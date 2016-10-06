<?php 
require_once '../../library/inc.php';
require_once("comm/config.php");

//QQ登录成功后的回调地址,主要保存access token
qq_callback();
//获取用户标示id
get_openid();
//获取用户基本资料
$url = "https://graph.qq.com/user/get_user_info?oauth_consumer_key=" . $_SESSION["appid"] . "&access_token=" . $_SESSION['access_token'] . "&openid=" . $_SESSION["openid"] . "&format=json";
$user_info = json_decode(file_get_contents($url),true);
if (!empty($user_info['error'])) { die($user_info); }

if ($uid = $db->getOne("SELECT id FROM cms_user WHERE u_exid = '".$_SESSION["openid"]."'")) {
  href(SITE_DIR.'user.php?act=oauth&uid='.$uid);
}else{
  // 写入用户
  $sql = "INSERT INTO cms_user (`id`, `u_exid`, `u_rid`, `u_enable`, `u_name`, `u_psw`, `u_picture`, `u_point`, `u_level`, `u_tname`, `u_email`, `u_mobile`, `u_location`, `u_province`, `u_city`, `u_district`, `u_addr`, `u_infor`, `u_question`, `u_answer`, `u_post`, `u_date`, `u_code`, `u_rec`, `last_login`, `u_isadmin`, `exid_type`) VALUES (NULL, '".$_SESSION["openid"]."', '0', '1', '".$user_info['nickname']."', NULL, '".$user_info['figureurl_2']."', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, NULL, NULL, '".time()."', '', '0', NULL, '0', '2')";
  if($db->query($sql)) {
    $uid = $db->getOne("SELECT id FROM cms_user WHERE u_exid = '".$_SESSION['openid']."'");
    href(SITE_DIR.'user.php?act=oauth&uid='.$uid);
  }else{
    alert_href('用户信息获取失败,请稍后重试！',SITE_DIR);
  }
}

function qq_callback() {
  if ($_REQUEST['state'] == $_SESSION['state']) {
    $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&" . "client_id=" . $_SESSION["appid"]. "&redirect_uri=" . urlencode($_SESSION["callback"]) . "&client_secret=" . $_SESSION["appkey"]. "&code=" . $_REQUEST["code"];
    $response = file_get_contents($token_url);
    if (strpos($response, "callback") !== false) {
      $lpos = strpos($response, "(");
      $rpos = strrpos($response, ")");
      $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
      $msg = json_decode($response);
      if (isset($msg->error)) {
        echo "<h3>error:</h3>" . $msg->error;
        echo "<h3>msg  :</h3>" . $msg->error_description;
        exit;
      }
    }

    $params = array();
    parse_str($response, $params);

    //set access token to session
    $_SESSION["access_token"] = $params["access_token"];
  } else {
    echo("The state does not match. You may be a victim of CSRF.");
  }
}

function get_openid() {
  $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=" . $_SESSION['access_token'];

  $str  = file_get_contents($graph_url);
  if (strpos($str, "callback") !== false) {
    $lpos = strpos($str, "(");
    $rpos = strrpos($str, ")");
    $str  = substr($str, $lpos + 1, $rpos - $lpos -1);
  }

  $user = json_decode($str);
  if (isset($user->error)) {
    echo "<h3>error:</h3>" . $user->error;
    echo "<h3>msg  :</h3>" . $user->error_description;
    exit;
  }

  //set openid to session
  $_SESSION["openid"] = $user->openid;
}
?>
