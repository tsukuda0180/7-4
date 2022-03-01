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
  <h1>追加確認<h1/>

<?php
require_once('../common/common.php');

$post=sanitize($_POST);
$staff_name=$post['name'];
$staff_pass=$post['pass'];
$staff_pass2=$post['pass2'];

if($staff_name=='')
{
  echo'スタッフ名が入力されていません。<br/>';
}else{
  echo'スタッフ名:';
  echo$staff_name;
  echo'さんを追加しますか？';
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
  echo'<input type ="button" onclick = "history.back()" value="戻る"  "width:80px" >';
  echo'</form>';
}else {
  $staff_pass=md5($staff_pass);
  echo'<form method="post" action="staff_add_done.php"  "width:80px">';
  echo'<input type="hidden" name="name" value="'.$staff_name.'">';
  echo'<input type ="hidden" name="pass" value="'.$staff_pass.'">';
  echo'<br/>';
  echo '<div class="confirm-btn"><input type ="button" onclick = "history.back()" value="戻る">';
  echo '<input type="submit"  value="OK" ></div>';
  echo'</form>';
}

?>
</body></html>
