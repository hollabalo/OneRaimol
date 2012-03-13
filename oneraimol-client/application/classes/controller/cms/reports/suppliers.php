<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Suppliers Report functionality of
 * Report module.
 *  
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Reports_Suppliers extends Controller_Cms_Reports {
        /**
         * @var ORM supplier Holds the supplier record from the DB.
         * @access private
         */
        private $supplier;  
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['supplier'];
            
        }

        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->supplier = ORM::factory('supplier')
                            ->where('supplier_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $html = View::factory('cms/reports/inventory/suppliers/formreport')
                           ->set('supplier', $this->supplier);      
            
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream("sample.pdf", array('Attachment' => 0));
        }
    }
    