<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link href="<?php echo ($WEBNAME); ?>/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo ($WEBNAME); ?>/Public/editor/themes/default/default.css" />
<script language="javascript" type="text/javascript" src="<?php echo ($WEBROOT); ?>/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/common.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/product.js"></script>
<script charset="utf-8" src="<?php echo ($WEBNAME); ?>/Public/editor/kindeditor.js"></script>
<script charset="utf-8" src="<?php echo ($WEBNAME); ?>/Public/editor/lang/zh_CN.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo ($WEBNAME); ?>/Public/js/uploadimg.js"></script>
</head>
<body>
<table width="100%" border="1" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#C4D8ED" >
<tr> <td    class="nzcms_table_top" >产品图片<span class="table_spanadd"><a  href="javascript:void(0)" id="addMoreImg">批量增加图片</a></span></td></tr>
 <tr >
 <td align="left" valign="top" bgcolor="#FFFFFF" class="z">
  <table width="100%" border="1" cellpadding="0" cellspacing="1" class="table_image">
  
	<tr>

		<td >
			<div  class="imgtable">
				<?php if(is_array($ImageList)): $i = 0; $__LIST__ = $ImageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Img): $mod = ($i % 2 );++$i;?><ul id="imgUL_<?php echo ($Img["autoid"]); ?>">
						<li><img src="<?php echo ($Img["pi_smaimg"]); ?>" width="160" height="113" id="img_<?php echo ($Img["autoid"]); ?>"/><div class="imgRemove" attrid="<?php echo ($Img["autoid"]); ?>"></div></li>
						<li class="img_name"><?php echo ($Img["pi_prodcode"]); ?></li>
					</ul><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</td>
		
	</tr>

	</form>

	</table>
 </td>
</tr>
 <tr>
 <td align="left" valign="top" bgcolor="#FFFFFF" class="table_imgcont">
 <form action="__APP__/Prodimglist/saveadd" method="post" name="formlist" id="formlist">
  <table width="100%" border="1" cellpadding="0" cellspacing="1" class="table_image">
	<tr><td  class="nzcms_table_top">保存批量插入图片</td></tr>
	<tr >
		<Td> <input type="hidden" value="<?php echo ($ProdID); ?>" name="prodid"/>
			<div id="imgContainer" class="imgtable"></div>
		</td>
	</tr>
	<tr><td  align="right"><input type="submit" value="提交上传图片"/>&nbsp;</td></tr>
  </table>
  </form>
  </td>
	</tr>   
	</table>
</body>
</html>