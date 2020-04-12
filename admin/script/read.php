<?php

// get the detail, mainpage content
function getAllbyCategory($args){
    $pdo = Database::getInstance()->getConnection();

    $detailQuery = 'SELECT * FROM '.$args['tbl'].' AS t, '.$args['tbl2'].' AS t2, '.$args['tbl3']. ' AS t3 ';
    $detailQuery .= ' WHERE t.'.$args['col'].' = t3.'.$args['col'];
    $detailQuery .= ' AND t2.'.$args['col2'].' = t3.'.$args['col2'];

    $results = $pdo->query($detailQuery);

    if($results){
        return $results;
    }else{
        return ' There was some problems';
    }
}

// delete the detail content
function deleteDeatil($detail_id){
    $pdo = Database::getInstance()->getConnection();
    $delete = 'DELETE FROM tbl_detail WHERE detail_id = :detail_id';
    $deleteDetail = $pdo->prepare($delete);
    $delete_Detail_Result = $deleteDetail ->execute(
                        array(
                            ':detail_id' =>$detail_id,
                        )
                        );
        
        if($delete_Detail_Result && $deleteDetail->rowCount() > 0){
            $delete_category = 'DELETE FROM tbl_detail_category WHERE detail_id = :detail_id';
            $delete_category_set = $pdo->prepare($delete_category);
            $delete_category_result  = $delete_category_set -> execute(
                array(
                    ':detail_id' =>$detail_id,
                )
                );

                if($delete_category_result){

                redirect_to('admin_content_detail.php');
                }else{
                    return 'The category can not be delete';
                }
        }else{
            return ' ERROE';
        }
    
}

// add the detail content
function addDetail($detailinfo){
    try{
        $pdo = Database::getInstance()->getConnection();
        $cover           = $detailinfo['cover'];
        $cover2          = $detailinfo['cover2'];
        $cover3          = $detailinfo['cover3'];
        $upload_file     = pathinfo($cover['name']);
        $upload_file2    = pathinfo($cover2['name']);
        $upload_file3    = pathinfo($cover3['name']);
        $accepted_types  = array('gif', 'jpg', 'jpe', 'png', 'jpeg', 'webp');
        if ((!in_array($upload_file['extension'], $accepted_types)) && (!in_array($upload_file2['extension'], $accepted_types)) && (!in_array($upload_file3['extension'], $accepted_types))){
            throw new Exception('wrong file type!');
        }
    
        $image_path = '../images/';
    
        $generated_name      = md5($upload_file['filename'] . time());
        $generated_name2     = md5($upload_file2['filename'] . time());
        $generated_name3     = md5($upload_file3['filename'] . time());
        $generated_filename  = $generated_name . '.' . $upload_file['extension'];
        $generated_filename2 = $generated_name2 . '.' . $upload_file2['extension'];
        $generated_filename3 = $generated_name3 . '.' . $upload_file3['extension'];
        $targetpath          = $image_path . $generated_filename;
        $targetpath2         = $image_path . $generated_filename2;
        $targetpath3         = $image_path . $generated_filename3;
    
        if ( (!move_uploaded_file($cover['tmp_name'], $targetpath))){
            throw new Exception('Failed to move uploaded file, check permission!');
        }
        
        if (!move_uploaded_file($cover2['tmp_name'], $targetpath2)){
            throw new Exception('Failed to move uploaded file, check permission!');
        }
        if (!move_uploaded_file($cover3['tmp_name'], $targetpath3)){
            throw new Exception('Failed to move uploaded file, check permission!');
        }

        $insert_detail_query  = 'INSERT INTO  tbl_detail (header_image, header, intro, image, sub_image, sub_intro)';
        $insert_detail_query .= ' VALUE(:detail_cover, :detail_header, :detail_intro, :detail_cover2,:detail_cover3, :detail_supplement)';
    
        $insert_detail = $pdo->prepare($insert_detail_query);
        $insert_detail_result = $insert_detail ->execute(
            array(
                ':detail_cover'           => $generated_filename,
                ':detail_header'          => $detailinfo['header'],
                ':detail_intro'           => $detailinfo['introduce'],
                ':detail_cover2'          => $generated_filename2,
                ':detail_cover3'          => $generated_filename3,
                ':detail_supplement'      => $detailinfo['supplement'],
                )
            );
    
            $last_uploaded_id = $pdo->lastInsertId();
            if ($insert_detail_result && !empty($last_uploaded_id)) {
                $update_category_query = 'INSERT INTO tbl_detail_category(detail_id, category_id) VALUES(:detail_id, :category_id)';
                $update_category       = $pdo->prepare($update_category_query);
    
                $update_category_result = $update_category ->execute(
                    array(
                        ':detail_id'    => $last_uploaded_id,
                        ':category_id'  => $detailinfo['category'],
                        )
                    );   
            }

        redirect_to('admin_content_detail.php');
        
        }catch(Exception $e){
            $error = $e->getMessage();
            return $error;
        }
        
}
    
