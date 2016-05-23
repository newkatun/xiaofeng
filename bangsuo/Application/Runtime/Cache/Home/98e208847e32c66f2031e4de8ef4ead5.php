<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($Page["title"]); ?></title>
<meta name="keywords" content="<?php echo ($Page["keywords"]); ?>">
<meta name="description" content="<?php echo ($Page["description"]); ?>">
<link href="/Public/css/style.css" rel="stylesheet" type="text/css" />
	<meta content="telephone=no" name="format-detection" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<!-- 	<link rel="apple-touch-icon-precomposed" href="iphone_milanoo.png" /> -->
</head>
<body>
	<header class="page-header">
		<div class="nav-title">
			<span class="nav-prev"><a href="javascript:window.history.go(-1);">返回</a></span>
			<?php echo ($Page["c_name"]); ?>
		</div>
		<div class="navbar"><a href="/home/category" class="navbar-cate"></a></div>
	</header>
<center>
 <div class="center">
 
 
 
		<div class="list">
		<?php if(empty($ProdList)): ?><meta http-equiv="refresh" content="2;url="/> 
				<div class="nocontent">没有找到您所需要的内容，<br/>点击<a href="">首页</a>进行返回！</div>
				<?php else: ?>
			
			<?php if(is_array($ProdList)): foreach($ProdList as $key=>$Prod): ?><div class="product-item">
				<div class="product">
					<div class="prod-img"><a href="/home/prodshow/index/id/<?php echo ($Prod["autoid"]); ?>" title="<?php echo ($Prod["prod_name"]); ?>"><img src="<?php echo ($Prod["img_url"]); ?>" alt="<?php echo ($Prod["prod_name"]); ?>" /></a></div>
					<div class="prod-name"><a href="/home/prodshow/index/id/<?php echo ($Prod["autoid"]); ?>" title="<?php echo ($Prod["prod_name"]); ?>"><?php echo ($Prod["prod_name"]); ?></a></div>
				</div>
			</div><?php endforeach; endif; ?>
			
			
			<div class="clearfix"></div>
			<div class="pagecont"><?php echo ($PageContent); ?></div>
			<div class="clearfix"></div><?php endif; ?>
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
</body>
</html>