/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	
	var form = $("#userform");
	var guest_oldpwd = $("#guest_oldpwd");
	var guest_oldpwdinfo = $("#guest_oldpwdinfo");
	var guest_newpwd = $("#guest_newpwd");
	var guest_newpwdinfo = $("#guest_newpwdinfo");
	var guest_chkpwd = $("#guest_chkpwd");
	var guest_chkpwdinfo = $("#guest_chkpwdinfo");

	//On blur
	guest_oldpwd.blur(validateoldpwd);
	guest_newpwd.blur(validatenewpwd);
	guest_chkpwd.blur(validatechkpwd);

	//On key press
	guest_oldpwd.keyup(validateoldpwd);
	guest_newpwd.keyup(validatenewpwd);
	guest_chkpwd.keyup(validatechkpwd);
	//On Submitting
	form.submit(function(){
		if(validateoldpwd() & validatenewpwd() & validatechkpwd() )
			return true
		else
			return false;
	});
	function validateoldpwd(){
		if(guest_oldpwd.val()==""){
			guest_oldpwd.addClass("error");
			guest_oldpwdinfo.text("Please input your old password!");
			guest_oldpwdinfo.addClass("error");
			return false;
		}else{
			guest_oldpwd.removeClass("error");
			guest_oldpwdinfo.text("Please input your old password");
			guest_oldpwdinfo.removeClass("error");
			return true;
		}
	}
	function validatenewpwd(){
		if(guest_newpwd.val()==""){
			guest_newpwd.addClass("error");
			guest_newpwdinfo.text("please input your new password!");
			guest_newpwdinfo.addClass("error");
			return false;
		}else{
			guest_newpwd.removeClass("error");
			guest_newpwdinfo.text("please input your new password!");
			guest_newpwdinfo.removeClass("error");
			return true;
		}
	}
	function validatechkpwd(){
		if(guest_chkpwd.val()==""){
			guest_chkpwd.addClass("error");
			guest_chkpwdinfo.text("check input your new password!");
			guest_chkpwdinfo.addClass("error");
			return false;
		}else if(guest_chkpwd.val()!=guest_newpwd.val()){
			guest_chkpwd.addClass("error");
			guest_chkpwdinfo.text("Two input not consistent!");
			guest_chkpwdinfo.addClass("error");
			return false;
		}else{
			guest_chkpwd.removeClass("error");
			guest_chkpwdinfo.text("please input your new password");
			guest_chkpwdinfo.removeClass("error");
			return true;
		}
	}
	
	
	
	
	
	//validation functions

});
