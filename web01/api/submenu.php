<?php
include_once "base.php";
$do = $_POST['table'];
$db = ${ucfirst($do)};

if (isset($_POST['id'])) {
    foreach ($_POST['id'] as $key => $id) {
        if (!empty($_POST['del']) && in_array($id, $_POST['del'])) {
            $db->del($id);
        } else {
            $row = $db->find($id);
            $row['href'] = $_POST['href'][$key];
            $row['text'] = $_POST['text'][$key];
            $db->save($row);
        }
    }
}


if (isset($_POST['text2'])) {
    foreach ($_POST['text2'] as $key => $text) {
        if ($text != '') {
            $db->save([
                'text' => $text,
                'href' => $_POST['href2'][$key],
                'main_id' => $_POST['main_id']
            ]);
        }
    }
}

to("../admin.php?do=$do");
