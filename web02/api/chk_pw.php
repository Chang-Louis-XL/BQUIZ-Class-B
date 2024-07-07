<?php include_once "base.php";

$chk = $User->count($_POST);

// 如果count=1帶進來if就為true
if ($chk) {
    $_SESSION['user'] = $_POST['acc'];
}

echo $chk;