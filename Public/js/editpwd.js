$(document).ready(function(){
	//global vars
	var form = $("#registerform");
	var name = $("#email");
	var errormsg = $("#email_tip");
	var userpwd = $("#password");
	var errorpwd = $("#password_tip");
	var confirmpwd = $("#password2");
	var errorconfirm = $("#password2_tip");
	var authcode=$("#validCode");
	var errorcode=$("#validCode_tip");
	var volidret=$("#volidret");
	var sessioncode=$("#sessioncode");
	
	name.blur(validateName(name,errormsg));
	authcode.blur(valicode(authcode,errorcode,volidret));
	userpwd.blur(validatePassword(userpwd,errorpwd));
	confirmpwd.blur(valiConfirmPwd(confirmpwd,errorconfirm,userpwd));
	//On key press
	name.keyup(validateName(name,errormsg));
	authcode.keyup(valicode(authcode,errorcode,volidret));
	userpwd.keyup(validatePassword(userpwd,errorpwd));
	confirmpwd.keyup(valiConfirmPwd(confirmpwd,errorconfirm,userpwd));
	
	form.submit(function(){
		if(validateName(name,errormsg) && valicode(authcode,errorcode,volidret) && validatePassword(userpwd,errorpwd) && valiConfirmPwd(confirmpwd,errorconfirm,userpwd) ){
			$result=$.ajax({
				method:'post',
				url:'http://'+WEBROOT+'login/updatepwd',
				data:{email:name.val(),validCode:authcode.val(),password:userpwd.val(),sessioncode:sessioncode.val()},
				success:function(data){
					data=JSON.parse(data);
					if(data.strStatus=='true'){
						window.location.href=data.webPage;
					}
					$(".tipmessage").text(data.strReturn);
				},
				error:function(){
					$(".tipmessage").text("网络错误.");
				}
			});
			return true;
		}else{
			return false;
		}
	});
})