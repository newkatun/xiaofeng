<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link href="/Phone/Public/css/admin_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="/Phone/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/common.js"></script>
<script language="javascript" type="text/javascript" src="/Phone/Public/js/manager/manager.js"></script>
</head>
<body style="margin:0px;" scroll="no" >
<div>
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:0px;">
    <tr>
      <td colspan="3"  height="60" style="background:#2A4A87;" ><!--头部开始-->
        
        <div class="head">
          <div class="logo"></div>
          <div style=" float:right; margin-top:0px; color:#FFF; margin-right:0px;  height:50px; line-height:80px; overflow:hidden;">
            <div style="float:left; width:80px; text-align:center; "><font color="#FFFFFF"><?php echo ($GUESTNAME); ?>&nbsp;&nbsp;‖</font></div>
            <div style="float:left;width:84px; text-align:center;"><a href="/Phone/manager/login/logout" onClick="return confirm('您确定要退出是吗？');"><font class="white">安全退出</font></a></div>
          </div>
          <div class="menu">
            <ul>
              <li class="two" id="Index" m=1><a href="/Phone/index.php/Manager/Index/main" target="I2"  hidefocus="true">后台首页</a></li>
              <?php if(UserPower($PowerUse,1) >= 0): ?><li class="one" id="Config" m=1><a href="/Phone/manager/productlist" target="I2" hidefocus="true">产品管理</a></li><?php endif; ?>
              <?php if(UserPower($PowerUse,2) >= 0): ?><li class="one" id="Admin" m=1 ><a href="/Phone/manager/userlist" target="I2" hidefocus="true">用户管理</a></li><?php endif; ?>
              <?php if(UserPower($PowerUse,2) >= 0): ?><li class="one" id="News" m=1 ><a href="/Phone/manager/newslist" target="I2" hidefocus="true">文章管理</a></li><?php endif; ?>
              <?php if(UserPower($PowerUse,3) >= 0): ?><li class="one" id="Manage" m=1 ><a href="/Phone/manager/pagelist" target="I2" hidefocus="true">功能管理</a></li><?php endif; ?>
            </ul>
          </div>
        </div>
        
        <!---下部开始--></td>
    </tr>
    <tr>
      <td valign="top" width="200" style="border-right:1px solid #3FB3E3; border-top:1px solid #3FB3E3;border-bottom:1px solid #9FD7FF; background-color:#C9DEFA;" id="td_left" ><div class="left" id="left" >
          <div class="option" id="IndexMenu">
            <div class="title2" m=3  id="IndexMenuS1" style="margin-bottom:0px;">Welcome</div>
            <div m=4 id="IndexMenuS1_1" ><img src="/Phone/Public/mimages/nzcms_ad.jpg"></div>
          </div>
          <div class="option1" id="ConfigMenu">
            <div class="title2" m=3 id="ConfigMenuS1"  style="margin-bottom:0px;">产品管理</div>
            <div m=4 id="ConfigMenuS1_1">
              <ul>
                <li class="list1" m=2 id="ConfigMenuL1"><a href="/Phone/manager/productlist" target="I2">公司产品列表</a></li>
                <li class="list2" m=2 id="ConfigMenuL2"><a href="/Phone/manager/category" target="I2">公司产品类型</a></li>
				<li class="list2" m=2 id="ConfigMenuL4"><a href="/Phone/manager/datarep" target="I2">数据批量替换</a></li>
              </ul>
            </div>
          </div>
          
          <!--用户管理-->
          <div class="option1" id="AdminMenu" >
            <div class="title2" m=3 id="AdminMenuS1"  style="margin-bottom:0px;">网站用户管理</div>
            <div m=4 id="AdminMenuS1_1">
              <ul>
                <li class="list2" m=2 id="AdminMenuL1"><a href="/Phone/manager/userlist" target="I2">网站用户列表</a></li>
                <li class="list2" m=2 id="AdminMenuL3"><a href="/Phone/manager/Feedlist" target="I2">客户留言管理</a></li>
              </ul>
            </div>
          </div>
          <!--文章管理-->
          <div class="option1" id="NewsMenu" >
            <div class="title2" m=3 id="NewsMenuS1"  style="margin-bottom:0px;">网站文章管理</div>
            <div m=4 id="AdminMenuS1_1">
              <ul>
                <li class="list2" m=2 id="NewsMenuL1"><a href="/Phone/manager/Newslist" target="I2">网站文章列表</a></li>
                <li class="list2" m=2 id="NewsMenuL2"><a href="/Phone/manager/Newstypelist" target="I2">文章类型列表</a></li>

              </ul>
            </div>
          </div>
          <!--功能管理-->
          <div class="option1" id="ManageMenu">
            <div class="title2" m=3 id="ManageMenuS1" style="margin-bottom:0px;">功能管理</div>
            <div m=4 id="ManageMenuS1_1" >
              <ul>
                <li class="list2"  m=2 id="ManageMenuL1"><a href="/Phone/manager/Pagelist" target="I2">中文页面管理</a></li>
                <li class="list2"  m=2 id="ManageMenuL3"><a href="/Phone/manager/releaselist" target="I2">宣传广告管理</a></li>
              </ul>
            </div>
          </div>
        </div></td>
      <td width="10" style=" background:#9FD7FF;"><div class="line" id="line"></div></td>
      <td width="100%" height="100%" valign="top" ><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td ><iframe src="/Phone/index.php/Manager/Index/main" name="I2" width="100%"  height="100%" scrolling="yes" frameborder="0"></iframe></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="3"  height="2" style="background-color: #D1E2F9;" ></td>
    </tr>
  </table>
</div>
</body>
</html>