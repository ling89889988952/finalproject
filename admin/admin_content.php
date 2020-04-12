<?php 
    require_once '../load.php';

    confirm_logged_in();
    

    $content_table ='tbl_content';
    $getContent = getAll($content_table);

    

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
    <a href="admin.php"> Back to admin</a><br>
    <a href="admin_content_contact.php">Edit Contact Infomation</a><br>
    <a href="admin_content_detail.php">Edit Readmore Infomation</a><br>

    <h2 style="text-align:center">Content System</h2>
    <p style="text-align:center"><?php echo !empty($message)? $message:'';?></p>
    <table>
    <form action="admin_user.php" method="POST">
        <thead>
            <tr>
                <th>Id</th>
                <th>title</th>
                <th>introduce</th>
                <th>category</th>
                <th>Edit</th>
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