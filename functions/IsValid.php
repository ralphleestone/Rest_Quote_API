<?php

// Includes required files
include_once '../../config/Database.php';
include_once '../../models/Quote.php';
include_once '../../models/Author.php';
include_once '../../models/Category.php';

// checks is value exists
function IsValid($id, $model) {
  
  // Sets model id
  $model->id = $id;
  
  // Result = return value of read_single
  $modelResult = $model->read_single();
  
  // Returns result
  return $modelResult;
}
?>