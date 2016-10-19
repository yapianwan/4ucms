<?php
/* Smarty version 3.1.30, created on 2016-10-19 10:53:18
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_login.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5806e01eb89507_67171827',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9882534e701b3a15fa4294bde90a12c25e901b0' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_login.html',
      1 => 1476841157,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:inc_head.html' => 1,
  ),
),false)) {
function content_5806e01eb89507_67171827 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_math')) require_once 'D:\\phpfind\\WWW\\4ucms\\library\\smarty-3.1.30\\libs\\plugins\\function.math.php';
?>
<!DOCTYPE html>
<html class="no-js">
<head>
<?php $_smarty_tpl->_subTemplateRender("file:inc_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<style>
  .header{ text-align:center;}
  .header h1{ font-size:200%;color:#333;margin-top: 30px;}
  .header p{ font-size:14px;}
  .hand{ cursor:pointer;}
</style>
</head>

<body>
<!--[if lte IE 9 ]><div class="am-alert am-alert-danger ie-warning" data-am-alert><button type="button" class="am-close">&times;</button><div class="am-container">您正在使用<strong>过时</strong>的浏览器，大部分功能暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a> 以获得更好的体验！</div></div><![endif]-->

<div class="header">
  <div class="am-g">
    <h1>MCMS系统管理后台</h1>
  </div>
  <hr>
</div>
<div class="am-g">
  <div class=" am-u-sm-centered am-u-md-8 am-u-lg-6">
    <form method="post" class="am-form">
      <div class="am-form-group">
        <label for="a_name">管理员/USER NAME:</label>
        <input type="text" name="a_name" id="a_name" value="">
      </div>
      <div class="am-form-group">
        <label for="a_password">密码/PASSWORD:</label>
        <input type="password" name="a_password" id="a_password" value="">
      </div>
      <div class="am-form-group">
        <div class="am-input-group">
          <input id="vercode" type="text" name="vercode" class="am-form-field" value="">
          <span class="am-input-group-btn">
            <img src="verifycode.php?v=<?php echo smarty_function_math(array('equation'=>rand()),$_smarty_tpl);?>
" onclick="javascript:this.src='verifycode.php?v='+Math.random();" class="hand" title="点击刷新验证码" height="38">
          </span>
        </div>
      </div>
      <div class="am-form-group">
        <input type="submit" name="submit" id="login_submit" value="登 录" class="am-btn am-btn-default am-btn-block"><input type="hidden" name="act" value="adminLogin">
      </div>
    </form>
    <!-- <hr>
    <p>© 2014 FORU Inc. Licensed under MIT license.</p> -->
  </div>
</div>

<!-- JS -->
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
  $('#login_submit').click(function(){
    if($('#a_name').val() == ''){
      alert('请填写用户名！');
      $('#a_name').focus();
      return false;
    }
    if($('#a_password').val() == ''){
      alert('请填写密码！');
      $('#a_password').focus();
      return false;
    }
    if($('#vercode').val() == ''){
      alert('请填写验证码！');
      $('#vercode').focus();
      return false;
    }
  });
});
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
