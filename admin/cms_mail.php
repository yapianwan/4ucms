<?php
$privilege = 'detail';
include '../library/inc.php';
include 'cms_check.php';

$size = !empty($_GET['size']) ? $_GET['size'] : 50;
$tpl->assign('size', $size);
$tpl->assign('pager', page_handle('page', $size, $db->getOne("SELECT COUNT(*) FROM cms_subscribe")));
$tpl->assign('res', $db->getAll("SELECT sub_mail FROM cms_subscribe ORDER BY id DESC LIMIT 0, $size"));
$tpl->display(tpl());