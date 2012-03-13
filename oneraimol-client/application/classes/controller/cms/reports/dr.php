<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Delivery Receipt Report functionality of
 * Report module.
 *  
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Reports_Dr extends Controller_Cms_Reports {
        /**
         * @var ORM $deliveryreceipt Holds the deliveryreceipt record from the DB.
         * @access private
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['dr'];
            
        }
        
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['sales']['dr'];
            
            $this->template->body->pageDescription = $this->config['desc']['reports']['deliveryreceipts']['description'];
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
        }
        
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/reports/sales/dr/grid')   //set yung html page
                                                       ->bind('deliveryreceipt', $this->deliveryreceipt);     // var to iterate yung customer records  
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['sales']['dr'];
                $this->template->body->pageDescription = $this->config['desc']['reports']['deliveryreceipts']['description'];
           
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('deliveryreceipt'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('deliveryreceipt'), 'limit', $limit);
                }

                $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                                        ->order_by( 'dr_id', 'ASC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        
        public function action_showreport($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                            ->where('dr_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $html = View::factory('cms/reports/sales/dr/formreport')
                           ->set('deliveryreceipt', $this->deliveryreceipt);      
            
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");            
            $dompdf->render();
            $dompdf->stream("sample.pdf", array('Attachment' => 0));
        }
    }
    