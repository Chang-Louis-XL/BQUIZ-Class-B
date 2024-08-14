<fieldset stlyle="width:60%;margin:20px auto">
    <legend>會員登入</legend>
    <table>
        <tr>
            <td>帳號</td>
            <td></td>
        </tr>
        <tr>
            <td>密碼</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <button onclick="login()">登入</button>
                <button onclick="clear()">清除</button>
            </td>
            <td>
                <a href="?do=forget">忘記密碼</a>
                <a href="?do=reg">尚未註冊</a>
            </td>
        </tr>
    </table>
</fieldset>
<script>
    function login() {
        $.post('./api/chk_acc.php', {
            acc: $("#acc").val()
        }, (chkAcc) => {
            if (parseInt(chkAcc) == 1) {
                $.post("./api/chk_pw.php", {
                    acc: $("#acc").val(),
                    pw: $("#pw").val()
                },(chkPw)=> {
                    if(parseInt(chkPw)){
                        if($("#acc").val()=='admin'){
                            location.href='back.php'
                        }else{
                            location.href='index.php'
                        }
                    }else{
                        alert("密碼錯誤")
                    }else{
                        alert("查無帳號")
                    }
                }
                )
            }
        }
        )
    }

</script>