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
<form name="formadd" method="post" action="__APP__/Sliderlist/saveedit" id="formadd">
<table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED"   class="table_addtable">
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td height="40" colspan="4" align="left" background="images/nzcms_top01.gif" bgcolor="#C9DEFA" class="nzcms_table_top"><a href="__APP__/Sliderlist/index">到货宣传广告列表</a>>>增加到货宣传广告</td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="10%"  align="right" ><strong>广告名称:</strong> </td>
<td  align="left" colspan="3">&nbsp;<input name="sl_title" class="inputtext" type="text" id="sl_title" size="60" value="<?php echo ($Slider["sl_title"]); ?>"><font color="red"><span id="fr_namespan"></span></font></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td width="10%"  align="right" ><strong>广告标签:</strong> </td>
<td  align="left" colspan="3">&nbsp;<input name="sl_prodname" class="inputtext" type="text" id="sl_prodname" size="60" value="<?php echo ($Slider["sl_prodname"]); ?>"><font color="red"><span id="fr_namespan"></span></font></td>
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="right"><strong>广告宣传图:</strong></td>
<td>&nbsp;<input type="text" size="60" name="sl_bigimg" id="sl_bigimg" class="inputtext" value="<?php echo ($Slider["sl_bigimg"]); ?>" />&nbsp;<input name="button" type="button" class="uploadimg"  value="上传图片" attrname="sl_bigimg" />&nbsp;<span style="color:gray">产品图大小为：703*258px</span></td>   
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="right"><strong>广告产品图:</strong></td>
<td>&nbsp;<input type="text" size="60" name="sl_smaimg" id="sl_smaimg" class="inputtext" value="<?php echo ($Slider["sl_smaimg"]); ?>" />&nbsp;<input name="button" type="button" class="uploadimg"  value="上传图片" attrname="sl_smaimg" /> &nbsp;<span style="color:gray">产品图大小为：213*152px</span></td>   
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="right"><strong>链接地址:</strong></td>
<td>&nbsp;<input type="text" size="40" name="sl_linkurl" id="sl_linkurl" class="inputtext" value="<?php echo ($Slider["sl_linkurl"]); ?>" /></td>   
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="right"><strong>到货时间:</strong></td>
<td>&nbsp;<input type="text" size="40" name="sl_gettime" id="sl_gettime" class="inputtext" value="<?php echo ($Slider["sl_gettime"]); ?>" /></td>   
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td align="right"><strong>图片排序:</strong></td>
<td>&nbsp;<input type="text" size="6" name="sl_sort" id="sl_sort" class="inputtext" value="<?php echo ($Slider["sl_sort"]); ?>" />&nbsp;&nbsp;<span style="color:gray">请输入一个数字，排序从小到大!</span></td>   
</tr>
<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
<td  align="right">&nbsp;</td>
<td colspan="3"><input type="hidden" value="<?php echo ($Slider["autoid"]); ?>" id="autoid" name="autoid">
<input name="Submit3" type="submit" class="button rb1" value=" 提交 " id="addnew" />
<input type="button" class="button rb1" value=" 返回 " onclick="window.location.href='__APP__/Sliderlist/index'"/></td>
</tr>
</table>
</form>


</body>
</html>