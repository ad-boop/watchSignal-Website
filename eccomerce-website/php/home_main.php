<?php

//Include libraries
require __DIR__ . '/../../vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->watchSignal;

//Extract the data that was sent to the server
$search_string = filter_input(INPUT_POST, 'search_word', FILTER_SANITIZE_STRING);

//Create a PHP array with our search criteria
$findCriteria = [
    '$text' => [ '$search' => $search_string] 
 ];
//Find all of the customers that match  this criteria
$cursor = $db->Products->find($findCriteria);

//Output each productas a JSON object with comma in between
$jsonStr = '['; //Start of array of customers in JSON

//Work through the products
foreach ($cursor as $product){
    //var_dump($product);
    $jsonStr .= json_encode($product);//Convert PHP representation of productinto JSON 
    $jsonStr .= ',';//Separator between customers
}

//Remove last comma
$jsonStr = substr($jsonStr, 0, strlen($jsonStr) - 1);

//Close array
$jsonStr .= ']';

// json for recommended words
//Echo final stringS
echo $jsonStr;

// header("Location: search.html");


