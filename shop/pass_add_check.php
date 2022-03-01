
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
require_once('../common/common.php');

$post=sanitize($_POST);
$staff_pass=$post['pass'];
$staff_pass2=$post['pass2'];

if($staff_pass=='')
{
  echo'パスワードが入力されていません。<br/>';
}

if($staff_pass!==$staff_pass2)
{
  echo'パスワードが一致しません。<br/>';
}

if($staff_pass==''||$staff_pass!==$staff_pass2)
{
  echo'<form>';
  echo'<input type ="button" onclick = "history.back()" value="戻る">';
  echo'</form>';
}else {
  $staff_pass=md5($staff_pass);
  echo'<form method="post" action="pass_add_done.php">';
  echo'<input type ="hidden" name="pass" value="'.$staff_pass.'">';
  echo'<br/>';
  echo'さきほどの内容で登録してよろしいですか？<br/>';
    echo'<br/>';
      echo'<br/>';
        echo'<div class="confirm-btn"><input type ="button" onclick = "history.back()" value="戻る">';
          echo '<input type="submit"  value="OK"></div>';

  echo'</form>';
}

?>


</body></html>
