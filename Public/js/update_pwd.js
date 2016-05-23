var commonSymbol ="[\\,\\`\\~\\!\\@\\#\\$\\%\\\\\^\\&\\*\\(\\)\\-\\_\\=\\+\\[\\{\\]\\}\\\\\|\\;\\:\\‘\\’\\“\\”\\<\\>\\/?]+"; 
function checkPassword(strobj){
	var password=$('#'+strobj).val();
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

function isSameWord(words){
	var firstTmp;
	if(words!=null&&words!=""){
		firstTmp = words.charAt(0);
	}
	var patternTmp =  "["+firstTmp+"]{"+(words.length)+"}";
	var pattern = new RegExp(patternTmp);
	return pattern.test(words);
}
function checkWords(){
	var password = jQuery("#guest_oldpwd").val();
    var userName = jQuery("#guest_name").val();
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

function checkNewPwd(strobj){
	var check_pwd1_rs=checkPassword(strobj);
	if (check_pwd1_rs==1){
		showPassError(strobj,"Password can not be empty !");
		return false;
	}
	if(check_pwd1_rs==2){
		showPassError(strobj,"The password's length is 6-20 !");    
		return false;
    }
	if(check_pwd1_rs==3){
       	showPassError(strobj,"The password's length is 6-20 !");
       	return false;
    }
    if(check_pwd1_rs==4){
        showPassError(strobj,"Spaces are not allowed in passwords !");
        return false;
    }
    if(check_pwd1_rs==5){
        showPassError(strobj,"Passwords can not are all digital !");
        return false;
    }
    if(check_pwd1_rs==6){
        showPassError(strobj,"Passwords can not all be a letter , must contain a number !");
        return false;
    }
    if(check_pwd1_rs==7){
        showPassError(strobj,"Passwords can not all special symbols !");
        return false;
    }
    if(check_pwd1_rs==8){
        showPassError(strobj,"Password can not be the same character !");
        return false;
    }
    if(check_pwd1_rs==9){
        showPassError(strobj,"Password and account name that is !");
        return false;
    }
	
	if(check_pwd1_rs==0){
		$('#'+strobj).removeClass('redErorBodr');
		$('#'+strobj+"info").text('');
	}
	return true;
}

function showPassError(strobj,errorInfo){
	//jQuery("#password_tip").hide();
	showErrorInfo(strobj,errorInfo);
}

function showErrorInfo(id,errorInfo){
	jQuery("#"+id+"").addClass("redErorBodr");
	jQuery("#"+id+"info").text(errorInfo);
}

function formSubmit(){
	if(checkNewPwd('guest_oldpwd')==true && checkNewPwd('guest_newpwd')==true && checkNewPwd('guest_chkpwd')==true){
		$("#userform").submit();
	}
}
$(document).ready(function(){
	$("input.input_btn").click(function(){
		newpwd=$('#guest_newpwd').val();
		chkpwd=$('#guest_chkpwd').val();
		if(newpwd!=chkpwd){
			$('#guest_newpwd').addClass("redErorBodr");
			jQuery("#guest_newpwdinfo").text("Confirm password input error");
			return false;
		}else if(checkNewPwd('guest_oldpwd')==true && checkNewPwd('guest_newpwd')==true && checkNewPwd('guest_chkpwd')==true){
			$("#userform").submit();
			return true;
		}else{
			return false;
		}
	})

})