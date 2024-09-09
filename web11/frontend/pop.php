<div>
    目前位置：首頁 > 最新文章區
</div>
<table>
    <tr>
        <td width="30%">標題</td>
        <td width="50%">內容</td>
        <td>人氣</td>
    </tr>
    <?php
    $total = $News->count(['sh' => 1]);
    $div = 5;
    $pages = ceil($total / $div);
    $now = $_GET['p'] ?? 1;
    $start = ($now - 1) * $div;
    $row = $News->all(['sh' => 1], "limit $start,$div");
    foreach ($row as $n) {
        ?>
        <tr>
            <td class='pop-header'><?= $n['title']; ?></td>
            <td class="pop-header">
                <div class='short'>
                    <?= mb_substr($n['article'], 0, 30) ?>...
                </div>
                <div class="alert">
                    <div style="font-size:20px;color:skyblue">
                        <?php
                        $type = ['', '健康新知', '菸害防治', '癌症防治', '慢性病防治'];
                        echo $type[$n['type']];
                        ?>
                    </div>
                    <?= nl2br($n['article']) ?>
                </div>
            </td>
            <td>
                <span class="num"><?= $n['good'] ?></span>個人說
                <img src="./icon/02B03.jpg" style="width:20px;">
                <?php
                if (isset($_SESSION['user'])) {
                    $chk = $Logs->count(['user' => $_SESSION['user'], 'news' => $n['id']]);
                    if ($chk > 0) {
                        echo "-<a href='#' data-user='{$_SESSION['user']}' data-news='{$n['id']}' class='good'>";
                        echo "收回讚";
                        echo "</a>";
                    } else {
                        echo "-<a href='#' data-user='{$_SESSION['user']}' data-news='{$n['id']}' class='good'>";
                        echo "讚";
                        echo "</a>";
                    }
                }
                ?>

            </td>
        </tr>
        <?php
    }
    ?>
</table>
<div>

    <?php

    if ($now - 1 > 0) {
        $prev = $now - 1;
        echo "<a href='?do=news&p=$prev'> < </a>";
    }

    for ($i = 1; $i <= $pages; $i++) {
        $font = ($i == $now) ? '20px' : '16px';
        echo "<a style='font-size:$font;' href='?do=news&p=$i'> $i </a>";
    }


    if ($now + 1 <= $pages) {
        $next = $now + 1;
        echo "<a href='?do=news&p=$next'> > </a>";
    }

    ?>
</div>

<script>

    $(".pop-header").hover(
        function () {
            $(this).parent().find('.alert').show()
        },
        function () {
            $(this).parent().find('.alert').hide()
        }
    )


    $(".good").on('click', function () {
        let num = $(this).siblings('.num').text() * 1;
        let data = {
            user: $(this).data('user'),
            news: $(this).data('news')
        }
        console.log(data);
        $.post("./api/good.php", data, (res) => {
            console.log(res);
            switch ($(this).text()) {
                case "讚":
                    $(this).text("收回讚")
                    $(this).siblings('.num').text(num + 1)
                    break;
                case "收回讚":
                    $(this).text("讚")
                    $(this).siblings('.num').text(num - 1)
                    break;
            }
        })

    })






</script>