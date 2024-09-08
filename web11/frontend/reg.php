<fieldset style="width: 60%;margin:auto">
<legend>會員註冊</legend>
<div style="color: red;">請設定您要註冊的帳號及密碼（最長 12 個字元）</div>
<table>
    <tr>
        <td>Step1:登入帳號</td>
        <td><input type="text" id="acc" name="acc"></td>
    </tr>
    <tr>
        <td>Step2:登入密碼</td>
        <td><input type="text" id="pw" name="pw"></td>
    </tr>
    <tr>
        <td>Step3:再次確認密碼</td>
        <td><input type="text" id="pw2" name="pw2"></td>
    </tr>
    <tr>
        <td>Step4:信箱(忘記密碼時使用)</td>
        <td><input type="text" id="pw" name="pw"></td>
    </tr>
    <tr>
        <td>
            <button onclick="reg()">註冊</button>
            <button onclick="clean()">清除</button>
        </td>
    </tr>
</table>

</fieldset>


<script>

function reg(){
    let user = 
    {acc:$("#acc").val(),
        pw:$("#pw").val(),
        pw2:$("#pw2").val(),
        email:$("#eamil").val(),
    }

    if(user.acc=='' || user.pw=='' || user.pw2=='' || user.eamil==''){
        alert("不可空白");
    }else if(user.pw != user.pw2){
        alert("密碼錯誤");
    }else{
        $.post("./api/chkacc.php",{
           acc:user.acc
        },(chkacc)=>{
            if(chkacc==1){
                alert("帳號重覆");
            }else{
                $.post("./api/reg.php",{
                    user
                },(chk)=>{
                    alert("註冊完成，歡迎加入")
                   
                })
            }
        })
    }

}




</script>