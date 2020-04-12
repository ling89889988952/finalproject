<?php 
require_once '../load.php';
confirm_logged_in();

$tbl_contact = 'tbl_contact';
$getContact  = getAll($tbl_contact);

if(!$getContact){
    $message = 'Failed to get contact information';
}

if(isset($_POST['submit'])){
    $username   = trim($_POST['username']);
    $password   = trim($_POST['password']);
    $email      = trim($_POST['email']);
    $message    = editUser($id,$username,$password,$email);
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
    <h2 style="text-align:center">Edit Contact Information</h2>
    <?php echo!empty($message)? $message:'';?>
    <form action='admin_content_contact.php' method='post'>
    <?php while($contactinfo = $getContact->fetch(PDO::FETCH_ASSOC)):?>
        <label>Contact_title<label><br>
        <input  class="cme-input" type='text' name='title' value='<?php echo $contactinfo['contact_title'];?>'><br>

        <label>Address<label><br>
        <input class="cme-input" type='text' name='address' value='<?php echo $contactinfo['contact_address'];?>'><br>

        <label>Phone:<label><br>
        <input  class="cme-input" type='text' name='phone' value='<?php echo $contactinfo['contact_phone'];?>'><br>

        <label>Email:<label><br>
        <input  class="cme-input" type='text' name='email' value='<?php echo $contactinfo['contact_email'];?>'><br>

        <label>Website:<label><br>
        <input class="cme-input" type='text' name='email' value='<?php echo $contactinfo['contact_website'];?>'><br>

    <?php endwhile;?>
        <button type='submit' name='submit' class="cms-button">Update Information</button>
</body>
</html>