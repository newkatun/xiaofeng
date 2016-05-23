
jQuery(".div_silde").slide({ mainCell:".bd ul",effect:"leftLoop",autoPlay:true} );
jQuery('#recommend').kxbdSuperMarqueeview({
		distance:720,
		time:8,
		direction:'left',
		btnGo:{left:'#direct_left',right:'#direct_right'},
		eventGo:'click',
		controlBtn:{left:'#direct_left',right:'#direct_right'},
		newAmount:1,
		eventA:'mouseenter',//鼠标事件，加速
 		eventB:'mouseleave',//鼠标事件，原速
});
$(document).ready(function(){
	$("li.div_recommend_prodview").mouseover(function(){
		$(this).children('div').css("display",'inline-block')
	});
	$("li.div_recommend_prodview").mouseout(function(){
		$(this).children('div').css("display",'none')
	});
});