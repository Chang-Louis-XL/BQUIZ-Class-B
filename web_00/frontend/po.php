<style>
    .nav1 {}
</style>


<div>
    目前位置: 首頁 > 分類網誌 > <span id="navType">健康新知</span>
</div>

<div class="nav1" style="display: flex;">
    <fieldset style="width:150px;">
        <legend>分類網誌</legend>
        <a class="type" data-type="1" style="display:block;margin:5px">健康新知</a>
        <a class="type" data-type="2" style="display:block;margin:5px">菸害防治</a>
        <a class="type" data-type="3" style="display:block;margin:5px">癌症防治</a>
        <a class="type" data-type="4" style="display:block;margin:5px">慢性病防治</a>
    </fieldset>
    <fieldset style="width:550px">
        <legend id="newsTitles">文章列表</legend>
        <div id="content"></div>
    </fieldset>

</div>

<script>

    getTitles(1)

    $(".type").on("click", function () {
        $("#navType").text($(this).text())
        getTitles($(this).data('type'))
    })

    function getTitles(type) {
        // console.log(type)
        $("#content").load("./api/get_titles.php", {
            type
        })
    }

    function getNews(id) {
        $("#content").load("./api/get_news.php", {
            id
        })
    }



    // function getNews(id) {
    //     $("#content").load("./api/get_news.php", { id }, (res) => {
    //         console.log('res', res);
    //     });
    // }

</script>