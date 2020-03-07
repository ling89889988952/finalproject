<?php

require_once '../load.php';
confirm_logged_in();


if(isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($username) || empty($password)){
        $message = 'Please fill the required field';
    }else{
        $message = createUser($username,$password);
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
        <label>UserName</label>
        <input type="text" name="username" value=""><br><br>
        <label>Password</label>
        <!-- input the password by the system and can not change -->
        <input type="text" name="password" value=""><br><br>
        <button name="submit">Create User</button>

    </form>
</body>
</html>