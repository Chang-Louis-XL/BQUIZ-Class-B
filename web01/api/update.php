<?php
include_once "base.php";
$do = $_POST['table'];
$db = ${ucfirst($do)};

if (!empty($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../images/" . $_FILES['img']['name']);
    $row = $db->find($_POST['id']);
    $row['img'] = $_FILES['img']['name'];
    $db->save($row);
}



to("../admin.php?do=$do");
