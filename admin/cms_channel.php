<?php
$privilege = 'channel';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $sql = 'SELECT * FROM cms_channel WHERE id = ' . $_GET['del'];
  $res = $db->getRow($sql);
  if ($res['c_ifsub'] == 0 && $res['c_safe'] == 0) {
    // 频道相关清理
    $c_picture = $db->getOne("SELECT c_picture FROM cms_channel WHERE id = ".$_GET['del']);
    if (!empty($c_picture)) {
      @unlink(substr(ROOT_PATH,0,strlen(ROOT_PATH)-1).$c_picture);
    }
    $c_content = $db->getOne("SELECT c_content FROM cms_channel WHERE id = ".$_GET['del']);
    preg_match_all('/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/', $c_content, $tmparr);
    foreach ($tmparr[1] as $val) {
      @unlink(substr(ROOT_PATH,0,strlen(ROOT_PATH)-1).$val);
    }
    $db->query('DELETE FROM cms_channel WHERE id = ' . $_GET['del']);
    $db->query('DELETE FROM cms_detail WHERE d_parent = ' . $_GET['del']);
    update_channel();
    admin_log('频道删除', $_COOKIE['admin_id']);
    alert_href('删除成功!', page_back());
  } else {
    alert_back('此频道存在下级或已受保护，无法删除！');
  }
}

$tpl->assign('channel_list', channel_list(0,0));
$tpl->display(tpl());