(function($){
	$.fn.myValidate=function(options){
		var opts=$.extend({},$.fn.myValidate.defaults,options);
		var element,objArray,strValue,strName;
		var strtext="bbbb"
		return this.click(function(){
			var $objInput=$("form#"+opts.formName);
			$objInput.find("input, select, textarea").each(function(){
				elment=$(this);
				strName=elment.attr("name");
				if(elment.attr('tagattr')!=undefined){
					objArray=elment.attr('tagattr').split("|");
					strValue=elment.val();
					for(var i=0;i<objArray.length;i++){
						CheckType(objArray[i],strValue,strName);
					}
				}
			})
		});
	}
	$.fn.myValidate.defaults={
		formName:'registerform',
		textName:logFunction
	};
	$.fn.myValidate.setDefaults=function(settings) {
		$.extend($.fn.myValidate.defaults,settings);
	};
	
	var logFunction={
		integer:/^\d+$/,
        date:/^((0?\d)|(1[012]))[\/-]([012]?\d|30|31)[\/-]\d{1,4}$/, 
        email:/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i,
        usd:/^\$?((\d{1,3}(,\d{3})*)|\d+)(\.(\d{2})?)?$/,            
        url:/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i,
        number:/^(?=.*\d)(?:[\d \.,]+)$/,
        zip:/^\d{5}(-\d{4})?$/,
        phone:/^((0[0-9]{1})([\-\. ]?))((([0-9]{2})\3){3}([0-9]{2}))$/,
        guid:/^(\{?([0-9a-fA-F]){8}-(([0-9a-fA-F]){4}-){3}([0-9a-fA-F]){12}\}?)$/,
        time12:/^((0?\d)|(1[012])):[0-5]\d?\s?[aApP]\.?[mM]\.?$/,
        time24:/^(20|21|22|23|[01]\d|\d)(([:][0-5]\d){1,2})$/,
        nonHtml:/^[^<>]*$/,
		textcode:/^[a-zA-Z]\w{5,20}$/,
		vercode:/^\d{4}$/,
		checkEmail:function(strValue){
			if(this.email.test(strValue)){
				console.log("aaa");
			}else{
				$("#email_error").text(messages.email);
			}
		},
		checkUnique:function(strValue){
			var t=Math.random();
			// var tempdata="false";
			$.post("http://"+WEBROOT+"memberlist/ajaxEmail/t/"+t,{eamil:strValue,async:true},function(data){
				tempdata=data;
				$("body").data("tempdata",tempdata);
				console.log(data);
				console.log(tempdata);
			});
			//console.log(tempdata);
			console.log($("body").data('tempdata'));
		},
		checkText:function(strValue,strName){
			if(this.textcode.test(strValue)){
				console.log("aaa");
			}else{
				$("span#"+strName+"_error").text(messages.name);
			}
		},
		checkVerCode:function(strValue,strName){
			if(this.vercode.test(strValue)){
				console.log("aaa");
			}else{
				$("span#"+strName+"_error").text(messages.vercode);
			}
		}
	};
	
	var messages = {
        required: "The field {field} is required.",
        grouprequired: "At least one field required.",
        integer: "The field {field} must be numeric.",
        number: "The field {field} must be numeric.",
        email: "Invalid email adress.",
        url: "Invalid URL.",
        phone: "Invalid phone number.",
        lowerthan: "{field1} must be lower than {field2}.",
        greaterthan: "{field1} must be greater than {field2}.",
		name:"请输入5-20位的字符",
		vercode:"请输入4位数字的验证码",
        zip: "Invalid postcode."
    };
	function CheckType(strType,strValue,strName){
		switch(strType){
			case "email":
				logFunction.checkEmail(strValue);
				break;
			case "unique":
				logFunction.checkUnique(strValue);
				break;
			case "number":
				logFunction.checkVerCode(strValue,strName);
				break;
			default :
				logFunction.checkText(strValue,strName);
		}
		
	}
})(jQuery);




	