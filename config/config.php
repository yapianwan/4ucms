<?php
// 网站路径信息，如果在根目录请保留"/"，如果在子目录内运行请将“4ucms”修改为您的网站目录名称。
define('SITE_DIR', '/4ucms/');
define('SQL_DIR', 'sql');
define('INSTALL_DIR', 'install');
// 是否开启管理员操作日志
define('ADMIN_LOG', false);
// 时差
$GLOBALS['timezone'] = 8;
// 验证码
define('VERIFYCODE_WIDTH', 150);
define('VERIFYCODE_HEIGHT', 50);
// 初始化页面
define('REWRITE', false);
define('VERIFYCODE_GD', true);
define('TIME_OUT', 5 * 60);
// 定义重复操作最短的允许时间，单位秒
define('COOKIE_EXPIRE', 30 * 24 * 3600);
// cookie超期时间(月*天*日)
// 短网址
define('URL_DWZ', 'http://dwz.cn/create.php');