<?php
$privilege = 'member';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del'])) {
  $sql = "DELETE FROM cms_user WHERE id = " . $_GET['del'];
  if ($db->query($sql)) {
    admin_log('会员删除',$_COOKIE['admin_id']);
    href('cms_member.php');
  } else {
    alert_back('删除失败！');
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">会员管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <form method="get" class="am-form am-show-sm-up am-nbfc">
                <div class="am-u-sm-12">
                  <div class="am-input-group">
                    <input id="key" class="am-form-field" type="text" name="key" placeholder="名称查找" />
                    <span class="am-input-group-btn"><button type="submit" id="search" class="am-btn" name="search">检索</button></span>
                  </div>
                </div>
            </form>
            <hr/>
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>帐号</th><th class="am-hide-sm-down">邮箱</th><th class="am-hide-sm-down">手机</th><th>操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $pager = page_handle('page',20,$db->getOne("SELECT COUNT(*) FROM cms_user WHERE u_isadmin = 0"));
                $res = $db->getAll("SELECT * FROM cms_user WHERE u_isadmin = 0 ORDER BY id DESC LIMIT " . $pager[0] . "," . $pager[1]);
                if (check_array($res)) {
                  foreach($res as $row){
                    echo '<tr><td>' . $row['u_name'] . '</td><td class="am-hide-sm-down">' . $row['u_email'] . '</td><td class="am-hide-sm-down">' . $row['u_mobile'] . '</td><td><a href="cms_member_edit.php?id=' . $row['id'] . '" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a> <a href="cms_member.php?del=' . $row['id'] . '" onclick="return confirm(\'确认要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></span></a></td></tr>';
                  }
                }
                ?>
              </tbody>
            </table>
            <div data-am-page="{pages:<?php echo $pager[2];?>,first:'首页',last:'尾页',curr:<?php echo $pager[3];?>}"></div>
          </main>
        </section>

      </div>
    </div>
  </div>
  <!-- content end -->
</div>

<?php include 'inc_footer.php';?>
</body>
</html>