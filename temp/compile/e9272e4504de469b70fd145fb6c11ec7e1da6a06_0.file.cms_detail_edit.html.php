<?php
/* Smarty version 3.1.30, created on 2016-10-19 13:12:33
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_detail_edit.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580700c1efd616_36299349',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9272e4504de469b70fd145fb6c11ec7e1da6a06' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_detail_edit.html',
      1 => 1476853952,
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
function content_580700c1efd616_36299349 (Smarty_Internal_Template $_smarty_tpl) {
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">编辑详情<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">

              <div class="am-tabs am-margin" data-am-tabs>
                <ul class="am-tabs-nav am-nav am-nav-tabs">
                  <li class="am-active"><a href="#tab1">基本</a></li>
                  <li><a href="#tab2">附属</a></li>
                  <li><a href="#tab3">SEO</a></li>
                </ul>
                <div class="am-tabs-bd">
                  <section class="am-tab-panel am-fade am-in am-active" id="tab1">
                    <div class="am-form-group">
                      <label for="d_name">内容名称</label>
                       <input id="d_name" type="text" name="d_name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['res']->value['d_name']);?>
">
                    </div>
                    <div class="am-form-group">
                      <label for="d_parent">所属频道</label>
                       <select id="d_parent" name="d_parent">
                        <option value="">请选择所属频道</option>
                        <?php echo $_smarty_tpl->tpl_vars['channel_select_list']->value;?>

                      </select>
                    </div>
                    <div class="am-form-group">
                      <label>推荐</label>
                      <div>
                        <label class="am-btn am-btn-default">
                          <input type="radio" name="d_rec" value="1" <?php if ($_smarty_tpl->tpl_vars['res']->value['d_rec'] == 1) {
echo @constant('LIB_CHECKED');
}?>/> 是
                        </label>
                        <label class="am-btn am-btn-default">
                          <input type="radio" name="d_rec" value="0" <?php if ($_smarty_tpl->tpl_vars['res']->value['d_rec'] == 0) {
echo @constant('LIB_CHECKED');
}?> /> 否
                        </label>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label>热门</label>
                      <div>
                        <label class="am-btn am-btn-default">
                          <input type="radio" name="d_hot" value="1" <?php if ($_smarty_tpl->tpl_vars['res']->value['d_hot'] == 1) {
echo @constant('LIB_CHECKED');
}?>/> 是
                        </label>
                        <label class="am-btn am-btn-default">
                          <input type="radio" name="d_hot" value="0" <?php if ($_smarty_tpl->tpl_vars['res']->value['d_hot'] == 0) {
echo @constant('LIB_CHECKED');
}?> /> 否
                        </label>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label for="d_price">价格</label>
                       <input id="d_price" type="text" name="d_price" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['d_price'];?>
">
                    </div>
                    <div class="am-form-group">
                      <label for="d_tag">标签</label>
                       <input id="d_tag" type="text" name="d_tag" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['d_tag'];?>
">
                    </div>
                    <div class="am-form-group">
                      <label for="d_content">详细介绍</label>
                       <textarea id="d_content" name="d_content"><?php echo stripslashes($_smarty_tpl->tpl_vars['res']->value['d_content']);?>
</textarea>
                    </div>
                    <div class="am-form-group">
                      <label for="d_scontent">简短介绍</label>
                       <textarea id="d_scontent" name="d_scontent"><?php echo stripslashes($_smarty_tpl->tpl_vars['res']->value['d_scontent']);?>
</textarea>
                    </div>
                    <div class="am-form-group">
                      <label for="d_source">来源</label>
                       <input id="d_source" type="text" name="d_source" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['d_source'];?>
">
                    </div>
                    <div class="am-form-group">
                      <label for="d_author">作者</label>
                       <input id="d_author" type="text" name="d_author" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['d_author'];?>
">
                    </div>
                    <div class="am-form-group">
                      <label for="d_date">添加日期</label>
                       <input id="d_date" type="text" name="d_date" value="<?php echo local_date('Y-m-d H:i:s',gmtime());?>
" data-am-datepicker>
                    </div>
                    <div class="am-form-group">
                      <label for="d_order">排序</label>
                       <input id="d_order" type="text" name="d_order" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['d_order'];?>
">
                       <p class="am-form-help">数字越小排列越靠前</p>
                    </div>
                  </section>

                  <section class="am-tab-panel am-fade" id="tab2">
                    <div class="am-form-group">
                      <label for="d_picture">图片标题</label>
                      <div class="am-input-group">
                        <input name="d_picture" type="text" id="d_picture" class="am-form-field" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['d_picture'];?>
">
                        <span class="am-input-group-btn">
                          <button class="am-btn am-btn-default" id="d_picture_upload" type="button">选择图片</button>
                        </span>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label for="d_slideshow">组图</label>
                      <div class="am-input-group">
                        <input type="text" name="d_slideshow" id="d_slideshow" class="am-form-field" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['d_slideshow'];?>
">
                        <span class="am-input-group-btn">    
                          <button class="am-btn am-btn-default" id="d_slideshow_upload" type="button">选择图片</button>
                        </span>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label for="d_attachment">附件</label>
                      <div class="am-input-group">
                        <input name="d_attachment" type="text" id="d_attachment" class="am-form-field" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['d_attachment'];?>
">
                        <span class="am-input-group-btn">
                          <button class="am-btn am-btn-default" id="d_attachment_upload" type="button">选择图片</button>
                        </span>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label>视频</label>
                      <div class="am-input-group">
                        <input name="d_video" type="text" id="d_video" class="am-form-field" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['d_video'];?>
">
                        <span class="am-input-group-btn">
                          <button class="am-btn am-btn-default" id="d_video_upload" type="button">选择图片</button>
                        </span>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label for="d_link">外部链接</label>
                       <input id="d_link" type="text" name="d_link" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['d_link'];?>
">
                      <p class="am-form-help">填写后会自动跳转到指定的地址</p>
                    </div>
                    <div class="am-form-group">
                      <label for="d_point">积分</label>
                       <input id="d_point" type="text" name="d_point" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['d_point'];?>
">
                    </div>
                  </section>

                  <section class="am-tab-panel am-fade" id="tab3">
                    <div class="am-form-group">
                      <label for="d_seoname">优化标题</label>
                       <input id="d_seoname" type="text" name="d_seoname" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['d_seoname'];?>
">
                    </div>
                    <div class="am-form-group">
                      <label for="d_keywords">关键字</label>
                       <textarea id="d_keywords" type="text" name="d_keywords"><?php echo $_smarty_tpl->tpl_vars['res']->value['d_keywords'];?>
</textarea>
                    </div>
                    <div class="am-form-group">
                      <label for="d_description">关键描述</label>
                       <textarea id="d_description" type="text" name="d_description"><?php echo $_smarty_tpl->tpl_vars['res']->value['d_description'];?>
</textarea>
                    </div>
                  </section>
                </div>
              </div>

              <center>
              <button type="submit" name="submit" id="save" class="am-btn am-btn-default">提交保存</button>
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
  $('.form-datetime').datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});

  $('#save').click(function(){
    if($('#d_name').val() == ''){
      alert('详情名称不能为空');
      $('#d_name').focus();
      return false;
    }
    if($('#d_parent').val() == ''){
      alert('请选择上级频道');
      $('#d_parent').focus();
      return false;
    }
    if (isNaN($('#d_order').val()) || $('#d_order').val() == '') {
      alert('排序必须是数字');
      $('#d_order').focus();
      return false;
    }
    if (isNaN($('#d_point').val()) || $('#d_point').val() == '') {
      alert('积分必须是数字');
      $('#d_point').focus();
      return false;
    }
  });
});
KindEditor.ready(function(K) {
  K.create('#d_content',{allowFileManager : true});
  K.create('#d_scontent',{allowFileManager : true});
  var editor = K.editor({allowFileManager : true});
  K('#d_picture_upload').click(function() {
    editor.loadPlugin('image', function() {
      editor.plugin.imageDialog({
      imageUrl : K('#d_picture').val(),
      clickFn : function(url, title, width, height, border, align) {
        K('#d_picture').val(url);
        editor.hideDialog();
        }
      });
    });
  });
  K('#d_slideshow_upload').click(function() {
    editor.loadPlugin('multiimage', function() {
      editor.plugin.multiImageDialog({
        clickFn : function(urlList) {
          var tem_val = '';
          var tem_s = '';
          K.each(urlList, function(i, data) {
            tem_val = tem_val + tem_s + data.url;
            tem_s = '|';
          });
          K('#d_slideshow').val(tem_val);
          editor.hideDialog();
        }
      });
    });
  });
  K('#d_attachment_upload').click(function() {
    editor.loadPlugin('insertfile', function() {
      editor.plugin.fileDialog({
        fileUrl : K('#d_attachment').val(),
        clickFn : function(url, title) {
          K('#d_attachment').val(url);
          editor.hideDialog();
        }
      });
    });
  });
});
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
