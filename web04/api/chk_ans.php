<?php include_once "base.php";

if ($_GET['ans'] == $_SESSION['ans']) {
    echo 1;
} else {
    echo 0;
}
