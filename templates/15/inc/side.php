<div id="sidebar_main" class="widget_area sideBar">
  <?php if ($c_main!='search') {?>
  <aside class="widget-first widgetWrap widget_categories">
    <h4 class="title">分类菜单</h4>
    <ul>
      <?php echo $channel_slist;?>
    </ul>
  </aside>
  <?php } ?>
  <aside class="widget-first widgetWrap widget_search">
    <form method="get" id="searchform" class="searchform" action="search.php">
      <div class="searchFormWrap">
        <div class="searchSubmit">
          <input class="sc_button sc_button_skin_dark sc_button_style_bg sc_button_size_mini" type="submit" id="searchsubmit" value="检索" />
        </div>
        <div class="searchField">
          <input class="" type="search" name="keyword" value="" id="keyword" placeholder="关键词 &hellip;" />
        </div>
      </div>
    </form>
  </aside>
</div>