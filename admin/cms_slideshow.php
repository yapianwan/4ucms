<?php
$privilege = 'slideshow';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $sql = "DELETE FROM cms_slideshow WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('幻灯删除', $_COOKIE['admin_id']);
    alert_href('删除成功!', page_back());
  } else {
    alert_back('删除失败！');
  }
}
if (isset($_POST['submit'])) {
  $s_name = $_POST['s_name'];
  $s_parent = $_POST['s_parent'];
  $s_picture = $_POST[LIB_SPIC];
  $s_link = $_POST[LIB_SURL]!='http://' ? $_POST[LIB_SURL] : '';
  $s_order = $_POST['s_order'];
  null_back($s_picture,'图片不能为空');
  non_numeric_back($s_order,'排序必须是数字!');
  $sql = "INSERT INTO cms_slideshow (s_name,s_parent,s_picture,s_link,s_order) VALUES ('" . $s_name . "','" . $s_parent . "','" . $s_picture . "','" . $s_link . "'," . $s_order . ")";
  if ($db->query($sql)) {
    admin_log('幻灯新增', $_COOKIE['admin_id']);
    alert_href('新增成功!', page_back());
  } else {
    alert_back('新增失败!');
  }
}

$tpl->assign('res', $db->getAll("SELECT * FROM cms_slideshow ORDER BY id DESC"));
$tpl->display(tpl());