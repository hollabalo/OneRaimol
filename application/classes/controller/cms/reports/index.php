<?php

    class Controller_Cms_Reports_Index extends Controller_Cms_Reports {
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
        }
        
        public function action_index() {
            $this->template->body->bodyContents = 'REPORTS HOME';
        }
        
    }