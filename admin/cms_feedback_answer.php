<?php
$privilege = 'qa';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $_data[LIB_FBASR] = $_POST[LIB_FBASR];
  $_data['f_adate'] = gmtime();
  $_data['f_ok'] = 1;
  $sql = "UPDATE cms_feedback SET " . arr_update($_data) . " WHERE id = " . $_GET['id'];
  if ($db->query($sql)) {
    alert_href('修改成功!','cms_feedback.php');
  } else {
    alert_back('修改失败!');
  }
}
?>
<!DOCTYPE html>
<html class="no-js fixed-layout">
<head>
<?php include 'inc_head.php';?>
<link rel="stylesheet" href="<?php echo SITE_DIR;?>ui/css/amazeui.datetimepicker.css">
</head>

<body>
<?php include 'inc_header.php';?>

<div class="am-cf admin-main">
  <!-- content start -->
  <div class="admin-content">
    <div class="am-g am-g-fixed">
      <div class="am-u-sm-12 am-padding-top">
        <?php
        $res = $db->getRow("SELECT * FROM cms_feedback WHERE id = " . $_GET['id']);
        if ($row = $res) {
        ?>
        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">回复留言<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-1">
              <table class="am-table am-table-bordered">
                <tr><td class="am-text-right">留言人</td><td><?php echo $row['f_name'];?></td></tr>
                <tr><td class="am-text-right">联系电话</td><td><?php echo $row['f_tel'];?></td></tr>
                <tr><td class="am-text-right">电子邮件</td><td><?php echo $row['f_email'];?></td></tr>
                <tr><td class="am-text-right">留言标题</td><td><?php echo $row['f_title'];?></td></tr>
                <tr><td class="am-text-right">留言内容</td><td><?php echo $row['f_content'];?></td></tr>
                <tr><td class="am-text-right">留言日期</td><td><?php echo local_date('Y-m-d H:i:s',$row['f_date']);?></td></tr>
              </table>
               <div class="am-form-group">
                <label for="f_answer">回复内容</label>
                <textarea name="f_answer" id="f_answer"><?php echo htmlspecialchars(stripslashes($row[LIB_FBASR]))?></textarea>
              </div>
              <center>
                <button type="submit" name="submit" class="am-btn am-btn-default">提交保存</button>
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
KindEditor.ready(function(K) {
  K.create('#f_answer',{allowFileManager : true});
});
</script>
</body>
</html>