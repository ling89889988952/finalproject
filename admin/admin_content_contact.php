<?php 
require_once '../load.php';
confirm_logged_in();

$tbl_contact = 'tbl_contact';
$getContact  = getAll($tbl_contact);

if(!$getContact){
    $message = 'Failed to get contact information';
}

if(isset($_POST['submit'])){
    $title         = trim($_POST['title']);
    $address       = trim($_POST['address']);
    $phone         = trim($_POST['phone']);
    $email         = trim($_POST['email']);
    $website       = trim($_POST['website']);

    if(!empty($title) && !empty($address) && !empty($phone) && !empty($email) && !empty($website)){
        $message    = editContactPage($title,$address,$phone,$email,$website);
    }else{
        $message = 'Please fill all blank';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>CMS - Edit Contact</title>
</head>
<body>
<a href="admin_content.php">Back to Content Mangement </a><br>
    <h2 style="text-align:center">Edit Contact Information</h2>
    <?php echo!empty($message)? $message:'';?>
    <form action='admin_content_contact.php' method='post'>
    <?php while($contactinfo = $getContact->fetch(PDO::FETCH_ASSOC)):?>
        <label>Contact_title<label><br>
        <textarea  class="cme-input" type='text' name='title'><?php echo $contactinfo['contact_title'];?></textarea><br>

        <label>Address<label><br>
        <textarea class="cme-input" type='text' name='address'><?php echo $contactinfo['contact_address'];?></textarea><br>

        <label>Phone:<label><br>
        <textarea  class="cme-input" type='text' name='phone'><?php echo $contactinfo['contact_phone'];?></textarea><br>

        <label>Email:<label><br>
        <textarea class="cme-input" type='email' name='email'><?php echo $contactinfo['contact_email'];?></textarea><br>

        <label>Website:<label><br>
        <textarea class="cme-input" type='text' name='website'><?php echo $contactinfo['contact_website'];?></textarea><br>

    <?php endwhile;?>
        <button type='submit' name='submit' class="cms-button">Update Information</button>
</body>
</html>