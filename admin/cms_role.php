<?php 
$privilege = 'priv';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_GET['del']) && $_GET['del'] == 1) {
  alert_back('默认角色不能删除！');
} else {
  if (isset($_GET['del'])) {
    $sql = "DELETE FROM cms_role WHERE id = " . $_GET['del'];
    if ($db->query($sql)) {
      admin_log('角色删除', $_COOKIE['admin_id']);
      alert_href('删除成功!', page_back());
    } else {
      alert_back('删除失败！');
    }
  }  
}
if (isset($_POST['submit'])) {
  $r_name = $_POST['r_name'];
  $res = $db->getRow("SELECT * FROM cms_role WHERE r_name = '$r_name'");
  if (!empty($res)) {
    alert_back('角色重名');
  }
  null_back($r_name,'请填写角色名');
  $sql = "INSERT INTO cms_role (r_name) VALUES ('$r_name')";
  if ($db->query($sql)) {
    admin_log('角色新增', $_COOKIE['admin_id']);
    alert_href('新增成功!', page_back());
  } else {
    alert_back('新增失败!');
  }
}

$tpl->assign('res', $db->getAll("SELECT * FROM cms_role ORDER BY id ASC"));
$tpl->display(tpl());