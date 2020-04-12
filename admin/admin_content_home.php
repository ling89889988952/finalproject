<?php 
require_once '../load.php';
confirm_logged_in();

$tbl_home = 'tbl_home';
$getHome = getAll($tbl_home);

if(!$getHome ){
    $message = 'Failed to get home information';
}

if(isset($_POST['submit'])){
    $username   = trim($_POST['username']);
    $password   = trim($_POST['password']);
    $email      = trim($_POST['email']);
    $message    = editUser($id,$username,$password,$email);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>CMS - Edit Home</title>
</head>
<body>
<a href="admin_content.php">Back to Content Mangement </a><br>
    <h2 style="text-align:center">Edit Home Information</h2>
    <?php echo!empty($message)? $message:'';?>
    <form action='admin_content_home.php' method='post'>
    <?php while($homeinfo = $getHome ->fetch(PDO::FETCH_ASSOC)):?>
        <label>Header</label><br>
        <input  type='text' name='header' value='<?php echo $homeinfo['home_header'];?>'><br>

        <label>Sub_Header</label><br>
        <input  type='text' name='sub_header' value='<?php echo $homeinfo['home_subheader'];?>'><br>

        <label>Introduce:</label><br>
        <textarea type='text' name='introduce'><?php echo $homeinfo['home_introduce'];?></textarea><br>


    <?php endwhile;?>
    <button type='submit' name='submit'>Update Information</button>
        
</body>
</html>