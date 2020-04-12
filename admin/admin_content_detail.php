<?php
require_once '../load.php';
confirm_logged_in();


$args = array(
    'tbl'=>'tbl_detail',
    'tbl2'=>'tbl_category',
    'tbl3'=>'tbl_detail_category',
    'col'=>'detail_id',
    'col2'=>'category_id',
);
$getDetail = getAllbyCategory($args);
if(!$getDetail){
    $message = 'Failed to get the content';
} 


if(isset($_GET['id'])){
    $detail_id = $_GET['id'];
    if($detail_id){
        $delete_detail = deleteDeatil($detail_id);
        if(!$$delete_detail){
            $message ='Failed to delete user';
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
    <title>CMS - Edit Readmore Detail</title>
</head>
<body>
    <a href="admin.php"> Back to admin</a><br>
    <a href="admin_adddetailcontent.php">Add Content</a><br>
    <h2 style="text-align:center">CMS - Edit Readmore Detail</h2>
    <p style="text-align:center"><?php echo !empty($message)? $message:'';?></p>

    <table>
    <form action="admin_content_detail.php" method="POST">
        <thead>
            <tr>
                <th>Detail_ID</th>
                <th>Detail_Category</th>
                <th>Image</th>
                <th>Header</th>
                <th>Introduce</th>
                <th>Introduce-Image</th>
                <th>Supplement</th>
                <th>Supplement-Image</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
        <?php while($details = $getDetail ->fetch(PDO::FETCH_ASSOC)):?>
            <tr>
                <td><?php echo $details['detail_id'];?></td>
                <td><?php echo $details['category_name'];?></td>
                <td><img src="../images/<?php echo $details['header_image'];?>" alt="detail picture" width="200px"></td>
                <td><?php echo $details['header'];?></td>
                <td><?php echo $details['intro'];?></td>
                <td><img src="../images/<?php echo $details['image'];?>" alt="detail picture" width="200px"></td>
                <td><?php echo $details['sub_intro'];?></td>
                <td><img src="../images/<?php echo $details['sub_image'];?>" alt="detail picture" width="200px"></td>
                <td><a href="admin_editdetailcontent.php?id=<?php echo $details['detail_id'];?>">Update</a></td>
                <td><a href="admin_content_detail.php?id=<?php echo$details['detail_id'];?>">Delete</a></td>
            </tr>
        <?php endwhile;?>
        </tbody>
    </table>
</body>
</html>