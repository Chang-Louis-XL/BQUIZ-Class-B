<fieldset>
    <legend>新增問卷</legend>
    <div style="display:flex">
        <div class="clo" style="width:50%">問卷名稱</div>
        <div style="width:50%"><input type="text" name="subject" id="subject"></div>
    </div>
    <div id="options" class="clo">
        <div>選項<input type="text" name="option" id=""><button onclick="more()">更多</button></div>
    </div>
    <div>
        <button onclick="send()">新增</button>
        <button onclick="clean()">清空</button>
    </div>



</fieldset>

<script>

    function more() {
        $("#options").prepend(`<div>選項<input type="text" name="option"></div>`)
    }


    function send() {
        let options = [];
        $("input[name='option']").each((i, o) => {
            options.push($(o).val())
        })

        let que = {
            subject: $("#subject").val(),
            options
        }

        $.post("./api/que.php", que, (res) => {
            console.log(res)
            // alert("問卷已新增完成")
            // clean()
        })
    }

</script>