<?php
$privilege = 'detail';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['execute'])) {
  null_back(@$_POST['id'],'请至少选中一项！');
  foreach ($_POST['id'] as $value) {
    $id .= $value . ',';
  }
  $id = rtrim($id, ',');
  switch ($_POST['execute_method']){
    case 'srec':
      $sql = "UPDATE cms_detail SET d_rec = 1 WHERE id in (" . $id . ")";
      break;
    case 'crec':
      $sql = "UPDATE cms_detail SET d_rec = 0 WHERE id in (" . $id . ")";
      break;
    case 'shot':
      $sql = "UPDATE cms_detail SET d_hot = 1 WHERE id in (" . $id . ")";
      break;
    case 'chot':
      $sql = "UPDATE cms_detail SET d_hot = 0 WHERE id in (" . $id . ")";
      break;
    case 'delete':
      $sql = "DELETE FROM cms_detail WHERE id IN (" . $id . ")";
      admin_log('批量信息删除',$_COOKIE['admin_id']);
      break;
    default:
      alert_back('请选择要执行的操作');
  }
  $db->query($sql);
  alert_href('执行成功!','?cid=0');
}
if ( isset($_POST['shift']) ) {
  null_back($_POST['id'],'请至少选中一项！');
  $s = '';
  foreach ($_POST['id'] as $value) {
    $id .= $s . $value;
    $s = ',';
  }
  null_back($_POST['shift_target'],'请选择要转移到的频道');
  $db->query("UPDATE cms_detail SET d_parent = " . $_POST['shift_target'] . " WHERE id IN (" . $id . ")");
  admin_log('信息转移',$_COOKIE['admin_id']);
  alert_href('转移成功!','?cid=0');
}

if (isset($_GET['cid'])) {
  if ($_GET['cid'] != 0){
    $pager = page_handle('page',20,mysql_num_rows(mysql_query("SELECT * FROM cms_detail WHERE d_parent IN (" . get_channel($_GET['cid'],'c_sub') . ")")));
    $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN (" . get_channel($_GET['cid'],'c_sub') . ") ORDER BY id DESC LIMIT " . $pager[0] . "," . $pager[1]);
  }else{
    $pager = page_handle('page',20,mysql_num_rows(mysql_query("SELECT * FROM cms_detail")));
    $res = $db->getAll("SELECT * FROM cms_detail ORDER BY id DESC LIMIT " . $pager[0] . "," . $pager[1]);
  }
}
if (isset($_GET['search'])) {
  $pager = page_handle('page',20,mysql_num_rows(mysql_query("SELECT * FROM cms_detail WHERE d_name LIKE '%" . $_GET['key'] . "%'")));
  $res = $db->getAll("SELECT * FROM cms_detail WHERE d_name LIKE '%" . $_GET['key'] . "%' limit " . $pager[0] . "," . $pager[1]);
}
$tpl->assign('channel_select_list_id', channel_select_list(0,0,$id,0));
$tpl->assign('channel_select_list', channel_select_list(0,0,0,0));
$tpl->assign('pager', $pager);
$tpl->assign('res', $res);
$tpl->display(tpl());