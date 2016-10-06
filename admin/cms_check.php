<?php
header("Content-Type: text/html; charset=utf-8");
// 判断登陆
if(!isset($_COOKIE['admin_name'])) {alert_href('请先登录','cms_login.php');}
// 判断权限
if (!empty($privilege)) {
  $res = $db->getOne("SELECT r.r_priv FROM cms_user AS u INNER JOIN cms_role AS r ON r.id=u.u_rid WHERE u.id = ".$_COOKIE['admin_id']);
  $priv_obj = $res=='all' ? 'all' : explode(',',$res);
  if ($priv_obj != 'all' && in_array($privilege,$priv_obj) == false) {
    alert_back('无操作权限');
  }
}
?>