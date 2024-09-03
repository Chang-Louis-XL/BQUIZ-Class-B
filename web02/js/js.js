// JavaScript Document
function lo(th,url)
{
	$.ajax(url,{cache:false,success: function(x){$(th).html(x)}})
}
/* function good(id,type,user)
{
	$.post("back.php?do=good&type="+type,{id,user},function()
	{
		if(type=="1")
		{
			$("#vie"+id).text($("#vie"+id).text()*1+1)
			$("#good"+id).text("收回讚").attr("onclick","good('"+id+"','2','"+user+"')")
		}
		else
		{
			$("#vie"+id).text($("#vie"+id).text()*1-1)
			$("#good"+id).text("讚").attr("onclick","good('"+id+"','1','"+user+"')")
		}
	})
}
 */
function clean(){

	$("input[type='text'],input[type='password']").val("")
	// 当使用两个参数调用 prop() 时，它将为所有匹配的元素设置指定的属性及其值。
	$("input[type='checkbox']").prop('checked',false)
}