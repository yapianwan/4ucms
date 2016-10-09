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
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-sm-4 margint60 hidden-xs"><!-- Sidebar -->
          <?php include 'inc/side.php';?>
        </div>
        <div class="col-lg-9 col-sm-8"><!-- Contact -->
          <div id="map" class="maps pos-center margint60"><?php echo $channel['c_scontent'];?></div>
          <div class="contact-form margint60"><!-- Contact Form -->
            <form action="ajax.php" method="post">
              <input type="text" placeholder="姓名" name="name" >
              <input type="text" placeholder="标题" name="subject" >
              <input type="text" placeholder="电子邮箱" name="email" >
              <textarea placeholder="写下您想要表达的..." name="message"></textarea>
              <input class="pull-right margint10" type="submit" value="提交">
              <input type="hidden" name="act" value="feedback_post">
            </form>
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