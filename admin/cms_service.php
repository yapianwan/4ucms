<?php
$privilege = 'im';
include '../library/inc.php'; 
include 'cms_check.php';
if(isset($_GET['del'])){
  $sql = "DELETE FROM cms_service WHERE id = ".$_GET['del'];
  if($db->query($sql)){
    admin_log('客服删除',$_COOKIE['admin_id']);
    alert_href('删除成功!','cms_service.php');
  }else{
    alert_back('删除失败！');
  }
}
if(isset($_POST['submit'])){
  $s_name = $_POST['s_name'];
  $s_type = $_POST['s_type'];
  $s_account = $_POST['s_account'];
  $s_order = $_POST['s_order'];
  null_back($s_name,'请填写客服名称');
  null_back($s_type,'请选择客服类型');
  null_back($s_account,'请填写客服帐号');
  non_numeric_back($s_order,'排序必须是数字!');
  $sql = "INSERT INTO cms_service (s_name,s_type,s_account,s_order) VALUES ('".$s_name."','".$s_type."','".$s_account."',".$s_order.")";
  if($db->query($sql)){
    admin_log('客服新增',$_COOKIE['admin_id']);
    alert_href('新增成功!','cms_service.php');
  }else
  {
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
<?php include 'inc_header.php';?>

<div class="am-cf admin-main">
  <!-- content start -->
  <div class="admin-content">
    <div class="am-g am-g-fixed">
      <div class="am-u-sm-12 am-padding-top">

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">客服管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr><th>排序</th><th>名称</th><th>类型</th><th>帐号</th><th>操作</th></tr>
              </thead>
              <tbody>
                <?php
                $res = $db->getAll("SELECT * FROM cms_service ORDER BY id DESC");
                if (check_array($res)) {
                  foreach($res as $row){
                    echo '<tr><td>'.$row['s_order'].LIB_TDEB.$row['s_name'].LIB_TDEB.$row['s_type'].LIB_TDEB.$row['s_account'].'</td><td><a href="cms_service_edit.php?id='.$row['id'].'" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a> <a href="cms_service.php?del='.$row['id'].'" onclick="return confirm(\'确认要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></span></a></td></tr>';
                  }
                }
                ?>
              </tbody>
            </table>
          </main>
        </section>

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增客服<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="s_name">客服名称</label>
                <input id="s_name" type="text" name="s_name">
              </div>
              <div class="am-form-group">
                <label for="s_type">客服类型</label>
                <select name="s_type" id="s_type">
                  <option value="">请选择类型</option>
                  <option value="1">腾讯QQ</option>
                  <option value="2">淘宝旺旺</option>
                  <option value="3">阿里旺旺</option>
                  <option value="4">微软MSN</option>
                  <option value="5">skype</option>
                </select>
              </div>
              <div class="am-form-group">
                <label for="s_account">客服帐号</label>
                <input id="s_account" type="text" name="s_account">
              </div>
              <div class="am-form-group">
                <label for="s_order">排序</label>
                <input id="s_order" type="text" name="s_order" value="100">
              </div>
              <center>
                <button type="submit" name="submit" class="am-btn am-btn-default submit">提交保存</button>
                <button type="reset" class="am-btn am-btn-default">放弃保存</button>
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
    if ($('#s_name').val() == ''){
      alert('请填写客服名称');
      $('#s_name').focus();
      return false;
    }
    if ($('#s_type').val() == ''){
      alert('请选择客服类型');
      $('#s_type').focus();
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