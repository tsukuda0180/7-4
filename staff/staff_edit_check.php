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
  <div class="check">
  <h1>修正内容確認<h1/>

<?php

require_once('../common/common.php');
$POST=sanitize($_POST);
$staff_code=$_POST['code'];
$staff_name=$_POST['name'];
$staff_pass=$_POST['pass'];
$staff_pass2=$_POST['pass2'];

if($staff_name=='')
{
  echo'スタッフ名が入力されていません。<br/>';
}else{
  echo'スタッフ名:';
  echo$staff_name;
  echo'<br/>';
}

if($staff_pass=='')
{
  echo'パスワードが入力されていません。<br/>';
}

if($staff_pass!==$staff_pass2)
{
  echo'パスワードが一致しません。<br/>';
}

if($staff_name==''||$staff_pass==''||$staff_pass!==$staff_pass2)
{
  echo'<form>';
  echo'<input type ="button" onclick = "history.back()" value="戻る">';
  echo'</form>';
}else {
  $staff_pass=md5($staff_pass);
  echo'<form method="post" action="staff_edit_done.php">';
  echo'<input type="hidden" name="code" value="'.$staff_code.'">';
  echo'<input type="hidden" name="name" value="'.$staff_name.'">';
  echo'修正内容を受け付けました。登録しますか？';
  echo'<br/>';
  echo'<input type ="hidden" name="pass" value="'.$staff_pass.'">';
  echo'<br/>';
  echo '<div class="confirm-btn"><input type ="button" onclick = "history.back()" value="戻る">';
echo'<br/>';
  echo '<input type="submit"  value="OK">';
  echo'</form>';
}

?>
</body></html>
