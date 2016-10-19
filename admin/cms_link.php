<?php
$privilege = 'link';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $sql = "DELETE FROM cms_link WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('链接删除',$_COOKIE['admin_id']);
    alert_href('删除成功!','cms_link.php');
  } else {
    alert_back('删除失败！');
  }
}
if (isset($_POST['submit'])) {
  $data[LIB_LNAME] = $_POST[LIB_LNAME];
  $data[LIB_LPICTURE] = $_POST[LIB_LPICTURE];
  $data[LIB_LURL] = $_POST[LIB_LURL];
  $data[LIB_LORDER] = $_POST[LIB_LORDER];
  $str = arr_insert($data);
  $sql = "INSERT INTO cms_link (" . $str['key'] . ") VALUES (" . $str['val'] . ")";
  if ($db->query($sql)) {
    admin_log('链接新增',$_COOKIE['admin_id']);
    alert_href('新增成功!','cms_link.php');
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">链接管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>排序</th><th>链接图片</th><th>链接名称</th><th class="am-hide-sm-only">链接地址</th><th>操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $pager = page_handle('page',20,$db->getOne("SELECT COUNT(*) FROM cms_link"));
                $res = $db->getAll("SELECT * FROM cms_link ORDER BY id DESC LIMIT " . $pager[0] . "," . $pager[1]);
                if (check_array($res)) {
                  foreach ($res as $row) {
                    echo '<tr><td>' . $row[LIB_LORDER] . '</td><td><a href="' . $row[LIB_LPICTURE] . '" target="_blank"><img src="' . $row[LIB_LPICTURE] . '" width="100" height="30" /></a></td><td>' . $row[LIB_LNAME] . '</td><td class="am-hide-sm-only">' . $row[LIB_LURL] . '</td><td><a href="cms_link_edit.php?id=' . $row['id'] . '" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a> <a href="cms_link.php?del=' . $row['id'] . '" onclick="return confirm(\'确认要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></span></a></td></tr>';
                  }
                }
                ?>
              </tbody>
            </table>
            <?php echo page_show_admin($pager[2],$pager[3],'page',2);?>
          </main>
        </section>

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增链接<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="l_name">链接名称</label>
                 <input id="l_name" type="text" name="l_name">
              </div>
              <div class="am-form-group">
                <label for="l_picture">链接图片</label>
                <div class="am-input-group">
                  <input name="l_picture" type="text" id="l_picture" class="am-form-field">
                  <span class="am-input-group-btn">
                    <button type="button" class="am-btn am-btn-default" id="l_picture_upload">选择图片</button>
                  </span>
                </div>
              </div>
              <div class="am-form-group">
                <label for="l_link">链接地址</label>
                 <input id="l_link" type="text" name="l_link" value="http://">
              </div>
              <div class="am-form-group">
                <label for="l_order">排序</label>
                 <input id="l_order" type="text" name="l_order" value="100">
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
    if ($('#l_name').val() == ''){
      alert('请填写链接名称');
      $('#l_name').focus();
      return false;
    }
    if (isNaN($('#l_order').val()) || $('#l_order').val() == '') {
      alert('排序必须是数字');
      $('#l_order').focus();
      return false;
    }
  });
});
KindEditor.ready(function(K) {
  var editor = K.editor({allowFileManager : true});
  K('#l_picture_upload').click(function() {
    editor.loadPlugin('image', function() {
      editor.plugin.imageDialog({
      imageUrl : K('#l_picture').val(),
      clickFn : function(url, title, width, height, border, align) {
        K('#l_picture').val(url);
        editor.hideDialog();
        }
      });
    });
  });
});
</script>
</body>
</html>