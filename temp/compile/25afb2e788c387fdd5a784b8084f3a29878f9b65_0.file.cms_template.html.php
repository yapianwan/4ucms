<?php
/* Smarty version 3.1.30, created on 2016-10-19 16:14:15
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_template.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58072b57d24516_64593986',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '25afb2e788c387fdd5a784b8084f3a29878f9b65' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_template.html',
      1 => 1476864845,
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
function content_58072b57d24516_64593986 (Smarty_Internal_Template $_smarty_tpl) {
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">模版管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>名称</th><th>路径</th><th>操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['res']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                <tr><td><?php echo $_smarty_tpl->tpl_vars['val']->value['t_name'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['val']->value['t_path'];?>
</td><td><?php if ($_smarty_tpl->tpl_vars['cms']->value['s_template'] == $_smarty_tpl->tpl_vars['val']->value['t_path']) {?><span class="color_red">当前模板</span><?php } else { ?><a href="cms_template.php?path=<?php echo $_smarty_tpl->tpl_vars['val']->value['t_path'];?>
" class="am-btn am-btn-default am-btn-xs">应用</a> <a href="cms_template.php?del=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" onclick="return confirm(\'确定要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></span></a><?php }?></td></tr>
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增模版<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="t_name">名称</label>
                <input id="t_name" type="text" name="t_name">
              </div>
              <div class="am-form-group">
                <label for="t_path">路径</label>
                <input name="t_path" type="text" id="t_path" placeholder="templates目录下的文件夹名称, 只能是英文和数字">
              </div>
              <center>
                <button type="submit" class="am-btn am-btn-primary submit">提交保存</button>
                <button type="reset" class="am-btn am-btn-primary">放弃保存</button>
                <input type="hidden" name="act" value="add">
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
    if ($('#t_name').val() == ''){
      alert('请填写模板名称');
      $('#t_name').focus();
      return false;
    }
    if ($('#t_path').val() == ''){
      alert('请填写模板路径');
      $('#t_path').focus();
      return false;
    }  
  });
});
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
