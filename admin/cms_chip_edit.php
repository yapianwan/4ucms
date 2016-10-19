<?php
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $c_code = $_POST['c_code'];
  $c_name = $_POST['c_name'];
  $c_content = $_POST['c_content'];
  $c_safe = $_POST[LIB_CSAFE];
  null_back($c_name,'请填写碎片名称！');
  $sql = "UPDATE cms_chip SET c_code='" . $c_code . "',c_name='" . $c_name . "',c_content='" . $c_content . "',c_safe=" . $c_safe . " WHERE id = " . $_GET['id'];
  if ($db->query($sql)) {
    admin_log('碎片编辑',$_COOKIE['admin_id']);
    alert_href('保存成功!','cms_chip.php');
  } else {
    alert_back('保存失败!');
  }
}

$tpl->assign('res', $db->getRow("SELECT * FROM cms_chip WHERE id = " . $id));
$tpl->display(tpl());