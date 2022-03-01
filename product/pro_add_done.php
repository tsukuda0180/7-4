

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>7-1</title>
  <link rel="stylesheet" type="text/css" href="/css/list.css">
</head>

<body>
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
  <div class="check">
    <h1>商品追加</h1>
<?php

try
{

    require_once('../common/common.php');
    $post=sanitize($_POST);
    $pro_name = $post['name'];
    $pro_price = $post['price'];
    $pro_gazou_name=$post['gazou_name'];


$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password ='1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'INSERT INTO mst_product(name,price,gazou) VALUES (?,?,?)';
$stmt = $dbh->prepare($sql);
$data[] = $pro_name;
$data[] = $pro_price;
$data[] = $pro_gazou_name;
$stmt->execute($data);

$dbh = null;

echo $pro_name;
echo' を追加しました。<br/>';

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
