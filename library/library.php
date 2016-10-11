<?php
function alert($t0) {
  echo LIB_JS_ALERT . $t0 . '");</script>';
}
function alert_back($t0) {
  die(LIB_JS_ALERT . $t0 . '");window.history.back();</script>');
}
//提示后跳转
function alert_href($t0, $t1) {
  die(LIB_JS_ALERT . $t0 . '");window.location.href="' . $t1 . '"</script>');
}
function back() {
  die('<script type="text/javascript">window.history.back();</script>');
}
function href($t0) {
  die('<script type="text/javascript">window.location.href="' . $t0 . '"</script>');
}
function url_back($t0 = '') {
  $url_back = $_COOKIE['cms']['url_back'];
  if (empty($url_back)) {
    if ($t0) {
      alert_href($t0, './');
    } else {
      href('./');
    }
  } else {
    if ($t0) {
      alert_href($t0, $url_back);
    } else {
      href($url_back);
    }
  }
}
//空值返回
function null_back($t0, $t1) {
  if (empty($t0)) {
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
  if ($t0 != $t1) {
    alert_back($t2);
  }
}
//非数字返回
function non_numeric_back($t0, $t1) {
  if (!is_numeric($t0)) {
    alert_back($t1);
  }
}
//判断非空数组
function check_array($arr) {
  return count($arr) ? count($arr) : 0;
}
// 判断电子邮箱
function check_email($str) {
  if (!empty($str)) {
    $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
    return preg_match($pattern, $str);
  } else {
    return false;
  }
}
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
  $tmp[0] = $FROM_num;
  $tmp[1] = $t1;
  $tmp[2] = $page_sum;
  $tmp[3] = $page_num;
  $tmp[4] = $t0;
  return $tmp;
}

