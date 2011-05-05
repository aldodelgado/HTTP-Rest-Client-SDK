<?php

include_once('controller.php');

$new_user = array(
    'user' => array(
        'login' => 'yoyo',
        'email' => 'yoyo@123.com',
        'mobile' => '3052221123',
        'first_name' => 'Joe',
        'last_name' => 'Smith',
        'birth_year' => '1974',
        'gender' => 'male',
        'address' => '123 home st',
        'address2' => 'suite 3',
        'state' => 'FL',
        'city' => 'Hollywood',
        'zip' => '33301',
        'income' => '55000',
        'sms' => '1',
        'newsletter' => '1',
        'mac' => '00:0a:10:00:00',
        'agreed_to_terms' => '1'
        #'created_at' => '',
        #'home' => '',
    )
);

$search_params = array(
        'mobile' => '3052221123'
);

$update_params = array(
    'user' => array(
        'mobile' => '5552221123'
    )
);

$user = new UserResource;

// User All
$all_users = $user->all();

// User create 
#$response = $user->create($new_user);

// User search
//$x = $user->search($search_params);

// User update
#$response = $user->update($update_params);
// User destroy

print_r($all_users);

?>
