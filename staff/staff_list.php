<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>7-1</title>
  <link rel="stylesheet" type="text/css" href="/css/base.css">
  <link rel="stylesheet" type="text/css" href="/css/list.css">
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
  <h1>管理者一覧<h1/>
<?php
try
{
$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password ='1qaz2wsx';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT code,name FROM mst_staff WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$dbh = null;

echo'<form method="post" action="staff_branch.php">';
while(true)
{
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  if($rec==false)
  {
    break;
  }
  echo'<input type = "radio" name = "staffcode" value="'.$rec['code'].'">';
  echo $rec['name'];
  echo'<br/>';
    echo'<br/>';
}
echo'<input type="submit" name="disp" value="参照">';
echo'<input type="submit" name="add" value="追加">';
echo'<input type="submit" name="edit" value="修正">';
echo'<input type="submit" name="delete" value="削除">';
echo'</form>';
}
catch(Exception $e)
{
  echo $e->getMessage();
  exit();
}
?>
</div>
 <div class="confirm-btn">
<a href = "../staff_login/staff_top.php"> トップへ戻る</a><br/>
</div>
</body></html>
