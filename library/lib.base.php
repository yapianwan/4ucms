<?php
//频道链接地址
function c_url($t0, $t1='') {
  if (!empty($t1)) {
    return $t1;
  }else{
    $tmp = $GLOBALS['db']->getOne("SELECT c_link FROM cms_channel WHERE id = $t0");
    if ($tmp) {
      return $tmp;
    } else {
      return c_rewrite($t0);
    }
  }
}
//详情链接地址
function d_url($t0, $t1='') {
  if (!empty($t1)) {
    return $t1;
  }else{
    $tmp = $GLOBALS['db']->getOne("SELECT d_link FROM cms_channel WHERE id = $t0");
    if ($tmp) {
      return $tmp;
    } else {
      return d_rewrite($t0);
    }
  }
}
// rewrite
function c_rewrite($t0) {
  if (REWRITE) {
    return 'channel-' . $t0 . '.html';
  } else {
    return 'channel.php?id=' . $t0;
  }
}
function d_rewrite($t0) {
  if (REWRITE) {
    return 'detail-' . $t0 . '.html';
  } else {
    return 'detail.php?id=' . $t0 . '';
  }
}
//TAG链接地址
function tag_url($t0) {
  return 'search.php?tag=' . $t0 . '';
}
//sitemap
function sitemap($t0, $t1, $t2) {
  $tmp = '';
  $res = $GLOBALS['db']->getAll('SELECT * FROM cms_channel WHERE c_parent = ' . $t0);
  foreach ($res as $row) {
    $nav_name = !empty($row[LIB_CNNAME]) ? $row[LIB_CNNAME] : $row[LIB_CNAME];
    $tmp .= LIB_LIA . ($row[LIB_CIFSUB] == 1 ? 'javascript:;' : c_url($row['id'],$row[LIB_CLINK])) . '">' . $nav_name . '</a>' . sitemap($row['id'], '', $t2) . LIB_LIE;
  }
  if (!empty($tmp)) {
    if ($t0 == 0) {
      return '<ul class="am-list am-list-border">' . $t1 . $tmp . LIB_ULE;
    } else {
      return '<ul class="am-margin am-list am-list-border">' . $t1 . $tmp . LIB_ULE;
    }
  }
}
//无限级导航(宽屏)
function navigation($t0, $t1, $t2, $t3=2, $t4="nav am-hide-md-down", $t5="sub") {
  $tmp = '';
  $t2 = !empty($t2) ? $t2 : 0;
  if ($t3>0) {
    $res = $GLOBALS['db']->getAll(LIB_CSELECT . $t0 . LIB_CORDER);
    $t3--;
    foreach ($res AS $row) {
      $nav_name = !empty($row[LIB_CNNAME]) ? $row[LIB_CNNAME] : $row[LIB_CNAME];
      if ($t0==0) {
        $tmp .= '<li ' . ($row['c_main']==$t2 ? 'class="' . PAGE_ACTIVE . '"' : '') . '><a href="' . c_url($row['id'],$row[LIB_CLINK]) . LIB_TARGET . $row[LIB_CTARGET] . '">' . $nav_name . '</a>' . navigation($row['id'], '', $t2, $t3) . LIB_LIE;
      }else{
        $tmp .= LIB_LIA . c_url($row['id'], $row[LIB_CLINK]) . LIB_TARGET . $row[LIB_CTARGET] . '">' . $nav_name . '</a>' . navigation($row['id'], '', $t2, $t3) . LIB_LIE;
      }
    }
  }
  if (!empty($tmp)) {
    if ($t0==0) {
      return '<ul class="' . $t4 . '">' . $t1 . $tmp . LIB_ULE;
    } else {
      return '<ul class="' . $t5 . '">' . $t1 . $tmp . LIB_ULE;
    }
  }
}
//无限级导航（移动端）
function navigation_m($t0, $t1, $t2, $t3=2) {
  $tmp = '';
  $t2 = !empty($t2) ? $t2 : 0;
  if ($t3>0) {
    $res = $GLOBALS['db']->getAll(LIB_CSELECT . $t0 . LIB_CORDER);
    $t3--;
    foreach ($res AS $row) {
      $nav_name = !empty($row[LIB_CNNAME]) ? $row[LIB_CNNAME] : $row[LIB_CNAME];
      $tmp .= '<li class="' . ($t0==$row['id'] ? PAGE_ACTIVE : '') . ($row[LIB_CIFSUB]==1 && $t3!=0 ? 'am-dropdown' : '') . '" ' . ($row[LIB_CIFSUB]==1 && $t3!=0 ? 'data-am-dropdown' : '') . '><a ' . ($row[LIB_CIFSUB]==1 && $t3!=0 ? 'class="am-dropdown-toggle"' : '') . ($row[LIB_CIFSUB]==1 && $t3!=0 ? ' data-am-dropdown-toggle' : '') . ' href="' . ($row[LIB_CIFSUB]==1 && $t3!=0 ? 'javascript:;' : c_url($row['id'], $row[LIB_CLINK])) . '">' . $nav_name . ($row[LIB_CIFSUB]==1 && $t3!=0 ? ' <span class="am-icon-caret-down"></span>' : '') . '</a>' . navigation_m($row['id'], '', $t2, $t3) . LIB_LIE;
    }
    if (!empty($tmp)) {
      if ($t0==0) {
        return '<ul class="am-nav am-nav-pills am-topbar-nav">' . $t1 . $tmp . LIB_ULE;
      } else {
        return '<ul class="am-dropdown-content">' . $t1 . $tmp . LIB_ULE;
      }
    }
  }
}
//一级导航
function navigation_s($t0, $t1='') {
  $tmp = '';
  $res = $GLOBALS['db']->getAll(LIB_CSELECT . $t0 . LIB_CORDER);
  foreach ($res as $row) {
    $nav_name = !empty($row[LIB_CNNAME]) ? $row[LIB_CNNAME] : $row[LIB_CNAME];
      $tmp .= LIB_LIA . c_url($row['id'], $row[LIB_CLINK]) . LIB_TARGET . $row[LIB_CTARGET] . '">' . $nav_name . LIB_ALI;
  }
  if (!empty($tmp)) {
    return $t1 . $tmp;
  }
}
//频道列表
function channel_slist($t0, $t1, $t2=2) {
  if ($t2>0) {
    $tmp = '';
    $res = $GLOBALS['db']->getAll('SELECT * FROM cms_channel WHERE c_parent = ' . $t0 . ' AND c_navigation=1 ORDER BY c_order ASC , id ASC ');
    foreach ($res as $row) {
      $tmp .= '<li ' . ($row['id'] == $t1 ? ' class="active"' : '') . '><a href="' . c_url($row['id'], $row[LIB_CLINK]) . LIB_TARGET . $row[LIB_CTARGET] . '">' . $row[LIB_CNAME] . LIB_ALI;
    }
    $t2--;
  }
  if ($t2==2) {
    return $tmp;
  }else{
    return '<ul>' . $tmp . LIB_ULE;
  }
}
//频道和内容页的当前位置
function current_channel_location($t0, $t1) {
  $tmp = '';
  $res = $GLOBALS['db']->getAll('SELECT * FROM cms_channel WHERE id = ' . $t0 . '');
  foreach ($res as $row) {
    if ($row['id'] == $t1) {
      $tmp = '<li class="am-active">' . $row[LIB_CNAME] . LIB_LIE;
    } else {
      $tmp = LIB_LIA . c_url($row['id'], $row[LIB_CLINK]) . '">' . $row[LIB_CNAME] . LIB_ALI;
    }
    if ($row['c_parent'] != 0) {
      $tmp = current_channel_location($row['c_parent'], $t1) . $tmp;
    }
  }
  return $tmp;
}
//获取频道字段
function get_channel($t0, $t1) {
  $res = $GLOBALS['db']->getRow('SELECT * FROM cms_channel WHERE id=' . $t0 . '');
  if ($row = $res) {
    return $row[$t1];
  } else {
    return '不存在';
  }
}
// 释放资源
function unset_str($str) {
  if (strpos($str, ',')!==false) {
    $arr = explode(',', $str);
    foreach ($arr as $val) {
      unset($val);
    }
  }else{
    unset($str);
  }
}
// 替换默认图片
function img_always($str) {
  if (!empty($str)) {
    return $str;
  } else {
    return 'uploadfile/pic.jpg';
  }
}
// 获取当前网页
function php_self() {
  if (!empty($_SERVER[LIB_PHPSELF])) {
    return substr($_SERVER[LIB_PHPSELF], strrpos($_SERVER[LIB_PHPSELF], '/')+1);
  } else {
    return false;
  }
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
  }
}
//获取访问者真实IP
function get_ip() {
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    //check ip FROM share internet
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    //to check ip is pass FROM proxy
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
function is_home($p) {
  return @$p == 'index';
}
function is_404($p) {
  return @$p == '404';
}
function is_500($p) {
  return @$p == '505';
}
function is_search($p) {
  return @$p == 'search';
}
function is_channel() {
  return strpos($_SERVER[LIB_PHPSELF], 'channel');
}
function is_detail() {
  return strpos($_SERVER[LIB_PHPSELF], 'detail');
}