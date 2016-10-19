<?php
$privilege = 'database';
include '../library/inc.php';
include_once '../library/cls.database.php';

$dbc = new Database($db);
switch ($act) {
  case 'backup':
    $dbc->backup();
    break;
  case 'restore':
    $db_name = str_safe($_GET['db']);
    $dbc->restore($db_name);
    break;
  case 'repair':
    $dbc->repair();
    break;
  case 'optimize':
    $dbc->optimize();
    break;
  case 'query':
    $sql = str_text($_GET['sql']);
    if ($db->query($sql)) {
      alert('操作完成');
    }else{
      alert('Error:'.$db->query($sql));
    }
    break;
  default:
    break;
}

$tpl->assign('res', $dbc->tables());
$tpl->display(tpl());