<?php
function createUser($username,$password,$email,$create_date){
    
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
        $create_user_query  = 'INSERT INTO tbl_admin (username, password, email,login_count, login_time)';
        $create_user_query .= ' VALUES(:username, :password, :email, :login_count,:login_time)';
        $create_user_set    = $pdo->prepare($create_user_query);
        $create_user_result = $create_user_set ->execute(
            array(
                ':username'      =>  $username,
                ':password'      =>  $password,
                ':email'         =>  $email,
                ':login_count'   =>  '0',
                ':login_time'    =>  $create_date,
            )
            );


        if($create_user_result){
            // sent the mail to the user and redirect to the admin_login page
            $message= 'Your account has been successfully created';
            mail_to($username,$password,$email);
            redirect_to('admin.php');

        } else{
            return 'error!';
        }
    
}else{
    
    $message= 'The username is exist, please change your username';
}
return $message;
}


function getUserData($id){
    $pdo = Database::getInstance()->getConnection(); 
    $find_user_data  = 'SELECT * FROM tbl_admin WHERE admin_id=:id';
    $query_user_data = $pdo->prepare($find_user_data);
    $user_result = $query_user_data ->execute(
                    array(
                        ':id' =>$id,
                    )
                    );

        if($user_result){
            return($query_user_data);
        }else{
            return'There havs some problem';
        }

}

function editUser($id,$username,$password,$email,$login_date){
    $pdo = Database::getInstance()->getConnection(); 
    $hash_password      = password_hash($password, PASSWORD_DEFAULT);
    $update_user_date   = 'UPDATE tbl_admin SET username =:username,  password =:password, email =:email, login_count = login_count+1, login_time =:logintime WHERE admin_id=:id';
    $update_user_set    = $pdo->prepare($update_user_date);
    $update_user_result = $update_user_set  -> execute(
                            array(
                                ':username'   => $username,
                                ':password'   => $hash_password ,
                                ':email'      => $email,
                                ':logintime'  => $login_date,
                                ':id'         => $id

                            )
                            );

    if($update_user_result){
        redirect_to('admin_logout.php');
    }else{
        return ' ERROR';
    }

}