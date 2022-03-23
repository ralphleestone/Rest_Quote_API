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

$result = $quote->read();
$num = $result->rowCount();

if($num > 0) {
    $quote_arr = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $quote_item = array( 
            'id' => $id,
            'quote' => html_entity_decode($quote),
            'author' => $author,
            'category' => $category
        );
        array_push($quote_arr, $quote_item);
    }
    echo(json_encode($quote_arr));
} else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}
?>