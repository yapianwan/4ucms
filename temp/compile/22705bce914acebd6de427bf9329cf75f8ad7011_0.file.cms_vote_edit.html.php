<?php
/* Smarty version 3.1.30, created on 2016-10-19 16:59:21
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_vote_edit.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580735e95c12d1_53239255',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '22705bce914acebd6de427bf9329cf75f8ad7011' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_vote_edit.html',
      1 => 1476867416,
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
function content_580735e95c12d1_53239255 (Smarty_Internal_Template $_smarty_tpl) {
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">编辑投票<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="v_name">投票主题</label>
                 <input id="v_name" type="text" name="v_name" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['v_name'];?>
">
              </div>
              <div class="am-form-group">
                <label for="l_picture">类型</label>
                <div class="am-form-group">
                  <label class="am-radio-inline">
                    <input type="radio" name="v_ifmulti" value="0" <?php if ($_smarty_tpl->tpl_vars['res']->value['v_ifmulti'] == 0) {?>checked="checked"<?php }?>> 单选
                  </label>
                  <label class="am-radio-inline">
                    <input type="radio" name="v_ifmulti" value="1" <?php if ($_smarty_tpl->tpl_vars['res']->value['v_ifmulti'] == 1) {?>checked="checked"<?php }?>> 多选
                  </label>
                </div>
              </div>
              <div class="am-form-group">
                <label for="v_stime">启动时间</label>
                 <input id="v_stime" type="text" name="v_stime" value="<?php echo local_date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['res']->value['v_stime']);?>
" data-am-datepicker>
              </div>
              <div class="am-form-group">
                <label for="v_etime">终止时间</label>
                 <input id="v_etime" type="text" name="v_etime" value="<?php echo local_date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['res']->value['v_etime']);?>
" data-am-datepicker>
              </div>
              <center>
                <input type="submit" name="submit" id="save" class="am-btn am-btn-default" value="提交保存">
                <input type="reset" class="am-btn am-btn-default" value="放弃保存">
                <input type="hidden" name="id" value="<?php echo '<?php ';?>echo $_GET['id'];<?php echo '?>';?>">
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
