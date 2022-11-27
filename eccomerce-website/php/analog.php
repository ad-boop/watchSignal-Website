<?php

//Include libraries
require __DIR__ . '/../../vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->watchSignal;

// //Extract the data that was sent to the server
$sortOption = filter_input(INPUT_POST, 'sort_option', FILTER_SANITIZE_NUMBER_INT);
// //Create a PHP array with our search criteria
$findCriteria = [
    "product_type"=>"analog"
 ];


// if theres not sort option
// normal finding
if (empty($sortOption)) {
    $cursor = $db->Products->find($findCriteria);
    
}
// sorted finding
else{
    
    //Find all of the customers that match  this criteria
    $sortArray=['sort' => ["price" => (int)$sortOption]];
    $cursor = $db->Products->find($findCriteria,$sortArray);
}





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

//Echo final string
echo $jsonStr;

