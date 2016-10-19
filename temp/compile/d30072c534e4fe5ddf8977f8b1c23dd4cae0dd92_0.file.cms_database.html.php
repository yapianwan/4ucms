<?php
/* Smarty version 3.1.30, created on 2016-10-19 12:02:15
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_database.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5806f047d471a3_36834244',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd30072c534e4fe5ddf8977f8b1c23dd4cae0dd92' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_database.html',
      1 => 1476848023,
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
function content_5806f047d471a3_36834244 (Smarty_Internal_Template $_smarty_tpl) {
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">数据库管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <a href="?act=backup" class="am-btn am-btn-default">数据库备份</a>
            <a id="modal-restore" class="am-btn am-btn-default">数据库还原</a>
            <a href="?act=optimize" class="am-btn am-btn-default">数据库优化</a>
            <a href="javascript:if(confirm('数据正常的情况下，请不要随意进行修复操作！\n您确定要进行该操作吗？')) window.location.href='?act=repair';" class="am-btn am-btn-default">数据库修复</a>
            <table class="am-table admin-content-table">
              <thead>
              <tr>
                <th>表名</th>
              </tr>
              </thead>
              <tbody>
                <tr>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['res']->value, 'val', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
                  <?php if ($_smarty_tpl->tpl_vars['key']->value % 4 == 0) {?></tr><tr><?php }?>
                  <td class="am-u-sm-12 am-u-md-4 am-u-lg-3"><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</td>
                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </tr>
              </tbody>
            </table>
          </main>
        </section>

      </div>
    </div>
  </div>
  <!-- content end -->
</div>

<?php $_smarty_tpl->_subTemplateRender("file:inc_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="am-modal am-modal-prompt" tabindex="-1" id="modal-prompt">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">请输入需还原的文件名</div>
    <div class="am-modal-bd" style="padding:10px 0;">
      <input type="text" class="am-modal-prompt-input">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>提交</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<?php echo '<script'; ?>
>
$(function() {
  $('#modal-restore').on('click', function() {
    $('#modal-prompt').modal({
      relatedTarget: this,
      onConfirm: function(e) {
        window.location.href='?act=restore&db='+e.data;
      },
      onCancel: function(e) {}
    });
  });
});
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
