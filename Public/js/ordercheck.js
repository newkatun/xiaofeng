
//点击新增地址显示地址表单
	function shownew_address(strshow){
		if(strshow=="show"){
			$(".ordercheck_table").css("display","inline");
			$("#checkaddreess").attr("disabled","disabled");
			$("#checkaddreess").css("background","url(./images/btn_online.png) 3px -115px no-repeat");
			$("#checkaddreessspan").text('Please fill in the form').css('color','red');
		}else{
			$(".ordercheck_table").css("display","none");
			$("#checkaddreess").removeAttr("disabled");
		}
		var addressID= $("input:radio[name=selectaddress]:checked").val(); 
		$("#addessid").attr("value",addressID);
		if(addressID!=0){
			$("#checkaddreess").css("background","url(./images/btn_online.png) -327px -115px no-repeat");
			$("#checkaddreessspan").text("Confirm this step and go on");
		}
	}
	//选择物流方式
	function confromship(){
		$("#checkship").removeAttr("disabled");
		$("#checkship").css("background","url(./images/btn_online.png) -327px -115px no-repeat");
		$("#checkshipspan").text("Confirm this step and go on");
	}
	//选择国家
	function checkcountry(){
		//$("#countryname").attr("value",$("#guestcountry").val());
		var countryname=$("#guestcountry").val();
		$("#countryname").attr("value",countryname);
		//alert($("#countryname").val());
	}
	function showpaybybank(strshow){
		if(strshow=="show"){
			$("#paybank_table").css("display","inline");
			$("#checkpaymentspan").text(" ")
		}else{
			$("#paybank_table").css("display","none");
			$("#checkpaymentspan").text(" ")
		}
	}
	
	function confirmAddress(){
		$('div.ordercheck_table').css("display","none");
		$("#checkaddreess").removeAttr("disabled").css("background","url(./images/btn_online.png) -327px -115px no-repeat");
		$("#checkaddreessspan").text("Confirm this step and go on");
		
	}
	
	function showChoice(strobk){
		$("."+strobk).css('display','inline');
	}