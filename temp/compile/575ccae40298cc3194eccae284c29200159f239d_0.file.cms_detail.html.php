<?php
/* Smarty version 3.1.30, created on 2016-10-19 13:34:26
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_detail.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580705e2c047f7_21604316',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '575ccae40298cc3194eccae284c29200159f239d' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_detail.html',
      1 => 1476850395,
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
function content_580705e2c047f7_21604316 (Smarty_Internal_Template $_smarty_tpl) {
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">内容管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <form method="get" class="am-form am-show-sm-up">
              <div class="am-g">
                <div class="am-u-sm-4">
                  <select onchange="location.href='cms_detail.php?cid='+this.options[this.selectedIndex].value;">
                    <option value="0">全部频道</option>
                    <?php echo $_smarty_tpl->tpl_vars['channel_select_list_id']->value;?>

                    <?php if (!empty($_GET['key'])) {?><option selected="selected" >搜索结果</option><?php }?>
                  </select>
                </div>
                <div class="am-u-sm-8">
                  <div class="am-input-group">
                    <input id="key" class="am-form-field" type="text" name="key" placeholder="名称查找" />
                    <span class="am-input-group-btn"><button type="submit" id="search" class="am-btn" name="search">检索</button></span>
                  </div>
                </div>
              </div>
            </form>
            <hr>
            <form action="" method="post">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>选择</th><th>排序</th><th>内容名称</th><th>所属频道</th><th class="am-hide">内容模型</th><th class="am-hide">内容操作</th><th>操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['res']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                <tr>
                  <td><input type="checkbox" name="id[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" /></td>
                  <td><?php echo $_smarty_tpl->tpl_vars['val']->value['d_order'];?>
</td>
                  <td align="left"><a href="../detail.php?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['val']->value['d_name'];?>
</a></td>
                  <td><?php echo get_channel_name($_smarty_tpl->tpl_vars['val']->value['d_parent']);?>
</td>
                  <td class="am-hide">
                    <?php if ($_smarty_tpl->tpl_vars['val']->value['d_rec'] == 1) {?><span class="am-badge am-badge-success">推</span><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['val']->value['d_hot'] == 1) {?><span class="am-badge am-badge-danger">热</span><?php }?>;
                    <?php if ($_smarty_tpl->tpl_vars['val']->value['d_ifslideshow'] == 1) {?><span class="am-badge am-badge-primary">图</span><?php }?>
                    <?php echo '?>';?>
                  </td>
                  <td class="am-hide"><?php echo local_date('Y-m-d',$_smarty_tpl->tpl_vars['val']->value['d_date']);?>
</td>
                  <td><a href="cms_detail_edit.php?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a></td>
                </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

              </tbody>
              <tfoot>
                <tr>
                  <td colspan="3">
                    <input type="button" id="check_all" value="全选" />
                    <input type="button" class="form_button" id="check_none" value="不选" />
                    <input type="button" class="form_button" id="check_invert" value="反选" />
                    <select id="execute_method" name="execute_method">
                      <option value="">请选择操作</option>
                      <option value="srec">设为推荐</option>
                      <option value="crec">取消推荐</option>
                      <option value="shot">设为热门</option>
                      <option value="chot">取消热门</option>
                      <option value="delete">删除选中</option>
                    </select>
                    <input type="submit" id="execute" name="execute" onclick="return confirm('确定要执行吗')" value="执行" />
                  </td>
                  <td colspan="2">
                    <select id="shift_target" name="shift_target" style="width:150px;">
                      <option value="">请选择目标频道</option>
                      <?php echo $_smarty_tpl->tpl_vars['channel_select_list']->value;?>

                    </select>
                    <input type="submit" id="shift" name="shift" onclick="return confirm('确定要转移吗')" value="转移" />
                  </td>
                </tr>
              </tfoot>
            </table>
            </form>
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
  //频道转移验证
  $('#shift').click(function(){
    if ($('#shift_target').val() == ''){
      alert('请选择要转移到的频道！');
      return false;
    };
    if ($('input[name="id[]"]').val() = ''){
      alert('请至少选择一项！');
      return false;
    };
  });
  //搜索验证
  $('#search').click(function(){
    if ($('#key').val() == ''){
      alert('请输入要查找的关键字');
      $('#key').focus();
      return false;
    };
  });
});
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
