<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link  href="<?php echo ($WEBNAME); ?>/Public/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($WEBNAME); ?>/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/common.js"></script>

</head>
<body>
<table width="100%" border="1" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED" >
<tr> <td    class="nzcms_table_top" >支付方式列表<span class="table_spanadd"><a href="__APP__/Paymentlist/addtable">增加支付方式</a></span></td></tr>
<tr valign="top">
<td  bgcolor="#FFFFFF">
<table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#abd9fc"  class="table" align="center">
<tr class="search">
<td  style="padding-left:8px;">

</td>
 <td align="right">输入关键词： <input name="keyword" type="text" id="keyword" value="" class="inputtext" size="36"  /> &nbsp;<input name="搜索" type="button" id="search" value="搜索" class="rb1" onclick="searchkey()" /></td></tr>
</table>
</td>
</tr>
 <tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
 <td align="left" valign="top" bgcolor="#FFFFFF" class="z">
  <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C9DEFA">
  <form action="__APP__/Paymentlist/dellist" method="post" name="formlist" id="formlist">
  <tr align="center" bgcolor="#00739e">
  <td width="5%" class="nzcms_table_top2">选择</td>
  <td width="15%" class="nzcms_table_top2">支付方式</td>
  <td width="15%" class="nzcms_table_top2">支付LOGO</td>
    <td width="10%" class="nzcms_table_top2">支付状态</td>
    <td  class="nzcms_table_top2">提示信息</td>
  <td width="10%" class="nzcms_table_top2">修改</td>
  </tr>
	<?php if(is_array($PaymentList) == true): if(is_array($PaymentList)): $i = 0; $__LIST__ = $PaymentList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Payment): $mod = ($i % 2 );++$i;?><tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';" bgcolor="#ffffff">
	<td height='30' align='center'><input name='id[]' type='checkbox' id='id' value='<?php echo ($Payment["autoid"]); ?>' onClick='javascript:changecolor(this.name);'  /></td>
	<td >&nbsp;<?php echo ($Payment["pay_name"]); ?></td>
	<td align="center">&nbsp;<img src="<?php echo ($Payment["pay_logo"]); ?>" width="128" height="48"/></td>
	<td>&nbsp;<?php echo ($Payment["pay_status"]); ?></td>
	<td>&nbsp;<?php echo ($Payment["pay_message"]); ?></td>
	<td align='center'><a href="__APP__/Paymentlist/edittable/id/<?php echo ($Payment["autoid"]); ?>">修改</a></td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	<?php else: ?>
	<tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';"  bgcolor="#FFFFFF">
	<td colspan="6" align="center" height="30">没有找到相关内容！</td>
	</tr><?php endif; ?>
 <tr onMouseOver="this.bgColor='#E4EDF9';" onMouseOut="this.bgColor='#FFFFFF';"  bgcolor="#FFFFFF">
 <td height="30" colspan="5">&nbsp;&nbsp; <input name="button" type="button" class="button" onClick="selectAll(document.formlist)" value="全选本页数据" />
 <input name="button" type="button" class="button" onClick="selectOther(document.formlist)" value="反选" />
 <input name="reset" type="reset" class="button" value="全部取消" />
</td>

 <td width="10%" align="center"><input name="Submit3" type="submit" class="button" value="删除选中内容" onClick="return confirm('您确定要删除吗？删除后将无法恢复，请谨慎操作！');" /></td>
 </tr>
	</form>
	<tr > 
	<td height="30" colspan="6" class="nzcms_table_top">
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