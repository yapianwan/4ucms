<!DOCTYPE html>
<html lang="en-US">
<head><?php include 'inc/head.php';?></head>

<body class="home page">

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
                  
                  <section class="section_padding_bottom_50">
                    <div class="container">
                      <h3 class="sc_title sc_title_style_3 sc_title_center"><?php echo $channel['c_name'];?></h3>
                    </div>
                  </section>

                  <section class="">
                    <div class="container-fluid"><?php echo $channel['c_scontent'];?></div>
                  </section>

                  <section class="">
                    <div class="container">
                      <div class="sc_content mainWrap">
                        <div class="sc_section sc_section_style_2 sc_align_center sc_columns_2_3">
                          <div class="sc_columns  sc_columns_3 sc_columns_indent">
                            <div class="sc_columns_item  sc_columns_item_coun_1 odd first" >
                              <h5 class="sc_title sc_title_style_3 margin_top_50 margin_bottom_20">企业信息</h5>
                              <div class="sc_contact_info" >
                                <div class="sc_contact_info_wrap">
                                  <div class="sc_contact_info_item sc_contact_address_1">
                                    <div class="sc_contact_info_lable">地址:</div>
                                    <?php echo get_chip('contact-addr');?>
                                  </div>
                                  <div class="sc_contact_info_item sc_contact_phone_1">
                                    <div class="sc_contact_info_lable">电话:</div>
                                    <?php echo get_chip('contact-hotline');?>
                                  </div>
                                  <div class="sc_contact_info_item sc_contact_website">
                                    <div class="sc_contact_info_lable">网站:</div>
                                    <?php echo $cms['s_domain'];?>
                                  </div>
                                  <div class="sc_contact_info_item sc_contact_email">
                                    <div class="sc_contact_info_lable">电邮:</div>
                                    <?php echo get_chip('contact-mail');?>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class=" sc_columns_item  sc_columns_item_coun_2 colspan_2 even" >
                              <h5 class="sc_title sc_title_style_3 margin_top_50 margin_bottom_20">留言/咨询</h5>
                              <div class="sc_form contact_form_1">
                                  <form class="contact_1" method="post" action="ajax.php">
                                  <div class="sc_columns_3 sc_columns_indent">
                                    <div class="sc_columns_item sc_form_username">
                                      <label class="required" for="contact_form_username">姓名</label>
                                              <input type="text" name="name" id="contact_form_username">
                                          </div>
                                    <div class="sc_columns_item sc_form_email">
                                      <label class="required" for="contact_form_email">电邮</label>
                                              <input type="text" name="email" id="contact_form_email">
                                          </div>
                                    <div class="sc_columns_item sc_form_subj">
                                      <label class="required" for="contact_form_subj">主题</label>
                                              <input type="text" name="subject" id="contact_form_subj">
                                          </div>
                                      </div>
                                  <div class="sc_form_message">
                                    <label class="required" for="contact_form_message">内容</label>
                                            <textarea  id="contact_form_message" class="textAreaSize" name="message"></textarea>
                                      </div>
                                  <div class="sc_form_button">
                                    <div class="sc_button sc_button_style_3 sc_button_skin_dark sc_button_style_bg sc_button_size_medium">
                                      <button type="submit" name="contact_submit" class="contact_form_submit">submit</button>
                                      <input type="hidden" name="act" value="feedback_post">
                                    </div>
                                  </div>

                                      <div class="result sc_infobox"></div>
                                  </form>
                              </div> 
                            </div>
                          </div>
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
