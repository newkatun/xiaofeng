/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	var form = $("#userpayform");
	var guestaccptname = $("#guestaccptname");
	var guestlastname = $("#guestlastname");
	var guestphone = $("#guestphone");
	var guestcity = $("#guestcity");
	var guestaddress = $("#guestaddress");
	var addressID= $("#addessid").val(); 
	var guestcountry=$("#guestcountry"); 
	


	//On blur
	guestaccptname.blur(validatefirst);
	guestlastname.blur(validatelast);
	guestphone.blur(validatephone);
	guestcity.blur(validatecity);
	guestaddress.blur(validateaddress);
	
	//On key press
	
	guestaccptname.keyup(validatefirst);
	guestlastname.keyup(validatelast);
	guestphone.keyup(validatephone);
	guestcity.keyup(validatecity);
	guestaddress.keyup(validateaddress);
	
	//动态提交地址
	$("#addnewaddreess").click(function(){
		if(validatefirst() && validatelast()   && validatephone() &&    validatecity() &&  validateaddress()){
			var ttime=new Date();
			var t=ttime.getMilliseconds();
			var strdata;
			$.post('ajaxfile/get_addaddress.php?action=newaddress&t='+t,{firsrname:guestaccptname.val(),lastname:guestlastname.val(),phone:guestphone.val(),city:guestcity.val(),address:guestaddress.val(),addressID:addressID,country:guestcountry.val()},function(data){
			strdata=unescape(data);
				$('li#shipping_tableli').before(strdata);
				$('div.ordercheck_table').css("display","none");
				$("#addnewaddreess").attr("disabled","disabled");
				$("#checkaddreess").attr("disabled",false);
				$('li#shipping_tableadd').remove();		
			});
			return true;
		}else{
			return false;
		}
		
	});
	
	
//	地址验证
	$("#checkaddreess").click(function(){
		var payaddresstype= $("input:radio[name=guestaddressId]:checked").val(); 
		if(payaddresstype=="" || typeof(payaddresstype)=="undefined"){
			$("#checkaddreessspan").text("Sorry,you not check address!");
		}else{
			$(this).css("background","url(./Public/images/button.png) 0px -220px no-repeat");
			$("#checkaddreessspan").text("Confirm this step and go on").css("color","green");
			$("div.shippingcontent").css("display","block");
		}
	});
	
	//确认物流方式
	$("#checkship").click(function(){
		var paytypename = $('input[name="shipmethod"]:checked').val();
		if(paytypename!=""){
			$(this).css("background","url(./images/button.png) 0px -220px no-repeat");
			$("#checkshipspan").css("color","green").text("Confirm this step and go on");
			$("div.pay_comments").css("display","block");
			$("#checkcomment").removeAttr("disabled");
			//console.log($("div.pay_comments").css("display"))
		}else{
			$("#checkshipspan").text("Sorry,you don't select the  Shipping Method!");
		}
		//console.log(paytypename);
	});

//	付款方式验证
	$("#checkpayment").click(function(){
		var paytypename =  $('input[name="checkpaytype"]:checked').val();
		if(paytypename=="paypal"){
			$("#checkpaymentspan").css("color","green").text("You select pay by paypal");
		}else if(paytypename=="EMS"){
			$("#checkpaymentspan").css("color","green").text("You select pay by bank");
		}else{
			$("#checkpaymentspan").text("Sorry,you not check pay type!");
		}
	
	});
	
//	On Submitting
	form.submit(function(){
		if(valicheckaddress() && valshippingMethod() )
			return true
		else
			return false;
	});
	
