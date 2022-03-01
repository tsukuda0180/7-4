<?php
    session_start();
    session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>7-1</title>
<link rel="stylesheet" type="text/css" href="/css/base.css">
<link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>

  <div class="check">
  <h1>購入完了通知<h1/>
<?php

try
{

require_once('../common/common.php');

$post=sanitize($_POST);

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];
$chumon=$post['chumon'];
$pass=$post['pass'];
$danjo=$post['danjo'];
$birth=$post['birth'];

echo $onamae.'様<br />';
echo 'ご注文ありがとうございました。<br />';
echo $email.'にメールを送りましたのでご確認ください。<br />';
echo '商品は以下の住所に発送させていただきます。<br />';
echo $postal1.'-'.$postal2.'<br />';
echo $address.'<br />';
echo $tel.'<br />';


$honbun='';
$honbun.=$onamae."様\n\n この度はご注文ありがとうございました。\n";
$honbun.="\n";
$honbun.="ご注文商品\n";
$honbun.="-----------------------------\n";

$cart= $_SESSION['cart'];
$kazu= $_SESSION['kazu'];
$max=count($cart);

$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user ='root';
$password ='1qaz2wsx';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

for($i=0;$i<$max;$i++)
{
    $sql = 'SELECT name,price FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $date[0]=$cart[$i];
    $stmt->execute($date);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    $name = $rec['name'];
    $price = $rec['price'];
    $kakaku[]=$price;
    $suryo = $kazu[$i];
    $shokei = $price * $suryo;

    $honbun.=$name.'';
    $honbun.=$price.'円 ×';
    $honbun.=$suryo.'個 =';
    $honbun.=$shokei."円\n";
}
$sql = 'LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$lastmembercode=0;
if($chumon=='chumontouroku')
{
    $sql = 'INSERT INTO dat_member(password,name,email,postal1,postal2,address,tel,danjo,born)VALUES (?,?,?,?,?,?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data = array();
    $data[]=md5($pass);
    $data[]=$onamae;
    $data[]=$email;
    $data[]=$postal1;
    $data[]=$postal2;
    $data[]=$address;
    $data[]=$tel;
    if($danjo=='dan')
    {
            $data[]=1;
    }
    else
    {
            $data[]=2;
    }
    $data[]=$birth;
    $stmt->execute($data);

    $sql ='SELECT LAST_INSERT_ID()';
    $stmt =$dbh->prepare($sql);
    $stmt->execute();
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastmembercode=$rec['LAST_INSERT_ID()'];
}

$sql ='INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel)VALUES(?,?,?,?,?,?,?)';
$stmt = $dbh->prepare($sql);
$data = array();
$data[]=$lastmembercode;
$data[]=$onamae;
$data[]=$email;
$data[]=$postal1;
$data[]=$postal2;
$data[]=$address;
$data[]=$tel;
$stmt->execute($data);

$sql ='SELECT LAST_INSERT_ID()';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$lastcode=$rec['LAST_INSERT_ID()'];


for($i=0;$i<$max;$i++)
{
    $sql ='INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) VALUES(?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data = array();
    $data[]=$lastcode;
    $data[]=$cart[$i];
    $data[]=$kakaku[$i];
    $data[]=$kazu[$i];
    $stmt->execute($data);
}

$sql = 'UNLOCK TABLES';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$dbh = null;

if($chumon=='chumontouroku')
{
    echo'会員登録が完了しました。<br />';
    echo'次回からメールアドレスとパスワードでログインしてください。<br />';
    echo'ご注文が簡単にできるようになります<br />';
    echo'<br />';
}

$honbun.="送料は無料です。\n";
$honbun.="-----------------------------\n";
$honbun.="\n";
$honbun.="代金は以下の口座にお振り込みください。\n";
$honbun.="クリエイト銀行　東京視点　普通口座　1234567\n";
$honbun.="\n";
$honbun.="------------------------------\n";
$honbun.="日本教育クリエイト\n";
$honbun.="\n";
$honbun.="東京都新宿区～";
$honbun.="電話 000-0000-0000\n";
$honbun.="メール　test@test.co.jp\n";
$honbun.="------------------------------\n";

if($chumon=='chumontouroku')
{
    $honbun.="会員登録が完了しました。\n";
    $honbun.="次回からメールアドレスとパスワードでログインしてください。\n";
    $honbun.="ご注文が簡単にできるようになります。\n";
    $honbun.="\n";
}

 //echo'<br />';
 //echo nl2br($honbun);

$title ='ご注文ありがとうございます。';
$header = 'From:test@test.co.jp';
$honbun =html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');

$title ='お客様からのご注文がありました。';
$header = 'From:'.$email;
$honbun =html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');

}
catch(Exception $e)
{
    echo $e->getMessage();
    exit();
}
?>
<br />
<div class="confirm-btn">
<a href="shop_list.php">商品画面へ</a>
</div>
</div>
</body>
</html>
