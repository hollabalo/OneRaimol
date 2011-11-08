<?php

    class Controller_Cms_Production_Index extends Controller_Cms_Production {
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
        }
        
        public function action_index() {
            $this->template->body->bodyContents = 'TRACKING HOME';
        }
        
    }