<?php
include '../library/inc.php';
include '../library/cls.verifycode.php';
$_vc = new VerifyCode(150, 50);
$_vc->doimg();
$_SESSION['verifycode_admin'] = $_vc->getCode();