// show detail content in edit page
function showDetail($detail_id){
    $pdo = Database::getInstance()->getConnection();
    $querySingle = "SELECT * FROM tbl_detail p, tbl_category c, tbl_detail_category h WHERE p.detail_id = h.detail_id AND c.category_id = h.category_id AND p.detail_id = $detail_id";
    $get_detail_result = $pdo->query($querySingle);
    // var_dump($get_product_result);
    //  exit;            

    if($get_detail_result ){
        
        return $get_detail_result;
        

    }else{
        return  "There have some problem";
    
    }
}

// edit the content if the image do not change
function editDetail($detail_edit,$detail_id){
    $pdo = Database::getInstance()->getConnection();
    $update_detail_data   = 'UPDATE tbl_detail SET  header=:header, intro=:intro, sub_intro=:sub_intro  WHERE detail_id =:id';
    $update_detail_set    = $pdo->prepare($update_detail_data);
    $update_detail_result = $update_detail_set->execute(
                array(
                    ':header'        => $detail_edit['header'],
                    ':intro'         => $detail_edit['introduce'],
                    ':sub_intro'     => $detail_edit['supplement'],
                    ':id'            => $detail_id,
                    )
                );
    
                if($update_detail_result){

                    $update_category     = 'UPDATE tbl_detail_category SET category_id =:category WHERE detail_id =:id';
                    $update_category_set = $pdo->prepare($update_category);
        
                    $update_category_result = $update_category_set ->execute(
                        array(
                            'id'         => $detail_id,
                            ':category'  => $detail_edit['category'],
                            )
                        );   

                        if($update_category_result){
                            redirect_to('admin_content_detail.php');
                        }else{
                            return 'The category can not be update';
                        }
                }else{
                    return 'error';
                }

}

// edit the content if all images have been changed
function editDetailImage($image,$image2,$image3,$detail_edit,$detail_id){
    try{
        $pdo = Database::getInstance()->getConnection();
        $cover           = $image;
        $cover2          = $image2;
        $cover3          = $image3;
        $upload_file     = pathinfo($cover['name']);
        $upload_file2    = pathinfo($cover2['name']);
        $upload_file3    = pathinfo($cover3['name']);
        $accepted_types  = array('gif', 'jpg', 'jpe', 'png', 'jpeg', 'webp');
        if ((!in_array($upload_file['extension'], $accepted_types)) && (!in_array($upload_file2['extension'], $accepted_types)) && (!in_array($upload_file3['extension'], $accepted_types))){
            throw new Exception('wrong file type!');
        }
    
        $image_path = '../images/';
    
        $generated_name      = md5($upload_file['filename'] . time());
        $generated_name2     = md5($upload_file2['filename'] . time());
        $generated_name3     = md5($upload_file3['filename'] . time());
        $generated_filename  = $generated_name . '.' . $upload_file['extension'];
        $generated_filename2 = $generated_name2 . '.' . $upload_file2['extension'];
        $generated_filename3 = $generated_name3 . '.' . $upload_file3['extension'];
        $targetpath          = $image_path . $generated_filename;
        $targetpath2         = $image_path . $generated_filename2;
        $targetpath3         = $image_path . $generated_filename3;
    
        if (!move_uploaded_file($cover['tmp_name'], $targetpath)){
            throw new Exception('Failed to move uploaded file, check permission!');
        }

        if (!move_uploaded_file($cover2['tmp_name'], $targetpath2)){
            throw new Exception('Failed to move uploaded file, check permission!');
        }

        if (!move_uploaded_file($cover3['tmp_name'], $targetpath3)){
            throw new Exception('Failed to move uploaded file, check permission!');
        }


        $update_detail_content  = 'UPDATE tbl_detail SET header_image =:header_image, header=:header, intro=:intro, image=:image, sub_image=:sub_image, sub_intro=:sub_intro WHERE detail_id =:id';
        $update_content_set     = $pdo->prepare($update_detail_content);
        $update_content_result  = $update_content_set->execute(
            array(
                ':header_image'  => $generated_filename,
                ':header'        => $detail_edit['header'],
                ':intro'         => $detail_edit['introduce'],
                ':image'         => $generated_filename2,
                ':sub_image'     => $generated_filename3,
                ':sub_intro'     => $detail_edit['supplement'],
                ':id'            => $detail_id,
                )
            );

        if($update_content_result){
            $update_category     = 'UPDATE tbl_detail_category SET category_id =:category WHERE detail_id =:id';
            $update_category_set = $pdo->prepare($update_category);

            $update_category_result = $update_category_set ->execute(
                array(
                    'id'         => $detail_id,
                    ':category'  => $detail_edit['category'],
                    )
                );   

                if($update_category_result){
                    redirect_to('admin_content_detail.php');
                }else{
                    return 'Please choose the category';
                }
        }
        }catch(Exception $e){
            $error = $e->getMessage();
            return $error;
        }

}

