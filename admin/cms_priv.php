<?php
$privilege = 'priv';
include '../library/inc.php';
include 'cms_check.php';
include '../language/priv.php';

// 获取管理员权限
$rid = $_GET['id'];
$res = $GLOBALS['db']->getOne("SELECT r_priv FROM cms_role WHERE id = " . $rid);
$priv = explode(',',$res);

// 更新权限至数据库
if ($act == 'update') {
  foreach ($_POST as $key=>$val) {
    if ($val!='' && $key!='rid' && $key!='act') {
      $arr[$key] = $val;
    }
  }
  $priv = implode(',',$arr); //转为priv字串
  $sql = "UPDATE cms_role SET r_priv = '$priv' WHERE id = ".$_POST['rid'];
  if ($db->query($sql)) {
    admin_log('权限管理',$_COOKIE['admin_id']);
    $admin_id = $db->getOne("SELECT * FROM cms_user WHERE u_rid = " . $_POST['rid']);
      alert_href('操作成功!','cms_priv.php?id='.$_POST['rid']);
  } else {
    alert_back('操作失败!');
  }
}
?>
<!DOCTYPE html>
<html class="no-js fixed-layout">
<head>
<?php include 'inc_head.php';?>
<style>
  th { background: #EEE;}
  label{ padding:5px 20px; cursor: pointer; margin-bottom: 0;}
  input[type=checkbox], input[type=radio]{ margin: 4px 5px 0 0;}
</style>
</head>

<body>
<?php include 'inc_header.php';?>

<div class="am-cf admin-main">
  <!-- content start -->
  <div class="admin-content">
    <div class="am-g am-g-fixed">
      <div class="am-u-sm-12 am-padding-top">

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">权限管理<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post">
          <main class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
            <table class="am-table am-table-bordered">
              <tbody>
                <tr>
                  <th><label><input type="checkbox" name="cms" id="cms" value="">内容管理</label></th>
                  <td>
                    <?php echo getChannelPriv(0,$rid,$priv);?>
                    <hr>
                    <?php
                    $cms = $_lang['priv']['cms'];
                    foreach ($cms as $key=>$val) {
                      echo PRIV_LBLB . $key . PRIV_CHKB . $key . PRIV_ID . $key . PRIV_VAL . $key . '" ' . (in_array($key,$priv) ? LIB_CHECKED : '') . '>' . $val . LIB_LBLE;
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th><label><input type="checkbox" name="int" id="int" value="">交互管理</label></th>
                  <td>
                    <?php
                    $int = $_lang['priv']['interaction'];
                    foreach ($int as $key=>$val) {
                      echo PRIV_LBLB . $key . PRIV_CHKB . $key . PRIV_ID . $key . PRIV_VAL . $key . '" ' . (in_array($key,$priv) ? LIB_CHECKED : '') . '>' . $val . LIB_LBLE;
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th><label><input type="checkbox" name="int" id="int" value="">微信管理</label></th>
                  <td>
                    <?php
                    $int = $_lang['priv']['weixin'];
                    foreach ($int as $key=>$val) {
                      echo PRIV_LBLB . $key . PRIV_CHKB . $key . PRIV_ID . $key . PRIV_VAL . $key . '" ' . (in_array($key,$priv) ? LIB_CHECKED : '') . '>' . $val . LIB_LBLE;
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th><label><input type="checkbox" name="sys" id="sys" value="">系统设置</label></th>
                  <td>
                    <?php
                    $sys = $_lang['priv']['system'];
                    foreach ($sys as $key=>$val) {
                      echo PRIV_LBLB . $key . PRIV_CHKB . $key . PRIV_ID . $key . PRIV_VAL . $key . '" ' . (in_array($key,$priv) ? LIB_CHECKED : '') . '>' . $val . LIB_LBLE;
                    }
                    ?>
                  </td>
                </tr>
              </tbody>
            </table>
            <center>
              <button type="submit" name="submit" id="save" class="am-btn am-btn-default">提交保存</button>
              <button type="reset" class="am-btn am-btn-default">放弃保存</button>
              <input type="hidden" name="act" value="update"><input type="hidden" name="rid" value="<?php echo $rid;?>">
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
<script>
$(function(){
  $('#cms,#int,#sys').click(function(){
    var p = $(this).parent().parent().parent();
    var v = $(this).attr('status');
    if (v==1) {
      p.find('input:checkbox').prop('checked', false);
      $(this).attr('status','0');
    }else{
      p.find('input:checkbox').prop('checked', true);
      $(this).attr('status','1');
    }
  });
  $('.common_table th>span>label>input').click(function(){
    var p = $(this).parent().parent().parent().parent();
    var v = $(this).attr('status');
    if (v==1) {
      p.find('input:checkbox').prop('checked', false);
      $(this).attr('status','0');
    }else{
      p.find('input:checkbox').prop('checked', true);
      $(this).attr('status','1');
    }
  });
})
</script>
</body>
</html>
<?php
function getChannelPriv($pid,$rid,$priv) {
  $str = '';
  $res = $GLOBALS['db']->getAll("SELECT * FROM cms_channel WHERE c_parent=".$pid." ORDER BY c_order ASC, id ASC");
  foreach ($res as $val) {
    if ($val['c_ifsub'] || $val['c_parent']==0) {
      if ($val['c_ifsub']==0 && $val['c_parent']==0) {
        $str .= '<table class="am-table am-table-bordered"><tr><th><label for="c' . $val['id'] . PRIV_CHKBNAMEB . $val['id'] . PRIV_IDB . $val['id'] . PRIV_VALB . $val['id'] . '" ' . (in_array("c" . $val['id'],$priv) ? LIB_CHECKED : '') . '>' . $val[LIB_CNAME] . '</label></th><td class="gray">无子频道</td></tr></table>';
      } else {
        $str .= '<table class="am-table am-table-bordered"><tr><th><label for="c' . $val['id'] . PRIV_CHKBNAMEB . $val['id'] . PRIV_IDB . $val['id'] . PRIV_VALB . $val['id'] . '" ' . (in_array("c" . $val['id'],$priv) ? LIB_CHECKED : '') . '>' . $val[LIB_CNAME] . '</label></th><td>' . getChannelPriv($val['id'],$rid,$priv) . '</td></tr></table>';
      }
    } else {
      $str .= '<label for="c' . $val['id'] . PRIV_CHKBNAMEB . $val['id'] . PRIV_IDB . $val['id'] . PRIV_VALB . $val['id'] . '" ' . (in_array("c" . $val['id'],$priv) ? LIB_CHECKED : '') . '>' . $val[LIB_CNAME] . LIB_LBLE;
    }
  }
  return $str;
}
?>