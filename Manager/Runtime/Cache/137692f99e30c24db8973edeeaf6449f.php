<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理</title>
<link href="<?php echo ($WEBNAME); ?>/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<link href="<?php echo ($WEBNAME); ?>/Public/css/uploadify.css" type="text/css" rel="stylesheet"/>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/common.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/functions.js"></script>
</head>
<body>
<form name="formadd" method="post" action="__URL__/addtable" id="formadd">
<table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED" class="table_addcontent" >
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td height="40" colspan="2" class="nzcms_table_top">网站参数设置</td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="right">网站名称：</td>
<td >&nbsp;<input type="text" size="60" name="sy_company" id="sy_company" class="inputtext" value="<?php echo ($System["sy_company"]); ?>"/><span id="sy_companyspan">*</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="right">网站域名：</td>
<td >&nbsp;<input type="text" size="60" name="sy_hostname" id="sy_hostname" class="inputtext" value="<?php echo ($System["sy_hostname"]); ?>"/><span id="sy_hostnamespan">*</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="right">联系方式：</td>
<td >&nbsp;<input type="text" size="60" name="sy_telephone" id="sy_telephone" class="inputtext" value="<?php echo ($System["sy_telephone"]); ?>"/><span id="sy_telephonespan">*</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="right">传真号码：</td>
<td >&nbsp;<input type="text" size="60" name="sy_faxnumber" id="sy_faxnumber" class="inputtext" value="<?php echo ($System["sy_faxnumber"]); ?>"/><span id="sy_faxnumberspan">*</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="right">管理员邮箱：</td>
<td >&nbsp;<input type="text" size="60" name="sy_memail" id="sy_memail" class="inputtext" value="<?php echo ($System["sy_memail"]); ?>"/><span id="sy_memailspan">*</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="right">发送邮箱：</td>
<td >&nbsp;<input type="text" size="60" name="sy_semail" id="sy_semail" class="inputtext" value="<?php echo ($System["sy_semail"]); ?>"/><span id="sy_semailspan">*</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="right">发送邮箱密码：</td>
<td >&nbsp;<input type="text" size="60" name="sy_webpassword" id="sy_webpassword" class="inputtext" value="<?php echo ($System["sy_webpassword"]); ?>"/><span id="sy_webpasswordspan">*</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="right">STMP服务商：</td>
<td >&nbsp;<input type="text" size="60" name="sy_websmtp" id="sy_websmtp" class="inputtext" value="<?php echo ($System["sy_websmtp"]); ?>"/><span id="sy_websmtpspan">*</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="right">网站备案号：</td>
<td >&nbsp;<input type="text" size="60" name="sy_recordcode" id="sy_recordcode" class="inputtext" value="<?php echo ($System["sy_recordcode"]); ?>"/></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="right">公司地址：</td>
<td >&nbsp;<input type="text" size="60" name="sy_address" id="sy_address" class="inputtext" value="<?php echo ($System["sy_address"]); ?>"/></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td  align="right">&nbsp;</td>
<td colspan="3"><input type="hidden" value="" id="autoid" name="autoid">
<input name="Submit3" type="submit" class="button" value=" 提交 " id="addnew" />
<input name="Submit3" type="reset" class="button" value=" 重置 " /></td>
</tr>
</table>
</form>
</body>
</html>