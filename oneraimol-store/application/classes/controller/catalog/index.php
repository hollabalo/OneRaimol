<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Store Controller wrapper for the store subdirectory.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @author     Laban, John Emmanuel B.
 * @author     Panganiban, John Emmanuel B.
 * @copyright  (c) 2012 DCDGLP
 */
    class Controller_Catalog_Index extends Controller_Store {
        
        /**
         * The items in the catalog
         * @var ORM 
         */
        protected $items;
        
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
        public function action_index($record = NULL) {
            
            // Count categories result for pagination
            if(!is_null($record)) {
                $count = ORM::factory('product')
                              ->where('material_category_id', '=', Helper_Helper::decrypt($record))
//                              ->join('product_price_tb')
//                              ->on('product_tb.product_id', '=', 'product_price_tb.product_id')
                              ->find_all()
                              ->count();
            }
            else {
                $count = ORM::factory('product')
//                               ->join('product_price_tb')
//                               ->on('product_tb.product_id', '=', 'product_price_tb.product_id')
                               ->find_all()
                               ->count();
            }
            
            // Paginate database result
            $this->pagination = Pagination::factory(array(
                                    'items_per_page' => 10,
                                    'view' => 'pagination/basic',
                                    'total_items' => $count
                                ));
            
            // Set the paginated result to ORM items property
            if(!is_null($record)) {
                $this->items = ORM::factory('product')
                                  ->where('material_category_id', '=', Helper_Helper::decrypt($record))
//                                   ->join('product_price_tb')
//                                   ->on('product_tb.product_id', '=', 'product_price_tb.product_id')
                                  ->limit( $this->pagination->items_per_page )
                                  ->offset( $this->pagination->offset )
                                  ->find_all();
            }
            else {
                $this->items = ORM::factory('product')
//                                 ->join('product_price_tb')
//                                 ->on('product_tb.product_id', '=', 'product_price_tb.product_id')
                                 ->limit( $this->pagination->items_per_page )
                                 ->offset( $this->pagination->offset )
                                 ->find_all();
            }
           
            
            $this->template->bodyContents = View::factory('store/catalog/list')
                                                    ->set('items', $this->items)
                                                    ->set('pagination', $this->pagination->render());
            
        }
    }