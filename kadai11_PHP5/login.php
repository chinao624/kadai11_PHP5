<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <title>Login</title>
  <link href="./css/sample.css?ver=1.0.1" rel="stylesheet">
  <script src="./js/jquery-2.1.3.min.js"></script>
  
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Sawarabi+Gothic&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:700" rel="stylesheet">
</head>
<body class="loginbody">

<header class="login">
  <h4>LOGIN</h4>
</header>

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<div class="loginform">
<form name="form1" action="login_act.php" method="post" class="login-form">
id:<input type="text" name="lid">
password:<input type="password" name="lpw"><br>
<input type="submit" value="login">
</form>
</div>


</body>
</html>