// start Discrimination & HIV Prevention 
// add the content 
function addContent($contentinfo){
    try{
        $pdo = Database::getInstance()->getConnection();
        $cover           = $contentinfo['cover'];
        $upload_file     = pathinfo($cover['name']);
        $accepted_types  = array('gif', 'jpg', 'jpe', 'png', 'jpeg', 'webp');
        if ((!in_array($upload_file['extension'], $accepted_types))){
            throw new Exception('wrong file type!');
        }
    
        $image_path = '../images/';
    
        $generated_name      = md5($upload_file['filename'] . time());
        $generated_filename  = $generated_name . '.' . $upload_file['extension'];
        $targetpath          = $image_path . $generated_filename;
    
        if ( (!move_uploaded_file($cover['tmp_name'], $targetpath))){
            throw new Exception('Failed to move uploaded file, check permission!');
        }
    
    

        $insert_detail_query  = 'INSERT INTO  tbl_content (content_header, content_intro, content_picture)';
        $insert_detail_query .= ' VALUE(:content_header, :content_intro, :content_picture)';
    
        $insert_detail = $pdo->prepare($insert_detail_query);
        $insert_detail_result = $insert_detail ->execute(
            array(
                ':content_picture'         => $generated_filename,
                ':content_header'          => $contentinfo['header'],
                ':content_intro'           => $contentinfo['introduce'],
                )
            );
    
            $last_uploaded_id = $pdo->lastInsertId();
            if ($insert_detail_result && !empty($last_uploaded_id)) {
                $update_category_query = 'INSERT INTO tbl_content_category(content_id, category_id) VALUES(:content_id, :category_id)';
                $update_category       = $pdo->prepare($update_category_query);
    
                $update_category_result = $update_category ->execute(
                    array(
                        ':content_id'    => $last_uploaded_id,
                        ':category_id'   => $contentinfo['category'],
                        )
                    );   
            }

        redirect_to('admin_content_more.php');
        
        }catch(Exception $e){
            $error = $e->getMessage();
            return $error;
        }
}

// delete the  content 
function deleteContent($content_id){
    $pdo = Database::getInstance()->getConnection();
    $delete = 'DELETE FROM tbl_content WHERE content_id = :content_id';
    $deleteDetail = $pdo->prepare($delete);
    $delete_Detail_Result = $deleteDetail ->execute(
                        array(
                            ':content_id' =>$content_id,
                        )
                        );
        
        if($delete_Detail_Result && $deleteDetail->rowCount() > 0){
            $delete_category = 'DELETE FROM tbl_content_category WHERE content_id =:content_id';
            $delete_category_set = $pdo->prepare($delete_category);
            $delete_category_result  = $delete_category_set -> execute(
                array(
                    ':content_id' =>$content_id,
                )
                );

                if($delete_category_result){

                redirect_to('admin_content_more.php');
                }else{
                    return 'The category can not be delete';
                }
        }else{
            return ' ERROE';
        }
}

