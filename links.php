<?php
$c_main = 0;
//首页引导文件
include './library/inc.php';
include './language/common.php';

setcookie('cms[url_back]', get_url());// 返回网址
// 显示模板
include $t_path . "links.php";