<?php include_once "base.php";

$vote = $_POST['vote'];
$que = $Que->find($vote);
$que['vote']++;

$subject = $Que->find($que['subject_id']);
$subject['vote']++;

$Que->save($subject);
$Que->save($que);
