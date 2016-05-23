/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	var form = $("#loginchk");
	var name = $("#email");
	var errormsg = $("#email_tip");
	var userpwd = $("#password");
	var errorpwd = $("#password_tip");
	var authcode=$("#validCode");
	var errorcode=$("#validCode_tip");
	var volidret=$("#volidret");

	
	//On blur
	name.blur(validateName);
	userpwd.blur(validatePassword);
	authcode.blur(valicode);

	//On key press
	name.keyup(validateName);
	userpwd.keyup(validatePassword);
	authcode.keyup(valicode);

	//On Submitting
	form.submit(function(){
		if(validateName() && validatePassword() && valicode()){
			$result=$.ajax({
				method:'post',
				url:'http://'+WEBROOT+'login/checklogin',
				data:{email:name.val(),password:userpwd.val(),validCode:authcode.val()},
				success:function(data){
					data=JSON.parse(data);
					if(data.logStatus=='success'){
						window.location.href=data.weburl;
					}else{
						$('#'+data.lablename).attr('class','errorinput');
						$('#'+data.lablename+'_tip').text(data.message).css('color','red');
					}
				},
				error:function(){
					alert('Network errors');
				}
			});
			return true;
		}else{
			return false;
		}
	});
	
	//validation functions
	function validatePassword(){
		//testing regular expression
		var a = $("#userpwd").val();
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
	function validateName(){
		//var reg=/^[a-zA-Z][a-zA-Z0-9_]{4,15}$/;
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
	
	function valicode(){
		var reg=/^[a-z0-9A-Z]{4}$/;
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
	
	//直接验证账号和密码是否正确
	// function check_username(strname,strpassword){
		// var t=Math.floor(Math.random()*1000);
		// var strdata;
		// $.get("getajax.php?action=chknamepwd&username="+strname+"&userpwd="+strpassword+"&t="+t , function(data) {
			// strdata=unescape(data);
			// $("#registerchk").attr("value",strdata)
		// });
		
	// }
	
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
			$.post("Publicuse/yanzheng/t/"+t,{action:"chkcode",yzcode:strcode},function(data){
				strdata=trimTxt(data);
				if(strdata=='true'){
					$("#validCode").attr('class','normal');
					$("#validCode_tip").text('');
				}
				$("#volidret").attr("value",strdata);
			});
		}
	}
	
	function get_backdata(){
		var str_return=$("#registerchk").val()
		if(str_return!="false"){
				errormsg.text("Your name or password is wrong!");
				return false;
			}else{
				errormsg.text(" ");
				return true;
		}
	}
	
});

	function showTipMsg(){
		var strEmail=jQuery('#email').val();
		if(strEmail=='Your Email'){
			jQuery('#email').attr('value','');	
			showErrorInfo("email_error",errorInfoText.emailerror);
			return 2;
		}
	}

