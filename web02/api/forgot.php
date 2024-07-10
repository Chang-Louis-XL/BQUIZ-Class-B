<?php include_once "base.php";

$result = $User->find(['email' => $_GET['email']]);
if (!empty($result)) {
    echo "您的密碼:{$result['pw']}";
} else {
    echo "查無資料";
}
