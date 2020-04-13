<?php

require_once '../load.php';

confirm_logged_in();

$category_table = 'tbl_category';
$getCategory = getAll($category_table);

$show_video = showVideo($_GET['id']);
$videoinfo  = $show_video->fetch(PDO::FETCH_ASSOC);

// var_dump($detailinfo);
// exit;


if(isset($_POST['submit'])){
    $video    = $_FILES['video'];
    $category = trim($_POST['cateList']);
    $video_id = $_GET['id'];

    if($video['error'] == 4){
        // $video_file = $videoinfo['video_source'];
        $result  = editVideoCategory($category,$video_id);
    }else{
        $video_file = $_FILES['video'];
        $result  = editVideo($video_file,$category,$video_id);
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
    <title>CMS - Edit Video</title>
</head>
<body>
    <a href="admin_content_video.php">Back to Video Content </a><br>
    <h2>Edit Video</h2>
    <?php echo !empty($message)? $message:'';?>
        <form action="admin_editvideo.php?id=<?php echo $videoinfo['video_id'];?>" method="post" enctype="multipart/form-data">
            <div><video src="../video/<?php echo $videoinfo['video_source'];?> " controls width='320px' height='200px'></div><br>
            <label>Change Video: </label>
            <input type="file" name="video" value=""><br><br>

            <label>Video Category:</label><br>
            <select name="cateList">
            <option value="<?php echo $videoinfo ['category_id'];?>"><?php echo $videoinfo ['category_name'];?></option>
            <?php while($categories = $getCategory->fetch(PDO::FETCH_ASSOC)):?>
            <option value="<?php echo $categories['category_id'];?>"><?php echo $categories['category_name'];?></option>
            <?php endwhile;?>
            </select><br><br>

            <button type="submit" name="submit">Edit Deatil</button>
        </form>
</body>
</html>
