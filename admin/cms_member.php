<?php
$privilege = 'member';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $sql = "DELETE FROM cms_user WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('会员删除',$_COOKIE['admin_id']);
    alert_href('删除成功!', page_back());
  } else {
    alert_back('删除失败！');
  }  
}

$pager = page_handle('page',20,$db->getOne("SELECT COUNT(*) FROM cms_user WHERE u_isadmin = 0"));
$tpl->assign('pager', $pager);
$tpl->assign('res', $db->getAll("SELECT * FROM cms_user WHERE u_isadmin = 0 ORDER BY id DESC LIMIT " . $pager[0] . "," . $pager[1]));
$tpl->display(tpl());