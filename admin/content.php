<?php
require_once '../load.php';


if (isset($_GET['filter'])) {
$args = array(
    'tbl1'=>'tbl_content',
    'tbl2'=>'tbl_category',
    'tbl3'=>'tbl_content_category',
    'col'=>'content_id',
    'col2'=>'category_id',
    'col3'=>'category_name',
    'filter'=>$_GET['filter']
);
$results = getContentByFilter($args);
echo json_encode($results);
}
