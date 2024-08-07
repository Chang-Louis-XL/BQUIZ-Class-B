<?php
$subject = $Que->find($_GET['id']);
?>
<style>
    .bar {
        height: 25px;
        background-color: #ccc;
    }
</style>
<fieldset>
    <legend>目前位置:首頁 > 問卷調查 > <?= $subject['text']; ?></legend>
    <h4><?= $subject['text']; ?></h4>

    <?php
    /*     if ($subject['vote'] <= 0) {
        echo "<h2 class='ct'>尚無任何投票，請先進行投票</h2>";
        echo "<div class='ct'><a href='?do=vote&id={$subject['id']}'>進行投票</a></div>";
        exit();
    } */
    ?>
    <?php
    $options = $Que->all(['subject_id' => $subject['id']]);
    foreach ($options as $option) {
        $div = ($subject['vote'] <= 0) ? 1 : $subject['vote'];
        $rate = $option['vote'] / $div;
        $show = round($rate, 2) * 100;
        $width = $rate * 75;
        echo "<div style='display:flex;margin: 10px 0'>";
        echo    "<div style='width:50%'>";
        echo    $option['text'];
        echo    "</div>";
        echo    "<div style='width:50%;display:flex'>";
        echo       "<div class='bar' style='width:{$width}%'></div>";
        echo       "<div>{$option['vote']}票({$show}%)</div>";
        echo    "</div>";
        echo "</div>";
    }
    ?>
    <div class="ct">
        <button onclick="location.href='?do=que'">返回</button>
    </div>
</fieldset>