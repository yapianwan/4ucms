<?php
$privilege = 'vote';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $sql = "DELETE FROM cms_vote WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('投票删除',$_COOKIE['admin_id']);
    alert_href('删除成功!','cms_vote.php');
  } else {
    alert_back('删除失败！');
  }
}
if (isset($_POST['submit'])) {
  $data[LIB_VNAME] = isset($_POST[LIB_VNAME]) ? $_POST[LIB_VNAME] : '';
  $data[LIB_VIFM] = isset($_POST[LIB_VIFM]) ? $_POST[LIB_VIFM] : '';
  $data[LIB_VSTIME] = isset($_POST[LIB_VSTIME]) ? gmstr2time($_POST[LIB_VSTIME]) : '';
  $data[LIB_VETIME] = isset($_POST[LIB_VETIME]) ? gmstr2time($_POST[LIB_VETIME]) : '';
  $data[LIB_VIFM] = isset($_POST[LIB_VIFM]) ? $_POST[LIB_VIFM] : '';
  $data['v_count'] = 0;
  $sql = $db->autoExecute("cms_vote",$data,"INSERT");
  if ($db->query($sql)) {
    admin_log('投票新增',$_COOKIE['admin_id']);
    alert_href('新增成功!','cms_vote.php');
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">投票管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>投票主题</th><th>选项</th><th>状态</th><th>操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $pager = page_handle('page',20,$db->getOne("SELECT COUNT(*) FROM cms_vote"));
                $res = $db->getAll("SELECT * FROM cms_vote ORDER BY id DESC LIMIT ".$pager[0].",".$pager[1]);
                if (check_array($res)) {
                  foreach ($res as $row) {
                    $opiton_count = $db->getOne("SELECT COUNT(id) FROM cms_vote_option WHERE v_id = " . $row['id']);
                    $vote_status = gmtime()>=$row[LIB_VETIME] ? '已过期' : '进行中';
                    echo '<tr><td>' . $row[LIB_VNAME] . '</td><td>' . $opiton_count . '</td><td>' . $vote_status . '</td><td><a href="cms_vote_edit.php?id=' . $row['id'] . '" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a> <a href="cms_option.php?id=' . $row['id'] . '" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-list-ul"></span></a> <a href="cms_vote.php?del=' . $row['id'] . '" onclick="return confirm(\'确认要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></span></a></td></tr>';
                  }
                }
                ?>
              </tbody>
            </table>
            <ul class="am-pagination am-pagination-centered"><?php echo page_show($pager[2],$pager[3],'page',2);?></ul>
          </main>
        </section>

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增投票<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="v_name">投票主题</label>
                 <input id="v_name" type="text" name="v_name">
              </div>
              <div class="am-form-group">
                <label for="l_picture">类型</label>
                <div class="am-form-group">
                  <label class="am-radio-inline">
                    <input type="radio" name="v_ifmulti" value="0" checked="checked"> 单选
                  </label>
                  <label class="am-radio-inline">
                    <input type="radio" name="v_ifmulti" value="1"> 多选
                  </label>
                </div>
              </div>
              <div class="am-form-group">
                <label for="v_stime">启动时间</label>
                 <input id="v_stime" type="text" name="v_stime" value="<?php echo local_date('Y-m-d',gmtime());?>" data-am-datepicker>
              </div>
              <div class="am-form-group">
                <label for="v_etime">终止时间</label>
                 <input id="v_etime" type="text" name="v_etime" value="<?php echo local_date('Y-m-d',gmtime()+86400*30);?>" data-am-datepicker>
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
    if ($('#v_name').val() == ''){
      alert('请填写投票名称');
      $('#v_name').focus();
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