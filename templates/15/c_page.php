<!DOCTYPE html>
<html lang="en-US">
<head><?php include 'inc/head.php';?></head>

<body class="home page">

  <div id="wrap" class="wrap fullWidth menuStyle1 menuSmartScrollShow bodyStyleFullWide menuStyleFixed visibleMenuDisplay logoImageStyle logoStyleBG" >
    <div id="wrapBox" class="wrapBox">

      <!-- header -->
      <?php include 'inc/header.php';?>

      <div class="topTitle subCategoryStyle1">
        <div class="subCategory">
          <h4 class="categoryTitle main"><?php echo $channel['c_name'];?></h4>
        </div>
      </div>

      <div class="wrapContent">
        <div id="wrapWide" class="wrapWide">
          <div class="content">
            <section class="singlePage emptyPostFormatIcon emptyPostTitle emptyPostInfo page">
              <article class="postContent">
                <div class="postTextArea">
                  
                  <section class="">
                    <div class="container">
                      <section class="singlePage emptyPostFormatIcon emptyPostTitle emptyPostInfo">
                        <article class="postContent">
                          <div class="postTextArea">

                            <div class="sc_content mainWrap">
                              
                              <section class="section_padding_bottom_70 with_border_bottom">
                                <div class="container-fluid">
                                  <?php
                                  if ($channel['id']==1) {
                                  ?>
                                  <div class=" sc_columns  sc_columns_2 sc_columns_indent">
                                    <div class=" sc_columns_item  sc_columns_item_coun_1 odd first" >
                                      <div  class="sc_image alignleft"><img  src="<?php echo img_always($channel['c_picture']);?>" alt="" /></div>
                                    </div>
                                    <div class=" sc_columns_item  sc_columns_item_coun_2 even" >
                                      <h2 class="sc_title sc_title_style_3 margin_bottom_25">企业简介</h2>
                                      <div class="margin_bottom_50">
                                        <?php echo $channel['c_content'];?>
                                      </div>
                                    </div>
                                  </div>
                                  <?php }else{ ?>
                                  <div class="sc_columns  sc_columns_1 sc_columns_indent">
                                  <?php echo $channel['c_content'];?>
                                  </div>
                                  <?php } ?>
                                </div>
                              </section>
                        
                              <section class="section_padding_top_90 section_padding_bottom_70 with_border_bottom partner">
                                <div class="container">
                                  <h3 class="sc_title sc_title_center sc_title_style_1 margin_bottom_50">
                                  合作伙伴</h3>
                                  <div class=" sc_columns  sc_columns_7 sc_columns_indent">
                                    <?php
                                    $res = $db->getAll("SELECT * FROM cms_link ORDER BY l_order ASC,id DESC LIMIT 0,7");
                                    foreach ($res as $key=>$val) {
                                      echo '<div class=" sc_columns_item sc_columns_item_coun_'.$key.($key%2?' even':' odd').($key==0?' first':'').'" > <div  class="sc_image"> <a href="'.$val['l_link'].'"> <img src="'.img_always($val['l_picture']).'" alt="'.$val['l_name'].'" /> </a> </div> </div>';
                                    }
                                    ?>
                                  </div>                        
                                </div>
                              </section>

                            </div>
                          </div>
                        </article>
                      </section>
                    </div>
                  </section>

                </div>
              </article>
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
