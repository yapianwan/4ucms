<?php
//接口信息
$appid = 'wx78a652c69d487cab';
$rurl=urlencode('http://jhd.shgoogleseo.com/oauth/weixin/oauth_response.php');
$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$rurl.'&response_type=code&scope=snsapi_login&state=party#wechat_redirect';
header('location:'.$url);