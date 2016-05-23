/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	var form = $("#userform");
	//var guest_name = $("#guest_name");
	
	var gd_firstname = $("#gd_firstname");
	var gd_firstnameinfo = $("#gd_firstnameinfo");
	var gd_lastname = $("#gd_lastname");
	var gd_lastnameinfo = $("#gd_lastnameinfo");
	var gd_postcode = $("#gd_postcode");
	var gd_postcodeinfo = $("#gd_postcodeinfo");
	
	var gd_countrycode = $("#gd_countrycode");
	var gd_countrycodeinfo = $("#gd_countrycodeinfo");
	
	var gd_telephone = $("#gd_telephone");
	var gd_phonenuminfo = $("#gd_phonenuminfo");
	
	var gd_country = $("#gd_country");
	var gd_countryinfo=$("#gd_countryinfo");
	
	var gd_city = $("#gd_city");
	var gd_cityinfo=$("#gd_cityinfo");
	
	var gd_state = $("#gd_state");
	var gd_stateinfo=$("#gd_stateinfo");
	
	var gd_address = $("#gd_address");
	var gd_addressinfo=$("#gd_addressinfo");
	
	//On blur
	gd_firstname.blur(validatefirst);
	gd_lastname.blur(validatelast);
	gd_postcode.blur(validatepostcode);
	gd_countrycode.blur(validatecountry);
	gd_telephone.blur(validatephone);
	gd_city.blur(validatecity);
	gd_state.blur(validatestate);
	gd_address.blur(validateaddress);
	//On key press
	
	gd_firstname.keyup(validatefirst);
	gd_lastname.keyup(validatelast);
	gd_postcode.keyup(validatepostcode);
	gd_countrycode.keyup(validatecountry);
	gd_telephone.keyup(validatephone);
	gd_city.keyup(validatecity);
	gd_state.keyup(validatestate);
	gd_address.keyup(validateaddress);
	
	//On Submitting
	form.submit(function(){
		if(validatefirst() & validatelast() & validatepostcode() & validatecountry() & validatephone() &  validatecity() & validatestate() & validateaddress())
			return true
		else
			return false;
	});
	function validatefirst(){
		if(gd_firstname.val()==""){
			gd_firstname.addClass("error");
			gd_firstnameinfo.text("please input your firstname!");
			gd_firstnameinfo.addClass("error");
			return false;
		}else{
			gd_firstname.removeClass("error");
			gd_firstnameinfo.text("Input your firstname");
			gd_firstnameinfo.removeClass("error");
			return true;
		}
	}
	function validatelast(){
		if(gd_lastname.val()==""){
			gd_lastname.addClass("error");
			gd_lastnameinfo.text("please input your lastname!");
			gd_lastnameinfo.addClass("error");
			return false;
		}else{
			gd_lastname.removeClass("error");
			gd_lastnameinfo.text("Input your lastname");
			gd_lastnameinfo.removeClass("error");
			return true;
		}
	}
	function validatepostcode(){
		if(gd_postcode.val()==""){
			gd_postcode.addClass("error");
			gd_postcodeinfo.text("please input your fax!");
			gd_postcodeinfo.addClass("error");
			return false;
		}else{
			gd_postcode.removeClass("error");
			gd_postcodeinfo.text("Input your fax");
			gd_postcodeinfo.removeClass("error");
			return true;
		}
	}
	
	function validatecountry(){
		if(gd_countrycode.val()==""){
			gd_countrycode.addClass("error");
			gd_countrycodeinfo.text("please input your country code!");
			gd_countrycodeinfo.addClass("error");
			return false;
		}else{
			gd_countrycode.removeClass("error");
			gd_countrycodeinfo.text("Input your country code");
			gd_countrycodeinfo.removeClass("error");
			return true;
		}
	}
	
	function validatephone(){
		if(gd_telephone.val()==""){
			gd_telephone.addClass("error");
			gd_phonenuminfo.text("please input your phone number!");
			gd_phonenuminfo.addClass("error");
			return false;
		}else{
			gd_telephone.removeClass("error");
			gd_phonenuminfo.text("Input your telephone number");
			gd_phonenuminfo.removeClass("error");
			return true;
		}
	}
	
	function validatecity(){
		if(gd_city.val()==""){
			gd_city.addClass("error");
			gd_cityinfo.text("please input your city!");
			gd_cityinfo.addClass("error");
			return false;
		}else{
			gd_city.removeClass("error");
			gd_cityinfo.text("Input your city");
			gd_cityinfo.removeClass("error");
			return true;
		}
	}
	
	function validatestate(){
		if(gd_state.val()==""){
			gd_state.addClass("error");
			gd_stateinfo.text("please input your state!");
			gd_stateinfo.addClass("error");
			return false;
		}else{
			gd_state.removeClass("error");
			gd_stateinfo.text("Input your state");
			gd_stateinfo.removeClass("error");
			return true;
		}
	}
	
	function validateaddress(){
		if(gd_address.val()==""){
			gd_address.addClass("error");
			gd_addressinfo.text("please input your address!");
			gd_addressinfo.addClass("error");
			return false;
		}else{
			gd_address.removeClass("error");
			gd_addressinfo.text("Input your address");
			gd_addressinfo.removeClass("error");
			return true;
		}
	}
	
	
	
	
	//validation functions

});