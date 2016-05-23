(function($){
/**
 * @功能是用来点击选中团购产品销售属性，获取该销售属性的相关信息
 * @ 2012-10-22
*/
	$.fn.groupColorSpan=function(options){
		var opts=$.extend({},$.fn.groupColorSpan.defaults,options);
		return this.each(function(){
			var $gspanobj=$(this);
			$gspanobj.click(function(){
				$(opts.attrtag).css("border","solid 2px #000000");
				$gspanobj.css("border","solid 2px #ff0000");
				var ttime=new Date();
				var t=ttime.getMilliseconds();
				var pattrid=$gspanobj.attr(opts.attrname);
				$('#groupattrid').attr('value',pattrid);
				$.get('ajaxfile/get_groupbuy.php?action=prodattr&pattrid='+pattrid+'&t='+t,function(data){
					var strarray=data.split(",");
					$('span.speciadollor').html('USD <font color=\"red\" size=\"5\">$ '+strarray[4]+'</font>');
				});
			
			})
		})
	}
	
	$.fn.groupColorSpan.defaults={
		attrtag:'div.topbg span',	//系列对象名称
		attrname:'data-value' 		//指定对象的属性
	};

	$.fn.groupColorSpan.setDefaults=function(settings) {
		$.extend( $.fn.groupColorSpan.defaults, settings );
	};
/**
 * @增加团购商品到购物车
 * @ 2012-10-22
*/	
	$.fn.GroupProdOrder=function(options){
		var opts=$.extend({},$.fn.GroupProdOrder.defaults,options);
		return this.click(function(){
			
			if($('dd.group_color span').length==1){
				$('#groupattrid').attr('value',$('dd.group_color span').attr('data-value'));
			}
			var groupattrid=$('#groupattrid').val();		//属性值
			var groupdnum=$('#group_ordernum').val();			//购买数量
			
			if(checknumber(groupattrid) && checknumber(groupdnum)){
				var ttime=new Date();
				var t=ttime.getMilliseconds();
				$.cookie("grouporderid",opts.prodid);
				$.post('ajaxfile/get_prodshow.php?action=addprod&t='+t,{pid:opts.prodid,pnum:groupdnum,pattrid:groupattrid},function(data){
					CheckLoginStatus($.trim(data));					
				})
				$(this).attr('src','images/fps_groupbtninto.png');
				//setTimeout(function(){window.location.href='groupcheck.php'},300)
			}else{
				$('li.prodtext_attr').css('border','solid 2px red');//没有选取销售属性
				alert('sorry,you did not select the product color!')
			}
			
		});
	}
	$.fn.GroupProdOrder.defaults={
		
	};
	$.fn.GroupProdOrder.setDefaults=function(settings){
		$.extend($.fn.GroupProdOrder.defaults, settings );
	}	

})(jQuery)