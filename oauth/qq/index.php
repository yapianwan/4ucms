<?php
require_once("comm/config.php");

function qq_login($appid, $scope, $callback)
{
	//CSRF protection
  $_SESSION['state'] = md5(uniqid(rand(), TRUE));
  $login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" . $appid . "&redirect_uri=" . urlencode($callback) . "&state=" . $_SESSION['state'] . "&scope=".$scope;
  header("Location:$login_url");
}

//登录调用函数
qq_login($_SESSION["appid"], $_SESSION["scope"], $_SESSION["callback"]);
?>
