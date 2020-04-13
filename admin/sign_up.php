<?php

require_once '../load.php';

if(isset($_GET["add_member"])) {
    $result =  register();
}

echo json_encode($result);
