<?php
$privilege = 'qa';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['execute'])) {
  null_back($_POST['id'],'请至少选中一项！');
  $s = '';
  foreach ($_POST['id'] as $value) {
    $id .= $s . $value;
    $s = ',';
  }
  switch ($_POST['execute_method']) {
    case 'sok':
      $sql = "UPDATE cms_feedback SET f_ok = 1 WHERE id IN (" . $id . ")";
      break;
    case 'cok':
      $sql = "UPDATE cms_feedback SET f_ok = 0 WHERE id IN (" . $id . ")";
      break;
    case 'delete':
      $sql = "DELETE FROM cms_feedback WHERE id IN (" . $id . ")";
      break;
    default:
      alert_back('请选择要执行的操作');
  }
  $db->query($sql);
  alert_href('执行成功!','cms_feedback.php');
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

        <div class="am-panel am-panel-default">
          <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">留言管理<span class="am-icon-chevron-down am-fr"></span></div>
          <div class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <form action="" method="post">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>&nbsp;</th><th>状态</th><th class="am-hide-sm-down">留言人</th><th class="am-hide-sm-down">联系电话</th><th class="am-hide">公司名称</th><th class="am-hide">联系地址</th><th class="am-hide-sm-down">留言日期</th><th>回复</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $pager = page_handle('page',10,$db->getOne("SELECT COUNT(*) FROM cms_feedback"));
                $res = $db->getAll("SELECT * FROM cms_feedback ORDER BY id DESC LIMIT " . $pager[0] . "," . $pager[1]);
                if (check_array($res)) {
                  foreach ($res as $row) {
                    if ($row['f_ok'] == 0) {
                      $temp_str = '<span style="color:red">未审</span>';
                    } else {
                      $temp_str = '已审';
                    }
                    echo '<tr><td><input class="form_checkbox" type="checkbox" name="id[]" value="' . $row['id'] . '" /></td><td>' . $temp_str . '</td><td class="am-hide-sm-down">' . $row['f_name'] . '</td><td class="am-hide-sm-down">' . $row['f_tel'] . '</td><td class="am-hide">' . $row['f_cname'] . '</td><td class="am-hide">' . $row['f_address'] . '</td><td class="am-hide-sm-down">' . local_date('Y-m-d',$row['f_date']) . '</td><td><a href="cms_feedback_answer.php?id=' . $row['id'] . '">回复</a></td></tr>';
                  }
                }
                ?>
                <tr>
                  <td colspan="8">
                    <button type="button" class="form_button" id="check_all">全选</button>
                    <button type="button" class="form_button" id="check_none">不选</button>
                    <button type="button" class="form_button" id="check_invert">反选</button>
                    <select name="execute_method" id="execute_method">
                      <option value="">请选择操作</option>
                      <option value="sok">审核留言</option>
                      <option value="cok">取消审核</option>
                      <option value="delete">删除选中</option>
                    </select>
                    <button type="submit" class="form_button" id="execute" name="execute" onclick="return confirm('确定要执行吗')">执行</button>
                  </td>
                </tr>
              </tbody>
            </table>
            </form>
            <div data-am-page="{pages:<?php echo $pager[2];?>,first:'首页',last:'尾页',curr:<?php echo $pager[3];?>}"></div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- content end -->
</div>

<?php include 'inc_footer.php';?>

<!-- js -->
<script type="text/javascript">
  $(function(){
    $('#check_all').click(function(){
      $('input[name="id[]"]:checkbox').attr('checked',true);
    });
    $('#check_none').click(function(){
      $('input[name="id[]"]:checkbox').attr('checked',false);
    });
    $('#check_invert').click(function(){
      $('input[name="id[]"]:checkbox').each(function(){
        this.checked = !this.checked;
      });
    });
    //操作执行验证
    $('#execute').click(function(){
      if ($('#execute_method').val() == ''){
        alert('请选择一项要执行的操作！');
        return false;
      };
      if ($('input[name="id[]"]').val() = ''){
        alert('请至少选择一项！');
        return false;
      };
    });
  });
</script>
</body>
</html>