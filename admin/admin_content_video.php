<?php
require_once '../load.php';
confirm_logged_in();

// show video detail
$args = array(
    'tbl'=>'tbl_video',
    'tbl2'=>'tbl_category',
    'tbl3'=>'tbl_video_category',
    'col'=>'video_id',
    'col2'=>'category_id',
);
$getVideo = getAllbyCategory($args);
if(!$getVideo){
    $message = 'Failed to get the content';
} 

// delete the video
if(isset($_GET['id'])){
    $video_id = $_GET['id'];

    if($video_id){
        $delete_video = deleteVideo($video_id);
        if(!$delete_video){
            $message ='Failed to delete Video';
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
    <link rel="stylesheet" href="../css/main.css">
    <title>CMS - Edit Video</title>
</head>
<body>
    <a href="admin_content.php"> Back to Content Management</a><br>
    <a href="admin_add_video.php">Add Video</a><br>
    <h2 style="text-align:center"> Edit Video</h2>
    <p style="text-align:center"><?php echo !empty($message)? $message:'';?></p>

    <table>
    <form action="admin_content_detail.php" method="POST">
        <thead>
            <tr>
                <th>ID</th>
                <th>Video</th>
                <th>Page</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
        <?php while($videos = $getVideo  ->fetch(PDO::FETCH_ASSOC)):?>
            <tr>
                <td><?php echo $videos['video_id'];?></td>
                <td><video src="../video/<?php echo $videos['video_source'];?> " controls width='320px' height='200px'></td>
                <td style="text-align:center"><?php echo $videos['category_name'];?></td>
                <td><a href="admin_editvideo.php?id=<?php echo $videos['video_id'];?>">Update</a></td>
                <td><a href="admin_content_video.php?id=<?php echo $videos['video_id'];?>">Delete</a></td>
            </tr>
        <?php endwhile;?>
        </tbody>
    </table>
</body>
</html>