// show  content info
function showContent($content_id){
    $pdo = Database::getInstance()->getConnection();
    $querySingle = "SELECT * FROM tbl_content p, tbl_category c, tbl_content_category h WHERE p.content_id = h.content_id AND c.category_id = h.category_id AND p.content_id = $content_id";
    $get_detail_result = $pdo->query($querySingle);
            
    if($get_detail_result ){
        
        return $get_detail_result;
        

    }else{
        return  "There have some problem";
    
    }
}

// edit the content info -only text
function editContentText($content_image,$content_detail,$content_id){
    $pdo = Database::getInstance()->getConnection();
    $update_content_data  = 'UPDATE tbl_content SET content_picture =:cover, content_header=:title,content_intro=:intro WHERE content_id =:id';
    $update_content_set    = $pdo->prepare($update_content_data);
    $update_content_result =  $update_content_set->execute(
                array(
                    ':cover'         => $content_image,
                    ':title'         => $content_detail['header'],
                    ':intro'         => $content_detail['introduce'],
                    'id'             => $content_id,
                    )
                );
    
                if($update_content_result){

                    $update_category     = 'UPDATE tbl_content_category SET category_id =:category WHERE content_id =:id';
                    $update_category_set = $pdo->prepare($update_category);
        
                    $update_category_result = $update_category_set ->execute(
                        array(
                            'id'         => $content_id,
                            ':category'  => $content_detail['category'],
                            )
                        );   

                        if($update_category_result){
                            redirect_to('admin_content_more.php');
                        }else{
                            return 'The category can not be update';
                        }
                }else{
                    return 'error';
                }


}

// edit the content info - text & image

function editAllContent($content_image,$content_detail,$content_id){
    try{
        $pdo = Database::getInstance()->getConnection();
        $cover          = $content_image;
        $upload_file    = pathinfo($cover['name']);
        $accepted_types = array('gif', 'jpg', 'jpe', 'png', 'jpeg', 'webp');
        if (!in_array($upload_file['extension'], $accepted_types)) {
            throw new Exception('wrong file type!');
        }

        $image_path = '../images/';

        $generated_name     = md5($upload_file['filename'] . time());
        $generated_filename = $generated_name . '.' . $upload_file['extension'];
        $targetpath         = $image_path . $generated_filename;

        if (!move_uploaded_file($cover['tmp_name'], $targetpath)) {
            throw new Exception('Failed to move uploaded file, check permission!');
        }

        $update_product_detail  = 'UPDATE tbl_content SET content_picture =:cover, content_header=:title,content_intro=:intro WHERE content_id =:id';
        $update_product_set     = $pdo->prepare($update_product_detail);
        $update_product_result  = $update_product_set  ->execute(
            array(
                ':cover'         => $generated_filename,
                ':title'         => $content_detail['header'],
                ':intro'         => $content_detail['introduce'],
                'id'             => $content_id,
                )
            );

        if($update_product_result){
            $update_category     = 'UPDATE tbl_content_category SET category_id =:category WHERE content_id =:id';
            $update_category_set = $pdo->prepare($update_category);

            $update_category_result = $update_category_set ->execute(
                array(
                    'id'         => $content_id,
                    ':category'  => $content_detail['category'],
                    )
                );   

                if($update_category_result){
                    redirect_to('admin_content_more.php');
                }else{
                    return 'Please choose the category';
                }
        }
        }catch(Exception $e){
            $error = $e->getMessage();
            return $error;
        }
    
}


