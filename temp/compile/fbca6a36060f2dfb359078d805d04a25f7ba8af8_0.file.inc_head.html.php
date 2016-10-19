<?php
/* Smarty version 3.1.30, created on 2016-10-19 16:59:35
  from "D:\phpfind\WWW\4ucms\templates\admin\inc_head.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580735f7133dd3_67481784',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbca6a36060f2dfb359078d805d04a25f7ba8af8' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\inc_head.html',
      1 => 1476850165,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580735f7133dd3_67481784 (Smarty_Internal_Template $_smarty_tpl) {
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>网站管理后台</title>

<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">

<!-- No Baidu Siteapp-->
<meta http-equiv="Cache-Control" content="no-siteapp"/>

<!-- Amaze UI CSS -->
<link rel="stylesheet" href="//cdn.amazeui.org/amazeui/2.7.2/css/amazeui.flat.min.css">
<link rel="stylesheet" href="<?php echo @constant('SITE_DIR');?>
templates/admin/css/admin.css">
<link rel="stylesheet" href="../editor/themes/default/default.css" />

<!-- style -->
<style>
.am-form select{ padding:0.52em}
</style>

<!--[if lt IE 9]>
<?php echo '<script'; ?>
 src="//libs.baidu.com/jquery/1.11.1/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="//cdn.amazeui.org/amazeui/2.7.2/js/amazeui.ie8polyfill.min.js"><?php echo '</script'; ?>
>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<?php echo '<script'; ?>
 src="//libs.baidu.com/jquery/2.1.4/jquery.min.js"><?php echo '</script'; ?>
>
<!--<![endif]-->
<?php echo '<script'; ?>
 src="//cdn.amazeui.org/amazeui/2.7.2/js/amazeui.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 charset="utf-8" type="text/javascript" src="../editor/kindeditor.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../editor/lang/zh_CN.js"><?php echo '</script'; ?>
><?php }
}
