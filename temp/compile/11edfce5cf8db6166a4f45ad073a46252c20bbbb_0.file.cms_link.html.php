<?php
/* Smarty version 3.1.30, created on 2016-10-19 13:55:58
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_link.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58070aeeb0c427_61875831',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11edfce5cf8db6166a4f45ad073a46252c20bbbb' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_link.html',
      1 => 1476855922,
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
function content_58070aeeb0c427_61875831 (Smarty_Internal_Template $_smarty_tpl) {
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">链接管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>排序</th><th>链接图片</th><th>链接名称</th><th class="am-hide-sm-only">链接地址</th><th>操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['res']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                <tr><td><?php echo $_smarty_tpl->tpl_vars['val']->value['l_order'];?>
</td><td><a href="<?php echo $_smarty_tpl->tpl_vars['val']->value['l_picture'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['val']->value['l_picture'];?>
" width="100" height="30" /></a></td><td><?php echo $_smarty_tpl->tpl_vars['val']->value['l_name'];?>
</td><td class="am-hide-sm-only"><?php echo $_smarty_tpl->tpl_vars['val']->value['l_link'];?>
</td><td><a href="cms_link_edit.php?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a> <a href="cms_link.php?del=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" onclick="return confirm(\'确认要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></span></a></td></tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

              </tbody>
            </table>
            <?php echo page_show_admin($_smarty_tpl->tpl_vars['pager']->value[2],$_smarty_tpl->tpl_vars['pager']->value[3],'page',2);?>

          </main>
        </section>

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增链接<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="l_name">链接名称</label>
                 <input id="l_name" type="text" name="l_name">
              </div>
              <div class="am-form-group">
                <label for="l_picture">链接图片</label>
                <div class="am-input-group">
                  <input name="l_picture" type="text" id="l_picture" class="am-form-field">
                  <span class="am-input-group-btn">
                    <button type="button" class="am-btn am-btn-default" id="l_picture_upload">选择图片</button>
                  </span>
                </div>
              </div>
              <div class="am-form-group">
                <label for="l_link">链接地址</label>
                 <input id="l_link" type="text" name="l_link" value="http://">
              </div>
              <div class="am-form-group">
                <label for="l_order">排序</label>
                 <input id="l_order" type="text" name="l_order" value="100">
              </div>
              <center>
                <button type="submit" name="submit" id="save" class="am-btn am-btn-default">提交保存</button>
                <button type="reset" class="am-btn am-btn-default">放弃保存</button>
              </center>
            </main>
          </form>
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
KindEditor.ready(function(K) {
  var editor = K.editor({allowFileManager : true});
  K('#l_picture_upload').click(function() {
    editor.loadPlugin('image', function() {
      editor.plugin.imageDialog({
      imageUrl : K('#l_picture').val(),
      clickFn : function(url, title, width, height, border, align) {
        K('#l_picture').val(url);
        editor.hideDialog();
        }
      });
    });
  });
});
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
