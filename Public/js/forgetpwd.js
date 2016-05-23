$(document).ready(function(){
	//global vars
	var form = $("#loginchk");
	var name = $("#email");
	var errormsg = $("#email_tip");
	var authcode=$("#validCode");
	var errorcode=$("#validCode_tip");
	var volidret=$("#volidret");
	
	name.blur(validateName(name,errormsg));
	authcode.blur(valicode(authcode,errorcode,volidret));

	//On key press
	name.keyup(validateName(name,errormsg));
	authcode.keyup(valicode(authcode,errorcode,volidret));
	
	form.submit(function(){
		if(validateName(name,errormsg) && valicode(authcode,errorcode,volidret)){
			$result=$.ajax({
				method:'post',
				url:'http://'+WEBROOT+'login/forgetaction',
				data:{email:name.val(),validCode:authcode.val()},
				success:function(data){
					data=JSON.parse(data);
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