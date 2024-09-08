<?php include_once "base.php";

$news = $News->all(['vote'=>$_POST['vote']]);


// echo $News->all(['vote'=>$_POST['vote']]);

foreach ($news as $n){
    echo "<p>";
    echo "<a href='javascript:getnew({$n['id']})'>";
    echo $n['title'];
    echo "</a>";
    echo "</p>";
}