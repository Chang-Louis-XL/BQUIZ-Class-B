
<fieldset style="width:60%;margin: 20px auto" >
<legend>會員登入</legend>

<table>
    <tr>
        <td>帳號:</td>
        <td><input type="text" id="acc" name="acc"></td>
    </tr>
    <tr>
        <td>密碼:</td>
        <td><input type="text" id="pw" name="pw"></td>
    </tr>
    <tr>
        <td>
            <button onclick="login()">登入</button>
            <button onclick="clean()">清除</button>
        </td>
        <td>
        <a href="?do=forgot">忘記密碼</a>
        <a href="?do=reg">尚未註冊</a>
        </td>
    </tr>
</table>
</fieldset>

<script>
function login(){
    
    $.post("./api/chkacc.php",{
        acc:$("#acc").val()
    },(chkacc)=>{
        console.log('acc',chkacc);
        if(parseInt(chkacc)){
            $.post("./api/chkpw.php",{
                acc:$("#acc").val(),
                pw:$("#pw").val()
            },(chkpw)=>{
                if(parseInt(chkpw)){
                    if($('#acc').val()=='admin'){
                        location.href = 'back.php'
                    } else{
                        location.href ='index.php'
                    }
                }else{
                    alert("密碼錯誤")
                }
            })
        }else{
            alert("查無帳號")
        }
    })



}


</script>