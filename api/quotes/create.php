<?php

// Sets headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Includes needed files
include_once '../../config/Database.php';
include_once '../../models/Quote.php';
include_once '../../models/Author.php';
include_once '../../models/Category.php';
include_once '../../functions/IsValid.php';

// needs updated!

// Creates database object
$database = new Database();
$db = $database->connect();

// Creates Quote object
$quote = new Quote($db);

// Decodes json and reads data into a string
$data = json_decode(file_get_contents("php://input"));

$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->authorId = $data->authorId;
$quote->categoryId = $data->categoryId;

$authorIdExists = IsValid($quote->authorId,$quote);

if(!$authorIdExists){
    echo json_encode(array('message' => 'authorId Not Found'));
} else{
    // Converts to json
    echo json_encode(
        // Creates array
        array(
            'id' => $db->lastInsertId(),
            'quote' => $quote->quote,
            'authorId' => $quote->authorId,
            'categoryId' => $quote->categoryId)
        );
    }

/*
if(isset($quote->quote) == false){
    echo json_encode(array('message' => 'Missing Required Parameters'));
}else{
    // Converts to json
    echo json_encode(
        // Creates array
        array(
            'id' => $db->lastInsertId(),
            'quote' => $quote->quote,
            'authorId' => $quote->authorId,
            'categoryId' => $quote->categoryId)
        );
    }
*/

/*
// Checks if Quote was created
if($quote->create()) {
    // Converts to json
    echo json_encode(
        // Creates array
        array(
            'id' => $db->lastInsertId(),
            'quote' => $quote->quote,
            'authorId' => $quote->authorId,
            'categoryId' => $quote->categoryId)
        );
    } else {
        echo json_encode(
            array('message' => 'quote Not Created')
        );
    }
    */
?>