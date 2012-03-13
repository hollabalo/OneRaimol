<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Production Work Order Report functionality of
 * Report module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Reports_Pwo extends Controller_Cms_Reports {
        /**
         * @var ORM $productionworkorder Holds the productionworkorder record from the DB.
         * @access private
         */
        private $productionworkorder;  
         
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['pwo'];
            
        }
        
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['sales']['pwo'];
            
            $this->template->body->pageDescription = $this->config['desc']['reports']['productionworkorders']['description'];
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
            
            $this->template->body->bodyContents = View::factory('cms/reports/production/pwo/grid')   //set yung html page
                                                       ->bind('productionworkorder', $this->productionworkorder);     // var to iterate yung customer records  
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['sales']['pwo'];
                $this->template->body->pageDescription = $this->config['desc']['reports']['productionworkorders']['description'];
           
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('pwo'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('pwo'), 'limit', $limit);
                }

                $this->productionworkorder = ORM::factory('pwo')
                                        ->order_by( 'pwo_id', 'ASC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }

        public function action_showreport($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->productionworkorder = ORM::factory('pwo')
                            ->where('pwo_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $html = View::factory('cms/reports/production/pwo/formreport')
                           ->set('productionworkorder', $this->productionworkorder);      
            
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("legal", "landscape");
            $dompdf->render();
            $dompdf->stream("sample.pdf", array('Attachment' => 0));
        }
    }
    