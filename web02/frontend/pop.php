<div>
    目前位置：首頁 > 人氣文章區
</div>
<table class="pop">
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
    //     select *: 選取 news 資料表中的所有欄位。
// from 'news': 從 news 資料表中取得資料。
// where `sh` = '1': 篩選出 sh 欄位值為 '1' 的資料列。
// ORDER BY 'news'.'good' DESC: 根據 good 欄位進行降序排序，DESC 表示由高到低排序。
// limit 0,5: 只取出前 5 筆資料（從第 0 筆開始）。
    $rows = $News->all(['sh' => 1], " ORDER BY `good` desc limit $start,$div");
    foreach ($rows as $idx => $row) {
        ?>
        <tr>
            <td class='pop-header'><?= $row['title']; ?></td>
            <td class='pop-header'>
                <div class="short">
                    <?= mb_substr($row['article'], 0, 30); ?>
                </div>
                <div class="alert">
                    <div style='font-size:20px;color:skyblue'>
                        <?php
                        $type = ['', '健康新知', '菸害防治', '癌症防治', '慢性病防治'];
                        echo $type[$row['type']];
                        ?>
                    </div>
                    <?= nl2br($row['article']); ?>
                </div>
            </td>
            <td>
                <span class='num'><?= $row['good']; ?></span>個人說
                <img src="./icon/02B03.jpg" style="width:20px;">
                <?php
                if (isset($_SESSION['user'])) {
                    $chk = $Log->count(['user' => $_SESSION['user'], 'news' => $row['id']]);
                    if ($chk > 0) {
                        echo "-<a href='#' data-user='{$_SESSION['user']}' data-news='{$row['id']}' class='good'>";
                        echo "收回讚";
                        echo "</a>";
                    } else {
                        echo "-<a href='#' data-user='{$_SESSION['user']}' data-news='{$row['id']}' class='good'>";
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
        echo "<a href='?do=pop&p=$prev'> < </a>";
    }

    for ($i = 1; $i <= $pages; $i++) {
        $font = ($i == $now) ? '20px' : '16px';
        echo "<a href='?do=pop&p=$i' style='font-size:$font;'> $i </a>";
    }

    if ($now + 1 <= $pages) {
        $next = $now + 1;
        echo "<a href='?do=pop&p=$next'> > </a>";
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
        },

    )
    $(".good").on("click", function () {
        // siblings() 方法用来选择当前元素的所有兄弟元素（同一父元素的其他子元素）。'.num' 是一个选择器，它进一步过滤兄弟元素，仅选择具有 class="num" 的兄弟元素。  
        // * 1: 乘以 1 是一种常见的技巧，用来将字符串转换为数字。                 
        let num = $(this).siblings('.num').text() * 1;
        let data = {
            user: $(this).data('user'),
            news: $(this).data('news')
        }
        $.post("./api/good.php", data, () => {
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