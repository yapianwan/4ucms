<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head><?php include 'inc/head.php';?></head>
<body>
<?php include 'inc/ie.php';?>
<div id="wrapper" class="fitvids">
  <div class="header"><!-- Header Section -->
    <?php include 'inc/pre_header.php';?>
    <?php include 'inc/main_header.php';?>
  </div>
  <div class="content"><!-- Content Section -->
    <div class="container">
      <div class="row">
        <?php
        if ($detail['d_ifslideshow']) {
          $arr_slideshow = explode('|', $detail['d_slideshow']);
          echo '<div class="about-slider margint40"><div class="col-lg-12"><div class="flexslider"><ul class="slides">';
          foreach ($arr_slideshow as $val) {
            echo '<li><img alt="'.$detail['d_name'].'" class="img-responsive" src="'.$val.'" /></li>';
          }
          echo '</ul></div></div></div>';
        }
        ?>
        <div class="clearfix"></div>
        <div class="col-lg-9 col-sm-8 blog-post-contents">
          <div class="blog-post"><!-- Blog Post -->
            <h3><?php echo $detail['d_name'];?></h3>
            <div class="post-materials  clearfix"></div>
            <div class="post-content margint10"><?php echo $detail['d_content'];?></div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-4 margint60 hidden-xs"><!-- Sidebar -->
          <?php include 'inc/side.php';?>
        </div>
      </div>
    </div>
  </div>
  <?php include 'inc/footer.php';?>
</div>
<!-- JS FILES -->
<?php include 'inc/js.php';?>
</body>
</html>