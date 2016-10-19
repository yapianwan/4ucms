<?php
$privilege = 'all';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del']) && $_GET['del'] == 1) {
  alert_back('默认账户不能删除！');
} else {
  if (isset($_GET['del'])) {
    $sql = 'DELETE FROM cms_user WHERE id = ' . $_GET['del'];
    if ($db->query($sql)) {
      admin_log('管理员删除', $_COOKIE['admin_id']);
      alert_href('删除成功!', 'cms_admin.php');
    } else {
      alert_back('删除失败！');
    }
  }
}
if (isset($_POST['submit'])) {
  $a_role = $_POST['a_role'];
  $a_name = $_POST['a_name'];
  $res = $db->getRow("SELECT * FROM cms_user WHERE u_name = '" . $a_name . "'");
  if (is_array($res)) {
    alert_back('登录帐号重名');
  }
  $a_tname = !empty($_POST['a_tname']) ? $_POST['a_tname'] : '';
  $a_password = $_POST['a_password'];
  $a_cpassword = $_POST['a_cassword'];
  null_back($a_name, '请填写登录帐号');
  null_back($a_password, '请填写登录密码');
  $sql = "INSERT INTO cms_user (u_rid,u_enable,u_name,u_tname,u_psw,u_isadmin) VALUES ('" . $a_role . "',1,'" . $a_name . "','" . $a_tname . "','" . md5($a_password) . "',1)";
  if ($db->query($sql)) {
    admin_log('管理员新增', $_COOKIE['admin_id']);
    alert_href('新增成功!', page_back());
  } else {
    alert_back('新增失败!');
  }
}
$user = $db->getAll("SELECT * FROM cms_user WHERE u_isadmin = 1");
foreach ($user as $key=>$val) {
  $user[$key]['edit_url'] = 'cms_admin_edit.php?id=' . $val['id'];
  $user[$key]['del_url'] = 'cms_admin.php?del=' . $val['id'];
}
$tpl->assign('user', $user);
$tpl->assign('role', $db->getAll("SELECT * FROM cms_role"));
$tpl->display(tpl());