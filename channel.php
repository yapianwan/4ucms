<?php
include './library/inc.php';
include './language/common.php';

non_numeric_back($id, $_lang['illegal']);
if (get_channel($id,'id') === false) {
  alert_href($_lang['illegal'], './');
}
setcookie('cms[url_back]', get_url());// 返回网址

$c_main = $channel['c_main'];
// 获取相关信息
$channel_slist = channel_slist($channel['c_ifsub'] == 1 ? $channel['id'] : $channel['c_parent'], $channel['id']);
$current_channel_location = current_channel_location($channel['id'], $channel['id']);

// 获取上级信息
$channel_parent = $objChannel->getParent($channel['id']);
$channel_main = $objChannel->getMain($channel['id']);

//读取指定的频道模型
include $t_path . $channel['c_cmodel'];

// 释放资源
unset($objChannel);
unset($channel);
unset($c_main);
unset($channel_slist);
unset($current_channel_location);
unset($channel_parent);