(function($){
/**
 * @功能是用来点击选中产品销售属性，获取该销售属性的相关信息
 * @ 2012-10-22
*/
	$.fn.spanclick=function(options){
		var opts=$.extend({},$.fn.spanclick.defaults,options);
		return this.each(function(){
			var $spanobj=$(this); //点击的对象
			$spanobj.click(function(){
				$(opts.attrtag).css("border","solid 2px #2f2f2f");
				$spanobj.css("border","solid 2px #FF0000");
					
				var ttime=new Date();
				var t=ttime.getMilliseconds();
				var pattrid=$spanobj.attr(opts.attrname);
				$(opts.attrobj).attr(opts.attrvalue,pattrid);
				$.get('ajaxfile/get_prodshow.php?action=prodattr&pattrid='+pattrid+'&t='+t,function(data){
					var strarray=data.split(",");
					$('span.'+opts.attrprice).html('USD <font color=\"red\" size=\"3\">$ '+strarray[4]+'</font>');
					$('#'+opts.attrimgid).attr('src','uploadfile/'+strarray[5]);
					if(parseInt(strarray[6])<1){
						$(opts.btnstock).html('<font color=\"red\" size=\"2\"><b>Out of stock</b></font>');
						$('#'+opts.btnremove).removeClass("prodorderinput").addClass('prodorderinputtime').attr('disabled','disabled');
					}else{
						$(opts.btnstock).html('<font color=\"green\" size=\"2\"><b>In stock</b></font>');
						$('#'+opts.btnremove).css("display","block").removeClass("prodorderinputtime").addClass('prodorderinput').removeAttr('disabled');
					}
				});
			});
		});
	}
	$.fn.spanclick.defaults={
		attrtag:'div.topbg span',		//系列对象名称
		attrname:'data-value', 			//指定对象的属性
		attrobj:'#prodattrid',			//将值付给指定的对象
		attrprodid:'data-prod',			//获取产品编号
		attrvalue:'value',				//将值付给指定的属性名称
		attrprice:'speciadollor',		//更改价格
		attrimgid:'prod_showimgurl'	,	//更换图片
		btnremove:'prodorder_btn',		//移除指定标签
		btnstock:'dd.view_prodstock'
	};

	$.fn.spanclick.setDefaults=function(settings) {
		$.extend( $.fn.spanclick.defaults, settings );
	};


/**
 * @增加商品到购物车
 * @ 2012-10-22
 */
	$.fn.ProductOrder=function(options){
		var opts=$.extend({},$.fn.ProductOrder.defaults,options);
		return this.click(function(){
			if($('li.prodtext_attr span').length==1){
				$('#prodattrid').attr('value',$('li.prodtext_attr span').attr('data-value'));
			}
			var $strbtnobg=$(this);
			var prodattrid=$('#prodattrid').val();		//属性值
			var prodnum=$('#prodnum').val();			//购买数量
			if(checknumber(prodattrid) && checknumber(prodnum)){
				var ttime=new Date();
				var t=ttime.getMilliseconds();
				$.post('ajaxfile/get_prodshow.php?action=addprod&t='+t,{pid:opts.prodid,pnum:prodnum,pattrid:prodattrid},function(data){
					CheckLoginStatus(data);
					if($.trim(data)!='loginin'){
						$('#cart_basket').html(data);
						/*
						if($strbtnobg.next().is('span') && $strbtnobg.next().attr('class')=='bugsuccessmsg'){
							$strbtnobg.next().text('Buy Success');
						}else{
							$strbtnobg.after('<span class=\"bugsuccessmsg\">Buy Success</span>');
						}
						*/
						$strbtnobg.css('background-position','0 -27px');
					}
				})
			}else{
				$('li.prodtext_attr').css('border','solid 2px red');//没有选取销售属性
			}
		});
	}
	$.fn.ProductOrder.defaults={
		
	};
	$.fn.ProductOrder.setDefaults=function(settings){
		$.extend($.fn.ProductOrder.defaults, settings );
	}
	
/**
 * @更新购物车商品数量
 * @ 2012-10-22
 */	
	$.fn.ChangeNum=function(options){
		var opts=$.extend({},$.fn.ChangeNum.defaults,options);
		return this.blur(function(){
			var $objview=$(this);
			var prodcartid=$objview.parent().parent().attr('data-cartid');
			var prodid=$objview.parent().parent().attr('data-prodid');
			var prodattrid=$objview.parent().parent().attr('data-attrid');
			var num_old=$('#hidordernum_'+prodcartid).val();
			var prodprice=$('span#pordcode'+prodcartid).text();
		
			if(checknumber($objview.val())){
				$('#hidspan_'+prodcartid).html('');
				$objview.css('border','solid 1px gray');
				$('#hidordernum_'+prodcartid).attr('value',$objview.val());
			
				var ttime=new Date();
				var t=ttime.getMilliseconds();
				$.get('ajaxfile/get_groupbuy.php?action=upnumprod&prodnum='+$objview.val()+'&cartid='+prodcartid+'&t='+t,function(data){
						CheckLoginStatus(data);
						var strarray=data.split(",");
						$('#cart_basket').html(strarray[0]);
						$('#subtotal_'+prodcartid).text(FormartFloat(parseFloat(prodprice)*$objview.val()));
						$('span.total_price_span').text(strarray[1]);	
				})
			}else{
				$objview.css('border','solid 1px #f00');
				$objview.attr('value',num_old);
				$('#hidspan_'+prodcartid).html('<font color=\"red\">Please input a number!</font>');
			}
		})
	}
	$.fn.ChangeNum.defaults={
	
	};
	$.fn.ChangeNum.setDefaults=function(settings){
		$.extend($.fn.ChangeNum.defaults,settings);
	}
	

	$.fn.ChangeNumBtn=function(options){
		var opts=$.extend({},$.fn.ChangeNumBtn.defaults,options);
		return this.click(function(){
	
			var $objview=$(this);
			var orderprodid=$objview.attr('orderprodid');
			var methodtype=$objview.attr('orderMethod');
			var prodprice=$('span#pordcode'+orderprodid).text();
			if(methodtype=='add'){
				var ordernum=parseInt($('input.prodnum_class[orderprodid='+orderprodid+']').attr('value'))+1;
			}else{
				var ordernum=parseInt($('input.prodnum_class[orderprodid='+orderprodid+']').attr('value'))-1;
			}
			if(ordernum>0){
				$('input.prodnum_class[orderprodid='+orderprodid+']').attr('value',ordernum);
				var ttime=new Date();
				var t=ttime.getMilliseconds();
				$.get('ajaxfile/get_groupbuy.php?action=upnumprod&prodnum='+ordernum+'&cartid='+orderprodid+'&t='+t,function(data){
					CheckLoginStatus(data);
					var strarray=data.split(",");
					$('#cart_basket').html(strarray[0]);
					$('#subtotal_'+orderprodid).text(FormartFloat(parseFloat(prodprice)*ordernum));
					console.log(prodprice);
					console.log(ordernum);
					$('span.total_price_span').text(strarray[1]);	
					
					
				})
			}

		})
	}
	$.fn.ChangeNumBtn.defaults={
	
	};
	$.fn.ChangeNumBtn.setDefaults=function(settings){
		$.extend($.fn.ChangeNumBtn.defaults,settings);
	}

	
/**
 * @删除购物车商品数量
 * @ 2012-10-22
 */	
	$.fn.DeleteOrder=function(options){
		var opts=$.extend({},$.fn.DeleteOrder.defaults,options);
		return this.click(function(){
			var $objview=$(this);
			if(confirm('Do you realy remove this product?')){
				var prodcartid=$objview.parent().parent().attr('data-cartid');
				$.get('ajaxfile/get_groupbuy.php?action=delprod&cartid='+prodcartid,function(data){
					CheckLoginStatus(data);
					var strarray=data.split(",");
					$('#cart_basket').html(strarray[0]);
					$('span.total_price_span').text("USD $ "+strarray[1]);
				})
				$("#table_td_group"+prodcartid).remove();
				if($("table.table_groupbuy tr").length==3){
					$("table.table_groupbuy tr").removeClass("table_nodata");
					$("table.table_groupbuy tr.table_price").css("display","none");	
				}
			}
		})
		
	};
	$.fn.DeleteOrder.defaults={
	
	};
	$.fn.DeleteOrder.setDefaults=function(settings){
		$.extend($.fn.DeleteOrder.defaults,settings)
	};
})(jQuery);



