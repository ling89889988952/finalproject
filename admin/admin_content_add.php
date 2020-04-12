<?php
require_once '../load.php';
confirm_logged_in();

$category_table = 'tbl_category';
$getCategory = getAll($category_table);

if(isset($_POST['submit'])){
    $contentinfo =  array(
        'cover'      => $_FILES['cover'],
        'header'     => trim($_POST['header']),
        'introduce'  => trim($_POST['introduce']),
        'category'   => trim($_POST['cateList']),
    );
    $result  = addContent($contentinfo);
    $message = $result;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Content</title>
</head>
<body>
<a href="admin.php">Back to Admin</a>
<h2 >Add Content</h2>
<?php echo !empty($message)?$message:'';?>
    <form action="admin_content_add.php" method="post" enctype="multipart/form-data">
        <label>Header:</label><br>
        <textarea name="header"></textarea><br><br>

        <label>Introduce:</label><br>
        <textarea name="introduce"></textarea><br><br>
  
        <label>Picture:</label><br>
        <input type="file" name="cover" value=""><br><br>


        <label>Category:</label><br>
        <select name="cateList">
            <option>Please select a detail category...</option>
            <?php while($categories = $getCategory->fetch(PDO::FETCH_ASSOC)):?>
            <option value="<?php echo $categories['category_id'];?>"><?php echo $categories['category_name'];?></option>
            <?php endwhile;?>
        </select><br><br>

        <button type="submit" name="submit">Add Content</button>

    </form>

</body>
</html>