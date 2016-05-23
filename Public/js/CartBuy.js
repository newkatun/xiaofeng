$(document).ready(function(){
	$("a.buybutton").click(function(){
		var prodid=$('a.buybutton').attr('attrid');
		var buynum=$('input.bnumber').val();
		CartBox.cart.CartAddData(prodid,buynum);
	});
	$("span.order_reduce").click(function(){
		CartBox.cart.CartNumber($(this).attr("attrid"),'reduce');
	});
	
	$("span.order_increase").click(function(){
		CartBox.cart.CartNumber($(this).attr("attrid"),'add');
	});
	$(".closediv").click(function(){
		$("#buystatus").slideUp();
	});
	$(".smallimage img").click(function(){
		var imgsrc=$(this).attr("src");
		$("div.bigimage a").attr("href",imgsrc);
		$("div.bigimage img").attr("src",imgsrc);
	})
	$(".fancybox").fancybox();	
})

