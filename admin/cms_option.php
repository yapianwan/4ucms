<?php
$privilege = 'link';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $sql = "DELETE FROM cms_vote_option WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('投票项目删除', $_COOKIE['admin_id']);
    alert_back('删除成功!');
  } else {
    alert_back('删除失败！');
  }
}
if (isset($_POST['submit'])) {
  $data['v_id'] = isset($_POST['v_id']) ? $_POST['v_id'] : $id;
  $data[LIB_ONAME] = isset($_POST[LIB_ONAME]) ? $_POST[LIB_ONAME] : '';
  $data['o_count'] = 0;
  $data[LIB_OORDER] = isset($_POST[LIB_OORDER]) ? $_POST[LIB_OORDER] : 100;
  $arr = arr_insert($data);
  $sql = "INSERT INTO cms_vote_option (" . $arr['key'] . ") VALUES (" . $arr['val'] . ")";
  if ($db->query($sql)) {
    admin_log('投票项目新增', $_COOKIE['admin_id']);
    alert_back('新增成功!');
  } else {
    alert_back('新增失败!');
  }
}

$pager = page_handle('page',20,$db->getOne("SELECT COUNT(*) FROM cms_vote_option WHERE v_id = $id"));
$res = $db->getAll("SELECT * FROM cms_vote_option WHERE v_id = $id ORDER BY o_order ASC, id DESC LIMIT " . $pager[0] . "," . $pager[1]);
$tpl->assign('id', $id);
$tpl->assign('pager', $pager);
$tpl->assign('res', $res);
$tpl->display(tpl());