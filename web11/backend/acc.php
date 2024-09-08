<fieldset>
    <legend>帳號管理</legend>

    <table class="tab ct">
        <tr>
            <th class="clo">帳號</th>
            <th class="clo">密碼</th>
            <th class="clo">刪除</th>
        </tr>
        <?php
        $users = $User->all();
        foreach ($users as $user) {
        ?>
            <tr>
                <td><?=$user['acc']; ?></td>
                <td><?= str_repeat("*",strlen($user['pw'])) ?></td>
                <td><input type="checkbox" name="del" value="<?=$user['id'] ?>"></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="ct">
        <button onclick="del()">確定刪除</button>
        <button onclick="clean()">清空選取</button>
    </div>

    <h2>新增會員</h2>
    <div style="color: red;">請設定您要註冊的帳號及密碼（最長 12 個字元）</div>
    <table>
    <tr>
        <td class="clo">Step1:登入帳號</td>
        <td><input type="text" id="acc" name="acc"></td>
    </tr>
    <tr>
        <td class="clo">Step2:登入密碼</td>
        <td><input type="text" id="pw" name="pw"></td>
    </tr>
    <tr>
        <td class="clo">Step3:再次確認密碼</td>
        <td><input type="text" id="pw2" name="pw2"></td>
    </tr>
    <tr>
        <td class="clo">Step4:信箱(忘記密碼時使用)</td>
        <td><input type="text" id="pw" name="pw"></td>
    </tr>
    <tr>
        <td>
            <button onclick="reg()">新增</button>
            <button onclick="clean()">清除</button>
        </td>
        <td></td>
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
                    location.href ='index.php'
                })
            }
        })
    }

}


</script>
