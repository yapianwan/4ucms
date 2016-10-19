<?php
$privilege = 'theme';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $sql = "DELETE FROM cms_template WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('模板删除',$_COOKIE['admin_id']);
    alert_back('删除成功！');
  } else {
    alert_back('删除失败！');
  }
}
if ($act == 'add') {
  $t_name = $_POST['t_name'];
  $t_path = $_POST[LIB_TPATH];
  if (empty($t_name) || empty($t_path)) {
    alert_back('名称或路径不能为空!');
  }
  $sql = "INSERT INTO cms_template (t_name,t_path) VALUES ('" . $t_name . "','" . $t_path . "')";
  if ($db->query($sql)) {
    admin_log('模板新增', $_COOKIE['admin_id']);
    alert_back('新增成功!');
  } else {
    alert_back('新增失败!');
  }
}
if (isset($_GET['path'])) {
  $db->query("UPDATE cms_system SET s_template = '" . $_GET['path'] . "'");
  alert_href('设置成功', page_back());
}

$tpl->assign('cms', $cms);
$tpl->assign('res', $db->getAll("select * from cms_template"));
$tpl->display(tpl());