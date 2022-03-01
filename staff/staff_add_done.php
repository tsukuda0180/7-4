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
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
</head>

<body>

<?php

try
{

  require_once('../common/common.php');
  $POST=sanitize($_POST);
$staff_name = $_POST['name'];
$staff_pass = $_POST['pass'];

$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password ='1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'INSERT INTO mst_staff(name,password) VALUES (?,?)';
$stmt = $dbh->prepare($sql);
$data[] = $staff_name;
$data[] = $staff_pass;
$stmt->execute($data);

$dbh = null;

// echo $staff_name;
//echo' さんを追加しました。<br/>';

}
catch(Exception $e)
{
  echo $e->getMessage();
  exit();
}
?>

<div class="check">
<h1>追加完了<h1/>

<form method="post" action="staff_login_check.php">
<div class="confirm-contents">
 <div>
<div class="answers">
<div class = "answer">

<div class ="answer-top">
<?php echo $_POST['name'];?>さんを追加しました。
</div>
</div>
</div>

<div class="confirm-btn">
<a href="staff_list.php">管理者一覧へ戻る</a>
</form>

</body></html>
