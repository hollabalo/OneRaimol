<?php

    class Controller_Cms_Signatories_Formula extends Controller_Cms_Signatories {
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
        }
        
        public function action_index() {
            $this->leftSelection = 'formula';
            $this->pageSelectionDesc = 'Formulas Approval';
        }
        
    }