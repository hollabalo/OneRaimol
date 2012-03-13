<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Stock Usage functionality oooof
 * Inventory module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Inventory_Stockusage extends Controller_Cms_Inventory {
        
        /**
         * @var ORM $supplier Holds the supplier record from the DB.
         * @access private
         */
        private $supplier;
        /**
         * @var ORM $materialsupply Holds the materialsupply record from the DB
         * @access private
         */
        private $materialsupply;
        /**
         * @var string formstatus Defines how the shared form will handle the request
         * @access private
         */
        private $formstatus;
        
        /**
         * @var int initialpagelimit Holds the default page limit from the system setting
         */
        private $initialpagelimit;

        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['stock'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */

        public function action_view($record = ''){
            
            $this->template->body->bodyContents = View::factory('cms/inventory/stock/gridusage')
                                            ->bind('materialstocklevel', $this->materialstocklevel);
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->materialstockusage = ORM::factory('materialstocklevel')
                        ->where('stock_id', '=', Helper_Helper::decrypt($record))
                        ->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
                                  
        }
        
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            // Display the searchbox on the top bar
            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/inventory/stock/gridusage')
                                            ->bind('materialstockusage', $this->materialstockusage);
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['inventory']['stock'];
                $this->template->body->pageDescription = $this->config['desc']['inventory']['stocks']['description'];
                $this->template->body->pageNote = $this->config['desc']['inventory']['stocks']['note'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('materialstockusage')->where('stock_id', '=', $this->materialstockusage->stock_id), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('materialstockusage')->where('stock_id', '=', $this->materialstockusage->stock_id), 'limit', $limit);
                }

                $this->materialstockusage = ORM::factory('materialstockusage')
                                        ->where('stock_id', '=', $this->materialstockusage->stock_id )
                                        ->order_by( 'material_stock_usage_id', 'DESC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }                  
       
         /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_viewreport($record = '') {
            
            //hahanapin yung record tapos...
            $this->materialstockusage = ORM::factory('materialstockusage')
                            ->where('stock_id', '=', Helper_Helper::decrypt($record))
                            ->find_all();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewstock'];
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/inventory/stockusage/viewreport')
                                                     ->set('materialstockusage', $this->materialstockusage)
                                                     ->set('formStatus', $this->formstatus)
                                                     ->set('stock', $record);
        }
        
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->materialstockusage = ORM::factory('materialstockusage')
                            ->where('stock_id', '=', Helper_Helper::decrypt($record))
                            ->find_all();  
            
            $filename = "List of Stocks Used" . "--" . date("Y-m-d");
            
            $html = View::factory('cms/reports/inventory/stockusage/pdf-report')
                           ->set('materialstockusage', $this->materialstockusage);      
            
            $html->render();
            //Log activity
            $this->_save_activity_stafflog( 'savestockaspdf', "List of Stocks");
            
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }       
    }