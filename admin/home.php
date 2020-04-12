<?php
require_once '../load.php';

if(isset($_GET['page'])){
    $tbl ="tbl_" . trim($_GET['page']);

    $content = getAll($tbl);
    $results = $content->fetch(PDO::FETCH_ASSOC);

    echo json_encode($results);
}