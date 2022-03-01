<?php
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
    setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
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
  <h1>ログアウトしました<h1/>
<br />
<br />
<div class="confirm-btn">
<a href="shop_list.php">商品一覧へ</a></div>
</body>
</html>
