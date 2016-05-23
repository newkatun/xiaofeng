$(document).ready(function(){
	//统计商品总价格
	//CartBox.cart.CartTotalOrderPrice();
	//减少选中商品的购买数量
	$("span.order_reduce").click(function(){
		CartBox.cart.CartNumber($(this).attr("attrid"),'reduce',true);
	});
	//增加选中商品的购买数量
	$("span.order_increase").click(function(){
		CartBox.cart.CartNumber($(this).attr("attrid"),'add',true);
	});
	//更新选中商品的购买数量
	$("input.order_number").change(function(){
		var $strObj=$(this);
		var buyNum=$strObj.val();
		var tempId=$strObj.attr("id").replace("order_num_","");
		var prodId=$strObj.attr("attrid");
		if(checkNumber(buyNum)){
			CartBox.cart.CartUpdateData(prodId,buyNum,tempId);
		}else{
			alert('请输入数字');
		}
	});
})

