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

<footer id="readmoreFooter">
    <!-- <h2>Contact Information</h2> -->
    <?php foreach ($contactData as $contact) {
            // echo '<div id="contactInfo">' .
                //     '<div class="contactInfo">'.
                //     '<p>Address: '.$contact['contact_address'].'</p>' .
                //     '</div>'.
                //     '<div class="contactInfo">'.
                //     '<p>Phone: '.$contact['contact_phone'].'</p>'.
                //     '</div>'.
                //     '<div class="contactInfo">'.
                //     '<p>E-mail: '.$contact['contact_email'].'</p>'.
                //     '</div>'.
                //     '<div class="contactInfo">'.
                //     '<p>Website: '.$contact['contact_website'].'</p>'.
                //     '</div>'.
                // '</div>';
        } ?>
    <div id="boy">
                <img id="img4" src="images/boy.png">
            </div>
    <div id="copyright1">
        <p>Copyright © <?php echo date('Y')?></p>
        <img src="images/<?php ?>" alt="<?php ?>">
    <div>
</footer>