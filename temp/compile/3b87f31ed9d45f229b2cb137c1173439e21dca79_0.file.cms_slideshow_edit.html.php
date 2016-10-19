<?php
/* Smarty version 3.1.30, created on 2016-10-19 15:57:38
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_slideshow_edit.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580727726bc9c4_34631828',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b87f31ed9d45f229b2cb137c1173439e21dca79' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_slideshow_edit.html',
      1 => 1476863855,
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
function content_580727726bc9c4_34631828 (Smarty_Internal_Template $_smarty_tpl) {
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">编辑幻灯<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="s_name">幻灯名称</label>
                 <input id="s_name" type="text" name="s_name" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['s_name'];?>
">
              </div>
              <div class="am-fomr-group">
                <label for="s_parent">属于</label>
                <select name="s_parent">
                  <option value="global" <?php if ($_smarty_tpl->tpl_vars['res']->value['s_parent'] == 'global') {
echo @constant('LIB_SELECTED');
}?>>全局</option>
                  <option value="mobile" <?php if ($_smarty_tpl->tpl_vars['res']->value['s_parent'] == 'mobile') {
echo @constant('LIB_SELECTED');
}?>>手机端</option>
                  <option value="index" <?php if ($_smarty_tpl->tpl_vars['res']->value['s_parent'] == 'index') {
echo @constant('LIB_SELECTED');
}?>>首页</option>
                  <?php echo $_smarty_tpl->tpl_vars['channel_select_list']->value;?>

                </select>
              </div>
              <div class="am-form-group">
                <label for="s_picture">幻灯图片</label>
                <div class="am-input-group">
                  <input name="s_picture" type="text" id="s_picture" class="am-form-field" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['s_picture'];?>
">
                  <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default" id="s_picture_upload" type="button">选择图片</button>
                  </span>
                </div>
              </div>
              <div class="am-form-group">
                <label for="s_link">链接地址</label>
                 <input id="s_link" type="text" name="s_link" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['s_link'];?>
">
              </div>
              <div class="am-form-group">
                <label for="s_order">排序</label>
                 <input id="s_order" type="text" name="s_order" value="100" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['s_order'];?>
">
              </div>
              <center>
                <button type="submit" name="submit" id="save" class="am-btn am-btn-default">提交保存</button>
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
