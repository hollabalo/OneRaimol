<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Staff Report functionality of
 * Report module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Reports_Staff extends Controller_Cms_Reports {
        /**
         * @var ORM staff Holds the customer record from the DB.
         * @access private
         */
        private $staff;  
         
        /** 
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['staff'];
            
        }

        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_view($record = '') {
            
            //hahanapin yung record tapos...
            $this->staff = ORM::factory('staff')
                            ->where('staff_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewstaff'] . $this->staff->full_name();
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/accounts/staff/formreport')
                                                     ->set('staff', $this->staff)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->staff = ORM::factory('staff')
                            ->where('staff_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $html = View::factory('cms/reports/accounts/staff/formreport')
                           ->set('staff', $this->staff);      
            
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");  
            $dompdf->render();
            $dompdf->stream("sample.pdf", array('Attachment' => 0));
        }
    }
    