<?php
include_once "base.php";
$do = $_POST['table'];
$db = ${ucfirst($do)};

if (!empty($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../images/" . $_FILES['img']['name']);
    $_POST['img'] = $_FILES['img']['name'];
}
if ($do == 'admin') {
    unset($_POST['pw2']);
}

unset($_POST['table']);
$db->save($_POST);

to("../admin.php?do=$do");
