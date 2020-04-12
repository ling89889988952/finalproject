<?php

require_once '../load.php';

    confirm_logged_in();

$args = array(
        'tbl'=>'tbl_content',
        'tbl2'=>'tbl_category',
        'tbl3'=>'tbl_content_category',
        'col'=>'content_id',
        'col2'=>'category_id',
    );
    $getContent= getAllbyCategory($args);
    if(!$getContent){
        $message = 'Failed to get the content';
    } 

    if(isset($_GET['id'])){
        $content_id = $_GET['id'];
        if($content_id){
            $delete_content = deleteContent($content_id);
           
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
    <title>Document</title>
</head>
<body>
<a href="admin_content.php">Back to Content Mangement </a><br>

<h2 style="text-align:center">Discrimination & HIV Prevention</h2>
    <div style="text-align:center"><a href="admin_content_add.php">Add New Content</a></div>
    <p style="text-align:center"><?php echo !empty($message)? $message:'';?></p>
    <table>
    <form action="admin_content_more.php" method="POST">
        <thead>
            <tr>
                <th>Id</th>
                <th>Header</th>
                <th>introduce</th>
                <th>Picture</th>
                <th>Category</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
        <?php while($contents = $getContent->fetch(PDO::FETCH_ASSOC)):?>
            <tr>
            <td><?php echo $contents['content_id'];?></td>
            <td><?php echo $contents['content_header'];?></td>
            <td><?php echo $contents['content_intro'];?></td>
            <td><img src="../images/<?php echo $contents['content_picture'];?>"alt="header image" width="100%"></td>
            <td><?php echo $contents['category_name'];?></td>
            <td><a href="admin_content_edit.php?id=<?php echo $contents['content_id'];?>">Update</a></td>
            <td><a href="admin_content_more.php?id=<?php echo $contents['content_id'];?>">Delete</a></td>
            </tr>
        <?php endwhile;?>
        
        </tbody>
   </table>
   </form>
</body>
</html>