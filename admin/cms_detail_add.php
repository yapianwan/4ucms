<?php
$privilege = 'detail';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $d_name = $_POST['d_name'];
  $d_picture = $_POST['d_picture'];
  $d_ifpicture = !empty($d_picture) ? 1 : 0;
  $d_parent = $_POST['d_parent'];
  $d_rec = $_POST['d_rec'];
  $d_hot = $_POST['d_hot'];
  $d_price = !empty($_POST['d_price']) ? $_POST['d_price'] : 0;
  $d_ifslideshow = !empty($d_slideshow) ? 1 : 0;
  $d_slideshow = $_POST['d_slideshow'];
  $d_ifvideo = !empty($d_video) ? 1 : 0;
  $d_video = $_POST['d_video'];
  $d_ifattachment = !empty($d_attachment) ? 1 : 0;
  $d_attachment = $_POST['d_attachment'];
  $d_content = $_POST['d_content'];
  $d_scontent = $_POST['d_scontent'];
  $d_source = $_POST['d_source'];
  $d_author = $_POST['d_author'];
  $d_seoname = $_POST['d_seoname'];
  $d_keywords = $_POST['d_keywords'];
  $d_description = $_POST['d_description'];
  $d_link = $_POST['d_link'];
  $d_point = $_POST['d_point'];
  $d_date = local_strtotime($_POST['d_date']);
  $d_order = $_POST['d_order'];
  $d_hits = 1;
  $d_tag = $_POST['d_tag'];

  //判断相关数据
  null_back($d_name,'详情名称不能为空');
  null_back($d_parent,'请选择上级频道');
  non_numeric_back($d_order,'排序必须是数字!');
  if ($d_ifpicture == 1) {
    null_back($d_picture,'请填写图片标题');
  }
  if ($d_ifslideshow == 1) {
    null_back($d_slideshow,'请上传组图');
  }
  if ($d_ifattachment == 1) {
    null_back($d_attachment,'请上传附件');
  }
  if ($d_ifvideo == 1) {
    null_back($d_video,'请填写视频');
  }

  $sql = "INSERT INTO cms_detail (`d_name`,`d_fname`,`d_ifpicture`,`d_picture`,`d_parent`,`d_rec`,`d_hot`,`d_price`,`d_ifslideshow`,`d_slideshow`,`d_content`,`d_scontent`,`d_seoname`,`d_keywords`,`d_description`,`d_link`,`d_order`,`d_source`,`d_author`,`d_hits`,`d_ifvideo`,`d_video`,`d_ifattachment`,`d_attachment`,`d_point`,`d_tag`,`d_date`) VALUES ('" . $d_name . "','" . $d_fname . "'," . $d_ifpicture . ",'" . $d_picture . "'," . $d_parent . "," . $d_rec . "," . $d_hot . "," . $d_price . "," . $d_ifslideshow . ",'" . $d_slideshow . "','" . $d_content . "','" . $d_scontent . "','" . $d_seoname . "','" . $d_keywords . "','" . $d_description . "','" . $d_link . "','" . $d_order . "','" . $d_source . "','" . $d_author . "','" . $d_hits . "','" . $d_ifvideo . "','" . $d_video . "','" . $d_ifattachment . "','" . $d_attachment . "','" . $d_point . "','" . $d_tag . "','" . $d_date . "')";
  if ($db->query($sql)) {
    admin_log('信息新增',$_COOKIE['admin_id']);
    alert_href('新增成功!','cms_detail_add.php');
  } else {
    alert_back('新增失败!');
  }
}
?>
<!DOCTYPE html>
<html class="no-js fixed-layout">
<head>
<?php include 'inc_head.php';?>
<link rel="stylesheet" href="<?php echo SITE_DIR;?>js/datetimepicker/css/amazeui.datetimepicker.css">
</head>

<body>
<?php include 'inc_header.php';?>

