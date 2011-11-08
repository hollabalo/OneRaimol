<?php

    class Controller_Cms_Signatories_So extends Controller_Cms_Signatories {
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
        }
        
        public function action_index() {
            $this->leftSelection = 'so';
            $this->pageSelectionDesc = 'Sales Orders Approval';
        }
        
    }