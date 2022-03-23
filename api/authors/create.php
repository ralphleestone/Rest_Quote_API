<?php

// Sets headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Includes required files
include_once '../../config/Database.php';
include_once '../../models/Author.php';
include_once '../../functions/IsValid.php';

// needs updated!

// Create datbase object
$database = new Database();
$db = $database->connect();

// Create author object
$author = new Author($db);

// Decodes json and reads data into a string
$data = json_decode(file_get_contents("php://input"));

$author->id = $data->id;
$author->author = $data->author;

/*
if(isset($author->id) == false || isset($author->author) == false){
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}else{
    // Converts to json
    echo json_encode(
        array(
            'id' => $db->lastInsertId(),
            'author' => $author->author)
        );
    }
*/

// Checks if author was created
if($author->create()) { 
    // Converts to json
    echo json_encode(
        array(
            'id' => $db->lastInsertId(),
            'author' => $author->author)
        );
    }
    
?>