<?php

function mail_to($username,$password,$email){
    $to = $email;
    $subject = 'Admin Information';
    $url = 'http://localhost/finalproject/admin/admin_login.php';
    $message = 'Hi, Your username is ' .$username. ' and password is ' .$password. ', Please login in your account to change your username and password. The login link is ' .$url. '';
    $headers = "From: noreply@HIV/Aids.com" ;

    mail($to,$subject,$message,$headers);
}