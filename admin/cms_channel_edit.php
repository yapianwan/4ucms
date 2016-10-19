<?php
$privilege = 'c' . $_GET['id'];
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  @($c_name = $_POST['c_name']);
  @($c_ifpicture = !empty($c_picture) ? 1 : 0);
  @($c_picture = $_POST['c_picture']);
  @($c_parent = $_POST['c_parent']);
  @($c_cmodel = $_POST[LIB_CCMDL]);
  @($c_dmodel = $_POST[LIB_CDMDL]);
  @($c_rec = $_POST[LIB_CREC]);
  @($c_content = $_POST['c_content']);
  @($c_scontent = $_POST['c_scontent']);
  @($c_page = $_POST['c_page']);
  @($c_seoname = $_POST['c_seoname']);
  @($c_keywords = $_POST['c_keywords']);
  @($c_description = $_POST['c_description']);
  @($c_navigation = $_POST[LIB_CNAV]);
  @($c_nname = $_POST['c_nname']);
  @($c_link = $_POST['c_link']);
  @($c_sname = $_POST['c_sname']);
  @($c_aname = $_POST['c_aname']);
  @($c_ifcover = !empty($c_cover) ? 1 : 0);
  @($c_cover = $_POST['c_cover']);
  @($c_ifslideshow = !empty($c_ifslideshow) ? 1 : 0);
  @($c_slideshow = $_POST['c_slideshow']);
  @($c_target = $_POST[LIB_CTARGET]);
  @($c_safe = $_POST[LIB_CSAFE]);
  @($c_order = $_POST['c_order']);

  null_back($c_name, '请填写频道名称');
  n_back($c_parent, '请选择上级频道');
  null_back($c_cmodel, '请选择或填写频道模型');
  null_back($c_dmodel, '请选择或填写详情模型');
  non_numeric_back($c_page, '分页条数必须是数字');
  non_numeric_back($c_order, '排序必须是数字');
  
  $sql = "UPDATE cms_channel SET c_name='" . $c_name . "',c_ifpicture='" . $c_ifpicture . "',c_picture = '" . $c_picture . "',c_parent='" . $c_parent . "',c_cmodel='" . $c_cmodel . "',c_dmodel='" . $c_dmodel . "',c_rec='" . $c_rec . "',c_content='" . $c_content . "',c_scontent='" . $c_scontent . "',c_page='" . $c_page . "',c_seoname='" . $c_seoname . "',c_keywords='" . $c_keywords . "',c_description='" . $c_description . "',c_navigation='" . $c_navigation . "',c_nname='" . $c_nname . "',c_link='" . $c_link . "',c_sname='" . $c_sname . "',c_aname='" . $c_aname . "',c_ifcover='" . $c_ifcover . "',c_cover='" . $c_cover . "',c_ifslideshow='" . $c_ifslideshow . "',c_slideshow='" . $c_slideshow . "',c_target='" . $c_target . "',c_safe='" . $c_safe . "',c_order='" . $c_order . "' WHERE id= '" . $_GET['id'] . "'";
  if ($db->query($sql)) {
    admin_log('频道编辑', $_COOKIE['admin_id']);
    alert_href('修改成功!', 'cms_channel.php');
  } else {
    alert_back('修改失败!');
  }
}
?>
<!DOCTYPE html>
<html class="no-js fixed-layout">
<head>
<?php include 'inc_head.php';?>
</head>

<body>
<?php include 'inc_header.php';?>

