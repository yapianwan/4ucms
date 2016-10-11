<?php
$c_main = 0;
include './library/inc.php';
include './language/common.php';
$time = time();

if ($act == COM_LGIN) {
  include $t_path . 'login.php';
}

elseif ($act == 'proc_login') {
  compare_back(strtolower($_POST[LIB_VRFC]),$_SESSION[LIB_VRFC],$_lang['vrfcode_faild']);
  $u_email = isset($_POST[LIB_UMAIL]) ? str_safe($_POST[LIB_UMAIL]) : '';
  $u_psw = isset($_POST[LIB_UPSW]) ? md5(trim($_POST[LIB_UPSW])) : '';
  $rem_id = isset($_POST['rem_id']) ? str_safe($_POST['rem_id']) : 1;
  if (strpos($u_email, '@') !== false) {
    $res = $db->getRow(LIB_SLCTUSERWHRUEMAILEQ . $u_email . LIB_ANDUPSWEQ . $u_psw . "'");
  } else {
    $res = $db->getRow("SELECT * FROM cms_user WHERE u_mobile = '" . $u_email . LIB_ANDUPSWEQ . $u_psw . "'");
  }
  if (check_array($res)) {
    setcookie(CMS_USERID, $res['id'], gmtime()+COOKIE_EXPIRE);
    setcookie('cms[user_name]', $res[LIB_UNAME], gmtime()+COOKIE_EXPIRE);
    setcookie('cms[remember]', $rem_id, gmtime()+COOKIE_EXPIRE);
    // 更新登录时间
    $db->query("UPDATE cms_user SET last_login = '" . gmtime() . "' WHERE id = '" . $res['id'] . "'");
    href('./');
  } else {
    alert_back($_lang[COM_LGIN][LIB_NOTMATCH]);
  }
}

elseif ($act == 'ajax_login') {
  if (strtolower($_POST[LIB_VRFC])!=$_SESSION[LIB_VRFC]) {
    $res['err'] = 'y';
    $res['msg'] = $_lang[LIB_VRFCFLD];
    die(json_encode($res));
  }
  $u_email = isset($_POST[LIB_UMAIL]) ? str_safe($_POST[LIB_UMAIL]) : '';
  $u_psw = isset($_POST[LIB_UPSW]) ? md5(trim($_POST[LIB_UPSW])) : '';
  if (strpos($u_email, '@') !== false) {
    $res = $db->getRow(LIB_SLCTUSERWHRUEMAILEQ . $u_email . LIB_ANDUPSWEQ . $u_psw . "'");
  } else {
    $res = $db->getRow("SELECT * FROM cms_user WHERE u_mobile = '" . $u_email . LIB_ANDUPSWEQ . $u_psw . "'");
  }
  if (check_array($res)) {
    setcookie(CMS_USERID, $res['id'], gmtime()+COOKIE_EXPIRE);
    // 更新登录时间
    $db->query("UPDATE cms_user SET last_login = '" . gmtime() . "' WHERE id = '" . $res['id'] . "'");
    $res['err'] = 'n';
    $res['msg'] = $_lang[COM_LGIN][COM_SUC];
  } else {
    $res['err'] = 'y';
    $res['msg'] = $_lang[COM_LGIN][LIB_NOTMATCH];
  }
  die(json_encode($res));
}

elseif ($act == 'reg') {
  include $t_path . 'reg.php';
}

elseif ($act == 'proc_reg') {
  // 注册限制
  if (isset($_SESSION['time'])) {
    if (($time - $_SESSION['time']) <= TIME_OUT) {
      $_SESSION['time'] = $time;
      alert_href($_lang['time_limit'], $_COOKIE['cms']['url_back']);
    }
  }
  // POST验证
  compare_back(strtolower($_POST[LIB_VRFC]),$_SESSION[LIB_VRFC],$_lang['vrfcode_faild']);
  null_back($_POST[LIB_UNAME], '请填写手机号码！');
  null_back($_POST[LIB_UPSW], '请填写密码！');
  null_back($_POST[LIB_UMAIL], '请填写电子邮箱！');
  compare_back($_POST[LIB_UPSW],$_POST['u_cpsw'],'确认密码有误！');
  // 赋值数组
  $arr[LIB_UNAME] = str_safe($_POST[LIB_UNAME]);
  $arr[LIB_UPSW] = md5(trim($_POST[LIB_UPSW]));
  $arr[LIB_UMAIL] = str_safe($_POST[LIB_UMAIL]);
  $arr['u_level'] = 1;
  $arr['u_date'] = gmtime();
  $arr['u_enable'] = $system_user; // 根据系统设置给出生效值
  if ($db->getRow(LIB_SLCTUSERWHRUEMAILEQ . $arr[LIB_UMAIL] . "'")) { // 邮箱是否存在
    alert_back($_lang['reg']['email_existing']);
  } else {
    if ($db->autoExecute('cms_user', $arr, 'INSERT')) {
      $subject = trans_p(MAIL_SYSNAME, $system_name, $_lang['reg'][COM_EM_SUBJ], '');
      $p = array('[user_name]', '[user_password]');
      $v = array(stripslashes($arr[LIB_UNAME]), $_POST[LIB_UPSW]);
      $body = trans_p($p, $v, $_lang['reg'][COM_EM_BODY]);
      smtp_mail($arr[LIB_UMAIL], $subject, $body);
      alert_href($_lang['reg'][COM_SUC], 'user.php?act=login');
    } else {
      alert_href($_lang['reg'][COM_FLD], LIB_INDEX);
    }
  }
}

