<?php

require_once '../load.php';

if(isset($_GET['allcontent'])){
    $content = getDetailContent();
    echo $content;
}
