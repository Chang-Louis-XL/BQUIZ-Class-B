<?php include_once "base.php";

$table = $_GET['table'];
unset($_GET['table']);

if($$table->count($_GET)){
    echo 1;
    $_SESSION[$table]=$_GET['acc'];
}else{
    echo 0;
}
