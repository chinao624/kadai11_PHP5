<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
// ↑エラー内容を表示してくれる魔法の言葉

session_start();
// login_act.phpでセッションに保存したnameとlidを使う
$name = $_SESSION["name"];
$lid = $_SESSION["lid"];

//DB接続します　PHPの構文　これはこのまま使ってOK
include("funcs.php"); //外部ファイル読み込み
$pdo = db_conn();
// var_dump($pdo);
// exit();

// ★ログインしたユーザーのidを一緒にfavoritesテーブルに保存する
$stmt = $pdo->prepare("SELECT lid FROM user_table WHERE name = ?");
$stmt->execute([$name]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $row['lid'];
$_SESSION['lid'] = $user_id;

//1. POSTデータ取得

$title = $_POST["title"];
$genre = $_POST["genre"];


// img1の画像データについての取得
$img1TmpName = $_FILES["img1"]["tmp_name"]; // ファイルの一時的な場所
$img1Name = $_FILES["img1"]["name"];
$img1Data = file_get_contents($img1TmpName);

// img2の画像データについての取得
$img2TmpName = $_FILES["img2"]["tmp_name"]; // ファイルの一時的な場所
$img2Name = $_FILES["img2"]["name"];
$img2Data = file_get_contents($img2TmpName);


// img3の画像データについての取得
$img3TmpName = $_FILES["img3"]["tmp_name"]; // ファイルの一時的な場所
$img3Name = $_FILES["img3"]["name"];
$img3Data = file_get_contents($img3TmpName);


// img4の画像データについての取得
$img4TmpName = $_FILES["img4"]["tmp_name"]; // ファイルの一時的な場所
$img4Name = $_FILES["img4"]["name"];
$img4Data = file_get_contents($img4TmpName);


// img5の画像データについての取得
$img5TmpName = $_FILES["img5"]["tmp_name"]; // ファイルの一時的な場所
$img5Name = $_FILES["img5"]["name"];
$img5Data = file_get_contents($img5TmpName);

// img6の画像データについての取得
$img6TmpName = $_FILES["img6"]["tmp_name"]; // ファイルの一時的な場所
$img6Name = $_FILES["img6"]["name"];
$img6Data = file_get_contents($img6TmpName);






//３．データ登録SQL作成
$sql = "INSERT INTO favorites(title,genre,img1,img2,img3,img4,img5,img6,user_id,indate)
VALUES(:title,:genre,:img1,:img2,:img3,:img4,:img5,:img6,:user_id,sysdate())";

$stmt = $pdo->prepare($sql);
// bind変数を使って、危ない文字がないかクリーニングして、VALUEに渡す
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（文字列の場合 PDO::PARAM_STR)
$stmt->bindValue(':genre', $genre, PDO::PARAM_STR);  
$stmt->bindValue(':img1', $img1Data, PDO::PARAM_LOB);  
$stmt->bindValue(':img2', $img2Data, PDO::PARAM_LOB);  
$stmt->bindValue(':img3', $img3Data, PDO::PARAM_LOB);  
$stmt->bindValue(':img4', $img4Data, PDO::PARAM_LOB);  
$stmt->bindValue(':img5', $img5Data, PDO::PARAM_LOB);  
$stmt->bindValue(':img6', $img6Data, PDO::PARAM_LOB);  
//自動的にログインユーザーのidをfavoritesのテーブル内user_idに入れる
$stmt->bindValue(':user_id', $_SESSION['lid'], PDO::PARAM_STR);


$status = $stmt ->execute();


//４．データ登録処理後
if($status==false){
    // SQL実行時にエラーがある場合
    $error = $stmt->errorInfo();
    $errorMessage = "SQL_ERROR: " . $error[2];
    exit($errorMessage);
} else {
    // リダイレクト前にセッションを開始する
    session_start();
    // index.phpへリダイレクト
    header("Location: index.php");
    exit();
}


?>
