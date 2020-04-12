<?php 
require_once '../load.php';
confirm_logged_in();

$tbl_hiv = 'tbl_hiv';
$getHiv = getAll($tbl_hiv);

if(!$getHiv ){
    $message = 'Failed to get home information';
}

// if(isset($_POST['submit'])){
//     $username   = trim($_POST['username']);
//     $password   = trim($_POST['password']);
//     $email      = trim($_POST['email']);
//     $message    = editUser($id,$username,$password,$email);
// }

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
    <form action='admin_content_home.php' method='post'>
    <?php while($hivinfo = $getHiv ->fetch(PDO::FETCH_ASSOC)):?>
        <label>Header</label><br>
        <input  type='text' name='header' value='<?php echo $hivinfo['hiv_header'];?>'><br>

        <label>Sub_Header</label><br>
        <input  type='text' name='sub_header' value='<?php echo $hivinfo['hiv_detail'];?>'><br>

        <label>HIV Introduce:</label><br>
        <textarea type='text' name='introduce'><?php echo $hivinfo['hiv_introduce'];?></textarea><br>

        <img src="../images/<?php echo $hivinfo['hiv_picture'];?>" alt="hiv image" width="10%"><br>
        <label>Change HIV Image: </label>
        <input type="file" name="cover" value=""><br><br>

         <label>AID Introduce:</label><br>
        <textarea type='text' name='aid'><?php echo $hivinfo['aid_intro'];?></textarea><br>

        <img src="../images/<?php echo $hivinfo['aid_picture'];?>" alt="aid image" width="10%"><br>
        <label>Change AID Image: </label>
        <input type="file" name="cover2" value=""><br><br>


        <label>Video</label><br>
        <div>
        <video src="../video/<?php echo $hivinfo['aid_video'];?> " controls width='320px' height='200px'>
        </div>
        <br>
    <?php endwhile;?>
        <button type='submit' name='submit'>Update Information</button>
</body>
</html>