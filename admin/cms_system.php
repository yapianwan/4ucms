<?php
$privilege = 'base';
include '../library/inc.php';
include 'cms_check.php';

if (isset($_POST['submit'])) {
  null_back($_POST[LIB_SDOMAIN],'请填写域名');
  null_back($_POST[LIB_SNAME],'请填写网络名称');

  $arr[LIB_SDOMAIN] = $_POST[LIB_SDOMAIN];
  $arr[LIB_SNAME] = $_POST[LIB_SNAME];
  $arr[LIB_SEON] = $_POST[LIB_SEON];
  $arr[LIB_KEYWORD] = $_POST[LIB_KEYWORD];
  $arr[LIB_SDESC] = $_POST[LIB_SDESC];
  $arr[LIB_SRIGHT] = $_POST[LIB_SRIGHT];
  $arr[LIB_SCODE] = $_POST[LIB_SCODE];
  $arr[LIB_SUSER] = $_POST[LIB_SUSER];
  $arr[LIB_SFB] = $_POST[LIB_SFB];

  $sql = "UPDATE cms_system SET " . arr_update($arr) . " WHERE id = 1";
  if ($db->query($sql)) {
    admin_log('系统设置编辑',$_COOKIE['admin_id']);
    alert_href('设置成功!','cms_system.php');
  } else {
    alert_back('设置失败!');
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
        <?php
        $res = $db->getRow("SELECT * FROM cms_system WHERE id = 1");
        if ($row = $res) {
        ?>
        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">系统设置<span class="am-icon-chevron-down am-fr"></span></header>
          <form action="" method="post" class="am-form">

            <main class="am-tabs am-margin" data-am-tabs>
              <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1">基本信息</a></li>
                <li><a href="#tab2">SEO</a></li>
              </ul>

              <div class="am-tabs-bd">
                <section class="am-tab-panel am-fade am-in am-active" id="tab1">
                  <div class="am-form-group">
                    <label for="s_domain">域名</label>
                    <input id="s_domain" type="text" name="s_domain" value="<?php echo $row[LIB_SDOMAIN]; ?>" placeholder="请在域名前添加http://，如:http://www.163.com">
                  </div>

                  <div class="am-form-group">
                    <label for="s_name">网站名称</label>
                    <input id="s_name" type="text" name="s_name" value="<?php echo $row[LIB_SNAME]; ?>">
                  </div>

                  <div class="am-form-group">
                    <label for="s_copyright">版权信息</label>
                    <textarea id="s_copyright" name="s_copyright"><?php echo $row[LIB_SRIGHT]?></textarea>
                  </div>
                  
                  <div class="am-form-group">
                    <label for="s_code">第三方代码</label>
                    <textarea id="s_code" name="s_code"><?php echo $row[LIB_SCODE]?></textarea>
                  </div>

                  <div class="am-form-group">
                    <label for="s_user">用户注册</label>
                    <select name="s_user" id="s_user">
                      <option value="1" <?php echo $row[LIB_SUSER] == 1 ? LIB_SELECTED :'';?>>不需审核</option>
                      <option value="0" <?php echo $row[LIB_SUSER] == 0 ? LIB_SELECTED :'';?>>需要审核</option>
                    </select>
                  </div>

                  <div class="am-form-group">
                    <label for="s_feedback">留言控制</label>
                    <select name="s_feedback" id="s_feedback">
                      <option value="1" <?php echo $row[LIB_SFB] == 1 ? LIB_SELECTED :'';?>>需要审核</option>
                      <option value="2" <?php echo $row[LIB_SFB] == 2 ? LIB_SELECTED :'';?>>不需审核</option>
                      <option value="0" <?php echo $row[LIB_SFB] == 0 ? LIB_SELECTED :'';?>>关闭留言</option>
                    </select>
                  </div>
                </section>
              
                <section class="am-tab-panel am-fade" id="tab2">
                  <div class="am-form-group">
                    <label for="s_seoname">优化标题</label>
                    <input id="s_seoname" type="text" name="s_seoname" value="<?php echo $row[LIB_SEON]; ?>">
                  </div>

                  <div class="am-form-group">
                    <label for="s_keywords">关键字</label>
                    <textarea id="s_keywords" type="text" name="s_keywords"><?php echo $row[LIB_KEYWORD]; ?></textarea>
                  </div>

                  <div class="am-form-group">
                    <label for="s_description">关键描述</label>
                    <textarea id="s_description" name="s_description"><?php echo $row[LIB_SDESC]; ?></textarea>
                  </div>
                </section>
                
                <center>
                  <button type="submit" name="submit" class="am-btn am-btn-default">提交保存</button>
                </center>
                <br>
              </div> 
            </main>
          </form>
        </section>
        <?php } ?>
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
    if ($('#s_domain').val() == ''){
      alert('请填写域名');
      $('#c_name').focus();
      return false;
    }
    if ($('#s_name').val() == ''){
      alert('请填写网络名称');
      $('#c_name').focus();
      return false;
    }
  });
});
KindEditor.ready(function(K) {
  K.create('#s_copyright',{allowFileManager : true});
});
</script>
</body>
</html>