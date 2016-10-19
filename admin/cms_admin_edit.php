<?php
$privilege = 'all';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $a_role = $_POST['a_role'];
  $a_name = $_POST['a_name'];
  $res = $db->getRow("SELECT * FROM cms_user WHERE u_name = '" . $a_name . "' AND id <> " . $_GET['id']);
  if ($res !== FALSE) {
    alert_back('登录帐号重名');
  }

  $a_tname = $_POST['a_tname'];
  $a_password = $_POST['a_password'];
  $a_cpassword = $_POST['a_cassword'];
  $a_npassword = $db->getOne("SELECT u_psw FROM cms_user WHERE id = " . $_GET['id']);
  if ($a_password == '') {
    $password = $a_npassword;
  } else {
    $password = md5($a_password);
  }

  null_back($a_name,'请填写登录帐号');
  $sql = "UPDATE cms_user SET u_rid=" . $a_role . ",u_name='" . $a_name . "',u_tname='" . $a_tname . "',u_psw='" . $password . "' WHERE id = " . $_GET['id'];
  if ($db->query($sql)) {
    admin_log('管理员编辑', $_COOKIE['admin_id']);
    alert_href('修改成功!', page_back());
  } else {
    alert_back('修改失败!');
  }
}

$tpl->assign('id', $id);
$tpl->assign('user', $db->getRow("SELECT * FROM cms_user WHERE id = ".$id));
$tpl->assign('role', $db->getAll("SELECT * FROM cms_role"));
$tpl->display(tpl());