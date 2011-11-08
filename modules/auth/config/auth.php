<?php defined('SYSPATH') or die('No direct access allowed.');

return array(

	'driver'       => 'file',
	'hash_method'  => 'sha256',
	'hash_key'     => false,
	'lifetime'     => 1209600,
	'session_key'  => 'auth_user',
        'users'        => array(),
    
);
