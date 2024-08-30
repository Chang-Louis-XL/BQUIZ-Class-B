<?php include_once "base.php";

$news = $News->find($_POST['id']);
echo $news['title'];
echo "<br>";
echo nl2br($news['article']);
