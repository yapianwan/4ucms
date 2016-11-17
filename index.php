<?php
$c_main = 'index';
//首页引导文件
include './library/inc.php';

setcookie('cms[url_back]', get_url());// 返回网址

include $t_path . self_name();