<?php include_once "base.php";



foreach ($_POST['id'] as $id) {
    // in_array($id, $_POST['del']) 的作用是檢查變數 $id 是否存在於陣列 $_POST['del'] 中
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $News->del($id);
    } else {
        $row = $News->find($id);
        $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
        $News->save($row);
    }
}

to("../back.php?do=news");
