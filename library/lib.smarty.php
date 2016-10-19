<?php
function tpl() {
  $res = explode('.', php_self());
  return $res[0] . '.html';
}