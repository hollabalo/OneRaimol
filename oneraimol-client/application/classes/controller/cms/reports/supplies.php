<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Supplies Report functionality of
 * Report module.
 *  
 * @category   Controller
 * @author     Laban, John Emmanuel B.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Reports_Supplies extends Controller_Cms_Reports {
        /**
         * @var ORM customer Holds the customer record from the DB.
         * @access private
         */
        private $stocks;  
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['supplies'];
            
        }

        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->materialsupply2 = ORM::factory('materialsupply')
                                    ->where('material_supply_id', '=', Helper_Helper::decrypt($record))
                                    ->find_all();    
            
            $this->materialsupply = ORM::factory('materialsupply')
                                    ->where('material_supply_id', '=', Helper_Helper::decrypt($record))
                                    ->find();
            
            $this->materialstocklevel = $this->materialsupply->materialstocklevel->find_all();

            $html = View::factory('cms/reports/inventory/supplies/formreport')
                           ->set('materialsupply', $this->materialsupply)
                           ->set('materialsupply2', $this->materialsupply2)
                           ->set('materialstocklevel', $this->materialstocklevel);      
            
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream("sample.pdf", array('Attachment' => 0));
        }
        
    }
    