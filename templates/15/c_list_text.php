<!DOCTYPE html>
<html lang="en-US">
<head><?php include 'inc/head.php';?></head>

<body class="">

  <div id="wrap" class="wrap sideBarRight sideBarShow menuStyle1 menuSmartScrollShow blogStyleExcerpt bodyStyleWide menuStyleFixed visibleMenuDisplay logoImageStyle logoStyleBG">
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

            <section class="">
              <div class="container">
                <?php
                $count = $db->getOne("SELECT COUNT(id) FROM cms_detail WHERE d_parent IN (".$channel['c_sub'].")");
                $pager = page_handle('page',$channel['c_page'],$count);
                $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN (".$channel['c_sub'].") ORDER BY d_order ASC,id DESC LIMIT ".$pager[0].",".$pager[1]);
                $i = 0;
                foreach ($res as $key=>$val) {
                  $i++;
                  echo '<article class="blogStreampage'.($key%2?" even":" odd").($key==0?" first":"").($i==$channel['c_page']||$i==$count?" last":"").' post"> <h2 class="postTitle"> <a href="'.d_url($val['id']).'">'.$val['d_name'].'</a> </h2> <div class="postInfo hoverUnderline"> <div class="postWrap"> <span class="postSpan postCategory"> 类别：<a class="cat_link" href="'.c_url($val['d_parent']).'">'.get_channel($val['d_parent'],'c_name').'</a> </span> <span class="postSpan postAuthor"> 作者：'.$val['d_author'].' </span> <span class="postSpan postDate"> 日期：'.local_date('M d, Y',$val['d_date']).' </span> </div> </div> <div class="post Standard"> <p>'.str_cut(str_text($val['d_content']),200).'</p> </div> <div class="readMore"> <a href="'.d_url($val['id']).'"  class="sc_button  sc_button_skin_dark sc_button_style_bg sc_button_size_medium" >Read more</a> </div> </article>';
                }
                ?>
              </div>
              <div class="bodyStyleBoxed"><ul class="pagination"><?php echo page_show($pager[2],$pager[3],'page',1);?></ul></div>
            </section>

          </div>

          <!-- side -->
          <?php include 'inc/side.php';?>
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
