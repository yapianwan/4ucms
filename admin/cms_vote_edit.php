<?php
$privilege = 'vote';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $data[LIB_VNAME] = isset($_POST[LIB_VNAME]) ? $_POST[LIB_VNAME] : '';
  $data[LIB_VSTIME] = isset($_POST[LIB_VSTIME]) ? gmstr2time($_POST[LIB_VSTIME]) : '';
  $data[LIB_VETIME] = isset($_POST[LIB_VETIME]) ? gmstr2time($_POST[LIB_VETIME]) : '';
  $data[LIB_VIFM] = isset($_POST[LIB_VIFM]) ? $_POST[LIB_VIFM] : '';
  $data['v_count'] = 0;
  $str = arr_update($data);
  $sql = "UPDATE cms_vote SET $str WHERE id = $id";
  if ($db->query($sql)) {
    admin_log('投票新增', $_COOKIE['admin_id']);
    alert_href('编辑成功!', page_back());
  } else {
    alert_back('编辑失败!');
  }
}

$tpl->assign('res', $db->getRow("SELECT * FROM cms_vote WHERE id = $id"));
$tpl->display(tpl());