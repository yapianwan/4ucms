<!DOCTYPE html>
<html lang="en-US">
<head><?php include 'inc/head.php';?></head>

<body class="">

  <div id="wrap" class="wrap menuStyle1 menuSmartScrollShow blogStyleExcerpt bodyStyleWide menuStyleFixed visibleMenuDisplay logoImageStyle logoStyleBG">
    <div id="wrapBox" class="wrapBox">

      <!-- header -->
      <?php include 'inc/header.php';?>

      <div class="wrapContent">
        <div id="wrapWide" class="wrapWide">
          <div class="content">

            <section class="singlePage post section_padding_bottom_50 with_border_bottom">
              <div class="container-fluid">
                <article class="postContent">
                  <h1 class="postTitle bodyStyleBoxed"><?php echo $detail['d_name'];?></h1>
                  <div class="post Standard">
                    <?php if ($detail['d_ifslideshow']) {?>
                    <div class="sc_slider sc_slider_style_2 sc_slider_swiper sc_slider_controls swiper-container margin_top_30 margin_bottom_30">
                      <ul class="slides swiper-wrapper" data-settings="none">
                        <?php
                        $res = str_array($detail['d_slideshow'],'|');
                        foreach ($res as $val) {
                          echo '<li class="swiper-slide" style="background-image:url('.$val.')" data-theme="dark"></li>';
                        }
                        ?>
                      </ul>
                      <ul class="slider-control-nav">
                        <li class="slide-prev">
                          <a class="icon-left-open-big" href="javascript:;"></a>
                        </li>
                        <li class="slide-next">
                          <a class="icon-right-open-big" href="javascript:;"></a>
                        </li>
                      </ul>
                    </div>
                    <?php }
                    echo $detail['d_content'];
                    ?>
                    </div>
                  </div>
                </article>
              </div>
            </section>

          </div>
        </div>
      </div>
  
      <!-- footer -->
      <?php include 'inc/footer.php';?>
    </div>

  </div>

  <div class="buttonScrollUp upToScroll icon-up-open-micro"></div>

  <!-- js -->
  <?php include 'inc/js.php';?>

</body>
</html>