<?php
require_once '../load.php';
confirm_logged_in();

$category_table = 'tbl_category';
$getCategory = getAll($category_table);

if(isset($_POST['submit'])){
        $video    = $_FILES['video'];  
        // var_dump($video);
        // exit;
        $category = trim($_POST['cateList']);

        if(!empty($video) && !empty($category)){
            $message = addVideo($video,$category);
        }else{
            $message = 'Please choose the video file and related category';
        }
}
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Video</title>
</head>
<body>
<a href="admin.php">Back to Admin</a>
<h2 >Add Video</h2>
<?php echo !empty($message)?$message:'';?>
    <form action="admin_add_video.php" method="post" enctype="multipart/form-data">
        <label for="file"><span>VideoFile:</span></label>
        <input type="file" name="video" /> <br></br>

        <label>Video Category:</label><br>
        <select name="cateList">
            <option>Please select a detail category...</option>
            <?php while($categories = $getCategory->fetch(PDO::FETCH_ASSOC)):?>
            <option value="<?php echo $categories['category_id'];?>"><?php echo $categories['category_name'];?></option>
            <?php endwhile;?>
        </select><br><br>

        <button type="submit" name="submit">Add Video</button>

    </form>

</body>
</html>