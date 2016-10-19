<?php
$privilege = 'qa';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $_data[LIB_FBASR] = $_POST[LIB_FBASR];
  $_data['f_adate'] = gmtime();
  $_data['f_ok'] = 1;
  $sql = "UPDATE cms_feedback SET " . arr_update($_data) . " WHERE id = " . $id;
  if ($db->query($sql)) {
    alert_href('修改成功!', page_back());
  } else {
    alert_back('修改失败!');
  }
}

$tpl->assign('res', $db->getRow("SELECT * FROM cms_feedback WHERE id = " . $id));
$tpl->display(tpl());