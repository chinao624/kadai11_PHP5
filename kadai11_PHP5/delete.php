<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

session_start();

// 1. DB接続
include("funcs.php");
$pdo = db_conn();


// 2. 削除対象の名前を取得
$id = $_GET['id'];

// 3. データを削除
$stmt = $pdo->prepare("DELETE FROM profile_builder WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

if ($status==false) {
    sql_error($stmt);
    echo "Dataの削除に失敗しました。エラー: " . $error[2];
    
} else {
    redirect("select.php");
    echo "Dataを削除しました。";
}

?>