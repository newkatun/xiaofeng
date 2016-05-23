<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
</head>
<body >
<header>
		<div class="logo"></div>
		<div class="navbar"><a href="/home/category" class="navbar-cate"></a></div>
	</header>
<div class="center">
	<div class="slide">
	
	<div class="slide-panel">
                <ul id="J_Slider">
                    <?php if(is_array($SlideList)): foreach($SlideList as $key=>$Slide): ?><li data-url="<?php echo ($Slide["rela_url"]); ?>">
                            <img src="<?php echo ($Slide["rela_img"]); ?>" alt="">
                        </li><?php endforeach; endif; ?>
                </ul>
                <div class="slide-pager" id="J_SliderOpt">
					<?php $__FOR_START_509432307__=0;$__FOR_END_509432307__=$key;for($i=$__FOR_START_509432307__;$i <= $__FOR_END_509432307__;$i+=1){ ?><span  class="active"></span><?php } ?>
                </div>
            </div>
	
	</div>
		<div class="list">
		<?php if(is_array($IndexProductList)): foreach($IndexProductList as $key=>$Prod): ?><div class="product-item">
				<div class="product">
					<div class="prod-img"><a href="/home/prodshow/index/id/<?php echo ($Prod["autoid"]); ?>" title="<?php echo ($Prod["prod_name"]); ?>"><img src="<?php echo ($Prod["img_url"]); ?>" alt="<?php echo ($Prod["prod_name"]); ?>" /></a></div>
					<div class="prod-name"><a href="/home/prodshow/index/id/<?php echo ($Prod["autoid"]); ?>" title="<?php echo ($Prod["prod_name"]); ?>"><?php echo ($Prod["prod_name"]); ?></a></div>
				</div>
			</div><?php endforeach; endif; ?>
		<div class="cl"></div>
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
		
	
<script src="/Public/js/jquery-1.9.0.min.js" type="text/javascript"></script>
<script src="/Public/js/scroll.js" type="text/javascript"></script>

</body>
</html>