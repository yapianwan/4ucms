<?php
/* Smarty version 3.1.30, created on 2016-10-19 16:06:38
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_system.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5807298e20d731_40444793',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8d2bf99fff4b25d1307cec8934e0e3b9ae54ab6' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_system.html',
      1 => 1476864395,
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
function content_5807298e20d731_40444793 (Smarty_Internal_Template $_smarty_tpl) {
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">系统设置<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">

            <main class="am-tabs am-margin" data-am-tabs>
              <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1">基本信息</a></li>
                <li><a href="#tab2">SEO</a></li>
              </ul>

              <div class="am-tabs-bd">
                <section class="am-tab-panel am-fade am-in am-active" id="tab1">
                  <div class="am-form-group">
                    <label for="s_domain">域名</label>
                    <input id="s_domain" type="text" name="s_domain" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['s_domain'];?>
" placeholder="请在域名前添加http://，如:http://www.163.com">
                  </div>

                  <div class="am-form-group">
                    <label for="s_name">网站名称</label>
                    <input id="s_name" type="text" name="s_name" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['s_name'];?>
">
                  </div>

                  <div class="am-form-group">
                    <label for="s_copyright">版权信息</label>
                    <textarea id="s_copyright" name="s_copyright"><?php echo stripslashes($_smarty_tpl->tpl_vars['res']->value['s_copyright']);?>
</textarea>
                  </div>
                  
                  <div class="am-form-group">
                    <label for="s_code">第三方代码</label>
                    <textarea id="s_code" name="s_code"><?php echo $_smarty_tpl->tpl_vars['res']->value['s_code'];?>
</textarea>
                  </div>

                  <div class="am-form-group">
                    <label for="s_user">用户注册</label>
                    <select name="s_user" id="s_user">
                      <option value="1" <?php if ($_smarty_tpl->tpl_vars['res']->value['s_user'] == 1) {
echo @constant('LIB_SELECTED');
}?>>不需审核</option>
                      <option value="0" <?php if ($_smarty_tpl->tpl_vars['res']->value['s_user'] == 0) {
echo @constant('LIB_SELECTED');
}?>>需要审核</option>
                    </select>
                  </div>

                  <div class="am-form-group">
                    <label for="s_feedback">留言控制</label>
                    <select name="s_feedback" id="s_feedback">
                      <option value="1" <?php if ($_smarty_tpl->tpl_vars['res']->value['s_feedback'] == 1) {
echo @constant('LIB_SELECTED');
}?>>需要审核</option>
                      <option value="2" <?php if ($_smarty_tpl->tpl_vars['res']->value['s_feedback'] == 2) {
echo @constant('LIB_SELECTED');
}?>>不需审核</option>
                      <option value="0" <?php if ($_smarty_tpl->tpl_vars['res']->value['s_feedback'] == 0) {
echo @constant('LIB_SELECTED');
}?>>关闭留言</option>
                    </select>
                  </div>
                </section>
              
                <section class="am-tab-panel am-fade" id="tab2">
                  <div class="am-form-group">
                    <label for="s_seoname">优化标题</label>
                    <input id="s_seoname" type="text" name="s_seoname" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['s_seoname'];?>
">
                  </div>

                  <div class="am-form-group">
                    <label for="s_keywords">关键字</label>
                    <textarea id="s_keywords" type="text" name="s_keywords"><?php echo $_smarty_tpl->tpl_vars['res']->value['s_keywords'];?>
</textarea>
                  </div>

                  <div class="am-form-group">
                    <label for="s_description">关键描述</label>
                    <textarea id="s_description" name="s_description"><?php echo $_smarty_tpl->tpl_vars['res']->value['s_description'];?>
</textarea>
                  </div>
                </section>
                
                <center>
                  <button type="submit" name="submit" class="am-btn am-btn-default">提交保存</button>
                </center>
                <br>
              </div> 
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
    if ($('#s_domain').val() == ''){
      alert('请填写域名');
      $('#c_name').focus();
      return false;
    }
    if ($('#s_name').val() == ''){
      alert('请填写网络名称');
      $('#c_name').focus();
      return false;
    }
  });
});
KindEditor.ready(function(K) {
  K.create('#s_copyright',{allowFileManager : true});
});
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
