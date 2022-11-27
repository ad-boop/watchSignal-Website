<?php

//Include libraries from the vendor
require __DIR__ . '/../vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->watchSignal;

//Extract ID from POST data for product id
$productID = filter_input(INPUT_POST, 'productID', FILTER_SANITIZE_STRING);

//Build PHP array with delete criteria 
$deleteCriteria = [
    "_id" => new MongoDB\BSON\ObjectID($productID)
];

//Delete the prdocut document
$deleteRes = $db->Products->deleteOne($deleteCriteria);
    
// if deletion successfu;
//Echo result back to user
if($deleteRes->getDeletedCount() == 1){
    echo 'ok';
}
// error in deletion
else{
   echo 'Error deleting Product';
}
