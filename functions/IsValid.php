<?php
include_once '../../config/Database.php';
include_once '../../models/Quote.php';
include_once '../../models/Author.php';
include_once '../../models/Category.php';

// checks is value exists
function IsValid($id, $model) {
    $model->id = $id;
    $result = $model->read_single();
    return $result;
  }
?>