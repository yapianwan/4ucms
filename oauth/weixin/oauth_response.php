<?php
include '../../library/inc.php';
$code = $_GET['code'];
$state = $_GET['state'];

if ($state!='party') { die('state参数错误'); }
//换成自己的接口信息
$appid = 'wx78a652c69d487cab';
$appsecret = '40b93bb0062f0210ff520a12e549bec1';
if (empty($code)) { die('授权失败'); }

$token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
$token = json_decode(file_get_contents($token_url),true);
if (isset($token['errcode'])) {
    die('<h1>错误：</h1>'.$token['errcode'].'<br/><h2>错误信息：</h2>'.$token['errmsg']);
}

$access_token_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$appid.'&grant_type=refresh_token&refresh_token='.$token['refresh_token'];
//转成对象
$access_token = json_decode(file_get_contents($access_token_url),true);
if (isset($access_token['errcode'])) {
    die('<h1>错误：</h1>'.$access_token['errcode'].'<br/><h2>错误信息：</h2>'.$access_token['errmsg']);
}

$user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$token['access_token'].'&openid='.$token['openid'].'&lang=zh_CN';
//转成对象
$user_info = json_decode(file_get_contents($user_info_url),true);
if (isset($user_info['errcode'])) {
    die('<h1>错误：</h1>'.$user_info['errcode'].'<br/><h2>错误信息：</h2>'.$user_info['errmsg']);
}

// 获取用户
if ($uid = $db->getOne("SELECT id FROM cms_user WHERE u_exid = '".$user_info['openid']."'")) {
  href(SITE_DIR.'user.php?act=oauth&uid='.$uid);
}else{
  // 写入用户
  $sql = "INSERT INTO cms_user (`id`, `u_exid`, `u_rid`, `u_enable`, `u_name`, `u_psw`, `u_picture`, `u_point`, `u_level`, `u_tname`, `u_email`, `u_mobile`, `u_location`, `u_province`, `u_city`, `u_district`, `u_addr`, `u_infor`, `u_question`, `u_answer`, `u_post`, `u_date`, `u_code`, `u_rec`, `last_login`, `u_isadmin`, `exid_type`) VALUES (NULL, '".$user_info['openid']."', '0', '1', '".$user_info['nickname']."', NULL, '".$user_info['headimgurl']."', '0', NULL, NULL, NULL, NULL, NULL, '".get_region($user_info['province'],1)."', '".get_region($user_info['city'],2)."', '', NULL, '', NULL, NULL, NULL, '".time()."', '', '0', NULL, '0', '1')";
  if($db->query($sql)) {
    $uid = $db->getOne("SELECT id FROM cms_user WHERE u_exid = '".$user_info['openid']."'");
    href(SITE_DIR.'user.php?act=oauth&uid='.$uid);
  }else{
    alert_href('用户信息获取失败,请稍后重试！',SITE_DIR);
  }
}