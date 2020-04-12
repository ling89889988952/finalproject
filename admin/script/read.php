<?php

// get the detail content
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
    
        if ( (!move_uploaded_file($cover['tmp_name'], $targetpath)) && (!move_uploaded_file($cover2['tmp_name'], $targetpath2)) && (!move_uploaded_file($cover3['tmp_name'], $targetpath3)) ){
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
function editDetail($detail_image,$detail_image2,$detail_image3,$detail_edit,$detail_id){
    $pdo = Database::getInstance()->getConnection();
    $update_detail_data   = 'UPDATE tbl_detail SET header_image =:header_image, header=:header, intro=:intro, image=:image, sub_image=:sub_image, sub_intro=:sub_intro WHERE detail_id=:id';
    $update_detail_set    = $pdo->prepare($update_detail_data);
    $update_detail_result = $update_detail_set->execute(
                array(
                    ':header_image'  => $detail_image,
                    ':image'         => $detail_image2,
                    '::sub_image'    => $detail_image3,
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
    
        if ( (!move_uploaded_file($cover['tmp_name'], $targetpath)) && (!move_uploaded_file($cover2['tmp_name'], $targetpath2)) && (!move_uploaded_file($cover3['tmp_name'], $targetpath3)) ){
            throw new Exception('Failed to move uploaded file, check permission!');
        }

        $update_detail_content  = 'UPDATE tbl_detail SET header_image =:header_image, header=:header, intro=:intro, image=:image, sub_image=:sub_image, sub_intro=:sub_intro WHERE detail_id =:id';
        $update_content_set     = $pdo->prepare($update_detail_content);
        $update_content_result  = $update_content_set->execute(
            array(
                ':header_image'  => $generated_filename,
                ':image'         => $generated_filename2,
                '::sub_image'    => $generated_filename3,
                ':header'        => $detail_edit['header'],
                ':intro'         => $detail_edit['introduce'],
                ':sub_intro'     => $detail_edit['supplement'],
                ':id'             => $detail_id,
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