//验证订单表格
   function  valicheckaddress(){
   	var payaddreessid=$("input:radio[name=guestaddressId]:checked").val(); 
		if(payaddreessid=="" || typeof(payaddreessid)=="undefined"){
			$("#checkaddreessspan").text("Sorry,you not check address!");
			return false;
		}else if(payaddreessid==0){
			$("#checkaddreessspan").text("you select a new address");
			return false;
		}else{
			$("#checkaddreessspan").text("you hava select a address").css("color","green");
			 return true;
		}
	}	
	
	function valshippingMethod(){
		var shipmethod=$("input:radio[name=shipmethod]:checked").val(); 
		if(shipmethod=="" || typeof(shipmethod)=="undefined"){
			$("#checkshipspan").text("Sorry,you don't select the  Shipping Method!");
			return false;
		}else{
			$("#checkshipspan").text("You hava selected a shipping method!").css("color","green");
			 return true;
		}
	
	}
	
	
	//验证付款方式【已经被删除】
	function valicheckpaytype(){
		var paymoneytype=$("input:radio[name=checkpaytype]:checked").val(); 
		if(paymoneytype=="" || typeof(paymoneytype)=="undefined"){
			$("#checkpaymentspan").text("Sorry,you not check pay type!");
			return false;
		}else if(paytypename=="paybank"){
			$("#checkpaymentspan").css("color","green").text("You select pay by bank");
			return true;
		}else{
			$("#checkpaymentspan").css("color","green").text("You select pay by paypal");
			return true;
		}
	}
	var AddressData={
		successInfo:'http://'+WEBROOT+'Public/images/done_square.png',
		failInfo:'http://'+WEBROOT+'Public/images/close_square.png'
	}
	
//验证地址表格函数
	function validatefirst(){
		if(guestaccptname.val()==""){
			guestaccptname.css("border","solid 1px red");
			$("#guestaccptnamespan").html("<img src=\""+AddressData.failInfo+"\">");
			return false;
		}else{
			guestaccptname.css("border","solid 1px #ccc");
			$("#guestaccptnamespan").html("<img src=\""+AddressData.successInfo+"\">");
			return true;
		}
	}
	
	function validatelast(){
		if(guestlastname.val()==""){
			guestlastname.css("border","solid 1px red");
			$("#guestlastnamespan").html("<img src=\""+AddressData.failInfo+"\">");
			return false;
		}else{
			guestlastname.css("border","solid 1px #ccc");
			$("#guestlastnamespan").html("<img src=\""+AddressData.successInfo+"\">");
			return true;
		}
	}

	

	
	function validatephone(){
		if(guestphone.val()==""){
			guestphone.css("border","solid 1px red");
			$("#guestphonespan").html("<img src=\""+AddressData.failInfo+"\">");
			return false;
		}else{
			guestphone.css("border","solid 1px ccc");
			$("#guestphonespan").html("<img src=\""+AddressData.successInfo+"\">");
			return true;
		}
	}
	
		function validatepostcode(){
		if(guestfaxcode.val()==""){
			guestfaxcode.css("border","solid 1px red");
			$("#guestfaxcodespan").html("<img src=\""+AddressData.failInfo+"\">");
			return false;
		}else{
			guestfaxcode.css("border","solid 1px ccc");
			$("#guestfaxcodespan").html("<img src=\""+AddressData.successInfo+"\">");
			return true;
		}
	}
	
	
	function validatecity(){
		if(guestcity.val()==""){
			guestcity.css("border","solid 1px red");
			$("#guestcityspan").html("<img src=\""+AddressData.failInfo+"\">");
			return false;
		}else{
			guestcity.css("border","solid 1px ccc");
			$("#guestcityspan").html("<img src=\""+AddressData.successInfo+"\">");
			return true;
		}
	}
	
	function validatestate(){
		if(gueststate.val()==""){
			gueststate.css("border","solid 1px red");
			$("#gueststatespan").html("<img src=\""+AddressData.failInfo+"\">");
			return false;
		}else{
			gueststate.css("border","solid 1px ccc");
			$("#gueststatespan").html("<img src=\""+AddressData.successInfo+"\">");
			return true;
		}
	}
	
	function validateaddress(){
		if(guestaddress.val()==""){
			guestaddress.css("border","solid 1px red");
			$("#guestaddressspan").html("<img src=\""+AddressData.failInfo+"\">");
			return false;
		}else{
			guestaddress.css("border","solid 1px ccc");
			$("#guestaddressspan").html("<img src=\""+AddressData.successInfo+"\">");
			return true;
		}
	}
	

});