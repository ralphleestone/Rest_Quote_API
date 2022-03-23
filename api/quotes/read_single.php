<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Creates database object
$database = new Database();
$db = $database->connect();

// Creates Quote object
$quote = new Quote($db);

$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

$quote->read_single();

// Creates array
$quote_arr = array (
    'id' => $quote->id,
    'quote' => $quote->quote,
    'author' => $quote->author,
    'category' => $quote -> category
);

// Checks if id is null or not
if($quote->id !== null) {
    print_r(json_encode($quote_arr));
}
else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}
?>