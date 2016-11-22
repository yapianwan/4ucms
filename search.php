<?php
$c_main = 'search';
include './library/inc.php';
if (!check_token($_GET['token'])) {
  alert_back($_lang['illegal']);
}

if (!empty($_GET[LIB_KEY])) {
  null_back($_GET[LIB_KEY], $_lang[LIB_KEY]);
  $key = str_safe($_GET[LIB_KEY]);
} elseif (!empty($_GET['tag'])) {
  null_back($_GET['tag'], $_lang[LIB_KEY]);
  $key = str_safe($_GET['tag']);
} else {
  alert_back($_lang[LIB_KEY]);
}

include $t_path . self_name();