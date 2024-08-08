<h2>第一次購物</h2>
<a href="Javascript:location.href='?do=reg'">
    <img src="./icon/0413.jpg">
</a>

<h2>會員登入</h2>
<!--table.all>tr*3>td.tt.ct+td.pp>input:text -->
<table class="all">
    <tr>
        <td class="tt ct">帳號</td>
        <td class="pp"><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
        <td class="tt ct">密碼</td>
        <td class="pp"><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td class="tt ct">驗證碼</td>
        <td class="pp">
            <?php
            $a = rand(10, 99);
            $b = rand(10, 99);
            $_SESSION['ans'] = $a + $b;
            echo $a . " + " . $b . " = ";
            ?>
            <input type="text" name="ans" id="ans">
        </td>
    </tr>
</table>
<div class="ct"><button onclick="login()">確認</button></div>
<script>
    function login() {
        $.get("./api/chk_ans.php", {
            ans: $("#ans").val()
        }, (chk) => {
            if (parseInt(chk)) {
                $.get("./api/chk_pw.php", {
                    table: 'Mem',
                    acc: $("#acc").val(),
                    pw: $("#pw").val()
                }, (chk) => {

                    if (parseInt(chk)) {
                        location.href = "index.php";
                    } else {
                        alert("帳號或密碼錯誤");
                    }
                })
            } else {
                alert("對不起，你輸入的驗證碼有誤，請您重新輸入");
            }
        })
    }
</script>