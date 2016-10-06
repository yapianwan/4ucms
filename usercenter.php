<?php
$c_main = 0;
include './library/inc.php';
include './language/common.php';
// 用户状态
user_state();
// 验证参数
$act = isset($act) && !empty($act) ? $act : 'welcome';

switch ($act) {
  case 'welcome':
    setcookie('cms[url_back]', get_url());
    $user_infor = $db->getRow("SELECT * FROM cms_user WHERE id = '" . $_COOKIE['cms']['user_id'] . "'");
    $user_infor['u_name'] = stripslashes($user_infor['u_name']);
    include $t_path . 'uc_welcome.php';
  break;

  case 'infor':
    setcookie('cms[url_back]', get_url());
    $user_infor = $db->getRow("SELECT * FROM cms_user WHERE id = '" . $_COOKIE['cms']['user_id'] . "'");
    $user_infor['u_name'] = stripslashes($user_infor['u_name']);
    include $t_path . 'uc_infor.php';
  break;

  case 'edit_infor':
    $arr['u_name'] = isset($_POST['u_name']) ? $_POST['u_name'] : '';
    $u_psw = isset($_POST['u_psw']) ? $_POST['u_psw'] : '';
    // 判断是否为密码赋值，如没有则不更新该项
    if ($u_psw) $arr['u_psw'] = md5($u_psw);
    $arr['u_tname'] = isset($_POST['u_tname']) ? $_POST['u_tname'] : '';
    // $arr['u_email'] = isset($_POST['u_email']) ? $_POST['u_email'] : '';
    $arr['u_mobile'] = isset($_POST['u_mobile']) ? $_POST['u_mobile'] : '';
    $arr['u_province'] = isset($_POST['u_province']) ? $_POST['u_province'] : '';
    $arr['u_city'] = isset($_POST['u_city']) ? $_POST['u_city'] : '';
    $arr['u_county'] = isset($_POST['u_county']) ? $_POST['u_county'] : '';
    $arr['u_addr'] = isset($_POST['u_addr']) ? $_POST['u_addr'] : '';
    $arr['u_post'] = isset($_POST['u_post']) ? $_POST['u_post'] : '';
    // $arr['u_question'] = isset($_POST['u_question']) ? $_POST['u_question'] : '';
    // $arr['u_answer'] = isset($_POST['u_answer']) ? $_POST['u_answer'] : '';
    if ($db->getRow("SELECT * FROM cms_user WHERE u_name = '" . $arr['u_name'] . "' AND id <> " . $_COOKIE['cms']['user_id']))
      alert_back($_lang['reg']['id_existing']);
    else
      $set_str = "u_name = '" . $arr['u_name'] . "'";
    if ($u_psw) $set_str .= ",u_psw = '" . $arr['u_psw'] . "'";
    $set_str .= ",u_tname = '" . $arr['u_tname'] . "'";
    $set_str .= ",u_mobile = '" . $arr['u_mobile'] . "'";
    $set_str .= ",u_province = '" . $arr['u_province'] . "'";
    $set_str .= ",u_city = '" . $arr['u_city'] . "'";
    $set_str .= ",u_county = '" . $arr['u_county'] . "'";
    $set_str .= ",u_addr = '" . $arr['u_addr'] . "'";
    $set_str .= ",u_post = '" . $arr['u_post'] . "'";
    // $set_str .= ",u_question = '" . $arr['u_question'] . "'";
    // $set_str .= ",u_answer = '" . $arr['u_answer'] . "'";
    if ($db->query("UPDATE cms_user SET " . $set_str . " WHERE id = " . $_COOKIE['cms']['user_id']))
      url_back($_lang['uc']['userinfor']['success']);
    else
      url_back($_lang['tryagain']);
    unset($arr);
  break;
  
  default:
    alert_href($_lang['illegal'], 'index.php');
  break;
}