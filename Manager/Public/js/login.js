if (top.location != self.location)top.location=self.location; //防止被框架
$(document).ready(function(){
	$("#weblogin").click(function(){
	  var UserName=$("#UserName").val();
	  var Password=$("#Password").val();
	  var VerifyCode=$("#VerifyCode").val();
	  if(UserName==""){
		  $("#UserName").css("border","1px solid red");
		  $("#UserName").focus();
		  $("#spantext").text("请填写用户名称！").css("color","red");
		  return false;
	  }else if(Password==""){
		  $("#Password").css("border","1px solid red");
		  $("#spantext").text("请填写用户密码！").css("color","red");
		  $("#Password").focus();
		 return false;
	  }
	  else if(VerifyCode==""){
		  $("#VerifyCode").css("border","1px solid red");
		  $("#spantext").text("请填写验证码！").css("color","red");
		  $("#VerifyCode").focus();
		  return false;
	  }
	});
	$("#verifyImg").bind('click',function(){
		var time = new Date().getTime();
		$('#verifyImg').attr('src',webRoot+'/Publicuse/verify/'+time);	
	})
});
