<?php

    class Controller_Cms_Inventory_Rawmaterials extends Controller_Cms_Inventory {
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = 'rawmaterials';
        }
        
        public function action_index() {
            $this->pageSelectionDesc = $this->config['msg']['page']['inventory']['raw'];
        }
        
    }