<?php
  session_start();
  session_regenerate_id(true);
  if (isset($_SESSION['login'])==false) {
    echo '<div class="check"><h1>ログインされていません。</h1><br/>';
    echo '<div class = "confirm-btn"><a href = "../staff_login/staff_login.php">ログイン画面へ</a></div>';
    exit();
  }else{
  }
  ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>7-1</title>
  <link rel="stylesheet" type="text/css" href="/css/list.css">
  <link rel="stylesheet" type="text/css" href="/css/base.css">
</head>

<body>
  <div class="check">

 <h1>商品が選択されていません。</h1><br/>
<br/>
<div class="confirm-btn">
<a href="pro_list.php">戻る</a></div>
</body></html>
