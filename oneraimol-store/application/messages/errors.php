<?php defined('SYSPATH') or die('No direct script access.');

    return array (
        'account' => array (
            'username' => 'Username already used.',
            'email' => 'Email address already associated with this or another account.',
            'password' => 'Old password incorrect.',
            'passwordchangefail' => 'Password change failed. Contact Raimol PO Site Administrator for support.',
            'invalidconfirmationcode' => 'Invalid confirmation code.',
            'noacctfound' => 'No account found with the email specified.',
            'cantrequestreset' => "Cannot request password reset. Account still unverified."
        ),
        'login' => array (
                'fail' => "Invalid username or password.",
                'unverified' => "Account unverified. Check your mail to verify."
        ),
        'register' => array(
            'fail' => 'Registration Failed.'
        )
        
    );
    
    