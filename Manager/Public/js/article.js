$(document).ready(function(){
	$("#addnew").click(function(){
		var art_name=$("#art_name").val();
		if(art_name==""){
			$("#art_name").css("border","1px solid red");
			$("#art_namespan").text("请填写产品名称").css("color","red");
			$("#art_name").focus();
			return false;
		};
	})	
	$("#search").click(function(){
		var keyword=$("#keyword").val()
		if ($("#keyword").val()==""){
		alert("请输入关键词！");
		return false;
		}else{
		window.location='?action=listbysc&keyword='+keyword;
		}
	 });
})
