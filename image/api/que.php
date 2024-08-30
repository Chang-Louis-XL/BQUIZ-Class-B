<?php
include_once "base.php";;
$Que->save(['text' => $_POST['subject'], 'subject_id' => 0]);
$subject_id = $Que->find(['text' => $_POST['subject']])['id'];

foreach($_POST['options'] as $option){
    $Que->save(['text'=>$option,'subject_id'=>$subject_id]);
}

