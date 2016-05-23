var webUrl="http://"+location.hostname+"/Phone/";
var WebCookie="/";
function checkNumber(strNumber) {
	if(strNumber==null)return false;
	if(isNaN(strNumber)) return false;
	var i,c,Letters = "1234567890"; 
	for( i = 0; i < strNumber.length; i ++ ) { 
		c = strNumber.charAt( i ); 
		if (Letters.indexOf( c ) ==-1)  return false; 
	} 
	return true; 
}
//字符验证	
function trimTxt(strTxt){
	return strTxt.replace(/(^\s*)|(\s*$)/g,"");
}
/**
 *刷新验证码
 */
function fleshVerify(){ 
	var time = new Date().getTime();
	$('#verifyImg').attr('src',webUrl+'/home/publicuse/verify/t/'+time);
}
/**
 * 将产品类别放置到导航栏目中，某些页面需要对左边栏进行占位处理，
 * 在页面载入时计算产品类别下拉高度，将高度赋给站位模块
 */
function menuUseBox(){
	var minheight=$("#menuid").height();
	minheight+='px';
	if($('.blank_box').length>0)$('.blank_box').css({'min-height':minheight});
}
$(document).ready(function(){
	$("input.search_key").focus(function(){
		$(this).attr('value','');
	}).blur(function(){
		value=$(this).attr('value');
		if(value==""){
			$(this).attr('value','Search for..');
		}
	});
})