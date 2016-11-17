<?php
include './library/inc.php';

switch (PATH_SEPARATOR) {
  case ';':
    $spt = "\r\n";
    break;
  case ':':
    $spt = "\n";
    break;
  default:
    $spt = "\r";
    break;
}

// subscribe post
if ($act == 'subscribe') {
  $sub_mail = str_safe($_POST['sub-mail']);
    if (check_email($sub_mail)) {
      $arr['sub_mail'] = $sub_mail;
      $arr['sub_date'] = gmtime();
      if ($db->getRow("SELECT * FROM cms_subscribe WHERE sub_mail = '$sub_mail'")) {
        alert_back($_lang['reg']['email_existing']);
      } else {
        $db->autoExecute('cms_subscribe',$arr,LIB_INST);
        alert_back($_lang[LIB_FBACK][COM_SUC]);
      }
    } else {
      alert_back($_lang['reg']['email_error']);
    }
}

elseif ($act == 'feedback_post') {
  $arr[LIB_FBNAME] = !empty($_POST['name']) ? str_safe($_POST['name']) : '';
  $arr[LIB_FBCONT] = !empty($_POST[AJAX_MSG]) ? str_safe($_POST[AJAX_MSG]) : '';
  foreach ($arr as $val) {
    if ($val == '') {
      alert_back($_lang[COM_MSGFLD]);
    }
  }
  $arr[LIB_FBTEL] = !empty($_POST['tel']) ? str_safe($_POST['tel']) : '';
  $arr[LIB_FBTTL] = !empty($_POST[AJAX_SUBJ]) ? str_safe($_POST[AJAX_SUBJ]) : '';
  $arr[LIB_FBMAIL] = !empty($_POST[LIB_EMAIL]) ? str_safe($_POST[LIB_EMAIL]) : '';

  if ($db->autoExecute('cms_feedback',$arr,LIB_INST)) {
    alert_back($_lang[LIB_FBACK][COM_SUC]);
  } else {
    alert_back($_lang[COM_MSGFLD]);
  }
}

// rewrite
elseif ($act == 'rewrite_apache') {
  $str = "RewriteEngine On{$spt}#主域名指向www二级域名{$spt}#RewriteCond %{HTTP_HOST} ^domain.com [NC]{$spt}#RewriteRule ^(.*)$ http://www.domain.com/$1 [L,R=301]{$spt}RewriteBase /{$spt}RewriteRule ^index\.html$ index.php{$spt}RewriteRule ^channel-([0-9]+)\.html$ channel.php?id=$1{$spt}RewriteRule ^channel-([0-9]+)-([0-9]+)\.html$ channel.php?id=$1&page=$2{$spt}RewriteRule ^detail-([0-9]+)\.html$ detail.php?id=$1{$spt}RewriteRule ^user\.html$ user.php{$spt}RewriteRule ^user-(.*)\.html$ user.php?act=$1{$spt}RewriteRule ^user-(.*)-([0-9]+)\.html$ user.php?act=$1&page=$2";
    $fp = fopen(".htaccess","w+");
    fwrite($fp,$str);
    fclose($fp);
    alert_back($_lang[COM_MSGSUC]);
}
elseif ($act == 'rewrite_nginx') {
  $str = "location " . SITE_DIR . " {{$spt}rewrite " . SITE_DIR . "index\.html$ " . SITE_DIR . "index.php;{$spt}rewrite ^" . SITE_DIR . "channel-([0-9]+)\.html$ " . SITE_DIR . "channel.php?id=$1;{$spt}rewrite ^" . SITE_DIR . "channel-([0-9]+)-([0-9]+)\.html$ " . SITE_DIR . "channel.php?id=$1&page=$2;{$spt}rewrite ^" . SITE_DIR . "detail-([0-9]+)\.html$ " . SITE_DIR . "detail.php?id=$1;{$spt}rewrite ^" . SITE_DIR . "user\.html$ " . SITE_DIR . "user.php;{$spt}rewrite ^" . SITE_DIR . "user-(.*)\.html$ " . SITE_DIR . "user.php?act=$1;{$spt}rewrite ^" . SITE_DIR . "user-(.*)-([0-9]+)\.html$ " . SITE_DIR . "user.php?act=$1&page=$2;{$spt}}";
  $fp = fopen(".nginx","w+");
  fwrite($fp,$str);
  fclose($fp);
  alert_back($_lang[COM_MSGSUC]);
}
elseif ($act == 'rewrite_isapi') {
  $str = "[ISAPI_Rewrite]{$spt}# 3600 = 1 hour{$spt}CacheClockRate 3600{$spt}RepeatLimit 32{$spt}# Protext httpd.ini and httpd.parse.errors files{$spt}# from accessing through HTTP{$spt}RewriteRule ^index\.html$ index.php{$spt}RewriteRule ^channel-([0-9]+)\.html$ channel\.php\?id=$1{$spt}RewriteRule ^channel-([0-9]+)-([0-9]+)\.html$ channel\.php\?id=$1&page=$2{$spt}RewriteRule ^detail-([0-9]+)\.html$ detail\.php\?id=$1{$spt}RewriteRule ^user\.html$ user.php{$spt}RewriteRule ^user-(.*)\.html$ user\.php\?act=$1{$spt}RewriteRule ^user-(.*)-([0-9]+)\.html$ user\.php\?act=$1&page=$2";
  $fp = fopen("httpd.ini","w+");
  fwrite($fp,$str);
  fclose($fp);
  alert_back($_lang[COM_MSGSUC]);
}
elseif ($act == 'rewrite_dotnet') {
  $str = '<?xml version="1.0" encoding="UTF-8"?><configuration><system.webServer><rewrite><rules><rule name="index" stopProcessing="true"><match url="^index.html" /><action type="Rewrite" url="index.php" /></rule><rule name="channelp" stopProcessing="true"><match url="^channel-([0-9]+)\.html$" /><action type="Rewrite" url="channel.php?id={R:1}" /></rule><rule name="channelpp" stopProcessing="true"><match url="^channel-([0-9]+)-([0-9]+)\.html$" /><action type="Rewrite" url="channel.php?id={R:1}&amp;page={R:2}" /></rule><rule name="detailp" stopProcessing="true"><match url="^detail-([0-9]+)\.html$" /><action type="Rewrite" url="detail.php?id={R:1}" /></rule><rule name="user" stopProcessing="true"><match url="^user\.html$" /><action type="Rewrite" url="user.php" /></rule><rule name="userp" stopProcessing="true"><match url="^user-(.*)\.html$" /><action type="Rewrite" url="user.php?act={R:1}" /></rule><rule name="userpp" stopProcessing="true"><match url="^user-(.*)-([0-9]+)\.html$" /><action type="Rewrite" url="user.php?act={R:1}&amp;page={R:2}" /></rule></rules></rewrite></system.webServer></configuration>';
  $fp = fopen("web.config","w+");
  fwrite($fp,$str);
  fclose($fp);
  alert_back($_lang[COM_MSGSUC]);
}

else {
  die($_lang['illegal']);
}