/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	var form = $("#feedtable");
	//var guest_name = $("#guest_name");
	
	var guestname = $("#guestname");
	var guestnamespan = $("#guestnamespan");
	var guestmail = $("#guestmail");
	var guestmailspan = $("#guestmailspan");
	var title = $("#title");
	var titlespan = $("#titlespan");
	var content = $("#content");
	var contentspan = $("#contentspan");
	
	var ValidataArray={
		name:/^[a-zA-z][\w '\-]+[a-zA-z]$/,
		email:/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
	}
	//On blur
	guestname.blur(valigeustName);
	guestmail.blur(validateEmail);
	title.blur(validateTitle);
	content.blur(validateContent);

	//On key press
	
	guestname.keyup(valigeustName);
	guestmail.keyup(validateEmail);
	title.keyup(validateTitle);
	content.keyup(validateContent);

	
	//On Submitting
	form.submit(function(){
		if(valigeustName() & validateEmail() & validateTitle() & validateContent())
			return true
		else
			return false;
	});
	function valigeustName(){
		var emailtext=trimTxt(guestname.val());
		if(ValidataArray.name.test(emailtext)){
			guestname.attr('class','normal');
			guestnamespan.attr('class','normal');
			return true;
		}else{
			guestname.attr('class',"error");
			guestnamespan.attr('class',"error");
			return false;
		}
	}
	function validateEmail(){
		var emailtext=trimTxt(guestmail.val());
		if(ValidataArray.email.test(emailtext)){
			guestmail.attr('class',"normal");
			guestmailspan.attr('class',"normal");
			return true;
		}else{
			guestmail.attr('class',"error");
			guestmailspan.attr('class',"error");
			return false;
		}
	}
	function validateTitle(){
		var emailtext=trimTxt(title.val());
		if(ValidataArray.name.test(emailtext)){
			title.attr('class',"normal");
			titlespan.attr('class',"normal");
			return true;
		}else{
			title.attr('class',"error");
			titlespan.attr('class',"error");
			return false;
		}
	}
	
	function validateContent(){
		var emailtext=trimTxt(content.val());
		if(emailtext!=""){
			content.attr('class',"normal");
			contentspan.attr('class',"normal");
			return true;
		}else{
			content.attr('class',"error");
			contentspan.attr('class',"error");
			return false;
		}
	}
});