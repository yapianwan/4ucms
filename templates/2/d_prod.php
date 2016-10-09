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
  <div class="breadcrumb breadcrumb-1 pos-center">
    <h1><?php echo $detail['d_name'];?></h1>
  </div>
  <div class="content"><!-- Content Section -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12"><!-- Room Gallery Slider -->
          <div class="room-gallery">
            <div class="margint40 marginb20"><h4>房间照片</h4></div>
            <div class="flexslider-thumb falsenav">
              <ul class="slides">
                <?php
                if($detail['d_ifslideshow']) {
                  $res = explode('|', $detail['d_slideshow']);
                  foreach($res as $val){
                    echo '<li data-thumb="'.$val.'"><img alt="Slider" class="img-responsive" src="'.$val.'"/></li>';
                  }
                }else{
                  echo '<li data-thumb="'.$t_path.'temp/room-gallery-image-1.jpg"><img alt="Slider 1" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-1.jpg"/></li><li data-thumb="'.$t_path.'temp/room-gallery-image-2.jpg"><img alt="Slider 1" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-2.jpg"/></li><li data-thumb="'.$t_path.'temp/room-gallery-image-3.jpg"><img alt="Slider 1" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-3.jpg"/></li><li data-thumb="'.$t_path.'temp/room-gallery-image-4.jpg"><img alt="Slider 1" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-4.jpg"/></li><li data-thumb="'.$t_path.'temp/room-gallery-image-5.jpg"><img alt="Slider 1" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-5.jpg"/></li><li data-thumb="'.$t_path.'temp/room-gallery-image-6.jpg"><img alt="Slider 1" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-6.jpg"/></li><li data-thumb="'.$t_path.'temp/room-gallery-image-7.jpg"><img alt="Slider 1" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-7.jpg"/></li><li data-thumb="'.$t_path.'temp/room-gallery-image-8.jpg"><img alt="Slider 1" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-8.jpg"/></li><li data-thumb="'.$t_path.'temp/room-gallery-image-9.jpg"><img alt="Slider 1" class="img-responsive" src="'.$t_path.'temp/room-gallery-image-9.jpg"/></li>';
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-9 clearfix"><!-- Room Information -->
          <div class="col-lg-12 clearfix col-sm-12">
            <h4>客房介绍</h4>
            <p class="margint30"><?php echo $detail['d_content'];?></p>
          </div>
        </div>
        <div class="col-lg-3 clearfix"><!-- Sidebar -->
          <div class="quick-reservation-container">
            <div class="quick-reservation clearfix">
              <div class="title-quick pos-center margint30">
                <h5>预订房间</h5>
                <div class="line"></div>
              </div>
              <div class="reserve-form-area">
                <form method="post" id="ajax-reservation-form">
                  <label>手机号码</label>
                  <input type="text" id="mobile" name="mobile" class="" placeholder="" />
                  <label>入住日期</label>
                  <input type="text" id="dpd1" name="dpd1" class="date-selector" placeholder="&#xf073;" />
                  <label>退房日期</label>
                  <input type="text" id="dpd2" name="dpd2" class="date-selector" placeholder="&#xf073;" />
                  <div class="pull-left children clearfix">
                    <label>预订房间</label>
                    <select name="rooms" class="pretty-select">
                      <option selected="selected" value="1" >1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                  <div class="pull-left type clearfix">
                    <label>成人</label>
                    <select name="adult" class="pretty-select">
                      <option selected="selected" value="1" >1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                  </select>
                  </div>
                  <div class="pull-left rooms clearfix">
                    <label>孩童</label>
                    <select name="children" class="pretty-select">
                      <option selected="selected" value="0" >0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                  <div class="pull-left search-button clearfix">
                    <div class="button-style-1">
                      <a id="res-submit" href="javascript:;">提交预订</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
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