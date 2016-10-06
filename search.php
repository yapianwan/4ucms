<?php
$c_main = 'search';
include './library/inc.php';
include './language/common.php';

if (!empty($_GET['keyword'])) {
	null_back($_GET['keyword'], $_lang['keyword']);
	$key = str_safe($_GET['keyword']);
}
elseif (!empty($_GET['tag'])) {
	null_back($_GET['tag'], $_lang['keyword']);
	$key = str_safe($_GET['tag']);
}
else{
	alert_back($_lang['keyword']);
}
//读取指定的频道模型
include $t_path . 'search.php';