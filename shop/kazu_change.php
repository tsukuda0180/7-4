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

    <?php
        session_start();
        session_regenerate_id(true);

        require_once('../common/common.php');

        $post=sanitize($_POST);

        $max=$post['max'];
        for($i=0;$i<$max;$i++)
        {
            if(preg_match("/\A[0-9]+\z/",$post['kazu'.$i])==0)
            {
                echo'<h1>数量に誤りがございます。</h1>';
                echo'<div class="confirm-btn"><a href="shop_cartlook.php">カートに戻る</a></div>';
                exit();
            }
            if($post['kazu'.$i]<1||10<$post['kazu'.$i])
            {
                echo'<h1>数量は必ず1個以上、10個までです。</h1>';
                echo'<div class="confirm-btn"><a href="shop_cartlook.php">カートに戻る</a></div>';
                exit();
            }
            $kazu[]=$post['kazu'.$i];
        }

        $cart=$_SESSION['cart'];

        for($i=$max;0<=$i;$i--)
        {
            if(isset($_POST['sakujo'.$i])==true)
            {
                array_splice($cart,$i,1);
                array_splice($kazu,$i,1);
            }
        }

        $_SESSION['cart']=$cart;
        $_SESSION['kazu']=$kazu;

        header('Location: shop_cartlook.php');
        exit();
?>
