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
    <td    class="table_top" >产品列表<span class="table_spanadd"><a href="/Phone/index.php/Manager/Productlist/addtable">增加产品</a></span></td>
  </tr>
  <tr valign="top">
    <td  ><table width="100%" border="1" cellpadding="0" cellspacing="1" class="table_search" align="center">
        <tr class="search">
          <td  >产品类型：
		  <select name="prodtype" id="prodtype">
		  <option value="0">请选择</option>
		  <?php if(is_array($CategoryList)): foreach($CategoryList as $key=>$Cate): if(isset($Mid) == true): ?><option value="<?php echo ($Cate["autoid"]); ?>" <?php echo (SelectChars($Cate["autoid"],$Mid)); ?>><?php echo ($Cate["ty_name"]); ?></option>
		  <?php else: ?>
		  <option value="<?php echo ($Cate["autoid"]); ?>"><?php echo ($Cate["ty_name"]); ?></option><?php endif; endforeach; endif; ?>
		  </select>
		  </td>
          <form action="/Phone/index.php/Manager/Productlist" name="formsearch" method="get">
            <td align="right">输入关键词：
              <input name="keyword" type="text" id="keyword" value="" class="inputtext" size="36"  />
              
              <input  type="submit" id="search" value="搜索" class="rb1 button"  />&nbsp;</td>
          </form>
        </tr>
      </table></td>
  </tr>
  <tr >
    <td ><table width="100%" border="1" cellpadding="0" cellspacing="1" class="table_cont">
        <tr align="center" class="table_title">
          <td width="5%" >选择</td>
          <td width="10%" >产品编号</td>
          <td  >产品名称</td>
          <td width="8%" >点击数</td>
          <td width="8%" >排序</td>
          <td width="8%" >是否发布</td>
          <td width="10%" >发布时间</td>
          <td width="15%" >产品图|修改</td>
        </tr>
        <?php if(isset($ProductList) == true): ?><form action="/Phone/index.php/Manager/Productlist/dellist" method="post" name="formlist" id="formlist">
            <?php if(is_array($ProductList)): foreach($ProductList as $key=>$Prod): ?><tr class="table_trcont">
                <td height='30' align='center'><input name='id[]' type='checkbox'  value='<?php echo ($Prod["autoid"]); ?>'   /></td>
                <td >&nbsp;<?php echo ($Prod["prod_id"]); ?></td>
                <td>&nbsp;<?php echo ($Prod["prod_name"]); ?></td>
                <td align="center">&nbsp;<?php echo ($Prod["prod_hits"]); ?></td>
                <td align="center">&nbsp;<?php echo ($Prod["prod_sort"]); ?></td>
                <td align="center">&nbsp;<?php echo (ProdStatus($Prod["prod_show"])); ?></td>
                <td align='center'><?php echo (TimeFormat($Prod["prod_datetime"])); ?></td>
                <td align='center'><a href="/Phone/manager/Prodimg/index/id/<?php echo ($Prod["autoid"]); ?>">产品图</a>&nbsp;|&nbsp;<a href="/Phone/index.php/Manager/Productlist/edittable/id/<?php echo ($Prod["autoid"]); ?>">修改</a></td>
              </tr><?php endforeach; endif; ?>
            <tr class="table_tr_btn">
              <td height="30" colspan="6">&nbsp;&nbsp;
                <input  type="button" class="button selectall"  value="全选" />
                <input name="button" type="button" class="button selectOther"  value="反选" />
                <input name="reset" type="reset" class="button unselectall" value="全取消" /></td>
              <td width="10%" align="center"><input  type="submit" class="button" value="上线" id="ProdUpOnline"/>
                &nbsp;
                <input type="submit" class="button" value="下线" id="ProdDownline" /></td>
              <td width="10%" align="center"><input name="Submit3" type="submit" class="button" value="删除选中内容" onClick="return confirm('您确定要删除吗？删除后将无法恢复，请谨慎操作！');" /></td>
            </tr>
          </form>
          <?php if(isset($PageContent) == true): ?><tr class="table_page">
              <td height="30" colspan="8" ><table border="0" align="center" width="100%" class="pagetable" >
                  <form action="" method="get" name="form">
                    <TR>
                      <TD align="center"><div class="page"><?php echo ($PageContent); ?></div></TD>
                    </TR>
                  </form>
                </table></td>
            </tr><?php endif; ?>
          <?php else: ?>
          <tr>
            <td colspan="8" align="center" height="30">没有找到相关内容！</td>
          </tr><?php endif; ?>
      </table></td>
  </tr>
</table>
</body>
</html>