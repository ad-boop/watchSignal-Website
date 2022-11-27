<?php

//Start session management
session_start();


//Include libraries
require __DIR__ . '/../../vendor/autoload.php';

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);
//Select a database
$db = $mongoClient->watchSignal;

$find_criteria=[
    "customer_email"=>$_SESSION['loggedInCustomerEmail']
];

$cursor = $db->Orders->find($find_criteria);

//Output each productas a JSON object with comma in between
$jsonStr = '['; //Start of array of customers in JSON

//Work through the products
foreach ($cursor as $customer){

    
    //var_dump($product);
    $jsonStr .= json_encode($customer);//Convert PHP representation of productinto JSON 
    $jsonStr .= ',';//Separator between customers

}
//Remove last comma
$jsonStr = substr($jsonStr, 0, strlen($jsonStr) - 1);

//Close array
$jsonStr .= ']';

//Echo final string
echo $jsonStr;

