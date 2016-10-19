<?php
$privilege = 'slideshow';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $sql = "DELETE FROM cms_slideshow WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('幻灯删除',$_COOKIE['admin_id']);
    alert_href('删除成功!','cms_slideshow.php');
  } else {
    alert_back('删除失败！');
  }
}
if (isset($_POST['submit'])) {
  $s_name = $_POST['s_name'];
  $s_parent = $_POST['s_parent'];
  $s_picture = $_POST[LIB_SPIC];
  $s_link = $_POST[LIB_SURL]!='http://' ? $_POST[LIB_SURL] : '';
  $s_order = $_POST['s_order'];
  null_back($s_picture,'图片不能为空');
  non_numeric_back($s_order,'排序必须是数字!');
  $sql = "INSERT INTO cms_slideshow (s_name,s_parent,s_picture,s_link,s_order) VALUES ('" . $s_name . "','" . $s_parent . "','" . $s_picture . "','" . $s_link . "'," . $s_order . ")";
  if ($db->query($sql)) {
    admin_log('幻灯新增',$_COOKIE['admin_id']);
    alert_href('新增成功!','cms_slideshow.php');
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">幻灯管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>排序</th><th>幻灯图片</th><th>幻灯名称</th><th>链接地址</th><th>操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $res = $db->getAll("SELECT * FROM cms_slideshow ORDER BY id DESC");
                if (check_array($res)) {
                  foreach ($res as $row) {
                    echo '<tr><td>' . $row['s_order'] . '</td><td><a href="' . $row[LIB_SPIC] . '" target="_blank"><img src="' . $row[LIB_SPIC] . '" width="100" height="30" /></a></td><td>' . $row['s_name'] . '</td><td>' . $row[LIB_SURL] . '</td><td><a href="cms_slideshow_edit.php?id=' . $row['id'] . '" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a> <a href="cms_slideshow.php?del=' . $row['id'] . '" onclick="return confirm(\'确认要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></span></a></td></tr>';
                  }
                }
                ?>
              </tbody>
            </table>
          </main>
        </section>

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">新增幻灯<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">
            <main class="am-panel-bd am-panel-bordered am-collapse am-in" id="collapse-panel-2">
              <div class="am-form-group">
                <label for="s_name">幻灯名称</label>
                 <input id="s_name" type="text" name="s_name">
              </div>
              <div class="am-form-group">
                <label for="s_parent">属于</label>
                <select name="s_parent">
                  <option value="global">全局</option>
                  <option value="mobile">手机端</option>
                  <option value="index">首页</option>
                  <?php echo channel_select_list(0,0,0,0);?>
                </select>
              </div>
              <div class="am-form-group">
                <label for="s_picture">幻灯图片</label>
                <div class="am-input-group">
                  <input name="s_picture" type="text" id="s_picture" class="am-form-field">
                  <span class="am-input-group-btn">
                    <button type="button" class="am-btn am-btn-default" id="s_picture_upload">选择图片</button>
                  </span>
                </div>
              </div>
              <div class="am-form-group">
                <label for="s_link">链接地址</label>
                 <input id="s_link" type="text" name="s_link" value="http://">
              </div>
              <div class="am-form-group">
                <label for="s_order">排序</label>
                 <input id="s_order" type="text" name="s_order" value="100">
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
    if($('#s_picture').val() == ''){
      alert('图片不能为空');
      $('#s_picture_upload').focus();
      return false;
    }
    if (isNaN($('#s_order').val()) || $('#s_order').val() == '') {
      alert('排序必须是数字');
      $('#s_order').focus();
      return false;
    }
  });
});
KindEditor.ready(function(K) {
  var editor = K.editor({allowFileManager : true});
  K('#s_picture_upload').click(function() {
    editor.loadPlugin('image', function() {
      editor.plugin.imageDialog({
      imageUrl : K('#s_picture').val(),
      clickFn : function(url, title, width, height, border, align) {
        K('#s_picture').val(url);
        editor.hideDialog();
        }
      });
    });
  });
});
</script>
</body>
</html>