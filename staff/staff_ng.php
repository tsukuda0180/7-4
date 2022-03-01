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

<div class="confirm-contents">
 <div>
<div class="answers">
<div class = "answer">

<div class ="answer-top">
スタッフが選択されていません
</div>
</div>
</div>

<div class="confirm-btn">
<a href="staff_list.php">管理者一覧へ戻る</a>
</form>

</body></html>
