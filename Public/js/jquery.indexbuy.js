(function($){
	$.fn.IndexOrderBtn=function(options){
		var opts=$.extend({},$.fn.IndexOrderBtn.defaults,options);
		return this.click(function(){
			var $strobj=$(this);
			if($("span[data-prod="+$strobj.attr('dataprodid')+"]").length==1){	//如果属性只有一个的情况下
				$strobj.attr('datacolor',$("span[data-prod="+$strobj.attr('dataprodid')+"]").attr('data-value'));
			};
			if($strobj.attr('datacolor')==""){
				alert('Please select your color!');
			}else{
				if(CheckLoginState()){
					var ttime=new Date();
					var t=ttime.getMilliseconds();
					$.post('ajaxfile/get_prodshow.php?action=addprod&t='+t,{pid:$strobj.attr('dataprodid'),pnum:1,pattrid:$strobj.attr('datacolor')},function(data){
						if(data!='loginin'){
							$('#cart_basket').html(data);
							$strobj.css('background-position','0 -22px');
							/*
							if($strobj.next().is('span')){
								$strobj.next().text('Success');
							}else{
								$strobj.after('<span class=\"bugsuccessmsg\">Success</span>');
							}
							*/
						}
					});
				}else{
					$.cookie("pageurl",window.location.href);
					window.location.href='login.php';	
				}
			}
		})
	};

	$.fn.IndexOrderBtn.defaults={

	};
	$.fn.IndexOrderBtn.setDefaults=function(settings){
		$.extend($.fn.IndexOrderBtn.defaults,settings);
	};

/**
 * @功能是用来点击选中产品销售属性，获取该销售属性的相关信息
 * @ 2012-10-22
*/
	$.fn.spanclick=function(options){
		var opts=$.extend({},$.fn.spanclick.defaults,options);
		return this.each(function(){
			var $spanobj=$(this); //点击的对象
			$spanobj.click(function(){
				$(opts.attrtag).css("border","0 none");
				$spanobj.css("border","solid 2px #ff0000");
					
				var ttime=new Date();
				var t=ttime.getMilliseconds();
				var pattrid=$spanobj.attr(opts.attrname);
				var prodid=$spanobj.attr(opts.attrprodid);
				$('#'+opts.attrobj+prodid).attr(opts.attrvalue,pattrid);

				$.get('ajaxfile/get_prodshow.php?action=prodattr&pattrid='+pattrid+'&t='+t,function(data){
					var strarray=data.split(",");
					$('span#'+opts.attrprice+prodid).html('USD <font color=\"red\" size=\"2\">$ '+strarray[4]+'</font>');
					$('#'+opts.attrimgid+prodid).attr('src','uploadfile/smallimg/'+strarray[5]);
					if(parseInt(strarray[6])<1){
						$('#'+opts.btnremove+prodid).css("display","none");
					}else{
						$('#'+opts.btnremove+prodid).css("display","inline");
					}
					
				});
				
			});
		});
	}
	$.fn.spanclick.defaults={
		attrtag:'div.topbg span',	//系列对象名称
		attrname:'data-value' ,		//指定对象的属性
		attrobj:'prodindex_',		//将值付给指定的对象
		attrprodid:'data-prod',		//获取产品编号
		attrvalue:'datacolor',		//将值付给指定的属性名称
		attrprice:'speciadollor_',	//更改价格
		attrimgid:'prodimag_',		//更换图片
		btnremove:'prodindex_'
		
	};

	$.fn.spanclick.setDefaults=function(settings) {
		$.extend( $.fn.spanclick.defaults, settings );
	};	
	
	
})(jQuery);


	
function CheckLoginState(){
	var ttime=new Date();
	var t=ttime.getMilliseconds();

	$.get('ajaxfile/get_session.php?t='+t,function(data){
		$.cookie('guestlogin',data)
	});
	if($.trim($.cookie('guestlogin'))=='loginsuccess'){
		return true;
	}else{
		return false;
	}

}