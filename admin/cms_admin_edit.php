<?php
$privilege = 'all';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  $a_role = $_POST['a_role'];
  $a_name = $_POST['a_name'];
  $res = $db->getRow("SELECT * FROM cms_user WHERE u_name = '" . $a_name . "' AND id <> " . $_GET['id']);
  if ($res !== FALSE) {
    alert_back('登录帐号重名');
  }

  $a_tname = $_POST['a_tname'];
  $a_password = $_POST['a_password'];
  $a_cpassword = $_POST['a_cassword'];
  $a_npassword = $db->getOne("SELECT u_psw FROM cms_user WHERE id = " . $_GET['id']);
  if ($a_password == '') {
    $password = $a_npassword;
  } else {
    $password = md5($a_password);
  }

  null_back($a_name,'请填写登录帐号');
  $sql = "UPDATE cms_user SET u_rid=" . $a_role . ",u_name='" . $a_name . "',u_tname='" . $a_tname . "',u_psw='" . $password . "' WHERE id = " . $_GET['id'];
  if ($db->query($sql)) {
    admin_log('管理员编辑',$_COOKIE['admin_id']);
    alert_href('修改成功!','cms_admin.php');
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
        <?php
        $res = $db->
        getRow("SELECT * FROM cms_user WHERE id = ".$_GET['id']);
        if ($row = $res) {
        ?>      
        <section class="am-panel am-panel-default">
        <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">管理员<span class="am-icon-chevron-down am-fr"></span></header>
        <form action="" method="post" class="am-form">
          <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
          <div class="am-form-group">
            <label for="a_name">登录帐号</label>
            <input id="a_name" type="text" name="a_name" value="<?php echo $row['u_name']; ?>" <?php echo ($_GET['id']==1) ? 'readonly' : ''?>
            >
          </div>
          <div class="am-form-group">
            <label for="a_password">登录密码</label>
            <input name="a_password" type="password" id="a_password" value="">
            <p class="am-form-help">
              如不需修改请留空
            </p>
          </div>
          <div class="am-form-group">
            <label for="a_cassword">重复密码</label>
            <input name="a_cassword" type="password" id="a_cassword">
            <p class="am-form-help">
              如不需修改请留空
            </p>
          </div>
          <div class="am-form-group">
            <label for="a_tname">昵称</label>
            <input name="a_tname" type="text" id="a_tname" value="<?php echo $row['u_tname']; ?>">
          </div>
          <div class="am-form-group">
            <label for="a_role">权限角色</label>
            <select name="a_role" id="a_role">
              <?php
              if ($row['id']==1) {
                echo '<option value="1" selected="selected">超级管理员</option>';
              } else {
                $res = $db->getAll("SELECT * FROM cms_role");
                foreach($res as $val) {
                  echo '<option value="'.$val['id'].'" '.($val['id']==$row['u_rid'] ? 'selected="selected"' : '').'>'.$val['r_name'].'</option>';
                }
              }
              ?>
            </select>
          </div>
          <center><button type="submit" name="submit" class="am-btn am-btn-default">提交保存</button>
          <button type="reset" class="am-btn am-btn-default">放弃保存</button></center>
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
    if ($('#a_name').val() == ''){
      alert('请填写登录帐号');
      $('#a_name').focus();
      return false;
    }
    if($('#a_password').val() != $('#a_cassword').val()){
      alert('两次密码不一致');
      return false;
    }
  });
});
</script>
</body>
</html>