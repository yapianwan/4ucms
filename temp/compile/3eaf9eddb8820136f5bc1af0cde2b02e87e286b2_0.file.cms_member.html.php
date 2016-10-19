<?php
/* Smarty version 3.1.30, created on 2016-10-19 15:49:07
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_member.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580725730b1c30_10464187',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3eaf9eddb8820136f5bc1af0cde2b02e87e286b2' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_member.html',
      1 => 1476861310,
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
function content_580725730b1c30_10464187 (Smarty_Internal_Template $_smarty_tpl) {
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">会员管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <form method="get" class="am-form am-show-sm-up am-nbfc">
                <div class="am-u-sm-12">
                  <div class="am-input-group">
                    <input id="key" class="am-form-field" type="text" name="key" placeholder="名称查找" />
                    <span class="am-input-group-btn"><button type="submit" id="search" class="am-btn" name="search">检索</button></span>
                  </div>
                </div>
            </form>
            <hr/>
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>帐号</th><th>邮箱</th><th>手机</th><th>操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['res']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                <tr><td><?php echo $_smarty_tpl->tpl_vars['val']->value['u_name'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['val']->value['u_email'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['val']->value['u_mobile'];?>
</td><td><a href="cms_member_edit.php?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a> <a href="cms_member.php?del=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
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

      </div>
    </div>
  </div>
  <!-- content end -->
</div>

<?php $_smarty_tpl->_subTemplateRender("file:inc_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
</html><?php }
}
