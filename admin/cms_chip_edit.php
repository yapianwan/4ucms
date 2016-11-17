<?php
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $c_code = $_POST['c_code'];
  $c_name = $_POST['c_name'];
  $c_content = $_POST['c_content'];
  $c_safe = $_POST[LIB_CSAFE];
  null_back($c_name,'请填写碎片名称！');
  $sql = "UPDATE cms_chip SET c_code='" . $c_code . "',c_name='" . $c_name . "',c_content='" . $c_content . "',c_safe=" . $c_safe . " WHERE id = " . $_GET['id'];
  if ($db->query($sql)) {
    admin_log('碎片编辑',$_COOKIE['admin_id']);
    alert_href('保存成功!','cms_chip.php');
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

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">编辑碎片<span class="am-icon-chevron-down am-fr"></span></header>
          <?php
          $res = $db->getRow("SELECT * FROM cms_chip WHERE id = " . $_GET['id']);
          if ($row = $res) {
          ?>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="c_name">碎片名称</label>
                 <input id="c_name" type="text" name="c_name" value="<?php echo $row['c_name']?>">
              </div>
              <div class="am-form-group">
                <label for="c_code">调用代码</label>
                 <input id="c_code" type="text" name="c_code" value="<?php echo $row['c_code']?>">
              </div>
              <div class="am-form-group">
                <label for="c_content">碎片内容</label>
                 <textarea id="c_content" name="c_content"><?php echo htmlspecialchars(stripslashes($row['c_content']))?></textarea>
              </div>
              <div class="am-form-group">
                <label for="">安全保护</label>
                <div>
                  <label class="am-btn am-btn-default <?php echo $row[LIB_CSAFE]?'am-active':'';?>">
                    <input type="radio" name="c_safe" value="1" <?php echo $row[LIB_CSAFE]?'checked="checked"':'';?>/> 是
                  </label>
                  <label class="am-btn am-btn-default">
                    <input type="radio" name="c_safe" value="0" <?php echo $row[LIB_CSAFE] == 0?'checked="checked"':'';?>/> 否
                  </label>
                </div>
              </div>
              <center>
                <button type="submit" name="submit" id="save" class="am-btn am-btn-default">提交保存</button>
              </center>
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
      if ($('#c_name').val() == ''){
        alert('请填写碎片名称');
        $('#c_name').focus();
        return false;
      }
    });
  });
  KindEditor.ready(function(K) {
    K.create('#c_content',{allowFileManager : true, width:'100%'});
  });
</script>
</body>
</html>