$(document).ready(function(){
	$("#addnew").click(function(){
		var page_name=$("#page_name").val();
		var page_url=$("#page_url").val();
		var keywords=$("#keywords").val();
		var description=$("#description").val();
		if(page_name==""){
			$("#page_name").css("border","1px solid red");
			$("#page_namespan").text("请填写页面名称").css("color","red");
			$("#page_name").focus();
			return false;
		};
		if(page_url==""){
			$("#page_url").css("border","1px solid red");
			$("#page_urlspan").text("请填写页面地址").css("color","red");
			$("#page_url").focus();
			return false;
		};
		if(keywords==""){
			$("#keywords").css("border","1px solid red");
			$("#art_namespan").text("请填写页面关键字").css("color","red");
			$("#keywords").focus();
			return false;
		};
		if(description==""){
			$("#description").css("border","1px solid red");
			$("#art_namespan").text("请填写页面描述").css("color","red");
			$("#description").focus();
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