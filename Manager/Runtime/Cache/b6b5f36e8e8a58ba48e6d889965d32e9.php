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
<form name="formadd" method="post" action="__APP__/Newstypelist/saveadd" id="formadd">
<table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED"   class="table_addtable">
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td height="40" colspan="2" align="left" background="images/nzcms_top01.gif" bgcolor="#C9DEFA" class="nzcms_table_top"><a href="__APP__/Newstypelist/index">文章类型</a>>>增加文章类型</td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="center">类型名称：</td>
<td><input type="text" size="80" name="atype_name" id="atype_name" class="inputtext" value=""/><span style="color:gray;">*必须填写</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="center">类型标题：</td>
<td><input type="text" size="80" name="atype_title" id="atype_title" class="inputtext" value=""/><span style="color:gray;">*必须填写</span></td>
</tr>

<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="center">类型选项：</td>
<td ><input type="radio" name="atype_type" value="1" />单篇类型<input type="radio" name="atype_type" value="2" />列表类型</td>   
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="center">类型位置：</td>
<td ><input type="radio" name="atype_service" value="1" />位置1<input type="radio" name="atype_service" value="2" />位置2</td>   
</tr>

<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="center">类型排序：</td>
<td ><input type="text" value="" name="atype_sort" id="atype_sort" size="6"></td>   
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="center">关键词：</td>
<td><input type="text" size="80" name="atype_keywords" id="atype_keywords" class="inputtext" value=""/><span style="color:gray;">*必须填写</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="center">描述内容：</td>
<td><textarea name="atype_descrption" id="atype_descrption" cols="80" rows="4"/></textarea><span style="color:gray;">*必须填写</span></td>
</tr>  
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="center">类型介绍：</td>
<td ><textarea name="p_content"  rows="5" cols="80" style="width:98%;"></textarea><span style="color:gray;">*必须填写</span></td>
</tr>


<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td  align="right"></td>
<td colspan="3"><input type="hidden" value="" id="autoid" name="autoid">
<input name="Submit3" type="submit" class="button" value=" 提交 " id="addnew" />
<input type="button" class="button" value=" 返回 " onclick="window.location.href='__APP__/productlist/index'"/></td>
</tr>
</table>
</form>


</body>
</html>