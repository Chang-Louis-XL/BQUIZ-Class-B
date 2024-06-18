<?php include_once "base.php"; 
dd($_POST);
foreach ($_POST['id'] as $key => $id) {
    if (!empty($_POST['del']) && in_array($id, $_POST['del'])) {
        // print_r($_POST['del']);
        // echo "<br>";
        // echo $sql ;
        // $pdo->exec($sql);
    } else {
        $row = $Title->find($id);
        $row['text'] = $_POST['text'][$key];
        $row['sh'] = (isset($_POST['sh']) && $_POST['sh'] == $id) ? 1 : 0;

        // print_r($_POST);
        // echo $sql ;   
        print_r(['fine' . $row['text']]);
    }
}

// unset($_POST['table']);

// header("location:../admin.php?do=title");
