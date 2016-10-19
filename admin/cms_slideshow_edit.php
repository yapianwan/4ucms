<?php
$privilege = 'slideshow';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $s_name = $_POST['s_name'];
  $s_parent = $_POST[LIB_SPARENT];
  $s_picture = $_POST['s_picture'];
  $s_link = $_POST['s_link'];
  $s_order = $_POST['s_order'];

  null_back($s_picture, '图片不能为空');
  non_numeric_back($s_order, '排序必须是数字!');

  $sql = "UPDATE cms_slideshow SET s_name='" . $s_name . "',s_parent='" . $s_parent . "',s_picture='" . $s_picture . "',s_link='" . $s_link . "',s_order=" . $s_order . " WHERE id = $id";
  if ($db->query($sql)) {
    admin_log('幻灯编辑', $_COOKIE['admin_id']);
    alert_href('保存成功!', page_back());
  } else {
    alert_back('保存失败!');
  }
}

$res = $db->getRow("SELECT * FROM cms_slideshow WHERE id = $id");
$tpl->assign('res', $res);
$tpl->assign('channel_select_list', channel_select_list(0,0,$res[LIB_SPARENT],0));
$tpl->display(tpl());