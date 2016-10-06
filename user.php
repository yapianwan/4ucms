<?php
$c_main = 0;
include './library/inc.php';
include './language/common.php';
$time = time();

switch ($act) {
  case 'login':
    include $t_path . 'login.php';
    break;

  case 'proc_login':
    compare_back(strtolower($_POST['verifycode']),$_SESSION['verifycode'],'验证码有误！');
    $u_email = isset($_POST['u_email']) ? str_safe($_POST['u_email']) : '';
    $u_psw = isset($_POST['u_psw']) ? md5(trim($_POST['u_psw'])) : '';
    $rem_id = isset($_POST['rem_id']) ? str_safe($_POST['rem_id']) : 1;
    if (strpos($u_email, '@') !== false)
      $res = $db->getRow("SELECT * FROM cms_user WHERE u_email = '" . $u_email . "' AND u_psw = '" . $u_psw . "'");
    else
      $res = $db->getRow("SELECT * FROM cms_user WHERE u_mobile = '" . $u_email . "' AND u_psw = '" . $u_psw . "'");
    if (check_array($res)) {
      setcookie('cms[user_id]', $res['id'], gmtime()+COOKIE_EXPIRE);
      setcookie('cms[user_name]', $res['u_name'], gmtime()+COOKIE_EXPIRE);
      // setcookie('cms[remember]', $rem_id, gmtime()+COOKIE_EXPIRE);
      // 更新登录时间
      $db->query("UPDATE cms_user SET last_login = '" . gmtime() . "' WHERE id = '" . $res['id'] . "'");
      // url_back();
      href('./');
    } else {
      alert_back($_lang['login']['not_match']);
    }
    break;

  case 'ajax_login':
    if (strtolower($_POST['verifycode'])!=$_SESSION['verifycode']) {
      $res['err'] = 'y';
      $res['msg'] = '验证码有误!';
      die(json_encode($res));
    }
    $u_email = isset($_POST['u_email']) ? str_safe($_POST['u_email']) : '';
    $u_psw = isset($_POST['u_psw']) ? md5(trim($_POST['u_psw'])) : '';
    if (strpos($u_email, '@') !== false)
      $res = $db->getRow("SELECT * FROM cms_user WHERE u_email = '" . $u_email . "' AND u_psw = '" . $u_psw . "'");
    else
      $res = $db->getRow("SELECT * FROM cms_user WHERE u_mobile = '" . $u_email . "' AND u_psw = '" . $u_psw . "'");
    if (check_array($res)) {
      setcookie('cms[user_id]', $res['id'], gmtime()+COOKIE_EXPIRE);
      // 更新登录时间
      $db->query("UPDATE cms_user SET last_login = '" . gmtime() . "' WHERE id = '" . $res['id'] . "'");
      $res['err'] = 'n';
      $res['msg'] = $_lang['login']['success'];
    } else {
      $res['err'] = 'y';
      $res['msg'] = $_lang['login']['not_match'];
    }
    die(json_encode($res));
    break;
    
  case 'reg':
    include $t_path . 'reg.php';
    break;

  case 'proc_reg':
    // 注册限制
    if (isset($_SESSION['time'])) {
      if ($time - $_SESSION['time'] <= TIME_OUT) {
        $_SESSION['time'] = $time;
        alert_href($_lang['time_limit'], $_COOKIE['cms']['url_back']);
      }
    }
    // POST验证
    compare_back(strtolower($_POST['verifycode']),$_SESSION['verifycode'],'验证码有误！');
    null_back($_POST['u_name'], '请填写手机号码！');
    null_back($_POST['u_psw'], '请填写密码！');
    null_back($_POST['u_email'], '请填写电子邮箱！');
    compare_back($_POST['u_psw'],$_POST['u_cpsw'],'确认密码有误！');
    // 赋值数组
    $arr['u_name'] = str_safe($_POST['u_name']);
    $arr['u_psw'] = md5(trim($_POST['u_psw']));
    $arr['u_email'] = str_safe($_POST['u_email']);
    // $arr['u_mobile'] = str_safe($_POST['u_mobile']);
    $arr['u_level'] = 1;
    $arr['u_date'] = gmtime();
    $arr['u_enable'] = $system_user; // 根据系统设置给出生效值
    if ($db->getRow("SELECT * FROM cms_user WHERE u_email = '" . $arr['u_email'] . "'")) { // 邮箱是否存在
      alert_back($_lang['reg']['email_existing']);
    } else {
      if ($db->autoExecute('cms_user', $arr, 'INSERT')) {
        $subject = trans_p('[system_name]', $system_name, $_lang['reg']['email_subject'], '');
        $p = array('[user_name]', '[user_password]');
        $v = array(stripslashes($arr['u_name']), $_POST['u_psw']);
        $body = trans_p($p, $v, $_lang['reg']['email_body']);
        smtp_mail($arr['u_email'], $subject, $body);
        alert_href($_lang['reg']['success'], 'user.php?act=login');
      } else {
        alert_href($_lang['reg']['failed'], 'index.php');
      }
    }
    break;

  case 'ajax_reg':
    // 注册限制
    if (isset($_SESSION['time'])) {
      if ($time - $_SESSION['time'] <= TIME_OUT) {
        $_SESSION['time'] = $time;
        $res['err'] = 'y';
        $res['msg'] = $_lang['time_limit'];
        die(json_encode($res));
      }
    }
    // POST验证
    if (strtolower($_POST['verifycode'])!=$_SESSION['verifycode']) {
      $res['err'] = 'y';
      $res['msg'] = '验证码有误!';
      die(json_encode($res));
    }
    if ($_POST['u_cpsw']!=$_POST['u_psw']) {
      $res['err'] = 'y';
      $res['msg'] = '确认密码有误！';
      die(json_encode($res));
    }
    // 赋值数组
    $arr['u_name'] = str_safe($_POST['u_name']);
    $arr['u_psw'] = md5(str_safe($_POST['u_psw']));
    $arr['u_email'] = str_safe($_POST['u_email']);
    // $arr['u_mobile'] = str_safe($_POST['u_mobile']);
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
    if ($db->getRow("SELECT * FROM cms_user WHERE u_email = '" . $arr['u_email'] . "'")) { // 邮箱是否存在
      $res['err'] = 'y';
      $res['msg'] = $_lang['reg']['email_existing'];
      die(json_encode($res));
    } else {
      if ($db->autoExecute('cms_user', $arr, 'INSERT')) {
        $subject = trans_p('[system_name]', $system_name, $_lang['reg']['email_subject'], '');
        $p = array('[user_name]', '[user_password]');
        $v = array(stripslashes($arr['u_name']), $_POST['u_psw']);
        $body = trans_p($p, $v, $_lang['reg']['email_body']);
        smtp_mail($arr['u_email'], $subject, $body);
        $res['err'] = 'n';
        $res['msg'] = $_lang['reg']['success'];
      } else {
        $res['err'] = 'y';
        $res['msg'] = $_lang['reg']['failed'];
      }
      die(json_encode($res));
    }
    break;
  
  case 'psw_find':
    include $t_path . 'psw_find.php';
    break;
  
  case 'proc_psw_find':
    compare_back(strtolower($_POST['verifycode']),$_SESSION['verifycode'],'验证码有误！');
    $u_email = str_safe($_POST['u_email']);

    $res = $db->getRow("SELECT * FROM cms_user WHERE u_email = '" . $u_email . "'");
    if (check_array($res)) {
      // 获取随机码
      $randstr = str_rand();
      $db->query("UPDATE cms_user SET u_code = '" . $randstr . "' WHERE u_email = '" . $u_email . "'");
      $p = array('[u_email]', '[randstr]', '[system_domain]');
      $v = array($u_email, $randstr, $system_domain);
      $subject = trans_p('[system_name]', $system_name, $_lang['reset_password']['email_subject'],'str');
      $body = trans_p($p, $v, $_lang['reset_password']['email_body']);
      if (smtp_mail($u_email, $subject, $body)) {
        alert_href($_lang['reset_password']['success'], 'index.php');
      }
    } else {
      alert_back($_lang['login']['not_match']);
    }
    break;
  
  case 'psw_reset':
    null_back($_GET['u_email'], $_lang['illegal']);
    null_back($_GET['rand'], $_lang['illegal']);
    $u_email = str_safe($_POST['u_email']);
    $u_code = str_safe($_POST['rand']);
    // 验证u_code
    $res = $db->getRow("SELECT * FROM cms_user WHERE u_email = '".$u_email."' AND u_code = '".$u_code."'");
    if (check_array($res))
      include $t_path . 'psw_reset.php';
    else
      alert_href($_lang['illegal'], 'index.php');
    break;
  
  case 'proc_psw_reset':
    null_back($_POST['u_psw'], $_lang['reset_result']['failed']);
    null_back($_POST['u_email'], $_lang['reset_result']['failed']);
    $u_psw = md5(trim(str_safe($_POST['u_psw'])));
    $u_email = str_safe($_POST['u_email']);
    if ($db->query("UPDATE cms_user SET u_psw = '" . $u_psw . "' WHERE u_email = '" . $u_email . "' AND u_isadmin = 0"))
      alert_href($_lang['reset_result']['success'], 'user.php?act=login');
    else
      alert_href($_lang['reset_result']['failed'], 'index.php');
    break;
  
  case 'logout':
    setcookie('cms[user_id]', '', gmtime() - 1);
    setcookie('cms[user_name]', '', gmtime() - 1);
    href('index.php');
    break;
  
  default:
    alert_href($_lang['illegal'], 'index.php');
    break;
}