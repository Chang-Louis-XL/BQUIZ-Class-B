<?php include_once "base.php"; ?>
<?php
$dsn = "mysql:host=localhost;charset=utf8;dbname=db15";
$pdo = new PDO($dsn, 'root', '');


if (!empty($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../images/" . $_FILES['img']['name']);
    // $sql = "insert into `title`(`img`,`text`) values('{$_FILES['img']['name']}','{$_POST['text']}')";
    // $pdo->exec($sql);
    $Title->save(['img'=> $_FILES['img']['name'],'text'=> $_POST['text']]);
    // header("location:../admin.php?do=title");
}
