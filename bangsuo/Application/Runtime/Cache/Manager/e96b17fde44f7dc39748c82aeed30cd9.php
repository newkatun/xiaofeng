<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link href="/Phone/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="/Phone/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/common.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/manager/product.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/manager/use.js"></script>
</head>
<body>
<form name="formadd" method="post" action="/Phone/index.php/Manager/Category/saveadd" id="formadd">
  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="1"    class="table_addtable">
    <tr>
      <td height="40" colspan="2" align="left"  class="table_top"><a href="/Phone/index.php/Manager/Category/index">产品类型</a>>>增加产品类型</td>
    </tr>
    <tr>
      <td width="12%" align="center">品牌名称：</td>
      <td>&nbsp;
        <select name="ty_subid">
          <option value="0">作为一级分类</option>
          <?php if(is_array($CategoryTable)): $i = 0; $__LIST__ = $CategoryTable;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Cate): $mod = ($i % 2 );++$i;?><option value="<?php echo ($Cate["autoid"]); ?>"><?php echo ($Cate["ty_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <span id="ty_subidspan" class="inputspan"></span></td>
    </tr>
    <tr>
      <td width="12%" align="center">类型名称：</td>
      <td>&nbsp;
        <input type="text" size="80" name="ty_name" id="ty_name" class="inputtext" value=""/>
        <span id="ty_namespan" class="inputspan"></span></td>
    </tr>
    <tr>
      <td align="center">上次图片：</td>
      <td >&nbsp;
        <input type="text" value="" name="ty_imgurl" id="ty_imgurl" size="80">
        &nbsp;
        <input type="button" value="上传图片" class="uploadimg" attrname="ty_imgurl">
        <span id="ty_imgurlspan" class="inputspan"></span></td>
    </tr>
    <tr>
      <td align="center">类别排序：</td>
      <td >&nbsp;
        <input type="text" value="" name="ty_sort" id="ty_sort" size="6" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">
        <span id="ty_sortspan" class="inputspan"></span></td>
    </tr>
    <tr>
      <td align="center">类别关键词：</td>
      <td >&nbsp;
        <input type="text" value="" name="ty_keyword" id="ty_keyword" size="80">
        <span id="ty_keywordspan" class="inputspan"></span></td>
    </tr>
	<tr>
      <td align="center">类型描述：</td>
      <td >&nbsp;
        <textarea name="ty_description" id="ty_description" rows="5" cols="90"></textarea>
        <span id="ty_descriptionspan" class="inputspan"></span></td>
    </tr>
    <tr>
      <td align="center">类型介绍：</td>
      <td >&nbsp;
        <textarea name="ty_intro" id="ty_intro" rows="5" cols="90"></textarea>
        <span id="ty_introspan" class="inputspan"></span></td>
    </tr>
	<tr>
      <td align="center">首页显示：</td>
      <td >&nbsp;
        <input type="radio" name="ty_index" id="ty_index" value="0" >否
		<input type="radio" name="ty_index" id="ty_index" value="1" >是
        <span id="ty_indexspan" class="inputspan"></span></td>
    </tr>
    <tr>
      <td  align="right">&nbsp;</td>
      <td colspan="3"><input type="hidden" value="" id="autoid" name="autoid">
        <input name="Submit3" type="submit" class="button" value=" 提交 " id="addnew" />
        <input type="button" class="button" value=" 返回 " onClick="window.location.href='/Phone/index.php/productlist/index'"/></td>
    </tr>
  </table>
</form>
</body>
</html>