<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
    print'ログインされていません。<br />';
    print'<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
}
else
{
}
 ?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>7-1</title>
<link rel="stylesheet" type="text/css" href="/css/list.css">
</head>
<body>

        <div class="check">
        <h1> データダウンロード画面<h1/>
<?php
require_once('../common/common.php');
?>

ダウンロードしたい注文日を選んでください。<br />
<form method="post" action="order_download_done.php">
<?php pulldown_year();?>
年
<?php pulldown_month();?>
月
<?php pulldown_day();?>
日<br />

<br />
<div class="confirm-btn">
<input type="submit" value="ダウンロードへ">

  <input type ="button" onclick = "history.back()" value="戻る">
</div>
</form>

</body>
</html>
