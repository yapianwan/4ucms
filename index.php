<?php
$c_main = 'index';
//首页引导文件
include './library/inc.php';
include './language/common.php';

setcookie('cms[url_back]', get_url());// 返回网址
// 首页初始值
$current_channel_location = '';
//读取指定的频道模型
include $t_path.'index.php';