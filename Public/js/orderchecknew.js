(function($){

//送货地址选择功能
	$.fn.RadioCheckData=function(options){
		var opts=$.extend({},$.fn.RadioCheckData.defaults,options);
		return this.click(function(){
			var $strobj=$(this);
			var strvalue=$strobj.attr('value');
			var strdatavalue=$strobj.attr('datavalue');
			if(opts.tablehid&&opts.radiochkon==strvalue){
				$("."+opts.tablehidname).css('display','inline');
				$('#'+opts.submitbtnid).attr("disabled","disabled").css("background","url(./images/button.png) 0px -264px no-repeat");
				$('#'+opts.tipspanid).text('Please fill in the form!').css('color','red');
			}else{
				$("."+opts.tablehidname).css('display','none');
				$('#'+opts.tipspanid).text('Confirm this step and go on');
				$('#'+opts.submitbtnid).removeAttr("disabled").css("background","url(./images/button.png) 0px -180px no-repeat");
				if($('p.confirm_p_address').length>0){
					$('p.confirm_p_address').html('<span>Consignee information:</span>'+strdatavalue)
				}else{
					$('#'+opts.insertDivid).append('<p class=\"confirm_p_address\"><span>Consignee information:</span>'+strdatavalue+'</p>')
				}
			}
		})
	};
	$.fn.RadioCheckData.defaults={
		submitbtnid:'checkaddreess',	//提交对应的按钮ID
		tipspanid:'checkaddreessspan', 	//提示span的ID
		insertDivid:'confirmInfo',		//插入内容DIV的ID
		tablehid:true,			//是否隐藏表格
		radiochkon:0,			//隐藏表格对应值
		tablehidname:'ordercheck_table'
	};
	$.fn.RadioCheckData.setDefaults=function(settings){
		$.extend($.fn.RadioCheckData.defaults,settings)
	}

//选择对应的选项确定对应的栏目
	$.fn.RadioCheckView=function(options){
		var opts=$.extend({},$.fn.RadioCheckView.defaults,options);
		return this.click(function(){
			var $strobject=$(this);
			var strvalue=$strobject.attr('value');
			var strdatavalue=$strobject.attr('datavalue');
			$('#'+opts.tipspanid).text('Confirm this step and go on');
			$('#'+opts.submitbtnid).removeAttr("disabled").css("background","url(./images/button.png) 0px -180px no-repeat");
			if($('p.confirm_p_ship').length>0){
				$('p.confirm_p_ship').html('<span>Delivery way:</span>'+strdatavalue)
			}else{
				$('#'+opts.insertDivid).append('<p class=\"confirm_p_ship\"><span>Delivery way:</span>'+strdatavalue+'</p>')
			}
		})
	};
	$.fn.RadioCheckView.defaults={
		insertDivid:'confirmInfo'	
	};
	$.fn.RadioCheckView.setDefaults=function(settings){
		$.extend($.fn.RadioCheckView.defaults,settings);
	}

	
})(jQuery);




$(document).ready(function(){
	$("input[name=guestaddressId]").RadioCheckData();
	$("input[name=shipmethod]").RadioCheckView({submitbtnid:'checkship',tipspanid:'checkshipspan'});
})
function showChoice(strobk){
	$("."+strobk).css('display','inline');
}