<?php 
    require_once '../load.php';

    confirm_logged_in();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/main.css">
    <title>cms - content edit</title>
</head>
<body>
    <h2 style="text-align:center">Content System</h2><br>
    <h3>Welcome! <?php echo $_SESSION['username'];?>, Please select the corresponding area to edit and manage.</h3>

    <a href="admin_content_home.php">Edit HomePage</a><br>
    <a href="admin_content_contact.php">Edit Contact Infomation</a><br>
    <a href="admin_content_hiv.php">Edit HIV Introduce</a><br>
    <a href="admin_content_video.php">Manage Video</a><br>
    <a href="admin_content_more.php">Manage Discrimination & HIV Prevention</a><br>
    <a href="admin_content_detail.php">Manage Readmore Infomation</a><br>
    <a href="admin.php"> Back to admin</a><br>


</body>
</html>