<?php
return array(
	//'配置项'=>'配置值'
	'LANG_SWITCH_ON' => false,	//开启多语言功能
	'LANG_AUTO_DETECT' => false, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST'        => 'uk,zh', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
	'URL_CASE_INSENSITIVE'  => true,
	'DB_TYPE'=>'MYSQL',
	'DB_HOST'=>'localhost',
	'DB_NAME'=>'connie_database',
	'DB_USER'=>'root',
	'DB_PWD'=>'123456',
	'DB_PORT'=>3306,
	'DB_PREFIX'=>'admin_',
	'ALIPAY_ACOUNT'=>'379223599@qq.com',
	'SHIPPING_DEFAULT'=>30.00,
	'OUTPUT_ENCODE'=>  true
);
?>