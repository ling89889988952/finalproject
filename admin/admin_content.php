<?php 
    require_once '../load.php';

    confirm_logged_in();
    
    $args = array(
        'tbl'=>'tbl_content',
        'tbl2'=>'tbl_category',
        'tbl3'=>'tbl_content_category',
        'col'=>'main_id',
        'col2'=>'category_id',
    );
    $getContent= getAllbyCategory($args);
    if(!$getContent){
        $message = 'Failed to get the content';
    } 

    if(isset($_GET['id'])){
        $main_id = $_GET['id'];
        if($main_id){
            $delete_content = deleteContent($main_id);
            if(!$delete_content){
                $message ='Failed to delete Content';
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
    <title>cms - content edit</title>
</head>
<body>
    <a href="admin.php"> Back to admin</a><br>
    <a href="admin_content_home.php">Edit HomePage</a><br>
    <a href="admin_content_contact.php">Edit Contact Infomation</a><br>
    <a href="admin_content_detail.php">Edit Readmore Infomation</a><br>

    <h2 style="text-align:center">Content System</h2>
    <p style="text-align:center"><?php echo !empty($message)? $message:'';?></p>
    <table>
    <form action="admin_content.php" method="POST">
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
        <?php while($contents = $getContent->fetch(PDO::FETCH_ASSOC)):?>
            <tr>
            <td><?php echo $contents['main_id'];?></td>
            <td><?php echo $contents['title'];?></td>
            <td><?php echo $contents['intro'];?></td>
            <td><?php echo $contents['category_name'];?></td>
            <td><a href="admin_content_edit.php?id=<?php echo $contents['main_id'];?>">Update</a></td>
            <td><a href="admin_content.phps?id=<?php echo $contents['main_id'];?>">Delete</a></td>
            </tr>
        <?php endwhile;?>
        
        </tbody>
   </table>
   </form>

</body>
</html>