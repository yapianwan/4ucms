<?php
$privilege = 'vote';
include '../library/inc.php';
include 'cms_check.php';

$res = $db->getRow("SELECT * FROM cms_vote WHERE id = " . $_GET['id']);

if (isset($_POST['submit'])) {
  $data[LIB_VNAME] = isset($_POST[LIB_VNAME]) ? $_POST[LIB_VNAME] : '';
  $data[LIB_VSTIME] = isset($_POST[LIB_VSTIME]) ? gmstr2time($_POST[LIB_VSTIME]) : '';
  $data[LIB_VETIME] = isset($_POST[LIB_VETIME]) ? gmstr2time($_POST[LIB_VETIME]) : '';
  $data[LIB_VIFM] = isset($_POST[LIB_VIFM]) ? $_POST[LIB_VIFM] : '';
  $data['v_count'] = 0;
  $str = arr_update($data);
  $sql = "UPDATE cms_vote SET " . $str . " WHERE id = " . $_POST['id'];
  if ($db->query($sql)) {
    admin_log('投票编辑',$_COOKIE['admin_id']);
    alert_href('编辑成功!','cms_vote.php');
  } else {
    alert_back('编辑失败!');
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">编辑投票<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="v_name">投票主题</label>
                 <input id="v_name" type="text" name="v_name" value="<?php echo $res[LIB_VNAME];?>">
              </div>
              <div class="am-form-group">
                <label for="l_picture">类型</label>
                <div class="am-form-group">
                  <label class="am-radio-inline">
                    <input type="radio" name="v_ifmulti" value="0" <?php echo ($res[LIB_VIFM]==0) ? 'checked="checked"' : '';?>> 单选
                  </label>
                  <label class="am-radio-inline">
                    <input type="radio" name="v_ifmulti" value="1" <?php echo ($res[LIB_VIFM]==1) ? 'checked="checked"' : '';?>> 多选
                  </label>
                </div>
              </div>
              <div class="am-form-group">
                <label for="v_stime">启动时间</label>
                 <input id="v_stime" type="text" name="v_stime" value="<?php echo local_date('Y-m-d',$res[LIB_VSTIME]);?>" data-am-datepicker>
              </div>
              <div class="am-form-group">
                <label for="v_etime">终止时间</label>
                 <input id="v_etime" type="text" name="v_etime" value="<?php echo local_date('Y-m-d',$res[LIB_VETIME]);?>" data-am-datepicker>
              </div>
              <center>
                <input type="submit" name="submit" id="save" class="am-btn am-btn-default" value="提交保存">
                <input type="reset" class="am-btn am-btn-default" value="放弃保存">
                <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
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
<script type="text/javascript">
$(function(){
  $('#save').click(function(){
    if ($('#l_name').val() == ''){
      alert('请填写链接名称');
      $('#l_name').focus();
      return false;
    }
    if ($('#v_stime').val() == ''){
      alert('请填写投票启动日期');
      $('#v_stime').focus();
      return false;
    }
    if ($('#v_etime').val() == ''){
      alert('请填写投票终止日期');
      $('#v_etime').focus();
      return false;
    }
  });
});
</script>
</body>
</html>