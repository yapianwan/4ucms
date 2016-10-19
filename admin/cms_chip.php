<?php
$privilege = 'chip';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $res = $db->getRow("SELECT * FROM cms_chip WHERE id = " . $_GET['del']);
  if ($res['c_safe']) {
    alert_back('已受保护,无法删除！');
  }
  $sql = "DELETE FROM cms_chip WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('碎片删除',$_COOKIE['admin_id']);
    alert_href('删除成功!','cms_chip.php');
  } else {
    alert_back('删除失败！');
  }
}
if (isset($_POST['submit'])) {
  $c_name = $_POST['c_name'];
  $c_code = $_POST['c_code'];
  $c_content = $_POST['c_content'];
  $c_safe = $_POST['c_safe'];
  null_back($c_name,'请填写碎片名称！');
  $sql = "INSERT INTO cms_chip (c_code,c_name,c_content,c_safe) VALUES ('" . $c_code . "','" . $c_name . "','" . $c_content . "'," . $c_safe . ")";
  if ($db->query($sql)) {
    alert_href('新增成功!', page_back());
  } else {
    alert_back('新增失败!');
  }
}

$res = $db->getAll("SELECT * FROM cms_chip ORDER BY id DESC");
foreach ($res as $key=>$val) {
  $res[$key]['edit_url'] = 'cms_chip_edit.php?id=' . $val['id'];
  $res[$key]['del_url'] = 'cms_chip.php?del=' . $val['id'];
}
$tpl->assign('res', $res);
$tpl->display(tpl());