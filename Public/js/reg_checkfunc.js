var commonSymbol ="[\\,\\`\\~\\!\\@\\#\\$\\%\\\\\^\\&\\*\\(\\)\\-\\_\\=\\+\\[\\{\\]\\}\\\\\|\\;\\:\\‘\\’\\“\\”\\<\\>\\/?]+";

//显示提示内容
function showoff(id){
	var strAry = id.split("_");
	if(strAry[0]!="password"){
	jQuery("#"+strAry[0]+"_error").hide();
	jQuery("#"+strAry[0]+"_tip").show();
	}
	jQuery("#"+id+"").hide();
}

function trim(str){ //删除左右两端的空格  
	return str.replace(/(^\s*)|(\s*$)/g, "");  
}  
function ltrim(str){ //删除左边的空格  
	return str.replace(/(^\s*)/g,"");  
}  
function rtrim(str){ //删除右边的空格  
	return str.replace(/(\s*$)/g,"");  
} 
/**
*	功能是显示错误提示效果
*	
*/
function showErrorInfo(id,errorInfo){
		jQuery("#"+id+"").removeClass("extra").addClass("errorinfo").html(""+errorInfo+"").show();
		jQuery("#pswdLevel").hide();
		var strs=id.split("_");
		jQuery("#"+strs[0]+"_desc").hide();
		jQuery("#"+strs[0]+"").addClass("redErorBodr");
}

function showNameError(errorInfo){
		jQuery("#name_tip").hide();
		showErrorInfo("name_error",errorInfo)
}
function showPassError(errorInfo){
		jQuery("#password_tip").hide();
		showErrorInfo("password_error",errorInfo)
	}
function showPass2Error(errorInfo){
		jQuery("#password2_tip").hide();
		showErrorInfo("password2_error",errorInfo)
	}
function showEmailError(errorInfo){
		jQuery("#email_tip").hide();
		showErrorInfo("email_error",errorInfo)
	}
function showCodeError(errorInfo){
		jQuery("#validCode_tip").hide();
		showErrorInfo("validCode_error",errorInfo)
	}
function checkCodeOnBlur(){
		 if($("#validCode").val()==""){
        	showCodeError("验证码不能为空");
        }else if($("#validCode").val().length != 4) {
        	showCodeError("验证码长度必须是4位");
        }
	}

/**
*功能是检测注册密码
*/
function checkPasswordOnBlur(){
		
		hideOtherTips("password");	
		var password = jQuery("#password");
		var check_pwd1_rs=check_pwd1();
		if(check_pwd1_rs!=0){
			jQuery("#password2").attr("readonly","readonly");
		}
		if (check_pwd1_rs==1){
			showPassError("密码不能为空");
			
		}else if(check_pwd1_rs==2){
			showPassError("密码为6-20位字符");           
        }else if(check_pwd1_rs==3){
        	showPassError("密码为6-20位字符");
        }else if(check_pwd1_rs==4){
        	showPassError("密码中不允许有空格");
        }
        else if(check_pwd1_rs==5){
        	showPassError("密码不能全为数字");
        }
        else if(check_pwd1_rs==6){
        	showPassError("密码不能全为字母，请包含至少1个数字或符号 ");
        }
        else if(check_pwd1_rs==7){
        	showPassError("密码不能全为符号");
        }
        else if(check_pwd1_rs==8){
        	showPassError("密码不能全为相同字符或数字");
        }
        else if(check_pwd1_rs==9){
        	showPassError("密码与用户名相似，为了您的账户安全请重新输入");
        }
        else{
			$("#password_desc").addClass("rightinfo").show();
			$("#password_desc").text("");
			hideOtherTips("none");
			jQuery("#password").removeClass("redErorBodr");
			jQuery("#password2").removeAttr("readonly");
			jQuery("#password2").removeAttr("readonly");
		}
	}
	function checkPassword2OnBlur(){
		var check_pwd2_rs=check_pwd2(); 
		if(check_pwd2_rs==1){
			showPass2Error("确认密码不能为空 ");
		}else if(check_pwd2_rs==2){
			showPass2Error("两次密码输入不一致");
		}else{
			$("#password2_desc").addClass("rightinfo").show();
			jQuery("#password2").removeClass("redErorBodr");
			hideOtherTips("none");
		}
	}	
	
/**
*	功能检测注册邮箱号码
*	return 错误类型
*/
function check_email(){	
	   	var email = jQuery('#user_email').val();
		if(email == ""){
			return 1;
		}
		var reg = "^([a-zA-Z0-9_\\-|\\,\\.\\=\\/\\$\\/\\^\\/\\(\\/\\)\\/\\-\\/\\_\\/\\+\\/\\[\\/\\]\\/\\{\\/\\}])+@([a-zA-Z0-9_\\-])+((\\.[a-zA-Z0-9_\\-]{2,4}){1,2})$";
		var email_reg = new RegExp(reg);
        if(!email_reg.test(email)){
        	return 2;
        }
        if(email.length > 60){
			return 3;
		}
        return 0;
    } 
	
