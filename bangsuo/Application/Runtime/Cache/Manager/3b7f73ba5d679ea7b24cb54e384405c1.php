<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link href="/Phone/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="/Phone/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/common.js"></script>
<script type="text/javascript" src="/Phone/Public/js/manager/main.js">

</script>
</head>
<body>
<table width="100%" border="1" cellpadding="0" cellspacing="1"   align="center" class="table_cont">
  <tr>
    <td  class="table_top">登陆信息</td>
  </tr>
  <tr>
    <td >&#8226;&nbsp;您好!&nbsp;<?php echo ($GUESTNAME); ?> 身份：网站管理员, 登陆IP：<?php echo ($IPAddress); ?>,登陆时间：<?php echo ($LoginDate); ?>, 登陆次数：<?php echo ($LoginTime); ?></td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="1"   align="center"  class="table_cont">
  <tr>
    <td  class="table_top" colspan="8">网站信息<span class="table_spanadd"><a href="/Phone/manager/systems">设置网站参数</a></span></td>
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
    <td class="main_table_left" >公司地址：</td>
    <td  colspan="7"><?php echo ($System["sy_address"]); ?></td>
  </tr>
  
  <tr> <td class="main_table_left" >功能操作</td> <td  colspan="7"><a href="javascript:void(0)" class="cacheBtn" >清除网站缓存数据</a><span class="cacheClearMsg" style="color:red;"></span></td></tr>
</table>

</body>
</html>