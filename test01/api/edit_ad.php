<?php
include_once "base.php";
var_dump($_POST['id']);
echo "<br>"."/";
var_dump($_POST['sh']);
foreach ($_POST['id'] as $key => $id) {
    echo $id.'/';
    // echo $_POST['sh'];
    if (!empty($_POST['del']) && in_array($id, $_POST['del'])) {

        $Ad->del($id);
    } else {
        $row = $Ad->find($id);
        $row['text'] = $_POST['text'][$key];
        $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh']));
        // $a=in_array($id, $_POST['sh']);
        $Ad->save($row);
        // echo "<br>"."/";
        // echo $a;
    }
   
}

to("../admin.php?do=ad");
