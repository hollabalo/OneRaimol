<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Formula Report functionality of
 * Report module.
 *  
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Reports_Formula extends Controller_Cms_Reports {
        /**
         * @var ORM $formula Holds the formula record from the DB.
         * @access private
         */
        private $formula;  
        
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

        public function action_showreport($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->formula = ORM::factory('formula')
                            ->where('formula_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $html = View::factory('cms/reports/production/formula/formreport')
                           ->set('formula', $this->formula);      
            
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");            
            $dompdf->render();
            $dompdf->stream("sample.pdf", array('Attachment' => 0));
        }
                /**
         * sample...
         */
        public function action_enable() {
            foreach( $_POST['id'] as $id ) {
                $this->customer = ORM::factory('customer')
                            ->where('customer_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->customer->loaded() ) {
                    $this->customer->status = 1;
                    $this->customer->save();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
    }
    