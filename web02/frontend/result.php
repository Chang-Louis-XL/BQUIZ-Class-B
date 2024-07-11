<?php
$subject = $Que->find($_GET['id']);
?>
<fieldset>
    <legend>目前位置:首頁 > 問卷調查 > <?= $subject['text']; ?></legend>
    <h4><?= $subject['text']; ?></h4>
    <?php
    $options = $Que->all(['subject_id' => $subject['id']]);
    foreach ($options as $option) {
        $rate = $option['vote'] / $subject['vote'];
        $show = round($rate, 2) * 100;
        echo "<div style='display:flex'>";
        echo "<div style='width:50%'>";
        echo $option['text'];
        echo "</div>";
        echo "<div style='width:50%'>";
        echo "<div class='bar'></div>";
        echo "<div>{$option['vote']}票({$show}%)</div>";
        echo "</div>";
        echo "</div>";
    }
    ?>
    <div class="ct">
        <button onclick="location.href='?do=que'">返回</button>
    </div>
</fieldset>