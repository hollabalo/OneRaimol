<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Sample extends Controller {

	public function action_index()
	{
		$this->request->response = '<h1>Hello, world!</h1>';
	}
	
	/**
	 * IMPORTANT: This is just sample code! It does not actually run. 
	 */   	
  public function action_edit($id = NULL) {
    // save the data
    if (!empty($_POST)) {
      // sample code paths for edit and create
      if(is_numeric($id)) {
        // EDIT: load the model with ID
        $model = ORM::factory('user', $id);
      } else {
        // CREATE: do not specify id
        $model = ORM::factory('user');
      }
      $model->values($_POST);
      // since we combine both editing and creating here we need a separate variable
      // you can get rid of it if your actions don't need to do that
      $result = false;
      if(is_numeric($id)) {
        // EDIT: check using alternative rules
        $result = $model->check();
      } else {
        // CREATE: check using default rules
        $result = $model->check_edit();
      }
      if($result) {
        // validation passed, save model
        $model->save();
      } else {
        // Get errors for display in view --> to AppForm
        // Note how the first param is the path to the message file (e.g. /messages/register.php)
				$content->set('errors', $model->validate()->errors('register'));
        // Pass on the old form values --> to AppForm                   
        $content->set('defaults', $_POST);        
      }
    }
  }
} 
