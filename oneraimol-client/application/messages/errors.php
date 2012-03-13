<?php defined('SYSPATH') or die('No direct script access.');

    return array (
        'account' => array (
            'username' => 'Username already used.',
            'email' => 'Email address already associated with this or another account.',
            'password' => 'Password does not matched.',
            'role' => 'Role limit exceeded.',
            'roleactivatefail' => 'Role limit exceeded or account has no role.'
        ),
        'login' => array (
                'fail' => "Invalid username or password."
        ),
        'inventory' => array (
            'material' => array (
                'desc' => 'Existing Material.'
            ),
            'product' => array (
                'desc' => 'Existing Product.'
            ),
            'unit' => array (
                'desc' => 'Existing Unit.'
            )
        ),
        'signatories' => array(
            'fail' => 'Failed to update document approval status.'
        ),
        'sales' => array(
            'dr' => array(
                'failreadydeliver' => 'Selected delivery receipt(s) has pending signatories.'
            )
        ),
        'production' => array(
            'pbt' => array(
                'release' => "Can't release PBT. Please update PBT(s) first. Selected PBT(s) has pending signatories",
                'pending' => 'Selected PBT(s) has pending signatories'
            )
        )
        
    );
    
    