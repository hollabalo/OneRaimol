<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Cms_Accounts_Index extends Controller_Cms_Accounts {
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
        }
        
        public function action_index() {
            $this->template->body->bodyContents = Request::detect_uri();
        }
        
    }