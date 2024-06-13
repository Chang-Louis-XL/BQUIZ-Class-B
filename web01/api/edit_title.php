<?php
include_once "base.php";

foreach ($_POST['id'] as $key => $id) {
    // in_array($id, $_POST['del']如果陣列中有id值中有del
    if (!empty($_POST['del']) && in_array($id, $_POST['del'])) {
        // $sql = "delete from `title` where id='$id'";
        // echo $sql;
        // $pdo->exec($sql);
        $Title->del($id);

    } else {
        if (isset($_POST['sh']) && $_POST['sh'] == $id) {
            $sql = "update `title` set `text`='{$_POST['text'][$key]}',`sh`='1' where id='$id'";
        } else
        // $sql = "update `title` set `text`='{$_POST['text'][$key]}',`sh`='0' where id='$id'";
        // echo $sql;
        // $pdo->exec($sql);
        $row = $Title->find($id);
        $row['text'] = $_POST['text'][$key];
        $row['sh'] = (isset($_POST['sh']) && $_POST['sh'] == $id) ? 1 : 0;
        
        var_dump($row);
        $Title->save($row);
    }
}

header("location:../admin.php?do=title");
