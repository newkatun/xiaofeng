<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>productlist</title>
<link href="<?php echo ($WEBROOT); ?>/Public/css/common.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ($WEBROOT); ?>/Public/css/prodshow.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery-1.9.0.min.js" ></script>
<script type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery.cookie.js" ></script>
<script type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/Common.js" ></script>
</head>
<body >
<div class="header">
  <div class="header_top">
	<div class="header_cont">
	<ul class="fr">
			<?php if(empty($GuestName) == true): ?><li id="loginbar" class="fore1">Welcome to myweb<span><a href="<?php echo ($WEBNAME); ?>/login">[User Login]</a> <a class="link-regist" href="<?php echo ($WEBNAME); ?>/register">[Free Registration]</a></span></li>
			<?php else: ?>
			<li id="loginbar" class="fore1">Hello，<?php echo ($GuestName); ?>！<span><a href="<?php echo ($WEBNAME); ?>/login/out">[Out]</a></span></li><?php endif; ?>
			<li class="fore2 ld">
				<span class="outline">|</span>
				<a rel="nofollow" href="<?php echo ($WEBNAME); ?>/userindex">My Order</a>
			</li>
			<li  id="biz-service" class="fore4 ld menu">
				<span class="outline">|</span>
				<span class="blank"></span>
				Customer Service
			</li>
		</ul>
	</div>
  </div>
  <div class="banner">
    <div class="logo"></div>
    <div class="banner_center">
      <div class="search">
        <form action="<?php echo ($WEBNAME); ?>/result" method="get" name="formsearch">
          <input type="text" name="keyword" id="keyword"  class="search_key"/><input type="submit"   value="search" class="search_btn"/>
          
        </form>
      </div>
    </div>
    <div class="userview">
	<div class="cartnum"><span id="cart_basket" class="cart_basket">0</span></div>
      <div class="base_cart">
        <ul>
          <li ><a href="<?php echo ($WEBNAME); ?>/cartlist">View Cart</a></li>
        </ul>
      </div>
    </div>
    <div class="banner_menu">
      <div class="nav_center">
        <ul>
          <li><a href="<?php echo ($WEBNAME); ?>" class="moveon">Home</a></li>
          <li><a href="<?php echo ($WEBNAME); ?>/Productcenter">Product-center</a></li>
		  <?php if(is_array($NavList)): foreach($NavList as $key=>$Nav): ?><li><a href="<?php echo ($WEBNAME); ?>/prodsell/index/type/<?php echo (strtolower($Nav["sole_name"])); ?>"><?php echo ($Nav["sole_name"]); ?></a></li><?php endforeach; endif; ?>
          <li><a href="<?php echo ($WEBNAME); ?>/newslist">Infomation</a><div class="hotnav"></div></li>
		  <li><a href="<?php echo ($WEBNAME); ?>/about">About Us</a></li>
		  <li><a href="<?php echo ($WEBNAME); ?>/contact">Contact Us</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="body">
  <div class="center"> 
  	<div class="left">
  <div class="left_menu">
    <ul>
      <li class="leftcontent">
        <div class="menulist" id="menuid">
          <ul>
            <?php if(is_array($CatalogList)): foreach($CatalogList as $key=>$Menu): ?><li class="bigmenu"><b>•</b><a href="<?php echo ($WEBROOT); ?>/productlist/index/mid/<?php echo ($Menu["autoid"]); ?>" title="<?php echo ($Menu["ty_name"]); ?>"><?php echo ($Menu["ty_name"]); ?></a></li>
			  <?php if(is_array($Menu['subCatalog']) == true): ?><li class="sublist">
                <div class="subdiv">
                  <ul>
                    <?php if(is_array($Menu['subCatalog'])): foreach($Menu['subCatalog'] as $key=>$Submenu): ?><li class="submenu"><b>-</b><a href="<?php echo ($WEBROOT); ?>/productlist/index/mid/<?php echo ($Submenu["ty_subid"]); ?>/sid/<?php echo ($Submenu["autoid"]); ?>" title="<?php echo ($Submenu["ty_name"]); ?>"><?php echo ($Submenu["ty_name"]); ?></a></li><?php endforeach; endif; ?>
                  </ul>
                </div>
              </li><?php endif; endforeach; endif; ?>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>

    <div class="block marginleft">
      <div class="title page_toptitle">
        <ul>
          <li class="prod_mian_type">Your Position:<a href="<?php echo ($WEBROOT); ?>">Home</a>&gt;&gt;Result</li>
		  
        </ul>
      </div>
      <div class="tablelist">
		<?php if($TableList == true && is_array($MenuProduct)): if(is_array($MenuProduct)): $i = 0; $__LIST__ = $MenuProduct;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Prod): $mod = ($i % 2 );++$i;?><div class="product ">
			<ul>
				<li class="product_img"><a title="<?php echo ($Prod["p_name"]); ?>" target="_blank" href="<?php echo ($WEBROOT); ?>/prodshow/index/id/<?php echo ($Prod["autoid"]); ?>"><img src="<?php echo ($Prod["p_img"]); ?>" width="180" height="180"></a></li>
				<li class="product_name"><a title="<?php echo ($Prod["p_name"]); ?>" target="_blank" href="<?php echo ($WEBROOT); ?>/prodshow/index/id/<?php echo ($Prod["autoid"]); ?>"><?php echo ($Prod["p_id"]); ?> <?php echo ($Prod["p_name"]); ?></a></li>
				<li class="product_code"><a title="<?php echo ($Prod["p_name"]); ?>" target="_blank" href="<?php echo ($WEBROOT); ?>/prodshow/index/id/<?php echo ($Prod["autoid"]); ?>">Code: <?php echo ($Prod["p_id"]); ?> </a></li>
			</ul>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
		<div class="clear"></div>
		<div class="page"><?php echo ($PageContent); ?></div>
		<?php else: ?>
		<div class="empty">Temporarily not find your interested product, please view our recommended items!</div>
		<?php if(is_array($MenuProduct)): foreach($MenuProduct as $key=>$TProd): ?><div class="product">
			<ul>
				<li class="product_img"><a title="<?php echo ($TProd["p_name"]); ?>" target="_blank" href="<?php echo ($WEBROOT); ?>/prodshow/index/id/<?php echo ($TProd["autoid"]); ?>"><img src="<?php echo ($TProd["p_img"]); ?>" width="180" height="180"></a></li>
				<li class="product_name"><a title="<?php echo ($TProd["p_name"]); ?>" target="_blank" href="<?php echo ($WEBROOT); ?>/prodshow/index/id/<?php echo ($TProd["autoid"]); ?>"><?php echo ($TProd["p_id"]); ?> <?php echo ($TProd["p_name"]); ?></a></li>
				<li class="product_code"><a title="<?php echo ($TProd["p_name"]); ?>" target="_blank" href="<?php echo ($WEBROOT); ?>/prodshow/index/id/<?php echo ($TProd["autoid"]); ?>">Code: <?php echo ($TProd["p_id"]); ?> </a></li>
			</ul>
		</div><?php endforeach; endif; ?>
		<div class="clear"></div><?php endif; ?>
		
      </div>
      <div class="blankmargin"></div>
    </div>
    <div class="blank"></div>
  </div>
</div>
<!--center end tags-->
<div class="clear"></div>
<div class="footer">
  <ul class="footul">
    <li class="footcopyright">
      <div class="footcopytext">
        <ul>
          <li >Wisdomiot Communication Electronics Trade Co., Limited</li>
          <li >Mail: wisdomiotmanager@gmail.com</li>
          <li >Whatsapp:+8613751850732</li>
          <li >Skype:a7872816</li>
          <li class="footimg"><img src="__ROOT__/Public/images/link.jpg"></li>
          <li>Copyright © 2003-2014 MPS gzwisdomiot.com.</li>
  
        </ul>
      </div>
    </li>
  </ul>
</div>

<!--footer end stags-->
<script type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/Cart.js" ></script>
<script type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/publicuse.js" ></script>
</body>
</html>