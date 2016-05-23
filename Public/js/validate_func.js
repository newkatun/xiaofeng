 function validatePassword(userpwd,errorpwd){
		console.log("aaaa");
		var filter = /^[a-zA-Z0-9_]{4,15}/;
		if(userpwd.val().length < 5){
			errorpwd.text("We want password with more than 4 letters!").css('color','red');
			userpwd.attr('class','errorinput');
			return false;
		}else if(filter.test(userpwd.val())==false){
			errorpwd.text("You can input A-Za-z0-9_,the first word must be letter!");
			userpwd.attr('class','errorinput');
			return false;
		}else{
			userpwd.attr('class','normal');;
			errorpwd.text(" ");
			return true;
		}
	}
	function validateName(name,errormsg){
		var reg=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
		if(name.val().indexOf("@") < 1 && name.val().indexOf(".")<2 ){
			errormsg.text("please input a  Email!").css('color','red');
			name.attr('class','errorinput');
			return false;
		}else if(reg.test(name.val())==false){
			errormsg.text("please input a current Email!").css('color','red');
			name.attr('class','errorinput');
			return false;
		}else{
			name.attr('class','normal');;
			errormsg.text(" ");
			return true;
		}
	}
	
	function valicode(authcode,errorcode,volidret){
		var reg=/^\d{4}$/;
		if(reg.test(authcode.val())==false){
			errorcode.text("Please input the Verification code!").css('color','red');
			authcode.attr('class','errorinput');
			return false;
		}else if(authcode.val().length==4){
			chk_yzcode(authcode.val());
			var yacode=volidret.val();
			if(yacode=="true"){
				authcode.attr('class','normal');;
				errorcode.text(" ");
				return true;
			}else{
				errorcode.text(" Verification code error!").css('color','red');
				authcode.attr('class','errorinput');
				return false;
			}
		}else{
			authcode.attr('class','normal');;
			errorcode.text(" ");
			return false;
		}
	}	
	
	function valiConfirmPwd(cpwd,errormsg,pwd){
		if(pwd.val()==cpwd.val() && pwd.val().length>5){
			errormsg.text("");
			return true;
		}else{
			errormsg.text("Check the confirm password.");
			return false;
		}
	
	}
	
	function valinamepwd(){
		if(validateName() && validatePassword()){
		    check_username(name.val(),userpwd.val());
		    var str_return=$("#registerchk").val();
			if(str_return!="false"){
				errormsg.text("Your name or password is wrong!");
				return false;
			}else{
				errormsg.text(" ");
				return true;
			}
		}else{
			errormsg.text("Please input your name or password !");
			return false;
		}
		
	}
	function chk_yzcode(strcode){
		var t=Math.floor(Math.random()*1000);
		var strdata;
		if(strcode!=""){
			$.post("http://"+WEBROOT+"Publicuse/yanzheng/t/"+t,{action:"chkcode",yzcode:strcode},function(data){
				strdata=trimTxt(data);
				if(strdata=='true'){
					$("#validCode").attr('class','normal');
					$("#validCode_tip").text('');
				}
				$("#volidret").attr("value",strdata);
			});
		}
	}