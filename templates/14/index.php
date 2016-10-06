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
  <?php
  $res = $db->getAll("SELECT * FROM cms_slidershow WHERE s_parent='index' ORDER BY s_order ASC,id DESC");
  ?>
  <div class="slider slider-home"><!-- Slider Section -->
    <div class="flexslider slider-loading falsenav">
      <ul class="slides">
        <?php
        if ($res) {
          foreach ($res as $val) {
            echo '<li><img alt="Slider '.$val['id'].'" class="img-responsive" src="'.$val['s_picture'].'" /></li>';
          }
        }else{
          echo '<li><img alt="Slider 1" class="img-responsive" src="'.$t_path.'temp/sli-1.jpg" /></li><li><img alt="Slider 2" class="img-responsive" src="'.$t_path.'temp/sli-2.jpg" /></li>';
        }
        ?>
      </ul>
    </div>
    <div class="book-slider">
      <div class="container">
        <div class="row pos-center">
          <div class="reserve-form-area">
            <form action="#" method="post" id="ajax-reservation-form">
              <ul class="clearfix">
                <li class="li-input">
                  <label>手机号码</label>
                  <input type="text" id="mobile" name="mobile" minlength="11" maxlength="11" required="required" placeholder="" />
                </li>
                <li class="li-input">
                  <label>入住日期</label>
                  <input type="text" id="dpd1" name="dpd1" class="date-selector" placeholder="&#xf073;" />
                </li>
                <li class="li-input">
                  <label>退房日期</label>
                  <input type="text" id="dpd2" name="dpd2" class="date-selector" placeholder="&#xf073;" />
                </li>
                <li class="li-select">
                  <label>预定房间</label>
                  <select name="rooms" id="rooms" class="pretty-select"> <option selected="selected" value="1" >1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> </select>
                </li>
                <li class="li-select">
                  <label>成人</label>
                  <select name="adult" id="adult" class="pretty-select">
                    <option selected="selected" value="1" >1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </li>
                <li class="li-select">
                  <label>孩童</label>
                  <select name="children" id="children" class="pretty-select">
                    <option selected="selected" value="0" >0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </li>
                <li>
                  <div class="button-style-1 margint40">
                    <a id="res-submit" href="javascript:;"><i class="fa fa-search"></i>预订房间</a>
                    <input type="hidden" name="act" value="book">
                  </div>
                </li>
              </ul>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="bottom-book-slider">
      <div class="container">
        <div class="row pos-center">
          <ul>
            <?php echo get_chip('index-service');?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="content"><!-- Content Section -->
    <div class="about clearfix"><!-- About Section -->
      <div class="container">
        <div class="row">
          <div class="about-title pos-center">
            <?php
            $cid = 1;
            ?>
            <h2>欢迎光临<?php echo $cms['s_name'];?></h2>
            <div class="title-shape"><img alt="Shape" src="<?php echo $t_path;?>img/shape.png"></div>
            <p><?php echo str_text(get_channel($cid,'c_scontent'));?></p>
          </div>
          <div class="otel-info margint60">
            <div class="col-lg-4 col-sm-12">
              <div class="flexslider">
                <ul class="slides">
                  <?php
                  if(get_channel($cid,'c_ifslideshow')) {
                    $str = get_channel($cid,'c_slideshow');
                    $arr_slideshow = explode('|', $str);
                    foreach($arr_slideshow as $val) {
                      echo '<li><img alt="Slider" class="img-responsive" src="'.$val.'" /></li>';
                    }
                  }else{
                    echo '<li><img alt="Slider 1" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg" /></li><li><img alt="Slider 2" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-2.jpg" /></li>';
                  }
                  ?>
                </ul>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="title-style-1 marginb40">
                <h5><?php echo get_channel($cid,'c_name');?></h5>
                <hr>
              </div>
              <?php echo str_cut(str_text(get_channel($cid,'c_content')),240);?>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="title-style-1 marginb40">
                <?php
                $cid = 2;
                $csub = get_channel($cid,'c_sub');
                ?>
                <h5><?php echo get_channel($cid,'c_name');?></h5>
                <hr>
              </div>
              <div class="home-news">
                <?php
                $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN ($csub) ORDER BY d_order ASC,id DESC LIMIT 0,2");
                if (!empty($res)) {
                  foreach($res as $val) {
                    echo '<div class="news-box clearfix"> <div class="news-time pull-left"> <div class="news-date pos-center"><div class="date-day">'.local_date('d',$val['d_date']).'<hr /></div>'.local_date('M',$val['d_date']).'</div> </div> <div class="news-content pull-left"> <h6><a href="'.d_url($val['id'],$val['d_link']).'">'.$val['d_name'].'</a></h6> <p class="margint10">'.str_cut(str_text($val['d_content']),40,'').' <a class="active-color" href="'.d_url($val['id'],$val['d_link']).'">[...]</a></p> </div> </div>';
                  }
                }else{
                  echo '<div class="news-box clearfix"> <div class="news-time pull-left"> <div class="news-date pos-center"><div class="date-day">20<hr /></div>MAY</div> </div> <div class="news-content pull-left"> <h6><a href="#">News from us from now</a></h6> <p class="margint10">Donec ullamcorper nulla non metus auctor fringilla. Donec sed odio dui <a class="active-color" href="#">[...]</a></p> </div> </div> <div class="news-box clearfix"> <div class="news-time pull-left"> <div class="news-date pos-center"><div class="date-day">20<hr /></div>MAY</div> </div> <div class="news-content pull-left"> <h6><a href="#">News from us from now</a></h6> <p class="margint10">Donec ullamcorper nulla non metus auctor fringilla. Donec sed odio dui. Nulla vitae elit libero, a pharetra augue <a class="active-color" href="#">[...]</a></p> </div> </div>';
                }
                ?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="explore-rooms margint30 clearfix"><!-- Explore Rooms Section -->
      <div class="container">
        <div class="row">  
          <div class="title-style-2 marginb40 pos-center">
            <h3>浏览房间</h3>
            <hr>
          </div>
          <?php
          $cid = 3;
          $csub = get_channel($cid,'c_sub');
          $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN ($csub) ORDER BY d_order ASC,id DESC LIMIT 0,3");
          if (!empty($res)) {
            foreach ($res as $val) {
              echo '<div class="col-lg-4 col-sm-4"> <div class="home-room-box"> <a href="'.d_url($val['id'],$val['d_link']).'"><div class="room-image"> '.($val['d_rec']?'<div class="room-features">推荐</div>':'').' <img alt="'.$val['d_name'].'" class="img-responsive" src="'.img_always($val['d_picture']).'"> <div class="home-room-details"> <h5>'.$val['d_name'].'</h5> </div></a> </div> <div class="room-details"> <p>'.str_cut(str_text($val['d_content']),48).'</p> </div> <div class="room-bottom"> <div class="pull-left"><h4>￥'.str_part($val['d_price'],'.').'<span class="room-bottom-time">/ 天</span></h4></div> <div class="pull-right"> <div class="button-style-1"> <a href="reservation.php?id='.$val['id'].'">立即预订</a> </div> </div> </div> </div> </div>';
            }
          }
          ?>
        </div>
      </div>
    </div>
    <div id="parallax123" class="parallax parallax-one clearfix margint60"><!-- Parallax Section -->
      <div class="support-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-sm-4">
              <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                <div class="flipper">
                  <div class="support-box pos-center front">
                    <div class="support-box-title"><i class="fa fa-phone"></i></div>
                    <h4>电话联系</h4>
                    <p class="margint20">您可以通过提供的电话号码与我们取得联系</p>
                  </div>
                  <div class="support-box pos-center back">
                    <div class="support-box-title"><i class="fa fa-phone"></i></div>
                    <h4>电话号码</h4>
                    <p class="margint20">欢迎您致电<br /><?php echo get_chip('contact-hotline');?></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-4">
              <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                <div class="flipper">
                  <div class="support-box pos-center front">
                    <div class="support-box-title"><i class="fa fa-envelope"></i></div>
                    <h4>邮件联系</h4>
                    <p class="margint20">您也可以通过提供的电子邮箱与我们取得联系</p>
                  </div>
                  <div class="support-box pos-center back">
                    <div class="support-box-title"><i class="fa fa-envelope"></i></div>
                    <h4>电子邮箱</h4>
                    <p class="margint20">欢迎您发送电子邮件至<br /><?php echo get_chip('contact-mail');?></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-4">
              <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                <div class="flipper">
                  <div class="support-box pos-center front">
                    <div class="support-box-title"><i class="fa fa-home"></i></div>
                    <h4>登门联系</h4>
                    <p class="margint20">我们随时欢迎您来店咨询相关事宜</p>
                  </div>
                  <div class="support-box pos-center back">
                    <div class="support-box-title"><i class="fa fa-home"></i></div>
                    <h4>企业地址</h4>
                    <p class="margint20">欢迎您来店咨询<br /><?php echo get_chip('contact-addr');?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="newsletter-section"><!-- Newsletter Section -->
      <div class="container">
        <div class="row">
          <div class="newsletter-top pos-center margint30">
            <img alt="Shape Image" src="<?php echo $t_path;?>img/shape.png" >
          </div>
          <div class="newsletter-form margint40 pos-center">
            <div class="newsletter-wrapper">
              <div class="pull-left">
                <h2>邮件订阅</h2>
              </div>
              <div class="pull-left">
                <form action="ajax.php?act=subscribe" method="post" id="ajax-contact-form">
                  <input type="text" name="sub-mail" placeholder="请输入电子邮箱">
                  <input type="submit" value="提交" >
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include 'inc/footer.php';?>
  </div>
</div>
<!-- JS FILES -->
<?php include 'inc/js.php';?>
<script>
$(function(){
  $("#res-submit").click(function(){
    var mobile = $("#mobile").val();
    var dpd1 = $("#dpd1").val();
    var dpd2 = $("#dpd2").val();
    if (mobile=="") {
      alert("手机号码不能为空");
      return false;
    }
    if (dpd1=="") {
      alert("入住日期不能为空");
      return false;
    }
    if (dpd2=="") {
      alert("退房日期不能为空");
      return false;
    }
    var dataString = $("#ajax-reservation-form").serialize();
    $.ajax({
      type:"post",
      url:"ajax.php",
      data:dataString,
      dataType:"json",
      success:function(res){
        alert(res.msg);
      },
      error:function(){
        alert('预订失败，请稍后重试！');
      }
    });
  });
})
</script>
</body>
</html>