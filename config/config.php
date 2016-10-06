<?php
// 时差
@define('SITE_TOKEN', 'mcmswx');
@define('SITE_DIR', '/mcmswx/');
@define('ADMIN_LOG', false);
// 初始化
$GLOBALS['timezone'] = 8;

// 初始化页面
define('REWRITE', false);
define('PREFIX', 'cms_');
define('TIME_OUT', 5 * 60);
// 定义重复操作最短的允许时间，单位秒
define('COOKIE_EXPIRE', 30 * 24 * 3600);
// cookie超期时间(月*天*日)
// 短网址
define('URL_DWZ', 'http://dwz.cn/create.php');