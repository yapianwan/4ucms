<?php
/* Smarty version 3.1.30, created on 2016-10-19 13:27:55
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_feedback_answer.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5807045b69bb79_95878865',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'acb9bd85a88510bc5bd44cb5491f50f62f70d4f5' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_feedback_answer.html',
      1 => 1476854830,
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
function content_5807045b69bb79_95878865 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html class="no-js fixed-layout">
<head>
<?php $_smarty_tpl->_subTemplateRender("file:inc_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="<?php echo @constant('SITE_DIR');?>
ui/css/amazeui.datetimepicker.css">
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">回复留言<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-1">
              <table class="am-table am-table-bordered">
                <tr><td class="am-text-right">留言人</td><td><?php echo $_smarty_tpl->tpl_vars['res']->value['f_name'];?>
</td></tr>
                <tr><td class="am-text-right">联系电话</td><td><?php echo $_smarty_tpl->tpl_vars['res']->value['f_tel'];?>
</td></tr>
                <tr><td class="am-text-right">电子邮件</td><td><?php echo $_smarty_tpl->tpl_vars['res']->value['f_email'];?>
</td></tr>
                <tr><td class="am-text-right">留言标题</td><td><?php echo $_smarty_tpl->tpl_vars['res']->value['f_title'];?>
</td></tr>
                <tr><td class="am-text-right">留言内容</td><td><?php echo $_smarty_tpl->tpl_vars['res']->value['f_content'];?>
</td></tr>
                <tr><td class="am-text-right">留言日期</td><td><?php echo local_date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['res']->value['f_date']);?>
</td></tr>
              </table>
               <div class="am-form-group">
                <label for="f_answer">回复内容</label>
                <textarea name="f_answer" id="f_answer"><?php echo stripslashes($_smarty_tpl->tpl_vars['res']->value['f_answer']);?>
</textarea>
              </div>
              <center>
                <button type="submit" name="submit" class="am-btn am-btn-default">提交保存</button>
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
KindEditor.ready(function(K) {
  K.create('#f_answer',{allowFileManager : true});
});
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
