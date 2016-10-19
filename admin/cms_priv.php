<?php
$privilege = 'priv';
include '../library/inc.php';
include 'cms_check.php';
include '../language/priv.php';

// 获取管理员权限
$rid = $id;
$res = $GLOBALS['db']->getOne("SELECT r_priv FROM cms_role WHERE id = " . $rid);
$priv = explode(',', $res);

// 更新权限至数据库
if ($act == 'update') {
  foreach ($_POST as $key=>$val) {
    if ($val!='' && $key!='rid' && $key!='act') {
      $arr[$key] = $val;
    }
  }
  $priv = implode(',',$arr); //转为priv字串
  $sql = "UPDATE cms_role SET r_priv = '$priv' WHERE id = ".$_POST['rid'];
  if ($db->query($sql)) {
    admin_log('权限管理', $_COOKIE['admin_id']);
    $admin_id = $db->getOne("SELECT * FROM cms_user WHERE u_rid = " . $_POST['rid']);
      alert_href('操作成功!', '?id='.$_POST['rid']);
  } else {
    alert_back('操作失败!');
  }
}

$tpl->assign('rid', $rid);
$tpl->assign('res', $res);
$tpl->assign('priv', $priv);
$tpl->assign('get_channel_priv', getChannelPriv(0, $rid, $priv));
$tpl->assign('lang_priv', $_lang['priv']['cms']);
$tpl->assign('lang_inrct', $_lang['priv']['interaction']);
$tpl->assign('lang_weixin', $_lang['priv']['weixin']);
$tpl->assign('lang_system', $_lang['priv']['system']);
$tpl->display(tpl());

function getChannelPriv($pid, $rid, $priv) {
  $str = '';
  $res = $GLOBALS['db']->getAll("SELECT * FROM cms_channel WHERE c_parent=".$pid." ORDER BY c_order ASC, id ASC");
  foreach ($res as $val) {
    if ($val['c_ifsub'] || $val['c_parent']==0) {
      if ($val['c_ifsub']==0 && $val['c_parent']==0) {
        $str .= '<table class="am-table am-table-bordered"><tr><th><label for="c' . $val['id'] . PRIV_CHKBNAMEB . $val['id'] . PRIV_IDB . $val['id'] . PRIV_VALB . $val['id'] . '" ' . (in_array("c" . $val['id'],$priv) ? LIB_CHECKED : '') . '>' . $val[LIB_CNAME] . '</label></th><td class="gray">无子频道</td></tr></table>';
      } else {
        $str .= '<table class="am-table am-table-bordered"><tr><th><label for="c' . $val['id'] . PRIV_CHKBNAMEB . $val['id'] . PRIV_IDB . $val['id'] . PRIV_VALB . $val['id'] . '" ' . (in_array("c" . $val['id'],$priv) ? LIB_CHECKED : '') . '>' . $val[LIB_CNAME] . '</label></th><td>' . getChannelPriv($val['id'],$rid,$priv) . '</td></tr></table>';
      }
    } else {
      $str .= '<label for="c' . $val['id'] . PRIV_CHKBNAMEB . $val['id'] . PRIV_IDB . $val['id'] . PRIV_VALB . $val['id'] . '" ' . (in_array("c" . $val['id'],$priv) ? LIB_CHECKED : '') . '>' . $val[LIB_CNAME] . '</label>';
    }
  }
  return $str;
}