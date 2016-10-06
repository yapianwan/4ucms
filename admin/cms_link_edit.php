<?php
$privilege = 'link';
include '../library/inc.php';
include 'cms_check.php';
if(isset($_POST['submit'])){
  null_back($_POST[LIB_LNAME],'请填写链接名称');
  non_numeric_back($_POST[LIB_LORDER],'排序必须是数字!');
  $data[LIB_LNAME] = $_POST[LIB_LNAME];
  $data[LIB_LPICTURE] = $_POST[LIB_LPICTURE];
  $data[LIB_LURL] = $_POST[LIB_LURL];
  $data[LIB_LORDER] = $_POST[LIB_LORDER];
  $sql = "UPDATE cms_link SET ".arr_update($data)." WHERE id = ".$_GET['id'];
  if($db->query($sql)){
    admin_log('链接编辑',$_COOKIE['admin_id']);
    alert_href('保存成功!','cms_link.php');
  }else{
    alert_back('保存失败!');
  }
}
?>
<!DOCTYPE html>
<html lang="en">
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
        $res = $db->getRow("SELECT * FROM cms_link WHERE id = ".$_GET['id']);
        if($row = $res){
        ?>
        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">编辑链接<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-1">
              <div class="am-form-group">
                <label for="l_name">链接名称</label>
                 <input id="l_name" type="text" name="l_name" value="<?php echo $row[LIB_LNAME]?>">
              </div>
              <div class="am-form-group">
                <label for="l_picture">链接图片</label>
                <div class="am-input-group">
                  <input name="l_picture" type="text" id="l_picture" class="am-form-field" value="<?php echo $row[LIB_LPICTURE]?>">
                  <span class="am-input-group-btn">
                    <button type="button" class="am-btn am-btn-default" id="l_picture_upload">选择图片</button>
                  </span>
                </div>
              </div>
              <div class="am-form-group">
                <label for="l_url">链接地址</label>
                 <input id="l_url" type="text" name="l_url" value="<?php echo $row[LIB_LURL]?>">
              </div>
              <div class="am-form-group">
                <label for="l_order">排序</label>
                 <input id="l_order" type="text" name="l_order" value="<?php echo $row[LIB_LORDER]?>">
              </div>
              <center>
                <button type="submit" name="submit" id="save" class="am-btn am-btn-default">提交保存</button>
                <button type="reset" class="am-btn am-btn-default">放弃保存</button>
              </center>
            </main>
          </form>
        </section>
        <?php } ?>
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
    if ($('#l_name').val() == ''){
      alert('请填写链接名称');
      $('#l_name').focus();
      return false;
    }
    if (isNaN($('#l_order').val()) || $('#l_order').val() == '') {
      alert('排序必须是数字');
      $('#l_order').focus();
      return false;
    }
  });
});
KindEditor.ready(function(K) {
  var editor = K.editor({allowFileManager : true});
  K('#l_picture_upload').click(function() {
    editor.loadPlugin('image', function() {
      editor.plugin.imageDialog({
      imageUrl : K('#l_picture').val(),
      clickFn : function(url, title, width, height, border, align) {
        K('#l_picture').val(url);
        editor.hideDialog();
        }
      });
    });
  });
});
</script>
</body>
</html>