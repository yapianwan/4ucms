<div class="luxen-widget news-widget hidden-xs">
  <div class="title">
    <h5>企业简介</h5>
  </div>
  <p><?php echo str_text(get_channel(1,'c_scontent'));?></p>
</div>
<div class="luxen-widget news-widget hidden-xs">
  <div class="title">
    <h5>联系我们</h5>
  </div>
  <ul class="footer-links">
    <li><p><i class="fa fa-map-marker"></i> <?php echo get_chip('contact-addr');?></p></li>
    <li><p><i class="fa fa-phone"></i> <?php echo get_chip('contact-hotline');?></p></li>
    <li><p><i class="fa fa-envelope"></i> <a href="mailto:<?php echo get_chip('contact-mail');?>"><?php echo get_chip('contact-mail');?></a></p></li>
  </ul>
</div>