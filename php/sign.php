<?php

require_once '../load.php';

date_default_timezone_set("America/Toronto");
$date = date("Y-m-d H:i:s");


if(isset($_POST['submit'])) {
    $name      = $_POST['name'];
    $gender    = $_POST['gender'];
    $age       = $_POST['age'];
    $email     = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
    $message   = $_POST['message'];
    

    if(!empty($name) && !empty($gender) && !empty($age) && !empty($email)){
        // logo user in
        register($name, $gender, $age, $email, $message,$date);
    }else{
        echo 'Please fill out the field';
    }
}


