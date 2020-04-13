<?php

require_once '../load.php';

confirm_logged_in();

$category_table = 'tbl_category';
$getCategory = getAll($category_table);


$show_content = showContent($_GET['id']);
$contentinfo = $show_content->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){
    $image  = $_FILES['cover'];

    $content_detail =  array(
        'header'       => trim($_POST['header']),
        'introduce'    => trim($_POST['introduce']),
        'category'     => trim($_POST['cateList']),
    );
    
    $content_id = $_GET['id'];

    if($image['error'] == 4){
        $content_image = $contentinfo['content_picture'];
        $result  = editContentText($content_image,$content_detail,$content_id);

    }else{
        $content_image = $_FILES['cover'];
        $result  = editAllContent($content_image,$content_detail,$content_id);
    }

    $message = $result;
    
    
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/main.css"> -->
    <title>CMS - Edit Detail</title>
</head>
<body>
    <a href="admin_content_more.php">Back to Discrimination & HIV Prevention Mangement </a><br>
    <h2>Edit Detail</h2>
    <p><strong>Please modify all the pictures if you want to modify the image, in order to keep a unified style.</strong></p>
    <?php echo !empty($message)? $message:'';?>
        <form action="admin_content_edit.php?id=<?php echo $contentinfo['content_id'];?>" method="post" enctype="multipart/form-data">
            <lable>ID:</label>
            <input type="text" name="id" value="<?php echo $contentinfo['content_id'];?>" readonly><br><br>

            <img src="../images/<?php echo $contentinfo['content_picture'];?>" alt="content picture" width="10%"><br>
            <label>Change Content Image: </label>
            <input type="file" name="cover" value=""><br><br>

            <label>Header: </label>
            <textarea type="text" name="header"><?php echo $contentinfo ['content_header'];?></textarea><br><br>

            <label>Introduce: </label>
            <textarea type="text" name="introduce"><?php echo $contentinfo ['content_intro'];?></textarea><br><br>

            <label>Detail Category:</label><br>
            <select name="cateList">
            <option value="<?php echo $contentinfo ['category_id'];?>"><?php echo $contentinfo ['category_name'];?></option>
            <?php while($categories = $getCategory->fetch(PDO::FETCH_ASSOC)):?>
            <option value="<?php echo $categories['category_id'];?>"><?php echo $categories['category_name'];?></option>
            <?php endwhile;?>
            </select><br><br>

            <button type="submit" name="submit">Edit Deatil</button>
        </form>
</body>
</html>
