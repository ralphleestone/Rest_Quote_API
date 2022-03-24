<?php
if ((isset($data->quote)) && (isset($data->categoryId)) && (isset($data->authorId))) {
    
    if (!isValid($data->authorId, $author)) {
        echo json_encode(array('message' => 'authorId Not Found'));
    exit();

}else if (!isValid($data->categoryId, $category)) {
    echo json_encode(array('message' => 'categoryId Not Found'));
    exit();

}else if (!isValid($data->id, $quote)) {
    echo json_encode(array('message' => 'No Quotes Found'));
    exit();

}else if($quote->create()){
    echo json_encode(array('message' => 'created quote (' . ($data->id) . ', ' . ($data->quote) . ', ' . ($data->authorId) . ', ' .($data->categoryId) . ')'));
}
 else{echo json_encode(array('message' => 'Missing Required Parameters'));
    exit();
}
}