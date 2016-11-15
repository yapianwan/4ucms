<?php
include './library/inc.php';
include './library/cls.verifycode.php';
$_vc = new VerifyCode(VERIFYCODE_WIDTH, VERIFYCODE_HEIGHT);
$_vc->doimg();
$_SESSION['verifycode_admin'] = $_vc->getCode();