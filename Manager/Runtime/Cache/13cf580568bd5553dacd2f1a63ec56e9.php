<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link href="<?php echo ($WEBNAME); ?>/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/common.js"></script>
 </head>
 <body>
<form name="formadd" method="post" action="__APP__/Stypelist/saveadd" id="formadd">
<table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED"   class="table_addtable">
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td height="40" colspan="2" align="left" background="images/nzcms_top01.gif" bgcolor="#C9DEFA" class="nzcms_table_top"><a href="__APP__/Stypelist/index">产品销售状态</a>>>增加产品销售状态</td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="center">销售状态名称：</td>
<td>&nbsp;<input type="text" size="80" name="sole_name" id="sole_name" class="inputtext" value=""/><span style="color:gray;">*必须填写</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="center">页面标题：</td>
<td>&nbsp;<input type="text" size="80" name="sole_title" id="sole_title" class="inputtext" value=""/><span style="color:gray;">*必须填写</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="center">销售状态排序：</td>
<td >&nbsp;<input type="text" value="" name="sole_sort" id="sole_sort" size="6"></td>   
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="center">关键词：</td>
<td>&nbsp;<input type="text" size="80" name="keywords" id="keywords" class="inputtext" value=""/><span style="color:gray;">*必须填写</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="center">描述内容：</td>
<td>&nbsp;<textarea name="description" id="description" cols="80" rows="4"/></textarea><span style="color:gray;">*必须填写</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td  align="right">&nbsp;</td>
<td colspan="3">
<input type="submit" class="button" value=" 提交 " id="addnew" />
<input type="button" class="button" value=" 返回 " onclick="window.location.href='__APP__/productlist/index'"/></td>
</tr>
</table>
</form>


</body>
</html>