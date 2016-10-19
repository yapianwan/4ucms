<?php
$privilege = 'link';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  null_back($_POST[LIB_LNAME],'请填写链接名称');
  non_numeric_back($_POST[LIB_LORDER],'排序必须是数字!');
  $data[LIB_LNAME] = $_POST[LIB_LNAME];
  $data[LIB_LPICTURE] = $_POST[LIB_LPICTURE];
  $data[LIB_LURL] = $_POST[LIB_LURL];
  $data[LIB_LORDER] = $_POST[LIB_LORDER];

  $sql = "UPDATE cms_link SET " . arr_update($data) . " WHERE id = " . $id;
  if ($db->query($sql)) {
    admin_log('链接编辑', $_COOKIE['admin_id']);
    alert_href('保存成功!', page_back());
  } else {
    alert_back('保存失败!');
  }
}

$res = $db->getRow("SELECT * FROM cms_link WHERE id = " . $id);
$tpl->assign('res', $res);
$tpl->display(tpl());