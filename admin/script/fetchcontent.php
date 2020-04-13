<?php

function getDetailContent(){
    $pdo = Database::getInstance()->getConnection();

    $get_detail_query  = 'SELECT * FROM tbl_detail';
    $get_detail_set    = $pdo->prepare($get_detail_query);
    $get_detail_result = $get_detail_set->execute();

    $details = array();
    if($get_detail_result){
        while($detail = $get_detail_set->fetch(PDO::FETCH_ASSOC)){
            $currentdetail                 = array();
            $currentdetail['id']           = $detail['id'];
            $currentdetail['header_image'] = $detail['header_image'];
            $currentdetail['header']       = $detail['header'];
            $currentdetail['intro']        = $detail['intro'];
            $currentdetail['image']        = $detail['image'];
            $currentdetail['sub_image']    = $detail['sub_image'];
            $currentdetail['sub_intro']    = $detail['sub_intro'];

            $details[] = $currentdetail;
        }
        return json_encode($details);
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

function getAll($tbl){
    $pdo = Database::getInstance()->getConnection();
    $queryAll = ' SELECT * FROM '.$tbl;
    $results = $pdo->query($queryAll);

    if($results){
        return $results;
    }else{
        return 'There was a problem accessing this info';
    }

}


function getVideoByFilter($args){
    $pdo = Database::getInstance()->getConnection();

    $filterQuery = 'SELECT * FROM '.$args['tbl1'].' AS t, '.$args['tbl2'].' AS t2, '.$args['tbl3']. ' AS t3 ';
    $filterQuery .= ' WHERE t.'.$args['col'].' = t3.'.$args['col'];
    $filterQuery .= ' AND t2.'.$args['col2'].' = t3.'.$args['col2'];
    $filterQuery .= ' AND t2.'.$args['col3'].' = "'.$args['filter'].'"';

    $results = $pdo->query($filterQuery);

    if($results){
        return $results->fetchALL(PDO::FETCH_ASSOC);
    }else{
        return ' There was some problems';
    }

}


function getContentByFilte($args){
    $pdo = Database::getInstance()->getConnection();

    $filterQuery = 'SELECT * FROM '.$args['tbl1'].' AS t, '.$args['tbl2'].' AS t2, '.$args['tbl3']. ' AS t3 ';
    $filterQuery .= ' WHERE t.'.$args['col'].' = t3.'.$args['col'];
    $filterQuery .= ' AND t2.'.$args['col2'].' = t3.'.$args['col2'];
    $filterQuery .= ' AND t2.'.$args['col3'].' = "'.$args['filter'].'"';

    $results = $pdo->query($filterQuery);

    if($results){
        return $results->fetchALL(PDO::FETCH_ASSOC);
    }else{
        return ' There was some problems';
    }
}