<div class="am-cf admin-main">
  <!-- content start -->
  <div class="admin-content">
    <div class="am-g am-g-fixed">
    <div class="am-u-sm-12 am-padding-top">

    <section class="am-panel am-panel-default">
      <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">编辑频道<span class="am-icon-chevron-down am-fr"></span></header>
      <?php
        $res = $db->getRow("SELECT * FROM cms_channel WHERE id = ".$_GET['id']);
        if ($row = $res) {
      ?>
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
                   <input id="c_name" type="text" name="c_name" value="<?php echo $row['c_name'];?>">
              </div>
              <div class="am-form-group">
                <label for="c_picture">频道图片</label>
                <div class="am-input-group">
                  <input name="c_picture" type="text" id="c_picture" class="am-form-field" value="<?php echo $row['c_picture'];?>">
                  <span class="am-input-group-btn"><button class="am-btn am-btn-default" id="c_picture_upload" type="button">选择图片</button></span>
                </div>
              </div>
              <div class="am-form-group">
                <label for="c_parent">上级频道</label>
                   <select id="c_parent" name="c_parent">
                  <option value="0">作为主频道</option>
                  <?php echo channel_select_list(0,0,$row['c_parent'],$row['id']); ?>
                </select>
              </div>
              <div class="am-form-group">
                <label for="c_cmodel">频道模型</label>
                <select onChange="c_cmodel.value=this.value">
                  <option value="">选择</option>
                  <?php echo channel_model_select_list($row[LIB_CCMDL])?>
                </select>
                <input id="c_cmodel" type="text" name="c_cmodel" value="<?php echo $row[LIB_CCMDL];?>" />
              </div>
              <div class="am-form-group">
                <label for="c_dmodel">内容模型</label>
                <select onChange="c_dmodel.value=this.value">
                  <option value="">选择</option>
                  <?php echo detail_model_select_list($row[LIB_CDMDL]); ?>
                </select>
                <input id="c_dmodel" type="text" name="c_dmodel" value="<?php echo $row[LIB_CDMDL];?>" />
              </div>
              <div class="am-form-group">
                <label>推荐</label>
                <div>
                  <label class="am-btn am-btn-default">
                    <input type="radio" name="c_rec" value="1" <?php echo $row[LIB_CREC] ==1 ? LIB_CHECKED : '';?>/> 是
                  </label>
                  <label class="am-btn am-btn-default">
                    <input type="radio" name="c_rec" value="0" <?php echo $row[LIB_CREC] ==0 ? LIB_CHECKED : '';?> /> 否
                  </label>
                </div>
                </div>
              <div class="am-form-group">
                <label for="c_content">详细介绍</label>
                <textarea id="c_content" name="c_content"><?php echo htmlspecialchars(stripslashes($row['c_content']));?></textarea>
              </div>
              <div class="am-form-group">
                <label for="c_scontent">简短介绍</label>
                <textarea id="c_scontent" name="c_scontent"><?php echo htmlspecialchars(stripslashes($row['c_scontent']));?></textarea>
              </div>
              <div class="am-form-group">
                <label for="c_page">分页条数</label>
                <input id="c_page" type="text" name="c_page" value="<?php echo $row['c_page'];?>">
              </div>
              <div class="am-form-group">
                <label for="c_order">排序</label>
                <input id="c_order" type="text" name="c_order" value="<?php echo $row['c_order'];?>">
                <p class="am-form-help">数字越小排列越靠前</p>
              </div>
            </section>
            
            <section class="am-tab-panel am-fade" id="tab2">
              <div class="am-form-group">
                <label for="">导航显示</label>
                <div>
                  <label class="am-btn am-btn-default <?php echo $row[LIB_CNAV]==1 ? LIB_CLSACT : '';?>">
                  <input type="radio" name="c_navigation" value="1" <?php echo $row[LIB_CNAV] == 1 ? LIB_CHECKED : '';?>/> 是
                  </label>
                  <label class="am-btn am-btn-default <?php echo $row[LIB_CNAV]==0 ? LIB_CLSACT : '';?>">
                    <input type="radio" name="c_navigation" value="0" <?php echo $row[LIB_CNAV] == 0 ? LIB_CHECKED : '';?>/> 否
                  </label>
                </div>
              </div>
              <div class="am-form-group">
                <label for="c_nname">导航名称</label>
                <input id="c_nname" type="text" name="c_nname" value="<?php echo $row['c_nname'];?>">
                <p class="am-form-help">留空后自动获取频道名称</p>
              </div>
              <div class="am-form-group">
                <label for="c_link">链接地址</label>
                <input id="c_link" type="text" name="c_link" value="<?php echo $row['c_link'];?>">
                <p class="am-form-help">填写后会自动跳转到指定的地址</p>
              </div>
              <div class="am-form-group">
                <label for="c_sname">简短名称</label>
                <input id="c_sname" type="text" name="c_sname" value="<?php echo $row['c_sname'];?>" />
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
                <input id="c_aname" type="text" name="c_aname" value="<?php echo $row['c_aname'];?>">
              </div>
              <div class="am-form-group">
                <label for="">频道封面</label>
                <div class="am-input-group">
                  <input name="c_cover" type="text" id="c_cover" class="am-form-field" value="<?php echo $row['c_cover'];?>">
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
                  <label class="am-btn am-btn-default <?php echo $row[LIB_CTARGET] == '_blank' ? LIB_CLSACT : '';?>">
                  <input type="radio" name="c_target" value="_blank" <?php echo $row[LIB_CTARGET] == '_blank' ? LIB_CHECKED : '';?>/> 新窗口
                  </label>
                  <label class="am-btn am-btn-default <?php echo $row[LIB_CTARGET]=='_self' ? LIB_CLSACT : '';?>">
                  <input type="radio" name="c_target" value="_self" <?php echo $row[LIB_CTARGET] == '_self' ? LIB_CHECKED : '';?>/> 本窗口
                  </label>
                </div>
              </div>
              <div class="am-form-group">
                <label for="">安全保护</label>
                <div>
                  <label class="am-btn am-btn-default <?php echo $row[LIB_CSAFE]==1 ? LIB_CLSACT : '';?>">
                  <input type="radio" name="c_safe" value="1" <?php echo $row[LIB_CSAFE]==1 ? LIB_CHECKED : '';?>/> 是
                  </label>
                  <label class="am-btn am-btn-default <?php echo $row[LIB_CSAFE]==0 ? LIB_CLSACT : '';?>">
                  <input type="radio" name="c_safe" value="0" <?php echo $row[LIB_CSAFE]==0 ? LIB_CHECKED : '';?>/> 否
                  </label>
                </div>
              </div>
              </section>

              <section class="am-tab-panel am-fade" id="tab3">
              <div class="am-form-group">
                <label for="c_seoname">优化标题</label>
                <input id="c_seoname" type="text" name="c_seoname" value="<?php echo $row['c_seoname'];?>">
              </div>
              <div class="am-form-group">
                <label for="c_keywords">关键字</label>
                <textarea id="c_keywords" type="text" name="c_keywords"><?php echo $row['c_keywords'];?></textarea>
              </div>
              <div class="am-form-group">
                <label for="c_description">关键描述</label>
                <textarea id="c_description" type="text" name="c_description"><?php echo $row['c_description'];?></textarea>
              </div>
            </section>
          </div>
        </div>
        <center><button type="submit" name="submit" id="save" class="am-btn am-btn-primar">提交保存</button></center>
      </main>
    </form>
<?php } ?>
    </section>

  </div>
  </div>
</div>
<!-- content end -->
</div>
<?php include 'inc_footer.php';?>
<!-- js -->
<script type="text/javascript">
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
</script>
</body>
</html>