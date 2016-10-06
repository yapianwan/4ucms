<!DOCTYPE html>
<html lang="en-US">
<head><?php include 'inc/head.php';?></head>

<body class="page">

  <div id="wrap" class="wrap fullWidth menuStyle1 menuSmartScrollShow bodyStyleFullWide menuStyleFixed visibleMenuDisplay logoImageStyle logoStyleBG" >
    <div id="wrapBox" class="wrapBox">

      <!-- header -->
      <?php include 'inc/header.php';?>

      <div class="wrapContent">
        <div id="wrapWide" class="wrapWide">
          <div class="content">
            <section class="singlePage emptyPostFormatIcon emptyPostTitle emptyPostInfo page">
              <article class="postContent">
                <div class="postTextArea">

                  <section class="">
                    <div class="container-fluid">
                      <div class="sc_blogger sc_blogger_horizontal style_portfolio_big portfolioWrap sc_blogger_indent">
                        <div class="masonryWrap">
                          <section class="masonryStyle isotopeWrap portfolio_big" data-foliosize="600">
                            <?php
                            $cid = 3;
                            $size = 3;
                            $csub = get_channel($cid,'c_sub');
                            $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN ($csub) ORDER BY d_order ASC,id DESC LIMIT 0,$size");
                            foreach ($res as $key=>$val) {
                              echo '<article class="isotopeItem post_format_standard isw_1'.($key%2?' even':' odd').''.($key+1==$size?' last':'').'" data-postid="'.$val['id'].'" data-wdh="620" data-hgt="620" data-incw="1" data-inch="1"> <a href="'.d_url($val['id']).'" class="isotopeItemWrap"> <div class="thumb"> <img src="'.img_always($val['d_picture']).'" alt="'.$val['d_name'].'"> </div> <div class="isotopeMore icon-down-open-big"> </div> <div class="isotopeContentWrap"> <div class="isotopeContent"> <h4 class="isotopeTitle">'.$val['d_name'].'</h4> <div class="isotopeExcerpt">'.str_cut(str_text($val['d_content']),36).'</div> </div> </div> </a> </article>';
                            }
                            ?>
                          </section>
                        </div>
                      </div>
                    </div>
                  </section>

                  <section class="">
                    <div class="container-fluid">
                      <div class="sc_blogger sc_blogger_horizontal style_portfolio_mini portfolioWrap sc_blogger_indent">
                        <div class="masonryWrap">
                          <section class="masonryStyle isotopeWrap portfolio_mini" data-foliosize="300">
                            <?php
                            $cid = 3;
                            $size = 12;
                            $csub = get_channel($cid,'c_sub');
                            $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN ($csub) ORDER BY d_order ASC,id DESC LIMIT 3,$size");
                            foreach ($res as $key=>$val) {
                              if ($val['d_ifpicture']) {
                                echo '<article class="isotopeItem post_format_standard isw_1'.($key%2?' even':' odd').''.($key+1==$size?' last':'').'" data-postid="'.$val['id'].'" data-wdh="620" data-hgt="620" data-incw="1" data-inch="1"> <a href="'.d_url($val['id']).'" class="isotopeItemWrap"> <div class="thumb"> <img src="'.img_always($val['d_picture']).'" alt="'.$val['d_name'].'"> </div> <div class="isotopeMore icon-down-open-big"> </div> <div class="isotopeContentWrap"> <div class="isotopeContent"> <h4 class="isotopeTitle">'.$val['d_name'].'</h4> <div class="isotopeExcerpt">'.str_cut(str_text($val['d_content']),36).'</div> </div> </div> </a> </article>';
                              } else {
                                echo '<article class="isotopeItem post_format_standard isw_1'.($key%2?' even':' odd').''.($key+1==$size?' last':'').'" data-postid="'.$val['id'].'" data-wdh="620" data-hgt="620" data-incw="1" data-inch="1"> <div data-url="'.d_url($val['id']).'" class="isotopeItemWrap"> <div class="isotopeMore icon-down-open-big"></div> <div class="isotopeStatickWrap"> <div class="isotopeStatick"> <div class="postFormatIcon icon-post"> </div> <div class="isotopeTags"> <a class="tag_link" href="'.c_url($val['d_parent']).'">'.get_channel($val['d_parent'],'c_name').'</a> </div> <h3 class="isotopeTitle lower"> <a href="'.d_url($val['id']).'">'.$val['d_name'].'</a> </h3> <div class="postInfo hoverUnderline"> <div class="postWrap"></div> </div> <div class="isotopeExcerpt">'.str_cut(str_text($val['d_content']),50).'</div> <a href="'.d_url($val['id']).'" class="isotopeReadMore">read more</a> </div> </div> </div> </article>';  
                              }
                            }
                            ?>
                          </section>
                        </div>
                      </div>
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
