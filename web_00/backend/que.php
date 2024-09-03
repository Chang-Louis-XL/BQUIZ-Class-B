<fieldset>
    <legend>新增問卷</legend>
    <div style="display:flex">
        <div class="clo" style="width:50%">問卷名稱</div>
        <div style="width:50%"><input type="text" name="subject" id="subject"></div>
    </div>
    <div id="options" class="clo">
        <div>選項<input type="text" name="" id=""><button onclick="more()">更多</button></div>
    </div>
    <div>
        <button onclick="send()">新增</button>
        <button onclick="clean()">清空</button>
    </div>




</fieldset>

<script>
    funciton more(){
        let opt = `<div>選項<input type="text" name="option"></div>`
        $("#options").prepend(opt)
    }


</script>