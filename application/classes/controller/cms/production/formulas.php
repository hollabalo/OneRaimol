<?php

    class Controller_Cms_Production_Formulas extends Controller_Cms_Production {
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = 'formulas';
        }
        
        public function action_index() {
            $this->pageSelectionDesc = $this->config['msg']['page']['production']['formulas'];
            
            $this->template->body->bodyContents = 'TRACKING HOME';
        }
        
    }