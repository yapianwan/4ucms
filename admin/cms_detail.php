<?php
$privilege = 'detail';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['execute'])) {
  null_back($_POST['id'],'请至少选中一项！');
  $s = '';
  foreach ($_POST['id'] as $value) {
    $id .= $s.$value;
    $s = ',';
  }
  switch ($_POST['execute_method']){
    case 'srec':
      $sql = "UPDATE cms_detail SET d_rec = 1 WHERE id in (" . $id . ")";
      break;
    case 'crec':
      $sql = "UPDATE cms_detail SET d_rec = 0 WHERE id in (" . $id . ")";
      break;
    case 'shot':
      $sql = "UPDATE cms_detail SET d_hot = 1 WHERE id in (" . $id . ")";
      break;
    case 'chot':
      $sql = "UPDATE cms_detail SET d_hot = 0 WHERE id in (" . $id . ")";
      break;
    case 'delete':
      $sql = "DELETE FROM cms_detail WHERE id IN (" . $id . ")";
      admin_log('批量信息删除',$_COOKIE['admin_id']);
      break;
    default:
      alert_back('请选择要执行的操作');
  }
  $db->query($sql);
  alert_href('执行成功!','cms_detail.php?cid=0');
}
if ( isset($_POST['shift']) ) {
  null_back($_POST['id'],'请至少选中一项！');
  $s = '';
  foreach ($_POST['id'] as $value) {
    $id .= $s . $value;
    $s = ',';
  }
  null_back($_POST['shift_target'],'请选择要转移到的频道');
  $db->query("UPDATE cms_detail SET d_parent = " . $_POST['shift_target'] . " WHERE id IN (" . $id . ")");
  admin_log('信息转移',$_COOKIE['admin_id']);
  alert_href('转移成功!','cms_detail.php?cid=0');
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
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">内容管理<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <form method="get" class="am-form am-show-sm-up">
              <div class="am-g">
                <div class="am-u-sm-4">
                  <select onchange="location.href='cms_detail.php?cid='+this.options[this.selectedIndex].value;">
                    <option value="0">全部频道</option>
                    <?php
                    echo channel_select_list(0,0,$_GET['cid'],0);
                    if(isset($_GET['key'])){
                      echo '<option selected="selected" >搜索结果</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="am-u-sm-8">
                  <div class="am-input-group">
                    <input id="key" class="am-form-field" type="text" name="key" placeholder="名称查找" />
                    <span class="am-input-group-btn"><button type="submit" id="search" class="am-btn" name="search">检索</button></span>
                  </div>
                </div>
              </div>
            </form>
            <hr>
            <form action="" method="post">
            <table class="am-table am-table-striped admin-content-table">
              <thead>
              <tr>
                <th>选择</th><th>排序</th><th>内容名称</th><th>所属频道</th><th class="am-hide">内容模型</th><th class="am-hide">内容操作</th><th>操作</th>
              </tr>
              </thead>
              <tbody>
                 <?php
                  if (isset($_GET['cid'])) {
                    if ($_GET['cid'] != 0){
                      $pager = page_handle('page',20,mysql_num_rows(mysql_query("SELECT * FROM cms_detail WHERE d_parent IN (" . get_channel($_GET['cid'],'c_sub') . ")")));
                      $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN (" . get_channel($_GET['cid'],'c_sub') . ") ORDER BY id DESC LIMIT " . $pager[0] . "," . $pager[1]);
                    }else{
                      $pager = page_handle('page',20,mysql_num_rows(mysql_query("SELECT * FROM cms_detail")));
                      $res = $db->getAll("SELECT * FROM cms_detail ORDER BY id DESC LIMIT " . $pager[0] . "," . $pager[1]);
                    }
                  }
                  if (isset($_GET['search'])) {
                    $pager = page_handle('page',20,mysql_num_rows(mysql_query("SELECT * FROM cms_detail WHERE d_name LIKE '%" . $_GET['key'] . "%'")));
                    $res = $db->getAll("SELECT * FROM cms_detail WHERE d_name LIKE '%" . $_GET['key'] . "%' limit " . $pager[0] . "," . $pager[1]);
                  }
                  if (check_array($res)) {
                  foreach($res as $row){
                  ?>
                  <tr>
                    <td><input type="checkbox" name="id[]" value="<?php echo $row['id'] ?>" /></td>
                    <td><?php echo $row['d_order'] ?></td>
                    <td align="left"><?php echo '<a href="../detail.php?id=' . $row['id'] . '" target="_blank">' . $row['d_name'] . '</a>' ?></td>
                    <td><?php echo get_channel_name($row['d_parent'])?></td>
                    <td class="am-hide">
                      <?php 
                        echo $row['d_rec'] == 1 ? '<span class="am-badge am-badge-success">推</span>':'';
                        echo $row['d_hot'] == 1 ? '<span class="am-badge am-badge-danger">热</span>':'';
                        echo $row['d_ifslideshow'] == 1 ? '<span class="am-badge am-badge-primary">图</span>':'';
                      ?>
                    </td>
                    <td class="am-hide"><?php echo mydate($row['d_date']) ?></td>
                    <td><a href="cms_detail_edit.php?id=<?php echo $row['id']?>" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a></td>
                  </tr>
                  <?php
                    }
                  }
                  ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="3"><input type="button" id="check_all" value="全选" />
              <input type="button" class="form_button" id="check_none" value="不选" />
              <input type="button" class="form_button" id="check_invert" value="反选" />
                    <select id="execute_method" name="execute_method">
                      <option value="">请选择操作</option>
                      <option value="srec">设为推荐</option>
                      <option value="crec">取消推荐</option>
                      <option value="shot">设为热门</option>
                      <option value="chot">取消热门</option>
                      <option value="delete">删除选中</option>
                    </select>
                    <input type="submit" id="execute" name="execute" onclick="return confirm('确定要执行吗')" value="执行" /></td>
                  <td colspan="2">
                    <select id="shift_target" name="shift_target" style="width:150px;">
                      <option value="">请选择目标频道</option>
                      <?php echo channel_select_list(0,0,0,0);?>
                    </select>
                    <input type="submit" id="shift" name="shift" onclick="return confirm('确定要转移吗')" value="转移" />
                  </td>
                </tr>
              </tfoot>
            </table>
            </form>
            <?php echo page_show_admin($pager[2],$pager[3],'page',2);?>
          </main>
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
  //频道转移验证
  $('#shift').click(function(){
    if ($('#shift_target').val() == ''){
      alert('请选择要转移到的频道！');
      return false;
    };
    if ($('input[name="id[]"]').val() = ''){
      alert('请至少选择一项！');
      return false;
    };
  });
  //搜索验证
  $('#search').click(function(){
    if ($('#key').val() == ''){
      alert('请输入要查找的关键字');
      $('#key').focus();
      return false;
    };
  });
});
</script>
</body>
</html>