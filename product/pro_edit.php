

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>7-1</title>
  <link rel="stylesheet" type="text/css" href="/css/list.css">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
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
    <h1>商品修正</h1>
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
$pro_gazou_name_old=$rec['gazou'];

$dbh = null;

if($pro_gazou_name_old==""){
  $disp_gazou='';
}else{
  $disp_gazou='<img src="./gazou/'.$pro_gazou_name_old.'">';
}
}
catch(Exception $e)
{
  echo $e->getMessage();
  exit();
}
?>


<br/>
<div class ="answer-top">
商品コード :
<?php echo $pro_code;?>
</div>

<div class ="answer-top">
<form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
<input type="hidden" name="code" value="<?php echo $pro_code;?>">
<input type="hidden" name="gazou_name_old" value="<?php echo $pro_gazou_name_old;?>">
</div>

<div class ="answer-top">
商品名 :
 <input type ="text" name = "name" style="width:200px" value="<?php echo $pro_name;?>">
</div>

<div class ="answer-top">
  価格 :
  <input type ="text" name = "price" style="width:100px" value="<?php echo $pro_price;?>">円
</br></div>

  <div class ="answer-top">
  <?php echo $disp_gazou;?>
   画像を選んでください<br/>
 <input type =file name = "gazou" style="width:400px"></br>
</div>

 <div class="confirm-btn">
  <input type ="button" onclick = "history.back()" value="戻る">
  <input type="submit"  value="OK"></div>

</body></html>
