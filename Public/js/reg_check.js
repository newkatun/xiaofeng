var clickFlag=false;
var nowid;
var totalid;
var can1press = false;
var emailafter;
var emailbefor;
var isShow = true;
var isRed = true;
var showCodeFlag = false;
$(document).ready(function(){
	$("#user_email").focus(function(){$("#user_email").addClass("input_focus");});
	$("#user_email").blur(function(){$("#user_email").removeClass("input_focus");});
	$("#user_name").focus(function(){$("#user_name").addClass("input_focus");});
	$("#user_name").blur(function(){$("#user_name").removeClass("input_focus");});
	$("#user_password").focus(function(){$("#user_password").addClass("input_focus");});
	$("#user_password").blur(function(){$("#user_password").removeClass("input_focus");});
	$("#user_password2").focus(function(){$("#user_password2").addClass("input_focus");});
	$("#user_password2").blur(function(){$("#user_password2").removeClass("input_focus");});
	//$("#validCode").focus(function(){$("#validCode").addClass("input_focus");});
	//$("#validCode").blur(function(){$("#validCode").removeClass("input_focus");})
	jQuery("#user_email").focus().addClass("input_focus");
	$("#validCode").val("");
	//隐藏验证码
	if(showCodeFlag==true){
		jQuery("#validCode_tip").hide();
		jQuery("#validCode_error").show();
	}
	jQuery("#user_email").keyup(function(event){ 
	     //获取当前按键的键值 
	     //jQuery的event对象上有一个which的属性可以获得键盘按键的键值 
	     var keycode = event.which;
	     //处理回车的情况 
	    if(keycode==8){
	    	isShow=true;
	    }
	 });
	 jQuery("#validCode").keyup(function(event){ 
	     //获取当前按键的键值 
	     //jQuery的event对象上有一个which的属性可以获得键盘按键的键值 
	     var keycode = event.which;
	     //处理回车的情况 
	     if(keycode==13){ 
	    	 if(doSubmit()){
	    		jQuery("#registerform").submit();
	    	 }
	    } 
	     //处理esc的情况 
	     if(keycode == 27){ 
	     } 
	 });

})

/**
* 功能是检测表格填写是否符合要求
* return true or false
*/
function doSubmit(){  
	if(doSubmitPwd()==false){
		return false;
	}
	var check_email_rs=check_email();
	if(check_email_rs==1){
		  showEmailError("Email不能为空");
		return false;
	}else if(check_email_rs==2){
		 showEmailError("");
		 $("#email_error").html("邮箱格式错误");
         return false;
	}else if(check_email_rs==3){
		showEmailError("");
	   $("#email_desc").html("邮箱长度不能超过100位");
	   return false;
	}
	else if($("#email_desc").html()=="重复的email"){
		$("#email").focus();
		return false;
	}
	
	var check_name_rs=check_Name();
	if(check_name_rs==1)
	{
		showNameError("用户名不能为空");
	   
	    return false;
	}
	else if(check_name_rs==2)
	{
		showNameError("用户名为4-20位字符");
	   
	    return false;
	}
	else if(check_name_rs==3)
	{
		showNameError("用户名为4-20位字符");
	   
	    return false;
	}
	else if(check_name_rs==4)
	{
		showNameError("用户名格式错误");
	    
	    return false;
	}
	else if($("#name_desc").text()=="用户名已被注册，请重新输入或使用该用户名登录"){
		
		return false;
	}
   
    if($("#validCode").val()==""){
    	showCodeError("验证码不能为空");
    	
    	return false;
    }else if($("#validCode").val().length != 4) {
    	showCodeError("验证码长度必须是4位");
    
    	return false;
    }else
    {
    	$("#validCode_desc").hide();
    }
    
    if($("#contract").attr("checked")==false){
    	$("#contract_desc").show();
    	
    	return false;
    }
	return true;
}  


/**
* 检测注册密码
*/
	function doSubmitPwd(){
		var check_pwd1_rs=check_pwd1();
		if (check_pwd1_rs==1){
			showPassError("密码不能为空");
			return false;
		}
		if(check_pwd1_rs==2){
			showPassError("密码为6-20位字符");    
			return false;
        }
		if(check_pwd1_rs==3){
        	showPassError("密码为6-20位字符");
        	return false;
        }
        if(check_pwd1_rs==4){
        	showPassError("密码中不允许有空格");
        	return false;
        }
        if(check_pwd1_rs==5){
        	showPassError("密码不能全为数字");
        	return false;
        }
        if(check_pwd1_rs==6){
        	showPassError("密码不能全为字母，请包含至少1个数字或符号 ");
        	return false;
        }
        if(check_pwd1_rs==7){
        	showPassError("密码不能全为符号");
        	return false;
        }
         if(check_pwd1_rs==8){
        	showPassError("密码不能全为相同字符或数字");
        	return false;
        }
        if(check_pwd1_rs==9){
        	showPassError("密码与用户名相似，为了您的账户安全请重新输入");
        	return false;
        }
	    var check_pwd2_rs=check_pwd2();
	    if(check_pwd2_rs==1){
	     	showPass2Error("确认密码不能为空");
		  
			return false;
	    }else if(check_pwd2_rs==2){
	    	showPass2Error("两次密码输入不一致");
		
			return false;
	    }
	}