

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>7-1</title>
<link rel="stylesheet" type="text/css" href="/css/list.css">
</head>
<body>

  <div class = "gest">
  <?php
  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['member_login'])==false)
  {
      print'ようこそゲスト様<br />';
      print'<a href="member_login.html">会員ログイン</a><br />';
      print'<br />';
  }
  else
  {
      print'ようこそ';
      print $_SESSION['member_name'];
      print '様<br />';
      print '<a href="member_logout.php">ログアウト</a><br />';
      print '<br />';
  }
  ?>
<?php

try
{

// 選択された商品「コード」を受け取る
$pro_code=$_GET['procode'];

// DBに接続
$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// 商品「コード」でproductテーブルから1件のレコードを取ってくる
$sql = 'SELECT name,price,gazou FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_price=$rec['price'];
$pro_gazou_name=$rec['gazou'];

$dbh = null;

if($pro_gazou_name=='')
{
      $disp_gazou='';
}
else
{
      $disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
}

echo '<a href="shop_cartin.php?procode='.$pro_code.'">カートに入れる</a><br /><br />';

}catch(Exception $e){
  echo $e->getMessage();
  exit();
}

?>

<!-- PHPはここまで。ここから下はHTMLで記述する。
ここで商品情報画面を表示する。フロントの実装。
商品コードと商品名はPHPの変数の中に入っているので、
<?php 〜?>でPHPの世界を細かく作って表示する。
-->
<div class="check">
<h1>商品情報参照<h1/>
<br />
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
<br />
</div>
<form>
<div class="confirm-btn">
<a href="shop_list.php">商品一覧へ戻る</a>
</div>
</form>

</body>
</html>
