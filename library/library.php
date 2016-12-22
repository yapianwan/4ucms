<?php
/*
 * -------------------------
 * pagination
 * -------------------------
*/
//分页初始化
//参数说明：1分页参数。2.每页显示多少。3.一共多少。
function page_handle($t0, $t1, $t2) {
  if (isset($_GET[$t0])) {
    $page_num = $_GET[$t0];
    if (empty($page_num) || $page_num < 1 || !is_numeric($page_num)) {
      $page_num = 1;
    } else {
      $page_num = intval($page_num);
    }
  } else {
    $page_num = 1;
  }
  if ($t2 == 0) {
    $page_sum = 1;
  } else {
    $page_sum = ceil($t2 / $t1);
  }
  if ($page_num > $page_sum) {
    $page_num = $page_sum;
  }
  $FROM_num = ($page_num - 1) * $t1;
  $tmp = array();
  // 每页的起始从本条开始
  $tmp[0] = $FROM_num;
  // 每页多少条
  $tmp[1] = $t1;
  // 总页数
  $tmp[2] = $page_sum;
  // 当前页数
  $tmp[3] = $page_num;
  // 分页参数
  $tmp[4] = $t0;
  return $tmp;
}
function page_ajax($t0, $t1, $t2) {
  if (isset($t0)) {
    $page_num = $t0;
    if (empty($page_num) || $page_num < 1 || !is_numeric($page_num)) {
      $page_num = 1;
    } else {
      $page_num = intval($page_num);
    }
  } else {
    $page_num = 1;
  }
  if ($t2 == 0) {
    $page_sum = 1;
  } else {
    $page_sum = ceil($t2 / $t1);
  }
  if ($page_num > $page_sum) {
    $page_num = $page_sum;
  }
  $FROM_num = ($page_num - 1) * $t1;
  $tmp = array();
  // 每页的起始从本条开始
  $tmp[0] = $FROM_num;
  // 每页多少条
  $tmp[1] = $t1;
  // 总页数
  $tmp[2] = $page_sum;
  // 当前页数
  $tmp[3] = $page_num;
  return $tmp;
}
// 返回翻页条
// 参数说明：0.总页数。1.当前页。2.分页参数。3.分页半径。4.包含元素
function page_show($t0, $t1, $t2, $t3, $t4='') {
  $page_sum = $t0;
  $page_current = $t1;
  $page_parameter = $t2?:'page';
  $page_len = !empty($t3) ? $t3 : 1;
  $page_start = '';
  $page_end = '';
  $page_start = $page_current - $page_len;
  if ($page_start <= 0) {
    $page_start = 1;
    $page_end = $page_start + $page_end;
  }
  $page_end = $page_current + $page_len;
  if ($page_end > $page_sum) {
    $page_end = $page_sum;
  }
  $page_link = $_SERVER['REQUEST_URI'];
  $tmp_arr = parse_url($page_link);
  if (REWRITE) {
    $page_arr = explode('-', $page_link);
    if (count($page_arr) > 2) {
      $page_link = $page_arr[0] . '-' . $page_arr[1] . '-';
    } else {
      $dot_arr = explode('.', $page_arr[1]);
      $page_link = $page_arr[0] . '-' . $dot_arr[0] . '-';
    }
  } else {
    if (isset($tmp_arr['query'])) {
      $url = $tmp_arr['path'];
      $query = $tmp_arr['query'];
      parse_str($query, $arr);
      unset($arr[$page_parameter]);
      if (count($arr) != 0) {
        $page_link = $url . '?' . http_build_query($arr) . '&';
      } else {
        $page_link = $url . '?';
      }
    } else {
      $page_link = $page_link . '?';
    }
  }
  $page_back = '';
  $page_home = '';
  $page_list = '';
  $page_last = '';
  $page_next = '';
  $tmp = '';
  if (!empty($t4)) {
    $arr = explode('|', $t4);
  } else {
    $arr = array(
    '0'=>'<li><a href="',
    '1'=>'1.html" title="首页">&laquo;</a></li>',
    '2'=>'<li class="am-disabled"><a href="javascript:;" title="上一页">&lsaquo;</a></li>',
    '3'=>'.html" title="上一页">&lsaquo;</a></li>',
    '4'=>'<li class="am-active"><a href="javascript:void(0)">',
    '5'=>'</a></li>',
    '6'=>'.html" title="第',
    '7'=>'页">',
    '8'=>'.html" title="尾页">&raquo;</a></li>',
    '9'=>'<li class="am-disabled"><a href="javascript:;" title="下一页">&rsaquo;</a></li>',
    '10'=>'.html" title="下一页">&rsaquo;</a></li>',
    '11'=>'=1" title="首页">&laquo;</a></li>',
    '12'=>'" title="上一页">&lsaquo;</a></li>',
    '13'=>'" title="第',
    '14'=>'" title="尾页">&raquo;</a></li>',
    '15'=>'" title="下一页">&rsaquo;</a></li>',
    '16'=>'<li class="am-active"><a href="javascript:void(0)">',
    '17'=>'</a></li>'
    );
  }
  if (REWRITE) {
    if ($page_current > $page_len + 1) {
      $page_home = $arr[0] . $page_link . $arr[1];
    }
    if ($page_current == 1) {
      $page_back = $arr[2];
    } else {
      $page_back = $arr[0] . $page_link . ($page_current - 1) . $arr[3];
    }
    for ($i = $page_start; $i <= $page_end; $i++) {
      if ($i == $page_current) {
        $page_list = $page_list . $arr[4] . $i . $arr[5];
      } else {
        $page_list = $page_list . $arr[0] . $page_link . $i . $arr[6] . $i . $arr[7] . $i . $arr[5];
      }
    }
    if ($page_current < $page_sum - $page_len) {
      $page_last = $arr[0] . $page_link . $page_sum . $arr[8];
    }
    if ($page_current == $page_sum) {
      $page_next = $arr[9];
    } else {
      $page_next = $arr[0] . $page_link . ($page_current + 1) . $arr[10];
    }
  } else {
    if ($page_current > $page_len + 1) {
      $page_home = $arr[0] . $page_link . $page_parameter . $arr[11];
    }
    if ($page_current == 1) {
      $page_back = $arr[2];
    } else {
      $page_back = $arr[0] . $page_link . $page_parameter . '=' . ($page_current - 1) . $arr[12];
    }
    for ($i = $page_start; $i <= $page_end; $i++) {
      if ($i == $page_current) {
        $page_list = $page_list . $arr[16] . $i . $arr[17];
      } else {
        $page_list = $page_list . $arr[0] . $page_link . $page_parameter . '=' . $i . $arr[13] . $i . $arr[7] . $i . $arr[5];
      }
    }
    if ($page_current < $page_sum - $page_len) {
      $page_last = $arr[0] . $page_link . $page_parameter . '=' . $page_sum . $arr[14];
    }
    if ($page_current == $page_sum) {
      $page_next = $arr[9];
    } else {
      $page_next = $arr[0] . $page_link . $page_parameter . '=' . ($page_current + 1) . $arr[15];
    }
  }
  $tmp = $tmp . $page_home . $page_back . $page_list . $page_next . $page_last . '<input type="hidden" value="' . $page_current . '" class="page_current">';
  return $tmp;
}

