<?php include_once './templates/head.php'?>
<?php include_once './templates/header.php'?>
<?php 
require_once 'load.php';

function getReadData($conn){
    $getData =$conn->query('SELECT * FROM tbl_readmore');
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
                '<h2>'.$detail['readmore_title'].'</h2>'.
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
                '<h3>'.$detail['header'].'</h3>'.
                '<p>'.$detail['description'].'</p>'.
             '</div>'.
            
             '<div class="readmoreContent">' .
                '<h3>'.$detail['sub_header'].'</h3>'.
                '<p>'.$detail['sub_description'].'</p>'.
             '</div>'.
             '</div>'.
            '</div>';
    } ?>


<?php include_once './templates/footer.php'?>