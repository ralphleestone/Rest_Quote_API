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

$category->id = isset($_GET['id']) ? $_GET['id'] : die();

$category->read_single();

// Creates array
$category_arr = array (
    'id' => $category->id,
    'category' => $category->category
);

// Checks if category id is null
if($category->id !== null) {
    // Converts to json and prints
    echo (json_encode($category_arr));
    } 
    else {
        echo json_encode(
            array('message' => 'categoryId Not Found')
        );
    }
?> 