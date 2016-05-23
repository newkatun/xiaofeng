var clickFlag=false;
var nowid;
var totalid;
var can1press = false;
var emailafter;
var emailbefor;
var isShow = true;
var isRed = true;
var showCodeFlag = false;
var WebName='/zheli/';
$(document).ready(function(){
	$("#email").focus(function(){$("#email").addClass("curr_ipt198");});
	$("#email").blur(function(){$("#email").removeClass("curr_ipt198");});
	$("#name").focus(function(){$("#name").addClass("curr_ipt198");});
	$("#name").blur(function(){$("#name").removeClass("curr_ipt198");});
	$("#password").focus(function(){$("#password").addClass("curr_ipt198");});
	$("#password").blur(function(){$("#password").removeClass("curr_ipt198");});
	$("#password2").focus(function(){$("#password2").addClass("curr_ipt198");});
	$("#password2").blur(function(){$("#password2").removeClass("curr_ipt198");});
	$("#validCode").focus(function(){$("#validCode").addClass("curr_ipt98");});
	$("#validCode").blur(function(){$("#validCode").removeClass("curr_ipt98");});
	$("#zhname").focus(function(){$("#zhname").removeClass("curr_ipt98");});
	$("#zhname").blur(function(){$("#zhname").removeClass("curr_ipt98");});
	$("#address").focus(function(){$("#address").removeClass("curr_ipt98");});
	$("#address").blur(function(){$("#address").removeClass("curr_ipt98");});
	$("#telphone").focus(function(){$("#telphone").removeClass("curr_ipt98");});
	$("#telphone").blur(function(){$("#telphone").removeClass("curr_ipt98");});
	jQuery("#email").focus().addClass("curr_ipt198");
	$("#validCode").val("");
	if(showCodeFlag==true){
		jQuery("#validCode_tip").hide();
		jQuery("#validCode_error").show();
	}
	jQuery("#email").keyup(function(event){ 
	     //获取当前按键的键值 
	     //jQuery的event对象上有一个which的属性可以获得键盘按键的键值 
	     var keycode = event.which;
	     //处理回车的情况 
	    if(keycode==8){
	    	isShow=true;
	    }
	 });
	jQuery("#validCode").keyup(function(event){ 
	     //获取当前按键的键值 
	     //jQuery的event对象上有一个which的属性可以获得键盘按键的键值 
	     var keycode = event.which;
	     //处理回车的情况 
	     if(keycode==13){ 
	    	 if(doSubmit()){
	    		jQuery("#registerform").submit();
	    	 }
	    } 
	     //处理esc的情况 
	     if(keycode == 27){ 
	       
	       
	     } 
	 });
	jQuery("#name").keypress(function(event){ 
		
	     //获取当前按键的键值 
	     //jQuery的event对象上有一个which的属性可以获得键盘按键的键值 
	     var keycode = event.which;
	     //处理回车的情况 
	    if(keycode==32){
	    	return false;
	    }
	 });
	jQuery("#email").keypress(function(event){ 
		
	     //获取当前按键的键值 
	     //jQuery的event对象上有一个which的属性可以获得键盘按键的键值 
	     var keycode = event.which;
	     //处理回车的情况 
	    if(keycode==8){
	    	isShow=true;
	    }
	 });
    $("#email").focus(function(){ // 文本框获得焦点，插入Email提示层
    	jQuery("#email").removeClass("redErorBodr");
        $("#myemail").remove();
        hideOtherTips("email");
	$(this).after("<div id='myemail'></div>");
        if($("#myemail").html()){
             $("#myemail").css("display","block");
	$(".newemail").css("width",$("#myemail").width());
		can1press = true;
        } else {
             $("#myemail").css("display","none");
		can1press = false;
        }		
    }).keyup(function(){
   	 if(clickFlag==false){
        $("#myemail").remove();
    	$(this).after("<div id='myemail'></div>");
            if($("#myemail").html()){
                 $("#myemail").css("display","block");
    	$(".newemail").css("width",$("#myemail").width());
    			can1press = true;
            } else {
                 $("#myemail").css("display","none");
                 can1press = false;
            }
     }
   	 
    	// 文本框输入文字时，显示Email提示层和常用Email
		var press = $("#email").val();
		if ((press!="" || press!=null)&&clickFlag==false&&isShow==true){
		var emailtxt = "";			
		var emailvar = new Array("@163.com","@qq.com","@126.com","@hotmail.com","@gmail.com","@sohu.com","@yahoo.cn","@139.com","@sina.com.cn","@vip.sina.com","@msn.com");
		totalid = emailvar.length;
			if(!(isEmail(press))){
			    for(var i=0; i<emailvar.length; i++) {
				    emailtxt = emailtxt + "<div class='newemail' style='width:170px; color:#6B6B6B; overflow:hidden;'><font >" + press + "</font>" + emailvar[i] + "</div>"
			    }
			} else {
			    emailbefor = press.split("@")[0];
			    emailafter = "@" + press.split("@")[1];
			    for(var i=0; i<emailvar.length; i++) {
			         var theemail = emailvar[i];
			         if(theemail.indexOf(emailafter) == 0)
			         {
				         emailtxt = emailtxt + "<div class='newemail' style='width:170px; color:#6B6B6B; overflow:hidden;'><font color='#D33022'>" + emailbefor + "</font>" + emailvar[i] + "</div>"
				     }
			    }
			}
			$("#myemail").html(emailtxt);
			if($("#myemail").html()){
				 $("#myemail").css("display","block");
				 $(".newemail").css("width",$("#myemail").width());
				 can1press = true;
			} else {
				 $("#myemail").css("display","none");
				 can1press = false;
			}
			beforepress = press;
		}
		if (press=="" || press==null){
		    $("#myemail").html("");		
		    
		     $("#myemail").css("display","none");    
		}				
    })
	$(document).click(function(){ // 文本框失焦时删除层
        if(can1press){
			$("#myemail").remove();
			can1press = false;		
		}
    })
    $(".newemail").live("mouseover",function(){ // 鼠标经过提示Email时，高亮该条Email
        $(".newemail").css("background","#FFFFFF");
        $(this).css("background","#E0EEE0");
        jQuery("#email").removeClass("redErorBodr");
		$(this).focus();
		nowid = $(this).index();
    }).live("click",function(){ // 鼠标点击Email时，文本框内容替换成该条Email，并删除提示层
        var newhtml = $(this).html();
        newhtml = newhtml.replace(/<.*?>/g,"");
        jQuery("#email").removeClass("redErorBodr");
        $("#email").val(newhtml); 
        $("#myemail").remove();
        jQuery("#email_error").hide();
        checkEmailOnBlur();
    })
	$(document).bind("keydown",function(e)  
	{     
		if(can1press){
			switch(e.which)     
			{            
				case 38:
				if (nowid > 0){		

					isRed = false;
					clickFlag = true;
					$(".newemail").css("background","#FFF");
					$(".newemail").eq(nowid).prev().css("background","#CACACA").focus();
					nowid = nowid-1;		
				}
				if(!nowid){

					isRed = false;
					clickFlag = true;
					nowid = 0;
					$(".newemail").css("background","#FFF");
					$(".newemail").eq(nowid).css("background","#CACACA");		
					$(".newemail").eq(nowid).focus();				
				}
				break;       
		
				case 40:
				if (nowid < totalid){	
					clickFlag = true;

					isRed = false;
					$(".newemail").css("background","#FFF");
					$(".newemail").eq(nowid).next().css("background","#CACACA").focus();
					nowid = nowid+1;			
				}
				if(!nowid){
					nowid = 0;
					clickFlag = true;

					isRed = false;
					$(".newemail").css("background","#FFF");
					$(".newemail").eq(nowid).css("background","#CACACA");		
					$(".newemail").eq(nowid).focus();				
				}
				break;  
		
				case 13:
				clickFlag = false;
				isRed = false;
				var newhtml = $(".newemail").eq(nowid).html();
				newhtml = newhtml.replace(/<.*?>/g,"");
				$("#email").val(newhtml); 
				$("#myemail").remove();
				jQuery("#email_error").hide();
				jQuery("#email").focus();
				isShow = false;
				checkEmailOnBlur();
			}
		}   
	})
}) 


	// 检查email邮箱
	function isEmail(str){
	    if(str.indexOf("@") > 0)     
	    {     
	        return true;
	    } else {
	        return false;
	    }
	}

	function doSubmit(){  
		var check_email_rs=check_email();
		if(check_email_rs==1){
			 showEmailError("The E-mial  can not be empty !");
			 return false;
		}else if(check_email_rs==2){
			 showEmailError("");
			 $("#email_error").html("E-mail format error !");
			 return false;
		}else if(check_email_rs==3){
			 showEmailError("");
		     $("#email_desc").html("E-mail can not be longer than 100 !");
		     return false;
		}else if($("#email_desc").html()=="Repeat email"){
			  $("#email").focus();
			  return false;
		}
	
		var check_name_rs=check_Name();
		if(check_name_rs==1){
			showNameError("User Name can not be empty !");
			return false;
		}else if(check_name_rs==2){
			showNameError("Length can only 3-20 bits !");
			return false;
		}else if(check_name_rs==3){
			showNameError("Length can only 3-20 bits !");
			return false;
		}else if(check_name_rs==4){
			showNameError("User Name format error !");
			return false;
		}
		
/* 		var zhname_view=checkTrueName();
		if(zhname_view==1){
			showZhnameError("真实姓名不能为空！");	
			return false;
		}else if(zhname_view==2){
			showZhnameError("真实姓名长度必须大于等于2！");
			return false;
		}else if(zhname_view==3){
			showZhnameError("真实姓名必须是中文！");
			return false;
		}
		
		var address_view=checkAddress();
		if(address_view==1){
			showAddressError("详细地址不能为空");	
			return false;
		}else if(address_view==2){
			showAddressError("详细地址长度不能小于5！");
			return false;
		}
		var provience_view=checkProvience();
		if(provience_view==1){
			showProvienceError("请选择省份城市地区！");	
			return false;
		}
		var phone_view=checkPhone();
		if(phone_view==1){
			showPhoneError("联系方式不能为空");	
			return false;
		}else if(phone_view==2){
			showPhoneError("联系方式长度不能小于7或大于13！");
			return false;
		}
		
   
		if(doSubmitPwd()==false){
			return false;
		} */
		
		
		if($("#validCode").val()==""){
			showCodeError("Verification code can not be empty !");
			return false;
		}else if($("#validCode").val().length != 4) {
			showCodeError("Verification code must be between 4 !");
			return false;	
		}else {
			var strReturnText=$('#volidretCheck').val();
			if(strReturnText!="true"){
				return false;
				showCodeError("Verification code error !");
			}else{
				$("#validCode_desc").hide();
			}
		}
		return true;
	}	  
	
	function doSubmitPwd(){
		var check_pwd1_rs=check_pwd1();
		if (check_pwd1_rs==1){
			showPassError("Password can not be empty !");
			return false;
		}
		if(check_pwd1_rs==2){
			showPassError("The password's length is 6-20 !");    
			return false;
        }
		if(check_pwd1_rs==3){
        	showPassError("The password's length is 6-20 !");
        	return false;
        }
        if(check_pwd1_rs==4){
        	showPassError("Spaces are not allowed in passwords !");
        	return false;
        }
        if(check_pwd1_rs==5){
        	showPassError("Passwords can not are all digital !");
        	return false;
        }
        if(check_pwd1_rs==6){
        	showPassError("Passwords can not all be a letter , must contain a number !");
        	return false;
        }
        if(check_pwd1_rs==7){
        	showPassError("Passwords can not all special symbols !");
        	return false;
        }
         if(check_pwd1_rs==8){
        	showPassError("Password can not be the same character !");
        	return false;
        }
        if(check_pwd1_rs==9){
        	showPassError("Password and account name that is !");
        	return false;
        }
	    var check_pwd2_rs=check_pwd2();
	    if(check_pwd2_rs==1){
	     	showPass2Error("Confirm password can not be empty !");
			return false;
	    }else if(check_pwd2_rs==2){
	    	showPass2Error("The two passwords do not match !");
			return false;
	    }
	}

	