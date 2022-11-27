<?php

//Start session management
session_start();


//Include libraries
require __DIR__ . '/../../vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->watchSignal;

//Extract the customer details 
$customer_id= filter_input(INPUT_POST, 'customer_id', FILTER_SANITIZE_STRING);
$first_name= filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
$last_name= filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
$email_id = filter_input(INPUT_POST, 'email_id', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
$home_address = filter_input(INPUT_POST, 'home_address', FILTER_SANITIZE_STRING);
$emirate = filter_input(INPUT_POST, 'emirate', FILTER_SANITIZE_STRING);

//Criteria for finding document to replace
$replaceCriteria = [
    "email_id" => $_SESSION['loggedInCustomerEmail']
];

//Data to replace
$customerData = [
    "first_name" => trim($first_name),
    "last_name" => trim($last_name),
    "email_id" => trim($email_id),
    "password" => trim($password),
    "telephone" => trim($telephone),
    "home_address" => trim($home_address),
    "emirate" => trim($emirate)
];

//Replace customer data for this ID
$updateRes = $db->Customers->replaceOne($replaceCriteria, $customerData);
    
//Echo result back to user
// if customer detials is updated
if($updateRes->getModifiedCount() == 1)
    echo 'ok';
else
    echo 'Customer details replacement error.';