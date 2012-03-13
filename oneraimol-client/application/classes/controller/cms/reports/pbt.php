<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Production Batch Ticket Report functionality of
 * Report module.
 *  
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Reports_Pbt extends Controller_Cms_Reports {
        /**
         * @var ORM $productionbatchticket Holds the productionbatchticket record from the DB.
         * @access private
         */
        private $productionbatchticket;  
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['pbt'];
            
        }

        public function action_showreport($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->productionbatchticket = ORM::factory('pbt')
                            ->where('pbt_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $html = View::factory('cms/reports/production/pbt/formreport')
                           ->set('productionbatchticket', $this->productionbatchticket);      
            
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");            
            $dompdf->render();
            $dompdf->stream("sample.pdf", array('Attachment' => 0));
        }
    }
    