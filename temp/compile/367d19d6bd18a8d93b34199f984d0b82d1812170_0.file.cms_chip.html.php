<?php
/* Smarty version 3.1.30, created on 2016-10-19 11:26:18
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_chip.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5806e7da0c76b4_60109218',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '367d19d6bd18a8d93b34199f984d0b82d1812170' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_chip.html',
      1 => 1476845266,
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
function content_5806e7da0c76b4_60109218 (Smarty_Internal_Template $_smarty_tpl) {
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">碎片管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>碎片名称</th><th>调用代码</th><th width="100">操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['res']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                <tr><td><?php echo $_smarty_tpl->tpl_vars['val']->value['c_name'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['val']->value['c_code'];?>
</td><td><a href="<?php echo $_smarty_tpl->tpl_vars['val']->value['edit_url'];?>
" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a> <a href="<?php echo $_smarty_tpl->tpl_vars['val']->value['del_url'];?>
" onclick="return confirm(\'确认要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></a></td></tr>
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增碎片<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="c_name">碎片名称</label>
                 <input id="c_name" type="text" name="c_name">
              </div>
              <div class="am-form-group">
                <label for="c_code">调用代码</label>
                 <input id="c_code" type="text" name="c_code">
              </div>
              <div class="am-form-group">
                <label for="c_content">碎片内容</label>
                 <textarea id="c_content" name="c_content"></textarea>
              </div>
              <div class="am-form-group">
                <label for="">安全保护</label>
                <div>
                  <label class="am-btn am-btn-default">
                    <input type="radio" name="c_safe" value="1"/> 是
                  </label>
                  <label class="am-btn am-btn-default am-active">
                    <input type="radio" name="c_safe" value="0" checked="checked" /> 否
                  </label>
                </div>
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
