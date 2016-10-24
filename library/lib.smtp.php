<?php
//smtp邮件发送
function smtp_mail($mailto, $subject, $body) {
  // smtp主体部分
  $smtpserver = SMTP_SERVER;
  //SMTP服务器
  $smtpserverport = 25;
  //SMTP服务器端口
  $smtpusermail = SMTP_EMAIL;
  //SMTP服务器的用户邮箱
  $smtpemailto = isset($mailto) && !empty($mailto) ? $mailto : 'shadowwing@163.com';
  //发送给谁
  $smtpuser = SMTP_ID;
  //SMTP服务器的用户帐号
  $smtppass = SMTP_PASS;
  //SMTP服务器的用户密码
  $mailsubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
  //邮件主题
  $mailbody = $body;
  //邮件内容
  $smtp = new Smtp($smtpserver, $smtpserverport, $smtpuser, $smtppass);
  return $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody);
}