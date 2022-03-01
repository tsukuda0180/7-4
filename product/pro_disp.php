

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
<?php

try
{

$pro_code=$_GET['procode'];

$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password ='1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name,price,gazou FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_price=$rec['price'];
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
<div class="check">
<h1>商品情報参照<h1/>
<br/>
<!-- 商品コードの表示 -->
商品コード :
<?php echo $pro_code;?>
<br />
商品名 :
<?php echo $pro_name;?>
<br />
価格 :
<?php echo $pro_price;?>円
<br />
商品画像<br />
<?php echo $disp_gazou; ?>
<br/>
</div>
<form>

  <div class="confirm-btn">
  <input type ="button" onclick = "history.back()" value="戻る">
  </div>
</form>
</body></html>
