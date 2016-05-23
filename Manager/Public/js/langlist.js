$(document).ready(function(){
	$("#addnew").click(function(){

	var ad_name=$("#ad_name").val();
	var ad_imgurl=$("#ad_imgurl").val();
	var ad_linkurl=$("#ad_linkurl").val();

	
	//var admin_name=$("#n_bigclass").find("option:selected").text();  获取选中值
	if(ad_name==""){
		$("#ad_name").css("border","1px solid red");
		$("#ad_namespan").text("请填写广告图片名称").css("color","red");
		$("#ad_name").focus();
		return false;
	}else{
		$("#ad_namespan").text("").css("color","red");
	};
	if(ad_imgurl==""){
		$("#ad_imgurl").css("border","1px solid red");
		$("#ad_imgurlspan").text("请上传广告图片").css("color","red");
		$("#ad_imgurl").focus();
		return false;
	}else{
		$("#ad_namespan").text("").css("color","red");
	};
	if(ad_linkurl==""){
		$("#ad_linkurl").css("border","1px solid red");
		$("#ad_linkurlspan").text("请填写广告图片名称").css("color","red");
		$("#ad_linkurl").focus();
		return false;
	}else{
		$("#ad_linkurlspan").text("").css("color","red");
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
	 $("#pricesameas").click(function(){
		var prodprice=$("#prod_price").val();
		if(prodprice!=""){
			$("#prod_oldprice").attr('value',prodprice);
		}
	 });
})