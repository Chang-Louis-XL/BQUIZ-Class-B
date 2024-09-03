<fieldset>
    <legend>帳號管理</legend>
    <table class="tab ct">
        <tr>
            <td class='clo'>帳號</td>
            <td class='clo'>密碼</td>
            <td class='clo'>刪除</td>
        </tr>
        <?php
        $users = $User->all();
        foreach ($users as $user) {
            ?>
            <tr>
                <td><?= $user['acc']; ?></td>
                <!-- str_repeat("*", ...)：這個函數會根據第二個參數指定的次數，重複輸出第一個參數的內容。在這裡，第一個參數是 "*", 也就是星號。
strlen($user['pw'])：這個函數會計算 $user['pw'] 這個字串的長度，也就是用戶密碼的字元數。 -->
                <td><?= str_repeat("*", strlen($user['pw'])); ?></td>
                <td><input type="checkbox" name="del" value="<?= $user['id']; ?>"></td>
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

    <!-- div+table>tr*5>td.clo+td>input:text -->
    <div style="color:red">*請設定您要註冊的帳號及密碼(最長12個字元)</div>
    <table>
        <tr>
            <td class="clo">Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td class="clo">Step2:登入密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td class="clo">Step3:再次確認密碼</td>
            <td><input type="password" name="pw2" id="pw2"></td>
        </tr>
        <tr>
            <td class="clo">Step4:信箱(忘記密碼時使用)</td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
        <tr>
            <td>
                <button onclick="reg()">註冊</button>
                <button onclick="clean()">清除</button>
            </td>
            <td></td>
        </tr>
    </table>

    <script>
        function reg() {
            let user = {
                acc: $("#acc").val(),
                pw: $("#pw").val(),
                pw2: $("#pw2").val(),
                email: $("#email").val(),
            }

            if (user.acc == '' || user.pw == '' || user.pw2 == '' || user.email == '') {
                alert("不可空白")
            } else if (user.pw != user.pw2) {
                alert("密碼錯誤")
            } else {
                $.post('./api/chk_acc.php', {
                    acc: user.acc
                }, (chk) => {
                    if (parseInt(chk) == 1) {
                        alert("帳號重複")
                    } else {
                        $.post("./api/reg.php", user, (res) => {
                            //console.log(res)
                            location.reload()
                        })
                    }
                })
            }

        }

        function del() {
            // $("input[type='checkbox']:checked"): 這是一個 jQuery 選擇器，它會選取頁面中所有 type 為 'checkbox' 並且已被勾選（checked）的 <input> 元素。
            let chks = $("input[type='checkbox']:checked")
            let ids = new Array();
            if (chks.length > 0) {
                for (let i = 0; i < chks.length; i++) {
                    ids.push(chks[i].value)
                    // chks[i]的 i 是一個索引值，表示我們想要訪問 jQuery 物件中的第 i 個元素。這個索引是從 0 開始的，
                    // chks[i] 是一種標準的數組或類數組的訪問語法，這裡用來訪問 chks 物件中的第 i 個 checkbox DOM 節點。
                }
                console.log(ids)
                $.post("./api/del_user.php", {
                    ids
                }, () => {
                    //ids.forEach(id => $(`input[value='${id}']`).parents('tr').remove())
                    location.reload();
                })
            } else {
                alert("沒有帳號要刪除")
            }
        }
    </script>
</fieldset>