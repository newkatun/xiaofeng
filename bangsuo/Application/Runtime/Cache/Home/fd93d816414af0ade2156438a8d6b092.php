<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($Page["title"]); ?></title>
<meta name="keywords" content="<?php echo ($Page["keywords"]); ?>" />
<meta name="Description" content="<?php echo ($Page["description"]); ?>" />
<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta content="telephone=no" name="format-detection" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<link href="/Public/css/style.css" rel="stylesheet" type="text/css" />
<!-- 	<link rel="apple-touch-icon-precomposed" href="iphone_milanoo.png" /> -->
</head>
<body>
	<header class="page-header">
		<div class="search">
			<form name="formsearch" method="get" action="/home/search">
			<ul><li class="search-li1"><span class="nav-prev"><a href="javascript:window.history.go(-1);">返回</a></span></li>
			<li class="search-li2"><input type="text" name="keywords" data-words="请输入商品关键字" id="keywords" class="inputtext"/></li>
			<li class="search-li3"> <input type="button" value="搜索" id="search_btn" class="inputbtn"/></li></ul>
			</form>
		</div>
	</header>
	<div class="center">
		<div class="content">
			<div class="category_list">
			<h2>商品分类</h2>
				<ul>
					<?php if(is_array($ProdType)): foreach($ProdType as $key=>$Type): ?><li><a href="/home/products/index/mid/<?php echo ($Type["autoid"]); ?>"><?php echo ($Type["ty_name"]); ?><span>&gt;</span></a></li>
						<?php if(is_array($Type['SubList'])): foreach($Type['SubList'] as $key=>$Sub): ?><li class="subli"><a href="/home/products/index/sid/<?php echo ($Sub["autoid"]); ?>"><?php echo ($Sub["ty_name"]); ?><span>&gt;</span></a></li><?php endforeach; endif; endforeach; endif; ?>
				</ul>
			</div>
		</div>
	</div>
<footer>
<div class="footer">
		<ul>
			<li class="bot-box">商品分类
				<div class="bot-nav">
				<?php if(is_array($BotNavList)): foreach($BotNavList as $key=>$Bot): ?><p><a href="/home/products/index/mid/<?php echo ($Bot["autoid"]); ?>"><?php echo ($Bot["ty_name"]); ?></a></p><?php endforeach; endif; ?>
				</div>
			
			</li>
			<li>电话咨询</li>
			<li>微信联系</li>
		</ul>
	</div>
</footer>
<div class="scroll" id="scroll" style="display:none;">Top</div>
		
	
<script type="text/javascript" src="/Public/js/jquery-1.9.0.min.js"></script>
<script src="/Public/js/scroll.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
  var $obj = $('#keywords');
  $obj.attr('value', $obj.attr('data-words')).css('color', '#666');
  $obj.focus(function () {
    if ($obj.val() == $obj.attr('data-words'))
    $obj.attr('value', '').css('color', '#333');
  }).blur(function () {
    if ($obj.val() == '')
    $obj.attr('value', $obj.attr('data-words')).css('color', '#666');
  });
  
  $('#search_btn').click(function(){
	if($obj.val() ==  $obj.attr('data-words') || $obj.val() == ''){
		return false;
	}else{
		$('form[name="formsearch"]').submit();
	}
  })
});
</script>
</body>
</html>