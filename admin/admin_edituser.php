<?php 
require_once '../load.php';
confirm_logged_in();

$id     = $_SESSION['admin_id'];
$user   = getUserData($id);

if(is_string($user)){
    $message = $user;
}

date_default_timezone_set("America/Toronto");
$login_date = date("Y-m-d H:i:s");

if(isset($_POST['submit'])){
    $username   = trim($_POST['username']);
    $password   = trim($_POST['password']);
    $email      = trim($_POST['email']);

    $message    = editUser($id,$username,$password,$email,$login_date);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <?php echo!empty($message)? $message:'';?>
    <form action='admin_edituser.php' method='post'>
    <?php while($info = $user->fetch(PDO::FETCH_ASSOC)):?>
        <label>Username:<label>
        <input type='text' name='username' value='<?php echo $info['username'];?>'><br>

        <label>Password:<label>
        <input type='text' name='password' value='<?php echo $info['password'];?>'><br>

        <label>Email:<label>
        <input type='text' name='email' value='<?php echo $info['email'];?>'><br>
    <?php endwhile;?>
        <button type='submit' name='submit'>Edit Account</button>
</body>
</html>