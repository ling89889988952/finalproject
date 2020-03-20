<?php

require_once '../load.php';

if(isset($_GET['contact'])){
    $contacts= getContact();
    echo $contacts;
}