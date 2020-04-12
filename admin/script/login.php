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
        // vertify the regular password
        $get_user_query    = 'SELECT * FROM tbl_admin WHERE username = :username AND password = :password';
        $user_check        = $pdo->prepare($get_user_query);
        $user_check->execute(
            array(
                ':username'=>$username,
                ':password'=>$password
            )
            );  
        
        $found_user = $user_check->fetch(PDO::FETCH_ASSOC);  
        // regular password is true,login to edit and update the password_count =0
        if($found_user){
            $id = $found_user['admin_id'];
            $_SESSION['admin_id'] = $id;
            $_SESSION['username'] = $found_user['username'];

            $update_count  = 'UPDATE tbl_admin SET password_count = :password_count WHERE username = :username';
            $count_set     = $pdo->prepare($update_count);
            $count_set     ->execute(
                array(
                    ':password_count' =>  '0',
                    ':username'       =>$username,
                    )
                );

            if(isset($id)){
            redirect_to('admin_edituser.php');
            }

        }else{
             // vertify the hash password
            $query_password = 'SELECT * FROM tbl_admin WHERE username = :username';
            $password_get   = $pdo->prepare($query_password );
            $password_get->execute(
                    array(
                     ':username' => $username,
                    )
                    );   
            $query_user = $password_get->fetch(PDO::FETCH_ASSOC);
            $password_hash_result = $query_user['password'];
            $now_password_count = $query_user['password_count'];
            
            // hash password is true,login to edit/manage and update the password_count =0
            if(password_verify($password, $password_hash_result)){
                $message ='your password is right';
                $message               = "Your password is right";
                $admin_id              = $query_user ['admin_id'];
                $_SESSION['admin_id']  = $admin_id ;
                $_SESSION['username']  = $query_user['username'];
                $login_count           = $query_user['login_count'];

                $update_hash_count  = 'UPDATE tbl_admin SET password_count = :password_count WHERE username = :username';
                $update_hash_result = $pdo->prepare($update_hash_count);
                $update_hash_result ->execute(
                    array(
                        ':password_count' =>  '0',
                        ':username'       =>$username,
                        )
                    );

                if($login_count == '0'){
                    redirect_to('admin_editUser.php');
                }else{
                    redirect_to('admin.php');
                }
            }
            else{
                $message ='wrong password!';
                if($now_password_count <= 3){
                
                $update_password_count = 'UPDATE tbl_admin SET password_count = password_count+1 WHERE username = :username';
                $password_count_set    = $pdo->prepare($update_password_count );
                $password_count_set    ->execute(
                    array(
                        ':username'=>$username,
                        )
                    );
                }else{
                    die('Your Account has been locked');
                }

            }

        }
          
    }else {
    $message ='User does not exist!'; 
    }
    return $message;      
}


function confirm_logged_in(){
    if(!isset($_SESSION['admin_id'])){
        redirect_to('index.php');
    }
}

function logout(){
    session_destroy();
    redirect_to('index.php');
}