/**
*	功能检测注册邮箱号码
*	通过showEmailError函数显示返回内容
*/
function checkEmailOnBlur(){
		clickFlag = false;
		var check_email_rs=check_email();
		if (check_email_rs==1){
			showEmailError("Email不能为空");
			
		}else if(check_email_rs==2){
			showEmailError("邮箱格式错误");
		}else if(check_email_rs==3){
			showEmailError("邮箱长度不能超过100位");
		}
		else{
			
		   $.ajax({
				  type: 'POST',
				  url: '/passport/check_email.do',
				  data: 'rd='+Math.random()+'&useremail='+$("#user_email").val(),
				  success: function(response){
					  if((trim(response))==1){
					  	jQuery("#email_tip").hide();

						 jQuery("#user_email").removeClass("redErorBodr");
					 	$("#email_desc").addClass("rightinfo").show();
					   }
					  else if((trim(response))==2){
						
						showEmailError("邮箱已被注册，请重新输入或使用该邮箱<a href='"+jQuery("#passport_url").val()+"passport/login_input.do'>登录</a>");
		  				
					  }
				  	}
				});
		}
		if(isRed==false){
			jQuery("#user_email").removeClass("redErorBodr");
		}
	}

/**
*	功能检测注册用户名
*	return 错误类型
*/	
function check_Name(){
		var un=$("#user_name").val();

		var exception=/^[0-9a-zA-Z\,\$\^\(\)\-\_\+\[\]\{\}\u4e00-\u9fa5]{3,20}$/;
		if(un=="")
		{
			return 1;
		}
		if(un.length<4 )
		{
			return 2;
		}
		if(un.length>20)
		{
			return 3;
		}
		if(!exception.test(un))
		{
			return 4;
		}
		
		
	}	
	
/**
*	功能鼠标移开之后检测用户名
*	通过调用showNameError函数显示返回内容
*/	
	function checkNameOnBlur(){
		var check_name_rs = check_Name();
		
		if(check_name_rs==1){
			showNameError("用户名不能为空");	
		}else if(check_name_rs==2){
			showNameError("用户名为4-20位字符");
		}else if(check_name_rs==3){
			showNameError("用户名为4-20位字符");
		}else if(check_name_rs==4){
			showNameError("用户名格式错误");
		}else{
			  jQuery.ajax({
				  type: 'POST',
				  url: '/passport/check_name.do',
				  data: 'username='+$("#user_name").val(),
				  success: function(response){
					  if(response==1){ $("#name_desc").removeClass("extra");
			        	$("#name_desc").removeClass("errorinfo");
						$("#name_desc").addClass("rightinfo");
						jQuery("#user_name").removeClass("redErorBodr");
						$("#name_desc").text("").show();}
					  else if(response==2){	
						  hideOtherTips("none");
						  showNameError("用户名已被注册，请重新输入或使用该用户名<a href='"+jQuery("#passport_url").val()+"passport/login_input.do'>登录</a>");
					  }
					  					  }
			});
			}
	}
/**
* 功能判定输入的密码与名称是否相同
*return true or false
*/

function checkWords(){
	var password = jQuery("#user_password").val();
    var userName = jQuery("#user_name").val();
    if(userName==undefined){
    	return false;
    }
    if(userName.substring(0,userName.length-1)==password){
        return true;
    }
    if(userName.substring(0,userName.length-1)==password.substring(0,password.length-1)){
    	 return true;
    }
    if(userName.substring(1,userName.length)==password){
    	 return true;
    }
    if(userName.substring(1,userName.length)==password.substring(1,password.legnth)){
    	 return true;
    }
    if(password.substring(0,password.length-1)==userName){
    	return true;
    }
    if(password.substring(1,password.length)==userName){
      	return true; 
     }
}

/**
* 功能验证字符串全都为一个值
*return true or false
*/
function isSameWord(words){
    var firstTmp;
    if(words!=null&&words!=""){
        firstTmp = words.charAt(0);
    }
    var patternTmp =  "["+firstTmp+"]{"+(words.length)+"}";
    var pattern = new RegExp(patternTmp);
    return pattern.test(words);
}


/**
*功能是检测注册密码
*return 错误类型类型编号
*/
function check_pwd1(){ 
    	// trim();
    	var password=$("#user_password").val();
		if(password==""){
			return 1;      //密码为空
		}
		if(password.length>20){
        	return 2;     //密码长度超过20
        }
        if(password.length<6){
        	return 3;     //密码长度小于6
        }	
        var pattern = /\s+/;
        if(pattern.test(password)){
           return 4;     //密码中包含空格
        }
        var isAllNumPattern = /^[0-9]+$/;
        if(isAllNumPattern.test(password)){
        	return 5;   //密码全由数字组成
        }
        
        var isALLCharPattern=/^[a-zA-Z]+$/;
        if(isALLCharPattern.test(password)){
        	return 6;    //密码全由字母组成
        }
        
        var isAllSpecial =/^[^0-9A-Za-z]+$/;
        if(isAllSpecial.test(password)){
        	return 7;    //密码全由特殊字符组成
    	}
        
        if(isSameWord(password)){
            return 8;   //密码都是由相同字母或数字组成
         }
        
        if(checkWords()){
	   		return 9;  //密码和用户名相似
	   	}
        
		var numPattern = "d*"+commonSymbol +"";
		var allPattern ="\\\d+[A-Za-z]|[A-Za-z]+[0-9]+|[A-Za-z]+"+commonSymbol+"[0-9]+|[A-Za-z]+[0-9]+"+commonSymbol+"|"+numPattern +"";
		var allReg = new RegExp(allPattern);
        if(!allReg.test(password)){
           return 10;   //密码不符合 字母+数字 或 字符+数字 或 字母+字符 或 字母+字符+数字
        }
        
	   		return 0;
    
    }