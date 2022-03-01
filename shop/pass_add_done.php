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
    <h1> パスワードを変更完了しました<h1/>
<?php

try
{

  require_once('../common/common.php');
  $POST=sanitize($_POST);
  $staff_pass = $_POST['pass'];

$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password ='1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'UPDATE dat_member SET password=? ';
$stmt = $dbh->prepare($sql);
$data[] = $staff_pass;
$stmt->execute($data);

$dbh = null;
echo 'パスワードを変更しました';

}
catch(Exception $e)
{
  echo $e->getMessage();
  exit();
}
?>
<br/>
<div class="confirm-btn">
<a href="member_login.html" > 会員ログイン画面へ</a></div>

</body></html>
