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
<form name="formadd" method="post" action="__APP__/Categorylist/saveedit" id="formadd">
<table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED"   class="table_addtable">
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td height="40" colspan="2" align="left" background="images/nzcms_top01.gif" bgcolor="#C9DEFA" class="nzcms_table_top"><a href="__APP__/Categorylist/index">产品类型</a>>>修改产品类型</td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td height="40" colspan="2" align="center" background="images/nzcms_top01.gif" bgcolor="#C9DEFA" class="nzcms_table_top">修改类型</td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="center">品牌名称：</td>
<td>&nbsp;<select name="ty_subid"><option value="0">作为一级分类</option>
<?php if(is_array($CategoryTable)): $i = 0; $__LIST__ = $CategoryTable;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$CateT): $mod = ($i % 2 );++$i; if($CateT['autoid'] == $Cate['ty_subid']): ?><option value="<?php echo ($CateT["autoid"]); ?>" selected="selected"><?php echo ($CateT["ty_name"]); ?></option>
<?php else: ?>
<option value="<?php echo ($CateT["autoid"]); ?>"><?php echo ($CateT["ty_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</select>
<span style="color:gray;">*必须填写</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="12%" align="center">类型名称：</td>
<td>&nbsp;<input type="text" size="80" name="ty_name" id="ty_name" class="inputtext" value="<?php echo ($Cate["ty_name"]); ?>"/><span style="color:gray;">*必须填写</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="center">上次图片：</td>
<td >&nbsp;<input type="text" value="<?php echo ($Cate["ty_imgurl"]); ?>" name="ty_imgurl" id="ty_imgurl" size="80">&nbsp;<input type="button" value="上传图片" class="uploadimg" attrname="ty_imgurl"></td>   
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="center">类别排序：</td>
<td >&nbsp;<input type="text" value="<?php echo ($Cate["ty_sort"]); ?>" name="ty_sort" id="ty_sort" size="20"></td>   
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="center">类型介绍：</td>
<td >&nbsp;<textarea name="ty_intro" id="ty_intro" rows="5" cols="70"><?php echo ($Cate["ty_intro"]); ?></textarea><span style="color:gray;">*必须填写</span></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td  align="right">&nbsp;</td>
<td width="878"><input type="hidden" name="autoid"  value="<?php echo ($Cate["autoid"]); ?>" />
<input name="Submit3" type="submit" class="button" value=" 提交 " id="addnew" />
<input name="Submit3" type="reset" class="button" value=" 重置 " /></td>
</tr>
</table>
</form>


</body>
</html>