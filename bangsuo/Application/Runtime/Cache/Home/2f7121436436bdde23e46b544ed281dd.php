<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($Page["prod_name"]); ?></title>
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
		<div class="nav-title">
			<span class="nav-prev"><a href="javascript:window.history.go(-1);">返回</a></span>
			商品详情
		</div>
		<div class="navbar"><a href="/home/category" class="navbar-cate"></a></div>
	</header>
	<div class="center">
	
		<div class="content">
			<div class="albums"><img src="<?php echo ($Page["img_url"]); ?>"/></div>
			<div class="dtail">
				<div class="dtail-name">
					<h1 class="p-name"><?php echo ($Page["img_name"]); ?></h1>
				</div>
				<div class="detail_attr mg-t">
						<h2>商品参数</h2>
						<pre>
							<?php echo (htmlspecialchars_decode($Page["prod_attr"])); ?>
						</pre>
					</div>
				<div class="dtail-info mg-t">
					
					<div class="detail_cont">
						<h2>详细介绍</h2>
						<?php echo (htmlspecialchars_decode($Page["content"])); ?>
					</div>
				</div>
				<div class="recommend mg-t">
					<h2>猜你也喜欢</h2>
					<?php if(is_array($ProdBeside)): foreach($ProdBeside as $key=>$Beside): ?><div class="rec-prod">
						<div class="rec-prod-img"><a href="/home/prodshow/index/id/<?php echo ($Beside["autoid"]); ?>" title="<?php echo ($Beside["prod_name"]); ?>"><img src="<?php echo ($Beside["img_url"]); ?>"/></a></div>
						<div class="rec-prod-name"><a href="/home/prodshow/index/id/<?php echo ($Beside["autoid"]); ?>" title="<?php echo ($Beside["prod_name"]); ?>"><?php echo ($Beside["prod_name"]); ?></a></div>
					</div><?php endforeach; endif; ?>
					<div class="cl"></div>
				</div>
			</div>
			<div class="clearfix"></div>
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