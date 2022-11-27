<?php
//Include libraries
require __DIR__ . '/../../vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);
//Select a database
$db = $mongoClient->watchSignal;
$collection = $db->Customers;

//Extract the data that was sent to the server
$first_name= filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
$last_name= filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email_id', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password_input', FILTER_SANITIZE_STRING);
$telephone= filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
$address= filter_input(INPUT_POST, 'home_address', FILTER_SANITIZE_STRING);
$emirate= filter_input(INPUT_POST, 'emirate_input', FILTER_SANITIZE_STRING);





// findingin if email already exists
$findCriteria=["email_id" => trim($email)];
$doc = $db->Customers->findOne($findCriteria);

if(!empty($doc)){
    echo 'Data Already Exist';
 } 
//  else insert customer data into db
 else{
        //Convert to PHP array
    $dataArray = [
        "first_name" => trim($first_name), 
        "last_name" => trim($last_name), 
        "email_id" => trim($email), 
        "password" => trim($password),
        "telephone" => trim($telephone),
        "home_address" => trim($address),
        "emirate" => trim($emirate)
    ];
    $insertResult = $db->Customers->insertOne($dataArray);

    //Echo result back to user
    if($insertResult->getInsertedCount()==1){
        echo 'ok';
    }
    else {
      echo 'Error adding customer';
    }
 }