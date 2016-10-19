<?php
$privilege = 'detail';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $d_name = $_POST['d_name'];
  $d_picture = $_POST['d_picture'];
  $d_ifpicture = !empty($d_picture) ? 1 : 0;
  $d_parent = $_POST['d_parent'];
  $d_rec = $_POST[LIB_DREC];
  $d_hot = $_POST[LIB_DHOT];
  $d_price = $_POST['d_price'];
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
  $d_tag = $_POST['d_tag'];

  null_back($d_name,'详情名称不能为空');
  non_numeric_back($d_order,'排序必须是数字!');

  $sql = "UPDATE cms_detail SET d_name='" . $d_name . "',d_fname='" . $d_fname . "',d_ifpicture=" . $d_ifpicture . ",d_picture = '" . $d_picture . "',d_parent=" . $d_parent . ",d_rec=" . $d_rec . ",d_hot=" . $d_hot . ",d_price=" . $d_price . ",d_ifslideshow=" . $d_ifslideshow . ",d_slideshow='" . $d_slideshow . "',d_content='" . $d_content . "',d_scontent='" . $d_scontent . "',d_seoname='" . $d_seoname . "',d_keywords='" . $d_keywords . "',d_description='" . $d_description . "',d_link='" . $d_link . "',d_order=" . $d_order . ",d_source='" . $d_source . "',d_author='" . $d_author . "',d_ifvideo=" . $d_ifvideo . ",d_video='" . $d_video . "',d_ifattachment=" . $d_ifattachment . ",d_attachment='" . $d_attachment . "',d_point='" . $d_point . "',d_tag='" . $d_tag . "',d_date='" . $d_date . "' WHERE id = " . $_GET['id'];
  if ($db->query($sql)) {
    admin_log('信息编辑',$_COOKIE['admin_id']);
    alert_href('修改成功!','cms_detail.php?cid=0');
  } else {
    alert_back('修改失败!');
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">编辑详情<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <?php
                $res = $db->getRow("SELECT * FROM cms_detail WHERE id = ".$_GET['id']);
                if($row = $res){
              ?>
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
                       <input id="d_name" type="text" name="d_name" value="<?php echo htmlspecialchars($row['d_name']);?>">
                    </div>
                    <div class="am-form-group">
                      <label for="d_parent">所属频道</label>
                       <select id="d_parent" name="d_parent">
                        <option value="">请选择所属频道</option>
                        <?php echo channel_select_list(0,0,$row['d_parent'],0);?>
                      </select>
                    </div>
                    <div class="am-form-group">
                      <label>推荐</label>
                      <div>
                        <label class="am-btn am-btn-default">
                          <input type="radio" name="d_rec" value="1" <?php echo $row[LIB_DREC] ==1 ? LIB_CHECKED : '';?>/> 是
                        </label>
                        <label class="am-btn am-btn-default">
                          <input type="radio" name="d_rec" value="0" <?php echo $row[LIB_DREC] ==0 ? LIB_CHECKED : '';?> /> 否
                        </label>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label>热门</label>
                      <div>
                        <label class="am-btn am-btn-default">
                          <input type="radio" name="d_hot" value="1" <?php echo $row[LIB_DHOT] ==1 ? LIB_CHECKED : '';?>/> 是
                        </label>
                        <label class="am-btn am-btn-default">
                          <input type="radio" name="d_hot" value="0" <?php echo $row[LIB_DHOT] ==0 ? LIB_CHECKED : '';?> /> 否
                        </label>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label for="d_price">价格</label>
                       <input id="d_price" type="text" name="d_price" value="<?php echo $row['d_price'];?>">
                    </div>
                    <div class="am-form-group">
                      <label for="d_tag">标签</label>
                       <input id="d_tag" type="text" name="d_tag" value="<?php echo $row['d_tag'];?>">
                    </div>
                    <div class="am-form-group">
                      <label for="d_content">详细介绍</label>
                       <textarea id="d_content" name="d_content"><?php echo stripslashes($row['d_content']);?></textarea>
                    </div>
                    <div class="am-form-group">
                      <label for="d_scontent">简短介绍</label>
                       <textarea id="d_scontent" name="d_scontent"><?php echo stripslashes($row['d_scontent']);?></textarea>
                    </div>
                    <div class="am-form-group">
                      <label for="d_source">来源</label>
                       <input id="d_source" type="text" name="d_source" value="<?php echo $row['d_source']?>">
                    </div>
                    <div class="am-form-group">
                      <label for="d_author">作者</label>
                       <input id="d_author" type="text" name="d_author" value="<?php echo $row['d_author']?>">
                    </div>
                    <div class="am-form-group">
                      <label for="d_date">添加日期</label>
                       <input id="d_date" type="text" name="d_date" value="<?php echo local_date('Y-m-d H:i:s',gmtime());?>" data-am-datepicker>
                    </div>
                    <div class="am-form-group">
                      <label for="d_order">排序</label>
                       <input id="d_order" type="text" name="d_order" value="<?php echo $row['d_order'];?>">
                       <p class="am-form-help">数字越小排列越靠前</p>
                    </div>
                  </section>

                  <section class="am-tab-panel am-fade" id="tab2">
                    <div class="am-form-group">
                      <label for="d_picture">图片标题</label>
                      <div class="am-input-group">
                        <input name="d_picture" type="text" id="d_picture" class="am-form-field" value="<?php echo $row['d_picture'];?>">
                        <span class="am-input-group-btn">
                          <button class="am-btn am-btn-default" id="d_picture_upload" type="button">选择图片</button>
                        </span>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label for="d_slideshow">组图</label>
                      <div class="am-input-group">
                        <input type="text" name="d_slideshow" id="d_slideshow" class="am-form-field" value="<?php echo $row['d_slideshow'];?>">
                        <span class="am-input-group-btn">    
                          <button class="am-btn am-btn-default" id="d_slideshow_upload" type="button">选择图片</button>
                        </span>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label for="d_attachment">附件</label>
                      <div class="am-input-group">
                        <input name="d_attachment" type="text" id="d_attachment" class="am-form-field" value="<?php echo $row['d_attachment'];?>">
                        <span class="am-input-group-btn">
                          <button class="am-btn am-btn-default" id="d_attachment_upload" type="button">选择图片</button>
                        </span>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label>视频</label>
                      <div class="am-input-group">
                        <input name="d_video" type="text" id="d_video" class="am-form-field" value="<?php echo $row['d_video'];?>">
                        <span class="am-input-group-btn">
                          <button class="am-btn am-btn-default" id="d_video_upload" type="button">选择图片</button>
                        </span>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label for="d_link">外部链接</label>
                       <input id="d_link" type="text" name="d_link" value="<?php echo $row['d_link'];?>">
                      <p class="am-form-help">填写后会自动跳转到指定的地址</p>
                    </div>
                    <div class="am-form-group">
                      <label for="d_point">积分</label>
                       <input id="d_point" type="text" name="d_point" value="<?php echo $row['d_point'];?>">
                    </div>
                  </section>

                  <section class="am-tab-panel am-fade" id="tab3">
                    <div class="am-form-group">
                      <label for="d_seoname">优化标题</label>
                       <input id="d_seoname" type="text" name="d_seoname" value="<?php echo $row['d_seoname'];?>">
                    </div>
                    <div class="am-form-group">
                      <label for="d_keywords">关键字</label>
                       <textarea id="d_keywords" type="text" name="d_keywords"><?php echo $row['d_keywords'];?></textarea>
                    </div>
                    <div class="am-form-group">
                      <label for="d_description">关键描述</label>
                       <textarea id="d_description" type="text" name="d_description"><?php echo $row['d_description'];?></textarea>
                    </div>
                  </section>
                </div>
              </div>
              <?php } ?>
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