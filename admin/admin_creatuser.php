<?php

require_once '../load.php';
confirm_logged_in();

function systemPassword( $length = 8) {
    $password = substr(md5(time()), 0 , $length);
    return $password;
}

date_default_timezone_set("America/Toronto");
$create_date = date("Y-m-d H:i:s");


if(isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email    = trim($_POST['email']);

    if(empty($username) || empty($password) || empty($email)){
        $message = 'Please fill the required field';
    }else{
        $message = createUser($username,$password,$email,$create_date);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h2>Create User</h2>
    <?php echo !empty($message)?$message:''; ?>
    <form action="admin_creatuser.php" method="post">
        <label>Username</label>
        <input type="text" name="username" value=""><br><br>

        <label>Password</label>
        <input type="text" name="password" readonly value="<?php echo systemPassword(8);?>"><br><br>

        <label>Email</label>
        <!-- input the password by the system and can not change -->
        <input type="text" name="email" value=""><br><br>

        <button name="submit">Create User</button>

    </form>
</body>
</html>