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
  <div class="content"><!-- Content Section -->
    <div class="container margint60">
      <div class="row">
        <?php
        $pager = page_handle('page',$channel['c_page'],$db->getOne("SELECT COUNT(id) FROM cms_detail WHERE d_parent IN (".$channel['c_sub'].")"));
        $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN (".$channel['c_sub'].") ORDER BY d_order ASC,id DESC LIMIT ".$pager[0].",".$pager[1]);
        if (!empty($res)) {
          foreach ($res as $val) {
            echo '<div class="col-lg-4 col-sm-6 clearfix"><div class="home-room-box clearfix"><a href="'.d_url($val['id'],$val['d_link']).'"><div class="room-image">'.($val['d_rec']?'<div class="room-features">推荐</div>':'').'<img alt="Room Images" class="img-responsive" src="'.img_always($val['d_picture']).'"><div class="home-room-details"><h5>'.$val['d_name'].'</h5></div></a></div><div class="room-details"><p>'.str_cut(str_text($val['d_content']),68,'').'[...]</p></div><div class="room-bottom"><div class="pull-left"><h4>￥'.str_part($val['d_price'],'.').'<span class="room-bottom-time">/ 天</span></h4></div><div class="pull-right"><div class="button-style-1"><a href="reservation.php?id='.$val['id'].'">立即预订</a></div></div></div></div></div>';
          }
        }else{
          echo '<div class="col-lg-4 col-sm-6 clearfix">
            <div class="home-room-box clearfix">
              <div class="room-image">
                <img alt="Room Images" class="img-responsive" src="'.$t_path.'temp/room-image-1.jpg">
                <div class="home-room-details">
                  <h5><a href="#">The luxury room in Istanbul</a></h5>
                  <div class="pull-left">
                    <ul>
                      <li><i class="fa fa-calendar"></i></li>
                      <li><i class="fa fa-flask"></i></li>
                      <li><i class="fa fa-umbrella"></i></li>
                      <li><i class="fa fa-laptop"></i></li>
                    </ul>
                  </div>
                  <div class="pull-right room-rating">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star inactive"></i></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="room-details">
                <p>Vestibulum id ligula porta felis euismod semper. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tibulum at ero[...]</p>
              </div>
              <div class="room-bottom">
                <div class="pull-left"><h4>89$<span class="room-bottom-time">/ Day</span></h4></div>
                <div class="pull-right">
                  <div class="button-style-1">
                    <a href="#">BOOK NOW</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 clearfix">
            <div class="home-room-box clearfix">
              <div class="room-image">
                <img alt="Room Images" class="img-responsive" src="'.$t_path.'temp/room-image-2.jpg">
                <div class="home-room-details">
                  <h5><a href="#">The King Room</a></h5>
                  <div class="pull-left">
                    <ul>
                      <li><i class="fa fa-calendar"></i></li>
                      <li><i class="fa fa-flask"></i></li>
                      <li><i class="fa fa-umbrella"></i></li>
                      <li><i class="fa fa-laptop"></i></li>
                    </ul>
                  </div>
                  <div class="pull-right room-rating">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star inactive"></i></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="room-details">
                <p>Vestibulum id ligula porta felis euismod semper. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tibulum at ero[...]</p>
              </div>
              <div class="room-bottom">
                <div class="pull-left"><h4>89$<span class="room-bottom-time">/ Day</span></h4></div>
                <div class="pull-right">
                  <div class="button-style-1">
                    <a href="#">BOOK NOW</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 clearfix">
            <div class="home-room-box clearfix">
              <div class="room-image">
                <img alt="Room Images" class="img-responsive" src="'.$t_path.'temp/room-image-3.jpg">
                <div class="home-room-details">
                  <h5><a href="#">Awesome Suits</a></h5>
                  <div class="pull-left">
                    <ul>
                      <li><i class="fa fa-calendar"></i></li>
                      <li><i class="fa fa-flask"></i></li>
                      <li><i class="fa fa-umbrella"></i></li>
                      <li><i class="fa fa-laptop"></i></li>
                    </ul>
                  </div>
                  <div class="pull-right room-rating">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star inactive"></i></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="room-details">
                <p>Vestibulum id ligula porta felis euismod semper. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tibulum at ero[...]</p>
              </div>
              <div class="room-bottom">
                <div class="pull-left"><h4>89$<span class="room-bottom-time">/ Day</span></h4></div>
                <div class="pull-right">
                  <div class="button-style-1">
                    <a href="#">BOOK NOW</a>
                  </div>
                </div>
              </div>
            </div>
          </div>    
          <div class="col-lg-4 col-sm-6 clearfix">
            <div class="home-room-box clearfix">
              <div class="room-image">
                <img alt="Room Images" class="img-responsive" src="'.$t_path.'temp/room-image-4.jpg">
                <div class="home-room-details">
                  <h5><a href="#">The luxury room in Istanbul</a></h5>
                  <div class="pull-left">
                    <ul>
                      <li><i class="fa fa-calendar"></i></li>
                      <li><i class="fa fa-flask"></i></li>
                      <li><i class="fa fa-umbrella"></i></li>
                      <li><i class="fa fa-laptop"></i></li>
                    </ul>
                  </div>
                  <div class="pull-right room-rating">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star inactive"></i></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="room-details">
                <p>Vestibulum id ligula porta felis euismod semper. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tibulum at ero[...]</p>
              </div>
              <div class="room-bottom">
                <div class="pull-left"><h4>89$<span class="room-bottom-time">/ Day</span></h4></div>
                <div class="pull-right">
                  <div class="button-style-1">
                    <a href="#">BOOK NOW</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 clearfix">
            <div class="home-room-box clearfix">
              <div class="room-image">
                <img alt="Room Images" class="img-responsive" src="'.$t_path.'temp/room-image-5.jpg">
                <div class="home-room-details">
                  <h5><a href="#">The King Room</a></h5>
                  <div class="pull-left">
                    <ul>
                      <li><i class="fa fa-calendar"></i></li>
                      <li><i class="fa fa-flask"></i></li>
                      <li><i class="fa fa-umbrella"></i></li>
                      <li><i class="fa fa-laptop"></i></li>
                    </ul>
                  </div>
                  <div class="pull-right room-rating">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star inactive"></i></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="room-details">
                <p>Vestibulum id ligula porta felis euismod semper. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tibulum at ero[...]</p>
              </div>
              <div class="room-bottom">
                <div class="pull-left"><h4>89$<span class="room-bottom-time">/ Day</span></h4></div>
                <div class="pull-right">
                  <div class="button-style-1">
                    <a href="#">BOOK NOW</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 clearfix">
            <div class="home-room-box clearfix">
              <div class="room-image">
                <img alt="Room Images" class="img-responsive" src="'.$t_path.'temp/room-image-6.jpg">
                <div class="home-room-details">
                  <h5><a href="#">Awesome Suits</a></h5>
                  <div class="pull-left">
                    <ul>
                      <li><i class="fa fa-calendar"></i></li>
                      <li><i class="fa fa-flask"></i></li>
                      <li><i class="fa fa-umbrella"></i></li>
                      <li><i class="fa fa-laptop"></i></li>
                    </ul>
                  </div>
                  <div class="pull-right room-rating">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star inactive"></i></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="room-details">
                <p>Vestibulum id ligula porta felis euismod semper. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tibulum at ero[...]</p>
              </div>
              <div class="room-bottom">
                <div class="pull-left"><h4>89$<span class="room-bottom-time">/ Day</span></h4></div>
                <div class="pull-right">
                  <div class="button-style-1">
                    <a href="#">BOOK NOW</a>
                  </div>
                </div>
              </div>
            </div>
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
  <?php include 'inc/footer.php';?>
</div>
<!-- JS FILES -->
<?php include 'inc/js.php';?>
</body>
</html>