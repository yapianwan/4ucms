<?php
$c_main = 0;
include './library/inc.php';
include './language/common.php';
// 用户状态
user_state();
// 验证参数
$act = isset($act) && !empty($act) ? $act : 'welcome';
$user_id = $_COOKIE['cms']['user_id'];

if ($act == 'welcome') {
  setcookie('cms[url_back]', get_url());
  $user_infor = $db->getRow("SELECT * FROM cms_user WHERE id = '" . $user_id . "'");
  $user_infor[LIB_UNAME] = stripslashes($user_infor[LIB_UNAME]);
  include $t_path . 'uc_welcome.php';
}

elseif ($act == 'infor') {
  setcookie('cms[url_back]', get_url());
  $user_infor = $db->getRow("SELECT * FROM cms_user WHERE id = '" . $user_id . "'");
  $user_infor[LIB_UNAME] = stripslashes($user_infor[LIB_UNAME]);
  include $t_path . 'uc_infor.php';
}

elseif ($act == 'edit_infor') {
  $arr[LIB_UNAME] = isset($_POST[LIB_UNAME]) ? $_POST[LIB_UNAME] : '';
  $u_psw = iss{et($_POST[LIB_UPSW]) ? $_POST[LIB_UPSW] : '';
  // 判断是否为密码赋值，如没有则不更新该项
  if ($u_psw) { 
    $arr[LIB_UPSW] = md5($u_psw);
  }
  $arr[LIB_UTNAME] = isset($_POST[LIB_UTNAME]) ? $_POST[LIB_UTNAME] : '';
  $arr[LIB_UMOBI] = isset($_POST[LIB_UMOBI]) ? $_POST[LIB_UMOBI] : '';
  $arr[LIB_UPROV] = isset($_POST[LIB_UPROV]) ? $_POST[LIB_UPROV] : '';
  $arr[LIB_UCITY] = isset($_POST[LIB_UCITY]) ? $_POST[LIB_UCITY] : '';
  $arr[LIB_UCOUNTY] = isset($_POST[LIB_UCOUNTY]) ? $_POST[LIB_UCOUNTY] : '';
  $arr[LIB_UADDR] = isset($_POST[LIB_UADDR]) ? $_POST[LIB_UADDR] : '';
  $arr[LIB_UPOST] = isset($_POST[LIB_UPOST]) ? $_POST[LIB_UPOST] : '';
  if ($db->getRow("SELECT * FROM cms_user WHERE u_name = '" . $arr[LIB_UNAME] . "' AND id <> " . $user_id)) {
    alert_back($_lang['reg']['id_existing']);
  } else {
    $set_str = "u_name = '" . $arr[LIB_UNAME] . "'";
  }
  if ($u_psw) {
    $set_str .= ",u_psw = '" . $arr[LIB_UPSW] . "'";
  }
  $set_str .= ",u_tname = '" . $arr[LIB_UTNAME] . "'";
  $set_str .= ",u_mobile = '" . $arr[LIB_UMOBI] . "'";
  $set_str .= ",u_province = '" . $arr[LIB_UPROV] . "'";
  $set_str .= ",u_city = '" . $arr[LIB_UCITY] . "'";
  $set_str .= ",u_county = '" . $arr[LIB_UCOUNTY] . "'";
  $set_str .= ",u_addr = '" . $arr[LIB_UADDR] . "'";
  $set_str .= ",u_post = '" . $arr[LIB_UPOST] . "'";
  if ($db->query("UPDATE cms_user SET " . $set_str . " WHERE id = " . $user_id)) {
    url_back($_lang['uc']['userinfor']['success']);
  } else {
    url_back($_lang['tryagain']);
  }
  unset($arr);
}

else {
  alert_href($_lang['illegal'], 'index.php');
}