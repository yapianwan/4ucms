<div class="footer margint40"><!-- Footer Section -->
  <div class="main-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-sm-3 footer-logo hidden-xs">
          <img alt="Logo" src="<?php echo $t_path;?>img/logo.png" class="img-responsive" >
        </div>
        <div class="col-lg-9 col-sm-9">
          <div class="col-lg-3 col-sm-3 hidden-xs">
            <?php
            $cid = 1;
            $csub = get_channel($cid,'c_sub');
            ?>
            <h6><?php echo get_channel($cid,'c_name');?></h6>
            <ul class="footer-links">
              <?php
              $res = $db->getAll("SELECT * FROM cms_channel WHERE id IN ($csub) AND id<>$cid ORDER BY c_order ASC,id DESC");
              foreach ($res as $val) {
                echo '<li><a href="'.c_url($val['id']).'">'.$val['c_name'].'</a></li>';
              }
              ?>
            </ul>
          </div>
          <div class="col-lg-3 col-sm-3 hidden-xs">
            <?php
            $cid = 3;
            $csub = get_channel($cid,'c_sub');
            ?>
            <h6><?php echo get_channel($cid,'c_name');?></h6>
            <ul class="footer-links">
              <?php
              $res = $db->getAll("SELECT * FROM cms_channel WHERE id IN ($csub) AND id<>$cid ORDER BY c_order ASC,id DESC");
              foreach ($res as $val) {
                echo '<li><a href="'.c_url($val['id']).'">'.$val['c_name'].'</a></li>';
              }
              ?>
            </ul>
          </div>
          <div class="col-lg-3 col-sm-3 hidden-xs">
            <?php
            $cid = 2;
            $csub = get_channel($cid,'c_sub');
            ?>
            <h6><?php echo get_channel($cid,'c_name');?></h6>
            <ul class="footer-links">
              <?php
              $res = $db->getAll("SELECT * FROM cms_channel WHERE id IN ($csub) AND id<>$cid ORDER BY c_order ASC,id DESC");
              foreach ($res as $val) {
                echo '<li><a href="'.c_url($val['id']).'">'.$val['c_name'].'</a></li>';
              }
              ?>
            </ul>
          </div>
          <div class="col-lg-3 col-sm-3">
            <h6>联系我们</h6>
            <ul class="footer-links">
              <li><p><i class="fa fa-map-marker"></i> <?php echo get_chip('contact-addr');?> </p></li>
              <li><p><i class="fa fa-phone"></i> <?php echo get_chip('contact-hotline');?> </p></li>
              <li><p><i class="fa fa-envelope"></i> <a href="mailto:<?php echo get_chip('contact-mail');?>"><?php echo get_chip('contact-mail');?></a></p></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pre-footer">
    <div class="container">
      <div class="row">
        <div class="pull-left"><p><?php echo $cms['s_copyright'];?></p></div>
        <div class="pull-right"></div>
      </div>
    </div>
  </div>
</div>