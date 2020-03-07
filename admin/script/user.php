<?php
function createUser($username,$password){

    $pdo = Database::getInstance()->getConnection();  
    // check the $username whether exist or not in database
    $check_user_exist = 'SELECT * FROM tbl_admin WHERE username = :username';
    $check_exist = $pdo->prepare($check_user_exist);
    $check_exist->execute(
        array(
            ':username' =>$username,
        )
        ); 
    $row = $check_exist->fetch(PDO::FETCH_ASSOC);

    // The $username do not exist
    if (!$row){
    // encrypted the password, based on the post password
        $create_user_query  = 'INSERT INTO tbl_admin (username, password)';
        $create_user_query .= ' VALUES(:username, :password)';
        $create_user_set   = $pdo->prepare($create_user_query);
        $create_user_result = $create_user_set ->execute(
            array(
                ':username'   =>  $username,
                ':password'   =>  $password
            )
            );


        if($create_user_result){
            // sent the mail to the user and redirect to the admin_login page
            $message= 'Your account has been successfully created';
            redirect_to('admin.php');

        } else{
            return 'error!';
        }
    
}else{
    
    $message= 'The username is exist, please change your username';
}
return $message;
}