<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Account history controller for Account module.
 * 
 * @category   Controller
 * @filesource classes/controller/account/history.php
 * @package    OneRaimol Store
 * @author     DCDGLP
 * @copyright  (c) 2012 DCDGLP
 */
    class Controller_Account_History extends Controller_Account {
        
        /**
         * Holds the purchase order record from the database
         * @var ORM 
         */
        private $purchaseorder;
        
        /**
         * Holds the delivery receipt record from the database
         * @var ORM 
         */
        private $deliveryreceipt;
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * @param string $record The record to be searched
         */
        public function action_index() {
            
            $this->template->title = 'Account History | Raimol&trade; Energized Lubricants Purchase Order';
            
            $this->user = ORM::factory('customer')
                                  ->where('customer_id', '=', Helper_Helper::decrypt($this->session->get('userid')))
                                  ->find();
            
            $po = $this->user->purchaseorders->find_all();
            
            $this->pagination = Pagination::factory(array(
                                    'items_per_page' => 10,
                                    'view' => 'pagination/basic',
                                    'total_items' => $po->count()
                                ));
            
            $this->purchaseorder = $this->user->purchaseorders
                                     ->order_by('po_id', 'DESC')
                                     ->limit( $this->pagination->items_per_page )
                                     ->offset( $this->pagination->offset )
                                     ->find_all();
            
            $this->template->bodyContents = View::factory('store/accounts/history')
                                                    ->set('pagination', $this->pagination->render())
                                                    ->set('purchaseorder', $this->purchaseorder);
            
        }
        
        /**
         * Displays the purchase order detail page
         * @param string $record The record to be viewed
         */
        public function action_vieworder($record = '') {
            
            $this->purchaseorder = ORM::factory('po')
                                         ->where('po_id', '=', Helper_Helper::decrypt($record))
                                         ->find();
            
            if($this->purchaseorder->loaded()) {
                $this->template->title = 'History - ' . $this->purchaseorder->po_id_string . ' | Raimol&trade; Energized Lubricants Purchase Order';
                
                $this->template->bodyContents = View::factory('store/accounts/purchaseorder')
                                                        ->set('po', $this->purchaseorder);
                
                // Set page action message to page
                if(($this->request->query('success')) && ($this->request->query('success') == 'true')) {
                    $this->template->bodyContents->set('success', TRUE);
                }
                
            }
            else {
                throw new HTTP_Exception_404('Error');
            }
        }
        
        /**
         * Generates a downloadable copy of the order in PDF format
         * @param string $record The record to be generated a downloadable copy
         */
        public function action_generatepdf($record = '') {
            
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            if($record != '') {
                $this->purchaseorder = ORM::factory('po')
                                ->where('po_id' ,'=', Helper_Helper::decrypt($record))
                                ->find();

                // Prepare PDF binary stream
                if($this->purchaseorder->loaded()) {
                    $filename = $this->purchaseorder->po_id_string . "--" . date("Y-m-d");

                    $this->session->delete('po_id_string');

                    $html = View::factory('reports/purchaseorder')
                                   ->set('purchaseorder', $this->purchaseorder);      

                    $html->render();

                    $dompdf = new DOMPDF();
                    $dompdf->load_html($html);
                    $dompdf->set_paper("a4", "portrait");
                    $dompdf->render();
                    $dompdf->stream($filename . ".pdf", array('Attachment' => 1)); 
                }
                else {
                    throw new HTTP_Exception_404('Record not found');
                }
            }
            else {
                $this->_expire_page();
            }
        }
        
        /**
         * Receives the PO in form of verification code
         * @param string $record The PO to be received
         */
        public function action_receiveorder($record = '') {
            if(isset($_POST['confirmation_code'])) {
                $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                                           ->where('confirmation_code', '=', $_POST['confirmation_code'])
                                           ->find();
                
                if($this->deliveryreceipt->loaded()) {
                    // 1 for user updated
                    // 2 for rainchem updated
                    // 0 for not received
                    $this->deliveryreceipt->order_receive_status = 1;
                    $this->deliveryreceipt->date_order_received = date('Y-m-d');
                    
                    // Build email array and instance
                    if($this->deliveryreceipt->save()) {
                        // Email
                        $receive = array(
                          'name'        => $this->deliveryreceipt->purchaseorders->customers->full_name(),
                          'po'          => $this->deliveryreceipt->purchaseorders->po_id_string,
                          'so_date'     => $this->deliveryreceipt->salesorders->date_created,
                          'dr_creation_date'    => $this->deliveryreceipt->date_created,
                          'dr_delivery_date'    => $this->deliveryreceipt->delivered_date,
                          'dr_receive_date'     => $this->deliveryreceipt->date_order_received
                        );

                        $body = View::factory('email/parent');

                        $body->mail_content = View::factory('email/account/orderreceived')
                                        ->bind('receive', $receive);

                        $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

                        $message = Swift_Message::newInstance()
                                    ->setSubject($this->config['msg']['email']['orderreceived'])
                                    ->setFrom(array('administrator@raimol.com' => 'RAIMOL Energized Lubricants'))
                                    ->setTo(array($this->deliveryreceipt->purchaseorders->customers->primary_email => $this->deliveryreceipt->purchaseorders->customers->full_name()))
                                    ->setBody($body, 'text/html');

                        $mailer->send($message);
                        
                        // Send to secondary email address if available
                        if(!is_null($this->deliveryreceipt->purchaseorders->customers->secondary_email)) {
                            $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

                            $message = Swift_Message::newInstance()
                                        ->setSubject($this->config['msg']['email']['orderreceived'])
                                        ->setFrom(array('administrator@raimol.com' => 'RAIMOL Energized Lubricants'))
                                        ->setTo(array($this->deliveryreceipt->purchaseorders->customers->secondary_email => $this->deliveryreceipt->purchaseorders->customers->full_name()))
                                        ->setBody($body, 'text/html');

                            $mailer->send($message);
                        }
                        
                        $this->json['url'] = $record;
                        $this->json['success'] = TRUE;
                        
                    }
                    else {
                        $this->json['success'] = FALSE;
                        $this->json['failmessage'] = FALSE;
                    }
                }
                else {
                    $this->json['success'] = FALSE;
                    $this->json['failmessage'] = $this->config['err']['account']['invalidconfirmationcode'];
                }
                
                $this->_json_encode();
            }
            else {
                $this->_expire_page();
            }
        }
    } // End Controller_Account_History