<?php

class Model_Sample {
	/**
   * Validates a user when the record is modified.
   *
   * Different rules are needed (e.g. the email and username do not need to be new, just unique to this user).
   *
   * Unobtrusive: we setup the _validate value (see ORM) with custom values, then just run check().
   * Should not require further changes to surrounding code.
   *
   * @param $array An array of fields for the user record.
   * @return Validate Validation object, call check() on the return value to validate.
   */
  public function check_edit() {
    $values = $this->as_array();
    // since removing validation rules is tricky (this is needed to ignore the password),
    // we will just create our own alternate _validate object and store it in the model.
    $this->_validate = Validate::factory($values)
                ->label('username', $this->_labels['username'])
                ->label('email', $this->_labels['email'])
                ->rules('username', $this->_rules['username'])
                ->rules('email', $this->_rules['email'])
                ->filter('username', 'trim')
                ->filter('email', 'trim')
                ->filter('password', 'trim')
                ->filter('password_confirm', 'trim');
    // if the password is set, then validate it 
    // Note: the password field is always set if the model was loaded from DB (since there is a DB value for it)
    // So we will check for the password_confirm field instead.
    if(isset($values['password_confirm']) && (trim($values['password_confirm']) != '')) {
       $this->_validate
                ->label('password', $this->_labels['password'])
                ->label('password_confirm', $this->_labels['password_confirm'])
                ->rules('password', $this->_rules['password'])
                ->rules('password_confirm', $this->_rules['password_confirm']);
    }

    // Since new versions of Kohana automatically exclude the current user from the uniqueness checks,
    // we no longer need to define our own callbacks. 
		foreach ($this->_callbacks as $field => $callbacks) {
			foreach ($callbacks as $callback) {
				if (is_string($callback) AND method_exists($this, $callback)) {
					// Callback method exists in current ORM model
					$this->_validate->callback($field, array($this, $callback));
				} else {
					// Try global function
					$this->_validate->callback($field, $callback);
				}
			}
		}
    return $this->_validate->check();
  }

}