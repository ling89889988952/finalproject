<?php
    require_once 'load.php';

    function getContactData($conn){
        $getData =$conn->query('SELECT * FROM tbl_conInfo');
        $result = array();

        while($row = $getData->fetch(PDO::FETCH_ASSOC)) {
            // push each row of data into our array
            $result[] = $row;
        } 
        return  $result;
    }
    $pdo = Database::getInstance()->getConnection();
    $contactData = getContactData($pdo);
   
?>

<footer>
    <h2>Contact Information</h2>
    <?php foreach ($contactData as $contact) {
            echo '<div>' .
                    '<p>Address: '.$contact['contact_address'].'</p>' .
                    '<p>Phone: '.$contact['contact_phone'].'</p>'.
                    '<p>E-mail: '.$contact['contact_email'].'</p>'.
                    '<p>Website: '.$contact['contact_website'].'</p>'.
                '</div>';
        } ?>
    <div>
        <p>Copyright © <?php echo date('Y')?></p>
        <img src="images/<?php ?>" alt="<?php ?>">
    <div>
</footer>