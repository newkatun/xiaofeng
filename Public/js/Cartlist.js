$(document).ready(function(){
	//CartBox.cart.CartTotalOrderPrice();
	$("span.order_reduce").click(function(){
		CartBox.cart.CartNumber($(this).attr("attrid"),'reduce',true);
	});
	
	$("span.order_increase").click(function(){
		CartBox.cart.CartNumber($(this).attr("attrid"),'add',true);
	});
	$("a.removeone").click(function(){
		var $strObj=$(this).parents('tr.cartlist_prod');
		if(typeof($strObj)){
			CartBox.cart.CartDeleteData($strObj);
			CartBox.cart.CartTotalDataPrice(true);
		}else{
			alert('Delecting failure');
		}
	})
	$("input.order_number").change(function(){
		var $strObj=$(this);
		var buyNum=$strObj.val();
		var tempId=$strObj.attr("id").replace("order_num_","");
		var prodId=$strObj.attr("attrid");
		if(checkNumber(buyNum)){
			CartBox.cart.CartUpdateData(prodId,buyNum,tempId);
		}else{
			alert('Please enter the number');
		}
	});
	$("#ordersubmit_btn").click(function(){
		$("#formcart").submit();
	});
	$("a.removeall").click(function(){
		if(confirm('Sure you want to delete all items in the shopping cart?')){
			$('form#formcart').attr('action','http://'+WEBROOT+'cartlist/cartDeleteAll').submit();
		}
		
	})
	
})