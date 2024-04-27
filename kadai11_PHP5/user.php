<?php
session_start();
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <title>User Resistration</title>
  <link href="./css/sample.css?ver=1.0.1" rel="stylesheet">
  <script src="./js/jquery-2.1.3.min.js"></script>
  
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Sawarabi+Gothic&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:700" rel="stylesheet">
</head>

<body class="loginbody">



<!-- Main[Start] -->
<div class="loginform">
<form method="post" action="user_insert.php" class="login-form">
      <label>User Resistration</label><br>
     <label>Name：<input type="text" name="name"></label><br>
     <label>Login ID：<input type="text" name="lid"></label><br>
     <label>Login PW：<input type="text" name="lpw"></label><br>
       <br>
       <input type="submit" value="submit">
</form>
</div>

<footer class="userfooter">
    <a href="login.php">Login</a>
    <a href="index.php">Back</a></div>
    </div>
</footer>

<!-- Main[End] -->


</body>
</html>
