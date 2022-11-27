<?php

//Start session management
session_start();

$email= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//Include libraries
require __DIR__ . '/../../vendor/autoload.php';

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);
//Select a database
$db = $mongoClient->watchSignal;

//Create a PHP array with our search criteria
$findCriteria = [
    "email_id" => $email
 ];

 $customerArray = $db->Customers->find($findCriteria)->toArray();

 //Check that there is exactly one customer
 if(count($customerArray) == 0){
    echo 'Customer email not found';
    return;
}
else if(count($customerArray) > 1){
    echo 'Database error: Multiple customers have same email address.';
    return;
}
//Get customer and check password
$customer = $customerArray[0];
if($customer['password'] != $password){
    echo 'Password incorrect.';
    return;
}
    
//Start session for this user
$_SESSION['loggedInCustomerEmail'] = $email;

//Inform web page that login is successful
echo 'ok';  