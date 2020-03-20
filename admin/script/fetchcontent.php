<?php

function getDetailContent(){
    $pdo = Database::getInstance()->getConnection();

    $get_detail_query  = 'SELECT * FROM tbl_detail';
    $get_detail_set    = $pdo->prepare($get_detail_query);
    $get_detail_result = $get_detail_set->execute();

    $detail = array();
    if($get_detail_result){
        while($detail = $get_detail_set->fetch(PDO::FETCH_ASSOC)){
            $currentdetail                 = array();
            $currentdetail['id']           = $detail['id'];
            $currentdetail['page']         = $detail['page'];
            $currentdetail['header_image'] = $detail['header_image'];
            $currentdetail['header']       = $detail['header'];
            $currentdetail['intro']        = $detail['intro'];
            $currentdetail['image']        = $detail['image'];
            $currentdetail['sub_image']    = $detail['sub_image'];
            $currentdetail['sub_intro']    = $detail['sub_intro'];

            $detail[] = $currentdetail;
        }
        return json_encode($detail);
    }else{
        return 'Error';
    }
}


function getContact(){
    $pdo = Database::getInstance()->getConnection();

    $get_contact = 'SELECT * FROM tbl_contact';
    $query_contact = $pdo->prepare($get_contact);
    $result_contact = $query_contact ->execute();

    $contacts = array();
    if($result_contact) {
        while($contact = $query_contact->fetch(PDO::FETCH_ASSOC)){
            $currentdetail                = array();
            $currentdetail['id']          = $contact['contact_id'];
            $currentdetail['title']       = $contact['contact_title'];
            $currentdetail['address']     = $contact['contact_address'];
            $currentdetail['phone']       = $contact['contact_phone'];
            $currentdetail['email']       = $contact['contact_email'];
            $currentdetail['website']     = $contact['contact_website'];
            $currentdetail['picture']     = $contact['contact_picture'];
            
            $contacts[] = $currentdetail;
        }
        return json_encode($contacts);
    }else{
        return 'Error';
    }
}

