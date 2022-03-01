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
if(isset($_SESSION['cart'])==true)
{
  $cart=$_SESSION['cart'];
  $kazu=$_SESSION['kazu'];
  if(in_array($pro_code,$cart)==true)
  {
    echo'その商品はすでにカートに入っています。<br />';
    echo'<a href="shop_list.php">商品一覧に戻る</a>';
    exit();
  }

}
$cart[]=$pro_code;
$kazu[]=1;
$_SESSION['cart']=$cart;
$_SESSION['kazu']=$kazu;

}
catch(Exception $e)
{
  echo $e->getMessage();
  exit();
}

?>

<div class="check">
<h1>商品追加完了<h1/>
<br />

カートに追加しました。<br />
<br />
</div>

<div class="confirm-btn">
<a href="shop_list.php">商品一覧に戻る</a>
</div>
</body>
</html>
