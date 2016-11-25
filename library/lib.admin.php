<?php
//获取频道下拉列表
function channel_select_list($t0, $t1, $t2, $t3) {
  $tmp = '';
  $s = '';
  $level = $t1;
  for ($i = 0; $i < $level; $i++) {
    $s = $s . '├ ';
  }
  $level = $level + 1;
  if (strpos($t0, ',')) {
    $sql = "SELECT * FROM cms_channel WHERE id IN (" . $t0 . ") AND id <> $t3";
  } else {
    $sql = "SELECT * FROM cms_channel WHERE c_parent IN (" . $t0 . ") AND id <> $t3";
  }
  $res = $GLOBALS['db']->getAll($sql);
  if (is_array($res)) {
    foreach ($res as $row) {
      $select = $row['id'] == $t2 ? 'selected="selected"' : '';
      $tmp .= '<option value="' . $row['id'] . '" ' . $select . '>' . $s . $row['c_name'] . '</option>' . (strpos($t0, ',') ? '' : channel_select_list($row['id'], $level, $t2, $t3));
    }
  }
  return $tmp;
}

//获取所有频道的ID
function get_channel_sub($t0, $t1) {
  $tmp = '';
  $s = ',';
  $sql = LIB_CSELECTF . $t0 . " ORDER BY c_order ASC , id ASC";
  $res = $GLOBALS['db']->getAll($sql);
  if (is_array($res)) {
    foreach ($res as $row) {
      $tmp .= $s . $row['id'] . get_channel_sub($row['id'], '');
    }
  }
  return $t1 . $tmp;
}

//获取指定频道的最上级频道
function get_channel_main($parent) {
  $sql = "SELECT * FROM cms_channel WHERE id =" . $parent;
  $res = $GLOBALS['db']->getRow($sql);
  if ($res['c_parent'] == 0) {
    return $res['id'];
  } else {
    return get_channel_main($res['c_parent']);
  }
}

//获取指定频道是否有子频道
function get_channel_ifsub($id) {
  $res = $GLOBALS['db']->getOne("SELECT id FROM cms_channel WHERE c_parent = " . $id);
  if ($res) {
    return 1;
  } else {
    return 0;
  }
}

//更新所有频道
function update_channel() {
  $sql = "SELECT * FROM cms_channel ORDER BY id ASC";
  $res = $GLOBALS['db']->getAll($sql);
  foreach ($res as $row) {
    $sql2 = "UPDATE cms_channel SET c_sub='" . get_channel_sub($row['id'], $row['id']) . "',c_ifsub='" . get_channel_ifsub($row['id']) . "',c_main='" . get_channel_main($row['id']) . "' WHERE id = " . $row['id'];
    $GLOBALS['db']->query($sql2);
  }
}

//频道管理列表
function channel_list($t0, $t1) {
  $tmp = '';
  $level = $t1;
  $s = '';
  for ($i = 0; $i < $level; $i++) {
    $s = $s . '&nbsp;-&nbsp;';
  }
  $res = $GLOBALS['db']->getAll('SELECT * FROM cms_channel WHERE c_parent = ' . $t0 . ' ORDER BY c_order ASC, id ASC ');
  $level = $level + 1;
  if (!empty($res)) {
    foreach ($res as $row) {
      $tmp .= '<tr><td>' . $row['id'] . '</td><td class="am-hide-sm-down">' . $row['c_order'] . '</td><td>' . $s . '<a href="../' . c_url($row['id']) . '" target="_blank">' . $row['c_name'] . '</a></td><td class="am-hide-sm-down">' . get_channel_model_name($row['c_cmodel']) . '</td><td class="am-hide-sm-down">' . get_detail_model_name($row['c_dmodel']) . '</td><td class="am-hide-sm-down"><a href="cms_detail_add.php?id=' . $row['id'] . '">添加</a>&nbsp;<a href="cms_detail.php?cid=' . $row['id'] . '">管理</a></td><td><a href="cms_channel_edit.php?id=' . $row['id'] . '" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a>&nbsp;<a href="cms_channel.php?del=' . $row['id'] . '" onclick="return confirm(\'确定要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></span></a></td></tr>' . channel_list($row['id'], $level);
    }
  }
  return $tmp;
}

//获取频道模型名称
function get_channel_model_name($t0) {
  $res = $GLOBALS['db']->getRow('SELECT * FROM cms_cmodel WHERE c_value="' . $t0 . '"');
  if (!!($row = $res)) {
    return $row['c_name'];
  } else {
    return '自定义';
  }
}

//获取详情模型名称
function get_detail_model_name($t0) {
  $res = $GLOBALS['db']->getRow('SELECT * FROM cms_dmodel WHERE d_value="' . $t0 . '"');
  if (!!($row = $res)) {
    return $row['d_name'];
  } else {
    return '自定义';
  }
}

function channel_model_select_list($t0 = 0) {
  $tmp = '';
  @($res = $GLOBALS['db']->getAll('SELECT * FROM cms_cmodel'));
  foreach ($res as $row) {
    $SELECT = $row['c_value'] == $t0 && !empty($t0) ? 'SELECTed="SELECTed"' : '';
    $tmp .= '<option value="' . $row['c_value'] . '" ' . $SELECT . '>' . $row['c_name'] . '</option>';
  }
  return $tmp;
}

