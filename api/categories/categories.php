<?php

// Sets headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Includes required files
include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Creates database object
$database = new Database();
$db = $database->connect();

// Creates category object
$category = new Category($db);

$result = $category->read();

// Gets row count
$num = $result->rowCount();

if($num > 0) {
    $category_arr = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $category_item = array( 
            'id' => $id,
            'category' => $category   
        );
        array_push($category_arr, $category_item);
    }
    print_r(json_encode($category_arr));
} else {
    echo json_encode(
        array('message' => 'No categories found')
    );
}
?>