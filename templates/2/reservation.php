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
  <div class="light-book-form margint60 marginb60">
    <div class="container">
      <div class="row pos-center">
        <div class="reserve-form-area">
          <div class="pos-center marginb20">
            <h2>预订表单</h2>
            <img src="<?php echo $t_path;?>img/shape.png">
          </div>
          <div class="col-lg-3"></div>
          <div class="col-lg-6">
            <form action="#" method="post" id="ajax-reservation-form">
              <ul class="clearfix">
                <li class="li-input">
                  <label>手机号码</label>
                  <input type="text" id="mobile" name="mobile" class="" placeholder="" />
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
                  <select name="adult" class="pretty-select">
                    <option selected="selected" value="1" >1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </li>
                <li class="li-select no-margin">
                  <label>孩童</label>
                  <select name="children" class="pretty-select">
                    <option selected="selected" value="0" >0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </li>
                <li class="clearfix"></li>
                <li>
                  <div class="button-style-1 clearfix margint70">
                    <a id="res-submit" href="#">预订房间</a>
                    <input type="hidden" name="room-name" value="<?php echo $prod['d_name'];?>">
                    <input type="hidden" name="act" value="roombook">
                  </div>
                </li>
              </ul>
            </form>
          </div>
          <div class="col-lg-3"></div>
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