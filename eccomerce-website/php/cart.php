<?php
//Include libraries
require __DIR__ . '/../../vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);
//Select a database
$db = $mongoClient->watchSignal;
$collection = $db->Orders;

//Extract the order data that was sent to the server
$customer_id= filter_input(INPUT_POST, 'customer', FILTER_SANITIZE_STRING);
$products= filter_input(INPUT_POST, 'products', FILTER_SANITIZE_STRING);
$order_date = filter_input(INPUT_POST, 'orderdate', FILTER_SANITIZE_STRING);
$total_amount= filter_input(INPUT_POST, 'total', FILTER_SANITIZE_STRING);




        //Convert order to PHP array
    $dataArray = [
        "customer_email" => trim($customer_id), 
        "products" => $products, 
        "order_date" => trim($order_date),
        "total_amount" => trim($total_amount),
 
    ];

    // insert the order data
    $insertResult =$db->Orders->insertOne($dataArray);

    // if order data is inserted
    if($insertResult->getInsertedCount()==1){
        echo 'ok';
    }
    // error in insertion
    else {
        echo 'Error adding Order';
    }
 