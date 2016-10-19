<?php
/* Smarty version 3.1.30, created on 2016-10-19 11:25:54
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_chip_edit.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5806e7c22ac779_72398977',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c9ac4b9e3d0cea6ecc82982d89388ed25e02b477' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_chip_edit.html',
      1 => 1476847551,
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
function content_5806e7c22ac779_72398977 (Smarty_Internal_Template $_smarty_tpl) {
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">编辑碎片<span class="am-icon-chevron-down am-fr"></span></header>

          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="c_name">碎片名称</label>
                 <input id="c_name" type="text" name="c_name" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_name'];?>
">
              </div>
              <div class="am-form-group">
                <label for="c_code">调用代码</label>
                 <input id="c_code" type="text" name="c_code" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_code'];?>
">
              </div>
              <div class="am-form-group">
                <label for="c_content">碎片内容</label>
                 <textarea id="c_content" name="c_content"><?php echo stripslashes($_smarty_tpl->tpl_vars['res']->value['c_content']);?>
</textarea>
              </div>
              <div class="am-form-group">
                <label for="">安全保护</label>
                <div>
                  <label class="am-btn am-btn-default <?php if ($_smarty_tpl->tpl_vars['res']->value['c_safe'] == 1) {?>am-active<?php }?>">
                    <input type="radio" name="c_safe" value="1" <?php if ($_smarty_tpl->tpl_vars['res']->value['c_safe'] == 1) {?>checked="checked"<?php }?>/> 是
                  </label>
                  <label class="am-btn am-btn-default">
                    <input type="radio" name="c_safe" value="0" <?php if ($_smarty_tpl->tpl_vars['res']->value['c_safe'] == 0) {?>checked="checked"<?php }?>/> 否
                  </label>
                </div>
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
      if ($('#c_name').val() == ''){
        alert('请填写碎片名称');
        $('#c_name').focus();
        return false;
      }
    });
  });
  KindEditor.ready(function(K) {
    K.create('#c_content',{allowFileManager : true});
  });
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
