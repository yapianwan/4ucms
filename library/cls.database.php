<?php
class Database {
  private $db;
  private $file_path;
  public function __construct($db) {
    $this->db = $db;
    $this->file_path = '../'.SQL_DIR.'/';
  }
  public function tables() {
    $tbl = $this->db->getAll("SHOW TABLES");
    return get_easy_array($tbl,'Tables_in_'.DATA_NAME);
  }
  public function backup() {
    //检查备份目录是否可写
    is_writeable($this->file_path) || alert_back('备份目录sql不存在或不可写，请检查后重试！');
    $mysql = "-- ----------\n";
    $arr_tbl = $this->tables();
    foreach ($arr_tbl as $value) {
      $this->lock($value);
      $rs_table = $this->db->getAll("SHOW CREATE TABLE `$value`");
      $sql = $rs_table[0];
      $mysql .= $sql['Create Table'] . ";\n-- ----------\n";
      $rs = $this->db->getAll("SELECT * FROM `$value`");
      if (!empty($rs)) {
        foreach ($rs as $k=>$val) {
          if (!empty($val)) {
            $keys = array_keys($val);
            $keys = array_map('addslashes', $keys);
            $keys = "`" . implode("`,`",$keys) . "`";
            $vals = array_values($val);
            $vals = array_map('addslashes', $vals);
            $vals = str_replace(array("\r\n", "\r", "\n","\t"), "", $vals);
            $vals = "'" . implode("','",$vals) . "'";
            $mysql .= $k==0 ? "INSERT INTO `$value` ($keys) VALUES ($vals)" : ",($vals)";
          }
        }
      }
      if (!empty($rs)) {
        $mysql .= ";\n-- ----------\n";
      }
    }
    $this->unlock();
    $filename = $this->file_path . DATA_NAME .'.'. date('Ymjgi') . ".sql"; //存放路径，默认存放到项目最外层
    $fp = fopen($filename, 'w');
    fputs($fp, $mysql);
    fclose($fp);
    alert_back("数据库备份成功");
  }
  public function restore($file_name) {
    $file_name .= !strpos($file_name, '.sql') ? '.sql' : '';
    //设置超时时间为0，表示一直执行。当php在safe mode模式下无效，此时可能会导致导入超时，此时需要分段导入
    set_time_limit(0);
    $fp = @fopen($this->file_path . $file_name, "r");
    if ($fp === false) {
      die("不能打开SQL文件 $file_name");
    }
    
    $arr_tbl = $this->tables();
    if ($arr_tbl) {
      echo "正在清空数据库,请稍等....<br>"; 
      foreach ($arr_tbl as $val) {
        $this->db->query("DROP TABLE IF EXISTS $val"); 
      }
      echo "数据库清理成功<br>";
    }

    echo "正在执行导入数据库操作<br>";
    // 导入数据库的MySQL命令
    $sql=fread($fp,filesize($this->file_path.$file_name));
    fclose($fp);
    $sql=explode("-- ----------",$sql);
    foreach ($sql as $val) {
      $this->db->query($val);
    }
    echo "数据库文件导入完成！";
    alert_back("数据库文件导入完成");
  }
  public function repair() {
    $arr_tbl = $this->tables();
    foreach ($arr_tbl as $val) {
      $this->lock($val);
    }
    $tbls = implode('`,`', $arr_tbl);
    $list = $this->db->query("REPAIR TABLE `{$tbls}`");
    $this->unlock();
    if ($list) {
      alert_back("数据库修复完成！");
    } else {
      alert_back("数据库修复出错请重试！");
    }
  }
  public function optimize() {
    $arr_tbl = $this->tables();
    foreach ($arr_tbl as $val) {
      $this->lock($val);
    }
    $tbls = implode('`,`', $arr_tbl);
    $list = $this->db->query("OPTIMIZE TABLE `{$tbls}`");
    $this->unlock();
    if ($list) {
      alert_back("数据库优化完成！");
    } else {
      alert_back("数据库优化出错请重试！");
    }
  }
  public function init() {
    $arr_tbl = array("cms_admin_log","cms_chip","cms_detail","cms_feedback","cms_link","cms_service","cms_slideshow","cms_subscribe","cms_vote","cms_vote_log","cms_vote_option","wx_event_push","wx_material","wx_menu","wx_mess","wx_mess_log","wx_msg_push","wx_news","wx_qrcode","wx_signin","wx_signin_res","wx_surl","wx_user");
    foreach ($arr_tbl as $val) {
      $this->lock($val);
      $this->db->truncate($val);
    }
    $this->unlock();
    alert_back("数据库初始化完成！");
  }
  private function lock($tablename, $op = "WRITE") {
    return $this->db->query("lock tables " . $tablename . " " . $op );
  }
  private function unlock() {
    return $this->db->query("unlock tables");
  }
  public function __destruct() {
    unset($this->db);
    unset($this->file_path);
  }
}
?>