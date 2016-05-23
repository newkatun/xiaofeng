<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link href="<?php echo ($WEBNAME); ?>/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/common.js"></script>
</head>
<body>
<table width="100%" border="1" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED"  align="center" >
  <tr>
    <td  class="nzcms_table_top">登陆信息</td>
  </tr>
  <tr>
    <td bgcolor="#E4EDF9">&#8226;&nbsp;您好!&nbsp;<?php echo ($GUESTNAME); ?> 身份：网站管理员, 登陆IP：<?php echo ($IPAddress); ?>,登陆时间：<?php echo ($LoginDate); ?>, 登陆次数：<?php echo ($LoginTime); ?></td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED"  align="center"  class="main_table">
  <tr>
    <td  class="nzcms_table_top" colspan="8">网站信息<span class="topspan"><a href="__APP__/functions">设置网站参数</a></span></td>
  </tr>
  <tr>
    <td class="main_table_left">网站名称：</td>
    <td><?php echo ($System["sy_company"]); ?></td>
    <td class="main_table_left">网站域名：</td>
    <td><?php echo ($System["sy_hostname"]); ?></td>
	 <td class="main_table_left">联系电话：</td>
    <td><?php echo ($System["sy_telephone"]); ?></td>
    <td class="main_table_left">传真号码：</td>
    <td><?php echo ($System["sy_faxnumber"]); ?></td>
  </tr>

   <tr>
    <td class="main_table_left">管理员邮箱：</td>
    <td><?php echo ($System["sy_memail"]); ?></td>
    <td class="main_table_left">网站备案号：</td>
    <td><?php echo ($System["sy_recordcode"]); ?></td>
	 <td class="main_table_left">邮件发送号：</td>
    <td><?php echo ($System["sy_semail"]); ?></td>
    <td class="main_table_left">SMTP服务商：</td>
    <td><?php echo ($System["sy_websmtp"]); ?></td>
  </tr>

   <tr>
<!--     <td class="main_table_left">支持语言：</td>
    <td>
	<?php if(is_array($LanguageList)): $i = 0; $__LIST__ = $LanguageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lang): $mod = ($i % 2 );++$i; echo ($lang["lang_name"]); ?>,<?php endforeach; endif; else: echo "" ;endif; ?>
	</td> -->

	 <td class="main_table_left" >公司地址：</td><td  colspan="7"><?php echo ($System["sy_address"]); ?></td>
  </tr>

</table>
<table width="100%" border="1" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED" class="main_table" align="center">
  <tr>
    <td   class="nzcms_table_top">网站最新动态</td>
  </tr>
  <tr>
    <td width="10%"  bgcolor="#E4EDF9">&#8226;&nbsp;总共有  个产品。点击这里处理</td>
  </tr>
  <tr>
    <td width="10%"  bgcolor="#E4EDF9">&#8226;&nbsp;总共有  篇文章。点击这里里处理</td>
  </tr>
  <tr>
    <td width="10%"  bgcolor="#E4EDF9">&#8226;&nbsp;总共有  条留言。 已审核  条留言 , <a href="notebook_view.php">点击</a></td>
  </tr>
  <tr>
    <td width="10%"  bgcolor="#E4EDF9">&#8226;&nbsp;总共有 0 个订单。 点击这里处理</td>
  </tr>
</table>
</body>
</html>