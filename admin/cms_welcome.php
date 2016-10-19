<?php
include '../library/inc.php';
include 'cms_check.php';

$tpl->assign('chn', $db->getOne("SELECT COUNT(id) FROM cms_channel"));
$tpl->assign('chn_url', 'cms_channel.php');
$tpl->assign('dtl', $db->getOne("SELECT COUNT(id) FROM cms_detail"));
$tpl->assign('dtl_url', 'cms_detail.php?cid=0');
$tpl->assign('sld', $db->getOne("SELECT COUNT(id) FROM cms_slideshow"));
$tpl->assign('sld_url', 'cms_slideshow.php');
$tpl->assign('chip', $db->getOne("SELECT COUNT(id) FROM cms_chip"));
$tpl->assign('chip_url', 'cms_chip.php');
$tpl->assign('usr', $db->getOne("SELECT COUNT(id) FROM cms_user WHERE u_isadmin=0"));
$tpl->assign('usr_url', 'cms_member.php');
$tpl->assign('fdb', $db->getOne("SELECT COUNT(id) FROM cms_feedback"));
$tpl->assign('fdb_url', 'cms_feedback.php');
$tpl->assign('link', $db->getOne("SELECT COUNT(id) FROM cms_link"));
$tpl->assign('link_url', 'cms_link.php');
$tpl->assign('tpl', $db->getOne("SELECT COUNT(id) FROM cms_template"));
$tpl->assign('tpl_url', 'cms_template.php');
$tpl->assign('adm', $db->getOne("SELECT COUNT(id) FROM cms_user WHERE u_isadmin=1"));
$tpl->assign('adm_url', 'cms_admin.php');
$tpl->assign('priv', $db->getOne("SELECT COUNT(id) FROM cms_role WHERE id>0"));
$tpl->assign('priv_url', 'cms_role.php');
$tpl->display(tpl());