function page_ajax($t0, $t1, $t2) {
  if (isset($_POST[$t0])) {
    $page_num = $_POST[$t0];
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
  $tmp[0] = $FROM_num; //每页的起始从本条开始
  $tmp[1] = $t1; // 每页多少条
  $tmp[2] = $page_sum; // 总页数
  $tmp[3] = $page_num; // 当前页数
  $tmp[4] = $t0; //分页参数
  return $tmp;
}

//返回翻页条
//参数说明：1.总页数。2.当前页。3.分页参数。4.分页半径。5.频道
function page_show($t0, $t1, $t2, $t3) {
  $page_sum = $t0;
  $page_current = $t1;
  $page_parameter = $t2;
  $page_len = $t3;
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
  $page_link = $_SERVER[LIB_RQURI];
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
    if (isset($tmp_arr[LIB_QRY])) {
      $url = $tmp_arr['path'];
      $query = $tmp_arr[LIB_QRY];
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
  if (REWRITE) {
    if ($page_current > ($page_len + 1)) {
      $page_home = LIB_LIA . $page_link . '1.html" title="首页">1...' . LIB_ALI;
    }
    if ($page_current == 1) {
      $page_back = LIB_LICLS.PAGE_DISABLED.'"><a href="javascript:;" title="上一页"><<' . LIB_ALI;
    } else {
      $page_back = LIB_LIA . $page_link . ($page_current - 1) . '.html" title="上一页"><<' . LIB_ALI;
    }
    for ($i = $page_start; $i <= $page_end; $i++) {
      if ($i == $page_current) {
        $page_list = $page_list . LIB_LICLS.PAGE_ACTIVE.'"><a href="javascript:void(0)">' . $i . '' . LIB_ALI;
      } else {
        $page_list = $page_list . LIB_LIA . $page_link . $i . '.html" title="第' . $i . '页">' . $i . '' . LIB_ALI;
      }
    }
    if ($page_current < ($page_sum - $page_len)) {
      $page_last = LIB_LIA . $page_link . $page_sum . '.html" title="尾页">...' . $page_sum . '' . LIB_ALI;
    }
    if ($page_current == $page_sum) {
      $page_next = LIB_LICLS.PAGE_DISABLED.'"><a href="javascript:;" title="下一页">>>' . LIB_ALI;
    } else {
      $page_next = LIB_LIA . $page_link . ($page_current + 1) . '.html" title="下一页">>>' . LIB_ALI;
    }
  } else {
    if ($page_current > ($page_len + 1)) {
      $page_home = LIB_LIA . $page_link . $page_parameter . '=1" title="首页">1...' . LIB_ALI;
    }
    if ($page_current == 1) {
      $page_back = LIB_LICLS.PAGE_DISABLED.'"><a href="javascript:;" title="上一页"><<' . LIB_ALI;
    } else {
      $page_back = LIB_LIA . $page_link . $page_parameter . '=' . ($page_current - 1) . '" title="上一页"><<' . LIB_ALI;
    }
    for ($i = $page_start; $i <= $page_end; $i++) {
      if ($i == $page_current) {
        $page_list = $page_list . LIB_LICLS.PAGE_ACTIVE.'"><a href="javascript:void(0)">' . $i . '' . LIB_ALI;
      } else {
        $page_list = $page_list . LIB_LIA . $page_link . $page_parameter . '=' . $i . '" title="第' . $i . '页">' . $i . '' . LIB_ALI;
      }
    }
    if ($page_current < ($page_sum - $page_len)) {
      $page_last = LIB_LIA . $page_link . $page_parameter . '=' . $page_sum . '" title="尾页">...' . $page_sum . '' . LIB_ALI;
    }
    if ($page_current == $page_sum) {
      $page_next = LIB_LICLS.PAGE_DISABLED.'"><a href="javascript:;" title="下一页">>>' . LIB_ALI;
    } else {
      $page_next = LIB_LIA . $page_link . $page_parameter . '=' . ($page_current + 1) . '" title="下一页">>>' . LIB_ALI;
    }
  }
  return $tmp . $page_back . $page_home . $page_list . $page_last . $page_next . '<input type="hidden" value="' . $page_current . '" class="page_current">';
}
//翻页条后台
function page_show_admin($t0, $t1, $t2, $t3, $c_sub = 0) {
  $page_sum = $t0;
  $page_current = $t1;
  $page_parameter = $t2;
  $page_len = $t3;
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
  $page_link = $_SERVER[LIB_RQURI];
  $tmp_arr = parse_url($page_link);
  if (isset($tmp_arr[LIB_QRY])) {
    $url = $tmp_arr['path'];
    $query = $tmp_arr[LIB_QRY];
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
  $page_back = '';
  $page_home = '';
  $page_list = '';
  $page_last = '';
  $page_next = '';
  $tmp = '<ul class="am-pagination am-pagination-centered">';
  if ($page_current > ($page_len + 1)) {
    $page_home = LIB_LIA . $page_link . $page_parameter . '=1" title="首页">1...' . LIB_ALI;
  }
  if ($page_current == 1) {
    $page_back = '<li class="am-disabled"><a href="javascript:;" title="上一页"><<' . LIB_ALI;
  } else {
    $page_back = LIB_LIA . $page_link . $page_parameter . '=' . ($page_current - 1) . '" title="上一页"><<' . LIB_ALI;
  }
  for ($i = $page_start; $i <= $page_end; $i++) {
    if ($i == $page_current) {
      $page_list = $page_list . '<li class="am-active"><a href="javascript:void(0)">' . $i . '' . LIB_ALI;
    } else {
      $page_list = $page_list . LIB_LIA . $page_link . $page_parameter . '=' . $i . '" title="第' . $i . '页">' . $i . '' . LIB_ALI;
    }
  }
  if ($page_current < ($page_sum - $page_len)) {
    $page_last = LIB_LIA . $page_link . $page_parameter . '=' . $page_sum . '" title="尾页">...' . $page_sum . '' . LIB_ALI;
  }
  if ($page_current == $page_sum) {
    $page_next = '<li class="am-disabled"><a href="javascript:;" title="下一页">>>' . LIB_ALI;
  } else {
    $page_next = LIB_LIA . $page_link . $page_parameter . '=' . ($page_current + 1) . '" title="下一页">>>' . LIB_ALI;
  }
  $tmp = $tmp . $page_back . $page_home . $page_list . $page_last . $page_next . '</ul><input type="hidden" value="' . $page_current . '" class="page_current">';
  if ($c_sub) {
    $tmp .= '<input type="hidden" value="' . $c_sub . '" class="c_sub">';
  }
  return $tmp;
}
//截断字符串
function str_cut($t0, $t1, $t2 = '...') {
  $str_ext = mb_strlen($t0, 'utf8') > $t1 ? $t2 : '';
  $tmp_str = mb_substr($t0, 0, $t1, 'utf8');
  return $tmp_str . $str_ext;
}
//返回日期 2020-01-01
function mydate($t0) {
  return mb_substr($t0, 0, 10, 'utf8');
}
//返回当前的脚本名
function self_name() {
  $tmp_str = explode('/', $_SERVER['PHP_SELF']);
  return end($tmp_str);
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
//数组到sql字串
function array_str($arr,$p=',') {
  if (strpos($arr,$p)!==false) {
    return implode($p, $arr);
  } else {
    return $arr;
  }
}
function str_array($str,$p=',') {
  return explode($p, $str);
}
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
    $tmp .= $k . " = '" . $v . "',";
  }
  return rtrim($tmp,',');
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
//通过user_id得到用户名
function get_user_name($t0) {
  $sql = "SELECT m_name FROM cms_user WHERE id = '{$t0}'";
  return $GLOBALS['db']->getOne($sql);
}
function get_user($t0, $t1) {
  $sql = "SELECT {$t1} FROM cms_user WHERE id = '{$t0}'";
  return $GLOBALS['db']->getOne($sql);
}
//高亮显示
function high_light($t0, $t1) {
  return str_replace($t1, '<span class="highlight">' . $t1 . '</span>', $t0);
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
// 获取当前完整URL
function get_Url() {
  $url_str = $_SERVER['SERVER_NAME'] . $_SERVER[LIB_RQURI];
  return LIB_HTTP . $url_str;
}
// 判断移动端
function is_mobile() {
  $regExp = '/nokia|iphone|android|samsung|htc|motorola|blackberry|ericsson|huawei|dopod|amoi|gionee|^sie\\-|^bird|^zte\\-|haier|';
  $regExp .= 'blazer|netfront|helio|hosin|novarra|techfaith|palmsource|^mot\\-|softbank|foma|docomo|kddi|up\\.browser|up\\.link|';
  $regExp .= 'symbian|smartphone|midp|wap|phone|windows ce|CoolPad|webos|iemobile|^spice|longcos|pantech|portalmmm|';
  $regExp .= 'alcatel|ktouch|nexian|^sam\\-|s[cg]h|^lge|philips|sagem|wellcom|bunjalloo|maui|';
  $regExp .= 'jig\\s browser|hiptop|ucweb|ucmobile|opera\\s*mobi|opera\\*mini|mqqbrowser|^benq|^lct';
  $regExp .= '480×640|640x480|320x320|240x320|320x240|176x220|220x176/i';
  if (!isset($_SERVER[LIB_HTTPAGT])) {
    return true;
  } else {
    return @$_GET['mobile'] || isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE']) || preg_match($regExp, strtolower($_SERVER[LIB_HTTPAGT]));
  }
}
// 随机码
function str_rand($len = 6) {
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
/**
 * 递归方式的对变量中的特殊字符进行转义
 *
 * @access  public
 * @param   mix   $value
 *
 * @return  mix
 */
function addslashes_deep($value) {
  if (empty($value)) {
    return $value;
  } else {
    return is_array($value) ? array_map('addslashes_deep', $value) : addslashes(str_isafe($value));
  }
}
function stripslashes_deep($value) {
  if (empty($value)) {
    return $value;
  } else {
    return is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
  }
}
// 获取碎片内容
function get_chip($t0) {
  $res = '';
  if (is_numeric($t0)) {
    $res = $GLOBALS['db']->getOne('SELECT c_content FROM cms_chip WHERE id = ' . $t0);
  } else {
    $res = $GLOBALS['db']->getOne('SELECT c_content FROM cms_chip WHERE c_code = \'' . $t0 . '\'');
  }
  if (!empty($res)) {
    return $res;
  } else {
    return '';
  }
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
// 替换语言文件内的[]参数
// $p 参数名
// $v 参数值
// $s 替换字串
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
// 短网址
function url_s($url) {
  $data = array('url' => $url);
  $url = URL_MURL;
  return json_decode(http_post($url, $data), true);
}
function baidu_dwz($url, $type = 1) {
  if ($type) {
    $baseurl = 'http://dwz.cn/create.php';
  } else {
    $baseurl = 'http://dwz.cn/query.php';
  }
  if ($type) {
    $data = array('url' => $url);
  } else {
    $data = array('tinyurl' => $url);
  }
  $arrResponse = json_decode(http_post($baseurl, $data), true);
  if ($arrResponse['status'] != 0) {
    echo 'Error: [' . $arrResponse['status'] . '] ErrorMsg: [' . iconv(LIB_UTF8, 'GBK', $arrResponse['err_msg']) . ']<br/>';
    return 0;
  }
  if ($type) {
    return $arrResponse['tinyurl'];
  } else {
    return $arrResponse['longurl'];
  }
}
function http_get($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_TIMEOUT, 200);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
  curl_setopt($curl, CURLOPT_URL, $url);
  $output = curl_exec($curl);
  if (curl_errno($curl)) {
    echo LIB_ERR . curl_error($curl);
  }
  curl_close($curl);
  return $output;
}
function http_post($url, $data) {
  // 模拟提交数据函数
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  if (class_exists('\\CURLFile')) {
    curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
  } else {
    if (defined('CURLOPT_SAFE_UPLOAD')) {
      curl_setopt($curl, CURLOPT_SAFE_UPLOAD, false);
    }
  }
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
  $output = curl_exec($curl);
  if (curl_errno($curl)) {
    echo LIB_ERR . curl_error($curl);
  }
  curl_close($curl);
  return $output;
}
function https_get($url) {
  // 模拟提交数据函数
  $curl = curl_init();
  // 启动一个CURL会话
  curl_setopt($curl, CURLOPT_URL, $url);
  // 要访问的地址
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
  // 对认证证书来源的检查
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
  // 从证书中检查SSL加密算法是否存在
  curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER[LIB_HTTPAGT]);
  // 模拟用户使用的浏览器
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  // 使用自动跳转
  curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
  // 自动设置Referer
  curl_setopt($curl, CURLOPT_TIMEOUT, 200);
  // 设置超时限制防止死循环
  curl_setopt($curl, CURLOPT_HEADER, 0);
  // 显示返回的Header区域内容
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  // 获取的信息以文件流的形式返回
  $output = curl_exec($curl);
  // 执行操作
  if (curl_errno($curl)) {
    echo LIB_ERR . curl_error($curl);
  }
  curl_close($curl);
  // 关闭CURL会话
  return $output;
}
function https_post($url, $data) {
  // 模拟提交数据函数
  $curl = curl_init();
  // 启动一个CURL会话
  curl_setopt($curl, CURLOPT_URL, $url);
  // 要访问的地址
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
  // 对认证证书来源的检查
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
  // 从证书中检查SSL加密算法是否存在
  curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER[LIB_HTTPAGT]);
  // 模拟用户使用的浏览器
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  // 使用自动跳转
  curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
  // 自动设置Referer
  curl_setopt($curl, CURLOPT_POST, 1);
  // 发送一个常规的Post请求
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
  // Post提交的数据包
  curl_setopt($curl, CURLOPT_TIMEOUT, 200);
  // 设置超时限制防止死循环
  curl_setopt($curl, CURLOPT_HEADER, 0);
  // 显示返回的Header区域内容
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  // 获取的信息以文件流的形式返回
  $output = curl_exec($curl);
  // 执行操作
  if (curl_errno($curl)) {
    echo LIB_ERR . curl_error($curl);
  }
  curl_close($curl);
  // 关闭CURL会话
  return $output;
}
// 获取最大值
function get_max($tbl, $col, $sql = '') {
  if ($sql != '') {
    $res = $GLOBALS['db']->getOne("SELECT MAX({$col}) FROM {$tbl} WHERE {$sql}");
  } else {
    $res = $GLOBALS['db']->getOne("SELECT MAX({$col}) FROM {$tbl}");
  }
  return !empty($res) ? $res : 0;
}
// 自动清理超期的数据
function clear_expire($tbl, $col, $limit, $sql, $id = 'id') {
  $ids = '';
  $res = $GLOBALS['db']->getAll("SELECT {$id},{$col},{$limit} FROM {$tbl} WHERE {$sql}");
  foreach ($res as $val) {
    if (gmtime() > $val[$col] + $val[$limit]) {
      $ids .= $val[$id] . ',';
    }
  }
  if (!empty($ids)) {
    $idstr = rtrim($ids, ',');
    $sql = "DELETE FROM {$tbl} WHERE {$id} IN ({$idstr})";
    return $GLOBALS['db']->query($sql);
  } else {
    return false;
  }
}
// 数组转字串（引号字串值）
function implode_ex($w, $arr) {
  $str = '';
  foreach ($arr as $key=>$val) {
    if ($key==0) {
      $str .= '"' . $val . '"';
    } else {
      $str .= $w . '"' . $val . '"';
    }
  }
  return $str;
}
// 获取后缀名
function get_file_ext($t0) {
  return substr($t0, strrpos($t0, '.') + 1);
}
// 从绝对本地地址获取文件名
function get_file_name($str) {
  $arr = explode('/', $str);
  $totalcount = count($arr) - 1;
  return $arr[$totalcount];
}
function check_browser() {
  return strpos($_SERVER[LIB_HTTPAGT], 'MSIE 8.0') || strpos($_SERVER[LIB_HTTPAGT], 'MSIE 7.0') || strpos($_SERVER[LIB_HTTPAGT], 'MSIE 6.0');
}
// 地址码解析
// type [1:state,2:city,3:district,4:location]
function get_region($loc, $type = 1) {
  $sql = "SELECT p_name FROM cms_region_state WHERE p_code = '";
  if (!empty($loc)) {
    switch ($type) {
      case 1:
        $p = substr($loc, 0, 2);
        $name = $GLOBALS['db']->getOne($sql . intval($p) . "'");
        break;
      case 2:
        $p = substr($loc, 0, 4);
        $name = $GLOBALS['db']->getOne("SELECT c_name FROM cms_region_city WHERE c_code = '" . intval($p) . "'");
        break;
      case 3:
        $name = $GLOBALS['db']->getOne("SELECT d_name FROM cms_region_district WHERE d_code = '" . intval($loc) . "'");
        break;
      case 4:
        $state = substr($loc, 0, 2);
        $state_name = $GLOBALS['db']->getOne($sql . intval($state) . "'");
        $city = substr($loc, 0, 4);
        $city_name = $GLOBALS['db']->getOne("SELECT c_name FROM cms_region_city WHERE c_code = '" . intval($city) . "'");
        $district_name = $GLOBALS['db']->getOne("SELECT d_name FROM cms_region_district WHERE d_code = '" . intval($loc) . "'");
        $name = $state_name . $city_name . $district_name;
        break;
      default:
        $p = substr($loc, 0, 2);
        $name = $GLOBALS['db']->getOne($sql . intval($p) . "'");
        break;
    }
    return $name;
  } else {
    return FALSE;
  }  
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
// $level ['L','M','Q','H']
// $type ['png','text','raw']
// $size 3:99;4:132
function get_qrcode($url, $size = 3, $margin = 2, $type = 'png', $level = 'L') {
  if (!strpos($url, LIB_HTTP)) {
    $url = LIB_HTTP . $url;
  }
  switch ($type) {
    case 'jpg':
      $output = QRCODE_DIR.microtime_float(1).'.jpg';
      QRcode::png($url, $output, $level, $size, $margin, '75');
      break;
    case 'png':
      $output = QRCODE_DIR.microtime_float(1).'.png';
      QRcode::png($url, $output, $level, $size, $margin);
      break;
    case 'text':
      $output = QRCODE_DIR.microtime_float(1).'.text';
      QRcode::text($url, $output, $level, $size, $margin);
      break;
    case 'raw':
      $output = QRCODE_DIR.microtime_float(1).'.raw';
      QRcode::raw($url, $output, $level, $size, $margin);
      break;
    default:
      $output = QRCODE_DIR.microtime_float(1).'.png';
      QRcode::png($url, $output, $level, $size, $margin);
      break;
  }
  return $output;
}

function alph_num($char) {
  $char = strtolower($char);
  $array = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
  $len = strlen($char);
  for($i = 0; $i<$len; $i++) {
    $index = array_search($char[$i], $array);
    $sum += ($index+1)*pow(26, $len-$i-1);
  }
  return $sum;
}

function num_alph($n) {
  $n++;
  $array = array(1=>'a', 2=>'b', 3=>'c', 4=>'d', 5=>'e', 6=>'f', 7=>'g', 8=>'h', 9=>'i', 10=>'j', 11=>'k', 12=>'l', 13=>'m', 14=>'n', 15=>'o', 16=>'p', 17=>'q', 18=>'r', 19=>'s', 20=>'t', 21=>'u', 22=>'v', 23=>'w', 24=>'x', 25=>'y', 26=>'z');
  if ($n<=26) {
    return strtoupper($array[$n]);
  } else {
    if ($n%26 == 0) {
      return strtoupper($array[floor(($n-1)/26)] . $array[26]);
    } else {
      return strtoupper($array[floor($n/26)] . $array[$n%26]);
    }
  }
}

function is_phonenum($num) {
  return preg_match("/^1[34578]{1}\d{9}$/", $num);
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
    $new_array=array_reverse($array);
    $abs_number=abs($number);
    if ($abs_number>$length) {
      $res = 'error';
    } else {
      $res = $new_array[$abs_number-1];
    }
  } else {
    if ($number>=$length) {
      $res = 'error';
    } else {
      $res = $array[$number];
    }
  }
  return $res;
}