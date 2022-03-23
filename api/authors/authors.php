<?php

// Sets headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Includes required files
include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Creates database object
$database = new Database();
$db = $database->connect();

// Creates author object
$author = new Author($db);

$result = $author->read();

$num = $result->rowCount();

if($num > 0) {
    $author_arr = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $author_item = array( 
            'id' => $id,
            'author' => $author
        );
        array_push($author_arr, $author_item);
    }
    print_r(json_encode($author_arr));
} else {
    echo json_encode(
        array('message' => 'No authors found')
    );
}
?>