// start video function - show,add,edit and delete video 
// add video
function addVideo($video,$category){
    $pdo = Database::getInstance()->getConnection();
    $videofile      = $video;
    $upload_file    = pathinfo($videofile['name']);
    $accepted_types = array("mp4","avi","3gp","mov","mpeg");

    if (!in_array($upload_file['extension'], $accepted_types)) {
        echo "<script type='text/javascript'>alert('Wrong file type!');</script>";
        redirect_to('./admin_add_video.php');
        die();
    }

    $video_path = '../video/';

    $generated_name     = md5($upload_file['filename'] . time());
    $generated_filename = $generated_name . '.' . $upload_file['extension'];
    $targetpath         = $video_path . $generated_filename;

    if (!move_uploaded_file($videofile['tmp_name'], $targetpath)) {
        echo "<script type='text/javascript'>alert('Failed to move uploaded file!');</script>";
        redirect_to('./addproduct.php');
        die();
    }

    $insert_video = 'INSERT INTO tbl_video(video_source) VALUE (:video)';
    $insert_video_query = $pdo->prepare($insert_video);
    $insert_video_result = $insert_video_query ->execute(
        array(
            ':video'  => $generated_filename,
        )
    );

    $last_uploaded_id = $pdo->lastInsertId();

    if ($insert_video_result && !empty($last_uploaded_id)) {
        $update_category_query = 'INSERT INTO tbl_video_category(video_id, category_id) VALUES(:video_id, :category_id)';
        $update_category       = $pdo->prepare($update_category_query);
        $update_category_result = $update_category ->execute(
            array(
                ':video_id'     => $last_uploaded_id,
                ':category_id'  => $category,
                )
            );   

        if($update_category_result){
            redirect_to('admin_content_video.php');
        }else{
            return 'error';
        }

    }else{
        return 'wrong';
    }

}

// delete the video
function deleteVideo($video_id){
    $pdo = Database::getInstance()->getConnection();
    $delete = 'DELETE FROM tbl_video WHERE video_id = :video_id';
    $deleteVideo = $pdo->prepare($delete);
    $delete_Video_Result = $deleteVideo ->execute(
                        array(
                            ':video_id' => $video_id,
                        )
                        );
        
        if($delete_Video_Result && $deleteVideo->rowCount() > 0){
            $delete_category = 'DELETE FROM tbl_video_category WHERE video_id = :video_id';
            $delete_category_set = $pdo->prepare($delete_category);
            $delete_category_result  = $delete_category_set -> execute(
                array(
                    ':video_id' =>$video_id,
                )
                );

                if($delete_category_result){

                redirect_to('admin_content_video.php');

                }else{
                    return 'The category can not be delete';
                }
        }else{
            return ' ERROE';
        }
    
}

// show the video in order to edit
function showVideo($video_id){
    $pdo = Database::getInstance()->getConnection();
    $querySingle = "SELECT * FROM tbl_video p, tbl_category c, tbl_video_category h WHERE p.video_id = h.video_id AND c.category_id = h.category_id AND p.video_id = $video_id";
    $get_detail_result = $pdo->query($querySingle);
    // var_dump($get_product_result);
    //  exit;            

    if($get_detail_result ){
        
        return $get_detail_result;
        

    }else{
        return  "There have some problem";
    
    }
}

// edit the video's category
function editVideoCategory($category,$video_id){
    $pdo = Database::getInstance()->getConnection();
    $update_category     = 'UPDATE tbl_video_category SET category_id =:category WHERE video_id =:id';
    $update_category_set = $pdo->prepare($update_category);
    $update_category_result = $update_category_set ->execute(
         array(
            'id'         => $video_id,
            ':category'  => $category,
        )
    );   
    
    if($update_category_result){
         redirect_to('admin_content_video.php');
    }else{
        return 'The category can not be update';
    }
               
}

// edit the video 
function editVideo($video_file,$category,$video_id){
    $pdo = Database::getInstance()->getConnection();
    $videofile      = $video_file;
    $upload_file    = pathinfo($videofile['name']);
    $accepted_types = array("mp4","avi","3gp","mov","mpeg");

    if (!in_array($upload_file['extension'], $accepted_types)) {
        echo "<script type='text/javascript'>alert('Wrong file type!');</script>";
        redirect_to('./admin_add_video.php');
        die();
    }

    $video_path = '../video/';

    $generated_name     = md5($upload_file['filename'] . time());
    $generated_filename = $generated_name . '.' . $upload_file['extension'];
    $targetpath         = $video_path . $generated_filename;

    if (!move_uploaded_file($videofile['tmp_name'], $targetpath)) {
        echo "<script type='text/javascript'>alert('Failed to move uploaded file!');</script>";
        redirect_to('./addproduct.php');
        die();
    }

    $update_video_source  = 'UPDATE tbl_video SET video_source =:source WHERE video_id =:id';
    $update_video_set     = $pdo->prepare($update_video_source );
    $update_video_result  = $update_video_set ->execute(
        array(
            ':source'        => $generated_filename ,
            ':id'            => $video_id,
            )
        );

    if($update_video_result){
        $update_category     = 'UPDATE tbl_video_category SET category_id =:category WHERE video_id =:id';
        $update_category_set = $pdo->prepare($update_category);

        $update_category_result = $update_category_set ->execute(
            array(
                'id'         => $video_id,
                ':category'  => $category,
                )
            );   

            if($update_category_result){
                redirect_to('admin_content_video.php');
            }else{
                return 'Please choose the category';
            }

    }else{
        return 'error';
    }

}


