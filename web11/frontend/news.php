<div>
    目前位置：首頁 > 最新文章區
</div>
<table class="tab">
    <tr>
        <td width="30%">標題</td>
        <td width="60%">內容</td>
        <td></td>
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
            <td class='title'><?= $n['title']; ?></td>
            <td>
                <div class='short'>
                    <?= mb_substr($n['article'], 0, 30) ?>...
                </div>
                <div class="all" style="display:none">
                    <?= nl2br($n['article']) ?>
                </div>
            </td>
            <td>
                <?php
                if (isset($_SESSION['user'])) {
                    $chk = $Logs->count(['user' => $_SESSION['user'], 'news' => $n['id']]);
                    if ($chk > 0) {
                        echo "<a href='#' data-user='{$_SESSION['user']}' data-news='{$n['id']}' class='good'>";
                        echo "收回讚";
                        echo "</a>";
                    } else {
                        echo "<a href='#' data-user='{$_SESSION['user']}' data-news='{$n['id']}' class='good'>";
                        ;
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
    $(".title").on("click", function () {
        $(this).next().children(".short,.all").toggle();
    })




    $(".good").on('click', function () {
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
                    break;
                case "收回讚":
                    $(this).text("讚")
                    break;
            }
        })

    })






</script>