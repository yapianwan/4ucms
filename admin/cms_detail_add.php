<?php
$privilege = 'detail';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $d_name = $_POST['d_name'];
  $d_fname = '';
  $d_picture = $_POST['d_picture'];
  $d_ifpicture = !empty($d_picture) ? 1 : 0;
  $d_parent = $_POST['d_parent'];
  $d_rec = $_POST['d_rec'];
  $d_hot = $_POST['d_hot'];
  $d_price = !empty($_POST['d_price']) ? $_POST['d_price'] : 0;
  $d_ifslideshow = !empty($d_slideshow) ? 1 : 0;
  $d_slideshow = $_POST['d_slideshow'];
  $d_ifvideo = !empty($d_video) ? 1 : 0;
  $d_video = $_POST['d_video'];
  $d_ifattachment = !empty($d_attachment) ? 1 : 0;
  $d_attachment = $_POST['d_attachment'];
  $d_content = $_POST['d_content'];
  $d_scontent = $_POST['d_scontent'];
  $d_source = $_POST['d_source'];
  $d_author = $_POST['d_author'];
  $d_seoname = $_POST['d_seoname'];
  $d_keywords = $_POST['d_keywords'];
  $d_description = $_POST['d_description'];
  $d_link = $_POST['d_link'];
  $d_point = $_POST['d_point'];
  $d_date = local_strtotime($_POST['d_date']);
  $d_order = $_POST['d_order'];
  $d_hits = 1;
  $d_tag = $_POST['d_tag'];

  //判断相关数据
  null_back($d_name,'详情名称不能为空');
  null_back($d_parent,'请选择上级频道');
  non_numeric_back($d_order,'排序必须是数字!');
  if ($d_ifpicture == 1) {
    null_back($d_picture,'请填写图片标题');
  }
  if ($d_ifslideshow == 1) {
    null_back($d_slideshow,'请上传组图');
  }
  if ($d_ifattachment == 1) {
    null_back($d_attachment,'请上传附件');
  }
  if ($d_ifvideo == 1) {
    null_back($d_video,'请填写视频');
  }

  $sql = "INSERT INTO cms_detail (`d_name`,`d_fname`,`d_ifpicture`,`d_picture`,`d_parent`,`d_rec`,`d_hot`,`d_price`,`d_ifslideshow`,`d_slideshow`,`d_content`,`d_scontent`,`d_seoname`,`d_keywords`,`d_description`,`d_link`,`d_order`,`d_source`,`d_author`,`d_hits`,`d_ifvideo`,`d_video`,`d_ifattachment`,`d_attachment`,`d_point`,`d_tag`,`d_date`) VALUES ('" . $d_name . "','" . $d_fname . "'," . $d_ifpicture . ",'" . $d_picture . "'," . $d_parent . "," . $d_rec . "," . $d_hot . "," . $d_price . "," . $d_ifslideshow . ",'" . $d_slideshow . "','" . $d_content . "','" . $d_scontent . "','" . $d_seoname . "','" . $d_keywords . "','" . $d_description . "','" . $d_link . "','" . $d_order . "','" . $d_source . "','" . $d_author . "','" . $d_hits . "','" . $d_ifvideo . "','" . $d_video . "','" . $d_ifattachment . "','" . $d_attachment . "','" . $d_point . "','" . $d_tag . "','" . $d_date . "')";
  if ($db->query($sql)) {
    admin_log('信息新增',$_COOKIE['admin_id']);
    alert_href('新增成功!','cms_detail_add.php');
  } else {
    alert_back('新增失败!');
  }
}

$tpl->assign('channel_select_list', channel_select_list(0,0,0,0));
$tpl->display(tpl());