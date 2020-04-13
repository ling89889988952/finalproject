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
      $insert_user = 'INSERT INTO tbl_member (user_name, user_gender, user_age, user_email, user_message)
                      VALUES (:name, :gender, :age, :email, :message)';
      $insert_user_set = $pdo->prepare($insert_user);
      $inset_result = $insert_user_set ->execute(
          array(
              ':name'           =>  $_POST['name'],
              ':gender'         =>  $_POST['gender'],
              ':age'            =>  $_POST['age'],
              ':email'          =>  $_POST['email'],
              ':message'        =>  $_POST['message'],
          )
          );

          if($inset_result){
              return array('result' => $inset_result);
              echo "Welcome to follow us";
          }

      }else{
          
              $update_query = 'UPDATE tbl_member SET user_name = :name, user_gender = :gender, user_age = :age, user_message = :message, 
                                 user_date = user_date WHERE user_email = :email';
              $update_set = $pdo->prepare($update_query);
              $update_result = $update_set->execute(
                  array(
                    ':name'           =>  $_POST['name'],
                    ':gender'         =>  $_POST['gender'],
                    ':age'            =>  $_POST['age'],
                    ':email'          =>  $_POST['email'],
                    ':message'        =>  $_POST['message'],
                  )
              );

              if($update_result){
                return array('result' => $update_result);
                  echo "Thanks for you come back";
              }            
            
      }
  }
      

