<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link href="/Phone/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="/Phone/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/common.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/manager/product.js"></script>
<script charset="utf-8" src="/Phone/Public/editor/kindeditor.js"></script>
<script charset="utf-8" src="/Phone/Public/editor/lang/zh_CN.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/manager/kindeditor.js"></script>
</head>
<body>
<form name="formadd" method="post" action="/Phone/index.php/Manager/Productlist/saveedit" id="formadd">
  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="1"    class="table_addtable">
    <tr >
      <td height="40" colspan="4" align="left"  class="table_top"><a href="/Phone/index.php/Manager/Productlist/index">产品列表</a>>>修改产品</td>
    </tr>
    <tr >
      <td width="10%"  align="right" ><strong>产品编号：</strong></td>
      <td  align="left" ><input name="prod_id" class="inputtext" type="text" id="prod_id" size="30" value="<?php echo ($Prod["prod_id"]); ?>" >
        <span id="prod_idspan" class="inputspan"></span></td>
      <td width="10%"  align="right" ><strong>产品名称：</strong></td>
      <td  align="left"  ><input name="prod_name" class="inputtext" type="text" id="prod_name" size="50" value="<?php echo ($Prod["prod_name"]); ?>">
        <span id="prod_namespan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td width="10%"  align="right" ><strong>上传图片：</strong></td>
      <td  align="left"  colspan="3"><input name="prod_img" class="inputtext" type="text" id="prod_img" size="80" value="<?php echo ($Prod["img_url"]); ?>">
        <input name="button" type="button" class="uploadimg"  attrimage="prod_img" value="上传图片" imgwidth="230"/>
        <span id="prod_imgspan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td   align="right" ><strong>产品大类：</strong></td>
      <td  align="left" ><Select name="prod_mainid" id="prod_mainid">
          <option value="0">请选择</option>
          <?php if(is_array($CategoryList)): $i = 0; $__LIST__ = $CategoryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Cate): $mod = ($i % 2 );++$i; if($Cate['autoid'] == $Prod['prod_mainid']): ?><option value="<?php echo ($Cate["autoid"]); ?>" selected><?php echo ($Cate["ty_name"]); ?></option>
              <?php else: ?>
              <option value="<?php echo ($Cate["autoid"]); ?>"><?php echo ($Cate["ty_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <span id="prod_mainidspan" class="inputspan"></span></td>
      <td width="10%"  align="right" ><strong>产品细类：</strong></td>
      <td  align="left" width="40%"><Select name="prod_subid" id="prod_subid">
          <option value="0">请选择</option>
        </select>
        <input type="hidden" id="subvalue" name="subvalue" value="<?php echo ($Prod["prod_subid"]); ?>"/>
        <span id="prod_subidspan" class="inputspan"></span></td>
    </tr>
    <tr>
      <td width="10%"  align="right" ><strong>产品排序：</strong></td>
      <td  align="left"  width="40%"><input name="prod_sort" class="inputtext" type="text" id="prod_sort" size="5" value="<?php echo ($Prod["prod_sort"]); ?>" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">
        <span id="prod_subidspan" class="inputspan">网站前台显示从大到小排列</span></td>
      <td width="10%"  align="right" ><strong>点击数：</strong></td>
      <td  align="left" ><input name="prod_hits" class="inputtext" type="text" id="prod_hits" size="5" value="<?php echo ($Prod["prod_hits"]); ?>" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">
        <span id="prod_hitsspan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td  align="right"  ><strong>产品关键词：</strong></td>
      <td  align="left"  colspan="3"><input name="prod_keywords" type="text" id="prod_keywords" class="inputtext" size="80" value="<?php echo ($Prod["keywords"]); ?>"/>
        <span id="prod_keywordsspan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td width="10%"  align="right" ><strong>产品简介：</strong></td>
      <td  align="left" colspan="3"><textarea name="prod_intro" class="textarea" type="text" id="prod_intro" cols="80" rows="3" ><?php echo ($Prod["intro"]); ?></textarea>
        <span id="prod_introspan" class="inputspan"></span></td>
    </tr>
	<tr >
      <td width="10%"  align="right" ><strong>产品属性：</strong></td>
      <td  align="left" colspan="3"><textarea name="prod_attr" class="textarea" type="text" id="prod_attr" cols="80" rows="2" ><?php echo ($Prod["prod_attr"]); ?></textarea>
        <span id="prod_attrspan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td width="10%"  align="right" ><strong>详细介绍：</strong></td>
      <td  align="left" colspan="3"><textarea name="content" id="content" rows="8" cols="60" style="width:98%;margin-top:5px;"><?php echo ($Prod["content"]); ?></textarea>
        <br>
        <span id="contentspan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td width="10%"  align="right" ><strong>产品状态：</strong></td>
      <td  align="left" >&nbsp;
	   <input type="radio" value="2" name="prod_status" <?php echo (CheckStr($Prod["prod_status"],2)); ?>>
        新品&nbsp;&nbsp;
        <input type="radio" value="1" name="prod_status" <?php echo (CheckStr($Prod["prod_status"],1)); ?>>
        热门&nbsp;&nbsp;
        <input type="radio" value="0" name="prod_status" <?php echo (CheckStr($Prod["prod_status"],0)); ?>>
        正常<span id="prod_statusspan" class="inputspan"></span></td>
		<td width="10%"  align="right" ><strong>产品发布：</strong></td>
	 <td  align="left">
	 <input type="radio" value="T" name="prod_show" <?php echo (CheckStr($Prod["prod_show"],'T')); ?>>
        是
	 <input type="radio" value="N" name="prod_show" <?php echo (CheckStr($Prod["prod_show"],'N')); ?>>
        否<span id="prod_statusspan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td  align="right">&nbsp;</td>
      <td colspan="3"><input type="hidden" value="<?php echo ($Prod["autoid"]); ?>" id="autoid" name="autoid">
        <input name="Submit3" type="submit" class="button" value=" 提交 " id="addnew" />
        <input type="button" class="button" value=" 返回 " onClick="window.location.href='/Phone/index.php/Manager/Productlist/index'"/></td>
    </tr>
  </table>
</form>
</body>
</html>