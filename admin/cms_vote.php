<?php
$privilege = 'vote';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $sql = "DELETE FROM cms_vote WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('投票删除', $_COOKIE['admin_id']);
    alert_href('删除成功!', page_back());
  } else {
    alert_back('删除失败！');
  }
}
if (isset($_POST['submit'])) {
  $data[LIB_VNAME] = isset($_POST[LIB_VNAME]) ? $_POST[LIB_VNAME] : '';
  $data[LIB_VSTIME] = isset($_POST[LIB_VSTIME]) ? gmstr2time($_POST[LIB_VSTIME]) : '';
  $data[LIB_VETIME] = isset($_POST[LIB_VETIME]) ? gmstr2time($_POST[LIB_VETIME]) : '';
  $data[LIB_VIFM] = isset($_POST[LIB_VIFM]) ? $_POST[LIB_VIFM] : '';
  $data['v_count'] = 0;
  if ($db->autoExecute("cms_vote", $data, 'INSERT')) {
    admin_log('投票新增', $_COOKIE['admin_id']);
    alert_href('新增成功!', page_back());
  } else {
    alert_back('新增失败!');
  }
}

$pager = page_handle('page', 20, $db->getOne("SELECT COUNT(*) FROM cms_vote"));
$res = $db->getAll("SELECT * FROM cms_vote ORDER BY id DESC LIMIT " . $pager[0] . "," . $pager[1]);
foreach ($res as $key=>$val) {
  $res[$key]['count'] = $db->getOne("SELECT COUNT(id) FROM cms_vote_option WHERE v_id = " . $val['id']);
  $res[$key]['status'] = gmtime()>=$val[LIB_VETIME] ? '已过期' : '进行中';
}
$tpl->assign('pager', $pager);
$tpl->assign('res', $res);
$tpl->display(tpl());