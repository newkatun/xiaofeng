$(document).ready(function(){
	$("a.OrderUpdate").click(function(){
		$obj=$(this);
		orderid=$obj.attr("attrid");
		window.location.href=Weburl+"orderlist/updata/id/"+orderid;
	});
	
	$("a.OrderDelete").click(function(){
		$obj=$(this);
		orderid=$obj.attr("attrid");
		if(confirm("确定要删除该订单吗？")){
			window.location.href=Weburl+"orderlist/deldata/id/"+orderid;
		}
	});
	
	$("input.unread_btn").click(function(){
		window.location.href=Weburl+"orderlist/index/gurl/unread";
	
	})
	
	$("input.read_btn").click(function(){
		window.location.href=Weburl+"orderlist/index/gurl/readed";
	
	})
	$("input.all_btn").click(function(){
		window.location.href=Weburl+"orderlist";
	})


})