/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	var form = $("#userform");
	var guest_name = $("#guest_name");
	var guest_country = $("#guest_country");
	var guest_countryinfo = $("#guest_countryinfo");
	var guest_truename = $("#guest_truename");
	var guest_truenameinfo = $("#guest_truenameinfo");
	var guest_postcode = $("#guest_postcode");
	var guest_postcodeinfo = $("#guest_postcodeinfo");
	var guest_telephone = $("#guest_telephone");
	var guest_phonenuminfo = $("#guest_phonenuminfo");
	var guest_photo = $("#guest_photo");
	var guest_photoinfo = $("#guest_photoinfo");
	var guest_address = $("#guest_address");
	var guest_addressinfo=$("#guest_addressinfo");
	
	//On blur
	guest_country.blur(validatecuntry);
	guest_truename.blur(validatetruename);
	guest_postcode.blur(validatepostcode);
	guest_telephone.blur(validatephone);
	guest_address.blur(validateaddress);
	//On key press
	guest_country.keyup(validatecuntry);
	guest_truename.keyup(validatetruename);
	guest_postcode.keyup(validatepostcode);
	guest_telephone.keyup(validatephone);
	guest_address.keyup(validateaddress);
	//On Submitting
	form.submit(function(){
		if(validatecuntry() & validatetruename() & validatepostcode() & validatephone() & validateaddress())
			return true
		else
			return false;
	});
	function validatecuntry(){
		if(guest_country.val()==""){
			guest_country.addClass("error");
			guest_countryinfo.text("We want names with more than 3 letters!");
			guest_countryinfo.addClass("error");
			return false;
		}else{
			guest_country.removeClass("error");
			guest_countryinfo.text("Input your contry");
			guest_countryinfo.removeClass("error");
			return true;
		}
	}
	function validatetruename(){
		if(guest_truename.val()==""){
			guest_truename.addClass("error");
			guest_truenameinfo.text("We want names with more than 3 letters!");
			guest_truenameinfo.addClass("error");
			return false;
		}else{
			guest_truename.removeClass("error");
			guest_truenameinfo.text("Input your contry");
			guest_truenameinfo.removeClass("error");
			return true;
		}
	}
	function validatepostcode(){
		if(guest_postcode.val()==""){
			guest_postcode.addClass("error");
			guest_postcodeinfo.text("We want names with more than 3 letters!");
			guest_postcodeinfo.addClass("error");
			return false;
		}else{
			guest_postcode.removeClass("error");
			guest_postcodeinfo.text("Input your contry");
			guest_postcodeinfo.removeClass("error");
			return true;
		}
	}
	
	function validatephone(){
		if(guest_telephone.val()==""){
			guest_telephone.addClass("error");
			guest_phonenuminfo.text("We want names with more than 3 letters!");
			guest_phonenuminfo.addClass("error");
			return false;
		}else{
			guest_telephone.removeClass("error");
			guest_phonenuminfo.text("Input your contry");
			guest_phonenuminfo.removeClass("error");
			return true;
		}
	}
	
	function validateaddress(){
		if(guest_address.val()==""){
			guest_address.addClass("error");
			guest_addressinfo.text("We want names with more than 3 letters!");
			guest_addressinfo.addClass("error");
			return false;
		}else{
			guest_address.removeClass("error");
			guest_addressinfo.text("Input your contry");
			guest_addressinfo.removeClass("error");
			return true;
		}
	}
	
	
	
	
	//validation functions

});