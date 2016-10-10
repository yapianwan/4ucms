<?php
header('Content-type:text/html; charset=utf-8');//设置编码
include '../library/inc.php';
if (isset($_POST['save'])) {
  $db_name = $_POST['db_name'];
  $str = '';
  $str .= '<?php';
  $str .= "\n";
  $str .= '//Mysql数据库信息';
  $str .= "\n";
  $str .= 'define(\'DATA_HOST\', \''.$_POST['db_host'].'\');';
  $str .= "\n";
  $str .= 'define(\'DATA_USERNAME\', \''.$_POST['db_username'].'\');';
  $str .= "\n";
  $str .= 'define(\'DATA_PASSWORD\', \''.$_POST['db_password'].'\');';
  $str .= "\n";
  $str .= 'define(\'DATA_NAME\', \''.$db_name.'\');';
  $str .= "\n";    
  $str .= '?>';
  $files = ROOT_PATH.'/config/data.php';
  $file_name = ROOT_PATH.INSTALL_DIR.'/data.sql';
  $ff = fopen($files,'w+');
  fwrite($ff,$str);

  set_time_limit(0);
  $fp = @fopen($file_name, "r");
    if ($fp === false) {
      die("不能打开SQL文件");
    }

    $tbl = $db->getAll("SHOW TABLES");
    $arr_tbl = get_easy_array($tbl,'Tables_in_'.DATA_NAME);
    if ($arr_tbl) {
      echo "正在清空数据库,请稍等....<br>"; 
      foreach ($arr_tbl as $val) {
        $db->query("DROP TABLE IF EXISTS $val"); 
      }
      echo "数据库清理成功<br>";
    }

  echo "正在执行导入数据库操作<br>";
  // 导入数据库的MySQL命令
  $sql=fread($fp,filesize($file_name));
  fclose($fp);
  $sql=explode("-- ----------",$sql);
  foreach($sql as $val){
    $db->query($val);
  }
  echo "数据库文件导入完成！";

  alert_href('安装成功,为了确保安全，请尽量删除install目录','../index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>安装向导</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
  $('#save').click(function(){
    if($('#db_host').val() == ''){
      alert('请填写主机名');
      $('#db_host').focus();
      return false;
    }
    if($('#db_name').val() == ''){
      alert('请填写数据库名');
      $('#db_name').focus();
      return false;
    }
    if($('#db_username').val() == ''){
      alert('请填写用户名');
      $('#db_username').focus();
      return false;
    }
    if($('#db_password').val() == ''){
      alert('请填写密码');
      $('#db_password').focus();
      return false;
    }
  });
});
</script>
</head>
<body>
<div id="body_main">
  <h1>MYSQL信息</h1>
  <form method="post">
    <table class="common_table">
      <tr>
        <td width="100" align="center">主机名</td>
        <td>
          <input id="db_host" class="form_text" type="text" name="db_host">
          <span class="color_red">*</span>
          <span class="color_gray">一般为 localhost 或者 127.0.0.1</span>
        </td>
      </tr>
      <tr>
        <td align="center">数据库名</td>
        <td>
          <input id="db_name" class="form_text" type="text" name="db_name" value="4ucms">
          <span class="color_red">*</span>
          <span class="color_gray">请提供的数据库名。</span>
        </td>
      </tr>
      <tr>
        <td align="center">用户</td>
        <td>
          <input id="db_username" class="form_text" type="text" name="db_username">
          <span class="color_red">*</span>
          <span class="color_gray">请填写MYSQL链接用户名</span>
        </td>
      </tr>
      <tr>
        <td align="center">密码</td>
        <td>
          <input id="db_password" class="form_text" type="text" name="db_password">
          <span class="color_red">*</span>
          <span class="color_gray">请填写MYSQL链接密码</span>
        </td>
      </tr>
      <tr>
        <td></td>
        <td><input id="save" class="form_submit" type="submit" name="save" value="安装"></td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>