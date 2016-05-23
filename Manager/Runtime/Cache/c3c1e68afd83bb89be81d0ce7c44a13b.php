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
<form name="formadd" method="post" action="__APP__/Newslist/saveadd" id="formadd">
<table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED"   class="table_addtable">
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td height="40" colspan="4" align="left" background="images/nzcms_top01.gif" bgcolor="#C9DEFA" class="nzcms_table_top"><a href="__APP__/Newslist/index">新闻列表</a>>>添加新闻</td>
</tr>
 <tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="10%"  align="right" ><strong>新闻标题：</strong> </td>
<td  align="left" width="40%">&nbsp;<input name="n_title" class="inputtext" type="text" ID="n_title" size="40" value=""> <font color="red"><span id="n_titlespan"></span></font></td>
<td width="10%"  align="right" ><strong>新闻分类：</strong></td>
<td  align="left" width="40%">&nbsp;<Select name="n_typeid" id="n_typeid">
<option value="0">请选择</option> 
<?php if(is_array($NewsTypeList)): foreach($NewsTypeList as $key=>$Ntype): ?><option value="<?php echo ($Ntype["autoid"]); ?>" ><?php echo ($Ntype["atype_name"]); ?></option><?php endforeach; endif; ?>
</select> <input type="hidden" name="n_type" id="n_type" value="conpany"/> <font color="red"><span id="n_typespan"></span></font></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
 <td  align="right"  ><strong>上传图片：</strong></td>
<td  align="left" >&nbsp; <input id="n_smaimg" name="n_smaimg" type="text" class="inputtext" size="40" value=""/> &nbsp;&nbsp;&nbsp;  <input name="button" type="button" class="uploadimg"  value="上传图片" attrimage="n_smaimg"/> <span id="n_smaimgspan"></span></font></td>
<td  align="right" ><strong>关联产品：</strong></td>
<td  align="left">&nbsp; <Select name="n_prodid" id="n_prodid">  <option value="0">请选择</option> </select></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
 <td  align="right"  ><strong>新闻关键词：</strong></td>
 <td  align="left" colspan="3">&nbsp;<input name="n_keywords" type="text" id="n_keywords" class="inputtext" size="60" value=""/>&nbsp;&nbsp;&nbsp;</td>
 </tr>
 <tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
 <td  align="right"  ><strong>新闻描述：</strong></td>
 <td  align="left" colspan="3">&nbsp;<textarea name="n_description" cols="60" rows="3"></textarea></td>
 </tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
 <td  align="right"  ><strong>新闻简要：</strong></td>
<td  align="left" colspan="3">&nbsp; <textarea  cols="65" rows="3" id="n_intro" name="n_intro"></textarea> <font color="red"><span id="n_introspan"></span></font></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
  <td width="10%"  align="right" ><strong>详细介绍：</strong></td>
  <td  align="left" colspan="3">&nbsp;
<textarea name="p_content" rows="8" cols="60" style="width:98%;margin-top:5px;"></textarea>
</td>
</tr>


<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
  <td width="10%"  align="right" ><strong>热门新闻：</strong></td>
  <td  align="left" colspan="3">&nbsp;<input type="radio" value="1" name="n_hot" checked="checked">是&nbsp;&nbsp;</td>
  </tr>
  

<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td  align="right">&nbsp;</td>
<td colspan="3"><input type="hidden" value="" id="autoid" name="autoid">
<input name="Submit3" type="submit" class="button" value=" 提交 " id="addnew" />
<input type="button" class="button" value=" 返回 " onclick="window.location.href='__APP__/Newslist/index'"/></td>
</tr>
</table>
</form>


</body>
</html>