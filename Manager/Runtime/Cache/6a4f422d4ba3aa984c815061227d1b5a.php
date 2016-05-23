<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link  href="<?php echo ($WEBNAME); ?>/Public/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($WEBNAME); ?>/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/common.js"></script>
<script charset="utf-8" src="<?php echo ($WEBNAME); ?>/Public/editor/kindeditor.js"></script>
<script charset="utf-8" src="<?php echo ($WEBNAME); ?>/Public/editor/lang/zh_CN.js"></script>
<link rel="stylesheet" href="<?php echo ($WEBNAME); ?>/Public/editor/themes/default/default.css" />
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/uploadimg.js"></script>
 </head>
 <body>
<form name="formadd" method="post" action="__APP__/Feedlist/saveedit" id="formadd">
<table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED"   class="table_addtable">
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td height="40" colspan="4" align="left" background="images/nzcms_top01.gif" bgcolor="#C9DEFA" class="nzcms_table_top"><a href="__APP__/Feedlist/index">客户留言列表</a>>>修改客户留言</td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="right" width="10%">留言主题:</td>
<td>&nbsp;<?php echo ($Feed["f_title"]); ?></td>   
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="right">客户名称:</td>
<td>&nbsp;<?php echo ($Feed["f_uname"]); ?></td>   
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="right">邮箱地址:</td>
<td>&nbsp;<?php echo ($Feed["f_email"]); ?></td>   
</tr>
<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td align="center">留言内容：</td>
<td>&nbsp;<?php echo (htmlspecialchars_decode($Feed["f_content"])); ?></td>
</tr>
<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td align="center">留言时间：</td>
<td>&nbsp;<?php echo ($Feed["datetime"]); ?></td>
</tr>

<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td  align="right">&nbsp;</td>
<td colspan="3"><input type="hidden" value="<?php echo ($Feed["autoid"]); ?>" id="autoid" name="autoid">
<input name="Submit3" type="submit" class="button rb1" value=" 提交 " id="addnew" />
<input type="button" class="button rb1" value=" 返回 " onclick="window.location.href='__APP__/Feedlist/index'"/></td>
</tr>
</table>
</form>


</body>
</html>