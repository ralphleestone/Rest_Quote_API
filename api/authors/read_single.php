<?php

// Sets headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Includes required files
include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Creates dabase object
$database = new Database();
$db = $database->connect();

// Creates author object
$author = new Author($db);

$author->id = isset($_GET['id']) ? $_GET['id'] : die();

$author->read_single();

// Creates array
$author_arr = array (
    'id' => $author->id,
    'author' => $author->author
);

// Checks if id is null
if($author->id !== null) {
    print_r(json_encode($author_arr));
} 
else {
    echo json_encode(
        array('message' => 'authorId Not Found')
    );
}
?>