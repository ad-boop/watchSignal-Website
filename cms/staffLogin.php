<?php

//Start session management
session_start();

$email= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//Include libraries
require __DIR__ . '/../vendor/autoload.php';

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);
//Select a database
$db = $mongoClient->watchSignal;

//Create a PHP array with our search criteria
$findCriteria = [
    "staff_email" => $email
 ];

 $staffArray = $db->Staff->find($findCriteria)->toArray();

 //Check that there is exactly one customer
 if(count($staffArray) == 0){
    echo 'Staff email not found';
    return;
}
else if(count($staffArray) > 1){
    echo 'Database error: Multiple Staffs have same email address.';
    return;
}
//Get customer and check password
$staff = $staffArray[0];
if($staff['password'] != $password){
    echo 'Password incorrect.';
    return;
}
    
//Start session for this user
$_SESSION['loggedInStaffEmail'] = $email;

//Inform web page that login is successful
echo 'ok';  