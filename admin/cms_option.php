<?php
$privilege = 'link';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $sql = "DELETE FROM cms_vote_option WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('投票项目删除',$_COOKIE['admin_id']);
    alert_back('删除成功!');
  } else {
    alert_back('删除失败！');
  }
}
if (isset($_POST['submit'])) {
  $data['v_id'] = isset($_POST['v_id']) ? $_POST['v_id'] : $_GET['id'];
  $data[LIB_ONAME] = isset($_POST[LIB_ONAME]) ? $_POST[LIB_ONAME] : '';
  $data['o_count'] = 0;
  $data[LIB_OORDER] = isset($_POST[LIB_OORDER]) ? $_POST[LIB_OORDER] : 100;
  $arr = arr_insert($data);

  $sql = "INSERT INTO cms_vote_option (" . $arr[0] . ") VALUES (" . $arr[1] . ")";
  if ($db->query($sql)) {
    admin_log('投票项目新增',$_COOKIE['admin_id']);
    alert_back('新增成功!');
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">投票项目管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>项目标题</th><th>操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $pager = page_handle('page',20,$db->getOne("SELECT COUNT(*) FROM cms_vote_option WHERE v_id = ".$_GET['id']));
                $res = $db->getAll("SELECT * FROM cms_vote_option WHERE v_id = " . $_GET['id'] . " ORDER BY o_order ASC, id DESC LIMIT " . $pager[0] . "," . $pager[1]);
                if (check_array($res)) {
                  foreach($res as $row){
                    echo '<tr><td>' . $row[LIB_ONAME] . '</td><td><a href="cms_option.php?del=' . $row['id'] . '" onclick="return confirm(\'确认要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></span></a></td></tr>';
                  }
                }
                ?>
              </tbody>
            </table>
            <div data-am-page="{pages:<?php echo $pager[2];?>,first:'首页',last:'尾页',curr:<?php echo $pager[3];?>,jump:'?id=<?php echo $_GET['id'];?>&page=%page%'}"></div>
          </main>
        </section>

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增投票项目<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="o_name">项目标题</label>
                 <input id="o_name" type="text" name="o_name">
              </div>
              <div class="am-form-group">
                <label for="o_order">项目排序</label>
                 <input id="o_order" type="text" name="o_order" value="100">
              </div>
              <center>
                <button type="submit" name="submit" id="save" class="am-btn am-btn-default">提交保存</button>
                <button type="button" class="am-btn am-btn-default" onclick="javascript:window.location.href='cms_vote.php';">返回投票主题</button>
                <input type="hidden" name="v_id" value="<?php echo $_GET['id'];?>">
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