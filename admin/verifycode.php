<?php
include_once '../library/inc.php';
include_once '../library/cls.verifycode.php';
$_vc = new ValidateCode(VERIFYCODE_WIDTH, VERIFYCODE_HEIGHT);
$_vc->doimg();
$_SESSION['verifycode_admin'] = $_vc->getCode();