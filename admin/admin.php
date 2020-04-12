<?php 
    require_once '../load.php';

    confirm_logged_in()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome! <?php echo $_SESSION['username'];?></h2>

    <a href="admin_user.php">User Management </a><br>
    <a href="admin_content.php">Content Management </a><br>
    <a href="admin_member.php">Member Mangement</a><br>
    <a href="admin_logout.php"> Sign Out </a>
</body>
</html>