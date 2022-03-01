

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

</div>

  <div class="check">
  <h1>商品一覧<h1/>
<?php

try {

$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


$sql = 'SELECT code,name,price FROM mst_product WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt ->execute();

$dbh = null;


while(true)
{
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false)
    {
      break;
    }
    print '<a href="shop_product.php?procode='.$rec['code'].'">';
    print $rec['name'].' --- ';
    print $rec['price'].'円';
    print '</a>';
    print '<br />';
}

print'<br />';
print'<div class="confirm-btn"><a href="shop_cartlook.php">カートを見る</a><br /></div>';

}
 catch (Exception $e)
{
      echo $e->getMessage();
    exit();
}

?>

</body>
</html>
