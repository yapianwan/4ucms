<?php
$privilege = 'all';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del']) && $_GET['del'] == 1) {
  alert_back('默认账户不能删除！');
} else {
  if (isset($_GET['del'])) {
    $sql = 'DELETE FROM cms_user WHERE id = ' . $_GET['del'];
    if ($db->query($sql)) {
      admin_log('管理员删除', $_COOKIE['admin_id']);
      href('cms_admin.php');
    } else {
      alert_back('删除失败！');
    }
  }
}
if (isset($_POST['submit'])) {
  $a_role = $_POST['a_role'];
  $a_name = $_POST['a_name'];
  $res = $db->getRow("SELECT * FROM cms_user WHERE u_name = '" . $a_name . "'");
  if (is_array($res)) {
    alert_back('登录帐号重名');
  }
  $a_tname = !empty($_POST['a_tname']) ? $_POST['a_tname'] : '';
  $a_password = $_POST['a_password'];
  $a_cpassword = $_POST['a_cassword'];

  null_back($a_name, '请填写登录帐号');
  null_back($a_password, '请填写登录密码');
  
  $sql = "INSERT INTO cms_user (u_rid,u_enable,u_name,u_tname,u_psw,u_isadmin) VALUES ('" . $a_role . "',1,'" . $a_name . "','" . $a_tname . "','" . md5($a_password) . "',1)";
  if ($db->query($sql)) {
    admin_log('管理员新增', $_COOKIE['admin_id']);
    alert_href('新增成功!', 'cms_admin.php');
  } else {
    alert_back('新增失败!');
  }
}
?>
<!DOCTYPE html>
<html class="no-js fixed-layout">
<head>
<?php include 'inc_head.php';?>
</head>

<body>
<?php include'inc_header.php';?>

<div class="am-cf admin-main">
  <!-- content start -->
  <div class="admin-content">
    <div class="am-g am-g-fixed">
    <div class="am-u-sm-12 am-padding-top">

      <div class="am-panel am-panel-default">
      <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">现有管理员<span class="am-icon-chevron-down am-fr"></span></div>
      <div class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
        <table class="am-table am-table-striped admin-content-table">
          <thead>
          <tr>
          <th class="am-hide-sm-down">ID</th><th>帐号</th><th class="am-hide">昵称</th><th>管理</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $res = $db->getAll("SELECT * FROM cms_user WHERE u_isadmin = 1");
            if (!empty($res)) {
              foreach($res as $row){
                echo '<tr><td class="am-hide-sm-down">' . $row['id'] . '</td><td>' . $row['u_name'] . '</td><td class="am-hide">' . $row['u_tname'] . '</td> <td><a href="cms_admin_edit.php?id=' . $row['id'] . '" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a> <a href="cms_admin.php?del=' . $row['id'] . '" onclick="return confirm(\'确认要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></span></a></td></tr>';
              }
            }
            ?>
          </tbody>
        </table>
        </div>
      </div>

    <section class="am-panel am-panel-default">
      <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增管理员<span class="am-icon-chevron-down am-fr"></span></header>
      <form action="" method="post" class="am-form">
        <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
          <div class="am-form-group">
          <label for="a_name">登录帐号</label>
          <input id="a_name" type="text" name="a_name">
          </div>
          <div class="am-form-group">
          <label for="a_password">登录密码</label>
          <input name="a_password" type="password" id="a_password">
          </div>
          <div class="am-form-group">
          <label for="a_cassword">重复密码</label>
          <input name="a_cassword" type="password" id="a_cassword">
          </div>
          <div class="am-form-group">
          <label for="a_tname">昵称</label>
          <input name="a_tname" type="text" id="a_tname">
          </div>
          <div class="am-form-group">
          <label for="a_role">权限角色</label>
          <select name="a_role" id="a_role">
            <?php
            $res = $db->getAll("SELECT * FROM cms_role");
            foreach($res as $row) {
              echo '<option value="' . $row['id'] . '">' . $row['r_name'] . '</option>';
            }
            ?>
          </select>
          </div>
            <center><button type="submit" name="submit" class="am-btn am-btn-primary">提交保存</button>
              <button type="reset" class="am-btn am-btn-primary">放弃保存</button></center>
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
  $('.submit').click(function(){
    if ($('#a_name').val() == ''){
      alert('请填写登录帐号');
      $('#a_name').focus();
      return false;
    }
    if ($('#a_password').val() == ''){
      alert('请填写登录密码');
      $('#a_password').focus();
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