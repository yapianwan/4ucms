<?php
/* Smarty version 3.1.30, created on 2016-10-19 10:40:45
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_channel.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5806dd2dd4cbe4_64679316',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13fb0f2fada7b18394f95f23bd266de285b08a1c' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_channel.html',
      1 => 1476842324,
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
function content_5806dd2dd4cbe4_64679316 (Smarty_Internal_Template $_smarty_tpl) {
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
        <div class="am-panel am-panel-default">
          <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">频道管理<span class="am-icon-chevron-down am-fr"></span></div>
          <div class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
              <th>ID</th><th>排序</th><th>频道名称</th><th>频道模型</th><th class="am-hide">内容模型</th><th class="am-hide">内容操作</th><th>频道操作</th>
              </tr>
              </thead>
              <tbody>
                <?php echo $_smarty_tpl->tpl_vars['channel_list']->value;?>

              </tbody>
            </table>
          </div>
        </div>
        </div>
    </div>
    </div>
    <!-- content end -->
</div>
<?php $_smarty_tpl->_subTemplateRender("file:inc_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
</html><?php }
}
