<fieldset style="">
<div>請輸入信箱以查詢密碼</div>
<div><input type="text" id="email" name="email"></div>
<button onclick="find()">尋找</button>
<div id="result"></div>
</fieldset>

<script>
  function find(){
    $.get("./api/forgot.php",{
        email: $("#email").val()
    },(result)=>{
        console.log(result);
        $("#result").text(result)
    })
  }
</script>