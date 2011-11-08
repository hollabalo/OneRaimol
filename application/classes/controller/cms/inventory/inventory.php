<?php

    class Controller_Cms_Inventory_Inventory extends Controller_Cms_Inventory {
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = 'inventory';
        }
        
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['inventory']['inventory'];
            
            // cats ha
            $cats = array(
                '1' => array(
                    '1' => array(
                        '1' => 'Compressor Oil',
                        '2' => 'Gas Oils',
                        '3' => 'Hydraulic Oils',
                        '4' => 'Slideway Oils',
                        '5' => 'Spindle Oils',
                        '6' => 'Turbine Oils',
                        '7' => 'Refrigerator Oils'
                    ),
                    '2' => 'Metal Working Fluid',
                    '3' => 'Stamping Oils',
                    '4' => 'Die Casting',
                    '5' => 'Cleaners',
                    '6' => 'Corrosion Preventive',
                    '7' => 'Transformer Oil'
                ),
                '2' => array(
                    '1' => 'Motorcycle Oils',
                    '2' => 'Gasoline Engine Oil',
                    '3' => 'Diesel Engine Oil',
                    '4' => 'Automatic Transmission',
                    '5' => 'Gear Oils'
                ),
                '3' => 'Marine',
                '4' => 'Greases',
                '5' => 'Aerosols'
            );
            
            $pagination = Pagination::factory(array(
                        'items_per_page' => 10,
                        'view' => 'pagination/boxes',
                        'total_items' => ORM::factory('product')->count_all(),
            ));
            
            $products = ORM::factory('product')
                            ->limit( $pagination->items_per_page )
                            ->offset( $pagination->offset )
                            ->order_by('product_id', 'DESC')
                            ->find_all();
              
            
            $this->template->body->bodyContents = View::factory('cms/inventory/grid')   //set yung html page
                                                       ->set('products', $products)
                                                       ->set('pagelinks', $pagination);
            
           if(Helper_Helper::decrypt($status) == 'add') {
                $this->template->body->bodyContents->success = 'created';
            }
            else if(Helper_Helper::decrypt($status) == 'edit') {
                $this->template->body->bodyContents->success = 'edited';
            }
            else if(Helper_Helper::decrypt($status) == 'delete') {
                $this->template->body->bodyContents->success = 'deleted';
            }

        }
        
        public function action_add() {
            $this->pageSelectionDesc = 'New Product';
            
            $this->template->body->bodyContents = View::factory('cms/inventory/form')
                                                        ->set('formStatus', 'add');
        }
        
        public function action_edit($record = '') {
            
         
            $product = ORM::factory('product')
                            ->where('product_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = 'Edit Product';
      
            $this->template->body->bodyContents = View::factory('cms/inventory/form')
                                                     ->set('product', $product)
                                                     ->set('formStatus', 'edit');
        }
        
         public function action_delete() {
            foreach( $_POST['id'] as $id ) {
                $product = ORM::factory('product')
                            ->where('product_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $product->loaded() ) {
                    $product->delete();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
        
        public function action_process_form($record = '') {
            
            $flag = false; 
            
            $product = ORM::factory('product');
            
            if($_POST['formstatus'] == 'add') {
                $flag = true;
                $this->json['action'] = 'add';
                
            }
            else if($_POST['formstatus'] == 'edit') {
                $product->where('product_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = 'edit';
            }
           
            //kung walang error
            if($flag) {
                $product->name = $_POST['productname'];
                $product->category_id = $_POST['category_id'];
                $product->save();
                
                $this->json['success'] = true;
            }
            else {
                $this->json['success'] = false;
            }

            $this->_json_encode();
        }
        
    }