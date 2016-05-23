$(document).ready(function(){
	$("#addnew").click(function(){
		var ma_password=$("#ma_password").val();
		//var ma_username=$("#n_bigclass").find("option:selected").text(); 
		var ma_username=$("#ma_username").val(); 
		var nt_phone=$("#nt_phone").val();
		var ma_email=$("#ma_email").val();
		var fps_intro=$("#fps_intro").val();
		var news_type=$("#news_type").val();
		var admin_pwdchk=$("#admin_pwdchk").val();
		if(ma_password==""){
			$("#ma_password").css("border","1px solid red");
			$("#ma_password").focus();
			return false;
		}
		if(admin_pwdchk!=ma_password){
			$("#admin_pwdchk").css("border","1px solid red");
			$("#admin_pwdchk").focus();
			return false;	
		}
		if(ma_username==""){
			$("#ma_username").css("border","1px solid red");
			$("#ma_username").focus();
			return false;
		}
	
		if(ma_email==""){
			$("#ma_email").css("border","1px solid red");
			$("#ma_email").focus();
			return false;
		}
		
	})	
	$("#search").click(function(){
	var keyword=$("#keyword").val()
		if ($("#keyword").val()==""){
		alert("请输入关键词！");
		return false;
		}else{
		window.location='?action=listbysc&keyword='+keyword;
		}
	 })
})