function detail_model_select_list($t0 = 0) {
  $tmp = '';
  $res = $GLOBALS['db']->getAll('SELECT * FROM cms_dmodel');
  foreach ($res as $row) {
    $SELECT = $row['d_value'] == $t0 && !empty($t0) ? 'SELECTed="SELECTed"' : '';
    $tmp .= '<option value="' . $row['d_value'] . '" ' . $SELECT . '>' . $row['d_name'] . '</option>';
  }
  return $tmp;
}

//获得查询时间和次数
function assign_query_info() {
  if ($GLOBALS['db']->queryTime == '') {
    $query_time = 0;
  } else {
    if (PHP_VERSION >= '5.0.0') {
      $query_time = number_format(microtime(true) - $GLOBALS['db']->queryTime, 6);
    } else {
      list($now_usec, $now_sec) = explode(' ', microtime());
      list($start_usec, $start_sec) = explode(' ', $GLOBALS['db']->queryTime);
      $query_time = number_format($now_sec - $start_sec + ($now_usec - $start_usec), 6);
    }
  }
  $query_info = '共处理 ' . $GLOBALS['db']->queryCount . ' 条查询, 用时 ' . $query_time . ' 秒';
  //内存占用情况
  if (function_exists('memory_get_usage')) {
    $memory_info = '内存占用 ' . memory_get_usage() / 1048576 . ' m';
  }
  //是否启用了 gzip
  $gzip = gzip_enabled() ? '支持' : '不支持';
  return $query_info.'&nbsp;&nbsp;&nbsp;&nbsp;'.$memory_info.'&nbsp;&nbsp;&nbsp;&nbsp;gzip:'.$gzip;
}

function gzip_enabled() {
  static $enabled_gzip = NULL;
  if ($enabled_gzip === NULL) {
    $enabled_gzip = function_exists('ob_gzhandler');
  }
  return $enabled_gzip;
}

//后台操作日志
function admin_log($code, $admin_id, $admin_name = '', $silent = ADMIN_LOG) {
  $log['admin_id'] = $admin_id;
  $log['admin_name'] = $admin_name;
  $log['log_code'] = $code;
  $log['log_time'] = date('Y-m-d H:i:s', time());
  $log['log_ip'] = get_ip();
  if ($silent == 1 || $silent===true) {
    $GLOBALS['db']->autoExecute('cms_admin_log', $log);
  } else {
    // print_r($log);
  }
}

// 自动清理超期的数据
function clear_expire($tbl, $col, $limit, $sql, $id = 'id') {
  $ids = '';
  $res = $GLOBALS['db']->getAll("SELECT {$id},{$col},{$limit} FROM {$tbl} WHERE {$sql}");
  foreach ($res as $val) {
    if (gmtime() > $val[$col] + $val[$limit]) $ids .= $val[$id] . ',';
  }
  if (!empty($ids)) {
    $idstr = rtrim($ids, ',');
    $sql = "DELETE FROM {$tbl} WHERE {$id} IN ({$idstr})";
    if ($GLOBALS['db']->query($sql)) {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
}

// 获取中文首字母
function get_first_letter($str) {
  $fchar = ord($str[0]);
  if ($fchar >= ord('A') and $fchar <= ord('z')) {
    return strtoupper($str[0]);
  }
  $s1 = iconv('UTF-8', 'gb2312', $str);
  $s2 = iconv('gb2312', 'UTF-8', $s1);
  if ($s2 == $str) {
    $s = $s1;
  } else {
    $s = $str;
  }
  $asc = ord($s[0]) * 256 + ord($s[1]) - 65536;
  if ($asc >= -20319 and $asc <= -20284) return 'A';
  if ($asc >= -20283 and $asc <= -19776) return 'B';
  if ($asc >= -19775 and $asc <= -19219) return 'C';
  if ($asc >= -19218 and $asc <= -18711) return 'D';
  if ($asc >= -18710 and $asc <= -18527) return 'E';
  if ($asc >= -18526 and $asc <= -18240) return 'F';
  if ($asc >= -18239 and $asc <= -17923) return 'G';
  if ($asc >= -17922 and $asc <= -17418) return 'I';
  if ($asc >= -17417 and $asc <= -16475) return 'J';
  if ($asc >= -16474 and $asc <= -16213) return 'K';
  if ($asc >= -16212 and $asc <= -15641) return 'L';
  if ($asc >= -15640 and $asc <= -15166) return 'M';
  if ($asc >= -15165 and $asc <= -14923) return 'N';
  if ($asc >= -14922 and $asc <= -14915) return 'O';
  if ($asc >= -14914 and $asc <= -14631) return 'P';
  if ($asc >= -14630 and $asc <= -14150) return 'Q';
  if ($asc >= -14149 and $asc <= -14091) return 'R';
  if ($asc >= -14090 and $asc <= -13319) return 'S';
  if ($asc >= -13318 and $asc <= -12839) return 'T';
  if ($asc >= -12838 and $asc <= -12557) return 'W';
  if ($asc >= -12556 and $asc <= -11848) return 'X';
  if ($asc >= -11847 and $asc <= -11056) return 'Y';
  if ($asc >= -11055 and $asc <= -10247) return 'Z';
  return null;
}