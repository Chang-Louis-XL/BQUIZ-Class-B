<div>
    目前位置 : 首頁 > 分類網誌 > <span id="navtype">健康新知</span>
</div>
<div style="display: flex;align-items:start;">
    <fieldset  style="width:150px">
        <legend>分類網誌</legend>
        <a class='type' data-vote="1" style="display:block;margin: 5px;">健康新知</a>
        <a class='type' data-vote="2" style="display:block;margin: 5px;">菸害防治</a>
        <a class='type' data-vote="3" style="display:block;margin: 5px;">癌症防治</a>
        <a class='type' data-vote="4" style="display:block;margin: 5px;">慢性病防治</a>
    </fieldset>
    <fieldset style="width:550px">
        <legend id="newtitle" >文章列表</legend>
        <div id="content"></div>
    </fieldset>
</div>


<script>

gettitle(1)

$(".type").on("click",function(){
    $("#navtype").text($(this).text())
    gettitle($(this).data('vote'))
})

function gettitle(vote){
    $("#content").load("./api/gettitle.php",{
        vote
    })
}

function getnew(id){
$("#content").load("./api/getnew.php",{
    id
})
}


</script>