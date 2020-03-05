<?php
require_once '../load.php';

if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(!empty($username) && !empty($password)){
        $message = login($username, $password);
    }else{
        $message = 'Please fill out the required field';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login </title>
</head>
<body>
    <h1>Welcome</h1>
    <p>Please enter the username and password in the form below.</p>
    <?php echo !empty($message)?$message:''; ?>
    <form action="admin_login.php" method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="">

        <label for="password">Password</label>
        <input type="text" id="password" name="password" value="">

        <button name="submit">Log In</button>
    </form>
</body>
</html>