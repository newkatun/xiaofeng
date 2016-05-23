<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link href="/Company/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="/Company/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="/Company/Public/js/common.js"></script>
<script language="javascript" type="text/javascript" src="/Company/Public/js/manager/use.js"></script>
<script language="javascript" type="text/javascript" src="/Company/Public/js/manager/newslist.js"></script>
</head>
<body>
<table width="100%" border="1" cellpadding="0" cellspacing="1"  >
  <tr>
    <td class="table_top" >文章列表<span class="table_spanadd"><a href="/Company/index.php/Manager/Newslist/addtable">增加文章</a></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" class="table_search" align="center">
        <tr class="search">
          <td  ></td>
          <form action="/Company/index.php/Manager/Newslist" name="formsearch" method="get">
            <td align="right">输入关键词：
              <input name="keyword" type="text" id="keyword" value="" class="inputtext" size="36"  />
              &nbsp;
              <input  type="submit" id="search" value="搜索" class="rb1"  /></td>
          </form>
        </tr>
      </table></td>
  </tr>
  <tr >
    <td ><table width="100%" border="1" cellpadding="0" cellspacing="1" class="table_cont">
        <tr  class="table_title">
          <td width="5%" >选择</td>
          <td  >文章名称 </td>
          <td width="40%" >文章标题</td>
          <td width="10%" >发布时间</td>
          <td width="8%" >文章状态</td>
          <td width="10%" >查看|修改</td>
        </tr>
        <?php if(isset($NewsList) == true): ?><form action="/Company/index.php/Manager/Newslist/dellist" method="post" name="formlist" id="formlist">
            <?php if(is_array($NewsList)): foreach($NewsList as $key=>$News): ?><tr class="table_trcont">
                <td height='30' align='center'><input name='id[]' type='checkbox'  value='<?php echo ($News["autoid"]); ?>'   /></td>
                <td >&nbsp;<?php echo ($News["news_name"]); ?></td>
                <td>&nbsp;<?php echo ($News["news_title"]); ?></td>
                <td align='center'><?php echo (TimeShort($News["datetimes"])); ?></td>
                <td align="center">&nbsp;<?php echo (ProdStatus($News["news_status"])); ?></td>
                <td align='center'><a href="/Company/index.php/Manager/Newslist/edittable/id/<?php echo ($News["autoid"]); ?>">修改</a></td>
              </tr><?php endforeach; endif; ?>
            <tr class="table_tr_btn">
              <td height="30" colspan="4">&nbsp;&nbsp;
                <input  type="button" class="button selectall"  value="全选" />
                <input name="button" type="button" class="button selectOther"  value="反选" />
                <input name="reset" type="reset" class="button unselectall" value="全取消" /></td>
              <td width="10%" align="center"><input  type="submit" class="button" value="上线" id="ProdUpOnline"/>
                &nbsp;
                <input type="submit" class="button" value="下线" id="ProdDownline" /></td>
              <td width="10%" align="center"><input name="Submit3" type="submit" class="button" value="删除选中内容" onClick="return confirm('您确定要删除吗？删除后将无法恢复，请谨慎操作！');" /></td>
            </tr>
          </form>
          <?php if(isset($PageContent) == true): ?><tr class="table_tr_page">
              <td height="30" colspan="6" ><table border="0" align="center" width="100%" class="pagetable" >
                  <form action="" method="get" name="form">
                    <TR>
                      <TD align="center"><div class="page"><?php echo ($PageContent); ?></div></TD>
                    </TR>
                  </form>
                </table></td>
            </tr><?php endif; ?>
          <?php else: ?>
          <tr>
            <td height="30" colspan="6" >没有找到相关内容！</td>
          </tr><?php endif; ?>
      </table></td>
  </tr>
</table>
</body>
</html>