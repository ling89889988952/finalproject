<?php

require_once '../load.php';

confirm_logged_in();

$category_table = 'tbl_category';
$getCategory = getAll($category_table);

$show_detail = showDetail($_GET['id']);
$detailinfo = $show_detail->fetch(PDO::FETCH_ASSOC);




if(isset($_POST['submit'])){
    $image  = $_FILES['cover'];
    $image2  = $_FILES['cover2'];
    $image3  = $_FILES['cover3'];
    $detail_edit =  array(
        'header'      => trim($_POST['header']),
        'introduce'   => trim($_POST['introduce']),
        'supplement'  => trim($_POST['supplement']),
        'category'    => trim($_POST['cateList']),
    );
    
    $detail_id = $_GET['id'];

    if($image['error'] == 4 && $image2['error'] == 4 && $image3['error'] == 4){
      
        $result  = editDetail($detail_edit,$detail_id);

    }elseif($image['error'] == 0 && $image2['error'] == 0 && $image3['error'] == 0){
        $image   = $_FILES['cover'];
        $image2  = $_FILES['cover2'];
        $image3  = $_FILES['cover3'];
        $result  = editDetailImage($image,$image2,$image3,$detail_edit,$detail_id);
    }else{

        $result = 'You can not just modify partial picture';
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
    <a href="admin_content_detail.php">Back to Content Mangement </a><br>
    <h2>Edit Detail</h2>
    <p><strong>Please modify all the pictures if you want to modify the image, in order to keep a unified style.</strong></p>
    <?php echo !empty($message)? $message:'';?>
        <form action="admin_editdetailcontent.php?id=<?php echo $detailinfo['detail_id'];?>" method="post" enctype="multipart/form-data">
            <lable>ID:</label>
            <input type="text" name="id" value="<?php echo $detailinfo['detail_id'];?>" readonly><br><br>

            <img src="../images/<?php echo $detailinfo['header_image'];?>" alt="header image" width="10%"><br>
            <label>Change Header Image: </label>
            <input type="file" name="cover" value=""><br><br>

            <label>Header: </label>
            <textarea type="text" name="header"><?php echo $detailinfo ['header'];?></textarea><br><br>

            <label>Introduce: </label>
            <textarea type="text" name="introduce"><?php echo $detailinfo ['intro'];?></textarea><br><br>

            <img src="../images/<?php echo $detailinfo['image'];?>" alt="introduce image" width="10%"><br>
            <label>Change Introduce Image: </label>
            <input type="file" name="cover2" value=""><br><br>
        
            <label>Supplement: </label>
            <textarea type="text" name="supplement"><?php echo $detailinfo ['sub_intro'];?></textarea><br><br>


            <img src="../images/<?php echo $detailinfo['sub_image'];?>" alt=" Supplement-Image" width="10%"><br>
            <label>Change  Supplement Image: </label>
            <input type="file" name="cover3" value=""><br><br>


            <label>Detail Category:</label><br>
            <select name="cateList">
            <option value="<?php echo $detailinfo ['category_id'];?>"><?php echo $detailinfo ['category_name'];?></option>
            <?php while($categories = $getCategory->fetch(PDO::FETCH_ASSOC)):?>
            <option value="<?php echo $categories['category_id'];?>"><?php echo $categories['category_name'];?></option>
            <?php endwhile;?>
            </select><br><br>

            <button type="submit" name="submit">Edit Deatil</button>
        </form>
</body>
</html>
