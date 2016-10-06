<header id="header">
  <div class="menuFixedWrapBlock"></div>
  <div class="menuFixedWrap">
    <a href="#" class="openMobileMenu"></a>
    <a href="#" class="openTopMenu"></a>
    <div class="wrapTopMenu">
      <div class="topMenu main">
        <?php echo navigation(0,'<li><a href="./">网站首页</a></li>',@$c_main,2,'','sub-menu');?>
      </div>
    </div>
  </div>
  <div class="logoHeader">
    <a href="./">
      <img src="<?php echo $t_path;?>images/logo.png" alt="<?php echo $cms['s_name'];?>">
    </a>
  </div>
  <div class="subTitle">&nbsp;</div>
</header>