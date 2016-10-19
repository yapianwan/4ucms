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
  $sql = LIB_CSELECTF . $t0 . ' AND id <> ' . $t3 . '';
  $res = $GLOBALS['db']->getAll($sql);
  if (is_array($res)) {
    foreach ($res as $row) {
      $select = $row['id'] == $t2 ? 'selected="selected"' : '';
      $tmp .= LIB_OPB . $row['id'] . '" ' . $select . '>' . $s . $row[LIB_CNAME] . LIB_OPE . channel_select_list($row['id'], $level, $t2, $t3);
    }
  }
  return $tmp;
}
//获取所有频道的ID
function get_channel_sub($t0, $t1) {
  $tmp = '';
  $s = ',';
  $sql = LIB_CSELECTF . $t0 . ' ORDER BY c_order ASC , id ASC ';
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
  $sql = 'SELECT * FROM cms_channel WHERE id =' . $parent . '';
  $res = $GLOBALS['db']->getRow($sql);
  if ($res['c_parent'] == 0) {
    return $res['id'];
  } else {
    return get_channel_main($res['c_parent']);
  }
}
//获取指定频道是否有子频道
function get_channel_ifsub($id) {
  $res = $GLOBALS['db']->getOne('SELECT id FROM cms_channel WHERE c_parent = ' . $id . ' ');
  if ($res) {
    return 1;
  } else {
    return 0;
  }
}
//更新所有频道
function update_channel() {
  $sql = 'SELECT * FROM cms_channel ORDER BY id ASC';
  $res = $GLOBALS['db']->getAll($sql);
  foreach ($res as $row) {
    $sql2 = 'update cms_channel set c_sub="' . get_channel_sub($row['id'], $row['id']) . '",c_ifsub=' . get_channel_ifsub($row['id']) . ',c_main=' . get_channel_main($row['id']) . ' WHERE id = ' . $row['id'] . ' ';
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
  $res = $GLOBALS['db']->getAll(LIB_CSELECTF . $t0 . ' ORDER BY c_order ASC, id ASC ');
  $level = $level + 1;
  if (is_array($res)) {
    foreach ($res as $row) {
      $tmp .= '<tr><td>' . $row['id'] . '</td><td>' . $row['c_order'] . '</td><td>' . $s . '<a href="../' . c_url($row['id']) . '" target="_blank">' . $row[LIB_CNAME] . '</a></td><td>' . get_channel_model_name($row['c_cmodel']) . '</td><td class="am-hide">' . get_detail_model_name($row['c_dmodel']) . '</td><td class="am-hide"><a href="cms_detail_add.php?id=' . $row['id'] . '">添加</a>&nbsp;<a href="cms_detail.php?cid=' . $row['id'] . '">管理</a></td><td><a href="cms_channel_edit.php?id=' . $row['id'] . '" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-pencil"></span></a>&nbsp;<a href="cms_channel.php?del=' . $row['id'] . '" onclick="return confirm(\'确定要删除吗？\')" class="am-btn am-btn-default am-btn-xs"><span class="am-icon-times"></span></a></td></tr>' . channel_list($row['id'], $level);
    }
  }
  return $tmp;
}
//通过id获取频道名称
function get_channel_name($t0) {
  $res = $GLOBALS['db']->getRow('SELECT * FROM cms_channel WHERE id=' . $t0 . '');
  if (!!($row = $res)) {
    return $row[LIB_CNAME];
  } else {
    return '';
  }
}
//通过id获取频道url
function get_channel_url($t0) {
  $res = $GLOBALS['db']->getRow('SELECT id, c_name FROM cms_channel WHERE id=' . $t0 . '');
  return '<a href=' . d_url($res['id']) . '>' . $res[LIB_CNAME] . '</a>';
}
//获取频道模型名称
function get_channel_model_name($t0) {
  $res = $GLOBALS['db']->getRow('SELECT * FROM cms_cmodel WHERE c_value="' . $t0 . '"');
  if (!!($row = $res)) {
    return $row[LIB_CNAME];
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
function channel_model_SELECT_list($t0 = 0) {
  $tmp = '';
  @($res = $GLOBALS['db']->getAll('SELECT * FROM cms_cmodel'));
  foreach ($res as $row) {
    $SELECT = $row['c_value'] == $t0 && !empty($t0) ? 'SELECTed="SELECTed"' : '';
    $tmp .= LIB_OPB . $row['c_value'] . '" ' . $SELECT . '>' . $row[LIB_CNAME] . LIB_OPE;
  }
  return $tmp;
}
function detail_model_SELECT_list($t0 = 0) {
  $tmp = '';
  $res = $GLOBALS['db']->getAll('SELECT * FROM cms_dmodel');
  foreach ($res as $row) {
    $SELECT = $row['d_value'] == $t0 && !empty($t0) ? 'SELECTed="SELECTed"' : '';
    $tmp .= LIB_OPB . $row['d_value'] . '" ' . $SELECT . '>' . $row['d_name'] . LIB_OPE;
  }
  return $tmp;
}
//获取会员等级下拉列表
function member_level_SELECT_list() {
  $tmp = '';
  $res = $GLOBALS['db']->getAll('SELECT * FROM cms_member_level');
  foreach ($res as $val) {
    $tmp .= '<option value=' . $val['id'] . '>' . $val['l_name'] . LIB_OPE;
  }
  return $tmp;
}
//获取会员等级信息
function get_member_level_id($t0) {
  return $GLOBALS['db']->getOne('SELECT id FROM cms_member_level WHERE id = ' . $t0);
}
function get_member_level_name($t0) {
  return $GLOBALS['db']->getOne('SELECT l_name FROM cms_member_level WHERE id = ' . $t0);
}
//获取子分类
function get_sub_id($t0) {
  $d_parent = '';
  $temp_arr = array();
  $res = $GLOBALS['db']->getAll('SELECT id FROM cms_channel WHERE c_parent = ' . $t0);
  foreach ($res as $key => $val) {
    $temp_arr[$key] = $val['id'];
  }
  if (is_array($temp_arr)) {
    $d_parent = implode(',', $temp_arr);
  } else {
    $d_parent = $t0;
  }
  return $d_parent;
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
function page_back() {
  $str = substr($_SERVER[LIB_PHPSELF], strrpos($_SERVER[LIB_PHPSELF], '/')+1);
  $arr = explode('_', $str);
  if (count($arr)>2) {
    return $arr[0] . '_' . $arr[1] . '.php';
  } else {
    return $arr[0] . '_' . $arr[1];
  }
}