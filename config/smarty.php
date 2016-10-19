<?php
// smarty
include_once ROOT_PATH . '/library/smarty-3.1.30/libs/Smarty.class.php';
$tpl = new Smarty();
$tpl->template_dir = ROOT_PATH . 'templates/admin/';
$tpl->compile_dir = ROOT_PATH . 'temp/compile/';
$tpl->cache_dir = ROOT_PATH . 'temp/cache/';
$tpl->left_delimiter = '{?';
$tpl->right_delimiter = '?}';
$tpl->force_compile = false;
$tpl->debugging = false;
$tpl->caching = false;
$tpl->cache_lifetime = SMARTY_TIMEOUT;