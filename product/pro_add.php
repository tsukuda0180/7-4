<?php
  session_start();
  session_regenerate_id(true);
  if (isset($_SESSION['login'])==false) {
    echo 'ログインされていません。<br/>';
    echo '<a href = "../staff_login/staff_login.php">ログイン画面へ</a>';
    exit();
  }else{
  }
  ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>7-1</title>
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
</head>

<body>
<div class="check">
<h1>商品追加<h1/>
<form method="post" action="pro_add_check.php" enctype="multipart/form-data" >
  <div class="confirm-contents">
  <div>
  <div class="answers">
  <div class = "answer">

  <div class ="answer-top">
<label>商品名を入力してください</label>
  <input type ="text" name = "name">
<label>価格を入力してください</label>
  <input type ="text" name = "price" >
  <label>画像を選んでください</label>
  <input type ="file" name = "gazou">
  </div>
  </div>
  </div>

<div class="confirm-btn">
  <input type ="button" onclick = "history.back()" value="戻る">
  <input type="submit"  value="OK">
</div>
</div>
</div>
</div>
</div>

</form>
</body></html>
