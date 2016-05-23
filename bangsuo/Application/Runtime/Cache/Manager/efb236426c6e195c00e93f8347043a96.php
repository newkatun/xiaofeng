<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link href="/Phone/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="/Phone/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/common.js"></script>
<script charset="utf-8" src="/Phone/Public/editor/kindeditor.js"></script>
<script charset="utf-8" src="/Phone/Public/editor/lang/zh_CN.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/manager/kindeditor.js"></script>
</head>
<body>
<form name="formadd" method="post" action="/Phone/index.php/Manager/Pagelist/saveedit" id="formadd">
  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="1"    class="table_addtable">
    <tr >
      <td height="40" colspan="4" align="left"  class="table_top"><a href="/Phone/index.php/Manager/Pagelist/index">网站页面列表</a>>>修改页面</td>
    </tr>
    <tr >
      <td width="12%" align="center">页面编号：</td>
      <td>
        <input type="text" value="<?php echo (CheckIsSet($Page["c_code"])); ?>" class="inputtext" id="c_code" name="c_code" size="40">
        <span id="c_codespan" class="inputspan"></span></td>
	   <td width="12%" align="center">页面名称：</td>
      <td>
        <input type="text"  class="inputtext" id="c_name" name="c_name" size="40" value="<?php echo (CheckIsSet($Page["c_name"])); ?>">
        <span id="c_namespan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td align="center">页面标题：</td>
      <td>
        <input type="text" value="<?php echo (CheckIsSet($Page["title"])); ?>" class="inputtext" id="c_title" name="c_title" size="40">
        <span id="c_titlespan" class="inputspan"></span></td> 
	  <td align="center">链接地址：</td>
      <td>
        <input type="text" value="<?php echo (CheckIsSet($Page["c_lurl"])); ?>" class="inputtext" id="c_lurl" name="c_lurl" size="40">
        
        <span id="c_lurlspan" class="inputspan"></span></td>
    </tr>
	<tr >
      <td align="center">选择模板：</td>
      <td colspan="3">
        <input type="radio"  id="c_type" name="c_type" value="0" <?php echo (CheckStr($Page["c_type"],0)); ?>>单页模板
        <input type="radio"   id="c_type" name="c_type" value="1" <?php echo (CheckStr($Page["c_type"],1)); ?>>文章模板
		<input type="radio"   id="c_type" name="c_type" value="2" <?php echo (CheckStr($Page["c_type"],2)); ?>>图片模板
		<input type="radio"  id="c_type" name="c_type" value="3" <?php echo (CheckStr($Page["c_type"],3)); ?> >产品模板
		<input type="radio"   id="c_type" name="c_type" value="4" <?php echo (CheckStr($Page["c_type"],4)); ?>>其他模板
		<input type="text" value="<?php echo (CheckIsSet($Page["c_typetext"])); ?>" class="inputtext" id="c_typetext" name="c_typetext" size="20">
        <span id="c_typetextspan" class="inputspan"></span></td> 
    </tr>
	<tr >
		<td align="center">页面图片：</td>
      <td colspan="3">
        <input type="text" value="<?php echo (CheckIsSet($Page["c_image"])); ?>" class="inputtext" id="c_image" name="c_image" size="80">
        <input name="button" type="button" class="uploadimg"  attrimage="c_image" value="上传图片" />
        <span id="c_imagespan" class="inputspan"></span></td>
	</tr>
    <tr >
      <td align="center">页面关键字：</td>
      <td colspan="3">
        <input type="text" value="<?php echo (CheckIsSet($Page["keywords"])); ?>" class="inputtext" id="keywords" name="keywords" size="80">
        <span id="keywordsspan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td align="center">页面描述：</td>
      <td colspan="3">
        <textarea class="inputtextarea" id="description" name="description" cols="80" rows="4"><?php echo ($Page["description"]); ?></textarea>
        <span id="descriptionspan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td align="center">详细内容：</td>
      <td colspan="3"><textarea class="inputtextarea" id="content" name="content" cols="80" rows="4" style="width:98%;"><?php echo ($Page["content"]); ?></textarea>
        <br>
        <span id="contentspan" class="inputspan"></span></td>
    </tr>
	<tr >
      <td align="center">优先级：</td>
      <td><input type="text" value="<?php echo ($Page["c_sort"]); ?>" class="inputtext" id="c_sort" name="c_sort" size="6"><span id="c_sortspan" class="inputspan"></span></td>
	  <td align="center">标题栏显示：</td>
      <td><input type="radio"   id="c_index" name="c_index" value="Y" <?php echo (CheckStr($Page["c_index"],'Y')); ?>>是<input type="radio"   id="c_index" name="c_index" value="N" <?php echo (CheckStr($Page["c_index"],'N')); ?>>否<span id="c_indexspan" class="inputspan"></span></td>
	  </tr>
	<tr >
	  <td align="center">网站底部显示：</td>
      <td colspan="3"><input type="radio"  id="c_bottom" name="c_bottom" value="Y" <?php echo (CheckStr($Page["c_bottom"],'Y')); ?>>是<input type="radio"  id="c_bottom" name="c_bottom" value="N" <?php echo (CheckStr($Page["c_bottom"],'Y')); ?>>否<span id="c_indexspan" class="inputspan"></span></td>
	</tr>
    <tr >
      <td  align="right"></td>
      <td colspan="3"><input type="hidden" value="<?php echo (CheckIsSet($Autoid)); ?>" id="autoid" name="autoid">
        <input name="Submit3" type="submit" class="button rb1" value=" 提交 " id="addnew" />
        <input type="button" class="button rb1" value=" 返回 " onClick="window.location.href='/Phone/index.php/Manager/Pagelist/index'"/></td>
    </tr>
  </table>
</form>
</body>
</html>