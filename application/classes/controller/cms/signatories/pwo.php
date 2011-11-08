<?php

    class Controller_Cms_Signatories_Pwo extends Controller_Cms_Signatories {
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
        }
        
        public function action_index() {
            $this->leftSelection = 'pwo';
            $this->pageSelectionDesc = 'Production Work Orders Approval';
        }
        
    }