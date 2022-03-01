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
  <link rel="stylesheet" type="text/css" href="/css/list.css">
</head>

<body>
<div class="check">
<h1>商品編集<h1/>
<?php

require_once('../common/common.php');
$post=sanitize($_POST);
$pro_code=$post['code'];
$pro_name=$post['name'];
$pro_price=$post['price'];
$pro_gazou_name_old=$post['gazou_name_old'];
$pro_gazou=$_FILES['gazou'];


if($pro_name==''){
  echo'商品名が入力されていません。<br/>';
}else{
  echo'商品名:';
  echo$pro_name;
  echo'<br/>';
}

if(preg_match('/\A[0-9]+\z/',$pro_price)==0)
{
  echo'きちんと価格を入力してください。<br/>';
}
else {
  echo'価格:';
  echo$pro_price;
  echo'円<br/>';
}

if($pro_gazou['size'] > 0){
  if($pro_gazou['size'] > 1000000){
    echo '画像が大きすぎます';
  }
  else {
    move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
    echo'<img src="./gazou/'.$pro_gazou['name'].'">';
    echo '<br/>';
  }
}

if($pro_name==''||preg_match('/\A[0-9]+\z/',$pro_price)==0||$pro_gazou['size']>100000)
{
  echo '<form>';
  echo '<input type="button"  onclick = "history.back()" value="戻る">';
  echo '</form>';
}


else {
  echo '上記のように変更します。<br/>';
  echo '<form method="post" action="pro_edit_done.php">';
  echo '<input type="hidden" name="code" value="'.$pro_code.'">';
  echo '<input type="hidden" name="name" value="'.$pro_name.'">';
  echo '<input type ="hidden" name="price" value="'.$pro_price.'">';
  echo '<input type ="hidden" name="gazou_name_old" value="'.$pro_gazou_name_old.'">';
  echo '<input type ="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
  echo '<br/>';
  echo '<div class="confirm-btn"><input type ="button" onclick = "history.back()" value="戻る">';
  echo '<input type="submit"  value="OK"></div>';
  echo '</form>';
}

?>
</body></html>
