<?php include_once './templates/head.php'?>
<?php include_once './templates/header.php'?>
<?php 
require_once 'load.php';

function getReadData($conn){
    $getData =$conn->query('SELECT * FROM tbl_read');
    $result = array();

    while($row = $getData->fetch(PDO::FETCH_ASSOC)) {
        // push each row of data into our array
        $detail[] = $row;
    } 
    return  $detail;
}
$pdo = Database::getInstance()->getConnection();
$detailData = getReadData($pdo);

?>


<?php foreach ($detailData as $detail) {
        echo '<div id="readmoreBody">'.
        '<div id="readmoreTitle">'.
                '<h2>'.$detail['read_header'].'</h2>'.
                '<div id="titlePic">'.
                    '<img id="img1" src="images/superman.png">'.
                '</div>'.
             '</div>'.
             '<div id="readmoreContent">'.
             '<div id="drugs">'.
                '<img id="img2" src="images/drug.png">'.
            '</div>'.
            '<div id="lady">'.
                '<img id="img3" src="images/lady.png">'.
            '</div>'.
            
             '<div class="readmoreContent">' .
                '<h3>'.$detail['title'].'</h3>'.
                '<p>'.$detail['intro'].'</p>'.
             '</div>'.
            
             '<div class="readmoreContent">' .
                '<h3>'.$detail['sub_title'].'</h3>'.
                '<p>'.$detail['sub_intro'].'</p>'.
             '</div>'.
             '</div>'.
            '</div>';
    } ?>


<?php include_once './templates/footer.php'?>