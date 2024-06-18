<?php
include_once "base.php";

$Ad->save($_POST);
to("../admin.php?do=ad");
