<?php
/* Smarty version 3.1.30, created on 2016-10-19 11:00:30
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_welcome.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5806e1ce280359_10934177',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ef3861a4d866dff657a984e755219e9f63556860' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_welcome.html',
      1 => 1476840546,
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
function content_5806e1ce280359_10934177 (Smarty_Internal_Template $_smarty_tpl) {
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
    
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">管理员: <?php echo $_COOKIE['admin_name'];?>
</strong></div>
    </div>

    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><a href="<?php echo $_smarty_tpl->tpl_vars['chn_url']->value;?>
"><span class="am-icon-btn am-icon-th-large"></span><br>站点频道: <?php echo $_smarty_tpl->tpl_vars['chn']->value;?>
</a></li>
      <li><a href="<?php echo $_smarty_tpl->tpl_vars['dtl_url']->value;?>
"><span class="am-icon-btn am-icon-file-text"></span><br/>频道详情: <?php echo $_smarty_tpl->tpl_vars['dtl']->value;?>
</a></li>
      <li><a href="<?php echo $_smarty_tpl->tpl_vars['sld_url']->value;?>
"><span class="am-icon-btn am-icon-archive"></span><br/>幻灯片: <?php echo $_smarty_tpl->tpl_vars['sld']->value;?>
</a></li>
      <li><a href="<?php echo $_smarty_tpl->tpl_vars['chip_url']->value;?>
"><span class="am-icon-btn am-icon-file-code-o"></span><br/>代码碎片: <?php echo $_smarty_tpl->tpl_vars['chip']->value;?>
</a></li>
    </ul>
    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><a href="<?php echo $_smarty_tpl->tpl_vars['usr_url']->value;?>
"><span class="am-icon-btn am-icon-users"></span><br/>会员: <?php echo $_smarty_tpl->tpl_vars['usr']->value;?>
</a></li>
      <li><a href="<?php echo $_smarty_tpl->tpl_vars['fdb_url']->value;?>
"><span class="am-icon-btn am-icon-comment"></span><br/>在线留言: <?php echo $_smarty_tpl->tpl_vars['fdb']->value;?>
</a></li>
      <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_url']->value;?>
"><span class="am-icon-btn am-icon-link"></span><br/>友情连接: <?php echo $_smarty_tpl->tpl_vars['link']->value;?>
</a></li>
      <li><a href="<?php echo $_smarty_tpl->tpl_vars['tpl_url']->value;?>
"><span class="am-icon-btn am-icon-laptop"></span><br/>站点模版: <?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
</a></li>
    </ul>
    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><a href="<?php echo $_smarty_tpl->tpl_vars['adm_url']->value;?>
"><span class="am-icon-btn am-icon-user"></span><br/>管理员: <?php echo $_smarty_tpl->tpl_vars['adm']->value;?>
</a></li>
      <li><a href="<?php echo $_smarty_tpl->tpl_vars['priv_url']->value;?>
"><span class="am-icon-btn am-icon-graduation-cap"></span><br/>权限管理: <?php echo $_smarty_tpl->tpl_vars['priv']->value;?>
</a></li>
    </ul>
    
    </div>
  </div>
  <!-- content end -->
</div>

<?php $_smarty_tpl->_subTemplateRender("file:inc_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
</html><?php }
}
