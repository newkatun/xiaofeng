<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> 后台管理员登录</title>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/common.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/function.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/alerts.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/login.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #016aa9;
	overflow:hidden;
}
.STYLE1 {
	color: #000000;
	font-size: 12px;
}
body,td,th {font-size: 12px; color: #000000;}
.P4{border-right-width: 1px; border-right-style: solid; border-right-color: #B4B0EC;}
a:link,a:visited {color: #000000; text-decoration: none;}
a:hover,a:active {text-decoration: underline; color: #000000;}

-->
</style>
</head>
<body>
<form name="formlogin" id="formlogin" method="post" action="<?php echo ($WEBROOT); ?>__URL__/loginCheck" >
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="235" background="<?php echo ($WEBNAME); ?>/Public/images/login_03.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td height="53"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="347" height="53" background="<?php echo ($WEBNAME); ?>/Public/images/login_05.gif">&nbsp;</td>
            <td width="255" background="<?php echo ($WEBNAME); ?>/Public/images/login_06.gif">
            
            <table width="258" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="36" height="25"><div align="right"><span class="STYLE1">用户名</span></div></td>
                <td width="88" height="25"><div align="center">
                  <input type="text" name="Username" id="UserName" style="width:80px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff">
                </div></td>
                <td width="30"><div align="right"><span class="STYLE1">密码</span></div></td>
                <td width="104" height="25" colspan="2"><div align="center">
                  <input type="password" name="Password" id="Password" style="width:80px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff">
                </div></td>
              </tr>
              <tr>
                <td height="25"><div align="right"><span class="STYLE1">验证码</span></div></td>
                <td height="25" align="left"><div align="center">
                  <input type="txt" name="VerifyCode" id="VerifyCode" style="width:80px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff"/>
                </div></td>
                <td height="25" colspan="3" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="40" border="0" cellspacing="0" cellpadding="0" style=" height:17px; background-color:#000; border:solid 1px #7dbad7;">
                        <tr>
                          <td width="45"><img src='<?php echo ($WEBROOT); ?>/Publicuse/verify/'  id="verifyImg" /></td>
     
                        </tr>
                      </table></td>
                      <td><div  align="center">
                        <input type='image' src="<?php echo ($WEBNAME); ?>/Public/images/dl.gif" name='Submit' id="weblogin" value="登录" class="inputlogin"/> <input name="Action" type="hidden" id="Action" value="Login" />
                      </div></td>
                    </tr>
                  </table>
                  </td>
                </tr>
            </table></td>
            <td width="368" background="<?php echo ($WEBNAME); ?>/Public/images/login_07.gif">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="213" background="<?php echo ($WEBNAME); ?>/Public/images/login_08.gif" align="center">&nbsp;<font color="red" ><span id="spantext"></span></font></td>
      </tr>
    </table></td>
  </tr>
</table>
  </form>
</body>
</html>