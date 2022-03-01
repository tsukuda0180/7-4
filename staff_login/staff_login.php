
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>7-1</title>
  <link rel="stylesheet" type="text/css" href="/css/login.css">
</head>


<div class="check">
<h1>管理者ログイン<h1/>

<form method="post" action="staff_login_check.php">
<div class="confirm-contents">
 <div>
<div class="answers">
<div class = "answer">

<div class ="answer-top">
<label>管理者ID</label>
<input type="text" name="code"><br/>
</div>

<div class ="answer-top">
<label>パスワード</label>
<input type="password" name="pass"><br/>
</div>
</div>
</div>

<div class="confirm-btn">
<button id ="btn" class ="btn" type="submit" name="login">ログイン</a></button>
</form>

</html>
