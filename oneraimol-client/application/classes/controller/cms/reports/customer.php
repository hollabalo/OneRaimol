<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Customer Report functionality of
 * Report module.
 *  
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Reports_Customer extends Controller_Cms_Reports {
        /**
         * @var ORM customer Holds the customer record from the DB.
         * @access private
         */
        private $customer;  
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['customer'];
            
        }

        public function action_showreport($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->customer = ORM::factory('customer')
                            ->where('customer_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $html = View::factory('cms/reports/accounts/customer/formreport')
                           ->set('customer', $this->customer);      
            
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream("sample.pdf", array('Attachment' => 0));
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['reports']['accounts']['customers'];
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
                      
            // kailangang may notification sa grid index kung successful ba yung operation
            // ng add, edit, o delete
            // lalabas yung confirmation box dun sa successful action ng user
            // try mong magadd, edit, yung delete wala pa
            if(Helper_Helper::decrypt($status) == Constants_FormAction::ADD) {
                $this->template->body->bodyContents->success = 'created';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::EDIT) {
                $this->template->body->bodyContents->success = 'edited';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::DELETE) {
                $this->template->body->bodyContents->success = 'deleted';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::ENABLE) {
                $this->template->body->bodyContents->success = 'enabled';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::DISABLE) {
                $this->template->body->bodyContents->success = 'disabled';
            }
        }
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/reports/accounts/customer/grid')   //set yung html page
                                                       ->bind('customers', $this->customer);     // var to iterate yung customer records  
            
            // Paginating a result set with WHERE clause?
            if(!is_null($searchquery)) {
                // Important! Else, incorrect result will display. Or the query won't work.
                $queryclone = clone $searchquery;
                
                // Check if limit is supplied on the URI, else, don't paginate
                if(is_null($limit)) {
                    $this->_pagination($queryclone, 'limit', NULL, TRUE);
                }
                else {
                    $this->_pagination($queryclone, 'limit', $limit, TRUE);
                }
            }
            else {
                $this->pageSelectionDesc = $this->config['msg']['page']['reports']['accounts']['customers'];
                
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('customer'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('customer'), 'limit', $limit);
                }

                $this->customer = ORM::factory('customer')
                                        ->order_by( 'customer_id', 'ASC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_view($record = '') {
            
            //hahanapin yung record tapos...
            $this->customer = ORM::factory('customer')
                            ->where('customer_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewcustomer'] . $this->customer->full_name() . ' ' . $this->customer->status();
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/accounts/customer/form')
                                                     ->set('customer', $this->customer)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_viewreport($record = '') {
            
            //hahanapin yung record tapos...
            $this->customer = ORM::factory('cstomeru')
                            ->where('customer_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewcustomer'] . " " . $this->customer->full_name();
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/accounts/staff/viewreport')
                                                     ->set('customer', $this->customer)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->customer = ORM::factory('customer')
                            ->where('customer_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $html = View::factory('cms/reports/accounts/customer/pdf-report')
                           ->set('customer', $this->customer);      
            
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");  
            $dompdf->render();
            $dompdf->stream("sample.pdf", array('Attachment' => 1));
        }

    }
