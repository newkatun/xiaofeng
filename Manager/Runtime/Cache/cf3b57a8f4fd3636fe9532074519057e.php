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
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/kindeditor.js"></script>
</head>
 <body>
<form name="formadd" method="post" action="__APP__/Pagelist/saveadd" id="formadd">
<table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED"   class="table_addtable">
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td height="40" colspan="4" align="left" background="images/nzcms_top01.gif" bgcolor="#C9DEFA" class="nzcms_table_top"><a href="__APP__/Pagelist/index">网站页面列表</a>>>增加网站页面</td>
</tr>
<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td width="12%" align="center">页面名称：</td>
<td>&nbsp;<input type="text" value="" class="inputtext" id="c_name" name="c_name" size="40"></td>
</tr>
<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td align="center">页面标题：</td>
<td>&nbsp;<input type="text" value="" class="inputtext" id="c_title" name="c_title" size="40"></td>
</tr>
<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td align="center">页面关键字：</td>
<td>&nbsp;<input type="text" value="" class="inputtext" id="c_keywords" name="c_keywords" size="40"></td>
</tr>
<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td align="center">页面描述：</td>
<td>&nbsp;<textarea class="inputtextarea" id="c_description" name="c_description" cols="70" rows="4"></textarea></td>   
</tr>

<tr bgcolor="#FFFFFF" onmouseout="this.bgColor='#FFFFFF';" onmouseover="this.bgColor='#E4EDF9';">
<td align="center">详细内容：</td>
<td><textarea class="inputtextarea" id="p_content" name="p_content" cols="70" rows="4" style="width:98%;"></textarea></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td  align="right">&nbsp;</td>
<td colspan="3"><input type="hidden" value="" id="autoid" name="autoid">
<input name="Submit3" type="submit" class="button rb1" value=" 提交 " id="addnew" />
<input type="button" class="button rb1" value=" 返回 " onclick="window.location.href='__APP__/Pagelist/index'"/></td>
</tr>
</table>
</form>


</body>
</html>