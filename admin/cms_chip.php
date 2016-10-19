<?php
$privilege = 'chip';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $res = $db->getRow("SELECT * FROM cms_chip WHERE id = " . $_GET['del']);
  if ($res['c_safe']) {
    alert_back('已受保护,无法删除！');
  }
  $sql = "DELETE FROM cms_chip WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('碎片删除',$_COOKIE['admin_id']);
    alert_href('删除成功!','cms_chip.php');
  } else {
    alert_back('删除失败！');
  }
}    
if (isset($_POST['submit'])) {
  $c_name = $_POST['c_name'];
  $c_code = $_POST['c_code'];
  $c_content = $_POST['c_content'];
  $c_safe = $_POST['c_safe'];
  null_back($c_name,'请填写碎片名称！');
  $sql = "INSERT INTO cms_chip (c_code,c_name,c_content,c_safe) VALUES ('" . $c_code . "','" . $c_name . "','" . $c_content . "'," . $c_safe . ")";
  if ($db->query($sql)) {
    alert_href('新增成功!','cms_chip.php');
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
<?php include 'inc_header.php';?>

<div class="am-cf admin-main">
  <!-- content start -->
  <div class="admin-content">
    <div class="am-g am-g-fixed">
      <div class="am-u-sm-12 am-padding-top">

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">碎片管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>碎片名称</th><th>调用代码</th><th width="100">操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $res = $db->getAll("SELECT * FROM cms_chip ORDER BY id DESC");
                if (check_array($res)) {
                  foreach ($res as $row) {
                    echo '<tr><td>'.$row['c_name'].'</td><td>'.$row['c_code'].'</td><td><a href="cms_chip_edit.php?id='.$row['id'].'" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a> <a href="cms_chip.php?del='.$row['id'].'" onclick="return confirm(\'确认要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></a></td></tr>';
                  }
                }
                ?>
              </tbody>
            </table>
          </main>
        </section>

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增碎片<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="c_name">碎片名称</label>
                 <input id="c_name" type="text" name="c_name">
              </div>
              <div class="am-form-group">
                <label for="c_code">调用代码</label>
                 <input id="c_code" type="text" name="c_code">
              </div>
              <div class="am-form-group">
                <label for="c_content">碎片内容</label>
                 <textarea id="c_content" name="c_content"></textarea>
              </div>
              <div class="am-form-group">
                <label for="">安全保护</label>
                <div>
                  <label class="am-btn am-btn-default">
                    <input type="radio" name="c_safe" value="1"/> 是
                  </label>
                  <label class="am-btn am-btn-default am-active">
                    <input type="radio" name="c_safe" value="0" checked="checked" /> 否
                  </label>
                </div>
              </div>
              <center>
                <button type="submit" name="submit" id="save" class="am-btn am-btn-default">提交保存</button>
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
      if ($('#c_name').val() == ''){
        alert('请填写碎片名称');
        $('#c_name').focus();
        return false;
      }
    });
  });
  KindEditor.ready(function(K) {
    K.create('#c_content',{allowFileManager : true});
  });
</script>
</body>
</html>