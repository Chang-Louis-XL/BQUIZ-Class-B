<?php include_once "base.php";

// select count(*) from  `logs` where `user`='mem01' && `news`='3'
$chk = $Log->count($_POST);
// select * from `news`  where `id`='1'
$news = $News->find($_POST['news']);
if ($chk > 0) {
    $Log->del($_POST);
    $news['good']--;
} else {
    $Log->save($_POST);
    $news['good']++;
}

$News->save($news);



