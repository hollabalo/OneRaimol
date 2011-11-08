<?php

    class Controller_Cms_Production_Pbt extends Controller_Cms_Production {
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = 'pbt';
        }
        
        public function action_index() {
            $this->pageSelectionDesc = $this->config['msg']['page']['production']['pbt'];
            
            $this->template->body->bodyContents = 'TRACKING HOME';
        }
        
    }