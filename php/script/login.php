<?php

function register($name, $gender, $age, $email, $message,$date){
  
  $pdo = Database::getInstance()->getConnection();
  // check existance
  $check_exist_query = 'SELECT COUNT(*) FROM tbl_contact WHERE user_email = :email';
  $user_check = $pdo->prepare($check_exist_query);
  $user_check->execute(
      array(
          ':email' =>$email,
      )
      );

  if($user_check->fetchColumn() == 0){

      // User does exists
      $insert_user = 'INSERT INTO tbl_contact (user_name, user_gender, user_age, user_email, user_message, user_date)
                      VALUES (:name, :gender, :age, :email, :message, :date)';
      $insert_user_set = $pdo->prepare($insert_user);
      $insert_user_set ->execute(
          array(
              ':name'           =>  $name,
              ':gender'         =>  $gender,
              ':age'            =>  $age,
              ':email'          =>  $email,
              ':message'        =>  $message,
              ':date'           =>  $date 
          )
          );

          // echo "<script language=\"JavaScript\">alert(\"Welcome to follow us \");</script>";

          if(isset($email)){
              // mail_register($email);
              echo "Welcome to follow us";
          }

      }else{
          
              $update_query = 'UPDATE tbl_contact SET user_name = :name, user_gender = :gender, user_age = :age, user_message = :message, 
                                 user_date = user_date WHERE user_email = :email';
              $update_set = $pdo->prepare($update_query);
              $update_set->execute(
                  array(
                      ':name'           =>  $name,
                      ':gender'         =>  $gender,
                      ':age'            =>  $age,
                      ':message'        =>  $message,
                      ':email'          =>  $email
                  )
              );

              // echo "<script language=\"JavaScript\">alert(\"Thanks for you come back\");</script>";

              if(isset($email)){
                  // mail_register($email);
                  echo "Thanks for you come back";
              }            
            
      }
  }
      

