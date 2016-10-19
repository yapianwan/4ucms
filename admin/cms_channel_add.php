<?php
$privilege = 'channel';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $c_name = $_POST['c_name'];
  $c_ifpicture = !empty($c_picture) ? 1 : 0;
  $c_picture = $_POST['c_picture'];
  $c_parent = $_POST['c_parent'];
  $c_cmodel = $_POST['c_cmodel'];
  $c_dmodel = $_POST['c_dmodel'];
  $c_rec = $_POST['c_rec'];
  $c_content = $_POST['c_content'];
  $c_scontent = $_POST['c_scontent'];
  $c_page = $_POST['c_page'];
  $c_seoname = $_POST['c_seoname'];
  $c_keywords = $_POST['c_keywords'];
  $c_description = $_POST['c_description'];
  $c_navigation = $_POST['c_navigation'];
  $c_nname = $_POST['c_nname'] == '' ? $c_name : $_POST['c_nname'];
  $c_link = $_POST['c_link'];
  $c_sname = $_POST['c_sname'];
  $c_aname = $_POST['c_aname'];
  $c_ifcover = !empty($c_cover) ? 1 : 0;
  $c_cover = $_POST['c_cover'];
  $c_ifslideshow = !empty($c_slideshow) ? 1 : 0;
  $c_slideshow = $_POST['c_slideshow'];
  $c_target = $_POST['c_target'];
  $c_safe = $_POST['c_safe'];
  $c_order = $_POST['c_order'];

  null_back($c_name, '请填写频道名称');
  n_back($c_parent, '请选择上级频道');
  null_back($c_cmodel, '请选择或填写频道模型');
  null_back($c_dmodel, '请选择或填写详情模型');
  non_numeric_back($c_page, '分页条数必须是数字');
  non_numeric_back($c_order, '排序必须是数字');
  
  $sql = "INSERT INTO cms_channel (c_name,c_ifpicture,c_picture,c_parent,c_cmodel,c_dmodel,c_rec,c_content,c_scontent,c_page,c_seoname,c_keywords,c_description,c_navigation,c_nname,c_link,c_sname,c_aname,c_ifcover,c_cover,c_ifslideshow,c_slideshow,c_target,c_safe,c_order) VALUES ('" . $c_name . "','" . $c_ifpicture . "','" . $c_picture . "','" . $c_parent . "','" . $c_cmodel . "','" . $c_dmodel . "','" . $c_rec . "','" . $c_content . "','" . $c_scontent . "','" . $c_page . "','" . $c_seoname . "','" . $c_keywords . "','" . $c_description . "','" . $c_navigation . "','" . $c_nname . "','" . $c_link . "','" . $c_sname . "','" . $c_aname . "','" . $c_ifcover . "','" . $c_cover . "','" . $c_ifslideshow . "','" . $c_slideshow . "','" . $c_target . "','" . $c_safe . "','" . $c_order . "')";
  if ($db->query($sql)) {
    update_channel();
    admin_log('频道新增', $_COOKIE['admin_id']);
    alert_href('新增成功!', page_back());
  } else {
    alert_back('新增失败!');
  }
}

$tpl->assign('channel_select_list', channel_select_list(0,0,0,0));
$tpl->assign('channel_model_select_list', channel_model_select_list());
$tpl->assign('detail_model_select_list', detail_model_select_list());
$tpl->display(tpl());