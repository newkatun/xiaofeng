<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($Page["title"]); ?></title>
<meta name="keywords" content="<?php echo ($Page["keywords"]); ?>">
<meta name="description" content="<?php echo ($Page["description"]); ?>">
<link href="/Company/Public/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<header class="header">
	<div class="header">
		<div class="content">
			<div class="logo fl"></div>
			<nav>
				<div class="nav fl">
					<ul>
						<li class="nav_on"><a href="/Company">网站首页</a></li>
						<li><a href="/Company/home/services.html">服务项目</a></li>
						<li><a href="/Company/home/superiority.html">优势内容</a></li>
						<li><a href="/Company/home/artlist/index/rurl/case.html">案例展示</a></li>
						<li><a href="/Company/home/artlist/index/rurl/news">资讯了解</a></li>
						<li><a href="/Company/home/content/index/rurl/about.html">关于高飞</a></li>
						<li><a href="/Company/home/content/index/rurl/contact.html">联系我们</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
</header>
<div class="center">
	<h1 class="page-name content"><?php echo ($Page["type_name"]); ?><span class="page-en"><?php echo ($Page["type_subname"]); ?></span></h1>
	<h3 class="page-subname content">高飞,衡阳网站建设领跑者,高端网站制作品牌服务商<span class="href-list"><a href="/Company">首页</a>&gt;&gt;<a href="/Company/home/artlist"><?php echo ($Page['MainData']['c_name']); ?></a>&gt;&gt;<a href="/Company/home/artlist/index/rurl/<?php echo ($Page["type_pagename"]); ?>"><?php echo ($Page["type_name"]); ?></a></span></h3>
	

		<div class="content ">
			<div class="cl mg-t"></div>
			<div class="text-cont">
			<article>
				 <?php echo (htmlspecialchars_decode($Page["type_content"])); ?>
				<div class="cl"></div>
			

			</article>
			</div>
			<div class="cl"></div>
		</div>
</div>



<footer>
	<div class="footer">
		<div class="content">
			<ul class="list fl">
				<li class="title">关于我们</li>
				<li><a href="/Company/home/content/index/rurl/about.html">公司简介</a></li>
				<li class="title">联系我们</li>
				<li><a href="/Company/home/content/index/rurl/contact.html">地理位置</A></li>
			</ul>
			
			<?php if(is_array($BotLinkList)): foreach($BotLinkList as $key=>$Bot): ?><ul class="list">
				<li class="title"><?php echo ($Bot["c_name"]); ?></li>
				<?php if(is_array($Bot['NewsType'])): foreach($Bot['NewsType'] as $key=>$BType): ?><li><a href="/Company/home/services/showcont/rurl/<?php echo ($BType["type_pagename"]); ?>"><?php echo ($BType["type_name"]); ?></a></li><?php endforeach; endif; ?>
			</ul><?php endforeach; endif; ?>
		
			<ul class="erweima fl">
				<li><span>微信二维码</span><img src="/Company/Public/images/erweima.png" width="75" height="75" alt="微信二维码"/></li>
				<li><span>手机二维码</span><img src="/Company/Public/images/erweima.png" width="75" height="75" alt="手机二维码"/></li>
			</ul>
			<div class="cl"></div>
			<ul class="copyright mg-t ">
				<li>Copyright 2008-2014 <?php echo ($System["sy_company"]); ?> 版权所有 咨询热线：<?php echo ($System["sy_telephone"]); ?>  邮箱/Mail：<a href="mailto:<?php echo ($System["sy_memail"]); ?>"><?php echo ($System["sy_memail"]); ?></a></li>
				<li>地址/Add：<?php echo ($System["sy_address"]); ?> 站长统计</li>
			</ul>
		</div>
	</div>
</footer>
<script src="/Company/Public/js/jquery-1.9.0.min.js" type="text/javascript"></script>
<script src="/Company/Public/js/common.js" type="text/javascript"></script>
</body>
</html>