<?php
include_once "base.php";


// ['img']存取input表單的name ['tmp_name']不能更改，為系統自帶。
if (!empty($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../images/" . $_FILES['img']['name']);
    //$sql = "insert into `title`(`img`,`text`) values('{$_FILES['img']['name']}','{$_POST['text']}')";
    //$pdo->exec($sql);
    $data['img'] = $_FILES['img']['name'];
    $data['text'] = $_POST['text'];
    $Title->save($data);

    to("../admin.php?do=title");
    // header("location:../admin.php?do=title");
}


?>