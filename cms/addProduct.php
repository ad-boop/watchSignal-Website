<?php
//Include libraries
require __DIR__ . '/../vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);
//Select a database
$db = $mongoClient->watchSignal;


//Extract the data of the product that was sent to the server
$product_name= filter_input(INPUT_POST, 'brandName', FILTER_SANITIZE_STRING);
$product_type= filter_input(INPUT_POST, 'watchType', FILTER_SANITIZE_STRING);
$gender= filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
$color = filter_input(INPUT_POST, 'watchColor', FILTER_SANITIZE_STRING);
$case_size = filter_input(INPUT_POST, 'watchSize', FILTER_SANITIZE_STRING);
$case_material = filter_input(INPUT_POST, 'caseMaterial', FILTER_SANITIZE_STRING);
$band = filter_input(INPUT_POST, 'band', FILTER_SANITIZE_STRING);
$price= filter_input(INPUT_POST, 'watchPrice', FILTER_SANITIZE_NUMBER_INT);
$quantity= filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
$description= filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$image= filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING);


//Convert to PHP array
$dataArray = [
    "product_name" => trim($product_name), 
    "product_type" => trim($product_type), 
    "gender" => trim($gender), 
    "case_size" => trim($case_size),
    "case_material" => trim($case_material),
    "band" => trim($band),
    "color" => trim($color),
    "quantity" => (int)trim($quantity),
    "price" => (int)trim($price),
    "description" => trim($description),
    "image" => trim($image)
];


//Add the new product to the database
$insertResult = $db->Products->insertOne($dataArray);

// if insertion of product successful
//Echo result back to user
if($insertResult->getInsertedCount()==1){
    
    echo 'ok';
}
// error in insertion
else {
    echo 'Error adding Product';
}
