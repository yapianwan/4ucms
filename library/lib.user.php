<?php
// 判断用户是否登陆
function user_state($url='user.php?act=login'){
  if (!isset($_COOKIE['cms'][LIB_USERID]) || $_COOKIE['cms'][LIB_USERID] == '') {
    alert_href('请登录后操作', $url);
    die;
  }
}
// 增加积分函数
function addPoint($point){
  user_state();
  non_numeric_back($point, '积分信息有误');
  //判断是否数字
  $point_o = get_field('cms_user', $_COOKIE['cms'][LIB_USERID], 'u_point');
  // 获取原积分
  $user_point = intval($point) + intval($point_o);
  //计算总积分
  if ($GLOBALS['db']->query('UPDATE cms_user SET u_point = \'' . $user_point . '\' WHERE id = \'' . $_COOKIE['cms'][LIB_USERID] . '\'')) {
    url_back();
  }
}
// 扣除积分函数
function deductPoint($point){
  user_state();
  non_numeric_back($point, '积分信息有误');
  //判断是否数字
  $point_o = get_field('cms_user', $_COOKIE['cms'][LIB_USERID], 'u_point');
  // 获取原积分
  if ($point > $point_o) {
    url_back('积分不足');
    die;
  } else {
    $user_point = intval($point_o) - intval($point);
    //计算总积分
    if ($GLOBALS['db']->query('UPDATE cms_user SET u_point = \'' . $user_point . '\' WHERE id = \'' . $_COOKIE['cms'][LIB_USERID] . '\'')) {
      url_back();
    }
  }
}