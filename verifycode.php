<?php
include './library/inc.php';
require './library/cls.verifycode.php';
$_vc = new ValidateCode(150, 50);
$_vc->doimg();
$_SESSION['verifycode'] = $_vc->getCode();