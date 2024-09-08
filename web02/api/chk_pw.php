<?php include_once "base.php";

$chk = $User->count($_POST);
// 這裡的 if($chk) 是在檢查 $chk 的值是否為 "真"。
if ($chk) {
    $_SESSION['user'] = $_POST['acc'];
}

echo $chk;
