
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
  <h1>お客様情報確認<h1/>
    <?php

try
{
require_once('../common/common.php');

$post=sanitize($_POST);
$member_email=$post['email'];

$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name FROM dat_member WHERE email=?';
$stmt = $dbh->prepare($sql);
$data[] = $member_email;
$stmt->execute($data);

$dbh = null;

$rec = $stmt->fetch(PDO::FETCH_ASSOC);

  if($rec==false)
  {
      echo'登録したメールアドレスが間違っています。<br />';
      echo'正しいアドレスを再度ご入力いただくか、<br />';
      echo'商品購入ページより再度新規会員登録をお願いいたします。<br />';
      echo'<br />';
      echo'<div class="confirm-btn"><a href="password_reset.php">アドレス再入力画面へ</a>';
      echo'<br />';
      echo'<a href="shop_list.php">商品購入ページへ</a></div>';
  }
  else
  {
    session_start();
    $_SESSION['member_login']=1;
    $_SESSION['member_code']=$rec['code'];
    $_SESSION['member_name']=$rec['name'];
    header('Location:password_change.php');
    exit;
  }

}
catch(Exception $e)
{
    echo $e->getMessage();;
    exit();
}

?>
