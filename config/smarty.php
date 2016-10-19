<?php
// smarty
include_once ROOT_PATH . '/library/smarty-3.1.30/libs/Smarty.class.php';
$tpl = new Smarty();
// 区分前/后模板位置
if (strpos(getcwd(), ADMIN_DIR)) {
  $tpl->template_dir = ROOT_PATH . 'templates/admin/';
  $tpl->caching = false;
} else {
  $tpl->template_dir = ROOT_PATH . 'templates/1/';
  $tpl->caching = true;
}
$tpl->compile_dir = ROOT_PATH . 'temp/compile/';
$tpl->cache_dir = ROOT_PATH . 'temp/cache/';
$tpl->left_delimiter = '{?';
$tpl->right_delimiter = '?}';
$tpl->force_compile = false;
$tpl->debugging = false;
$tpl->cache_lifetime = SMARTY_TIMEOUT;