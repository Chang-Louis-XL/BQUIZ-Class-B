<fieldset>
    <legend>忘記密碼</legend>
    <div>請輸入信箱以查詢密碼</div>
    <div><input type="text" name="email" id="email"></div>
    <div id="result"></div>
    <button onclick="find()">尋找</button>

</fieldset>



<script>

function find(){
    $.post("./api/forgot.php",{
        email:$("#email").val()
    },(result)=>{
        console.log(result)
        $("#result").text(result)
    })
}


</script>