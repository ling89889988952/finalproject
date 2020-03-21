<?php

require_once '../load.php';

confirm_logged_in();

$getMember = getAllMember();

if(!$getMember){
    $message = 'Failed to get member list';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member</title>
</head>
<body>
    <h2>Member List</h2>
    <?php echo !empty($message)? $message:''?>
    <table>
        <thead>
            <tr>
                <th>Member_id</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Email</th>
                <th>Message</th>
                <th>Subscription_date</th>
            </tr>  
        <thead>
        <tbody>
        <?php while($members = $getMember->fetch(PDO::FETCH_ASSOC)):?>
            <tr>
                <td><?php echo $members['user_id'];?></td>
                <td><?php echo $members['user_name'];?></td>
                <td><?php echo $members['user_gender'];?></td>
                <td><?php echo $members['user_age'];?></td>
                <td><?php echo $members['user_email'];?></td>
                <td><?php echo $members['user_message'];?></td>
                <td><?php echo $members['user_date'];?></td>
            </tr>
        <?php endwhile;?>
        </tbody>
    </table>
    <p><a href="admin.php">Back to Admin</a></p>
    
</body>
</html>