<div class="am-cf admin-main">
  <!-- content start -->
  <div class="admin-content">
    <div class="am-g am-g-fixed">
      <div class="am-u-sm-12 am-padding-top">

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增详情<span class="am-icon-chevron-down am-fr"></span></header>
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
                       <input id="d_name" type="text" name="d_name">
                    </div>
                    <div class="am-form-group">
                      <label for="d_parent">所属频道</label>
                       <select id="d_parent" name="d_parent">
                        <option value="">请选择上级频道</option>
                        <?php echo isset($cids) ? channel_select_list($cids,0,0,0) : channel_select_list(0,0,0,0); ?>
                      </select>
                    </div>
                    <div class="am-form-group">
                      <label>推荐</label>
                      <div>
                        <label class="am-btn am-btn-default">
                          <input type="radio" name="d_rec" value="1"/> 是
                        </label>
                        <label class="am-btn am-btn-default">
                          <input type="radio" name="d_rec" value="0" checked="checked" /> 否
                        </label>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label>热门</label>
                      <div>
                        <label class="am-btn am-btn-default">
                          <input type="radio" name="d_hot" value="1"/> 是
                        </label>
                        <label class="am-btn am-btn-default">
                          <input type="radio" name="d_hot" value="0" checked="checked" /> 否
                        </label>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label for="d_price">价格</label>
                       <input id="d_price" type="text" name="d_price" value="0">
                    </div>
                    <div class="am-form-group">
                      <label for="d_tag">标签</label>
                       <input id="d_tag" type="text" name="d_tag" value="">
                    </div>
                    <div class="am-form-group">
                      <label for="d_content">详细介绍</label>
                       <textarea id="d_content" name="d_content"></textarea>
                    </div>
                    <div class="am-form-group">
                      <label for="d_scontent">简短介绍</label>
                       <textarea id="d_scontent" name="d_scontent"></textarea>
                    </div>
                    <div class="am-form-group">
                      <label for="d_source">来源</label>
                       <input id="d_source" type="text" name="d_source">
                    </div>
                    <div class="am-form-group">
                      <label for="d_author">作者</label>
                       <input id="d_author" type="text" name="d_author">
                    </div>
                    <div class="am-form-group">
                      <label for="d_date">添加日期</label>
                       <input id="d_date" type="text" name="d_date" value="<?php echo local_date('Y-m-d H:i:s',gmtime());?>" data-am-datepicker>
                    </div>
                    <div class="am-form-group">
                      <label for="d_order">排序</label>
                       <input id="d_order" type="text" name="d_order" value="100">
                       <p class="am-form-help">数字越小排列越靠前</p>
                    </div>
                  </section>

                  <section class="am-tab-panel am-fade" id="tab2">
                    <div class="am-form-group">
                      <label>图片标题</label>
                      <div class="am-input-group">
                        <input name="d_picture" type="text" id="d_picture" class="am-form-field" value="">
                        <span class="am-input-group-btn">
                          <button class="am-btn am-btn-default" id="d_picture_upload" type="button">选择图片</button>
                        </span>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label>组图</label>
                      <div class="am-input-group">
                        <input name="d_slideshow" type="text" id="d_slideshow" class="am-form-field" value="">
                        <span class="am-input-group-btn">
                          <button class="am-btn am-btn-default" id="d_slideshow_upload" type="button">选择图片</button>
                        </span>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label>附件</label>
                      <div class="am-input-group">
                        <input name="d_attachment" type="text" id="d_attachment" class="am-form-field" value="">
                        <span class="am-input-group-btn">
                          <button class="am-btn am-btn-default" id="d_attachment_upload" type="button">选择图片</button>
                        </span>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label>视频</label>
                      <div class="am-input-group">
                        <input name="d_video" type="text" id="d_video" class="am-form-field" value="">
                        <span class="am-input-group-btn">
                          <button class="am-btn am-btn-default" id="d_video_upload" type="button">选择图片</button>
                        </span>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label for="d_link">外部链接</label>
                       <input id="d_link" type="text" name="d_link">
                      <p class="am-form-help">填写后会自动跳转到指定的地址</p>
                    </div>
                    <div class="am-form-group">
                      <label for="d_point">积分</label>
                       <input id="d_point" type="text" name="d_point" value="0">
                    </div>
                  </section>

                  <section class="am-tab-panel am-fade" id="tab3">
                    <div class="am-form-group">
                      <label for="d_seoname">优化标题</label>
                       <input id="d_seoname" type="text" name="d_seoname">
                    </div>
                    <div class="am-form-group">
                      <label for="d_keywords">关键字</label>
                       <textarea id="d_keywords" type="text" name="d_keywords"></textarea>
                    </div>
                    <div class="am-form-group">
                      <label for="d_description">关键描述</label>
                       <textarea id="d_description" type="text" name="d_description"></textarea>
                    </div>
                  </section>
                </div>
              </div>
              <center>
                <button type="submit" name="submit" id="save" class="am-btn">提交保存</button>
                <button type="reset" class="am-btn">放弃保存</button>
              </center>
            </main>
          </form>
        </section>

      </div>
    </div>
  </div>
  <!-- content end -->
</div>

<?php include 'inc_footer.php';?>

<!-- js -->
<script src="<?php echo SITE_DIR;?>js/datetimepicker/amazeui.datetimepicker.min.js"></script>
<script type="text/javascript">
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
</script>
</body>
</html>