// start home function 
//  edit the home page
function editHomePage($header,$sub,$introduce){
    $pdo = Database::getInstance()->getConnection(); 
    $update_home   = 'UPDATE tbl_home SET home_header =:header, home_subheader =:subheader, home_introduce =:introduce';
    $update_home_set    = $pdo->prepare($update_home);
    $update_home_result = $update_home_set  -> execute(
        array(
            ':header'       => $header,
            ':subheader'    => $sub ,
             ':introduce'   => $introduce,
            )
    );

    if($update_home_result){
        redirect_to('admin_content.php');
    }else{
        return ' ERROR';
    }
}

// start contact functuon 
//  edit the contact infomation 
function editContactPage($title,$address,$phone,$email,$website){
    $pdo = Database::getInstance()->getConnection(); 
    $update_contact   = 'UPDATE tbl_contact SET contact_title =:title, contact_address =:address, contact_phone =:phone, contact_email =:email, contact_website =:website';
    $update_contact_set    = $pdo->prepare($update_contact);
    $update_contact_result = $update_contact_set  -> execute(
        array(
            ':title'       => $title,
            ':address'     => $address,
            ':phone'       => $phone,
             ':email'      => $email,
             ':website'    =>$website
            )
    );

    if($update_contact_result){
        redirect_to('admin_content.php');
    }else{
        return ' ERROR';
    }

}

// start hiv functuon - edit the hiv infomation (four possibilities)
// 1. only change the text, no change the image
function editHivTest($hivinfo){
    $pdo = Database::getInstance()->getConnection(); 
    $update_text  = 'UPDATE tbl_hiv SET hiv_header =:header, hiv_detail =:detail, hiv_intro =:hiv, aid_intro=:aid';
    $update_text_set    = $pdo->prepare($update_text);
    $update_text_result = $update_text_set  -> execute(
        array(
            ':header'           => $hivinfo['header'],
            ':detail'           => $hivinfo['sub_header'],
            ':hiv'              => $hivinfo['introduce'],
            ':aid'              => $hivinfo['aid_introduce'],
        )
    );

    if($update_text_result){
        redirect_to('admin_content.php');
    }else{
        return ' ERROR';
    }
}

// 2.only change one picture - aid picture 
function editAidPicture($change_file,$hivinfo){
    try{
        $pdo = Database::getInstance()->getConnection();
        $cover          = $change_file;
        $upload_file    = pathinfo($cover['name']);
        $accepted_types = array('gif', 'jpg', 'jpe', 'png', 'jpeg', 'webp');
        if (!in_array($upload_file['extension'], $accepted_types)) {
            throw new Exception('wrong file type!');
        }

        $image_path = '../images/';

        $generated_name     = md5($upload_file['filename'] . time());
        $generated_filename = $generated_name . '.' . $upload_file['extension'];
        $targetpath         = $image_path . $generated_filename;

        if (!move_uploaded_file($cover['tmp_name'], $targetpath)) {
            throw new Exception('Failed to move uploaded file, check permission!');
        }

        $update_product_detail  = 'UPDATE tbl_hiv SET aid_picture =:cover,hiv_header =:header, hiv_detail =:detail, hiv_intro =:hiv, aid_intro=:aid';
        $update_product_set     = $pdo->prepare($update_product_detail);
        $update_product_result  = $update_product_set  ->execute(
            array(
                ':cover'         => $generated_filename ,
                ':header'           => $hivinfo['header'],
                ':detail'           => $hivinfo['sub_header'],
                ':hiv'              => $hivinfo['introduce'],
                ':aid'              => $hivinfo['aid_introduce'],

                )
            );

        if($update_product_result){
            redirect_to('admin_content.php');
            }else{
                    return 'error';
         }
        
        }catch(Exception $e){
            $error = $e->getMessage();
            return $error;
        }
}

