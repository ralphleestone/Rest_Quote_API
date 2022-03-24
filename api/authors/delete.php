<?php

// Sets headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Includes required files
include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Creates database object
$database = new Database();
$db = $database->connect();

// Creates author object
$author = new Author($db);

// Decodes json and reads data into a string
$data = json_decode(file_get_contents("php://input"));

$author->id = $data->id;

// Checks if author was deleted
if($author->delete()) {
    echo json_encode(
        array('id' => $author->id )
    );
} else {
    echo json_encode(
        array('message' => 'Author not Deleted')
    );
}
?>