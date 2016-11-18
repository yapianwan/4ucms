<!doctype html>
<html lang="zh">
<head><?php include 'inc/head.php';?></head>
<body class="scroll-assist" data-reveal-selectors="section:not(.masonry):not(:first-of-type):not(.parallax)" data-reveal-timing="1000">
  <a id="top"></a>
  <div class="loader"></div>
  <?php include 'inc/nav_index.php';?>
  <div class="main-container transition--fade">
    <?php include 'inc/banner.php';?>
    <section>
      <div class="container">
        <div class="row">
          <div class="masonry masonry-blog">
            <div class="masonry__container masonry--animate">
              <?php
              $pager = page_handle('page',$channel['c_page'],$db->getOne("SELECT COUNT(id) FROM cms_detail WHERE d_parent IN (".$channel['c_sub'].")"));
              $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN (".$channel['c_sub'].") ORDER BY d_order ASC,id DESC LIMIT ".$pager[0].",".$pager[1]);
              foreach ($res as $val) {
                echo '<div class="col-md-4 col-sm-6 masonry__item"><a href="'.d_url($val['id'],$val['d_link']).'"><div class="card card-4"><div class="card__image"><img alt="'.$val['d_name'].'" src="'.img_always($val['d_picture']).'" /></div><div class="card__body boxed boxed--sm bg--white"><h6>'.$val['d_name'].'</h6><div class="card__title"><h5>'.str_cut(str_text($val['d_content']),40).'</h5></div><hr><div class="card__lower"><span>'.local_date('Y-m-d',$val['d_date']).'</span></div></div></div></a></div>';
              }
              ?>
            </div>
            <!--end masonry container-->
          </div>
          <!--end masonry-->
          <div class="pagination-container">
            <hr>
            <ul class="pagination">
              <?php echo page_show($pager[2],$pager[3],'page',1);?>
            </ul>
          </div>
        </div>
        <!--end of row-->
      </div>
      <!--end of container-->
    </section>
    <?php include 'inc/footer.php';?>
  </div>
  <?php include 'inc/js.php';?>
</body>
</html>