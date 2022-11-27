<?php

//Include libraries
require __DIR__ . '/../vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->watchSignal;

//Extract the data of the product that was sent to the server
$product_id = filter_input(INPUT_POST, 'productID', FILTER_SANITIZE_STRING);
$brandName= filter_input(INPUT_POST, 'brandName', FILTER_SANITIZE_STRING);
$gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
$watchType = filter_input(INPUT_POST, 'watchType', FILTER_SANITIZE_STRING);

$watchSize= filter_input(INPUT_POST, 'watchSize', FILTER_SANITIZE_STRING);
$watchColor= filter_input(INPUT_POST, 'watchColor', FILTER_SANITIZE_STRING);
$watchPrice= filter_input(INPUT_POST, 'watchPrice', FILTER_SANITIZE_STRING);
$caseMaterial= filter_input(INPUT_POST, 'caseMaterial', FILTER_SANITIZE_STRING);
$band= filter_input(INPUT_POST, 'band', FILTER_SANITIZE_STRING);
$quantity= filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_STRING);
$description= filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$image= filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING);




//Criteria for finding document or data to replace
$replaceCriteria = [
    "_id" => new MongoDB\BSON\ObjectID($product_id)
];

//Data to replace for the document
$productData = [
    "product_name" => trim($brandName),
    "product_type" => trim($watchType),
    "gender" => trim($gender),
    "case_size" => trim($watchSize),
    "case_material" => trim($caseMaterial),
    "band" => trim($band),
    "color" => trim($watchColor),
    "quantity" => (int)trim($quantity),
    "price" => (int)trim($watchPrice),
    "description" => trim($description),
    "image" => trim($image)
];

//Replace product data for this ID
$updateRes = $db->Products->replaceOne($replaceCriteria, $productData);
    
//Echo result back to user
// if successfully modified
if($updateRes->getModifiedCount() == 1){
    echo 'ok';
    header("LOCATION:editProduct.html");
}
// error in modification
else{
    echo 'Product replacement error.';
}
