<?php

// Sets headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Includes required files
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

$quote->delete();

$quote->id = $data->id;

/*
$quoteExists = isValid($quote->id,$quote);

if(isset($quote->id) !== false){
    if(!$quoteExists) {
        echo json_encode(array('message' => 'No Quotes Found')); 
    } else {
        echo json_encode(array('id' =>  $quote->id));
    }
}
*/

// checks if $quote->id is set
if(isset($quote->id) !== false) {
    // Converts data to json
    echo json_encode(
        array('id' =>  $quote->id));
} 
else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}

?>