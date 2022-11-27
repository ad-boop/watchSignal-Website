<?php

//Include libraries
require __DIR__ . '/../vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->watchSignal;

//Extract ID from POST data
$orderID = filter_input(INPUT_POST, 'orderID', FILTER_SANITIZE_STRING);

//Build PHP array with delete criteria 
$deleteCriteria = [
    "_id" => new MongoDB\BSON\ObjectID($orderID)
];

//Delete the customer document
$deleteRes = $db->Orders->deleteOne($deleteCriteria);
    
//Echo result back to user
if($deleteRes->getDeletedCount() == 1){
    echo 'ok';
    // header("Location: deleteOrders.html");
}
else{ 
   echo 'Error deleting Order';
}