$(document).ready(function(){
	$("#ProdUpOnline").click(function(){
		$("form#formlist").attr("action",webUrl+"manager/newslist/statuschg/name/upline");
	});
	
	$("#ProdDownline").click(function(){
		$("form#formlist").attr("action",webUrl+"manager/newslist/statuschg/name/downline");
	});
})