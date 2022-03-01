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
        <h1>商品削除<h1/>
<?php

try
{

$pro_code=$_GET['procode'];

$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password ='1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name,gazou FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_gazou_name=$rec['gazou'];

$dbh = null;

if($pro_gazou_name==""){
  $disp_gazou='';
}else{
  $disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
}
}

catch(Exception $e)
{
  echo $e->getMessage();
  exit();
}
?>

 商品削除<br/>
<br/>
商品コード<br/>
<?php echo $pro_code;?>
<br/>
商品名<br/>
<?php echo $pro_name;?>
<br/>
<?php echo $disp_gazou;?>
<br/>
 この商品を削除してよろしいですか<br/>
 <br/>
<form method="post" action="pro_delete_done.php">
<input type="hidden" name="code" value="<?php echo $pro_code;?>">
<div class = "confirm-btn">
<input type="hidden" name="gazou_name" value="<?php echo $pro_gazou_name;?>">
  <input type ="button" onclick = "history.back()" value="戻る">
  <input type="submit"  value="OK"></div>

</body></html>
