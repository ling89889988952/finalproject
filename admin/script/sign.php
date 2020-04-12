<?php

function register(){
  
  $pdo = Database::getInstance()->getConnection();
  // check existance
  $check_exist_query = 'SELECT COUNT(*) FROM tbl_member WHERE user_email = :email';
  $user_check = $pdo->prepare($check_exist_query);
  $user_check->execute(
      array(
          ':email' =>$_POST['email'],
      )
      );

  if($user_check->fetchColumn() == 0){

      // User does exists
      $insert_user = 'INSERT INTO tbl_member (user_name, user_gender, user_age, user_email, user_message, user_date)
                      VALUES (:name, :gender, :age, :email, :message, :date)';
      $insert_user_set = $pdo->prepare($insert_user);
      $insert_user_set ->execute(
          array(
              ':name'           =>  $_POST['name'],
              ':gender'         =>  $_POST['gender'],
              ':age'            =>  $_POST['age'],
              ':email'          =>  $_POST['email'],
              ':message'        =>  $_POST['message'],
              ':date'           =>  '1'
          )
          );

          if(isset($email)){
              // mail_register($email);
              echo "Welcome to follow us";
          }

      }else{
          
              $update_query = 'UPDATE tbl_member SET user_name = :name, user_gender = :gender, user_age = :age, user_message = :message, 
                                 user_date = user_date WHERE user_email = :email';
              $update_set = $pdo->prepare($update_query);
              $update_set->execute(
                  array(
                    ':name'           =>  $_POST['name'],
                    ':gender'         =>  $_POST['gender'],
                    ':age'            =>  $_POST['age'],
                    ':email'          =>  $_POST['email'],
                    ':message'        =>  $_POST['message'],
                  )
              );

              if(isset($email)){
                  // mail_register($email);
                  echo "Thanks for you come back";
              }            
            
      }
  }
      

