<?php
$privilege = 'detail';
include '../library/inc.php';
include 'cms_check.php';
?>
<!DOCTYPE html>
<html class="no-js fixed-layout">
<head>
<?php include 'inc_head.php';?>
</head>

<body>
<?php include 'inc_header.php';?>

<div class="am-cf admin-main">
  <!-- content start -->
  <div class="admin-content">
    <div class="am-g am-g-fixed">
      <div class="am-u-sm-12 am-padding-top">

        <section class="am-panel am-panel-default">
          <header class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">电子邮箱<span class="am-icon-chevron-down am-fr"></span></header>
          <main class="am-panel-bd am-collapse am-text-break am-in" id="collapse-panel-1">
            <?php
            $size = !empty($_GET['size']) ? $_GET['size'] : 50;
            $pager = page_handle('page',$size,mysql_num_rows(mysql_query("SELECT * FROM cms_subscribe")));
            $res = $db->getAll("SELECT sub_mail FROM cms_subscribe ORDER BY id DESC LIMIT 0,$size");
            echo '<textarea class="am-form-field" rows="15" id="doc-ta-1" onClick="select();">';
            foreach ($res as $key=>$val) {
              if ($key==0) {
                echo $val['sub_mail'];
              } else {
                echo ','.$val['sub_mail'];
              }
            }
            echo '</textarea>';
            ?>
            <?php echo page_show_admin($pager[2],$pager[3],'page',2);?>
          </main>
        </section>

      </div>
    </div>
  </div>
  <!-- content end -->
</div>

<?php include 'inc_footer.php';?>
</body>
</html>