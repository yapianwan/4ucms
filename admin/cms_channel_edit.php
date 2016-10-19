<?php
$privilege = 'c' . $_GET['id'];
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $c_name = $_POST['c_name'];
  $c_ifpicture = !empty($c_picture) ? 1 : 0;
  $c_picture = $_POST['c_picture'];
  $c_parent = $_POST['c_parent'];
  $c_cmodel = $_POST[LIB_CCMDL];
  $c_dmodel = $_POST[LIB_CDMDL];
  $c_rec = $_POST[LIB_CREC];
  $c_content = $_POST['c_content'];
  $c_scontent = $_POST['c_scontent'];
  $c_page = $_POST['c_page'];
  $c_seoname = $_POST['c_seoname'];
  $c_keywords = $_POST['c_keywords'];
  $c_description = $_POST['c_description'];
  $c_navigation = $_POST[LIB_CNAV];
  $c_nname = $_POST['c_nname'];
  $c_link = $_POST['c_link'];
  $c_sname = $_POST['c_sname'];
  $c_aname = $_POST['c_aname'];
  $c_ifcover = !empty($c_cover) ? 1 : 0;
  $c_cover = $_POST['c_cover'];
  $c_ifslideshow = !empty($c_ifslideshow) ? 1 : 0;
  $c_slideshow = $_POST['c_slideshow'];
  $c_target = $_POST[LIB_CTARGET];
  $c_safe = $_POST[LIB_CSAFE];
  $c_order = $_POST['c_order'];

  null_back($c_name, '请填写频道名称');
  n_back($c_parent, '请选择上级频道');
  null_back($c_cmodel, '请选择或填写频道模型');
  null_back($c_dmodel, '请选择或填写详情模型');
  non_numeric_back($c_page, '分页条数必须是数字');
  non_numeric_back($c_order, '排序必须是数字');
  
  $sql = "UPDATE cms_channel SET c_name='" . $c_name . "',c_ifpicture='" . $c_ifpicture . "',c_picture = '" . $c_picture . "',c_parent='" . $c_parent . "',c_cmodel='" . $c_cmodel . "',c_dmodel='" . $c_dmodel . "',c_rec='" . $c_rec . "',c_content='" . $c_content . "',c_scontent='" . $c_scontent . "',c_page='" . $c_page . "',c_seoname='" . $c_seoname . "',c_keywords='" . $c_keywords . "',c_description='" . $c_description . "',c_navigation='" . $c_navigation . "',c_nname='" . $c_nname . "',c_link='" . $c_link . "',c_sname='" . $c_sname . "',c_aname='" . $c_aname . "',c_ifcover='" . $c_ifcover . "',c_cover='" . $c_cover . "',c_ifslideshow='" . $c_ifslideshow . "',c_slideshow='" . $c_slideshow . "',c_target='" . $c_target . "',c_safe='" . $c_safe . "',c_order='" . $c_order . "' WHERE id= '" . $_GET['id'] . "'";
  if ($db->query($sql)) {
    admin_log('频道编辑', $_COOKIE['admin_id']);
    alert_href('修改成功!', page_back());
  } else {
    alert_back('修改失败!');
  }
}

$res = $db->getRow("SELECT * FROM cms_channel WHERE id = ".$_GET['id']);
$tpl->assign('res', $res);
$tpl->assign('channel_select_list', channel_select_list(0,0,$res['c_parent'],$res['id']));
$tpl->display(tpl());