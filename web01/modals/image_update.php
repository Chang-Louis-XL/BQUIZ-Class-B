<h3 class='cent'>更新圖片</h3>
<hr>

<form action="./api/update.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>校園映像圖片：</td>
            <td><input type="file" name="img" id="img"></td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name='id' value="<?= $_GET['id']; ?>">
                <input type="hidden" name="table" value='mvim'>
                <input type="submit" value="更新">
                <input type="reset" value="重置">
            </td>
            <td></td>
        </tr>
    </table>
</form>