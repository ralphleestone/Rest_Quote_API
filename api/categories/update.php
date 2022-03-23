<?php

// include required files
include_once '../../config/Database.php';
include_once '../../models/Category.php';
include_once '../../functions/IsValid.php';

// needs updated!

// Creates database object
$database = new Database();
$db = $database->connect();

// Creates category object
$category = new Category($db);

// Decodes json and reads data into a string
$data = json_decode(file_get_contents("php://input"));

$category->id = $data->id;
$category->category = $data->category;

if(isset($category->id) == false || isset($category->category) == false){
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}else{
    // converts json
    echo json_encode(
        array('id' => $category->id,
              'category' => $category->category)
    );
}

/*
// Checks if category was updated
if($category->update()){
    echo json_encode(
        array('id' => $category->id,
              'category' => $category->category)
    );
} else {
    echo json_encode(
        array('message' => 'category Not updated')
    );
}
*/
?>