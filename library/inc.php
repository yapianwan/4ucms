<?php
@session_start();
@header('Content-type: text/html;charset=UTF-8');
@define('SQL_DIR', 'sql');
@define('ADMIN_DIR', 'admin');
@define('EDITOR_DIR', 'editor/php/');
@define('INSTALL_DIR', 'install');
@define('TEMP_DIR', 'temp');
@define('TEXT_ROOT', 'ROOT_PATH');
// root
$arr_url = array('\\'=>'/');
if (strpos(getcwd(), ADMIN_DIR)) {
  $arr_admin = array('/' . ADMIN_DIR=>'');
  @define(TEXT_ROOT, strtr(strtr(getcwd(),$arr_url) . '/',$arr_admin));
  unset($arr_admin);
} elseif (strpos(getcwd(), EDITOR_DIR)) {
  $arr_editor = array('/' . EDITOR_DIR=>'');
  @define(TEXT_ROOT, strtr(strtr(getcwd(),$arr_url) . '/',$arr_editor));
  unset($arr_editor);
} elseif (strpos(getcwd(), INSTALL_DIR)) {
  $arr_install = array('/' . INSTALL_DIR=>'');
  @define(TEXT_ROOT, strtr(strtr(getcwd(),$arr_url) . '/',$arr_install));
  unset($arr_install);
} elseif (strpos(getcwd(), TEMP_DIR)) {
  $arr_temp = array('/' . TEMP_DIR=>'');
  @define(TEXT_ROOT, strtr(strtr(getcwd(),$arr_url) . '/',$arr_temp));
  unset($arr_temp);
} else {
  @define(TEXT_ROOT, strtr(getcwd(),$arr_url) . '/');
}
unset($arr_url);
// 引入文件
include_once ROOT_PATH . '/library/constant.php';
include_once ROOT_PATH . '/config/config.php';
include_once ROOT_PATH . '/config/data.php';
include_once ROOT_PATH . '/library/cls.mysql.php';
include_once ROOT_PATH . '/library/library.php';
// 公共函数库
include_once ROOT_PATH . '/library/function.php';
// 后台函数文件
include_once ROOT_PATH . '/library/lib.user.php';
include_once ROOT_PATH . '/library/lib.time.php';
include ROOT_PATH . '/config/smtp.php';
include_once ROOT_PATH . '/library/cls.smtp.php';
include_once ROOT_PATH . '/library/lib.base.php';

$GLOBALS['db'] = $db = new Mysql(DATA_HOST, DATA_USERNAME, DATA_PASSWORD, DATA_NAME);
//cms_system
$sql = 'SELECT * FROM cms_system WHERE id = 1';
$GLOBALS['cms'] = $cms = $db->getRow($sql);
$system_sidenav = '导航菜单';
$GLOBALS['t_path'] = $t_path = 'templates/' . (!empty($_COOKIE['cms']['template_id']) ? $_COOKIE['cms']['template_id'] : $cms['s_template']) . '/';
// 对用户传入的变量进行转义操作
if (!get_magic_quotes_gpc()) {
  if (!empty($_GET)) {
    $_GET = addslashes_deep($_GET);
  }
  if (!empty($_POST)) {
    $_POST = addslashes_deep($_POST);
  }
  $_COOKIE = addslashes_deep($_COOKIE);
  $_REQUEST = addslashes_deep($_REQUEST);
}
// common
if (!isset($_COOKIE['cms']['user_id'])) {
  $_COOKIE['cms']['user_id'] = 0;
}
if (!isset($_COOKIE['cms']['user_name'])) {
  $_COOKIE['cms']['user_name'] = '';
}
if (!isset($_COOKIE['cms']['remember'])) {
  $_COOKIE['cms']['remember'] = 0;
}
// id
$id = isset($_GET['id']) && $_GET['id'] > 0 ? str_safe($_GET['id']) : 0;
// act
$act = !empty($_POST['act']) ? str_safe($_POST['act']) : (!empty($_GET['act']) ? str_safe($_GET['act']) : '');
// header
if (is_detail()) {
  include ROOT_PATH.'/library/cls.detail.php';
  include ROOT_PATH.'/library/cls.channel.php';

  $objDetail = new Detail($db);
  $detail = $objDetail->getDetail($id);
  $objChannel = new Channel($db);
  $channel = $objChannel->getChannel($detail['d_parent']);

  $title = $detail['d_name'] . '-' . $channel[LIB_CNAME] . '-' . $cms[LIB_SNAME];
  $keywords = !empty($detail['d_keywords']) ? $detail['d_keywords'] : $detail['d_name'];
  $description = !empty($detail[LIB_DDESC]) ? str_cut(str_text($detail[LIB_DDESC],1),220) : str_cut(str_text($cms[LIB_SDESC],1),220);
}
elseif (is_channel()) {
  include ROOT_PATH . '/library/cls.channel.php';

  $objChannel = new Channel($db);
  $channel = $objChannel->getChannel($id);

  $title = $channel[LIB_CNAME] . '-' . $cms[LIB_SNAME];
  $keywords = !empty($channel['c_keywords']) ? $channel['c_keywords'] : $channel[LIB_CNAME];
  $description = !empty($channel['c_description']) ? $str_cut(str_text($channel['c_description'],1),220) : str_cut(str_text($cms[LIB_SDESC],1),220);
}
elseif (is_404(@$c_main)) {
  $title = '404 Not Found - ' . $cms[LIB_SNAME];
  $keywords = $cms['s_keywords'];
  $description = str_cut(str_text($cms[LIB_SDESC],1),220);
}
else{
  $title = !empty($cms['s_seoname']) ? $cms[LIB_SNAME] . '-' . $cms['s_seoname'] : $cms[LIB_SNAME];
  $keywords = $cms['s_keywords'];
  $description = str_cut(str_text($cms[LIB_SDESC],1),220);
}