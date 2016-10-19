<?php
include '../library/inc.php';

if ($act == 'adminLogin') {
  $a_name = str_safe($_POST['a_name']);
  $a_password = str_safe($_POST['a_password']);
  // 次数限制
  $time = time();
  if (!isset($_SESSION[CMS_LOGINCONT])) {
    $_SESSION[CMS_LOGINCONT] = 0;
  }
  if (!isset($_SESSION[CMS_TIMEADMIN])) {
    $_SESSION[CMS_TIMEADMIN] = $time;
  }
  $_SESSION[CMS_LOGINCONT]++;

  if (strtolower($_POST['vercode']) != $_SESSION["verifycode_admin"]) {
    alert_href('验证码错误','cms_login.php');
  }

  if ($_SESSION[CMS_LOGINCONT]>5 && $time - $_SESSION[CMS_TIMEADMIN] <= TIME_OUT ) {
    $_SESSION[CMS_TIMEADMIN] = $time;
    alert_href("短时间内请不要重复操作!", $_COOKIE['cms']['url_back']);
  } elseif ($time - $_SESSION[CMS_TIMEADMIN] > TIME_OUT) {
    $_SESSION[CMS_LOGINCONT] = 0;
  }

  $sql = "SELECT * FROM cms_user WHERE u_name = '" . $a_name . "' AND u_psw = '" . md5($a_password) . "' AND u_isadmin=1";
  $res = $db->getRow($sql);

  if (check_array($res)) {
    setcookie('admin_name', $res['u_name']);
    setcookie(LIB_SAID, $res['id']);
    if (!empty($_COOKIE[LIB_SAID])) {
      admin_log('管理员登陆', $_COOKIE[LIB_SAID]);
    }
    href('index.php?act=welcome');
  } else {
    alert_href('用户名或密码错误', page_back());
  }
}

$tpl->display(tpl());