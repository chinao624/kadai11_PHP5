<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

session_start();

// //ログインしていない場合ログインページに
if (!isset($_SESSION['lid'])) {
  header("Location: login.php");
  exit;
}

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

// ログインユーザーの ID を取得
$login_user_id = $_SESSION['lid'];

// ★ログインユーザーの登録したデータのみ取得、に変更 ！！！
// $sql = "SELECT * FROM favorites WHERE user_id IN (SELECT lid FROM user_table WHERE lid = :lid)";
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':lid', $login_user_id, PDO::PARAM_INT);
// $status = $stmt->execute();

$sql = "SELECT f.* FROM favorites f INNER JOIN user_table u ON f.user_id = u.lid WHERE u.lid = :lid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $login_user_id, PDO::PARAM_STR);
$status = $stmt->execute();

// //２．データ登録SQL作成
// $sql = "SELECT * FROM favorites";
// $stmt = $pdo->prepare($sql);
// $status = $stmt->execute(); //true or false

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]


?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <title>My Favorites List</title>
  <link href="./css/sample.css?ver=1.0.1" rel="stylesheet"> 
  <script src="./js/jquery-2.1.3.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Sawarabi+Gothic&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:700" rel="stylesheet">
</head>

<body class="select">
<!-- Head[Start] -->
<header id="header">
<?php echo '<span class="headername">' .$_SESSION["name"].'さん</span>';?>
<h2>My Favorites List</h2>
     <!-- <img src="header2.jpg" alt="header"> -->
</header>
<!-- Head[End] -->


<!-- Main[Start] -->

    <div class="list_container">
      <?php foreach($values as $value){ ?>
     <div class="list">
    <?=h($value["title"])?><br>
    <?=h($value["indate"])?>
    <div class="link">
    <?php 
          // ジャンルごとにリンク先を変える
          if ($value["genre"] == "travel") {
            echo '<a href="travel.php?id=' . h($value["id"]) . '">view</a>';
          } elseif ($value["genre"] == "food") {
            echo '<a href="food.php?id=' . h($value["id"]) . '">view</a>';
          } elseif ($value["genre"] == "pet") {
            echo '<a href="pet.php?id=' . h($value["id"]) . '">view</a>';
          } elseif ($value["genre"] == "kids") {
            echo '<a href="kids.php?id=' . h($value["id"]) . '">view</a>';
          }
        ?>
    <a href="#" class="deletebtn" data-id="<?=h($value["id"])?>">delete</a>
    <a href="detail.php?id=<?=h($value["id"])?>">update</a>
        </div> 
      </div>
      <?php }?>
      </div>

<div class="btnwrap">
<div class="tobtn"><a href="logout.php" class="btn2">Logout</a></div>
<div class="tobtn"><a href="index.php" class="btn">Create New</a></div>
 
</div>
<!-- Main[End] -->

<script src="./js/script.js"></script>

</body>
</html>
