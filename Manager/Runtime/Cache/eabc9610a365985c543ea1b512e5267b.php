<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link  href="<?php echo ($WEBNAME); ?>/Public/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($WEBNAME); ?>/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/common.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/product.js"></script>
 </head>
 <body>
<table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED" id="1">
<tr> <td    class="nzcms_table_top" >订单基本信息</td></tr>
<tr >
<td align="left" valign="top" bgcolor="#FFFFFF" class="z">
<table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C9DEFA" align="center">
<tr align="center" bgcolor="#ffffff">
<td align="center">订单号：</td>
<td height="30">&nbsp;<?php echo ($Order["order_id"]); ?></td>
<td align="center">订单时间：</td>
<td >&nbsp;<?php echo ($Order["order_datetime"]); ?></td>
<td align="center">收货状态：</td>
<td >&nbsp;<font color="red"><?php echo ($Order["order_status"]); ?></font></td>
</tr>

  <tr align="center" bgcolor="#ffffff">
<td align="center" height="30">付款状态：</td>
<td >&nbsp;<font color="red">&nbsp;<?php echo ($Order["order_payment"]); ?></font></td>
<td align="center">付款方式：</td><td>Paypal</td>
<td >&nbsp;订单运费：</td>
<td >&nbsp;20.00</td>
</tr>
  <tr align="center" bgcolor="#ffffff">
<td align="center" width="150" height="30">订单备注：</td>
<td  align="left" colspan="5">&nbsp;<?php echo ($Order["order_text"]); ?></td>
</tr>
</table>
</td>
</tr>
 <tr >
 <td align="left" valign="top" bgcolor="#FFFFFF" class="z">
  <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C9DEFA" align="center">
  <tr align="center" bgcolor="#C9DEFA">
  <td width="15%" class="nzcms_table_top2">客户邮箱</td>
  <td width="15%" class="nzcms_table_top2">收货人姓名</td>
  <td  class="nzcms_table_top2">收货地址</td>
  <td width="12%" class="nzcms_table_top2">联系方式</td>
  <td width="12%" class="nzcms_table_top2">国家区号</td>
  <td width="12%" class="nzcms_table_top2">邮政编码</td>
  </tr>
 <tr align="center" bgcolor="#FFFFFF">
  <td height="30"><?php echo ($Address["add_gname"]); ?></td>
  <td height="30"><?php echo ($Address["add_lastname"]); ?> <?php echo ($Address["add_firstname"]); ?></td>
  <td ><?php echo ($Address["add_address"]); ?> <?php echo ($Address["add_cityname"]); ?> <?php echo ($Address["add_statename"]); ?> <?php echo ($Address["add_country"]); ?> </td>
  <td ><?php echo ($Address["add_telephone"]); ?> </td>
  <td ><?php echo ($Address["add_countrycode"]); ?> </td>
  <td ><?php echo ($Address["add_zipcode"]); ?> </td>
</tr>
</table>
</td>
</tr>
<tr >
<td >
<table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED" id="1">
<tr >
<td  align="center" colspan="4">
<input name="Submit3" type="reset" class="button" value="返回" onclick="window.history.back();"/></td>
</tr>
</form>
</td>
</tr>
<tr> <td    class="nzcms_table_top" >订单详细信息</td>
</tr>

 <tr >
 <td align="left" valign="top" bgcolor="#FFFFFF" class="z">
  <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C9DEFA" align="center">
  <tr align="center" bgcolor="#C9DEFA">
  <td width="90" class="nzcms_table_top2">商品图片</td>
  <td width="8%" class="nzcms_table_top2">商品编号</td>
  <td class="nzcms_table_top2">商品名称</td>
  <td width="13%" class="nzcms_table_top2">商品价格 </td>
  <td width="10%" class="nzcms_table_top2">订购数量</td>
  <td width="10%" class="nzcms_table_top2">合计</td>
  </tr>

  <?php if(is_array($OrderProdList)): foreach($OrderProdList as $key=>$Prod): ?><tr align="center" bgcolor="#FFFFFF">
  <td height="90"><img src="<?php echo ($Prod["p_img"]); ?>" width="80" height="80"></td>
  <td width="8%" height="40"><?php echo ($Prod["p_id"]); ?></td>
  <td align="left">&nbsp;<?php echo ($Prod["p_name"]); ?> </td>
  <td width="13%"><?php echo ($Prod["prod_orderprice"]); ?></td>
  <td width="10%" ><?php echo ($Prod["prod_number"]); ?></td>
  <td width="10%" ><?php echo ($Prod[prod_orderprice]*$Prod[prod_number]); ?></td>
 </tr><?php endforeach; endif; ?>
</table>
</td>
</tr>


</table>
<br></body>
</html>