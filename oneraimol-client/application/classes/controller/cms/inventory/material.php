<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Material functionality of
 * Inventory module.
 * 
 * @category   Controller
 * @filesource classes/controller/cms/inventory/material.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Inventory_Material extends Controller_Cms_Inventory {
        /*
         * @var ORM material Holds the material records from the DB
         * @access private
         */
        private $material;
        /**
         * @var ORM materialsupply Holds the materialsupply record from the DB.
         * @access private
         */
        private $materialsupply;
        /**
         * @var int $materialstocklevel Holds the materialstocklevel record from the DB.
         * @access private
         */
        private $materialstocklevel;
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['material'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['inventory']['material'];
            
            $this->template->body->pageDescription = $this->config['desc']['inventory']['rawmaterials']['description'];
            $this->template->body->pageNote = $this->config['desc']['inventory']['rawmaterials']['note'];
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')
                                            ->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Display the searchbox on the top bar
            $this->template->header->searchbox = $this->_get_current_url('search');
                      
            // kailangang may notification sa grid index kung successful ba yung operation
            // ng add, edit, o delete
            // lalabas yung confirmation box dun sa successful action ng user
            if(Helper_Helper::decrypt($status) == Constants_FormAction::ADD) {
                $this->template->body->bodyContents->success = 'created';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::EDIT) {
                $this->template->body->bodyContents->success = 'edited';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::DELETE) {
                $this->template->body->bodyContents->success = 'deleted';
            }
         }
        
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            // Display the searchbox on the top bar
            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/inventory/material/grid')   //set yung html page
                                                          ->bind('material', $this->material);     // var to iterate yung material records  
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['inventory']['material'];
                $this->template->body->pageDescription = $this->config['desc']['inventory']['rawmaterials']['description'];
                $this->template->body->pageNote = $this->config['desc']['inventory']['rawmaterials']['note'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('material'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('material'), 'limit', $limit);
                }
                    
                $this->material = ORM::factory('material')
                                        ->order_by( 'material_id', 'ASC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
                

                
               
            }
        }
        
        /**
         * Displays the material details page.
         * @param string $record The record to be viewed
         */
         public function action_details($record = '', $status = '') {
            $this->formstatus = Constants_FormAction::EDIT;
            $this->template->body->bodyContents = View::factory('cms/inventory/material/form-gridmaterialstock')
                                                        ->bind('material', $this->material)
                                                        ->bind('materialstocklevel', $this->materialstocklevel)
                                                        ->set('formStatus', $this->formstatus);
          
            //para sa form edit
            $this->material = ORM::factory('material')
                                     ->where('material_id', '=', Helper_Helper::decrypt($record))
                                     ->find();

            $this->materialstocklevel = ORM::factory('materialstocklevel')
                                    ->join('material_supply_tb','INNER')
                                    ->on('material_stock_level_tb.material_supply_id', '=', 'material_supply_tb.material_supply_id')
                                    ->join('material_tb','INNER')
                                    ->on('material_tb.material_id', '=', 'material_supply_tb.material_id')
                                    ->where('material_tb.material_id', '=', Helper_Helper::decrypt($record))
                                    ->find_all();
        }
        
        /**
         * Shows the add form.
         */
        public function action_add($record = '') {
            //san ba uli ung msg?..
            $this->pageSelectionDesc = $this->config['msg']['actions']['newmaterial'];
            $this->formstatus = Constants_FormAction::ADD;
            //since iisang form lang ang ginagamit sa add at edit, kelangan lang
            //bigyan ng state yung form kung add o edit ba sya,
            //kaya yun ang trabaho ng formStatus
            $this->material = ORM::factory('material')
                            ->where('material_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->category = ORM::factory('materialcategory')
                            ->where('description', '=', 'Base Oil')
                            ->or_where('description', '=', 'Additives')
                            ->find_all();
            
            $this->template->body->bodyContents = View::factory('cms/inventory/material/form')
                                                        ->set('material', $this->material)
                                                        ->set('category', $this->category)
                                                        ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Shows the addstock form.
         */
        public function action_addstock($record = '') {
            //san ba uli ung msg?..
            $this->pageSelectionDesc = $this->config['msg']['actions']['newmaterial'];
            $this->formstatus = Constants_FormAction::ADD;
            //since iisang form lang ang ginagamit sa add at edit, kelangan lang
            //bigyan ng state yung form kung add o edit ba sya,
            //kaya yun ang trabaho ng formStatus
            
            $this->material = ORM::factory('material')
                            ->where('material_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();   
            
            $this->materialsupply = ORM::factory('materialsupply')
                            ->where('material_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->materialstocklevel = ORM::factory('materialstocklevel')
                            ->where('stock_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->template->body->bodyContents = View::factory('cms/inventory/material/form-materialstock')
                                                        ->set('materialstocklevel', $this->materialstocklevel)
                                                        ->set('stock_id', $record)
                                                        ->set('formStatus', $this->formstatus);
        }
        
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_edit($record = '') {
            
            //hahanapin yung record tapos...
            $this->material = ORM::factory('material')
                            ->where('material_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->category = ORM::factory('materialcategory')
                            ->where('description', '=', 'Additives')
                            ->or_where('description', '=', 'Base Oil')
                            ->find_all();
            $this->pageSelectionDesc = $this->config['msg']['actions']['editmaterial'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            //..tapos iloload sa variable na visible sa view, $material
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/inventory/material/form')
                                                     ->set('material', $this->material)
                                                     ->set('category', $this->category)
                                                     ->set('formStatus', $this->formstatus);
        }    
        
//         /**
//         * Shows the edit form.
//         * @param string $record The record to be edited.
//         */
//        public function action_edit($record = '') {
//            
//            //hahanapin yung record tapos...
//            $this->materialstocklevel = ORM::factory('materialstocklevel')
//                            ->where('stock_id' ,'=', Helper_Helper::decrypt($record))
//                            ->find();
//            
//            $this->pageSelectionDesc = $this->config['msg']['actions']['editmaterial'];
//            $this->formstatus = Constants_FormAction::EDIT;
//            
//            //..tapos iloload sa variable na visible sa view, $supplier
//            //may formStatus rin
//            $this->template->body->bodyContents = View::factory('cms/inventory/material/form-materialstock')
//                                                     ->set('materialstocklevel', $this->materialstocklevel)
//                                                     ->set('stock_id', $this->materialstocklevel->materialsupply->material_id)
//                                                     ->set('formStatus', $this->formstatus);
//        }
          
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->material = ORM::factory('material');
            
            //security na rin kaya specified yung condition since
            //kung may kumag na user na maalam sa mga ganto, pwede nyang palitan ang value
            //ng formstatus na hidden field dun sa form
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                //kelangang itest kung used na yung descriptoin
                //kasi diba hindi pwedeng magpareho ang description (material name)
                $this->material->where('description', '=', $_POST['description'])
                         ->find();
                
               $flag = true;
               $this->json['action']=Constants_FormAction::ADD;
                              
          
            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->material->where('material_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
                //Log activity
                $this->_save_activity_stafflog( 'editmaterial', $this->material->material_id);
            }
             if($flag) {
                $this->material->values($_POST);
                $this->material->category_id = Helper_Helper::decrypt($_POST['category']);
                $this->material->save();
                if ($_POST['formstatus'] == Constants_FormAction::ADD) {
                    //Log activity
                    $this->_save_activity_stafflog( 'newmaterial', $this->material->material_id);
                }
                $this->json['success'] = true;
            }
            //may mga error na nadetect
            else {
                $this->json['success'] = false;
            }          
            //since ajax ang method ng pagssubmit ng form, kelangang pasahan ng
            //json encoded message yung page para mamanipulate thru javascript yung
            //gagawin ng form kapag nasubmit na yung form
            $this->_json_encode();
        }
        
       /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_formmaterialstock($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->materialsupply = ORM::factory('materialsupply');
            $this->materialstocklevel = ORM::factory('materialstocklevel');
            
            
            //security na rin kaya specified yung condition since
            //kung may kumag na user na maalam sa mga ganto, pwede nyang palitan ang value
            //ng formstatus na hidden field dun sa form
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                
               $flag = true;
               $this->json['action']=Constants_FormAction::ADD;
                              
          
            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->materialstocklevel->where('material_supply_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                $this->materialsupply->where('material_supply_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
            }
             if($flag) {
 
                //for material supply
                $this->materialsupply->values(array(
                                                  'price' => $_POST['price'], 
                                                  'supplier_id' => $_POST['supplier_id'],
                                                  'material_id' => Helper_Helper::decrypt($_POST['stock_id'])
                                             ));
                
                $this->materialsupply->save();
                
                 //for materialstocklevel
                $this->materialstocklevel->values(array(
                                                      'stock_taking_date' => $_POST['stock_taking_date'],
                                                      'liters' => $_POST['liters'],
                                                      'expiration_date' => $_POST['expiration_date'],
                                                      'material_supply_id' => $this->materialsupply->material_supply_id
                    
                ));
  
                $this->materialstocklevel->save();
                
                
                $this->json['success'] = true;
            }
            //may mga error na nadetect
            else {
                $this->json['success'] = false;
            }          
            //since ajax ang method ng pagssubmit ng form, kelangang pasahan ng
            //json encoded message yung page para mamanipulate thru javascript yung
            //gagawin ng form kapag nasubmit na yung form
            $this->_json_encode();
        }
              
        /**
         * Makes a search then populates the result
         * into the data grid.
         * @param string $record The search keyword
         * @param string $limit Number of search result records per page
         */
        public function action_search($record, $limit = NULL) {
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['inventory']['material'];
            
            $this->template->body->bodyContents = View::factory('cms/inventory/material/grid');
            
            // Gotta be immune from SQL injection attacks. :)
            $this->material = ORM::factory('material')
                                      ->where(DB::expr("MATCH(description)"), 'AGAINST', DB::expr("('+$record* +$record*' IN BOOLEAN MODE)"));
                                     
            
            // Paginate the result set
            $this->action_limit($limit, $this->material);
            
            // Set offset and item per page from the pagination object
            $this->material->order_by( 'material_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('material', $this->material->find_all());
             
        }
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_viewreport() {
            
            //hahanapin yung record tapos...
            $this->material = ORM::factory('material')
                            ->order_by('material_id', 'ASC')
                            ->find_all();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewmaterial'];
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/inventory/material/viewreport')
                                                     ->set('material', $this->material)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Generates PDF
         */
        public function action_generatepdf() {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->material = ORM::factory('material')
                                   // ->where('material_id', '=', Helper_Helper::decrypt($record))
                                    ->order_by( 'material_id', 'ASC' )
                                    ->find_all();

            $filename = "List of Materials" . "--" . date("Y-m-d");
            
            $html = View::factory('cms/reports/inventory/material/pdf-report')
                           ->set('material', $this->material);      
            
            $html->render();
            //Log activity
            $this->_save_activity_stafflog( 'savematerialaspdf', "List of Materials");
            
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }
    }