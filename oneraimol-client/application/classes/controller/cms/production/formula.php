<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Formula functionality of
 * Production module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Production_Formula extends Controller_Cms_Production {
        
        /**
         * @var ORM $formula Holds the formula record from the DB.
         * @access private
         */
        private $formula;

        /**
         * @var string formstatus Defines how the shared form will handle the request
         * @access private
         */
        private $formstatus;
        
        /**
         * @var int initialpagelimit Holds the default page limit from the system setting
         * @access private
         */
        private $initialpagelimit;
        
        /**
         *
         * @var ORM Database result of PWO items from ORM 
         * @access private
         */
        private $pwoitems;

        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['formula'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['production']['formulas'];
            
            $this->template->body->pageDescription = $this->config['desc']['production']['formulas']['description'];
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
                      
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
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/production/formula/grid')   //set yung html page
                                                       ->bind('formula', $this->formula);     // var to iterate yung supplier records  
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['production']['formulas'];
                $this->template->body->pageDescription = $this->config['desc']['production']['formulas']['description'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('formula'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('formula'), 'limit', $limit);
                }

                $this->formula = ORM::factory('formula')
                                        ->order_by( 'formula_id', 'DESC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        /**
         * Displays the formula details page.
         * @param string $record The record to be viewed
         */
        public function action_details($record = '') {
            $this->template->body->bodyContents = View::factory('cms/production/formula/formdetails')
                                                        ->bind('formuladetail', $this->formuladetail)
                                                        ->bind('formula', $this->formula);
            
            $this->formuladetail = ORM::factory('formuladetail')
                                    ->where('formula_id', '=', Helper_Helper::decrypt($record))
                                    ->find_all();
            
            $this->formula = ORM::factory('formula')
                                     ->where('formula_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
//            if($this->formula->loaded()) {
             $this->pageSelectionDesc = $this->config['msg']['page']['production']['formuladetails'] . $this->formula->formula_id_string . " of " . $this->formula->poitems->product_description;
//            }
        }
        /**
         * Shows the add form.
         */
        public function action_add() {
            //san ba uli ung msg?..
            $this->pageSelectionDesc = $this->config['msg']['actions']['newformula'];
            $this->formstatus = Constants_FormAction::ADD;
            //since iisang form lang ang ginagamit sa add at edit, kelangan lang
            //bigyan ng state yung form kung add o edit ba sya,
            //kaya yun ang trabaho ng formStatus
            $this->template->body->bodyContents = View::factory('cms/production/formula/form')
                                                        ->bind('pwoitem', $this->pwoitems)
                                                        ->bind('productionworkorder', $this->productionworkorder)
                                                        ->set('formStatus', $this->formstatus);
             
            $this->pwoitems = ORM::factory('pwoitem')
                                     ->where('status', '=', NULL)
                                     ->find_all();
            
            $this->productionworkorder = ORM::factory('pwo')
                                            ->order_by('pwo_id', 'DESC')
                                             ->where_open()
                                             ->and_where('hc_approved_status', '=', '1')
                                             ->and_where('sc_approved_status', '=', '1')
                                             ->and_where('accountant_approved_status', '=', '1')
                                             ->where_close()
                                            ->find_all();
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_edit($record = '') {
            
           
            $this->formula = ORM::factory('formula')
                            ->where('formula_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->formuladetail = ORM::factory('formuladetail')
                            ->where('formula_id', '=', Helper_Helper::decrypt($record))
                            ->find_all();
            
            $this->materialstocklevel = ORM::factory('materialstocklevel')
                    ->group_by('material_supply_id')
                    ->having('material_stock_level_tb.liters', '>', DB::select(array(DB::expr('SUM(liters)'), 'totalLitersUsed'))->from('material_stock_usage_tb'))
                    ->find_all();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editformula'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            $this->template->body->bodyContents = View::factory('cms/production/formula/editform')
                                                     ->set('formula', $this->formula)
                                                     ->set('formuladetail', $this->formuladetail)
                                                     ->set('materialstocklevel', $this->materialstocklevel)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->formula = ORM::factory('formula');
            $this->formuladetail = ORM::factory('formuladetail');
            
            //security na rin kaya specified yung condition since
            //kung may kumag na user na maalam sa mga ganto, pwede nyang palitan ang value
            //ng formstatus na hidden field dun sa form
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                
                $this->pwoitems = ORM::factory('pwoitem')
                                        ->where('pwo_item_id', '=', Helper_Helper::decrypt($_POST['pwo']))
                                        ->find();
                
                $flag = TRUE;
                $this->json['action'] = Constants_FormAction::ADD;
            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->formula->where('formula_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $this->formuladetail->where('formula_id', '=', Helper_Helper::decrypt($record))
                        ->find_all();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
                //Log activity
                $this->_save_activity_stafflog( 'editformula', $this->formula->formula_id_string);
            } 
            
            if($flag) {
                
                if($_POST['formstatus'] == Constants_FormAction::EDIT ){
                    
                    $delfordetail = 'DELETE FROM formula_detail_tb
                                        WHERE formula_id =' .  Helper_Helper::decrypt($record);
                    
                    $for = DB::query(Database::DELETE, $delfordetail)->execute();
                    
                    foreach($_POST['id'] as $id => $ids) {
                        
                          $itemid = $_POST['material'];
                          $delusage = 'DELETE FROM material_stock_usage_tb WHERE stock_id =' . Helper_Helper::decrypt($itemid[$id]);
                          $usage = DB::query(Database::DELETE, $delusage)->execute();
                    }
                }
                
                if(($_POST['formstatus'] == Constants_FormAction::ADD )) {
                
                    $this->formula->formula_id_string = Helper_Helper::set_pk(Constants_DocType::FORMULA);
                    $this->formula->po_item_id = Helper_Helper::decrypt($_POST['po_item_id']);
                    $this->formula->pwo_item_id =  Helper_Helper::decrypt($_POST['pwo_item_id']);
                    $this->formula->date_created = date("Y-m-d");
                    $this->formula->save();
                }

                $this->formula->values(array(
                    'selling_price' => $_POST['ps'],
                    'net_price' => $_POST['pn'],
                    'opex' => $_POST['opex'],
                    'direct_material_cost' => $_POST['direct_material_cost']
                ));
                $this->formula->save();
                
                foreach($_POST['id'] as $id => $ids) {
                    $liters = $_POST['liters'];
                    $dosage = $_POST['dosage'];
                    $price = $_POST['price'];
                    $direct_material_cost = $_POST['direct_material_cost'];
                    $itemid = $_POST['material'];
                
                    $array = array (
                        'formula_id' => $this->formula->formula_id,
                        'stock_id' => Helper_Helper::decrypt($itemid[$id]),
                        'dosage' => $dosage[$id],
                        'price' => $price[$id],
                        'liters' => $liters[$id]
                    );
                    
                    $this->formuladetail= ORM::factory('formuladetail')
                                            ->values($array)
                                            ->save();

                    $usage = array (
                        'stock_id' => Helper_Helper::decrypt($itemid[$id]),
                        'date'  => Helper_Helper::date(),
                        'liters' => $liters[$id]
                    );
                    $this->materialstockusage = ORM::factory('materialstockusage')
                                            ->values($usage)
                                            ->save();
                }
                if($_POST['formstatus'] == Constants_FormAction::ADD) {
                   //Log activity
                    $this->_save_activity_stafflog( 'newformula', $this->formula->formula_id_string);
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
         * Deletes records from the DB.
         */
        public function action_delete() {
            foreach( $_POST['id'] as $id ) {
                $this->formula = ORM::factory('formula')
                            ->where('formula_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->formula->loaded() ) {
                   //Log activity
                    $this->_save_activity_stafflog( 'deleteformula', $this->formula->formula_id_string);
                    $this->formula->delete();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
        
        /**
         * Populates the Unit material to the select box
         * @param int $record The request
         */
        public function action_populate_material($record = '') {
            $materialstocklevel = ORM::factory('materialstocklevel')
                    ->group_by('material_supply_id')
                    ->having('material_stock_level_tb.liters', '>', DB::select(array(DB::expr('SUM(liters)'), 'totalLitersUsed'))->from('material_stock_usage_tb'))
                    ->find_all();
//SELECT stock_id, liters, MIN(stock_taking_date), material_supply_id FROM material_stock_level_tb
//GROUP BY (material_supply_id)
//HAVING (SELECT SUM(liters) as totallitersused FROM material_stock_usage_tb
//) < material_stock_level_tb.liters
            echo View::factory('cms/production/formula/material')->set('materialstocklevel', $materialstocklevel);
            
            exit(0);
        } 
        
        /**
         * Filter by production work order id
         * @param string $filter The filter to be set on the page
         */
        public function action_filter($filter = '') {
            
            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->pageSelectionDesc = $this->config['msg']['page']['production']['productionworkorder'];
            
            if($filter == 'all'){
                $this->initialpagelimit = ORM::factory('systemsetting')->find();
                $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page)); 
            }
            else {
                $this->productionworkorder = ORM::factory('pwo')
                            ->where('status', '=', Helper_Helper::decrypt($filter))
                            ->order_by( 'pwo_id', 'DESC' )
                            ->find_all();    
                
                $this->template->body->bodyContents = View::factory('cms/production/formula/form')  
                                                           ->bind('productionworkorder', $this->productionworkorder); 
            }
            
            $this->template->body->bodyContents->selected = Helper_Helper::decrypt($filter);
        }
        
        /**
         * Populates PWO items based on the view form selection.
         * 
         * @param string $record Record to be selected
         */
        public function action_populate_pwoitems($record = '') {
            $rec = ORM::factory('pwo')
                         ->where('pwo_id', '=',Helper_Helper::decrypt($record))
                         ->find();
            
            if($rec->loaded()) {
                echo View::factory('cms/production/formula/pwolist')
                           ->set('pwoitems', $rec->pwoitems->find_all());
            }
            
            exit(0);
        }

        
        /**
         * Displays information of Material selected
         * 
         * @param string $record Record to be selected
         */
        public function action_populate_materialinfo($record = '') {
            $materialinfo = ORM::factory('materialstocklevel')
                            ->where('material_supply_id', '=', Helper_Helper::decrypt($record))
                            ->find();
            
            $materialusage = ORM::factory('materialstockusage')
                            ->where('stock_id', '=', $materialinfo->stock_id)
                            ->find();

                echo View::factory('cms/production/formula/materialinfo')
                                ->set('materialusage', $materialusage)
                                ->set('materialinfo', $materialinfo);
    
                exit(0);

        }
        /**
         * Processes the summary of formula computation
         */
        public function action_process_compute() {
            if(isset($_POST['desc']) && array_count_values($_POST['desc']) != 0) {
                echo View::factory('cms/production/formula/compute')
                            ->set('desc', $_POST['desc'])
                            ->set('dosage', $_POST['dosage'])
                            ->set('price', $_POST['price'])
                            ->set('opex', $_POST['opex'])
                            ->set('ps', $_POST['ps']);
            }
            else echo '';
            
            exit(0);
        }
        
        /**
         * Makes a search then populates the result
         * into the data grid.
         * @param string $record The search keyword
         * @param string $limit Number of search result records per page
         */
        public function action_search($record, $limit = NULL) {
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['production']['formulas'];
            
            $this->template->body->bodyContents = View::factory('cms/production/formula/grid');
            
            // Gotta be immune from SQL injection attacks. :)
            $this->formula = ORM::factory('formula')
                                      ->where(DB::expr("MATCH(formula_id)"), 'AGAINST', DB::expr("('+$record* +$record*' IN BOOLEAN MODE)"));
                                      
            
            // Paginate the result set
            $this->action_limit($limit, $this->supplier);
            
            // Set offset and item per page from the pagination object
            $this->formula->order_by( 'formula_id', 'DESC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('formula', $this->formula->find_all());
             
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_viewreport($record = '') {
            
            //hahanapin yung record tapos...
            $this->formula = ORM::factory('formula')
                            ->where('formula_id' ,'=', Helper_Helper::decrypt($record))
                            ->find(); 
            
            $this->formuladetail = ORM::factory('formuladetail')
                            ->where('formula_id', '=', Helper_Helper::decrypt($record))
                            ->find_all();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewformula'] . $this->formula->formula_id_string;
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/production/formula/viewreport')
                                                     ->set('formula', $this->formula)
                                                     ->set('formuladetail', $this->formuladetail)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->formula = ORM::factory('formula')
                            ->where('formula_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $this->formuladetail = ORM::factory('formuladetail')
                            ->where('formula_id', '=', Helper_Helper::decrypt($record))
                            ->find_all();
            
            $filename = $this->formula->formula_id_string . "--" . date("Y-m-d");
            
            $html = View::factory('cms/reports/production/formula/pdf-report')
                           ->set('formuladetail', $this->formuladetail)
                           ->set('formula', $this->formula);      
            
            $html->render();
            //Log activity
            $this->_save_activity_stafflog( 'saveformulaaspdf', $this->formula->formula_id_string);
            
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");            
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }
    }