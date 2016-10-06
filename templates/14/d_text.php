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
        <div class="col-lg-9 col-sm-8 blog-post-contents">
          <div class="blog-post"><!-- Blog Post -->
            <h3><?php echo $detail['d_name'];?></h3>
            <div class="post-materials  clearfix">
              <ul>                                
                <li><h6><a href="#"><i class="fa fa-calendar"></i><?php echo local_date('M d Y',$detail['d_date']);?></a></h6></li>
                <li><h6><a href="#"><i class="fa fa-user"></i><?php echo !empty($detail['d_author'])?$detail['d_author']:'网站管理员';?></a></h6></li>
                <li><h6><a href="#"><i class="fa fa-tags"></i><?php echo !empty($detail['d_source'])?$detail['d_source']:$cms['s_name'];?></a></h6></li>
              </ul>
            </div>
            <?php
            if (!empty($detail['d_picture'])) echo '<div class="blog-image marginb30 margint30"><img alt="Blog Image 2" class="img-responsive" src="'.$detail['d_picture'].'" alt="'.$detail['d_name'].'" ></div>';
            ?>
            <div class="post-content margint10"><?php echo $detail['d_content'];?></div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-4 margint60 hidden-xs"><!-- Sidebar -->
          <div class="luxen-widget news-widget">
            <div class="title">
              <h5>近期讯息</h5>
            </div>
            <ul class="sidebar-recent">
              <?php
              $cid = 2;
              $csub = get_channel($cid,'c_sub');
              $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN ($csub) ORDER BY d_order ASC,id DESC LIMIT 0,2");
              if (!empty($res)) {
              foreach ($res as $val){
                echo '<li class="clearfix"> <h6><a href="'.d_url($val['id'],$val['d_link']).'">'.$val['d_name'].'</a></h6> <div class="pull-left blg-img margint20"> <img src="'.$val['d_picture'].'" class="img-responsive" alt=""> </div> <div class="pull-left blg-txt"> <p>'.str_cut(str_text($val['d_content']),42,'').' <a class="active-color" href="'.d_url($val['id'],$val['d_link']).'">[...]</a></p> </div> </li>';
              }
            }else{
              echo '<li class="clearfix"> <h6><a href="#"></a></h6> <div class="pull-left blg-img margint20"> <img src="temp/sidebar-news-image-1.jpg" class="img-responsive" alt=""> </div> <div class="pull-left blg-txt"> <p>Donec ullamcorper nulla non metus auctor Nulla vitae elit libero, a pharetra augue <a class="active-color" href="#">[...]</a></p> </div> </li> <li class="clearfix"> <h6><a href="#">Its Summary for news</a></h6> <div class="pull-left blg-img margint20"> <img src="temp/sidebar-news-image-2.jpg" class="img-responsive" alt=""> </div> <div class="pull-left blg-txt"> <p>Donec ullamcorper nulla non metus auctor Nulla vitae elit libero, a pharetra augue <a class="active-color" href="#">[...]</a></p> </div> </li>'; }
              ?>
            </ul>
          </div>
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