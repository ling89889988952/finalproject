<?php 
require_once '../load.php';
confirm_logged_in();

$tbl_hiv = 'tbl_hiv';
$getHiv = getAll($tbl_hiv);

if(!$getHiv){
    $message = 'Failed to get home information';
}

if(isset($_POST['submit'])){
   
    $hivinfo =  array(
        'header'         => trim($_POST['header']),
        'sub_header'     => trim($_POST['sub_header']),
        'introduce'      => trim($_POST['introduce']),
        'aid_introduce'  => trim($_POST['aid']),
    );

    $hivcover    = $_FILES['cover'];
    $aidcover    = $_FILES['cover2'];

    if($hivcover['error'] == 4){ 
       if($aidcover['error'] == 4){
        $message = editHivTest($hivinfo);
       }else{
            // change aid picture
        $change_file = $_FILES['cover2'];
        $message = editAidPicture($change_file,$hivinfo);
       }

    }else{
        $change_file  = $_FILES['cover'];
        if($aidcover['error'] == 4){
            $message = editHivPicture($change_file,$hivinfo);
        }else{
            $aid_file = $_FILES['cover2'];
            // change two picture
            $message = editHivPage($change_file,$aid_file,$hivinfo);
        }
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS - Edit HIV INTROUDCE</title>
</head>
<body>
<a href="admin_content.php">Back to Content Mangement </a><br>
    <h2 style="text-align:center">Edit HIV Introduce Info</h2>
    <?php echo!empty($message)? $message:'';?>
    <form action='admin_content_hiv.php' method='post' enctype="multipart/form-data">
    <?php while($hivinfo = $getHiv ->fetch(PDO::FETCH_ASSOC)):?>
        <label>Header</label><br>
        <textarea type='text' name='header'><?php echo $hivinfo['hiv_header'];?></textarea><br>

        <label>Sub_Header</label><br>
        <textarea type='text' name='sub_header'><?php echo $hivinfo['hiv_detail'];?></textarea><br>

        <label>HIV Introduce:</label><br>
        <textarea type='text' name='introduce'><?php echo $hivinfo['hiv_intro'];?></textarea><br>
        
        <img src="../images/<?php echo $hivinfo['hiv_picture'];?>" alt="hiv image" width="10%"><br>
        <label>Change HIV Image: </label>
        <input type="file" name="cover" value=""><br><br>

        <label>AID Introduce:</label><br>
        <textarea type='text' name='aid'><?php echo $hivinfo['aid_intro'];?></textarea><br>


        <img src="../images/<?php echo $hivinfo['aid_picture'];?>" alt="aid image" width="10%"><br>
        <label>Change AID Image: </label>
        <input type="file" name="cover2" value=""><br><br>

    <?php endwhile;?>
        <button type='submit' name='submit'>Update Information</button>
</body>
</html>