<link rel="stylesheet" href="css/cmsStyle.css">
<?php

session_start();
//Include libraries
require __DIR__ . '/../vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->watchSignal;

//Extract the data of product id that was sent to the server
$product_id = filter_input(INPUT_POST, 'productID', FILTER_SANITIZE_STRING);

//Create a PHP array with our find criteria 
// using product id
$findCriteria = [
    '_id' => new MongoDB\BSON\ObjectID($product_id)
 ];


//Find all of the profucts that match  this criteria
$cursor = $db->Products->find($findCriteria);


//Output each productas a JSON object with comma in between
echo '<div class="content">';
echo '<h1>Update Products</h1>';
echo '<div>';


// lopping through each products if theres many
//Work through the products
foreach ($cursor as $product){
    
    // form for editing products
    echo '<form action="editProduct.php" method="post">';
    // id in hidden text
    echo '<input type="hidden" id="productID" name="productID" value="'.$product['_id'].'">';

    // brand name
    echo '<label for="brandName">Watch Brand Name</label>';
    echo '<input type="text" id="brandName" name="brandName" value="'.$product['product_name'].'" required>';

    // gender
    echo '<label for="gender">Gender</label>';
    echo '<input type="text" id="gender" name="gender" value="'.$product['gender'].'" required>';

    // watch type
    echo '<label for="watchType">Watch Type</label>';
    echo '<input type="text" name="watchType" id="watchType" value="'.$product['product_type'].'" required>';

    // color of watch
    echo '<label for="watchColor">Watch Color</label>';
    echo '<input type="text" name="watchColor" id="watchColor" value="'.$product['color'].'" required>';

    // case size of watch
    echo '<label for="watchSize">Watch Dial Size</label>';
    echo '<input type="text" name="watchSize" id="watchSize" value="'.$product['case_size'].'" required>';

    // price
    echo '<label for="watchPrice">Watch Price</label>';
    echo '<input type="text" name="watchPrice" id="watchPrice" value="'.$product['price'].'" required>';

    // case material
    echo '<label for="caseMaterial">Case Material</label>';
    echo '<input type="text"  name="caseMaterial" id="caseMaterial" value="'.$product['case_material'].'" required>';

    // band 
    echo '<label for="band">Band</label>';
    echo '<input type="text"  name="band" id="band" value="'.$product['band'].'" required>';

    // stock of watches
    echo '<label for="quantity">Quantity</label>';
    echo '<input type="text" name="quantity" id="quantity" value="'.$product['quantity'].'" required>';

    // description of the watch
    echo '<label for="description">Description</label>';
    echo '<input type="text" name="description" id="description" value="'.$product['description'].'" required>';

    // image url
    echo '<label for="image">Image URL</label>';
    echo '<input type="text" name="image" id="image" value="'.$product['image'].'" required>';

    // submit url
    echo '<button type="submit">Update Product</button>';
    echo '</form>';
    
}