<?php
/* Smarty version 3.1.30, created on 2016-10-19 15:17:30
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_rewrite.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58071e0a9ba3f2_12592697',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9c74c126247973a0b22dad06bf4fd821baacb979' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_rewrite.html',
      1 => 1476861435,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:inc_head.html' => 1,
    'file:inc_header.html' => 1,
    'file:inc_footer.html' => 1,
  ),
),false)) {
function content_58071e0a9ba3f2_12592697 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html class="no-js fixed-layout">
<head>
<?php $_smarty_tpl->_subTemplateRender("file:inc_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</head>

<body>
<?php $_smarty_tpl->_subTemplateRender("file:inc_header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="am-cf admin-main">
  <!-- content start -->
  <div class="admin-content">
    <div class="am-g am-g-fixed">
      <div class="am-u-sm-12 am-padding-top">

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">伪静态规则文件生产<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-nbfc am-in" id="collapse-panel-1">
            <div class="am-u-sm-6">
              <a href="../ajax.php?act=rewrite_apache" class="am-btn am-btn-default">APACHE</a>
              <p class="am-form-help">默认会在网站根目录生成.htaccess规则文件</p>
            </div>
            <div class="am-u-sm-6">
              <a href="../ajax.php?act=rewrite_nginx" class="am-btn am-btn-default">NGINX</a>
              <p class="am-form-help">默认会在网站根目录生成.nginx规则文件</p>
            </div>
            <div class="am-u-sm-6">
              <a href="../ajax.php?act=rewrite_isapi" class="am-btn am-btn-default">HTTPD</a>
              <p class="am-form-help">默认会在网站根目录生成httpd.ini规则文件</p>
            </div>
            <div class="am-u-sm-6">
              <a href="../ajax.php?act=rewrite_dotnet" class="am-btn am-btn-default">DOTNET</a>
              <p class="am-form-help">默认会在网站根目录生成web.config规则文件</p>
            </div>
          </main>
        </section>

      </div>
    </div>
  </div>
  <!-- content end -->
</div>

<?php $_smarty_tpl->_subTemplateRender("file:inc_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<!-- js -->
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
  $('#save').click(function(){
    if ($('#l_name').val() == ''){
      alert('请填写链接名称');
      $('#l_name').focus();
      return false;
    }
    if (isNaN($('#l_order').val()) || $('#l_order').val() == '') {
      alert('排序必须是数字');
      $('#l_order').focus();
      return false;
    }
  });
});
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
