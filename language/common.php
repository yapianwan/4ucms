<?php
// common
$_lang['illegal'] = '非法访问页面!';
$_lang['404'] = '您访问的页面不存在!';
$_lang['NA'] = 'N/A';
$_lang['error_text'] = 'Error: ';
$_lang['keyword'] = '请输入要查找的关键字';
$_lang['time_limit'] = '短时间内请勿重复操作!';
$_lang['msg_success'] = '操作成功!';
$_lang['msg_failed'] = '操作失败, 请检查后重试!';
$_lang['tryagain'] = '操作失败, 请稍后重试!';
$_lang['qrcode_faild'] = '对应二维码创建失败!';
$_lang['vrfcode_faild'] = '验证码有误，请检查后重试!';
// feedback
$_lang['feedback'][COM_SUC] = '您的信息已提交，我们会尽快处理！';
// mail
$_lang['mail'][COM_SUC] = '邮件投递成功！';
$_lang['mail'][COM_FLD] = '邮件投递失败！';
$_lang['mail']['subscribe'] = '邮件订阅成功，谢谢您对我们的支持！';
// reg
$_lang['reg']['id_existing'] = '账户已存在，请修改后重试!';
$_lang['reg']['email_existing'] = 'Email已存在，请修改后重试!';
$_lang['reg']['email_error'] = 'Email格式不对，请修改后重试!';
$_lang['reg'][COM_EM_SUBJ] = '[system_name] 恭喜您注册成功！';
$_lang['reg'][COM_EM_BODY] = '尊敬的用户，您好！<br>您的注册信息如下：<p>账户：[user_name]<br>密码：[user_password]</p>请保存好您的用户信息。感谢您对我们的支持！';
$_lang['reg'][COM_SUC] = '注册成功';
$_lang['reg'][COM_FLD] = '注册失败';
// login
$_lang[COM_LGIN][COM_SUC] = '恭喜您，登陆成功!';
$_lang[COM_LGIN]['not_match'] = '信息不匹配!';
$_lang[COM_LGIN]['tip'] = '请登陆后继续操作！';
// reset password
$_lang[COM_RST_PSD][COM_EM_SUBJ] = '[system_name]-重置密码 您可以通过正文中的链接重置密码';
$_lang[COM_RST_PSD][COM_EM_BODY] = '尊敬的用户，您好！<br><p>您可以通过如下链接，重置密码：<br><a href="[system_domain]/user.php?act=psw_reset&u_email=[u_email]&rand=[randstr]#main" target="_blank">点击该链接进行密码重置</a></p>';
$_lang['admin_'.COM_RST_PSD][COM_EM_SUBJ] = '[system_name]-密码已重置 您可以通过正文中的查看密码';
$_lang['admin_'.COM_RST_PSD][COM_EM_BODY] = '尊敬的用户，您好！<br><p>您的密码已重置为：[u_psw]<br>请您及时的登陆您的账号并修改密码</p>';
$_lang[COM_RST_PSD][COM_SUC] = '密码找回信息已发往您的邮箱，请注意查收!';
$_lang['reset_result'][COM_SUC] = '密码重置成功!';
$_lang['reset_result'][COM_FLD] = '密码重置失败!';
// user center
$_lang['uc']['userinfor'][COM_SUC] = '用户信息编辑成功';