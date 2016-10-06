<?php
$privilege = 'member';
include '../library/inc.php';
include 'cms_check.php';
if(isset($_POST['submit'])){
  $u_rid = isset($_POST[LIB_URID]) ? $_POST[LIB_URID] : '';
  if ($_GET['id']==1) {alert_back('该用户为内置用户无法操作!');}
  $u_psw = trim($_POST['u_psw']);
  $u_cash = trim($_POST['u_cash']);
  if (!empty($u_psw)) {
    $sql = "UPDATE cms_user SET u_rid='".$u_rid."',u_psw='".md5($u_psw)."',u_cash=".$u_cash." WHERE id = ".$_GET['id'];
  } else {
    $sql = "UPDATE cms_user SET u_rid='".$u_rid."',u_cash=".$u_cash." WHERE id = ".$_GET['id'];
  }
  if ($db->query($sql)) {
    admin_log('会员编辑',$_COOKIE['admin_id']);
    alert_href('修改成功!','cms_member.php');
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
        $res = $db->getRow("SELECT * FROM cms_user WHERE id = ".$_GET['id']);
        if($row = $res){
        ?>
        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">会员信息<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-1">
              <div class="am-form-group">
                <label>账户</label>
                <div><?php echo $row['u_name']?></div>
              </div>
               <div class="am-form-group">
                <label>密码</label>
                <div><input type="text" name="u_psw" value="" placeholder="不需要修改请留空"/></div>
              </div>
              <!--
              <div class="am-form-group">
                <label>权限</label>
                <div>
                  <select name="u_rid" id="">
                    <option value="">请为该用户指定操作权限</option>
                    <?php
                    $res = $db->getAll("SELECT * FROM cms_role ORDER BY id ASC");
                    foreach ($res as $val) {
                      echo '<option value="'.$val['id'].'" '.($row[LIB_URID]==$val['id'] ? 'selected="selected"' : '').'>'.$val['r_name'].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              -->
              <div class="am-form-group">
                <label>Email</label>
                <div><?php echo $row['u_email']?></div>
              </div>
              <div class="am-form-group">
                <label>余额</label>
                <div><input type="text" name="u_cash" value="<?php echo $row['u_cash']?>"></div>
              </div>
              <div class="am-form-group">
                <label>积分</label>
                <div><?php echo $row['u_point']?></div>
              </div>
              <div class="am-form-group">
                <label>姓名</label>
                <div><?php echo $row['u_tname']?></div>
              </div>
              <div class="am-form-group">
                <label>手机</label>
                <div><?php echo $row['u_mobile']?></div>
              </div>
              <div class="am-form-group">
                <label>地址</label>
                <div><?php echo $row['u_province'].' '.$row['u_city'].' '.$row['u_district'].' '.$row['u_addr']?></div>
              </div>
              <div class="am-form-group">
                <label>邮编</label>
                <div><?php echo $row['u_post']?></div>
              </div>
              <center><button type="submit" name="submit" id="save" class="am-btn am-btn-default">提交保存</button></center>
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

</body>
</html>