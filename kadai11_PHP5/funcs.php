<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}
//DB接続
function db_conn()
{
    try {
        $db_name =  'kadai11';            //データベース名
        $db_host =  'localhost';  //DBホスト
        $db_id =    'root';                //アカウント名(登録しているドメイン)
        $db_pw =    '';           //さくらサーバのパスワード
        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
    }

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

function redirect($file_name){
    header("Location: ".$file_name);
    exit();
    }

//SessionCheck(スケルトン)
function sschk(){
    if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){ //！は、逆の意味になるので、「setされていなければ」となる
      exit("Login Error");
   }else{
      session_regenerate_id(true); //SESSION KEYを入れ替えます！違うページにいくと入れ替えて持たせる。特定されづらくなるように＝セキュリティ面
      $_SESSION["chk_ssid"] = session_id();
  }
  }
?>