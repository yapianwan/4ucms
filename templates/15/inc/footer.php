<footer class="footerWidget">
  <div class="sc_columns_4 sc_columns_indent">
    <div class="widget_area">
      <aside class="sc_columns_item widgetWrap widget_recent_posts widget_trex_post">
        <?php
          $cid = 10;
          $csub = get_channel($cid,'c_sub');
          echo '<h4 class="title">'.get_channel($cid,'c_name').'</h4><ul>';
          $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN ($csub) ORDER BY d_order ASC,id DESC LIMIT 0,6");
          if (!empty($res)) {
            foreach ($res as $val) {
              echo '<li> <a href="'.d_url($val['id']).'">'.$val['d_name'].'</a> </li>';
            }
          } else {
            echo '<li> <a href="#">Gluten-Free Baked Goods</a> </li> <li> <a href="#">Healthy Food Guide</a> </li> <li> <a href="#">Organic & Natural</a> </li> <li> <a href="#">The Farm Story</a> </li> <li> <a href="#">Plum cake</a> </li> <li> <a href="#">GMOs: Your Right to Know</a> </li> <li> <a href="#">John Mackey\'s Blog</a> </li>';
          }
          echo '</ul>';
        ?>
      </aside>
      <aside class="sc_columns_item widgetWrap widget_recent_posts widget_trex_post">
        <?php
          $cid = 3;
          echo '<h4 class="title">'.get_channel($cid,'c_name').'</h4>';
        ?>
        <ul>
          <?
          $res = $db->getAll("SELECT id,c_name FROM cms_channel WHERE c_parent = $cid ORDER BY c_order ASC,id ASC");
          foreach ($res as $val) {
            echo '<li><a href="'.c_url($val['id']).'">'.$val['c_name'].'</a></li>';
          }
          ?>
        </ul>
      </aside>
      <aside class="sc_columns_item widgetWrap widget_recent_posts widget_trex_post">
        <?php
          $cid = 3;
          $csub = get_channel($cid,'c_sub');
          echo '<h4 class="title">推荐'.get_channel($cid,'c_sname').'</h4>';
          $res = $db->getAll("SELECT * FROM cms_detail WHERE d_parent IN ($csub) AND d_rec = 1 ORDER BY d_order ASC,id DESC LIMIT 0,3");
          if (!empty($res)) {
            foreach ($res as $key=>$val) {
              echo '<div class="post_item'.($key==0?' first':'').'"> <div class="post_thumb image_wrapper"> <img alt="Gluten-Free Baked Goods" src="'.img_always($val['d_picture']).'"> </div> <div class="post_wrapper"> <div class="post_title theme_title title_padding"> <a href="'.d_url($val['id']).'">'.$val['d_name'].'</a> </div> <div class="post_info theme_info"> <span class="post_date theme_text">'.local_date('M d, Y').'</span> </div> </div> </div>';
            }
          } else {
            echo '<div class="post_item first"> <div class="post_thumb image_wrapper"> <img alt="Gluten-Free Baked Goods" src="'.$t_path.'images/12-620x620.jpg"> </div> <div class="post_wrapper"> <div class="post_title theme_title title_padding"> <a href="#">Gluten-Free Baked Goods</a> </div> <div class="post_info theme_info"> <span class="post_date theme_text">January 22, 2015</span> </div> </div> </div><div class="post_item"> <div class="post_thumb image_wrapper"> <img alt="Healthy Food Guide" src="'.$t_path.'images/22-620x620.jpg"> </div> <div class="post_wrapper"> <div class="post_title theme_title title_padding"> <a href="#">Healthy Food Guide</a> </div> <div class="post_info theme_info"> <span class="post_date theme_text">January 22, 2015</span> </div> </div> </div><div class="post_item"> <div class="post_thumb image_wrapper"> <img alt="Organic &#038; Natural" src="'.$t_path.'images/32-620x620.jpg"> </div> <div class="post_wrapper"> <div class="post_title theme_title title_padding"> <a href="#">Organic & Natural</a> </div> <div class="post_info theme_info"> <span class="post_date theme_text">January 22, 2015</span> </div> </div> </div>';
          }
        ?>
      </aside>
      <aside class="sc_columns_item widgetWrap widget_recent_posts widget_trex_post">
        <?php
          $cid = 6;
          echo '<h4 class="title">'.get_channel($cid,'c_name').'</h4><ul>';
          echo '<li>咨询电话：'.get_chip('contact-hotline').'</li>';
          echo '<li>在线客服：'.get_chip('contact-qq').'</li>';
          echo '<li>电子邮箱：'.get_chip('contact-mail').'</li>';
          echo '<li>联系地址：'.get_chip('contact-addr').'</li>';
          echo '</ul>';
          ?>
        </ul>
      </aside>
    </div>
  </div>
  <div class="copyright">
    <?php echo $cms['s_copyright'];?>
  </div>
</footer>