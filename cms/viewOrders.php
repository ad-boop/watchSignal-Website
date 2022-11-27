<?php

//Include libraries
require __DIR__ . '/../vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->watchSignal;

// //Extract the data that was sent to the server
// $product_type= "analog";

//Create a PHP array with our search criteria



//Find all of the customers that match  this criteria
$cursor = $db->Orders->find();

//Output each productas a JSON object with comma in between
$jsonStr = '['; //Start of array of customers in JSON

//Work through the products
foreach ($cursor as $order){
    //var_dump($product);
    $jsonStr .= json_encode($order);//Convert PHP representation of productinto JSON 
    $jsonStr .= ',';//Separator between customers
}

//Remove last comma
$jsonStr = substr($jsonStr, 0, strlen($jsonStr) - 1);

//Close array
$jsonStr .= ']';

//Echo final string
echo $jsonStr;

