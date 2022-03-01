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
  <link rel="stylesheet" type="text/css" href="/css/list.css">
</head>

<body>

        <div class="check">
        <h1>削除完了画面<h1/>
  <?php

try
{
$pro_code = $_POST['code'];
$pro_gazou_name = $_POST['gazou_name'];
$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password ='1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'DELETE FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $pro_code;
$stmt->execute($data);

$dbh = null;

if($pro_gazou_name!=''){
  unlink('./gazou/'.$pro_gazou_name);
}
}
catch(Exception $e)
{
  echo $e->getMessage();
  exit();
}
?>
削除しました。<br/>
<br/>

<div class="confirm-btn">
<a href="pro_list.php">戻る</a>
</div>

</body></html>
