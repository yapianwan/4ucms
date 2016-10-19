<?php
/* Smarty version 3.1.30, created on 2016-10-19 10:40:30
  from "D:\phpfind\WWW\4ucms\templates\admin\cms_channel_edit.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5806dd1eafcef8_69919921',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bca3bc8afc33049babb03f50ecd58fbff43a6b6d' => 
    array (
      0 => 'D:\\phpfind\\WWW\\4ucms\\templates\\admin\\cms_channel_edit.html',
      1 => 1476844828,
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
function content_5806dd1eafcef8_69919921 (Smarty_Internal_Template $_smarty_tpl) {
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
      <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">编辑频道<span class="am-icon-chevron-down am-fr"></span></header>

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
                <label for="c_name">频道名称</label>
                   <input id="c_name" type="text" name="c_name" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_name'];?>
">
              </div>
              <div class="am-form-group">
                <label for="c_picture">频道图片</label>
                <div class="am-input-group">
                  <input name="c_picture" type="text" id="c_picture" class="am-form-field" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_picture'];?>
">
                  <span class="am-input-group-btn"><button class="am-btn am-btn-default" id="c_picture_upload" type="button">选择图片</button></span>
                </div>
              </div>
              <div class="am-form-group">
                <label for="c_parent">上级频道</label>
                   <select id="c_parent" name="c_parent">
                  <option value="0">作为主频道</option>
                  <?php echo $_smarty_tpl->tpl_vars['channel_select_list']->value;?>

                </select>
              </div>
              <div class="am-form-group">
                <label for="c_cmodel">频道模型</label>
                <select onChange="c_cmodel.value=this.value">
                  <option value="">选择</option>
                  <?php echo '<?php ';?>echo channel_model_select_list($res.c_cmodel)<?php echo '?>';?>
                </select>
                <input id="c_cmodel" type="text" name="c_cmodel" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_cmodel'];?>
" />
              </div>
              <div class="am-form-group">
                <label for="c_dmodel">内容模型</label>
                <select onChange="c_dmodel.value=this.value">
                  <option value="">选择</option>
                  <?php echo '<?php ';?>echo detail_model_select_list($res.c_dmodel); <?php echo '?>';?>
                </select>
                <input id="c_dmodel" type="text" name="c_dmodel" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_dmodel'];?>
" />
              </div>
              <div class="am-form-group">
                <label>推荐</label>
                <div>
                  <label class="am-btn am-btn-default">
                    <input type="radio" name="c_rec" value="1" <?php if ($_smarty_tpl->tpl_vars['res']->value['c_rec'] == 1) {
echo @constant('LIB_CHECKED');
}?>/> 是
                  </label>
                  <label class="am-btn am-btn-default">
                    <input type="radio" name="c_rec" value="0" <?php if ($_smarty_tpl->tpl_vars['res']->value['c_rec'] == 0) {
echo @constant('LIB_CHECKED');
}?> /> 否
                  </label>
                </div>
                </div>
              <div class="am-form-group">
                <label for="c_content">详细介绍</label>
                <textarea id="c_content" name="c_content"><?php echo stripslashes($_smarty_tpl->tpl_vars['res']->value['c_content']);?>
</textarea>
              </div>
              <div class="am-form-group">
                <label for="c_scontent">简短介绍</label>
                <textarea id="c_scontent" name="c_scontent"><?php echo stripslashes($_smarty_tpl->tpl_vars['res']->value['c_scontent']);?>
</textarea>
              </div>
              <div class="am-form-group">
                <label for="c_page">分页条数</label>
                <input id="c_page" type="text" name="c_page" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_page'];?>
">
              </div>
              <div class="am-form-group">
                <label for="c_order">排序</label>
                <input id="c_order" type="text" name="c_order" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_order'];?>
">
                <p class="am-form-help">数字越小排列越靠前</p>
              </div>
            </section>
            
            <section class="am-tab-panel am-fade" id="tab2">
              <div class="am-form-group">
                <label for="">导航显示</label>
                <div>
                  <label class="am-btn am-btn-default <?php if ($_smarty_tpl->tpl_vars['res']->value['c_navigation'] == 1) {
echo @constant('LIB_CLSACT');
}?>">
                  <input type="radio" name="c_navigation" value="1" <?php if ($_smarty_tpl->tpl_vars['res']->value['c_navigation'] == 1) {
echo @constant('LIB_CHECKED');
}?>/> 是
                  </label>
                  <label class="am-btn am-btn-default <?php if ($_smarty_tpl->tpl_vars['res']->value['c_navigation'] == 0) {
echo @constant('LIB_CLSACT');
}?>">
                    <input type="radio" name="c_navigation" value="0" <?php if ($_smarty_tpl->tpl_vars['res']->value['c_navigation'] == 0) {
echo @constant('LIB_CHECKED');
}?>/> 否
                  </label>
                </div>
              </div>
              <div class="am-form-group">
                <label for="c_nname">导航名称</label>
                <input id="c_nname" type="text" name="c_nname" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_nname'];?>
">
                <p class="am-form-help">留空后自动获取频道名称</p>
              </div>
              <div class="am-form-group">
                <label for="c_link">链接地址</label>
                <input id="c_link" type="text" name="c_link" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_link'];?>
">
                <p class="am-form-help">填写后会自动跳转到指定的地址</p>
              </div>
              <div class="am-form-group">
                <label for="c_sname">简短名称</label>
                <input id="c_sname" type="text" name="c_sname" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_sname'];?>
" />
                  <select onChange="c_sname.value=this.value">
                    <option value="">选择或填写</option>
                    <option value="文章">文章</option>
                    <option value="产品">产品</option>
                    <option value="下载">下载</option>
                    <option value="图片">图片</option>
                    <option value="视频">视频</option>
                  </select>
              </div>
              <div class="am-form-group">
                <label for="c_aname">频道别名</label>
                <input id="c_aname" type="text" name="c_aname" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_aname'];?>
">
              </div>
              <div class="am-form-group">
                <label for="">频道封面</label>
                <div class="am-input-group">
                  <input name="c_cover" type="text" id="c_cover" class="am-form-field" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_cover'];?>
">
                  <span class="am-input-group-btn"><button class="am-btn am-btn-default" id="c_cover_upload" type="button">选择图片</button></span>
                </div>
              </div>
              <div class="am-form-group">
                <label>组图</label>
                <div class="am-input-group">
                  <input name="c_slideshow" type="text" id="c_slideshow" class="am-form-field" value="">
                  <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default" id="c_slideshow_upload" type="button">选择图片</button>
                  </span>
                </div>
              </div>
              <div class="am-form-group">
                <label for="">打开方式</label>
                <div>
                  <label class="am-btn am-btn-default <?php if ($_smarty_tpl->tpl_vars['res']->value['c_target'] == '_blank') {
echo @constant('LIB_CLSACT');
}?>">
                  <input type="radio" name="c_target" value="_blank" <?php if ($_smarty_tpl->tpl_vars['res']->value['c_target'] == '_blank') {
echo @constant('LIB_CHECKED');
}?>/> 新窗口
                  </label>
                  <label class="am-btn am-btn-default <?php if ($_smarty_tpl->tpl_vars['res']->value['c_target'] == '_self') {
echo @constant('LIB_CLSACT');
}?>">
                  <input type="radio" name="c_target" value="_self" <?php if ($_smarty_tpl->tpl_vars['res']->value['c_target'] == '_self') {
echo @constant('LIB_CHECKED');
}?>/> 本窗口
                  </label>
                </div>
              </div>
              <div class="am-form-group">
                <label for="">安全保护</label>
                <div>
                  <label class="am-btn am-btn-default <?php if ($_smarty_tpl->tpl_vars['res']->value['c_safe'] == 1) {
echo @constant('LIB_CLSACT');
}?>">
                  <input type="radio" name="c_safe" value="1" <?php if ($_smarty_tpl->tpl_vars['res']->value['c_safe'] == 1) {
echo @constant('LIB_CHECKED');
}?>/> 是
                  </label>
                  <label class="am-btn am-btn-default <?php if ($_smarty_tpl->tpl_vars['res']->value['c_safe'] == 0) {
echo @constant('LIB_CLSACT');
}?>">
                  <input type="radio" name="c_safe" value="0" <?php if ($_smarty_tpl->tpl_vars['res']->value['c_safe'] == 0) {
echo @constant('LIB_CHECKED');
}?>/> 否
                  </label>
                </div>
              </div>
              </section>

              <section class="am-tab-panel am-fade" id="tab3">
              <div class="am-form-group">
                <label for="c_seoname">优化标题</label>
                <input id="c_seoname" type="text" name="c_seoname" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['c_seoname'];?>
">
              </div>
              <div class="am-form-group">
                <label for="c_keywords">关键字</label>
                <textarea id="c_keywords" type="text" name="c_keywords"><?php echo $_smarty_tpl->tpl_vars['res']->value['c_keywords'];?>
</textarea>
              </div>
              <div class="am-form-group">
                <label for="c_description">关键描述</label>
                <textarea id="c_description" type="text" name="c_description"><?php echo $_smarty_tpl->tpl_vars['res']->value['c_description'];?>
</textarea>
              </div>
            </section>
          </div>
        </div>
        <center><button type="submit" name="submit" id="save" class="am-btn am-btn-primar">提交保存</button></center>
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
    if ($('#c_name').val() == '') {
      alert('请填写频道名称');
      $('#c_name').focus();
      return false;
    }
    if ($('#c_parent').val() == '') {
      alert('请选择上级频道');
      $('#c_parent').focus();
      return false;
    }
    if ($('#c_cmodel').val() == '') {
      alert('请选择或填写频道模型');
      $('#c_cmodel').focus();
      return false;
    }
    if ($('#c_dmodel').val() == '') {
      alert('请选择或填写详情模型');
      $('#c_dmodel').focus();
      return false;
    }
    if (isNaN($('#c_page').val()) || $('#c_page').val() == '') {
      alert('分页条数必须是数字');
      $('#c_page').focus();
      return false;
    }
    if (isNaN($('#c_order').val()) || $('#c_order').val() == '') {
      alert('排序必须是数字');
      $('#c_order').focus();
      return false;
    }
  });
});
KindEditor.ready(function(K) {
  K.create('#c_content',{allowFileManager : true});
  K.create('#c_scontent',{allowFileManager : true});
  var editor = K.editor({allowFileManager : true});
  K('#c_picture_upload').click(function() {
    editor.loadPlugin('image', function() {
      editor.plugin.imageDialog({
      imageUrl : K('#c_picture').val(),
      clickFn : function(url, title, width, height, border, align) {
        K('#c_picture').val(url);
        editor.hideDialog();
        }
      });
    });
  });
  K('#c_cover_upload').click(function() {
    editor.loadPlugin('image', function() {
      editor.plugin.imageDialog({
      imageUrl : K('#c_cover').val(),
      clickFn : function(url, title, width, height, border, align) {
        K('#c_cover').val(url);
        editor.hideDialog();
        }
      });
    });
  });
  K('#c_slideshow_upload').click(function() {
    editor.loadPlugin('multiimage', function() {
      editor.plugin.multiImageDialog({
        clickFn : function(urlList) {
          var tem_val = '';
          var tem_s = '';
          K.each(urlList, function(i, data) {
            tem_val = tem_val + tem_s + data.url;
            tem_s = '|';
          });
          K('#c_slideshow').val(tem_val);
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
