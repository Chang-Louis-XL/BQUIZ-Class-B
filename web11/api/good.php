<?php include_once "base.php";

$chk = $Logs->count($_POST);
$news = $News->find($_POST['news']);
if ($chk > 0) {
    $Logs->del($_POST);
    $news['good']--;
} else {
    $Logs->save($_POST);
    $news['good']++;
}

$News->save($news);