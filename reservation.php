<?php
$c_main = 'reservation';
include './library/inc.php';
include '/language/common.php';
if ($id) {
  $prod = $db->getRow("SELECT * FROM cms_detail WHERE id = $id");
}
//读取指定的频道模型
include $t_path . 'reservation.php';