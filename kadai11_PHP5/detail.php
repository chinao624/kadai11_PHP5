<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

session_start();

$id = $_GET["id"];
//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM profile_builder WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //true or false

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}

//全データ取得
$value =  $stmt->fetch(); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]


?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <title>Update Portfolio</title>
  <link href="./css/sample.css?ver=1.0.1" rel="stylesheet">
  <script src="./js/jquery-2.1.3.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=IM+Fell+DW+Pica+SC" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>

<body>


<!-- Main[Start] -->
<!-- formタグでくくっている中身だけが飛んでいく -->
<div class=container2>
    <h3>Update Profile</h3>
    <form id ="wrap" action="update.php" method="post" enctype="multipart/form-data">

<div>
            <label for="name" class="spacer">Name</label>
            <input type="text" name="name" value="<?=$value["name"]?>">
        </div>

<div>
<label for="genre" class="spacer">Genre</label>
        <select id="genre" name="genre">
        <option value="stylist" <?php if($value["genre"] == 'stylist') echo 'selected'; ?>>stylist</option>
        <option value="photographer" <?php if($value["genre"]  == 'photographer') echo 'selected'; ?>>photographer</option>
        <option value="hairmake" <?php if($value["genre"]  == 'hairmake') echo 'selected'; ?>>hair&make-up</option>
        </select>
</div>        

<div>
        <label for="profile">Profile</label><br>
    <textarea name="profile" rows="7" cols="50"><?=$value["profile"]?></textarea>
    </div>

    <div>
            <label for="portrait" class="spacer">Portrait</label>
            <input type="file" name="portrait">
        </div>

        <div>
            <label for="works" class="spacer">Works</label><br>
            <input type="file" name="works1">
            <input type="file" name="works2"><br>
            <input type="file" name="works3">
            <input type="file" name="works4">
            <input type="file" name="works5">
            <label for="url" class="sublabel2">more works</label>
            <input id="url" name="url" type="text" value="<?=$value["name"]?>">
        </div>

       <div class="contact">
        <label for="contact">Contact</label><br>
        <label for="agent" class="sublabel">Agency</label>
            <input id ="agent" name="agent" type="text" value="<?=$value["agent"]?>">
            <label for="email" class="sublabel2">Email</label>
            <input id ="email" name="email" type="text" value="<?=$value["email"]?>">

        <input type="hidden" name="id" value="<?=$value["id"]?>"> 
        </div>
       

            <div class="save_btn"><button id="save" type="submit">UPDATE</button></div>
    </form>
    
    <div class="tobtn"><a href="select.php" class="btn">Profile List</a></div>
    </div>



<!-- Main[End] -->

<script src="./js/script.js"></script>
</body>
</html>
