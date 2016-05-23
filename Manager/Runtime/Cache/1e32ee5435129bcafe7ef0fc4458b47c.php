<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link href="<?php echo ($WEBNAME); ?>/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/common.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/product.js"></script>
</head>
<body>
<table width="100%" border="1" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED" >
<tr> <td    class="nzcms_table_top" >产品列表<span class="table_spanadd"><a href="__APP__/Productlist/addtable">增加产品</a></span></td></tr>
<tr valign="top">
<td  bgcolor="#FFFFFF">
<table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#abd9fc"  class="table" align="center">
<tr class="search">
<td  style="padding-left:8px;">

</td>
 <td align="right">输入关键词： <input name="keyword" type="text" id="keyword" value="" class="inputtext" size="36"  /> &nbsp;<input name="搜索" type="button" id="search" value="搜索" class="rb1"  /></td></tr>
</table>
</td>
</tr>
 <tr >
 <td align="left" valign="top" bgcolor="#FFFFFF" class="z">
  <table width="100%" border="1" cellpadding="0" cellspacing="1" class="table_cont">
  <form action="__APP__/Productlist/dellist" method="post" name="formlist" id="formlist">
  <tr align="center" class="table_title">
  <td width="5%" class="table_title_td">选择</td>
  <td width="7%" class="table_title_td">产品编号</td>
  <td  class="table_title_td">产品名称</td>
  <td width="15%" class="table_title_td">售价/市场价</td>
  <td width="15%" class="table_title_td">产品类型</td>
  <td width="10%" class="table_title_td">发布时间</td>
  <td width="8%" class="table_title_td">产品状态</td>
  <td width="10%" class="table_title_td">查看|修改</td>
  </tr>
  <?php if(is_array($ProductList)): $i = 0; $__LIST__ = $ProductList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Prod): $mod = ($i % 2 );++$i;?><tr class="table_trcont">
<td height='30' align='center'><input name='id[]' type='checkbox'  value='<?php echo ($Prod["autoid"]); ?>'   /></td>
<td >&nbsp;<?php echo ($Prod["p_id"]); ?></td>
<td>&nbsp;<?php echo ($Prod["p_name"]); ?></td>
<td>&nbsp;<span class="price">$ <?php echo ($Prod["p_price"]); ?></span> / $ <?php echo ($Prod["p_oldprice"]); ?></td>
<td align="center">&nbsp;<a href="__APP__/Productlist/index/mid/<?php echo ($Prod["p_typeid"]); ?>"><?php echo ($Prod["ty_name"]); ?></a></td>
<td align='center'><?php echo (timeformat($Prod["p_datetime"])); ?></td>
<td align="center">&nbsp;<?php echo (prodstatus($Prod["p_status"])); ?></td>
<td align='center'><a href="__APP__/Prodimglist/index/id/<?php echo ($Prod["autoid"]); ?>">产品图</a>&nbsp;|&nbsp;<a href="__APP__/Productlist/edittable/id/<?php echo ($Prod["autoid"]); ?>">修改</a></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>

 <tr class="table_button">
 <td height="30" colspan="6">&nbsp;&nbsp; <input  type="button" class="button selectall"  value="全选" />
 <input name="button" type="button" class="button selectOther"  value="反选" />
 <input name="reset" type="reset" class="button unselectall" value="全取消" />
</td>
 <td width="10%" align="center"><input  type="submit" class="button" value="上线" id="ProdUpOnline"/>&nbsp;<input type="submit" class="button" value="下线" id="ProdDownline" /></td>
 <td width="10%" align="center"><input name="Submit3" type="submit" class="button" value="删除选中内容" onClick="return confirm('您确定要删除吗？删除后将无法恢复，请谨慎操作！');" /></td>
 </tr>
  <tr class="table_button"> 
<td height="30" colspan="8" ><div class="sole_type">产品销售模式：
<select name="soletype" id="soletype">
<option value="0">Normal</option>
<?php if(is_array($SoleType) == true): if(is_array($SoleType)): foreach($SoleType as $key=>$Sole): ?><option value="<?php echo ($Sole["autoid"]); ?>"><?php echo ($Sole["sole_name"]); ?></option><?php endforeach; endif; endif; ?>
</select> <input type="submit" value="更改产品销售状态" id="soletype"/></div></td>
 </tr>
	</form>
	<tr class="table_page"> 
	<td height="30" colspan="8" >
	<table border="0" align="center" width="100%" class="pagetable" >
	<form action="" method="get" name="form">
	<TR>
	<TD align="center"><div class="page"><?php echo ($PageContent); ?></div></TD>
	</TR>
 </form>
	</table>
 </td>
	</tr>   
	</table>
 </td>
	</tr>   
	</table>
</body>
</html>