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
        <h1>修正完了<h1/>
<?php

try
{

  require_once('../common/common.php');
  $post=sanitize($_POST);
$pro_code=$post['code'];
$pro_name = $post['name'];
$pro_price = $post['price'];
$pro_gazou_name_old=$post['gazou_name_old'];
$pro_gazou_name=$post['gazou_name'];


$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password ='1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = ' UPDATE mst_product SET name=?,price=?,gazou=? WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $pro_name;
$data[] = $pro_price;
$data[] = $pro_gazou_name;
$data[] = $pro_code;
$stmt->execute($data);

$dbh = null;

if($pro_gazou_name_old!=$pro_gazou_name){
  if($pro_gazou_name_old!=''){
  unlink('./gazou/'.$pro_gazou_name_old);
}
}

echo'  修正しました。<br/>';

}
catch(Exception $e)
{
  echo $e->getMessage();
  exit();
}
?>
<div class="confirm-btn">
<a href="pro_list.php">戻る</a></div>

</body></html>
