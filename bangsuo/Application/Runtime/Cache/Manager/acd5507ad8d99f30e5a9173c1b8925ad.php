<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link href="/Company/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="/Company/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="/Company/Public/js/common.js"></script>
<script charset="utf-8" src="/Company/Public/editor/kindeditor.js"></script>
<script charset="utf-8" src="/Company/Public/editor/lang/zh_CN.js"></script>
<script language="javascript" type="text/javascript" src="/Company/Public/js/manager/kindeditor.js"></script>
</head>
<body>
<form name="formadd" method="post" action="/Company/index.php/Manager/Newstypelist/saveedit" id="formadd">
  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="1"    class="table_addtable">
    <tr  >
      <td height="80" colspan="4" align="left"  class="table_top"><a href="/Company/index.php/Manager/Newstypelist/index">类型页面列表</a>>>修改类型页面</td>
    </tr>
    <tr  >
      <td width="12%"  align="right" ><strong>类型页面编号：</strong></td>
      <td  align="left" ><input name="type_pagename" class="inputtext" type="text" ID="type_pagename" size="20" value="<?php echo ($Type["type_pagename"]); ?>" >
        <span id="type_pagenamespan" class="inputspan">英文字符，且不能重复</span></td>
		 <td width="12%"  align="right" ><strong>类型页面名称：</strong></td>
      <td  align="left" ><input name="type_name" class="inputtext" type="text" ID="type_name" size="40" value="<?php echo ($Type["type_name"]); ?>">
        <span id="type_namespan" class="inputspan">缩写名称</span></td>
    </tr>
    <tr  >
     <td width="12%"  align="right" ><strong>类型英文名称：</strong></td>
	   <td  align="left" ><input name="type_subname" class="inputtext" type="text" id="type_subname" size="40" value="<?php echo ($Type["type_subname"]); ?>">
       <span id="type_subnamespan" class="inputspan"></span></td>
	   <td width="12%"  align="right" ><strong>页面转接地址：</strong></td>
      <td  align="left" colspan="3"><input name="type_url" class="inputtext" type="text" id="type_url" size="60" value="<?php echo ($Type["type_url"]); ?>">
        <span id="type_urlspan" class="inputspan">链接地址，外链需加http://</span></td>
    </tr>
    <tr  >
	 
      <td   align="right" ><strong>类型页面所属：</strong></td>
      <td  align="left" ><Select name="type_subpage" id="type_subpage">
          <option value="0">Please Select</option>
          <?php if(is_array($PageTable)): foreach($PageTable as $key=>$Page): if($Page['autoid'] == $Type['type_subpage']): ?><option value="<?php echo ($Page["autoid"]); ?>" selected="selected"><?php echo ($Page["c_name"]); ?></option>
              <?php else: ?>
              <option value="<?php echo ($Page["autoid"]); ?>" ><?php echo ($Page["c_name"]); ?></option><?php endif; endforeach; endif; ?>
        </select>
        <span id="type_subpagespan" class="inputspan"></span></td>
		<td   align="right" ><strong>类型页面层级：</strong></td>
      <td  align="left" ><Select name="type_main" id="type_main">
          <option value="0">一级目录</option>
		  <?php if(is_array($TypeViewList)): foreach($TypeViewList as $key=>$TypeV): if($TypeV['autoid'] == $Type['type_main']): ?><option value="<?php echo ($TypeV["autoid"]); ?>" selected="selected"><?php echo ($TypeV["type_name"]); ?></option>
		  <?php else: ?>
		  <option value="<?php echo ($TypeV["autoid"]); ?>"><?php echo ($TypeV["type_name"]); ?></option><?php endif; endforeach; endif; ?>
        </select>
        <span id="type_subpagespan" class="inputspan"></span></td>
		
    </tr>

    <tr  >
      <td   align="right" ><strong>类型页面选项：</strong></td>
      <td  align="left" ><input name="type_view"  type="radio" id="type_view"  value="0" <?php echo (CheckStr($Type["type_view"],0)); ?>/>
        单篇内容&nbsp;
        <input name="type_view"  type="radio" id="type_view"  value="1" <?php echo (CheckStr($Type["type_view"],1)); ?>/>
        文章类别&nbsp;
        <input name="type_view"  type="radio" id="type_view"  value="2" <?php echo (CheckStr($Type["type_view"],2)); ?>/>
        图片类别<span id="type_viewspan" class="inputspan"></span></td>
		<td   align="right" ><strong>类型页面排序：</strong></td>
      <td  align="left" ><input name="type_sort" class="inputtext" type="text" id="type_sort" size="5" value="<?php echo ($Type["type_sort"]); ?>" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">
        <span id="type_sortspan" class="inputspan">网站前台显示从小到大排列</span></td>
    </tr>
    <tr >
      <td width="12%"  align="right" ><strong>类型页面标题：</strong></td>
      <td  align="left" colspan="3"><input name="type_title" class="inputtext" type="text" ID="type_title" size="80" value="<?php echo ($Type["title"]); ?>">
        <span id="type_namespan" class="inputspan"></span></td>
    </tr>
    <tr  >
      <td width="12%"  align="right" ><strong>类型页面关键词：</strong></td>
      <td  align="left" colspan="3"><input name="type_keyword" class="inputtext" type="text" ID="type_keyword" size="80" value="<?php echo ($Type["keywords"]); ?>">
        <span id="type_keywordspan" class="inputspan"></span></td>
    </tr>
    <tr  >
      <td width="12%"  align="right" ><strong>类型页面描述：</strong></td>
      <td  align="left" colspan="3"><textarea name="type_description" class="inputtext" type="text" ID="type_description" cols="90" rows="3" ><?php echo ($Type["description"]); ?></textarea>
        <span id="type_descriptionspan" class="inputspan"></span></td>
    </tr>
    <tr  >
      <td width="12%"  align="right" ><strong>页面详细介绍：</strong></td>
      <td  align="left" colspan="3"><textarea id="content" name="content" rows="8" cols="60" style="width:98%;margin-top:5px;"><?php echo ($Type["type_content"]); ?></textarea>
        <br>
        <span id="contentspan" class="inputspan"></span></td>
    </tr>
	<tr  >
	 <td align="right"><strong>首页推荐显示：</strong></td>
      <td colspan="3"><input type="radio"  id="type_index" name="type_index" value="Y" <?php echo (CheckStr($Type["type_index"],'Y')); ?>>是<input type="radio"  id="type_index" name="type_index" value="N"  <?php echo (CheckStr($Type["type_index"],'N')); ?>>否<span id="type_indexspan" class="inputspan"></span></td>
	</tr>
    <tr >
      <td  align="right"></td>
      <td colspan="3"><input type="hidden" value="<?php echo ($Type["autoid"]); ?>" id="autoid" name="autoid">
        <input name="Submit3" type="submit" class="button" value=" 提交 " id="addnew" />
        <input type="button" class="button" value=" 返回 " onClick="window.location.href='/Company/index.php/Manager/Newstypelist/index'"/></td>
    </tr>
  </table>
</form>
</body>
</html>