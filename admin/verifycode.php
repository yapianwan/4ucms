<?php
include '../library/inc.php';
require '../library/cls.verifycode.php';
$_vc = new ValidateCode(150, 50);
$_vc->doimg();
$_SESSION['verifycode_admin'] = $_vc->getCode();//验证码保存到SESSION中