<?php
  session_start();
  $_SESSION=array();
  if (isset($_COOKIE[session_name()])==true) {
    setcookie(session_name(),'',time()-42000,'/');
  }
  session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>7-1</title>
  <link rel="stylesheet" type="text/css" href="/css/login.css">
</head>

<body>

<div class="check">
<h1>ログアウトしました<h1/>

<div class="confirm-btn">
  <a href="../staff_login/staff_login.php">ログイン画面へ</a>
</div>
</div>
</form>
</body></html>
