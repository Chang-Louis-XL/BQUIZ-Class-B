<fieldset>
    <form action="./api/edit_news.php" method="post">
        <table class="tab">
            <tr>
                <th>編號</th>
                <th width="60%">標題</th>
                <th>顯示</th>
                <th>刪除</th>
            </tr>
            <?php
            $total = $News->count();
            $div = 3;
            $pages = ceil($total / $div);
            $now = $_GET['p'] ?? 1;
            $start = ($now - 1) * $div;
            $row = $News->all(" limit $start,$div");
            foreach ($row as $idx => $a) {

                ?>
                <tr>
                    <td><?= $idx + 1 ?></td>
                    <td><?= $a['title'] ?></td>
                    <td><input type="checkbox" name="sh[]" value="<?= $a['id'] ?>" <?= ($a['sh'] == 1) ? "checked" : ""; ?>>
                    </td>
                    <td><input type="checkbox" name="del[]" value="<?= $a['id'] ?>"></td>
                    <input type="hidden" name="id[]" value="<?= $a['id'] ?>">
                </tr>
                <?php
            }
            ?>

        </table>
        <div class="ct">
            <?php
            if ($now - 1 > 0) {
                $prev = $now - 1;
                echo "<a href='?do=news&p=$prev'> < </a>";
            }

            // echo $pages;
            
            for ($i = 1; $i <= $pages; $i++) {
                $font = ($i == $now) ? '20px' : '16px';
                echo "<a href='?do=news&p=$i' style='font-size:$font;'> $i </a>";
            }


            if ($now + 1 <= $pages) {
                $next = $now + 1;
                echo "<a href='?do=news&p=$next'> > </a>";
            }

            ?>
        </div>

        <div class="ct"><input type="submit" value="確定修改"></div>
    </form>

</fieldset>