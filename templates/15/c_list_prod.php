<!DOCTYPE html>
<html lang="en-US">
<head><?php include 'inc/head.php';?></head>

<body class="page">

  <div id="wrap" class="wrap fullWidth menuStyle1 menuSmartScrollShow bodyStyleFullWide menuStyleFixed visibleMenuDisplay logoImageStyle logoStyleBG" >
    <div id="wrapBox" class="wrapBox">

      <!-- header -->
      <?php include 'inc/header.php';?>

      <div class="topTitle subCategoryStyle2">
        <div class="subCategory">
          <h4 class="categoryTitle main"><?php echo $channel['c_name'];?></h4>
        </div>
      </div>

      <div class="wrapContent">
        <div id="wrapWide" class="wrapWide">
          <div class="content">

            <section class="">
              <div class="container-fluid">
                <div class="masonryWrap">
                  <div class="isotopeFiltr">
                    <ul>
                      <?php
                      $res = $db->getAll("SELECT * FROM cms_channel WHERE id IN (".$channel['c_sub'].") AND c_navigation = 1 ORDER BY c_order ASC,id ASC");
                      echo '<li><a href="javascript:;" class="active" data-filter="*">全部</a></li>';
                      foreach($res as $val){
                        echo '<li><a href="javascript:;" data-filter=".'.$val['c_name'].'">'.$val['c_name'].'</a></li>';
                      }
                      ?>
                    </ul>
                  </div>
                  <section class="masonryStyle isotopeWrap portfolio_medium ajaxContainer" data-foliosize="450">
                    <?php
                    $count = $db->getOne("SELECT COUNT(id) FROM cms_detail WHERE d_parent IN (".$channel['c_sub'].")");
                    $pager = page_handle('page',$channel['c_page'],$count);
                    $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN (".$channel['c_sub'].") ORDER BY d_order ASC,id DESC LIMIT ".$pager[0].",".$pager[1]);
                    $i = 0;
                    foreach ($res as $key=>$val) {
                      $i++;
                      echo '<article class="isotopeItem post_format_standard isw_1'.($key%2?" even":" odd").($i==$channel['c_page']||$i==$count?" last":"").' '.get_channel($val['d_parent'],'c_name').'" data-postid="'.$val['id'].'" data-wdh="620" data-hgt="620" data-incw="1" data-inch="1"> <a href="'.d_url($val['id']).'" class="isotopeItemWrap"> <div class="thumb"> <img src="'.img_always($val['d_picture']).'" alt="'.$val['d_name'].'"> </div> <div class="isotopeMore icon-down-open-big"> </div> <div class="isotopeContentWrap"> <div class="isotopeContent"> <h4 class="isotopeTitle">'.$val['d_name'].'</h4> <div class="isotopeExcerpt">'.str_cut(str_text($val['d_content']),30).'</div> <div class="postInfo hoverUnderline"> <div class="postWrap"> </div> </div> </div> </div> </a> </article>';
                    }
                    ?>
                  </section>
                </div>
                <div class="bodyStyleBoxed" style="padding:30px 0 0 0;"><ul class="pagination"><?php echo page_show($pager[2],$pager[3],'page',1);?></ul></div>
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
