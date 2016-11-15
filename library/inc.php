<?php
// error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
@session_start();
header('Content-type: text/html;charset=UTF-8');
define('ROOT_PATH', strtr(__DIR__.'/',array('\\'=>'/')));
// 引入文件
include_once ROOT_PATH . './constant.php';
include_once ROOT_PATH . '../config/config.php';
include_once ROOT_PATH . '../config/data.php';
include ROOT_PATH . '../config/smtp.php';
include_once ROOT_PATH . './cls.mysql.php';
include_once ROOT_PATH . './cls.smtp.php';

include_once ROOT_PATH . './lib.base.php';
include_once ROOT_PATH . './lib.admin.php';
include_once ROOT_PATH . './lib.url.php';
include_once ROOT_PATH . './library.php';

include_once ROOT_PATH . './lib.time.php';
include_once ROOT_PATH . './lib.smtp.php';

$GLOBALS['db'] = $db = new Mysql(DATA_HOST, DATA_USERNAME, DATA_PASSWORD, DATA_NAME);

//cms_system
$sql = 'SELECT * FROM cms_system WHERE id = 1';
$cms = $db->getRow($sql);
$GLOBALS['t_path'] = $t_path = 'templates/' . (@$_COOKIE['cms']['template_id'] ?: $cms['s_template']) . '/';

// 对用户传入的变量进行转义操作
if (!get_magic_quotes_gpc()) {
  if (!empty($_GET)) $_GET = addslashes_deep($_GET);
  if (!empty($_POST)) $_POST = addslashes_deep($_POST);
  $_COOKIE = addslashes_deep($_COOKIE);
  $_REQUEST = addslashes_deep($_REQUEST);
}

// common
if (!isset($_COOKIE['cms']['user_id'])) $_COOKIE['cms']['user_id'] = 0;
if (!isset($_COOKIE['cms']['user_name'])) $_COOKIE['cms']['user_name'] = '';
if (!isset($_COOKIE['cms']['remember'])) $_COOKIE['cms']['remember'] = 0;
$id = isset($_GET['id']) && $_GET['id'] > 0 ? str_safe($_GET['id']) : 0;
$act = !empty($_POST['act']) ? str_safe($_POST['act']) : (!empty($_GET['act']) ? str_safe($_GET['act']) : '');

// header
if (is_detail()) {
  include_once ROOT_PATH . './cls.detail.php';
  include_once ROOT_PATH . './cls.channel.php';
  $objDetail = new Detail($db);
  $detail = $objDetail->getDetail($id);
  $objChannel = new Channel($db);
  $channel = $objChannel->getChannel($detail['d_parent']);

  $title = $detail['d_name'] . '-' . $channel[LIB_CNAME] . '-' . $cms[LIB_SNAME];
  $keywords = !empty($detail['d_keywords']) ? $detail['d_keywords'] : $detail['d_name'];
  $description = !empty($detail[LIB_DDESC]) ? str_cut(str_text($detail[LIB_DDESC],1),220) : str_cut(str_text($cms[LIB_SDESC],1),220);
}
elseif(is_channel()) {
  include_once ROOT_PATH . './cls.channel.php';
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