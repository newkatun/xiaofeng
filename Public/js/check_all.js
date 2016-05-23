var commonSymbol ="[\\,\\`\\~\\!\\@\\#\\$\\%\\\\\^\\&\\*\\(\\)\\-\\_\\=\\+\\[\\{\\]\\}\\\\\|\\;\\:\\‘\\’\\“\\”\\<\\>\\/?]+"; 
var WEBURL='http://'+location.hostname+'/';
var spliter = ",";

function saveToCookie(){
	var name = jQuery("#name").val();
	var password = jQuery("#password").val();
	var email = jQuery("#email").val();
	var rePassword = jQuery("#password2").val();
	var  tmpStr = name+spliter+password+spliter+rePassword+email;
	$.cookie("register_info", tmpstr);
}
function showoff(id){
	var strAry = id.split("_");
	if(strAry[0]!="password"){
	jQuery("#"+strAry[0]+"_error").hide();
	jQuery("#"+strAry[0]+"_tip").show();
	}
	jQuery("#"+id+"").hide();
}
function checkWords(){
	var password = jQuery("#password").val();
    var userName = jQuery("#name").val();
    if(userName==undefined){
    	return false;
    }
    if(userName.substring(0,userName.length-1)==password){
        return true;
    }
    if(userName.substring(0,userName.length-1)==password.substring(0,password.length-1)){
    	 return true;
    }
    if(userName.substring(1,userName.length)==password){
    	 return true;
    }
    if(userName.substring(1,userName.length)==password.substring(1,password.legnth)){
    	 return true;
    }
    if(password.substring(0,password.length-1)==userName){
    	return true;
    }
    if(password.substring(1,password.length)==userName){
      	return true; 
     }
}
	function trim(str){ //删除左右两端的空格  
		return str.replace(/(^\s*)|(\s*$)/g, "");  
	}  
	function ltrim(str){ //删除左边的空格  
		return str.replace(/(^\s*)/g,"");  
	}  
	function rtrim(str){ //删除右边的空格  
		return str.replace(/(\s*$)/g,"");  
	} 
	function isSameWord(words){
		var firstTmp;
		if(words!=null&&words!=""){
			firstTmp = words.charAt(0);
		}
		var patternTmp =  "["+firstTmp+"]{"+(words.length)+"}";
		var pattern = new RegExp(patternTmp);
		return pattern.test(words);
	}
	function checkYZCode(strobj){
		var strcode=strobj.value;
		if(strcode.length==4){
			$.post(WEBURL+'Publicuse/yanzheng',{'yzcode':strcode},function(data){
				if(data=='true'){
					jQuery("#validCode_tip").hide();
					jQuery("#validCode").css("border",'solid 1px #CCCCCC');
					jQuery('#volidretCheck').attr('value',"true");
				}else{
					$('#validCode').css('border','solid 1px #960000');
					$("#validCode_tip").text("Verification code wrong !").css("color","#960000");
					jQuery('#volidretCheck').attr('value',"false");
					jQuery("#validCode_tip").show();
				}
			});
		}else{
			$('#validCode').css('border','solid 1px #960000');
			$("#validCode_tip").text("Verification code wrong !").css("color","#960000");
		}
	} 
	function hideOtherTips(id){
		jQuery("#email_tip").hide();
		jQuery("#name_tip").hide();
		jQuery("#password_tip").hide();
		jQuery("#password2_tip").hide();
		jQuery("#validcode_tip").hide();
		if(jQuery("#"+id+"").val()==""){
			jQuery("#"+id+"_error").hide();	
			jQuery("#"+id+"_tip").show();	
		}
		jQuery("#"+id+"").removeClass("redErorBodr");
			
	}
	function check_email(){	
	   	var email = jQuery('#email').val();
		if(email == ""){
			return 1;
		}
		var reg = "^([a-zA-Z0-9_\\-|\\,\\.\\=\\/\\$\\/\\^\\/\\(\\/\\)\\/\\-\\/\\_\\/\\+\\/\\[\\/\\]\\/\\{\\/\\}])+@([a-zA-Z0-9_\\-])+((\\.[a-zA-Z0-9_\\-]{2,4}){1,2})$";
		var email_reg = new RegExp(reg);
        if(!email_reg.test(email)){
        	return 2;
        }
        if(email.length > 100){
			return 3;
		}
		
        return 0;
    } 
    function showTipMsg(){
		var strEmail=jQuery('#email').val();
		if(strEmail=='Your Email'){
			jQuery('#email').attr('value','');	
			showErrorInfo("email_error",errorInfoText.emailerror);
			return 2;
		}
	}
	 
    function check_pwd1(){ 
    	var password=$("#password").val();
		if(password==""){
			return 1;      //密码为空
		}
		if(password.length>20){
        	return 2;     //密码长度超过20
        }
        if(password.length<6){
        	return 3;     //密码长度小于6
        }	
        var pattern = /\s+/;
        if(pattern.test(password)){
           return 4;     //密码中包含空格
        }
        var isAllNumPattern = /^[0-9]+$/;
        if(isAllNumPattern.test(password)){
        	return 5;   //密码全由数字组成
        }
        
        var isALLCharPattern=/^[a-zA-Z]+$/;
        if(isALLCharPattern.test(password)){
        	return 6;    //密码全由字母组成
        }
        
        var isAllSpecial =/^[^0-9A-Za-z]+$/;
        if(isAllSpecial.test(password)){
        	return 7;    //密码全由特殊字符组成
    	}
        
        if(isSameWord(password)){
            return 8;   //密码都是由相同字母或数字组成
         }
        
        if(checkWords()){
	   		return 9;  //密码和用户名相似
	   	}
        
		var numPattern = "d*"+commonSymbol +"";
		var allPattern ="\\\d+[A-Za-z]|[A-Za-z]+[0-9]+|[A-Za-z]+"+commonSymbol+"[0-9]+|[A-Za-z]+[0-9]+"+commonSymbol+"|"+numPattern +"";
		var allReg = new RegExp(allPattern);
        if(!allReg.test(password)){
           return 10;   //密码不符合 字母+数字 或 字符+数字 或 字母+字符 或 字母+字符+数字
        }
	   		return 0;
    }
    
    function check_pwd2(){
		var password=$("#password").val();
		var password2=$("#password2").val();
		if(password2==""){
			return 1;	//确认密码为空
		}
		if(password!=password2){
			return 2;	//确认密码与密码不相同
		}
		return 0;
    } 
     
    function checkPassWordContent(){
		 jQuery("#password").removeClass("redErorBodr");
    	var password = jQuery("#password").val();
    	if(password.length>0){
    		changePassStrong();
    	}
    	else{
    		hideOtherTips("password");
    	}
    }
    
    function check_referer(){
    	var referer=$("#referer").val().replace(/(^ *)|( *$)/g,"");
		if (referer!=""){
			if($("#refererDesc").html().indexOf("image")==-1){
	        	return 1;
	        }
		}
    }
    	
    function showErrorInfo(id,errorInfo){
		jQuery("#"+id+"").removeClass("extra").addClass("errorinfo").html(""+errorInfo+"").show();
		jQuery("#pswdLevel").hide();
		var strs=id.split("_");
		jQuery("#"+strs[0]+"_desc").hide();
		jQuery("#"+strs[0]+"").addClass("redErorBodr");
	}
	
	function showNameError(errorInfo){
		jQuery("#name_tip").hide();
		showErrorInfo("name_error",errorInfo)
	}
	function showZhnameError(errorInfo){
		jQuery("#zhname_tip").hide();
		showErrorInfo("zhname_error",errorInfo)
	}
	function showAddressError(errorInfo){
		jQuery("#address_tip").hide();
		showErrorInfo("address_error",errorInfo)
	}
	
	function showPhoneError(errorInfo){
		jQuery("#telphone_tip").hide();
		showErrorInfo("telphone_error",errorInfo)
	}
	function showPassError(errorInfo){
		jQuery("#password_tip").hide();
		showErrorInfo("password_error",errorInfo)
	}
	function showPass2Error(errorInfo){
		jQuery("#password2_tip").hide();
		showErrorInfo("password2_error",errorInfo)
	}
	function showEmailError(errorInfo){
		jQuery("#email_tip").hide();
		showErrorInfo("email_error",errorInfo)
	}
	function showCodeError(errorInfo){
		jQuery("#validCode_tip").hide();
		showErrorInfo("validCode_error",errorInfo);
	}
	function showProvienceError(errorInfo){
		jQuery("#province_tip").hide();
		showErrorInfo("province_error",errorInfo);
	}
	
	function checkCodeOnBlur(){
		 if($("#validCode").val()==""){
        	showCodeError("Verification code can not be empty !");
        }else if($("#validCode").val().length != 4) {
        	showCodeError("Verification code must be 4 !");
        }
	}
	
	function checkEmailOnBlur(){
		var clickFlag = false;
		var check_email_rs=check_email();
		if (check_email_rs==1){
			showEmailError("This infomation is required!");
		}else if(check_email_rs==2){
			showEmailError("E-mail account mistake !");
		}else if(check_email_rs==3){
			showEmailError("E-mail can not be longer ultralow 100 !");
		}else{
			$.post(WEBURL+'Memberlist/ajaxEmail',{'email':$("#email").val()},function(data){
				if(data=='true'){
					jQuery("#email_tip").hide();
					jQuery("#email").removeClass("redErorBodr");
					jQuery("#email_desc").addClass("rightinfo").show();
					jQuery('#volidret').attr('value','true');
				}else if(data=='false'){
					showEmailError(errorInfoText.emaillive);
				}
			})
		}
		if(isRed==false){
			jQuery("#email").removeClass("redErorBodr");
		}
	}
	//检查用户名称
	function check_Name(){
		var un=$("#name").val();
		var exception=/^[0-9a-zA-Z\,\$\^\(\)\-\_\+\[\]\{\}\u4e00-\u9fa5]{3,20}$/;
		if(un==""){
			return 1;	//用户名称为空
		}
		if(un.length<2 ){
			return 2;	//长度小于2
		}
		if(un.length>20){
			return 3;	//长度大于20
		}
		if(!exception.test(un)){
			return 4;	//不符合要求
		}
	}

	function checkNameOnBlur(){
		var check_name_rs = check_Name();
		if(check_name_rs==1){
			showNameError("This infomation is required!!");	
		}else if(check_name_rs==2){
			showNameError("Your name length is 3-20 bits !");
		}else if(check_name_rs==3){
			showNameError("Your name length is 3-20 bits !");
		}else if(check_name_rs==4){
			showNameError("Your name format error !");
		}
	}
	
	function checkZhnameOnBlur(){
		var check_zhname_rs = checkTrueName();
		if(check_zhname_rs==1){
			showZhnameError("真实姓名不能为空！");	
		}else if(check_zhname_rs==2){
			showZhnameError("真实姓名长度必须大于等于2！");
		}else if(check_zhname_rs==3){
			showZhnameError("真实姓名必须是中文！");
		}else{
			$("#zhname_error").addClass("rightinfo").show();
			$("#zhname_error").text("");
			hideOtherTips("none");
			jQuery("#zhname").removeClass("redErorBodr");
		}
	}
	
	function checkAddressOnblur(){
		var check_address_rs = checkAddress();
		if(check_address_rs==1){
			showAddressError("详细地址不能为空");	
		}else if(check_address_rs==2){
			showAddressError("详细地址长度不能小于5！");
		}else{
			$("#address_error").addClass("rightinfo").show();
			$("#address_error").text("");
			hideOtherTips("none");
			jQuery("#address").removeClass("redErorBodr");
		}
	}
	
	function checkPhoneOnblur(){
		var check_phone_rs = checkPhone();
		if(check_phone_rs==1){
			showPhoneError("联系方式不能为空");	
		}else if(check_phone_rs==2){
			showPhoneError("联系方式长度不能小于7或大于13！");
		}else{
			$("#telphone_error").addClass("rightinfo").show();
			$("#telphone_error").text("");
			hideOtherTips("none");
			jQuery("#telphone").removeClass("redErorBodr");
		}
	}
	function checkProvinceOnBlur(){
		var check_provience_rs = checkProvience();
		if(check_provience_rs==1){
			showProvienceError("请选择省份城市地区！");	
		}else{
			$("#province_error").addClass("rightinfo").show();
			$("#province_error").text("");
			hideOtherTips("none");
			jQuery("#province").removeClass("redErorBodr");
		}
	}
	
	function checkPasswordOnBlur(){
		hideOtherTips("password");	
		var password = jQuery("#password");
		var check_pwd1_rs=check_pwd1();
		if(check_pwd1_rs!=0){
			jQuery("#password2").attr("readonly","readonly");
		}
		if (check_pwd1_rs==1){
			showPassError("This infomation is required! ");
			
		}else if(check_pwd1_rs==2){
			showPassError("Password must have at least 6-20 characters!");           
        }else if(check_pwd1_rs==3){
        	showPassError("Password must have at least 6-20 characters!");
        }else if(check_pwd1_rs==4){
        	showPassError("Password must not contain spaces!");
        }
        else if(check_pwd1_rs==5){
        	showPassError("Password must not be all numbers!");
        }
        else if(check_pwd1_rs==6){
        	showPassError("Password must not be all letters, have at least one number!");
        }
        else if(check_pwd1_rs==7){
        	showPassError("Password must not be all special characters!");
        }
        else if(check_pwd1_rs==8){
        	showPassError("Password must not be all special characters!");
        }
        else if(check_pwd1_rs==9){
        	showPassError("Password must not contain multiple identical consecutive characters!");
        }
        else{
			$("#password_desc").addClass("rightinfo").show();
			$("#password_desc").text("");
			hideOtherTips("none");
			jQuery("#password").removeClass("redErorBodr");
			jQuery("#password2").removeAttr("readonly");
			jQuery("#password2").removeAttr("readonly");
		}
	}
	function checkPassword2OnBlur(){
		var check_pwd2_rs=check_pwd2(); 
		if(check_pwd2_rs==1){
			showPass2Error("This infomation is required! ");
		}else if(check_pwd2_rs==2){
			showPass2Error("Passwords did not match. Please try again.");
		}else{
			$("#password2_desc").addClass("rightinfo").show();
			jQuery("#password2").removeClass("redErorBodr");
			hideOtherTips("none");
		}
	}
	function mySubmit()	{  
		setTimeout(function(){
			if(doSubmit()){ 
			document.registerform.submit();
		}else{
			refresh_valid_code();
		}
		},1000);
		
	}
	function getPassPoint(){
		var password = jQuery("#password").val();
		var point = checkPassLength(password);
		point = point+checkPassSymbol(password);
		point = point +checkPassNumAndWord(password);
		point = point+(checkPassAll(password));
		point = point+checkPassAlpha(password);
		point = point+checkPassNum(password);
		return point;
	}
	function checkPassLength(password){
		if(password.length>6&&password.length<8){
			return 10;
		}
		if(password.length>=9){
			return 25;
		}
		return 0;
	}
	
	function checkPassSymbol(password){
		if(getSymbolPattern(2).test(password)){
			return 25;
		}
		else if(getSymbolPattern(1).test(password)){
			return 10;
		}
		return 0;
	
	}
	function getSymbolPattern(times){
		var tmp = ""+commonSymbol.substr(0,commonSymbol.length-1)+"{"+times+",}";
		var pattern = new RegExp(tmp);
		return pattern;
		
	}
    var patternNumAlpha =  /^(?=.*\d.*)(?=.*[a-zA-Z].*)./;
	function checkPassNumAndWord(password){
		
		if(patternNumAlpha.test(password)){
			return 5;
		}
		return 0;
		
	}
	
	function isDigit(s)
	{
		var patrn=/(?=.*[0-9])/;
		return getCompareResult(patrn,s);
	} 
	function isBigWord(s)
	{
		var patrn=/(?=.*[A-Z])/;
		return getCompareResult(patrn,s);
	} 
	function isSymbol(s)
	{
		var tmp="(?=.*"+commonSymbol.substr(0,commonSymbol.length-1)+")";
		var patrn = new RegExp(tmp)
		return getCompareResult(patrn,s);
	}	 
	function isSmallWord(s)
	{
		var patrn=/(?=.*[a-z])/;
		return getCompareResult(patrn,s);
	} 
	function getCompareResult(patrn,s){
   		 if(patrn.test(s)){
   		 	return true;
   		 	}
			return false;    
	}
	function checkPassAll(password){
		if(isDigit(password)&&isBigWord(password)&&isSmallWord(password)&&isSymbol(password)){
				return 5;
		}
		if(patternNumAlpha.test(password)){
			if(isSymbol(password)){
				return 3;
			}else{
			return 2;
			}
		}
		return 0;
	}

	
	// 检查密码字符
	function checkPassAlpha(password){
		var count = 0;
		var countBig = 0;
		var countLittle = 0;
		var length =  password.length;
		var purePattern=/^[a-z]+$|^[A-Z]+$/;
		if(purePattern.test(password)){
			return 10;
		}
		var mixedPattern = /.*?[A-Z]+?.*?[a-z]+?.*?|.*?[a-z]+?.*[A-Z]+?.*?/;
		if(mixedPattern.test(password)){
			return 25;
		}
		return 0;
		}
	function checkPassNum(password){
		if(getNumPattern(3).test(password)){
			return 20;
		}
		if(getNumPattern(1).test(password)){
			return 10;
		}
		return 0;
	}
	function getNumPattern(numCount){
		var tmp = "[0-9]{"+numCount+",}";
		var pattern = new RegExp(tmp);
		return pattern;	
	}
	function changePassStrong(){
		var password = jQuery("#password");
		//验证密码是否符合要求，通过为0，移除disabled属性，否则加上disabled属性
		if(check_pwd1()===0){
			jQuery("#password2").removeAttr("disabled");
		}else{
			jQuery("#password2").attr("disabled","disabled");
		}
		if(password.val().length==0){
			jQuery("#pswdLevel").hide();
			hideOtherTips("password");
			return;
		}else{
			jQuery("#password_tip").hide();
			jQuery("#password_error").hide();
		}
		
		var point = getPassPoint(password);
		jQuery("#pswdLevel").attr("class","").addClass("pswdLevelA").attr("style","display:block");;
		if(point>=80){
			jQuery("#pswdLevel").attr("class","").addClass("pswdLevelC").attr("style","display:block");;
			return;
		}
		if(point>=50){
			jQuery("#pswdLevel").attr("class","").addClass("pswdLevelB").attr("style","display:block");;
			return;
		}
	}
	function refresh_valid_code(){ 
		var dt = new Date(); 
		
		//jQuery("#validCode").removeClass("redErorBodr");
		//jQuery("#validCode_error").hide();
		$("#valid_code_pic").attr("src","/passport/valid_code.do?t=" + dt); 
	}
	
	
	function checkRefererLink(){
		var pars=location.search;
		if(pars.indexOf("rlink")!=-1){ 
			$("#referer").attr('readonly','readonly'); 
		} 
	
	}
	
	function checkTrueName(){
		var zhname=$("#zhname").val();
		if(zhname==""){
			return 1; //为空
		}
		if(zhname.length<2){
			return 2; //长大小于2
		}
		var pattern=/^[\u4e00-\u9fa5]{2,}$/;
		if(!pattern.test(zhname)){
			return 3; //非中文字符
		}
		return 0;
	}
	
	function checkAddress(){
		var address=$("#address").val();
		if(address==""){
			return 1; //为空
		}
		if(address.length<5){
			return 2; //长大小于2
		}
		return 0;
	}
	function checkPhone(){
		var phone=$("#telphone").val();
		if(phone==""){
			return 1;//为空
		}
		if(phone.length<7 || phone.length>13){
			return 2;//电话长度大于7
		}
		
	}
	
	
	function checkProvience(){
		var province=$("#province").val();
		if(province==""){
			return 1;//为空
		}
		return 0;
	}
	