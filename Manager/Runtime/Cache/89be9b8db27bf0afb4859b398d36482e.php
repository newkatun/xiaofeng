<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link  href="<?php echo ($WEBNAME); ?>/Public/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($WEBNAME); ?>/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/common.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/product.js"></script>
<script charset="utf-8" src="<?php echo ($WEBNAME); ?>/Public/editor/kindeditor.js"></script>
<script charset="utf-8" src="<?php echo ($WEBNAME); ?>/Public/editor/lang/zh_CN.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/kindeditor.js"></script>
 </head>
 <body>
<form name="formadd" method="post" action="__APP__/Productlist/saveedit" id="formadd">
<table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED"   class="table_addtable">
<tr >
<td height="40" colspan="4" align="left" background="images/nzcms_top01.gif" bgcolor="#C9DEFA" class="nzcms_table_top"><a href="__APP__/Productlist/index">产品列表</a>>>修改产品</td>
</tr>
 <tr >
  <td width="10%"  align="right" ><strong>产品编号：</strong></td>
  <td  align="left" width="40%"><input name="p_id" class="inputtext" type="text" id="p_id" size="40" value="<?php echo ($Prod["p_id"]); ?>" ><font color="red"><span id="p_idspan"></span></font></td>
  <td width="10%"  align="right" ><strong>产品名称：</strong></td>
  <td  align="left" width="40%"><input name="p_name" class="inputtext" type="text" id="p_name" size="40" value="<?php echo ($Prod["p_name"]); ?>"><font color="red"><span id="p_namespan"></span></font></td>
</tr>
<tr > 
<td   align="right" ><strong>产品大类：</strong></td> 
<td  align="left" >
<Select name="p_typeid" id="p_typeid" > 
 <option value="0">Please Select</option> 
 <?php if(is_array($CategoryList)): $i = 0; $__LIST__ = $CategoryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Cate): $mod = ($i % 2 );++$i; if($Cate['autoid'] == $Prod['p_typeid']): ?><option value="<?php echo ($Cate["autoid"]); ?>" selected="selected"><?php echo ($Cate["ty_name"]); ?></option> 
<?php else: ?>
<option value="<?php echo ($Cate["autoid"]); ?>"><?php echo ($Cate["ty_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
 
</select>
 </td><td width="10%"  align="right" ><strong>产品细类：</strong></td>
  <td  align="left" width="40%"><Select name="p_ttypeid" id="p_ttypeid">
<option value="0">Please Select</option>
<?php if(is_array($CategorySubList)): $i = 0; $__LIST__ = $CategorySubList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Subcate): $mod = ($i % 2 );++$i; if($Subcate['autoid'] == $Prod['p_ttypeid']): ?><option value="<?php echo ($Subcate["autoid"]); ?>" selected="selected"><?php echo ($Subcate["ty_name"]); ?></option> 
<?php else: ?>
<option value="<?php echo ($Subcate["autoid"]); ?>"><?php echo ($Subcate["ty_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</select>
<span id="prod_mainidspan">*</span></td>
</tr>
<tr >
  <td width="10%"  align="right" ><strong>上传图片：</strong></td>
  <td  align="left" ><input name="p_img" class="inputtext" type="text" id="p_img" size="40" value="<?php echo ($Prod["p_img"]); ?>">&nbsp;&nbsp;&nbsp;<input name="button" type="button" class="uploadimg"  attrimage="p_img" value="上传图片" /><font color="red"><span id="p_imgspan"></span></font></td>
 <td width="10%"  align="right" ><strong>产品排序：</strong></td>
  <td  align="left" ><input name="p_sort" class="inputtext" type="text" id="p_sort" size="5" value="<?php echo ($Prod["p_sort"]); ?>" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">&nbsp;&nbsp;&nbsp;<font color="red">网站前台显示从小到大排列</font></td>
</tr>
 <tr >
  <td width="10%"  align="right" ><strong>产品价格：</strong></td>
  <td  align="left" width="40%"><input name="p_price" class="inputtext" type="text" id="p_price" size="40" value="<?php echo ($Prod["p_price"]); ?>" ><font color="red"><span id="p_idspan"></span></font></td>
  <td width="10%"  align="right" ><strong>产品市场价：</strong></td>
  <td  align="left" width="40%"><input name="p_oldprice" class="inputtext" type="text" id="p_oldprice" size="40" value="<?php echo ($Prod["p_oldprice"]); ?>"><font color="red"><span id="p_namespan"></span></font></td>
</tr>
<tr >
 <td  align="right"  ><strong>产品关键词：</strong></td>
 <td  align="left" colspan="3"><input name="p_keywords" type="text" id="p_keywords" class="inputtext" size="60" value="<?php echo ($Prod["p_keywords"]); ?>"/>&nbsp;&nbsp;&nbsp;</td>
 </tr>
 <tr >
 <td  align="right"  ><strong>产品描述：</strong></td>
 <td  align="left" colspan="3"><textarea name="p_description" cols="60" rows="3" class="textarea"><?php echo ($Prod["p_description"]); ?></textarea></td>
 </tr>
<tr >
 <td width="10%"  align="right" ><strong>产品简介：</strong></td>
  <td  align="left" colspan="3"><textarea name="p_intro" class="textarea" type="text" id="p_intro" cols="80" rows="3" ><?php echo ($Prod["p_intro"]); ?></textarea>&nbsp;<span id="P_introspan"></span></td> 
</tr>
<tr >
  <td width="10%"  align="right" ><strong>详细介绍：</strong></td>
  <td  align="left" colspan="3">
<textarea name="p_content" rows="8" cols="60" style="width:98%;margin-top:5px;"><?php echo ($Prod["p_content"]); ?></textarea>
</td>
</tr>


<tr >
  <td width="10%"  align="right" ><strong>产品状态：</strong></td>
  <td  align="left" colspan="3">&nbsp;<input type="radio" value="0" name="p_status" checked=checked>立即发布&nbsp;&nbsp;<input type="radio" value="1" name="p_status" >进入仓库</td>
  </tr>
  
  <tr >
  <td width="10%"  align="right" ><strong>新产品：</strong></td>
  <td  align="left" colspan="3">&nbsp;<input type="radio" value="1" name="p_new" checked=checked>是&nbsp;&nbsp;<input type="radio" value="0" name="p_new" >否</td>
  </tr> 
<tr >
<td  align="right">&nbsp;</td>
<td colspan="3"><input type="hidden" value="<?php echo ($Prod["autoid"]); ?>" id="autoid" name="autoid">
<input name="Submit3" type="submit" class="button" value=" 提交 " id="addnew" />
<input type="button" class="button" value=" 返回 " onclick="window.location.href='__APP__/productlist/index'"/></td>
</tr>
</table>
</form>


</body>
</html>