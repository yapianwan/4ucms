<?php
$privilege = 'im';
include '../library/inc.php';
include 'cms_check.php';
if(isset($_POST['submit'])){
  $s_name = $_POST['s_name'];
  $s_type = $_POST[LIB_STYPE];
  $s_account = $_POST['s_account'];
  $s_order = $_POST['s_order'];
  null_back($s_name,'请填写客服名称');
  null_back($s_account,'请填写客服帐号');
  non_numeric_back($s_order,'排序必须是数字!');
  $sql = "UPDATE cms_service SET s_name='".$s_name."',s_type='".$s_type."',s_account='".$s_account."',s_order=".$s_order." WHERE id=".$_GET['id'];
  if($db->query($sql)){
    admin_log('客服编辑',$_COOKIE['admin_id']);
    alert_href('修改成功!','cms_service.php');
  }else
  {
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
        <?php
        $res = $db->getRow("SELECT * FROM cms_service WHERE id = ".$_GET['id']);
        if ($row = $res) {
        ?>
        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">编辑客服<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-1">
              <div class="am-form-group">
                <label for="s_name">客服名称</label>
                <input id="s_name" type="text" name="s_name" value="<?php echo $row['s_name']; ?>">
              </div>
              <div class="am-form-group">
                <label for="s_type">客服类型</label>
                <select name="s_type" id="s_type">
                  <option value="1" <?php echo $row[LIB_STYPE] == '1' ? LIB_SELECTED :'';?>>腾讯QQ</option>
                  <option value="2" <?php echo $row[LIB_STYPE] == '2' ? LIB_SELECTED :'';?>>淘宝旺旺</option>
                  <option value="3" <?php echo $row[LIB_STYPE] == '3' ? LIB_SELECTED :'';?>>阿里旺旺</option>
                  <option value="4" <?php echo $row[LIB_STYPE] == '4' ? LIB_SELECTED :'';?>>微软MSN</option>
                  <option value="5" <?php echo $row[LIB_STYPE] == '5' ? LIB_SELECTED :'';?>>skype</option>
                </select>
              </div>
              <div class="am-form-group">
                <label for="s_account">客服帐号</label>
                <input id="s_account" type="text" name="s_account" value="<?php echo $row['s_account']; ?>">
              </div>
              <div class="am-form-group">
                <label for="s_order">排序</label>
                <input id="s_order" type="text" name="s_order" value="<?php echo $row['s_order']; ?>">
              </div>
              <center>
                <button type="submit" name="submit" class="am-btn am-btn-default">提交保存</button>
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
    if ($('#s_name').val() == ''){
      alert('请填写客服名称');
      $('#s_name').focus();
      return false;
    }  
    if ($('#s_account').val() == ''){
      alert('请填写客服帐号');
      $('#s_account').focus();
      return false;
    }
    if (isNaN($('#s_order').val()) || $('#s_order').val() == '') {
      alert('排序必须是数字');
      $('#s_order').focus();
      return false;
    }
  });
});
</script>
</body>
</html>