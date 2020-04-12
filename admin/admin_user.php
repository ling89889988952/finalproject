<?php 
    require_once '../load.php';

    confirm_logged_in();
    $id   = $_SESSION['admin_id'];

    $user_table ='tbl_admin';
    $getUser = getAll($user_table);

    if(!$getUser){
        $message = 'Failed to get user list';
    }

    // Delete User
    if(isset($_GET['id'])){
        $admin_id = $_GET['id'];

        if( $admin_id != $id){
            $delete_result= deleteUser($admin_id);

            if(!$delete_result){
                $message ='Failed to delete user';
            }
        }else{
        $message = 'You can not delete';
        }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/main.css">
    <title>Welcome</title>
</head>
<body>
    <a href="admin.php"> Back to admin</a><br>
    <a href="admin_creatuser.php"> Create User </a><br>
    <a href="admin_edituser.php">Edit User</a><br>

    <h2 style="text-align:center">Welcome! <?php echo $_SESSION['username'];?></h2>
    <p style="text-align:center"><?php echo !empty($message)? $message:'';?></p>
    <table>
    <form action="admin_user.php" method="POST">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
        <?php while($users = $getUser->fetch(PDO::FETCH_ASSOC)):?>
            <tr>
            <td><?php echo $users['admin_id'];?></td>
            <td><?php echo $users['username'];?></td>
            <td><?php echo $users['email'];?></td>
            <td><a href="admin_user.php?id=<?php echo $users['admin_id'];?>">Delete</a></td>
            </tr>
        <?php endwhile;?>
        
        </tbody>
   </table>
   </form>

</body>
</html>