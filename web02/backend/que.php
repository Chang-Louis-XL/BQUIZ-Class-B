<fieldset>
    <legend>新增問卷</legend>
    <div style="display:flex">
        <div class="clo" style="width:50%">問卷名稱</div>
        <div style="width:50%">
            <input type="text" name="subject" id="subject">
        </div>
    </div>
    <div id="options" class='clo'>
        <div>
            選項 <input type="text" name="option">
            <button onclick="more()">更多</button>
        </div>
    </div>
    <div>
        <button onclick="send()">新增</button>|
        <button onclick="clean()">清空</button>
    </div>
</fieldset>
<script>
    function more() {
        let opt = `<div>
                    選項 <input type="text" name="option">
                </div>`
        // prepend() 方法用于向被选中的元素内的开头位置插入指定的 HTML 内容。
        $("#options").prepend(opt)
    }

    function send() {
        // 这种方式创建数组的效果和 let options = []; 是一样的。
        let options = new Array();
        // i: 0（第一个元素的索引）
        // o: 第一个复选框 <input type="checkbox" name="option" value="">
        $("input[name='option']").each((i, o) => {
            options.push($(o).val())
        })
        let que = {
            subject: $("#subject").val(),
            options
        }
        $.post("./api/que.php", que, () => {
            alert("問卷已新增完成")
            clear()
        })
    }


</script>