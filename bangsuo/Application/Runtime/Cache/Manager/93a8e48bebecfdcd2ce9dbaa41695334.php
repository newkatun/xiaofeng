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
    <td    class="table_top" ><a href="/Phone/index.php/Manager/Category/index">产品类型列表</a>&gt;&gt;<?php echo ($CateMain["ty_name"]); ?><span class="table_spanadd"><a href="/Phone/index.php/Manager/Category/addtable">增加产品类型</a></span></td>
  </tr>
  <tr valign="top">
    <td  ><table width="100%" border="1" cellpadding="0" cellspacing="1" class="table_search" align="center">
        <tr class="search">
          <td  ></td>
          <td align="right">输入关键词：
            <input name="keyword" type="text" id="keyword" value="" class="inputtext" size="36"  />
            &nbsp;
            <input  type="button" id="search" value="搜索" class="rb1"  /></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td ><table width="100%" border="1" cellpadding="0" cellspacing="1" class="table_cont">
        <tr align="center" class="table_title">
          <td width="5%" >选择</td>
          <td width="20%" >类型名称</td>
          <td width="10%" >类型排序</td>
          <td width="10%" >查看|修改</td>
        </tr>
        <?php if(isset($CategoryList) == true): ?><form action="/Phone/index.php/Manager/Category/dellist" method="post" name="formlist" id="formlist">
            <?php if(is_array($CategoryList)): foreach($CategoryList as $key=>$Cate): ?><tr >
                <td height='30' align='center'><input name='id[]' type='checkbox' id='id' value='<?php echo ($Cate["autoid"]); ?>'  /></td>
                <td >&nbsp;<a href="/Phone/index.php/Manager/Category/index/mid/<?php echo ($Cate["autoid"]); ?>"><?php echo ($Cate["ty_name"]); ?></td>
                <td align='center'><?php echo ($Cate["ty_sort"]); ?></td>
                <td align='center'><a href="/Phone/index.php/manager/Productlist/index/sid/<?php echo ($Cate["autoid"]); ?>">查看产品</a>&nbsp;|&nbsp;<a href="/Phone/index.php/Manager/Category/edittable/id/<?php echo ($Cate["autoid"]); ?>">修改</a></td>
              </tr><?php endforeach; endif; ?>
            <tr class="table_tr_btn">
              <td height="30" colspan="3">&nbsp;&nbsp;
                <input  type="button" class="button selectall"  value="全选" />
                <input name="button" type="button" class="button selectOther"  value="反选" />
                <input name="reset" type="reset" class="button unselectall" value="全取消" /></td>
              <td width="10%" align="center"><input name="Submit3" type="submit" class="button" value="删除选中内容" onClick="return confirm('您确定要删除吗？删除后将无法恢复，请谨慎操作！');" /></td>
            </tr>
          </form>
          <?php if(isset($PageContent) == true): ?><tr class="table_page">
              <td height="30" colspan="4" ><table border="0" align="center" width="100%" class="pagetable" >
                  <form action="" method="get" name="form">
                    <tr class="table_page">
                      <TD align="center"><div class="page"><?php echo ($PageContent); ?></div></TD>
                    </TR>
                  </form>
                </table></td>
            </tr><?php endif; ?>
          <?php else: ?>
          <tr >
            <td height="30" colspan="5" align="center"> 没有找到相关内容！ </td>
          </tr><?php endif; ?>
      </table></td>
  </tr>
</table>
</body>
</html>