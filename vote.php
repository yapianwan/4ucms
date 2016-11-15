<?php
$c_main = 'vote';
include './library/inc.php';
include './language/common.php';

non_numeric_back(intval($_GET['id']), $_lang['illegal']);
// 记入投票数据
if ($act == 'vote') {
  if ($db->getOne("SELECT id FROM cms_vote_log WHERE l_ip = '" . getIp() . "'") && !empty($_COOKIE['cms']['ifvote'])) {
    alert_href('您已参与过投票，谢谢您的支持！', 'vote.php?act=view&id=' . $_GET['id']);
  }
  foreach ($_GET['vote'] as $row) {
    non_numeric_back(intval($_GET['vote']), $_lang['illegal']);
    $arr['v_id'] = $_GET['id'];
    $arr['o_id'] = $row;
    $arr['l_ip'] = getIp();
    $arr['l_date'] = gmtime();
    $db->autoExecute('cms_vote_log', $arr, 'INSERT');
    // 更新项目统计
    $db->query("UPDATE cms_vote SET v_count=v_count+1 WHERE id=" . $_GET['id']);
    $db->query("UPDATE cms_vote_option SET o_count=o_count+1 WHERE id=" . $row);
  }
  setcookie('cms[ifvote]', 1, gmtime()+COOKIE_EXPIRE);
  alert_href('您已完成投票，谢谢您的支持！', 'vote.php?act=view&id=' . $_GET['id']);
}

elseif ($act == 'view') {
  // 获取投票数据
  $vote = $db->getRow("SELECT * FROM cms_vote WHERE id = " . $_GET['id']);
  $vote_option = $db->getAll("SELECT * FROM cms_vote_option WHERE v_id = " . $vote['id'] . " ORDER BY id ASC");
  if ($vote['v_count'] == 0) {
    foreach ($vote_option as $key => $val) {
      $vote_option[$key]['pct'] = '0%';
    }
  } else {
    foreach ($vote_option as $key => $val) {
      $vote_option[$key]['pct'] = round($val['o_count'] / $vote['v_count'] * 100) . '%';
    }
  }
} 

else {
  // 获取投票数据
  $vote = $db->getRow("SELECT * FROM cms_vote WHERE id = " . $_GET['id']);
  $vote_option = $db->getAll("SELECT * FROM cms_vote_option WHERE v_id = " . $vote['id'] . " ORDER BY o_order DESC,id ASC");
}

//读取指定的频道模型
include $t_path . self_name();