elseif ($act == 'ajax_reg') {
  // 注册限制
  if (isset($_SESSION['time'])) {
    if (($time - $_SESSION['time']) <= TIME_OUT) {
      $_SESSION['time'] = $time;
      $res['err'] = 'y';
      $res['msg'] = $_lang['time_limit'];
      die(json_encode($res));
    }
  }
  // POST验证
  if (strtolower($_POST[LIB_VRFC])!=$_SESSION[LIB_VRFC]) {
    $res['err'] = 'y';
    $res['msg'] = $_lang[LIB_VRFCFLD];
    die(json_encode($res));
  }
  if ($_POST['u_cpsw']!=$_POST[LIB_UPSW]) {
    $res['err'] = 'y';
    $res['msg'] = '确认密码有误！';
    die(json_encode($res));
  }
  // 赋值数组
  $arr[LIB_UNAME] = str_safe($_POST[LIB_UNAME]);
  $arr[LIB_UPSW] = md5(str_safe($_POST[LIB_UPSW]));
  $arr[LIB_UMAIL] = str_safe($_POST[LIB_UMAIL]);
  foreach ($arr as $val) {
    if (empty($val)) {
      $res['err'] = 'y';
      $res['msg'] = $_lang['msg_failed'];
      die(json_encode($res));
      break;
    }
  }
  $arr['u_level'] = 1;
  $arr['u_date'] = gmtime();
  $arr['u_enable'] = $system_user; // 根据系统设置给出生效值
  if ($db->getRow(LIB_SLCTUSERWHRUEMAILEQ . $arr[LIB_UMAIL] . "'")) { // 邮箱是否存在
    $res['err'] = 'y';
    $res['msg'] = $_lang['reg']['email_existing'];
    die(json_encode($res));
  } else {
    if ($db->autoExecute('cms_user', $arr, 'INSERT')) {
      $subject = trans_p(MAIL_SYSNAME, $system_name, $_lang['reg'][COM_EM_SUBJ], '');
      $p = array('[user_name]', '[user_password]');
      $v = array(stripslashes($arr[LIB_UNAME]), $_POST[LIB_UPSW]);
      $body = trans_p($p, $v, $_lang['reg'][COM_EM_BODY]);
      smtp_mail($arr[LIB_UMAIL], $subject, $body);
      $res['err'] = 'n';
      $res['msg'] = $_lang['reg'][COM_SUC];
    } else {
      $res['err'] = 'y';
      $res['msg'] = $_lang['reg'][COM_FLD];
    }
    die(json_encode($res));
  }
}

elseif ($act == 'psw_find') {
  include $t_path . 'psw_find.php';
}

elseif ($act == 'proc_psw_find') {
  compare_back(strtolower($_POST[LIB_VRFC]),$_SESSION[LIB_VRFC],$_lang['vrfcode_faild']);
  $u_email = str_safe($_POST[LIB_UMAIL]);

  $res = $db->getRow(LIB_SLCTUSERWHRUEMAILEQ . $u_email . "'");
  if (check_array($res)) {
    // 获取随机码
    $randstr = str_rand();
    $db->query("UPDATE cms_user SET u_code = '" . $randstr . "' WHERE u_email = '" . $u_email . "'");
    $p = array('[u_email]', '[randstr]', '[system_domain]');
    $v = array($u_email, $randstr, $system_domain);
    $subject = trans_p(MAIL_SYSNAME, $system_name, $_lang[LIB_RSTPSW][COM_EM_SUBJ],'str');
    $body = trans_p($p, $v, $_lang[LIB_RSTPSW][COM_EM_BODY]);
    if (smtp_mail($u_email, $subject, $body)) {
      alert_href($_lang[LIB_RSTPSW][COM_SUC], LIB_INDEX);
    }
  } else {
    alert_back($_lang[COM_LGIN][LIB_NOTMATCH]);
  }
}

elseif ($act == 'psw_reset') {
  null_back($_GET[LIB_UMAIL], $_lang[COM_ILL]);
  null_back($_GET['rand'], $_lang[COM_ILL]);
  $u_email = str_safe($_POST[LIB_UMAIL]);
  $u_code = str_safe($_POST['rand']);
  // 验证u_code
  $res = $db->getRow(LIB_SLCTUSERWHRUEMAILEQ . $u_email . "' AND u_code = '" . $u_code . "'");
  if (check_array($res)) {
    include $t_path . 'psw_reset.php';
  } else {
    alert_href($_lang[COM_ILL], LIB_INDEX);
  }
}

elseif ($act == 'proc_psw_reset') {
  null_back($_POST[LIB_UPSW], $_lang[LIB_RSTRES][COM_FLD]);
  null_back($_POST[LIB_UMAIL], $_lang[LIB_RSTRES][COM_FLD]);
  $u_psw = md5(trim(str_safe($_POST[LIB_UPSW])));
  $u_email = str_safe($_POST[LIB_UMAIL]);
  if ($db->query("UPDATE cms_user SET u_psw = '" . $u_psw . "' WHERE u_email = '" . $u_email . "' AND u_isadmin = 0")) {
    alert_href($_lang[LIB_RSTRES][COM_SUC], 'user.php?act=login');
  } else {
    alert_href($_lang[LIB_RSTRES][COM_FLD], LIB_INDEX);
  }
}

elseif ($act == 'logout') {
  setcookie(CMS_USERID, '', gmtime() - 1);
  setcookie('cms[user_name]', '', gmtime() - 1);
  href(LIB_INDEX);
}

else {
  alert_href($_lang[COM_ILL], LIB_INDEX);
}