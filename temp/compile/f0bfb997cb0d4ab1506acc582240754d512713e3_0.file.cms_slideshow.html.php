<?php
/* Smarty version 3.1.30, created on 2016-10-19 15:58:30
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_slideshow.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580727a67b2ac0_46561034',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f0bfb997cb0d4ab1506acc582240754d512713e3' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_slideshow.html',
      1 => 1476863547,
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
function content_580727a67b2ac0_46561034 (Smarty_Internal_Template $_smarty_tpl) {
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">幻灯管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>排序</th><th>幻灯图片</th><th>幻灯名称</th><th>链接地址</th><th>操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['res']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                <tr><td><?php echo $_smarty_tpl->tpl_vars['val']->value['s_order'];?>
</td><td><a href="<?php echo $_smarty_tpl->tpl_vars['val']->value['s_picture'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['val']->value['s_picture'];?>
" width="100" height="30" /></a></td><td><?php echo $_smarty_tpl->tpl_vars['val']->value['s_name'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['val']->value['s_link'];?>
</td><td><a href="cms_slideshow_edit.php?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a> <a href="cms_slideshow.php?del=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" onclick="return confirm(\'确认要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></span></a></td></tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

              </tbody>
            </table>
          </main>
        </section>

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增幻灯<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="s_name">幻灯名称</label>
                 <input id="s_name" type="text" name="s_name">
              </div>
              <div class="am-form-group">
                <label for="s_parent">属于</label>
                <select name="s_parent">
                  <option value="global">全局</option>
                  <option value="mobile">手机端</option>
                  <option value="index">首页</option>
                  <?php echo '<?php ';?>echo channel_select_list(0,0,0,0);<?php echo '?>';?>
                </select>
              </div>
              <div class="am-form-group">
                <label for="s_picture">幻灯图片</label>
                <div class="am-input-group">
                  <input name="s_picture" type="text" id="s_picture" class="am-form-field">
                  <span class="am-input-group-btn">
                    <button type="button" class="am-btn am-btn-default" id="s_picture_upload">选择图片</button>
                  </span>
                </div>
              </div>
              <div class="am-form-group">
                <label for="s_url">链接地址</label>
                 <input id="s_url" type="text" name="s_url" value="http://">
              </div>
              <div class="am-form-group">
                <label for="s_order">排序</label>
                 <input id="s_order" type="text" name="s_order" value="100">
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
    if($('#s_picture').val() == ''){
      alert('图片不能为空');
      $('#s_picture_upload').focus();
      return false;
    }
    if (isNaN($('#s_order').val()) || $('#s_order').val() == '') {
      alert('排序必须是数字');
      $('#s_order').focus();
      return false;
    }
  });
});
KindEditor.ready(function(K) {
  var editor = K.editor({allowFileManager : true});
  K('#s_picture_upload').click(function() {
    editor.loadPlugin('image', function() {
      editor.plugin.imageDialog({
      imageUrl : K('#s_picture').val(),
      clickFn : function(url, title, width, height, border, align) {
        K('#s_picture').val(url);
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
