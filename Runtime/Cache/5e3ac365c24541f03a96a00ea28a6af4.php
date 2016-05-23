<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gzwisdomiot</title>
<meta name="Keywords" content="Gzwisdomiot" />
<meta name="Description" content="Gzwisdomiot" />

<link rel="Shortcut Icon" href="favicon.ico">
<link href="<?php echo ($WEBNAME); ?>/Public/css/common.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ($WEBNAME); ?>/Public/css/user.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/jquery-1.9.0.min.js" ></script>
<script type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/Common.js" ></script>
<script type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/update_pwd.js"></script>
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
  <div class="manage_cont"> <div class="manager_left">
  <dl>
    <dt>My Order Center</dt>
    <dd><b>&#8226;</b><a  href="<?php echo ($WEBNAME); ?>/userindex">My Order</a></dd>
  </dl>
  <dl>
    <dt>Personal Message</dt>
    <dd><b>&#8226;</b><a  href="<?php echo ($WEBNAME); ?>/userindex/pwdedit">Update Password</a></dd>
    <dd><b>&#8226;</b><a  href="<?php echo ($WEBNAME); ?>/userindex/address">Address Manager</a></dd>
  </dl>
  </div>

    <div class="manager_right">
      <div class="manager_rightcenter">
        <ul>
          <li class="manager_rtitle">
			<div class="title usercenter">You are here : Manager Center &gt; Password to modify </div>
          </li>

          <li class="manager_rtable">
            <table width="100%" height="100%" cellspacing="1" cellpadding="0" border="0" class="manager_address_table" >
              <tbody>
                <tr>
                  <td><div class="manager_address">
                      <form name="userform" method="post" action="<?php echo ($WEBNAME); ?>/userindex/pwdeditok" id="userform">
                        <ul>
                          <li class="user_left">Your Email：</li>
                          <li class="user_right">
                            <input type="text" readonly="" id="guest_email" name="guest_email" value="<?php echo ($GuestEmail); ?>" readonly="" style="background-color:#f0f0f0;" disabled="disabled">
                          </li>
                          <li class="user_left">Your Name：</li>
                          <li class="user_right">
                            <input type="text" readonly="" id="guest_name" name="guest_name" value="<?php echo ($GuestName); ?>" readonly="" style="background-color:#f0f0f0; " disabled="disabled">
                          </li>
                          <li class="user_left">Old Password：</li>
                          <li class="user_right">
                            <input type="password" id="guest_oldpwd" name="guest_oldpwd" value="" onblur="checkNewPwd('guest_oldpwd')" class="guest_oldpwdinfo">
                            <span class="normal" id="guest_oldpwdinfo">Please input your old password!</span> </li>
                          <li class="user_left">New Password：</li>
                          <li class="user_right">
                            <input type="password" id="guest_newpwd" name="guest_newpwd" value="" class="guest_newpwdinfo" onblur="checkNewPwd('guest_newpwd')">
                            <span class="normal" id="guest_newpwdinfo">Please input your new password!</span> </li>
                          <li class="user_left">Confirm Password：</li>
                          <li class="user_right">
                            <input type="password" id="guest_chkpwd" name="guest_chkpwd" value="" class="guest_chkpwdinfo" onblur="checkNewPwd('guest_chkpwd')">
                            <span class="normal" id="guest_chkpwdinfo">Please input your password again!</span> </li>
                          <li class="user_title">
                            <input type="submit" value="Submit and Save" class="input_btn">
                          </li>
                        </ul>
                      </form>
                    </div></td>
                </tr>
              </tbody>
            </table>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</div>
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

<script type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/Cart.js" ></script>
<script type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/publicuse.js" ></script>
</body>
</html>