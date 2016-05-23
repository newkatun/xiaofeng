/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	var form = $("#userform");
	var guestaccptname = $("#guestaccptname");
	var guestlastname = $("#guestlastname");
	var guestphone = $("#guestphone");
	var guestcity = $("#guestcity");
	var guestaddress = $("#guestaddress");
	var addressID= $("#addessid").val(); 
	var guestcountry=$("#guestcountry"); 
	var guestpostcode=$("#guestpostcode"); 
	


	//On blur
	guestaccptname.blur(validatefirst);
	guestlastname.blur(validatelast);
	guestphone.blur(validatephone);
	guestcity.blur(validatecity);
	guestaddress.blur(validateaddress);
	guestpostcode.blur(validateposecode);
	
	//On key press
	
	guestaccptname.keyup(validatefirst);
	guestlastname.keyup(validatelast);
	guestphone.keyup(validatephone);
	guestcity.keyup(validatecity);
	guestaddress.keyup(validateaddress);
	guestpostcode.blur(validateposecode);
	//On change
	guestcountry.change(validateCountry);
	
	//动态提交地址
	 $("input#input_btn").click(function(){
		if(validatefirst() && validatelast()  && validatephone() &&  validatecity() &&  validateaddress() && validateposecode()){
			console.log('aaaa');
			return true;
		}else{
			console.log(validatefirst());
			console.log('bbbb');
			console.log(validatelast());
			console.log('bbbb');
			console.log(validatephone());
			console.log('bbbb');
			console.log(validatecity());
			console.log('bbbb');
			console.log(validateaddress());
			console.log('bbbb');
			console.log(validateposecode());
			console.log('bbbb');
			return false;
		}
		
	}); 
	
	

	

	

	
//验证地址表格函数
	function validatefirst(){
		if(guestaccptname.val()==""){
			guestaccptname.attr('class','error');
			$("#guestaccptnameinfo").attr('class','error');
			return false;
		}else{
			guestaccptname.attr('class','normal');
			$("#guestaccptnameinfo").attr('class','normal');
			return true;
		}
	}
	
	function validatelast(){
		if(guestlastname.val()==""){
			guestlastname.attr('class','error');
			$("#guestlastnameinfo").attr('class','error');
			return false;
		}else{
			guestlastname.attr('class','normal');
			$("#guestlastnameinfo").attr('class','normal');
			return true;
		}
	}

	
	function validatephone(){
		if(guestphone.val()==""){
			guestphone.attr('class','error');
			$("#guestphoneinfo").attr('class','error');
			return false;
		}else{
			guestphone.attr('class','normal');
			$("#guestphoneinfo").attr('class','normal');
			return true;
		}
	}

	
	
	function validatecity(){
		if(guestcity.val()==""){
			guestcity.attr('class','error');
			$("#guestcityinfo").attr('class','error');
			return false;
		}else{
			guestcity.css("border","solid 1px ccc");
			$("#guestcityinfo").attr('class','normal');
			return true;
		}
	}
	
	function validatestate(){
		if(gueststate.val()==""){
			gueststate.attr('class','error');
			$("#guest_fnameinfo").attr('class','error');
			return false;
		}else{
			gueststate.attr('class','normal');
			$("#guest_fnameinfo").attr('class','normal');
			return true;
		}
	}
	
	function validateaddress(){
		if(guestaddress.val()==""){
			guestaddress.attr('class','error');
			$("#guestaddressinfo").attr('class','error');
			return false;
		}else{
			guestaddress.attr('class','normal');
			$("#guestaddressinfo").attr('class','normal');
			return true;
		}
	}
	
	function validateposecode(){
		if(guestpostcode.val()==""){
			guestpostcode.attr('class','error');
			$("#guestpostcodeinfo").attr('class','error');
			return false;
		}else{
			guestaddress.attr('class','normal');
			$("#guestpostcodeinfo").attr('class','normal');
			return true;
		}
	
	}
	
	
	function validateCountry(){
		if(guestcountry.val()=="0"){
			guestcountry.attr('class','error');
			$("#guestcountryinfo").attr('class','error');
		}else{
			guestcountry.attr('class','normal');
			$("#guestcountryinfo").attr('class','normal');
			return true;
		}
	}
	

});