<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link  href="<?php echo ($WEBNAME); ?>/Public/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($WEBNAME); ?>/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/common.js"></script>
</head>
 <body>
<form name="formadd" method="post" action="__APP__/Userlist/saveedit" id="formadd">
<table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED"   class="table_addtable">
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td height="40" colspan="4" align="left" background="images/nzcms_top01.gif" bgcolor="#C9DEFA" class="nzcms_table_top"><a href="__APP__/Userlist/index">网站管理员列表</a>>>修改网站管理员</td>
</tr>
<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td width="12%" align="center">管理员帐号：</td>
<td>&nbsp;<input type="text" value="<?php echo ($User["user_name"]); ?>" class="inputtext" id="user_name" name="user_name" size="40"></td>
</tr>
<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td align="center">管理员密码：</td>
<td>&nbsp;<input type="password" value="" class="inputtext" id="user_password" name="user_password" size="40"></td>
</tr>
<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td align="center">确认密码：</td>
<td>&nbsp;<input type="password" value="" class="inputtext" id="user_passwordchk" name="user_passwordchk" size="40"></td>
</tr>
<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td align="center">管理员邮箱：</td>
<td>&nbsp;<input type="text" value="<?php echo ($User["user_email"]); ?>" class="inputtext" id="user_email" name="user_email" size="40"></td>   
</tr>
<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td align="center">管理员权限：</td>
<td>&nbsp;<input type="checkbox"  value="1" class="inputtext" id="user_power" name="user_power[]" <?php echo (htmlcheck($User["user_power"],1)); ?>>产品管理 &nbsp;<input type="checkbox"  value="4" class="inputtext" id="user_power" name="user_power[]" <?php echo (htmlcheck($User["user_power"],4)); ?>>订单管理&nbsp;<input type="checkbox"  value="2" class="inputtext" id="user_power" name="user_power[]" <?php echo (htmlcheck($User["user_power"],2)); ?>>用户管理&nbsp;<input type="checkbox"  value="5" class="inputtext" id="user_power" name="user_power[]" <?php echo (htmlcheck($User["user_power"],5)); ?>>文章管理&nbsp;<input type="checkbox"  value="3" class="inputtext" id="user_power" name="user_power[]" <?php echo (htmlcheck($User["user_power"],3)); ?>>功能管理&nbsp;</td>   
</tr>
<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td align="center">管理员备注：</td>
<td>&nbsp;<textarea class="inputtextarea" id="user_intro" name="user_intro" cols="70" rows="4"><?php echo ($User["user_intro"]); ?></textarea></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td  align="right">&nbsp;</td>
<td colspan="3"><input type="hidden" value="<?php echo ($User["autoid"]); ?>" id="autoid" name="autoid">
<input name="Submit3" type="submit" class="button rb1" value=" 提交 " id="addnew" />
<input type="button" class="button rb1" value=" 返回 " onclick="window.location.href='__APP__/Userlist/index'"/></td>
</tr>
</table>
</form>


</body>
</html>