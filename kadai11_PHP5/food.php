<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

session_start();

// 1. DB接続
include("funcs.php");
$pdo = db_conn();

// 2. idで取得
$id = $_GET['id'];

// 3. 対象のidのデータ取得
$sql = "SELECT * FROM favorites WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
} else {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// 4. jpegでもpngでもいけるように、ファイルタイプの判別
function getImageType($data) {
    $info = getimagesizefromstring($data);
    if ($info === false) {
        return null;
    }
    return image_type_to_mime_type($info[2]);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food photos</title>
    <link href="./css/sample.css?ver=1.0.2" rel="stylesheet">
    <script src="./js/jquery-2.1.3.min.js"></script>
    
<link href="https://fonts.googleapis.com/css?family=Montserrat+Subrayada" rel="stylesheet">
    <!-- モーダル追加のためのcss -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
</head>

<body class="food_body">
   
<header id="food_header">
        <div class="food_header">
        <p><?=h($row['title'])?></p>
        </div>
    </header>

   <div class="foodimg_wrap">
         
            <?php
            $img1Type = getImageType($row['img1']);
            $img2Type = getImageType($row['img2']);
            $img3Type = getImageType($row['img3']);
            $img4Type = getImageType($row['img4']);
            $img5Type = getImageType($row['img5']);
            $img6Type = getImageType($row['img6']);
            ?> 
        
            <div class="food_image">
                <?php if ($img1Type == 'image/jpeg') {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img1']) . '" alt="img1">';
                } elseif ($img1Type == 'image/png') {
                    echo '<img src="data:image/png;base64,' . base64_encode($row['img1']) . '" alt="img1">';
                } ?>
            </div>
            <div class="food_image">
                <?php if ($img2Type == 'image/jpeg') {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img2']) . '" alt="img2">';
                } elseif ($img2Type == 'image/png') {
                    echo '<img src="data:image/png;base64,' . base64_encode($row['img2']) . '" alt="img2">';
                } ?>
            </div>
            <div class="food_image">
                <?php if ($img3Type == 'image/jpeg') {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img3']) . '" alt="img3">';
                } elseif ($img3Type == 'image/png') {
                    echo '<img src="data:image/png;base64,' . base64_encode($row['img3']) . '" alt="img3">';
                } ?>
            </div>
            <div class="food_image">
                <?php if ($img4Type == 'image/jpeg') {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img4']) . '" alt="img4">';
                } elseif ($img4Type == 'image/png') {
                    echo '<img src="data:image/png;base64,' . base64_encode($row['img4']) . '" alt="img4">';
                } ?>
            </div>
            <div class="food_image">
                <?php if ($img5Type == 'image/jpeg') {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img5']) . '" alt="img5">';
                } elseif ($img5Type == 'image/png') {
                    echo '<img src="data:image/png;base64,' . base64_encode($row['img5']) . '" alt="img5">';
                } ?>
            </div>
            <div class="food_image">
                <?php if ($img6Type == 'image/jpeg') {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img6']) . '" alt="img6">';
                } elseif ($img6Type == 'image/png') {
                    echo '<img src="data:image/png;base64,' . base64_encode($row['img6']) . '" alt="img6">';
                } ?>
            </div>
        </div>
    
    <!-- クリックしたら写真が全部見えるようにしたい -->
    <!-- モーダル追加 ？-->
    <div id="modal" class="modal">
  <span class="close-btn">&times;</span>
  <img class="modal-content" id="modal-img">
</div>


    <div class="tobtn"><a href="select.php" class="tr_btn">Back to List</a></div>
           
    <script src="./js/script.js"></script>
</body>
</html>