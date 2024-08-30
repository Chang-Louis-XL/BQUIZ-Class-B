<?php include_once "base.php";

$chk = $Log->count($_POST);
$news = $News->find($_POST['news']);
if ($chk > 0) {
    $Log->del($_POST);
    $news['good']--;
} else {
    $Log->save($_POST);
    $news['good']++;
}

$News->save($news);
