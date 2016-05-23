<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link href="/Phone/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="/Phone/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/common.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/manager/use.js"></script>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="1" >
  <tr>
    <td class="table_top" >网站页面列表<span class="table_spanadd"><a href="/Phone/index.php/Manager/Pagelist/addtable">增加网站页面</a></span></td>
  </tr>
  <tr >
    <td ><table width="100%" border="1" cellpadding="0" cellspacing="1"   class="table_search" align="center">
        <tr class="search">
          <td ></td>
          <form action="/Phone/index.php/Manager/Pagelist" name="formsearch" method="get">
            <td align="right">输入关键词：
              <input name="keyword" type="text" id="keyword" value="" class="inputtext" size="36"  />
              <input  type="submit" id="search" value="搜索" class="rb1"  /></td>
          </form>
        </tr>
      </table></td>
  </tr>
  <tr >
    <td align="left">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="table_cont">
		<thead>
			<tr class="table_title">
			  <th width="5%" >选择</th>
			  <th width="10%" >页面编号 </th>
			  <th width="15%" >页面名称</th>
			  <th width="40%" >页面标题</th>
			  <th width="10%" >优先级</th>
			  <th width="10%" >添加时间</th>
			  <th width="10%" >修改</th>
			</tr>
		</thead>	
        <?php if(isset($PageList) == true): ?><tbody>
          <form action="/Phone/index.php/Manager/Pagelist/dellist" method="post" name="formlist" id="formlist">
            <?php if(is_array($PageList)): foreach($PageList as $key=>$Page): ?><tr class="table_trcont">
                <td height='30' align='center'><input name='id[]' type='checkbox' id='id' value='<?php echo ($Page["autoid"]); ?>'  /></td>
                <td ><?php echo ($Page["c_code"]); ?></td>
                <td class="td_center"><?php echo ($Page["c_name"]); ?></td>
                <td><?php echo ($Page["title"]); ?></td>
                <td class="td_center"><?php echo ($Page["c_sort"]); ?></td>
                <td class="td_center"><?php echo (TimeFormat($Page["datetimes"])); ?></td>
                <td class="td_center"><a href="/Phone/index.php/Manager/Pagelist/edittable/id/<?php echo ($Page["autoid"]); ?>">修改</a></td>
              </tr><?php endforeach; endif; ?>
            <tr class="table_tr_btn">
              <td height="30" colspan="5">
                <input  type="button" class="button selectall"  value="全选" />
                <input name="button" type="button" class="button selectOther"  value="反选" />
                <input name="reset" type="reset" class="button unselectall" value="全取消" /></td>
              <td width="10%" align="center"></td>
              <td width="10%" align="center"><input name="Submit3" type="submit" class="button" value="删除选中内容" onClick="return confirm('您确定要删除吗？删除后将无法恢复，请谨慎操作！');" /></td>
            </tr>
          </form>
          <?php if(isset($PageContent) == true): ?><tr >
              <td height="30" colspan="7" >
			  <table border="0" align="center" width="100%" class="pagetable" >
                  <form action="" method="get" name="form">
                    <TR>
                      <TD align="center"><div class="page"><?php echo ($PageContent); ?></div></TD>
                    </TR>
                  </form>
                </table></td>
            </tr><?php endif; ?>
          <?php else: ?>
          <tr>
            <td colspan="6" align="center" height="30">没有找到相关内容！</td>
          </tr>
		</tbody><?php endif; ?>
    </table></td>
  </tr>
</table>
</body>
</html>