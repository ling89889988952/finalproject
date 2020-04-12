<?php

require_once '../load.php';

if(isset($_GET["add_member"])) {
    // $name    = $_POST['name'];
    // $gender  = $_POST['gender'];
    // $age     = $_POST['age'];
    // $email   = $_POST['email'];
    // $message = $_POST['message'];
    // $date    = '1';

    // $result =  register($name, $gender, $age, $email, $message,$date);
    $result =  register();

    
}

echo json_encode($result);
