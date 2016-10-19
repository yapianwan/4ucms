<?php
$privilege = 'link';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $sql = "DELETE FROM cms_link WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('链接删除', $_COOKIE['admin_id']);
    alert_href('删除成功!', page_back());
  } else {
    alert_back('删除失败！');
  }
}
if (isset($_POST['submit'])) {
  $data[LIB_LNAME] = $_POST[LIB_LNAME];
  $data[LIB_LPICTURE] = $_POST[LIB_LPICTURE];
  $data[LIB_LURL] = $_POST[LIB_LURL];
  $data[LIB_LORDER] = $_POST[LIB_LORDER];
  $str = arr_insert($data);
  $sql = "INSERT INTO cms_link (" . $str['key'] . ") VALUES (" . $str['val'] . ")";
  if ($db->query($sql)) {
    admin_log('链接新增', $_COOKIE['admin_id']);
    alert_href('新增成功!', page_back());
  } else {
    alert_back('新增失败!');
  }
}

$pager = page_handle('page',20,$db->getOne("SELECT COUNT(*) FROM cms_link"));
$res = $db->getAll("SELECT * FROM cms_link ORDER BY id DESC LIMIT " . $pager[0] . "," . $pager[1]);
$tpl->assign('pager', $pager);
$tpl->assign('res', $res);
$tpl->display(tpl());