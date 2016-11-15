<?php
//返回当前的脚本名
function self_name() {
  $tmp_str = explode('/', $_SERVER['PHP_SELF']);
  return end($tmp_str);
}
// 获取后缀名
function get_file_ext($t) {
  return end(explode('.', $t));
}
// 获取文件名
function get_file_name($t) {
  return current(explode('.', $t));
}