/*
 * -------------------------
 * str
 * -------------------------
*/
//截断字符串
function str_cut($t0, $t1, $t2 = '...') {
  $str_ext = mb_strlen($t0, 'utf8') > $t1 ? $t2 : '';
  $tmp_str = mb_substr($t0, 0, $t1, 'utf8');
  return $tmp_str . $str_ext;
}
/**
 * 按符号截取字符串的指定部分
 * @param string $str 需要截取的字符串
 * @param string $sign 需要截取的符号
 * @param int $number 数组索引
 * @return string 返回截取的内容
 */
function str_part($str, $sign, $number=0) {
  $array = explode($sign, $str);
  $length = count($array);
  if ($number<0) {
    $new_array = array_reverse($array);
    $abs_number = abs($number);
    if ($abs_number>$length) {
      return 'error';
    } else {
      return $new_array[$abs_number-1];
    }
  } else {
    if ($number>=$length) {
      return 'error';
    } else {
      return $array[$number];
    }
  }
}
//返回可安全执行的SQL,带html格式
function str_isafe($str) {
  $tmp = array('SELECT ', 'insert ', 'update ', 'delete ', ' and', 'drop table', 'script', '*', '%', 'eval');
  $tmp_re = array('sel&#101;ct ', 'ins&#101;rt ', 'up&#100;ate ', 'del&#101;te ', ' an&#100;', 'dro&#112; table', '&#115;cript', '&#42;', '&#37;', '$#101;val');
  return str_replace($tmp, $tmp_re, trim($str));
}
//返回可安全执行的SQL,不带html格式
function str_safe($str) {
  return str_isafe(htmlspecialchars($str));
}
//返回无空格,tab,html的字串
function str_text($str, $ext = 0) {
  if ($ext == 1) {
    return str_replace(array("\r\n", "\r", "\n", " ", "　", chr(34), chr(13), " ", "&nbsp;"), '', strip_tags(str_isafe($str)));
  } elseif ($ext == 2) {
    return str_replace(array(" ","　",chr(34)), '', strip_tags(str_isafe($str)));
  } else {
    return str_replace(array("\r\n", "\r", "\n", " ", "　", chr(34), chr(13), "  "), '', strip_tags(str_isafe($str)));
  }
}
function array_str($arr, $p=',') {
  if (strpos($arr,$p)!==false) {
    return implode($p, $arr);
  } else {
    return $arr;
  }
}
function str_array($str,$p=',') {
  return explode($p, $str);
}
//高亮显示
function high_light($t0, $t1) {
  return str_replace($t1, '<span class="highlight">' . $t1 . '</span>', $t0);
}
// 随机码
function str_rand($len = 6, $type = 'all') {
  $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  // characters to build the password from
  mt_srand((double) microtime() * 1000000 * getmypid());
  // seed the random number generater (must be done)
  $tmp_str = '';
  while (strlen($tmp_str) < $len) {
    $tmp_str .= substr($chars, mt_rand() % strlen($chars), 1);
  }
  return $tmp_str;
}
// 32位非0整数
function str_code($len = 32) {
  $chars = '123456789';
  // characters to build the password from
  mt_srand((double) microtime() * 1000000 * getmypid());
  // seed the random number generater (must be done)
  $tmp_str = '';
  while (strlen($tmp_str) < $len) {
    $tmp_str .= substr($chars, mt_rand() % strlen($chars), 1);
  }
  return $tmp_str;
}
// 掩码处理（默认为手机号处理）
// $t1 从第几位开始 $t2 到第几位结束
// $t3 倒数几位
// 如银行卡号：0,4,3 得出6222************847
function get_mask_str($t0, $t1 = 0, $t2 = 3, $t3 = 4) {
  $strlen = strlen($t0);
  $str_mid = '';
  $str_pre = substr($t0, $t1, $t2);
  $str_suf = substr($t0, -$t3);
  for ($i = 0; $i < $strlen - ($t2 + $t3); $i++) {
    $str_mid .= '*';
  }
  return $str_pre . $str_mid . $str_suf;
}
function color_rand() {
  return '#' . dechex(rand(0, 16777215));
}

