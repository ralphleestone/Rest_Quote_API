<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

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

if(isset($quote->quote)){
    echo json_encode(
        array('message' => 'quote not updated')
    );
}

$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->authorId = $data->authorId;
$quote->categoryId = $data->categoryId;

/*
$authorIdExists = isValid($quote->authorId,$quote);
$categoryIdExists = isValid($quote->categoryId,$quote);

if(!$authorIdExists){
    echo json_encode(array('message' => 'authorId Not Found'));
}

if(!$categoryIdExists){
    echo json_encode(array('message' => 'categoryId Not Found'));
}
*/

// Checks if Quote was updated
if($quote->update()) {
    echo json_encode(
        array('id' => $quote->id,
        'quote' => $quote->quote,
        'authorId' => $quote->authorId,
        'categoryId' => $quote->categoryId
        )
    );
} else {
    echo json_encode(
        array('message' => 'quote not updated')
    );
}
?>