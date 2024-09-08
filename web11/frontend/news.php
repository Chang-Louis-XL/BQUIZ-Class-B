<div>
    目前位置：首頁 > 最新文章區
</div>
<table>
    <tr>
        <td style="width:30%">標題</td>
        <td style="width:60%">內容</td>
        <td></td>
    </tr>
    <?php
    $total = $News->count(['sh' => 1]);
    $div = 5;
    $pages = ceil($total / $div);
    $now = $_GET['p'] ?? 1;
    $start = ($now - 1) * $div;
    $row = $News->all(['sh' => 1], "limit $start,$div");
    foreach ($row as $n){
    ?>
    <tr>
        <td class='title'><?=$n['title']; ?></td>
        <td class='short'>
            <?= mb_substr($n['text'],0,30) ?>...
        </td>
        <td style="display:none">
            <?=  nl2br($n['text']) ?>
        </td>
    </tr>
    <?php
    }
    ?>
    <div>



</table>