<?php
session_start();
$login_user = $_SESSION['name'] ?? null;
include("funcs.php"); 
$pdo = db_conn();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <title>Edit your favorites</title>
  <link href="./css/sample.css?ver=1.0.1" rel="stylesheet">
  <script src="./js/jquery-2.1.3.min.js"></script>
  
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Sawarabi+Gothic&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:700" rel="stylesheet">
</head>

<body>

<!-- Head[Start] -->
<header id="header">
<h1>Edit your Favorites!</h1>
     <img src="header.png" alt="header">
</header>

<!-- Head[End] -->

<!-- Main[Start] -->

<div class=container>
    <div class="login_btn"><a href="login.php" class="btn">LOGIN</a>
<a href="user.php" class="btn2">NEW USER</a></div>
    <h3>What's your Favorite!?</h3>
    <!-- formタグでくくっている中身だけが飛んでいく -->
    <form id ="wrap" action="insert.php" method="post" enctype="multipart/form-data">

    <div>
                <label for="title" class="spacer">Title</label>
                <input type="text" name="title">
            </div>

    <div>
    <label for="genre" class="spacer">Genre</label>
            <select id="genre" name="genre">
                <option value="">select genre</option>
                <option value="travel">travel</option>
                <option value="food">food</option>
                <option value="pet">pet</option>
                <option value="kids">kids</option>
            </select>
    </div>        

     
            <div>
                <label for="images" class="spacer">Images</label><br>
                <input type="file" name="img1">
                <input type="file" name="img2"><br>
                <input type="file" name="img3">
                <input type="file" name="img4">
                <input type="file" name="img5">
                <input type="file" name="img6">
                
            </div>


            <div class="save_btn"><button id="save" type="submit">SAVE</button></div>
    </form>
    
    <div class="tobtn"><a href="select.php" class="listbtn">My Favorites List</a></div>
    </div>



<!-- Main[End] -->

<script src="./js/script.js"></script>
</body>
</html>
