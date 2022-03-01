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
<h1>管理者追加<h1/>
<form method="post" action="staff_add_check.php">

<div class="confirm-contents">
<div>
<div class="answers">
<div class = "answer">

<div class ="answer-top">
<label>管理者名を入力してください</label>
<input type="text" name="name"><br/>
</div>

<div class ="answer-top">
<label>ログインパスワードを入力してください。</label>
<input type="password" name="pass"><br/>

<div class ="answer-top">
<label>ログインパスワードをもう一度入力してください。</label>
<input type="password" name="pass2"><br/>
</div>
</div>
</div>

<div class="confirm-btn">
<button id ="btn" class ="btn" type="submit" name="login"> 追加</a></button>
 <a href="javascript:history.back();">前の画面に戻る</a>
</div>
</div>
</div>
</div>
</div>

</form>
</body>
</html>
