<?php

// Sets headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Includes required files
include_once '../../config/Database.php';
include_once '../../models/Author.php';
include_once '../../functions/IsValid.php';

// Needs updated!!

// Creates dabase object
$database = new Database();
$db = $database->connect();

// Creates author object
$author = new Author($db);

$data = json_decode(file_get_contents("php://input"));

$author->id = $data->id;
$author->author = $data->author;

// Checks if author was updated
if ($author->update()) {
    // converts json
    echo json_encode(
        array (
            'id' => $author->id,
            'author'  => $author->author
            )
        );
    }else {
        echo json_encode(
            array('message' => 'author Not updated')
        );
    }
?>