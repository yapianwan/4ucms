<?php
$privilege = 'member';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $u_rid = isset($_POST[LIB_URID]) ? $_POST[LIB_URID] : '';
  if ($_GET['id']==1) {
    alert_back('该用户为内置用户无法操作!');
  }
  $u_psw = trim($_POST['u_psw']);
  $u_cash = trim($_POST['u_cash']);
  if (!empty($u_psw)) {
    $sql = "UPDATE cms_user SET u_rid='" . $u_rid . "',u_psw='" . md5($u_psw) . "',u_cash=" . $u_cash . " WHERE id = " . $id;
  } else {
    $sql = "UPDATE cms_user SET u_rid='" . $u_rid . "',u_cash=" . $u_cash . " WHERE id = " . $id;
  }
  if ($db->query($sql)) {
    admin_log('会员编辑',$_COOKIE['admin_id']);
    alert_href('修改成功!', page_back());
  } else {
    alert_back('修改失败!');
  }
}


$tpl->assign('res', $db->getRow("SELECT * FROM cms_user WHERE id = " . $id));
$tpl->display(tpl());