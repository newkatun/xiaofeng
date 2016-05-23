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
<form name="formadd" method="post" action="/Company/index.php/Manager/Newslist/saveedit" id="formadd">
  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="1"    class="table_addtable">
    <tr >
      <td height="40" colspan="4" align="left"  class="table_top"><a href="/Company/index.php/Manager/Newslist/index">文章列表</a>>>修改文章</td>
    </tr>
    <tr >
      <td width="12%"  align="right" ><strong>文章名称：</strong></td>
      <td  align="left" ><input name="news_name" class="inputtext" type="text" ID="news_name" size="50" value="<?php echo ($News["news_name"]); ?>">
        <span id="news_namespan" class="inputspan"></span></td>
      <td   align="right" ><strong>文章大类：</strong></td>
      <td  align="left" ><Select name="news_type" id="news_type">
          <option value="0">Please Select</option>
          <?php if(is_array($CategoryList)): foreach($CategoryList as $key=>$Type): if($Type['autoid'] == $News['news_type']): ?><option value="<?php echo ($Type["autoid"]); ?>" selected><?php echo ($Type["type_name"]); ?></option>
              <?php else: ?>
              <option value="<?php echo ($Type["autoid"]); ?>"><?php echo ($Type["type_name"]); ?></option><?php endif; endforeach; endif; ?>
        </select>
        <span id="news_typespan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td width="12%"  align="right" ><strong>上传图片：</strong></td>
      <td  align="left" colspan="3"><input name="news_image" class="inputtext" type="text" id="news_image" size="80" value="<?php echo ($News["news_image"]); ?>">
        &nbsp;&nbsp;&nbsp;
        <input name="button" type="button" class="uploadimg button"  attrimage="news_image" value="上传图片" />
        <span id="news_imagespan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td width="12%"  align="right" ><strong>文章作者：</strong></td>
      <td  align="left" ><input name="news_author" class="inputtext" type="text" ID="news_author" size="50" value="<?php echo ($News["news_author"]); ?>" >
        <span id="news_authorspan" class="inputspan"></span></td>
      <td width="12%"  align="right" ><strong>文章来源：</strong></td>
      <td  align="left" ><input name="news_source" class="inputtext" type="text" ID="news_source" size="50" value="<?php echo ($News["news_source"]); ?>" >
        <span id="news_sourcespan" class="inputspan"></span></font></td>
    </tr>
    <tr >
      <td width="12%"  align="right" ><strong>文章排序：</strong></td>
      <td  align="left" ><input name="news_sort" class="inputtext" type="text" ID="news_sort" size="5" value="<?php echo ($News["news_sort"]); ?>" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">
        <span id="news_sortspan" class="inputspan">网站前台显示从大到小排列</span></td>
      <td width="12%"  align="right" ><strong>文章点击：</strong></td>
      <td  align="left" ><input name="news_hits" class="inputtext" type="text" ID="news_hits" size="5" value="<?php echo ($News["news_hits"]); ?>" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))">
        <span id="news_hitsspan" class="inputspan">网站前台显示从大到小排列</span></td>
    </tr>
    <tr >
      <td width="12%"  align="right" ><strong>文章标题：</strong></td>
      <td  align="left" colspan="3"><input name="news_title" class="inputtext" type="text" ID="news_title" size="80" value="<?php echo ($News["title"]); ?>" >
        <font color="red"><span id="news_titlespan" class="inputspan"></span></font></td>
    </tr>
    <tr >
      <td width="12%"  align="right" ><strong>文章关键词：</strong></td>
      <td  align="left" colspan="3"><input name="news_keyword" class="inputtext" type="text" ID="news_keyword" size="80" value="<?php echo ($News["keywords"]); ?>">
        <span id="news_keywordspan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td width="12%"  align="right" ><strong>文章描述：</strong></td>
      <td  align="left" colspan="3"><textarea name="news_description" class="inputtext" type="text" ID="news_description" cols="90" rows="3" ><?php echo ($News["description"]); ?></textarea>
        <span id="news_descriptionspan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td width="12%"  align="right" ><strong>详细介绍：</strong></td>
      <td  align="left" colspan="3"><textarea name="content" rows="8" cols="60" style="width:98%;margin-top:5px;"><?php echo ($News["news_content"]); ?></textarea>
        <br>
        <span id="contentspan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td width="12%"  align="right" ><strong>文章状态：</strong></td>
      <td  align="left" colspan="3"><input type="radio" value="0" name="news_status" <?php echo (CheckStr($News["news_status"],0)); ?>>
        隐藏
        <input type="radio" value="1" name="news_status" <?php echo (CheckStr($News["news_status"],1)); ?>>
        显示<span id="news_statusspan" class="inputspan"></span></td>
    </tr>
    <tr >
      <td  align="right">&nbsp;</td>
      <td colspan="3"><input type="hidden" value="<?php echo ($News["autoid"]); ?>" id="autoid" name="autoid">
        <input name="Submit3" type="submit" class="button" value=" 提交 " id="addnew" />
        <input type="button" class="button" value=" 返回 " onClick="window.location.href='/Company/index.php/Manager/Newslist/index'"/></td>
    </tr>
  </table>
</form>
</body>
</html>