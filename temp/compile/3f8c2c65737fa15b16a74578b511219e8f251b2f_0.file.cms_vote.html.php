<?php
/* Smarty version 3.1.30, created on 2016-10-19 16:59:35
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_vote.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580735f711c6d2_09528404',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f8c2c65737fa15b16a74578b511219e8f251b2f' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_vote.html',
      1 => 1476866031,
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
function content_580735f711c6d2_09528404 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html class="no-js fixed-layout">
<head>
<?php $_smarty_tpl->_subTemplateRender("file:inc_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="<?php echo @constant('SITE_DIR');?>
js/datetimepicker/css/amazeui.datetimepicker.css">
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">投票管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>投票主题</th><th>选项</th><th>状态</th><th>操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['res']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                <tr><td><?php echo $_smarty_tpl->tpl_vars['val']->value['v_name'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['val']->value['count'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['val']->value['status'];?>
</td><td><a href="cms_vote_edit.php?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="am-btn am-btn-default  am-btn-xs"><span class="am-icon-pencil"></span></a> <a href="cms_option.php?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-list-ul"></span></a> <a href="cms_vote.php?del=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增投票<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="v_name">投票主题</label>
                 <input id="v_name" type="text" name="v_name">
              </div>
              <div class="am-form-group">
                <label for="v_ifmulti">类型</label>
                <div class="am-form-group">
                  <label class="am-radio-inline">
                    <input type="radio" name="v_ifmulti" value="0" checked="checked"> 单选
                  </label>
                  <label class="am-radio-inline">
                    <input type="radio" name="v_ifmulti" value="1"> 多选
                  </label>
                </div>
              </div>
              <div class="am-form-group">
                <label for="v_stime">启动时间</label>
                 <input id="v_stime" type="text" name="v_stime" value="<?php echo local_date('Y-m-d H:i:s',gmtime());?>
" data-am-datepicker>
              </div>
              <div class="am-form-group">
                <label for="v_etime">终止时间</label>
                 <input id="v_etime" type="text" name="v_etime" value="<?php echo local_date('Y-m-d H:i:s',gmtime());?>
" data-am-datepicker>
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
 src="<?php echo @constant('SITE_DIR');?>
js/datetimepicker/amazeui.datetimepicker.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
  $('#save').click(function(){
    if ($('#v_name').val() == ''){
      alert('请填写投票名称');
      $('#v_name').focus();
      return false;
    }
    if ($('#v_stime').val() == ''){
      alert('请填写投票启动日期');
      $('#v_stime').focus();
      return false;
    }
    if ($('#v_etime').val() == ''){
      alert('请填写投票终止日期');
      $('#v_etime').focus();
      return false;
    }
  });
});
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
