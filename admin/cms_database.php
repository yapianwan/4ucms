<?php
$privilege = 'database';
include '../library/inc.php';
include_once '../library/cls.database.php';

$dbc = new Database();
switch ($act) {
  case 'backup':
    $dbc->backup();
    break;
  case 'restore':
    $db_name = str_safe($_GET['db']);
    $dbc->restore($db_name);
    break;
  case 'repair':
    $dbc->repair();
    break;
  case 'optimize':
    $dbc->optimize();
    break;
  case 'query':
    $sql = str_text($_GET['sql']);
    if ($db->query($sql)) {
      alert('操作完成');
    }else{
      alert('Error:'.$db->query($sql));
    }
    break;
  default:
    break;
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">数据库管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <a href="?act=backup" class="am-btn am-btn-default">数据库备份</a>
            <a id="modal-restore" class="am-btn am-btn-default">数据库还原</a>
            <a href="?act=optimize" class="am-btn am-btn-default">数据库优化</a>
            <a href="javascript:if(confirm('数据正常的情况下，请不要随意进行修复操作！\n您确定要进行该操作吗？')) window.location.href='?act=repair';" class="am-btn am-btn-default">数据库修复</a>
            <table class="am-table admin-content-table">
              <thead>
              <tr>
                <th>表名</th>
              </tr>
              </thead>
              <tbody>
                <tr>
                <?php
                $res = $dbc->tables();
                if (check_array($res)) {
                  $count = count($res);
                  for ($i=0;$i<$count;$i++) {
                    echo '<td class="am-u-sm-12 am-u-md-4 am-u-lg-3">'.$res[$i].'</td>';
                  }
                }
                ?>
                </tr>
              </tbody>
            </table>
          </main>
        </section>

      </div>
    </div>
  </div>
  <!-- content end -->
</div>

<?php include 'inc_footer.php';?>
<div class="am-modal am-modal-prompt" tabindex="-1" id="modal-prompt">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">请输入需还原的文件名</div>
    <div class="am-modal-bd" style="padding:10px 0;">
      <input type="text" class="am-modal-prompt-input">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>提交</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>
<script>
$(function() {
  $('#modal-restore').on('click', function() {
    $('#modal-prompt').modal({
      relatedTarget: this,
      onConfirm: function(e) {
        window.location.href='?act=restore&db='+e.data;
      },
      onCancel: function(e) {}
    });
  });
});
</script>
</body>
</html>