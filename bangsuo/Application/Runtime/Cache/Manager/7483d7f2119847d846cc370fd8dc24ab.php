<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<table width="100%" border="1" cellpadding="0" cellspacing="1"  >
  <tr>
    <td    class="table_top" >操作异常<span class="table_spanadd"></td>
  </tr>
  <tr valign="top">
    <td  ><table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF" class="table" align="center">
        <tr class="search">
          <td  >
             <div class="error"><div class="errortext"><p><?php echo ($ErrorCode); ?>
			 <?php if(empty($ReturnUrl) == false): ?>点击<a href="<?php echo ($ReturnUrl); ?>">返回</a>到上一页面。 <meta http-equiv="refresh" content="5; url=<?php echo ($ReturnUrl); ?>" /><?php endif; ?>
			 <p>
			 <p>具体错误信息：<?php echo ($ErrorMsg); ?></p>
			 </div></div>
            </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>