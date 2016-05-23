<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html Public "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Drop-ins</title>
<meta name="Keywords" content="Drop-ins" />
<meta name="Description" content="Drop-ins" />
<link rel="Shortcut Icon" href="favicon.ico">
<link href="<?php echo ($WEBNAME); ?>/Public/css/common.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ($WEBNAME); ?>/Public/css/cartlist.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/jquery-1.9.0.min.js" ></script>
<script type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/Common.js"></script>
</head>
<body>
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
          <li><a href="<?php echo ($WEBNAME); ?>/catalog">Catalog</a></li>
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
  <!--header end tags-->
  <div class="center">
    <div class="cartlist_title cartlist_submit"></div>
    <div class="ordercheck_cont">
      <div class="cart_body">
        <ul>
          <li class="cart_div_title"></li>
          <li id="cart_div_cont" class="cart_div_cont">
            <div class="fail">
			<p><?php echo ($FailText); ?></p>
			<p>The system is returning to the shopping cart page for you, if long time cannot jump to the page, please click <a href="<?php echo ($WEBNAME); ?>/userindex">here</a>!</p>
			<meta http-equiv="refresh" content="3; url=<?php echo ($WEBNAME); ?>/userindex" />
			</div>
            <div class="clear"></div>
          </li>
          <li class="cart_div_bottom"></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="clear margintop"></div>
<div class="clear"></div>
<div class="footer">
  <ul class="footul">
    <li class="footcopyright">
      <div class="footcopytext">
        <ul>
          <li ><span class="spanleft">FPSMALL: </span><span class="spanright">Client Download | Moblie Access</span></li>
          <li><span class="spanleft">GETTING STARTED: </span><span class="spanright">Shopping Process | Credits Policy | Invoice System | Service Agreements</span></li>
          <li><span class="spanleft">AFTER-SALES SERVICE: </span><span class="spanright">Extended Warranty Service | Payment & Delivery Address | How To Handle The Cash Withdrawal</span></li>
          <li>Copyright &copy; 2009-2012  3P Trade Co., Ltd., ALL rights reserved.</li>
          <li>Terms of Use |<span> Privacy Policy  | </span> Site Map </li>
        </ul>
      </div>
    </li>
  </ul>
</div>

</body>
</html>