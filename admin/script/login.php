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
                redirect_to('admin_edituser.php');

            }else{      
                
                $query_password = 'SELECT * FROM tbl_admin WHERE username = :username';
                $password_get= $pdo->prepare($query_password );
                $password_get->execute(
                array(
                 ':username'=>$username,
                )
                );   
                
                $user_arry = $password_get->fetch(PDO::FETCH_ASSOC);
                $count = $user_arry['login_count'];
               
                if($count == 1){
                    $login_time = $user_arry['login_time'];

                    // get the now time
                    date_default_timezone_set("America/Toronto");
                    $now_date = date("Y-m-d H:i:s");
                    // change the now time to strtotime and set the last time = after 12 hour
                    $now = strtotime($now_date);

                    $last = strtotime("$login_time + 12 hours");
                    
                    // compare the now time data <  the data of (late time + 12hours)
                    if($now > $last){
                        $message = 'Your account has been suspended.';
                        session_destroy();
                    }else{
                        $password_hash = $user_arry['password'];
                        // verify the password(post) and the user_password(from database)
                    if(password_verify($password, $password_hash)){
                        $message = "Your password is right";
                        $user_id = $user_arry['admin_id'];
                        $_SESSION['admin_id'] = $user_id ;
                        $_SESSION['username'] = $user_arry['username'];

                    redirect_to('admin.php');
                        }else{
                    $message ='wrong password!';
                }
            }
        }else{
               $password_hash = $user_arry['password'];
                // verify the password(post) and the user_password(from database)
                if(password_verify($password, $password_hash)){
                $message = "Your password is right";
                $user_id = $user_arry['admin_id'];
                $_SESSION['admin_id'] = $user_id ;
                $_SESSION['username'] = $user_arry['username'];
                redirect_to('admin.php');
                }else{     
                $message ='wrong password!';
                }
            }           
                
            }
  }else {
        $message ='User does not exist!'; }

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


