<?php

// Sets headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Includes required files
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

if(isset($category->category) == false){
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}else{
    // Converts to json
    echo json_encode(
        array(
            'id' => $db->lastInsertId(),
            'category' => $category->category)
        );
    }

/*
$categoryExists = IsValid($category->id,$category)

if(!categoryExists){
    echo json_encode(array('message' => 'Missing Required Parameters'));
}
*/

/*
if(isset($category->category) == NULL){
    echo json_encode(array('message' => 'Missing Required Parameters'));
}
*/
/*
// checks if category was created
if($category->create()){
    // Converts to json
    echo json_encode(
        array(
            'id' => $db->lastInsertId(),
            'category' => $category->category)
        );
    } else {
        echo json_encode(
            array('message' => 'Missing Required Parameters')
        );
    }
?>