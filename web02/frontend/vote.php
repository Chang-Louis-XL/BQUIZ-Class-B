<?php
$subject = $Que->find($_GET['id']);
?>
<fieldset>
    <legend>目前位置:首頁 > 問卷調查 > <?= $subject['text']; ?></legend>
    <h4><?= $subject['text']; ?></h4>
    <?php
    $options = $Que->all(['subject_id' => $subject['id']]);
    foreach ($options as $option) {
        echo "<p>";
        echo "<input type='radio' name='opt' value='{$option['id']}'>";
        echo $option['text'];
        echo "</p>";
    }
    ?>
    <div class="ct">
        <button onclick='vote()'>我要投票</button>
    </div>
</fieldset>
<script>
    function vote() {
        let vote = $("input[type='radio']:checked").val()
        $.post("./api/vote.php", {
            vote
        }, () => {
            location.href = "?do=result&id=<?= $subject['id']; ?>"
        })
    }
</script>