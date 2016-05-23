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
<tr> <td    class="nzcms_table_top" >订单列表</td></tr>
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
  <form action="__APP__/Orderview/dellist" method="post" name="formlist" id="formlist">
  <tr align="center" class="table_title">
  <td width="5%" class="table_title_td">选择</td>
  <td width="15%" class="table_title_td">订单编号</td>
  <td width="15%"  class="table_title_td">客户名称</td>
  <td width="10%" class="table_title_td">订单总价</td>
  <td width="15%" class="table_title_td">付款状态</td>
  <td width="15%" class="table_title_td">订单状态</td>
  <td width="15%" class="table_title_td">成交时间</td>
  <td width="10%" class="table_title_td">查看</td>
  </tr>
  <?php if(is_array($Orderview)): $i = 0; $__LIST__ = $Orderview;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Order): $mod = ($i % 2 );++$i;?><tr class="table_trcont">
	<td height='30' align='center'><input name='id[]' type='checkbox'  value='<?php echo ($Order["autoid"]); ?>'   /></td>
	<td >&nbsp;<?php echo ($Order["order_id"]); ?></td>
	<td>&nbsp;<a href="javascript:void(0)" attrid="<?php echo ($Order["order_uid"]); ?>"><?php echo ($Order["order_uname"]); ?></a></td>
	<td>&nbsp;<span class="price">$ <?php echo ($Order["order_price"]); ?></span> </td>
	<td align="center">&nbsp;<?php echo ($Order["order_payment"]); ?></td>
	<td align='center'><?php echo ($Order["order_status"]); ?></td>
	<td align="center">&nbsp;<?php echo ($Order["order_datetime"]); ?></td>
	<td align='center'><a href="__APP__/Orderview/edittable/id/<?php echo ($Order["autoid"]); ?>">查看详情</a></td>
 </tr><?php endforeach; endif; else: echo "" ;endif; ?>

 <tr class="table_button">
 <td height="30" colspan="6">&nbsp;&nbsp; <input  type="button" class="button selectall"  value="全选" />
 <input name="button" type="button" class="button selectOther"  value="反选" />
 <input name="reset" type="reset" class="button unselectall" value="全取消" />
</td>
 <td width="10%" align="center"></td>
 <td width="10%" align="center"><input name="Submit3" type="submit" class="button" value="删除选中内容" onClick="return confirm('您确定要删除吗？删除后将无法恢复，请谨慎操作！');" /></td>
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