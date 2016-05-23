<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理员登录</title>
<link href="/Public/css/admin_css.css" type="text/css" rel="stylesheet"/>
<script language="javascript" type="text/javascript" src="/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="/Public/js/common.js"></script>
<script type="text/javascript">
if(top.location!==self.location){
	top.location.href=self.location.href; 
}
</script>
<style type="text/css">
<!--
body {
	margin: 0;
	padding:0;
	font-family:Arial, Helvetica, sans-serif;
	background-color: #016aa9;
}
div {
	margin: 0 auto;
	padding: 0
}
h1, h2, h3, h4, h5, h6, ul, li, dl, dt, dd, form, img, p, span {
	border: none;
	margin: 0;
padding: 0, -webkit-text-size-adjust:none;
}
ul, li {
	list-style-type: none;
	padding: 0;
}
body, td, th {
	font-size: 12px;
	color: #000000;
}
-->
</style>
</head>
<body>
<form name="formlogin" id="formlogin" method="post" action="/index.php/Manager/Login/loginCheck" >
  <div class="logintable">
    <div class="loginform">
      <h1>Manage Center</h1>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right" width="70">用户名：</td>
          <td width="180"><input type="text" name="Username" id="UserName" class="inputview logininput"></td>
          <td rowspan="3"><input type='image' src="/Public/mimages/signin.png" name='Submit' id="weblogin" value="登录" class="inputlogin"/>
            <input name="Action" type="hidden" id="Action" value="Login" /></td>
        </tr>
        <tr>
          <td align="right">密  码：</td>
          <td><input type="password" name="Password" id="Password" class="inputview logininput"></td>
        </tr>
        <tr>
          <td align="right">验证码：</td>
          <td><div class="yzmdiv">
              <ul>
                <li>
                  <input type="txt" name="VerifyCode" id="VerifyCode" class="inputview inputverify"/>
                </li>
                <li style="margin-left:6px;"> <img src='/index.php/Home/Publicuse/verify/'  id="verifyImg" width="80" height="25"/></li>
              </ul>
            </div></td>
        </tr>
      </table>
    </div>
  </div>
</form>
</body>
</html>