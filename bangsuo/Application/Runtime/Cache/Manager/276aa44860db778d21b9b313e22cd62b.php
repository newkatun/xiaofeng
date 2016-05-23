<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理员登录</title>
<link href="/Public/css/admin_css.css" type="text/css" rel="stylesheet"/>
<meta http-equiv="refresh" content="3;url=/manager/login"/>
<script language="javascript" type="text/javascript" src="/Public/js/jquery-1.9.0.min.js"></script>
<script language="javascript" type="text/javascript" src="/Public/js/common.js"></script>
<style type="text/css">
<!--
body {
	margin: 0;
	padding:0;
	font-family:Arial, Helvetica, sans-serif;
	background-color: #016aa9;
}
-->
</style>
</head>
<body>
<div class="logincheck">
  <?php if($ErrorCode == 'name' ): ?><div class="checkerror">帐号或密码出现错误，请重新<A href="/index.php/Manager/Login">登录</a>！</div>
    <?php elseif($ErrorCode == 'code' ): ?>
    <div class="checkerror">验证码出现错误，请重新<A href="/index.php/Manager/Login">登录</a>！</div>
    <?php elseif($ErrorCode == 'login' ): ?>
    <div class="checkcontent">正在为您转到后台管理页面，<script>window.location.href='/manager/index';</script></div>
    <?php else: ?>
    <div class="checkerror">核对用户名与密码是否为空，请重新<A href="/index.php/Manager/Login">登录</a>！</div><?php endif; ?>
</div>
</body>
</html>