function alph_num($char) {
  $char = strtolower($char);
  $array = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
  $len = strlen($char);
  for ($i = 0; $i<$len; $i++) {
    $index = array_search($char[$i], $array);
    $sum += ($index+1) * pow(26,$len-$i-1);
  }
  return $sum;
}

function num_alph($n) {
  $n++;
  $array=array(1=>'a', 2=>'b', 3=>'c', 4=>'d', 5=>'e', 6=>'f', 7=>'g', 8=>'h', 9=>'i', 10=>'j', 11=>'k', 12=>'l', 13=>'m', 14=>'n', 15=>'o', 16=>'p', 17=>'q', 18=>'r', 19=>'s', 20=>'t', 21=>'u', 22=>'v', 23=>'w', 24=>'x', 25=>'y', 26=>'z');
  // $array=array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
  if ($n<=26) {
    return strtoupper($array[$n]);
  }else{
    if ($n%26==0) {
      return strtoupper($array[floor(($n-1)/26)] . $array[26]);
    } else {
      return strtoupper($array[floor($n/26)] . $array[$n%26]);
    }
  }
}

/*
 * -------------------------
 * sql
 * -------------------------
*/
//将数组转换成供insert用的字符串
function arr_insert($arr) {
  foreach ($arr as $k => $v) {
    $tmp_key[] = "`" . $k . "`";
    $tmp_value[] = "'" . $v . "'";
  }
  $key = '';
  $value = '';
  $key .= implode(',', $tmp_key);
  $value .= implode(',', $tmp_value);
  $tmp['key'] = $key;
  $tmp['val'] = $value;
  return $tmp;
}
//将数组转换成供update用的字符串
function arr_update($arr) {
  $tmp = '';
  foreach ($arr as $k => $v) {
    $tmp .= "`" . $k . "` = '" . $v . "',";
  }
  return rtrim($tmp, ',');
}
//根据ID获取任何表的任何字段
function get_field($t0, $t1, $t2, $t3 = 'id') {
  $res = $GLOBALS['db']->getRow('SELECT * FROM ' . $t0 . ' WHERE ' . $t3 . ' = ' . $t2 . ' ');
  if (is_array($res)) {
    return $res[$t1];
  } else {
    return '';
  }
}
function list_detail($c_sub, $limit, $order=''){
  $order = $order?:'ORDER BY d_order ASC,id DESC';
  return $GLOBALS['db']->getAll("SELECT * FROM cms_detail WHERE d_parent IN ($c_sub) $order LIMIT $limit");
}
function list_channel($c_id, $c_sub, $order=''){
  $order = $order?:'ORDER BY c_order ASC,id ASC';
  return $GLOBALS['db']->getAll("SELECT * FROM cms_channel WHERE id IN ($c_sub) AND id <> $c_id $order");
}
// 获取碎片内容
function get_chip($t0) {
  if (is_numeric($t0)) {
    $res = $GLOBALS['db']->getOne('SELECT c_content FROM cms_chip WHERE id = ' . $t0);
  } else {
    $res = $GLOBALS['db']->getOne('SELECT c_content FROM cms_chip WHERE c_code = \'' . $t0 . '\'');
  }
  return $res;
}

