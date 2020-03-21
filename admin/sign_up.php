<?php

require_once '../load.php';

// $name    = $_POST['name'];
// $gnder   = $_POST['gender'];
// $age     = $_POST['age'];
// $email   = $_POST['email'];
// $message = $_POST['message'];
// $date    = '1';

if(isset($_POST['name'])){
    register($name, $gender, $age, $email, $message,$date);
    echo 'succ';
}
      
