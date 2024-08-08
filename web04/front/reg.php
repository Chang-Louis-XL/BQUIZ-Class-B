<!-- h2.ct+table.all>tr*6>td.tt.ct+td.pp>input:text -->
<h2 class="ct">會員註冊</h2>
<table class="all">
    <tr>
        <td class="tt ct">姓名</td>
        <td class="pp"><input type="text" name="name" id="name"></td>
    </tr>
    <tr>
        <td class="tt ct">帳號</td>
        <td class="pp">
            <input type="text" name="acc" id="acc">
            <button onclick="chk()">檢測帳號</button>
        </td>
    </tr>
    <tr>
        <td class="tt ct">密碼</td>
        <td class="pp"><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td class="tt ct">電話</td>
        <td class="pp"><input type="text" name="tel" id="tel"></td>
    </tr>
    <tr>
        <td class="tt ct">住址</td>
        <td class="pp"><input type="text" name="addr" id="addr"></td>
    </tr>
    <tr>
        <td class="tt ct">電子信箱</td>
        <td class="pp"><input type="text" name="email" id="email"></td>
    </tr>
</table>
<div class="ct">
    <button onclick='reg()'>註冊</button>
    <button>重置</button>
</div>

<script>
    function chk() {
        $.post("api/chk_acc.php", {
            acc: $("#acc").val()
        }, (chk) => {
            if (parseInt(chk) == 1 || $("#acc").val() == "admin") {
                alert("帳號重複");
            } else {
                alert("此帳號可使用");
            }
        })
    }

    function reg() {
        let info = {
            name: $("#name").val(),
            acc: $("#acc").val(),
            pw: $("#pw").val(),
            tel: $("#tel").val(),
            addr: $("#addr").val(),
            email: $("#email").val(),
        }
        $.post("api/chk_acc.php", {
            acc: info.acc
        }, (chk) => {

            if (parseInt(chk) == 1 || info.acc == "admin") {
                alert("帳號重複");
            } else {
                $.post("api/add_user.php", info, () => {
                    location.href = "?do=login";
                })
            }
        })
    }
</script>