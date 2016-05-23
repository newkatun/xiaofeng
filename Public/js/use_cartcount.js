$(document).ready(function(){	
	MyCartNew.cart.CartNewTotal();
	var strPointsObj={
		NumberObj:$('input.order_number'),
		CountObj:$('input[name="sendpoints"]'),
		ReturnObj:$('#CartOrder_SendPoints'),
		StrTextBack:"积分",
		StrTextHead:"赠送"
	};
	//MyCartNew.cart.TotalPointsCount(strPointsObj);
	
	var strCostPoints={
		NumberObj:$('input.order_number'),
		CountObj:$('input[name="costpoints"]'),
		ReturnObj:$('#CartOrder_CostPoints'),
		StrTextBack:"积分",
		StrTextHead:"消费"
	};
	//MyCartNew.cart.TotalPointsCount(strCostPoints);
	$('a.removeone').click(function(){
		if(confirm('Are you sure you want to remove this product ?')){
			var $obj=$(this);
			var strskuid=$obj.parents('tr').eq(0).attr('dataskuid');
			$('tr#cartlist_'+strskuid).slideUp('slow',function(){
				$('tr#cartlist_'+strskuid).remove();
				MyCartNew.cart.DeleteOneRecord(strskuid);
				//MyCartNew.cart.CountTotalprice();
				MyCartNew.cart.CartNewTotal();
				MyCartNew.cart.TotalCartNum();
				//MyCartNew.cart.TotalPointsCount(strPointsObj);
			});
		}
	});

	
	$('span.order_reduce').click(function(){
		var $obj=$(this);
		var strskuid=$obj.parents('tr').eq(0).attr('dataskuid');
		var strnumber=$('#order_num_'+strskuid).val(),stroldber=$('#order_num_'+strskuid).attr('oldnumber'),loginstatus=MyCartNew.cart.Check_login();
		if(checknumber(strnumber)){
			strnumber=parseInt(strnumber)-1;
			strnumber=strnumber<1?1:strnumber;
			$('#order_num_'+strskuid).attr('value',strnumber);
			$('#order_num_'+strskuid).attr('oldnumber',strnumber);
			if(loginstatus){
				MyCartNew.cart.Number_change(strskuid,strnumber);
			}else{
				MyCartNew.cart.UpdateToCookie(strskuid,strnumber,1);
			
			}
			MyCartNew.cart.CountSubTotal($obj,strnumber);
			MyCartNew.cart.CartNewTotal();
			//MyCartNew.cart.TotalPointsCount(strPointsObj);
		}else{
			$('#order_num_'+strskuid).attr('value',stroldber);
			alert('Sorry , the quantity ordered must be an integer greater than 0 !');
		}
		
	});
	
	$('span.order_increase').click(function(){
		var $obj=$(this);
		var strskuid=$obj.parents('tr').eq(0).attr('dataskuid');
		var strnumber=$('#order_num_'+strskuid).val(),stroldber=$('#order_num_'+strskuid).attr('oldnumber'),loginstatus=MyCartNew.cart.Check_login();
		if(checknumber(strnumber)){
			strnumber=parseInt(strnumber)+1;
			$('#order_num_'+strskuid).attr('value',strnumber);
			$('#order_num_'+strskuid).attr('oldnumber',strnumber);
			if(loginstatus){
				MyCartNew.cart.Number_change(strskuid,strnumber);
			}else{
				MyCartNew.cart.UpdateToCookie(strskuid,strnumber,0);
				MyCartNew.cart.TotalCartNum();
				//MyCartNew.cart.CountTotalprice();
			}
				MyCartNew.cart.CountSubTotal($obj,strnumber);
				MyCartNew.cart.CartNewTotal();
				//MyCartNew.cart.TotalPointsCount(strPointsObj);
				
		}else{
			$('#order_num_'+strskuid).attr('value',stroldber);
			alert('Sorry, the order must be an integer greater than 0!');
		}
		
	});
	
	$('#clearCartList').click(function(){
		if(confirm('Are you sure you want to remove the shopping cart?')){
			MyCartNew.cart.DelAllCartProd();
			MyCartNew.cart.TotalCartNum();
			//MyCartNew.cart.TotalPointsCount(strPointsObj);
		}
	})
	
	$('input.order_number').change(function(){
		var $obj=$(this);
		var strskuid=$obj.parents('tr').eq(0).attr('dataskuid');
		var strnumber=$obj.attr('value'),stroldber=$obj.attr('oldnumber'),loginstatus=MyCartNew.cart.Check_login();
		if(checknumber(strnumber)&&strnumber>0){
			$obj.attr('oldnumber',strnumber);
			if(loginstatus){
				MyCartNew.cart.Number_change(strskuid,strnumber);
			}else{
				MyCartNew.cart.UpdateToCookie(strskuid,strnumber,2);
				//MyCartNew.cart.CountTotalprice();
			}
			MyCartNew.cart.CountSubTotal($obj,strnumber);
			MyCartNew.cart.CartNewTotal();
		//	MyCartNew.cart.TotalPointsCount(strPointsObj);
		}else{
			$obj.attr('value',stroldber);
			alert('Sorry, the order must be an integer greater than 0!');
		}
	});
	
	$("input#continuebtn").click(function(){
		MyCartNew.cart.ContinueShop();
	});
	MyCartNew.cart.DiscountTotal();
});