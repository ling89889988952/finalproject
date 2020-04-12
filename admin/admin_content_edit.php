<?php

require_once '../load.php';

confirm_logged_in();

$category_table = 'tbl_category';
$getCategory = getAll($category_table);


$show_content = showContent($_GET['id']);
$contentinfo = $show_content->fetch(PDO::FETCH_ASSOC);



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
    <a href="admin_content_detail.php">Back to Content Mangement </a><br>
    <h2>Edit Detail</h2>
    <p><strong>Please modify all the pictures if you want to modify the image, in order to keep a unified style.</strong></p>
    <?php echo !empty($message)? $message:'';?>
        <form action="admin_editdetailcontent.php?id=<?php echo $contentinfo['detail_id'];?>" method="post" enctype="multipart/form-data">
            <lable>ID:</label>
            <input type="text" name="id" value="<?php echo $contentinfo['detail_id'];?>" readonly><br><br>

            <img src="../images/<?php echo $contentinfo['header_image'];?>" alt="header image" width="10%"><br>
            <label>Change Header Image: </label>
            <input type="file" name="cover" value=""><br><br>

            <label>Header: </label>
            <textarea type="text" name="header"><?php echo $contentinfo ['header'];?></textarea><br><br>

            <label>Introduce: </label>
            <textarea type="text" name="introduce"><?php echo $contentinfo ['intro'];?></textarea><br><br>

            <img src="../images/<?php echo $contentinfo['image'];?>" alt="introduce image" width="10%"><br>
            <label>Change Introduce Image: </label>
            <input type="file" name="cover2" value=""><br><br>
        
            <label>Supplement: </label>
            <textarea type="text" name="supplement"><?php echo $contentinfo ['sub_intro'];?></textarea><br><br>


            <img src="../images/<?php echo $contentinfo['sub_image'];?>" alt=" Supplement-Image" width="10%"><br>
            <label>Change  Supplement Image: </label>
            <input type="file" name="cover3" value=""><br><br>


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
