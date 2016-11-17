<?php
header("Content-Type: text/html; charset=utf-8");
// 判断登陆
if (!isset($_COOKIE['admin_name'])) {
  alert_href('请先登录','cms_login.php');
}
// 判断权限
if (!empty($privilege)) {
  $res = $db->getOne("SELECT r.r_priv FROM cms_user AS u INNER JOIN cms_role AS r ON r.id=u.u_rid WHERE u.id = ".$_COOKIE['admin_id']);
  $cids = 0;
  if ($res=='all') {
    $priv_obj = 'all';
  } else {
    $priv_obj = explode(',', $res);
    if (preg_replace('(,)', '', preg_replace('([a-z]+,?)', '', $res))) {
      $cids = rtrim(preg_replace('([a-z]+,?)', '', $res), ',');
    }
  }
  if ($priv_obj != 'all' && in_array($privilege, $priv_obj) === false) {
    alert_back('无操作权限');
  }
}
?>