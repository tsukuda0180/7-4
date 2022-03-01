
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
$member_pass=$post['pass'];

$member_pass=md5($member_pass);

$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT code,name FROM dat_member WHERE email=? AND password=?';
$stmt = $dbh->prepare($sql);
$data[] = $member_email;
$data[] = $member_pass;
$stmt->execute($data);

$dbh = null;

$rec = $stmt->fetch(PDO::FETCH_ASSOC);

  if($rec==false)
  {
      echo'メールアドレスかパスワードが間違っています。<br />';
      echo'<div class="confirm-btn"><a href="member_login.html">戻る</a></div>';
  }
  else
  {
    session_start();
    $_SESSION['member_login']=1;
    $_SESSION['member_code']=$rec['code'];
    $_SESSION['member_name']=$rec['name'];
    header('Location:shop_list.php');
    exit;
  }

}
catch(Exception $e)
{
    echo $e->getMessage();;
    exit();
}

?>
