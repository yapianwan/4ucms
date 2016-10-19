<?php
/* Smarty version 3.1.30, created on 2016-10-19 13:37:29
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_feedback.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580706992f4f95_67070112',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '50519ece00864191f542a45c34db95437b09ef5a' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_feedback.html',
      1 => 1476855287,
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
function content_580706992f4f95_67070112 (Smarty_Internal_Template $_smarty_tpl) {
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

        <div class="am-panel am-panel-default">
          <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">留言管理<span class="am-icon-chevron-down am-fr"></span></div>
          <div class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <form action="" method="post">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>选择</th><th>状态</th><th>留言人</th><th class="am-hide">联系电话</th><th class="am-hide">公司名称</th><th class="am-hide">联系地址</th><th>留言日期</th><th>回复</th>
              </tr>
              </thead>
              <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['res']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                <tr><td><input class="form_checkbox" type="checkbox" name="id[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" /></td><td><?php if ($_smarty_tpl->tpl_vars['val']->value['f_ok'] == 0) {?><span style="color:red">未审</span><?php } else { ?>已审<?php }
echo @constant('LIB_TDEB');
echo $_smarty_tpl->tpl_vars['val']->value['f_name'];
echo @constant('LIB_TDHEB');
echo $_smarty_tpl->tpl_vars['val']->value['f_tel'];
echo @constant('LIB_TDHEB');
echo $_smarty_tpl->tpl_vars['row']->value['f_cname'];
echo @constant('LIB_TDHEB');
echo $_smarty_tpl->tpl_vars['row']->value['f_address'];
echo @constant('LIB_TDEB');
echo local_date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['val']->value['f_date']);?>
</td><td><a href="cms_feedback_answer.php?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
">回复</a></td></tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                <tr>
                  <td colspan="8">
                    <button type="button" class="form_button" id="check_all">全选</button>
                    <button type="button" class="form_button" id="check_none">不选</button>
                    <button type="button" class="form_button" id="check_invert">反选</button>
                    <select name="execute_method" id="execute_method">
                      <option value="">请选择操作</option>
                      <option value="sok">审核留言</option>
                      <option value="cok">取消审核</option>
                      <option value="delete">删除选中</option>
                    </select>
                    <button type="submit" class="form_button" id="execute" name="execute" onclick="return confirm('确定要执行吗')">执行</button>
                  </td>
                </tr>
              </tbody>
            </table>
            </form>
            <?php echo page_show_admin($_smarty_tpl->tpl_vars['pager']->value[2],$_smarty_tpl->tpl_vars['pager']->value[3],'page',2);?>

          </div>
        </div>

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
    $('#check_all').click(function(){
      $('input[name="id[]"]:checkbox').attr('checked',true);
    });
    $('#check_none').click(function(){
      $('input[name="id[]"]:checkbox').attr('checked',false);
    });
    $('#check_invert').click(function(){
      $('input[name="id[]"]:checkbox').each(function(){
        this.checked = !this.checked;
      });
    });
    //操作执行验证
    $('#execute').click(function(){
      if ($('#execute_method').val() == ''){
        alert('请选择一项要执行的操作！');
        return false;
      };
      if ($('input[name="id[]"]').val() = ''){
        alert('请至少选择一项！');
        return false;
      };
    });
  });
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
