<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Material Report functionality of
 * Report module.
 *  
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Reports_Material extends Controller_Cms_Reports {
        /**
         * @var ORM customer Holds the customer record from the DB.
         * @access private
         */
        private $material;  
        
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

        public function action_showreport() {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->material = ORM::factory('material')
                                   // ->where('material_id', '=', Helper_Helper::decrypt($record))
                                    ->order_by( 'material_id', 'ASC' )
                                    ->find_all();

            $html = View::factory('cms/reports/inventory/material/formreport')
                           ->set('material', $this->material);      
            
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream("sample.pdf", array('Attachment' => 0));
        }
    }