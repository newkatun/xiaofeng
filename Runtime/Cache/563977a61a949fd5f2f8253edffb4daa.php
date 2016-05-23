<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($Page["c_title"]); ?></title>
<meta content="<?php echo ($Page["c_keywords"]); ?>" name="keywords" />
<meta content="<?php echo ($Page["c_description"]); ?>" name="description" />
<link rel="Shortcut Icon" href="favicon.ico">
<link href="<?php echo ($WEBNAME); ?>/Public/css/common.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ($WEBNAME); ?>/Public/css/cartlist.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/jquery-1.9.0.min.js" ></script>
<script type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/Common.js"></script>
<script type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/Cart.js"></script>
<script type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/Cartcheck.js"></script>

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
  <!--header end tags-->
  <div class="center">
    <div class="cartlist_step">
		<ul>
		<li class="cart_step1 cart_on1"><span>1</span>View Carts</li>
		<li class="cart_step2 cart_on2"><span>2</span>Confirm The Order</li>
		<li class="cart_step3"><span>3</span>Submit The Order</li>
		<li class="cart_step4"><span>4</span>Reviews Product</li>
		</ul>
	</div>
    <div class="ordercheck_cont">
      <form method="post" id="userpayform" name="formpost" action="<?php echo ($WEBNAME); ?>/cartlist/cartsubmit">

        <div class="ordercheck_comments">
          <ul>
            <li class="title">Product List </li>
            <li> <div class="pay_comments">
  <table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#cccccc" class="table_cart">
    <tbody>
      <tr  class="table_title">
        <td width="100" align="center">Photo</td>
        <td height="30" align="center" >Name</td>
        <td width="100" align="center">Number</td>
      </tr>
      <?php if(is_array($CartProdList)): $i = 0; $__LIST__ = $CartProdList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Cart): $mod = ($i % 2 );++$i;?><tr dataskuid="<?php echo ($Cart["autoid"]); ?>" id="cartlist_<?php echo ($Cart["autoid"]); ?>" class="cartlist_prod" >
          <td align="center"><input type="hidden" value="<?php echo ($Cart["autoid"]); ?>" name="cartId[]">
            <img width="80" src="<?php echo ($Cart["p_img"]); ?>" height="80"></td>
          <td height="100" class="table_td_name" style="padding-left:6px;"><?php echo ($Cart["ty_name"]); ?> <?php echo ($Cart["p_name"]); ?></td>
          <td align="center"><div class="order_input"><span attrid="<?php echo ($Cart["autoid"]); ?>" class="order_reduce">&nbsp;</span>
              <input attrid="<?php echo ($Cart["temp_pid"]); ?>" type="text" value="<?php echo ($Cart["temp_qty"]); ?>" size="4" id="order_num_<?php echo ($Cart["autoid"]); ?>" class="order_number"  oldnumber="<?php echo ($Cart["temp_qty"]); ?>">
              <span attrid="<?php echo ($Cart["autoid"]); ?>" class="order_increase">&nbsp;</span></div></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>

    </tbody>
  </table>
  <ul>
    <li>The supplement to fill your orders: <br>
      <textarea style="width:500px; " name="pay_ordertext" cols="80" rows="3"></textarea>
    </li>
    <li> </li>
    <li class="confirm_div"><span class="comerror" id="checkcomspan"></span>
      
      <input type="hidden" name="cartdiscount" value="0" id="cartdiscount">
      <input type="submit" class="input_submitorder" id="checkcomment" value="Submit Order" name="checkcomment">
    </li>
  </ul>
</div>
 </li>
          </ul>
        </div>
      </form>
    </div>
  </div>
  <!--center end tags-->
  <!--footer end stags-->
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