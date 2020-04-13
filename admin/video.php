<?php
require_once '../load.php';


if (isset($_GET['filter'])) {
$args = array(
    'tbl1'=>'tbl_video',
    'tbl2'=>'tbl_category',
    'tbl3'=>'tbl_video_category',
    'col'=>'video_id',
    'col2'=>'category_id',
    'col3'=>'category_name',
    'filter'=>$_GET['filter']
);
$results = getVideoByFilter($args);
echo json_encode($results);
}
