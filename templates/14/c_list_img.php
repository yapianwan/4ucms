<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head><?php include 'inc/head.php';?></head>
<body>
<?php include 'inc/ie.php';?>
<div id="wrapper">
  <div class="header"><!-- Header Section -->
    <?php include 'inc/pre_header.php';?>
    <?php include 'inc/main_header.php';?>
  </div>
  <div class="content"><!-- Gallery Section -->
    <div class="container">
      <div class="row">
        <?php if (get_channel($channel['c_main'],"c_ifsub")) { ?>
        <div class="portfolio-filters clearfix">
          <ul>
            <?php
            $res = $db->getAll("SELECT * FROM cms_channel WHERE id IN (".$channel['c_sub'].") AND c_navigation = 1 ORDER BY c_order ASC,id ASC");
            echo '<li><a href="javascript:;" class="active" data-filter="*">全部</a></li>';
            foreach($res as $val){
              echo '<li><a href="javascript:;" data-filter=".'.$val['c_name'].'">'.$val['c_name'].'</a></li>';
            }
            ?>
          </ul>
        </div>
        <?php } ?>
        
        <div class="row portfolio-box">
          <?php
          $pager = page_handle('page',$channel['c_page'],$db->getOne("SELECT COUNT(id) FROM cms_detail WHERE d_parent IN (".$channel['c_sub'].")"));
          $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN (".$channel['c_sub'].") ORDER BY d_order ASC,id DESC LIMIT ".$pager[0].",".$pager[1]);
          if (!empty($res)) {
            foreach ($res as $val) {
              echo '<div class="col-lg-4 col-sm-6 gallery-box"> <a href="'.d_url($val['id'],$val['d_link']).'"><img alt="Gallery" class="img-responsive" src="'.img_always($val['d_picture']).'"> <h5>'.$val['d_name'].'</h5></a> </div>';
            }
          }else{
            echo '<div class="col-lg-4 col-sm-6 gallery-box">
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a style="display:none;" href="'.$t_path.'temp/room-gallery-image-2.jpg" rel="prettyPhoto[pp_gal]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a style="display:none;" href="'.$t_path.'temp/room-gallery-image-3.jpg" rel="prettyPhoto[pp_gal]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal]"><h5>SPA CENTER</h5></a>
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal]"><h6>2 PHOTOS</h6></a>
        </div>  
        <div class="col-lg-4 col-sm-6 gallery-box">
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal2]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-2.jpg"></a>
          <a style="display:none;" href="'.$t_path.'temp/room-gallery-image-2.jpg" rel="prettyPhoto[pp_gal2]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a style="display:none;" href="'.$t_path.'temp/room-gallery-image-3.jpg" rel="prettyPhoto[pp_gal2]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal2]"><h5>SPA CENTER</h5></a>
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal2]"><h6>2 PHOTOS</h6></a>
        </div>
        <div class="col-lg-4 col-sm-6 gallery-box">
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal3]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-3.jpg"></a>
          <a style="display:none;" href="'.$t_path.'temp/room-gallery-image-2.jpg" rel="prettyPhoto[pp_gal3]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a style="display:none;" href="'.$t_path.'temp/room-gallery-image-3.jpg" rel="prettyPhoto[pp_gal3]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal3]"><h5>SPA CENTER</h5></a>
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal3]"><h6>2 PHOTOS</h6></a>
        </div>
        <div class="col-lg-4 col-sm-6 gallery-box">
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_galx4]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-4.jpg"></a>
          <a style="display:none;" href="'.$t_path.'temp/room-gallery-image-2.jpg" rel="prettyPhoto[pp_gal4]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a style="display:none;" href="'.$t_path.'temp/room-gallery-image-3.jpg" rel="prettyPhoto[pp_gal4]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal4]"><h5>SPA CENTER</h5></a>
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal4]"><h6>2 PHOTOS</h6></a>
        </div>
        <div class="col-lg-4 col-sm-6 gallery-box">
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal5]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-5.jpg"></a>
          <a style="display:none;" href="'.$t_path.'temp/room-gallery-image-2.jpg" rel="prettyPhoto[pp_gal5]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a style="display:none;" href="'.$t_path.'temp/room-gallery-image-3.jpg" rel="prettyPhoto[pp_gal5]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal5]"><h5>SPA CENTER</h5></a>
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal5]"><h6>2 PHOTOS</h6></a>
        </div>
        <div class="col-lg-4 col-sm-6 gallery-box">
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal6]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-6.jpg"></a>
          <a style="display:none;" href="'.$t_path.'temp/room-gallery-image-2.jpg" rel="prettyPhoto[pp_gal6]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a style="display:none;" href="'.$t_path.'temp/room-gallery-image-3.jpg" rel="prettyPhoto[pp_gal6]"><img alt="Gallery" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"></a>
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal6]"><h5>SPA CENTER</h5></a>
          <a href="'.$t_path.'temp/room-gallery-image-1.jpg" rel="prettyPhoto[pp_gal6]"><h6>2 PHOTOS</h6></a>
        </div>';
          }
          ?>
          <div class="pagination-container reset-clearfix pos-center">
            <hr>
            <ul class="pagination">
              <?php echo page_show($pager[2],$pager[3],'page',1);?>
            </ul>
          </div>
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