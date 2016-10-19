<?php
/* Smarty version 3.1.30, created on 2016-10-19 15:31:58
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_priv.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5807216e680043_49176473',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2e0525fa60c0c0f00b426e0cc04f1ac1ec88c29e' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_priv.html',
      1 => 1476860133,
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
function content_5807216e680043_49176473 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html class="no-js fixed-layout">
<head>
<?php $_smarty_tpl->_subTemplateRender("file:inc_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<style>
  th { background: #EEE;}
  label{ padding:5px 20px; cursor: pointer; margin-bottom: 0;}
  input[type=checkbox], input[type=radio]{ margin: 4px 5px 0 0;}
</style>
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">权限管理<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post">
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-bordered">
              <tbody>
                <tr>
                  <th><label><input type="checkbox" name="cms" id="cms" value="">内容管理</label></th>
                  <td>
                    <?php echo $_smarty_tpl->tpl_vars['get_channel_priv']->value;?>

                    <hr>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lang_priv']->value, 'val', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
                    <label for="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['priv']->value)) {
echo @constant('LIB_CHECKED');
}?>><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</label>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                  </td>
                </tr>
                <tr>
                  <th><label><input type="checkbox" name="int" id="int" value="">交互管理</label></th>
                  <td>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lang_inrct']->value, 'val', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
                    <label for="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['priv']->value)) {
echo @constant('LIB_CHECKED');
}?>><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</label>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                  </td>
                </tr>
                <tr>
                  <th><label><input type="checkbox" name="int" id="int" value="">微信管理</label></th>
                  <td>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lang_weixin']->value, 'val', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
                    <label for="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['priv']->value)) {
echo @constant('LIB_CHECKED');
}?>><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</label>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                  </td>
                </tr>
                <tr>
                  <th><label><input type="checkbox" name="sys" id="sys" value="">系统设置</label></th>
                  <td>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lang_system']->value, 'val', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
                    <label for="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['priv']->value)) {
echo @constant('LIB_CHECKED');
}?>><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</label>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                  </td>
                </tr>
              </tbody>
            </table>
            <center>
              <button type="submit" name="submit" id="save" class="am-btn am-btn-default">提交保存</button>
              <button type="reset" class="am-btn am-btn-default">放弃保存</button>
              <input type="hidden" name="act" value="update"><input type="hidden" name="rid" value="<?php echo $_smarty_tpl->tpl_vars['rid']->value;?>
">
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
>
$(function(){
  $('#cms,#int,#sys').click(function(){
    var p = $(this).parent().parent().parent();
    var v = $(this).attr('status');
    if (v==1) {
      p.find('input:checkbox').prop('checked', false);
      $(this).attr('status','0');
    }else{
      p.find('input:checkbox').prop('checked', true);
      $(this).attr('status','1');
    }
  });
  $('.common_table th>span>label>input').click(function(){
    var p = $(this).parent().parent().parent().parent();
    var v = $(this).attr('status');
    if (v==1) {
      p.find('input:checkbox').prop('checked', false);
      $(this).attr('status','0');
    }else{
      p.find('input:checkbox').prop('checked', true);
      $(this).attr('status','1');
    }
  });
})
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