// 3.only change one picture -  hiv picture
function editHivPicture($change_file,$hivinfo){
    try{
        $pdo = Database::getInstance()->getConnection();
        $cover          = $change_file;
        $upload_file    = pathinfo($cover['name']);
        $accepted_types = array('gif', 'jpg', 'jpe', 'png', 'jpeg', 'webp');
        if (!in_array($upload_file['extension'], $accepted_types)) {
            throw new Exception('wrong file type!');
        }

        $image_path = '../images/';

        $generated_name     = md5($upload_file['filename'] . time());
        $generated_filename = $generated_name . '.' . $upload_file['extension'];
        $targetpath         = $image_path . $generated_filename;

        if (!move_uploaded_file($cover['tmp_name'], $targetpath)) {
            throw new Exception('Failed to move uploaded file, check permission!');
        }

        $update_product_detail  = 'UPDATE tbl_hiv SET hiv_picture =:cover,hiv_header =:header, hiv_detail =:detail, hiv_intro =:hiv, aid_intro=:aid';
        $update_product_set     = $pdo->prepare($update_product_detail);
        $update_product_result  = $update_product_set  ->execute(
            array(
                ':cover'         => $generated_filename ,
                ':header'           => $hivinfo['header'],
                ':detail'           => $hivinfo['sub_header'],
                ':hiv'              => $hivinfo['introduce'],
                ':aid'              => $hivinfo['aid_introduce'],

                )
            );

        if($update_product_result){
            redirect_to('admin_content.php');
            }else{
                    return 'error';
         }
        
        }catch(Exception $e){
            $error = $e->getMessage();
            return $error;
        }
}

// 4.change two picture - aid and hiv picture 

function editHivPage($change_file,$aid_file,$hivinfo){
    try{
        $pdo = Database::getInstance()->getConnection();
        $cover          = $change_file;
        $cover2         = $aid_file;
        $upload_file    = pathinfo($cover['name']);
        $upload_file2    = pathinfo($cover2['name']);
        $accepted_types = array('gif', 'jpg', 'jpe', 'png', 'jpeg', 'webp');
        if ( (!in_array($upload_file['extension'], $accepted_types)) && (!in_array($upload_file2['extension'], $accepted_types)) ){
            throw new Exception('wrong file type!');
        }

        $image_path = '../images/';

        $generated_name       = md5($upload_file['filename'] . time());
        $generated_name2      = md5($upload_file2['filename'] . time());
        $generated_filename   = $generated_name . '.' . $upload_file['extension'];
        $generated_filename2  = $generated_name2 . '.' . $upload_file2['extension'];
        $targetpath           = $image_path . $generated_filename;
        $targetpath2          = $image_path . $generated_filename2;

        if (!move_uploaded_file($cover['tmp_name'], $targetpath)){
            throw new Exception('Failed to move uploaded file, check permission!');
        }

        if (!move_uploaded_file($cover2['tmp_name'], $targetpath2)){
            throw new Exception('Failed to move uploaded file, check permission!');
        }

        $update_product_detail  = 'UPDATE tbl_hiv SET hiv_picture =:cover,aid_picture =:cover2,hiv_header =:header, hiv_detail =:detail, hiv_intro =:hiv, aid_intro=:aid';
        $update_product_set     = $pdo->prepare($update_product_detail);
        $update_product_result  = $update_product_set  ->execute(
            array(
                ':cover'            => $generated_filename,
                ':cover2'           => $generated_filename2,
                ':header'           => $hivinfo['header'],
                ':detail'           => $hivinfo['sub_header'],
                ':hiv'              => $hivinfo['introduce'],
                ':aid'              => $hivinfo['aid_introduce'],

                )
            );

        if($update_product_result){
            redirect_to('admin_content.php');
            }else{
                    return 'error';
         }
        
        }catch(Exception $e){
            $error = $e->getMessage();
            return $error;
        }
}