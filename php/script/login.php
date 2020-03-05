<?php

function login($username, $password){

    $pdo = Database::getInstance()->getConnection();
    // check user existance
    $check_exist_query = 'SELECT COUNT(*) FROM tbl_admin WHERE username = :username';
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute(
        array(
            ':username' =>$username,
        )
        ); 

    
    if ($user_set->fetchColumn()>0){
        // If the password did not encrypt, using the method to check the username and password
        $get_user_query = 'SELECT * FROM tbl_admin WHERE username = :username';
        $get_user_query .= ' AND password = :password';
        $user_check = $pdo->prepare($get_user_query);
        $user_check->execute(
            array(
                ':username'=>$username,
                ':password'=>$password
            )
            );   

            while($found_user = $user_check->fetch(PDO::FETCH_ASSOC)){
                $id = $found_user['admin_id'];
                // logged in
                $_SESSION['admin_id'] = $id;
                $_SESSION['username'] = $found_user['username'];

            }
 

            if(isset($id)){
                $message = 'You just logged in !';
                // login to a welcome page
                redirect_to('admin.php');

            }else{      
                    
                $message ='wrong password!';
            }
  }else {
        $message ='User does not exist!';
    }

    return $message;  
     
}


function confirm_logged_in(){
    if(!isset($_SESSION['admin_id'])){
        redirect_to('admin_login.php');
    }
}

function logout(){
    session_destroy();
    redirect_to('admin_login.php');
}


