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

$staff_code=$_GET['staffcode'];

$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password ='1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name FROM mst_staff WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[]=$staff_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$staff_name=$rec['name'];

$dbh = null;

}
catch(Exception $e)
{
  echo $e->getMessage();
  exit();
}
?>

<div class="check">
<h1> スタッフ削除<h1/>
<form method="post" action="staff_delete_done.php">
<input type="hidden" name="code" value="<?php echo $staff_code;?>">

<div class="answers">
<div class = "answer">

<div class ="answer-top"><br/>
<label>管理者コード : </label>
<?php echo $staff_code;?><br/>
</div>

<div class ="answer-top"><br/>
<label>管理者名 :  </label>
<?php echo $staff_name;?><br/>
</div>

<div class ="answer-top"><br/>
 <label>このスタッフを削除してよろしいですか?</label>
 </div>

 <div class="confirm-btn">
  <input type ="button" onclick = "history.back()" value="戻る">
  <input type="submit"  value="OK">
</div>
</body></html>
