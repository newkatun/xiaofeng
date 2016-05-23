$(document).ready(function(){
	$('.cacheBtn').click(function(){
		$.get(webUrl+'manager/index/cache',{t:Math.random()},function(data){
			$('.cacheClearMsg').html(data);
		});
	})
});