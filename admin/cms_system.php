<?php
$privilege = 'base';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  null_back($_POST[LIB_SDOMAIN], '请填写域名');
  null_back($_POST[LIB_SNAME], '请填写网络名称');

  $arr[LIB_SDOMAIN] = $_POST[LIB_SDOMAIN];
  $arr[LIB_SNAME] = $_POST[LIB_SNAME];
  $arr[LIB_SEON] = $_POST[LIB_SEON];
  $arr[LIB_KEYWORD] = $_POST[LIB_KEYWORD];
  $arr[LIB_SDESC] = $_POST[LIB_SDESC];
  $arr[LIB_SRIGHT] = $_POST[LIB_SRIGHT];
  $arr[LIB_SCODE] = $_POST[LIB_SCODE];
  $arr[LIB_SUSER] = $_POST[LIB_SUSER];
  $arr[LIB_SFB] = $_POST[LIB_SFB];

  $sql = "UPDATE cms_system SET " . arr_update($arr) . " WHERE id = 1";
  if ($db->query($sql)) {
    admin_log('系统设置编辑', $_COOKIE['admin_id']);
    alert_href('设置成功!', page_back());
  } else {
    alert_back('设置失败!');
  }  
}

$tpl->assign('res', $db->getRow("SELECT * FROM cms_system WHERE id = 1"));
$tpl->display(tpl());