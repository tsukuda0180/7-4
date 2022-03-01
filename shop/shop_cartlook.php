
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

<?php

try
{

if(isset($_SESSION['cart'])==true)
{
  $cart= $_SESSION['cart'];
  $kazu= $_SESSION['kazu'];
  $max=count($cart);
}
else
{
  $max=0;
}

if($max==0)
{
  echo'<div class="check"><h1>カートに商品がありません。</h1><br />';
  echo'<br />';
  echo'<div class="confirm-btn"><a href="shop_list.php">商品一覧へ戻る</a></div>';
  exit();
}

// DBに接続
$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

foreach($cart as $key => $val)
{
    $sql = 'SELECT code,name,price,gazou FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[0]=$val;
    $stmt->execute($data);

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

    $pro_name[] = $rec['name'];
    $pro_price[] = $rec['price'];
    if($rec['gazou']=='')
    {
      $pro_gazou[]='';
    }
    else
    {
      $pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'">';
    }
}
$dbh = null;


}catch(Exception $e){
  echo $e->getMessage();
  exit();
}

?>
<div class="check">
<h1>カートの中身<h1/>

<form method="post" action="kazu_change.php">
<table border="1">
<tr>
<td>商品</td>
<td>商品画像</td>
<td>価格</td>
<td>数量</td>
<td>小計</td>
<td>削除</td>
</tr>
<?php for($i=0;$i<$max;$i++)
  {
?>
<tr>
  <td><?php echo $pro_name[$i]; ?></td>
  <td><?php echo $pro_gazou[$i]; ?></td>
  <td>¥<?php echo $pro_price[$i]; ?></td>
  <td><input type="text" name="kazu<?php echo $i;?>" value="<?php echo $kazu[$i];?>"></td>
  <td>¥<?php echo $pro_price[$i]*$kazu[$i];?></td>
  <td><input type="checkbox" name="sakujo<?php echo $i; ?>"></td>
</td>
<?php
  }
?>
</table>

<div class="btn">
<input type="hidden" name="max" value="<?php echo $max;?>"><br /><br />
<input type="submit" value="数量変更">
<input type="button" onclick="history.back()" value="前の画面に戻る">

</form></div>
</div>
<div class="confirm-btn">
<a href='shop_form.html'>ご購入手続きへ<br />進む</a><br />

<?php
    if(isset($_SESSION["member_login"])==true)
    {
        echo'<a href="shop_kantan_check.php">会員かんたん注文<br />ヘ進む</a><br />';
    }
?>
</div>

</body>
</html>
