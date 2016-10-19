<?php
$privilege = 'qa';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['execute'])) {
  null_back(@$_POST['id'],'请至少选中一项！');
  foreach ($_POST['id'] as $value) {
    $id .= $value . ',';
  }
  $id = rtrim($id, ',');
  switch ($_POST['execute_method']) {
    case 'sok':
      $sql = "UPDATE cms_feedback SET f_ok = 1 WHERE id IN (" . $id . ")";
      break;
    case 'cok':
      $sql = "UPDATE cms_feedback SET f_ok = 0 WHERE id IN (" . $id . ")";
      break;
    case 'delete':
      $sql = "DELETE FROM cms_feedback WHERE id IN (" . $id . ")";
      break;
    default:
      alert_back('请选择要执行的操作');
  }
  $db->query($sql);
  alert_href('执行成功!', page_back());
}

$pager = page_handle('page',10,$db->getOne("SELECT COUNT(*) FROM cms_feedback"));
$res = $db->getAll("SELECT * FROM cms_feedback ORDER BY id DESC LIMIT " . $pager[0] . "," . $pager[1]);
$tpl->assign('pager', $pager);
$tpl->assign('res', $res);
$tpl->display(tpl());