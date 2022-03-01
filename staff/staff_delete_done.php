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

<?php

try
{
$staff_code = $_POST['code'];
$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password ='1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'DELETE FROM mst_staff WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $staff_code;
$stmt->execute($data);

$dbh = null;

}
catch(Exception $e)
{
  echo $e->getMessage();
  exit();
}
?>
<div class="check">
<h1>削除完了<h1/>
  <div class="confirm-contents">
   <div>
  <div class="answers">
  <div class = "answer">

  <div class ="answer-top">
削除しました。<br/>
<br/>
</div>
</div>
</div>
<div class="confirm-btn">
<a href="staff_list.php" >管理者一覧へ戻る</a>
</div>
</div>
</div>
</body></html>
