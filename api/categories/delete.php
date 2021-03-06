<?php

// Includes headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Includes required files
include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Creates database object
$database = new Database();
$db = $database->connect();

// Creates category object
$category = new Category($db);

// Decodes json and reads data into a string
$data = json_decode(file_get_contents("php://input"));

$category->id = $data->id;

// checks it category was deleted
if($category->delete()){
    echo json_encode(
        array('id' => $category->id)
    );
} else {
    echo json_encode(
        array('message' => 'category Not deleted')
    );
}
?>