/*
 * -------------------------
 * check
 * -------------------------
*/
//判断非空数组
function check_array($arr) {
  if ($arr!==false) {
    return count($arr) ? count($arr) : 0;
  } else {
    return false;
  }
}
// 判断电子邮箱
function check_email($str) {
  if (!empty($str)) {
    $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
    if (preg_match($pattern, $str)) {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
}
// 判断手机号
function is_phonenum($num) {
  if (preg_match("/^1[34578]{1}\d{9}$/", $num)) {
    return true;
  } else {
    return false;
  }
}
// token
function cms_token() {
  if (!empty($_SESSION['cms']['token'])) {
    return $_SESSION['cms']['token'];
  } else {
    $_SESSION['cms']['token'] = str_rand();
    return $_SESSION['cms']['token'];
  }
}
function check_token($str) {
  return @$str == $_SESSION['cms']['token'];
}
// 判断移动端
function is_mobile() {
  $regExp = '/nokia|iphone|android|samsung|htc|motorola|blackberry|ericsson|huawei|dopod|amoi|gionee|^sie\\-|^bird|^zte\\-|haier|';
  $regExp .= 'blazer|netfront|helio|hosin|novarra|techfaith|palmsource|^mot\\-|softbank|foma|docomo|kddi|up\\.browser|up\\.link|';
  $regExp .= 'symbian|smartphone|midp|wap|phone|windows ce|CoolPad|webos|iemobile|^spice|longcos|pantech|portalmmm|';
  $regExp .= 'alcatel|ktouch|nexian|^sam\\-|s[cg]h|^lge|philips|sagem|wellcom|bunjalloo|maui|';
  $regExp .= 'jig\\s browser|hiptop|ucweb|ucmobile|opera\\s*mobi|opera\\*mini|mqqbrowser|^benq|^lct';
  $regExp .= '480×640|640x480|320x320|240x320|320x240|176x220|220x176/i';
  if (!isset($_SERVER['HTTP_USER_AGENT'])) {
    return true;
  } else {
    return @$_GET['mobile'] || isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE']) || preg_match($regExp, strtolower($_SERVER['HTTP_USER_AGENT']));
  }
}
function check_browser() {
  if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') || strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') || strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {
    return false;
  } else {
    return true;
  }
}
// 短时间内次数限制
function times_limit($count, $session) {
  $time = time();
  if (!isset($_SESSION[$count])) {
    $_SESSION[$count] = 0;
  }
  if (!isset($_SESSION[$session])) {
    $_SESSION[$session] = $time;
  }
  $_SESSION[$count]++;
  if ($_SESSION[$count]>5 && $time - $_SESSION[$session] <= TIME_OUT ) {
    $_SESSION[$session] = $time;
    alert_href("短时间内请不要重复操作!", $_COOKIE['cms']['url_back']);
  } elseif ($time - $_SESSION[$session] > TIME_OUT) {
    $_SESSION[$count] = 0;
  }
}

/*
 * -------------------------
 * etc
 * -------------------------
*/
// 替换语言文件内的[]参数
// $p 参数名 $v 参数值 $s 替换字串
function trans_p($p, $v, $s, $t='array') {
  if ($t=='array') {
    $res = $s;
    foreach ($p as $key => $val) {
      $res = str_replace($p[$key], $v[$key], $res);
    }
  } else {
    $res = str_replace($p, $v, $s);
  }
  return $res;
}
// 多维数组转单维
// array(array("0"=>值),array("0"=>值)，...)
// array("0"=>值,"1"=>值,...)
function get_easy_array($many_arr, $many_key) {
  $res = array();
  foreach ($many_arr as $val) {
    $res[] = $val[$many_key];
  }
  return $res;
}
// qrcode
// $level ['L','M','Q','H'] $type ['png','text','raw'] $size 3:99;4:132
function get_qrcode($url,$size=3,$margin=2,$type='png',$level='L') {
  if (!strpos($url, 'http://')) {
    $url = 'http://' . $url;
  }
  switch ($type) {
    case 'jpg':
      $output = QRCODE_DIR . microtime_float(1) . '.jpg';
      QRcode::png($url, $output, $level, $size, $margin, '75');
      break;
    case 'png':
      $output = QRCODE_DIR.microtime_float(1) . '.png';
      QRcode::png($url, $output, $level, $size, $margin);
      break;
    case 'text':
      $output = QRCODE_DIR.microtime_float(1) . '.text';
      QRcode::text($url, $output, $level, $size, $margin);
      break;
    case 'raw':
      $output = QRCODE_DIR.microtime_float(1) . '.raw';
      QRcode::raw($url, $output, $level, $size, $margin);
      break;
  }
  return $output;
}

/*
 * -------------------------
 * js
 * -------------------------
*/
function alert($t0) {
  echo '<script type="text/javascript">alert("' . $t0 . '");</script>';
}
function alert_back($t0) {
  die('<script type="text/javascript">alert("' . $t0 . '");window.history.back();</script>');
}
//提示后跳转
function alert_href($t0, $t1) {
  die('<script type="text/javascript">alert("' . $t0 . '");window.location.href="' . $t1 . '"</script>');
}
function back() {
  die('<script type="text/javascript">window.history.back();</script>');
}
function url_back($t0 = '') {
  if (!isset($_COOKIE['cms']['url_back']) || $_COOKIE['cms']['url_back'] == '') {
    if ($t0) {
      alert_href($t0, './');
    } else {
      href('./');
    }
  } else {
    if ($t0) {
      alert_href($t0, $_COOKIE['cms']['url_back']);
    } else {
      href($_COOKIE['cms']['url_back']);
    }
  }
}
function href($t0) {
  die('<script type="text/javascript">window.location.href="' . $t0 . '"</script>');
}
function admin_href($t='') {
  $str = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/')+1);
  if (substr_count($str, '_') > 1) {
    list($pre, $main, $suf) = explode('_', $str);
    $url = $pre . '_' . $main . '.php' . (isset($_GET['cid']) ? '?cid='.$_GET['cid'] : '');
    $t ? alert_href($t, $url) : href($url);
  } else {
    $url = $str . (isset($_GET['cid']) ? '?cid='.$_GET['cid'] : '');
    $t ? alert_href($t, $url) :  href($url);
  }
}
//空值返回
function null_back($t0, $t1) {
  if ($t0 == '' || $t0 === 0 || $t0 === '0' || $t0 === null) {
    alert_back($t1);
  }
}
function n_back($t0, $t1) {
  if ($t0 == '' || $t0 === null) {
    alert_back($t1);
  }
}
//比较返回
function compare_back($t0, $t1, $t2) {
  if ($t0 == '' || $t1 == '' || $t0 != $t1) {
    alert_back($t2);
  }
}
//非数字返回
function non_numeric_back($t0, $t1) {
  if (!is_numeric($t0) || $t0 < 0) {
    alert_back($t1);
  }
}