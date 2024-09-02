<?php include_once "base.php";

$news = $News->all(['type' => $_POST['type']]);

// dd($news);

foreach ($news as $n) {
    echo "<p>";
    echo "<a href='javascript:getNews({$n['id']})'>";
    echo $n['title'];
    echo "</a>";
    echo "</p>";
}


