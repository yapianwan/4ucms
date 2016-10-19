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
  $d_rec = $_POST[LIB_DREC];
  $d_hot = $_POST[LIB_DHOT];
  $d_price = $_POST['d_price'];
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
  $d_tag = $_POST['d_tag'];

  null_back($d_name,'详情名称不能为空');
  non_numeric_back($d_order,'排序必须是数字!');

  $sql = "UPDATE cms_detail SET d_name='" . $d_name . "',d_fname='" . $d_fname . "',d_ifpicture=" . $d_ifpicture . ",d_picture = '" . $d_picture . "',d_parent=" . $d_parent . ",d_rec=" . $d_rec . ",d_hot=" . $d_hot . ",d_price=" . $d_price . ",d_ifslideshow=" . $d_ifslideshow . ",d_slideshow='" . $d_slideshow . "',d_content='" . $d_content . "',d_scontent='" . $d_scontent . "',d_seoname='" . $d_seoname . "',d_keywords='" . $d_keywords . "',d_description='" . $d_description . "',d_link='" . $d_link . "',d_order=" . $d_order . ",d_source='" . $d_source . "',d_author='" . $d_author . "',d_ifvideo=" . $d_ifvideo . ",d_video='" . $d_video . "',d_ifattachment=" . $d_ifattachment . ",d_attachment='" . $d_attachment . "',d_point='" . $d_point . "',d_tag='" . $d_tag . "',d_date='" . $d_date . "' WHERE id = " . $_GET['id'];
  if ($db->query($sql)) {
    admin_log('信息编辑',$_COOKIE['admin_id']);
    alert_href('修改成功!','cms_detail.php?cid=0');
  } else {
    alert_back('修改失败!');
  }
}

$res = $db->getRow("SELECT * FROM cms_detail WHERE id = ".$_GET['id']);
$tpl->assign('channel_select_list', channel_select_list(0,0,$res['d_parent'],0));
$tpl->assign('res', $res);
$tpl->display(tpl());