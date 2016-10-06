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
                  <h1 class="postTitle"><?php echo $detail['d_name'];?></h1>
                  <div class="postInfo hoverUnderline">
                    <div class="postWrap">
                      <span class="postSpan postCategory">
                        类别：<a class="cat_link" href="<?php echo c_url($detail['d_parent']);?>"><?php echo $channel['c_name'];?></a>
                      </span>
                      <span class="postSpan postAuthor">
                        作者：<?php echo $detail['d_author']?$detail['d_author']:'管理员';?>
                      </span>
                      <span class="postSpan postDate">
                        日期：<?php echo local_date('M d, Y',$detail['d_date']);?>
                      </span>
                    </div>
                    <div class="postWrap"> </div>
                  </div>
                  <div class="postTextArea">
                    <div class="">
                      <?php
                      echo $detail['d_content'];
                      if ($detail['d_ifslideshow']) {
                        echo '<div id="sc_gallery_1" class="sc_gallery sc_columns_4" >';
                        $res = str_array($detail['d_slideshow'],'|');
                        foreach ($res as $val) {
                          echo '<div class="sc_columns_item sc_gallery_item"> <div class="thumb"> <img alt="'.$detail['d_name'].'" src="'.$val.'"> </div> <a class="sc_gallery_info_wrap" href="'.$val.'" data-image="'.$val.'" title="'.$detail['d_name'].'"> <span class="sc_gallery_info"> <span class="sc_gallery_href icon-search"></span> </span> </a> </div>';
                        }
                        echo '</div>';
                      }
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