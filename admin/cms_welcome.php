<?php
include '../library/inc.php';
include 'cms_check.php';

$chn = $db->getOne("SELECT COUNT(id) FROM cms_channel");
$dtl = $db->getOne("SELECT COUNT(id) FROM cms_detail");
$sld = $db->getOne("SELECT COUNT(id) FROM cms_slideshow");
$chip = $db->getOne("SELECT COUNT(id) FROM cms_chip");
$usr = $db->getOne("SELECT COUNT(id) FROM cms_user WHERE u_isadmin=0");
$fdb = $db->getOne("SELECT COUNT(id) FROM cms_feedback");
$link = $db->getOne("SELECT COUNT(id) FROM cms_link");
$tpl = $db->getOne("SELECT COUNT(id) FROM cms_template");
$adm = $db->getOne("SELECT COUNT(id) FROM cms_user WHERE u_isadmin=1");
$priv = $db->getOne("SELECT COUNT(id) FROM cms_role WHERE id>0");
?>
<!DOCTYPE html>
<html class="no-js fixed-layout">
<head>
<?php include 'inc_head.php';?>
</head>

<body>
<?php include 'inc_header.php';?>

<div class="am-cf admin-main">
  <!-- content start -->
  <div class="admin-content">
    <div class="am-g am-g-fixed">
    
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">管理员: <?php echo $_COOKIE['admin_name'];?></strong></div>
    </div>

    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><a href="cms_channel.php"><span class="am-icon-btn am-icon-th-large"></span><br>站点频道: <?php echo $chn;?></a></li>
      <li><a href="cms_detail.php?cid=0"><span class="am-icon-btn am-icon-file-text"></span><br/>频道详情: <?php echo $dtl;?></a></li>
      <li><a href="cms_slideshow.php"><span class="am-icon-btn am-icon-archive"></span><br/>幻灯片: <?php echo $sld;?></a></li>
      <li><a href="cms_chip.php"><span class="am-icon-btn am-icon-file-code-o"></span><br/>代码碎片: <?php echo $chip;?></a></li>
    </ul>
    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><a href="cms_member.php"><span class="am-icon-btn am-icon-users"></span><br/>会员: <?php echo $usr;?></a></li>
      <li><a href="cms_feedback.php"><span class="am-icon-btn am-icon-comment"></span><br/>在线留言: <?php echo $fdb;?></a></li>
      <li><a href="cms_link.php"><span class="am-icon-btn am-icon-link"></span><br/>友情连接: <?php echo $link;?></a></li>
      <li><a href="cms_template.php"><span class="am-icon-btn am-icon-laptop"></span><br/>站点模版: <?php echo $tpl;?></a></li>
    </ul>
    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><a href="cms_admin.php"><span class="am-icon-btn am-icon-user"></span><br/>管理员: <?php echo $adm;?></a></li>
      <li><a href="cms_role.php"><span class="am-icon-btn am-icon-graduation-cap"></span><br/>权限管理: <?php echo $priv;?></a></li>
    </ul>
    
    </div>
  </div>
  <!-- content end -->
</div>

<?php include 'inc_footer.php';?>
</body>
</html>