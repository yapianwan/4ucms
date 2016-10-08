<?php
class Mysql {
  public $queryCount = 0;
  public $queryTime = '';
  private $_user;
  //连接数据库用户名
  private $_pwd;
  //连接密码
  private $_host;
  //数据库地址
  private $_conn;
  //数据库连接指针
  private $_err;
  //返回错误信息
  private $_db;
  //连接的数据库名
  private $value = ') VALUES (';
  private $insertinto = 'INSERT INTO ';
  private $eqdyh = ' = \'';
  /**
   * 构造方法
   * @return Connect
   */
  public function __construct($host, $user, $pwd, $db = '') {
    $this->Connect($host, $user, $pwd, $db);
  }
  /**
   * 建立数据库连接
   * @param string $host 服务器地址
   * @param string $user 登陆用户名
   * @param string $pwd 登陆密码
   * @param string $db  数据库名称
   */
  public function Connect($host, $user, $pwd, $db = '') {
    $this->_conn = @mysql_connect($host, $user, $pwd);
    $this->_host = DATA_HOST;
    $this->_user = DATA_USERNAME;
    $this->_pwd = DATA_PASSWORD;
    if (mysql_errno()) {
      $this->_err = mysql_error();
      return;
    }
    mysql_query('set names utf8');
    if (!empty($db)) {
      $this->selectDB($db);
    }
  }
  /**
   * 选择数据库
   * @param string $db 数据库名称
   */
  public function selectDB($db) {
    $this->_db = $db;
    if (!empty($this->_db)) {
      @mysql_select_db($this->_db, $this->_conn);
      if (mysql_errno()) {
        $this->_err = mysql_error();
        return;
      }
    } else {
      $this->_err = '请输入数据库名';
      return;
    }
  }
  public function query($sql) {
    $this->checkSql($sql);
    $query = @mysql_query($sql, $this->_conn);
    if (!$query) {
      $this->_err = '请合查数据表前缀是否有误！';
      return;
    }
    if (mysql_errno()) {
      $this->_err = mysql_error();
      return false;
    }
    return $query;
  }
  /* 仿真 Adodb 函数 */
  public function selectLimit($sql, $num, $start = 0) {
    if ($start == 0) {
      $sql .= ' LIMIT ' . $num;
    } else {
      $sql .= ' LIMIT ' . $start . ', ' . $num;
    }
    return $this->query($sql);
  }
  public function getOne($sql, $limited = false) {
    if ($limited) {
      $sql = trim($sql . ' LIMIT 1');
    }
    $res = $this->query($sql);
    if ($res !== false) {
      $row = !empty($res) ? mysql_fetch_row($res) : '';
      return !empty($row) ? $row[0] : '';
    } else {
      return false;
    }
  }
  public function getAll($sql) {
    $res = $this->query($sql);
    if ($res !== false && $res !== null) {
      $arr = array();
      while ($row = mysql_fetch_assoc($res)) {
        $arr[] = $row;
      }
      return $arr;
    } else {
      return false;
    }
  }
  public function getRow($sql, $limited = true) {
    if ($limited) {
      $sql = trim($sql . ' LIMIT 1');
    }
    $res = $this->query($sql);
    if ($res !== false) {
      return @mysql_fetch_assoc($res);
    } else {
      return false;
    }
  }
  public function getCol($sql) {
    $res = $this->query($sql);
    if ($res !== false) {
      $arr = array();
      while (@($row = mysql_fetch_row($res))) {
        $arr[] = $row[0];
      }
      return $arr;
    } else {
      return false;
    }
  }
  public function autoExecute($table, $field_values, $mode = 'INSERT', $where = '', $querymode = '') {
    $field_names = $this->getCol('DESC ' . $table);
    $sql = '';
    if ($mode == 'INSERT') {
      $fields = $values = array();
      foreach ($field_names as $value) {
        if (array_key_exists($value, $field_values) ) {
          $fields[] = $value;
          $values[] = '\'' . $field_values[$value] . '\'';
        }
      }
      if (!empty($fields)) {
        $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
      }
    } else {
      $sets = array();
      foreach ($field_names as $value) {
        if (array_key_exists($value, $field_values)) {
          $sets[] = $value . ' = \'' . $field_values[$value] . '\'';
        }
      }
      if (!empty($sets)) {
        $sql = 'UPDATE ' . $table . ' SET ' . implode(', ', $sets) . ' WHERE ' . $where;
      }
    }
    if ($sql) {
      return $this->query($sql, $querymode);
    } else {
      return false;
    }
  }
  public function autoReplace($table, $field_values, $update_values, $where = '', $querymode = '') {
    $field_descs = $this->getAll('DESC ' . $table);
    $primary_keys = array();
    foreach ($field_descs as $value) {
      $field_names[] = $value['Field'];
      if ($value['Key'] == 'PRI') {
        $primary_keys[] = $value['Field'];
      }
    }
    $fields = $values = array();
    foreach ($field_names as $value) {
      if (array_key_exists($value, $field_values)) {
        $fields[] = $value;
        $values[] = '\'' . $field_values[$value] . '\'';
      }
    }
    $sets = array();
    foreach ($update_values as $key => $value) {
      if (array_key_exists($key, $field_values)) {
        if (is_int($value) || is_float($value)) {
          $sets[] = $key . ' = ' . $key . ' + ' . $value;
        } else {
          $sets[] = $key . ' = \'' . $value . '\'';
        }
      }
    }
    $sql = '';
    if (empty($primary_keys)) {
      if (!empty($fields)) {
        $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
      }
    } else {
      if ($this->version() >= '4.1') {
        if (!empty($fields)) {
          $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
          $sql .= !empty($sets) ? 'ON DUPLICATE KEY UPDATE ' . implode(', ', $sets) : '';
        }
      } else {
        if (empty($where)) {
          $where = array();
          foreach ($primary_keys as $value) {
            $where[] = is_numeric($value) ? $value . ' = ' . $field_values[$value] : $value . ' = \'' . $field_values[$value] . '\'';
          }
          $where = implode(' AND ', $where);
        }
        if ($where && (!empty($sets) || !empty($fields))) {
          if (intval($this->getOne("SELECT COUNT(*) FROM {$table} WHERE {$where}")) > 0) {
            $sql = !empty($sets) ? 'UPDATE ' . $table . ' SET ' . implode(', ', $sets) . ' WHERE ' . $where : '';
          } else {
            $sql = !empty($fields) ? 'REPLACE INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')' : '';
          }
        }
      }
    }
    if ($sql) {
      return $this->query($sql, $querymode);
    } else {
      return false;
    }
  }
  public function checkSql($sql) {
    if (empty($sql) || $sql == NULL) {
      $this->_err = '没有输入SQL语句';
      return false;
    }
  }
  public function truncate($table) {
    return $this->query('TRUNCATE TABLE ' . $table);
  }
  public function drop($table) {
    return $this->query('DROP TABLE ' . $table);
  }
  public function dropDB($db) {
    return $this->query('DROP DATABASE ' . $db);
  }
  /**
   * 关闭数据源
   */
  public function close() {
    if ($this->_conn) {
      @mysql_close($this->_conn);
      unset($this->_conn);
      unset($this->_host);
      unset($this->_db);
      unset($this->_user);
      unset($this->_pwd);
      unset($this->_err);
    }
  }
  /**
   * 析构函数
   */
  public function __destruct() {
    $this->close();
  }
}