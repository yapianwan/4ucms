<?php
$privilege = 'slideshow';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $s_name = $_POST['s_name'];
  $s_parent = $_POST[LIB_SPARENT];
  $s_picture = $_POST['s_picture'];
  $s_link = $_POST['s_link'];
  $s_order = $_POST['s_order'];

  null_back($s_picture,'图片不能为空');
  non_numeric_back($s_order,'排序必须是数字!');

  $sql = "UPDATE cms_slideshow SET s_name='" . $s_name . "',s_parent='" . $s_parent . "',s_picture='" . $s_picture . "',s_link='" . $s_link . "',s_order=" . $s_order . " WHERE id = " . $_GET['id'];
  if ($db->query($sql)) {
    admin_log('幻灯编辑',$_COOKIE['admin_id']);
    alert_href('保存成功!','cms_slideshow.php');
  } else {
    alert_back('保存失败!');
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
        <?php
        $res = $db->getRow("SELECT * FROM cms_slideshow WHERE id = " . $_GET['id']);
        if ($row = $res) {
        ?>
        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">编辑幻灯<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="s_name">幻灯名称</label>
                 <input id="s_name" type="text" name="s_name" value="<?php echo $row['s_name']; ?>">
              </div>
              <div class="am-fomr-group">
                <label for="s_parent">属于</label>
                <select name="s_parent">
                  <option value="global" <?php echo $row[LIB_SPARENT] == 'global' ? LIB_SELECTED : '';?>>全局</option>
                  <option value="mobile" <?php echo $row[LIB_SPARENT] == 'mobile' ? LIB_SELECTED : '';?>>手机端</option>
                  <option value="index" <?php echo $row[LIB_SPARENT] == 'index' ? LIB_SELECTED : '';?>>首页</option>
                  <?php echo channel_select_list(0,0,$row[LIB_SPARENT],0);?>
                </select>
              </div>
              <div class="am-form-group">
                <label for="s_picture">幻灯图片</label>
                <div class="am-input-group">
                  <input name="s_picture" type="text" id="s_picture" class="am-form-field" value="<?php echo $row['s_picture']?>">
                  <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default" id="s_picture_upload" type="button">选择图片</button>
                  </span>
                </div>
              </div>
              <div class="am-form-group">
                <label for="s_link">链接地址</label>
                 <input id="s_link" type="text" name="s_link" value="<?php echo $row['s_link']?>">
              </div>
              <div class="am-form-group">
                <label for="s_order">排序</label>
                 <input id="s_order" type="text" name="s_order" value="100" value="<?php echo $row['s_order']?>">
              </div>
              <center>
                <button type="submit" name="submit" id="save" class="am-btn am-btn-default">提交保存</button>
              </center>
            </main>
          </form>
        </section>
        <?php  } ?>
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

    if($('#s_picture').val() == ''){
      alert('图片不能为空');
      $('#s_picture_upload').focus();
      return false;
    }
    if (isNaN($('#s_order').val()) || $('#s_order').val() == '') {
      alert('排序必须是数字');
      $('#s_order').focus();
      return false;
    }
  });
});
KindEditor.ready(function(K) {
  var editor = K.editor({allowFileManager : true});
  K('#s_picture_upload').click(function() {
    editor.loadPlugin('image', function() {
      editor.plugin.imageDialog({
      imageUrl : K('#s_picture').val(),
      clickFn : function(url, title, width, height, border, align) {
        K('#s_picture').val(url);
        editor.hideDialog();
        }
      });
    });
  });
});
</script>
</body>
</html>