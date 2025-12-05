<header class="full_wrapper header_full_wrpr hover_head_common">

    <div class="full_wrapper header_main_wrpr padding_lr_header_primary wrpr_flex flex_start">

        <div class="logo">

            <?php
              $media_list = $this->index_model->getMediaList(2);

              if ($media_list != NULL) {
                foreach ($media_list as $media_key => $media_row) {
                  $images_arr = json_decode($media_row->images, TRUE);
                                            $image = $images_arr[0]['image'];   
                                            $image_alt = $images_arr[0]['seo_alt'];
                                            $image_title = $images_arr[0]['seo_title'];
              ?>


            <img src='<?php echo base_url() . 'media_library/' . $image; ?>' alt='<?php echo $image_alt; ?>'
                title='<?php echo $image_title; ?>'>


            <?php
                }
              }
              ?>

        </div>

        <div class="txt_clr_1 txt_size_line_11 social_media_icons wrpr_flex">

            <ul class="wrpr_flex">

                <?php
                    $media_list = $this->index_model->getMediaList(3);

                    if ($media_list != NULL) {
                      foreach ($media_list as $media_key => $media_row) {

                        $customized_link = json_decode($media_row->custom_link, TRUE);
                        $full_url = $this->index_model->getCustomUrl($customized_link);  
                    ?>

                <li>

                    <a href="<?php echo $full_url; ?>" class="" target="<?php echo $customized_link['target_type']; ?>">

                        <span class="<?php echo $media_row->iconClass; ?>"></span>

                    </a>

                </li>

                <?php
                      }
                    }
                    ?>

            </ul>

        </div>

        <div class=" item_center margin_l_auto">

            <?php
                $media_list = $this->index_model->getMediaList(4);

                if ($media_list != NULL) {
                  foreach ($media_list as $media_key => $media_row) {

                ?>

            <div class="full_wrapper <?php if($media_key > 0){ echo "mobile_view"; } ?>">

                <a href="mailto:<?php echo $media_row->content_title; ?>" class="wrpr_flex mail_enquiry" target="_self">

                    <div class="icon">

                        <span class="gd_icon_contact_t"></span>

                    </div>

                    <?php echo $media_row->content_title; ?>
                </a>

            </div>

            <?php
                  }
                }
                ?>

        </div>

        <?php
            $media_list = $this->index_model->getMediaList(5);

            if ($media_list != NULL) {
                foreach ($media_list as $media_key => $media_row) {
        ?>

        <div class="item_center ml_auto call_enquiry wrpr_flex margin_l_50">

            <div class="icon">

                <span class="gd_icon_support"></span>

            </div>

            <div class="text-center text_wrap margin-rght-10">

                <?php echo $media_row->content_short_description; ?>

            </div>

            <div class="dspl-flex align-item-c phn-number">
                <div class="margin-lr-2">

                    <a href="tel:<?php echo $media_row->content_title; ?>"
                        target="_self"><?php echo $media_row->content_title; ?>,</a>

                </div>
                <div class="margin-lr-2">

                    <a href="tel:<?php echo $media_row->second_title; ?>"
                        target="_self"><?php echo $media_row->second_title; ?> </a>

                </div>
            </div>

        </div>

        <?php
                }
            }
        ?>

        <div class="hangburger_trigger"> <span></span> <span></span><span></span></div>

    </div>

    <div class="top_inner_block">

        <div class="top_text_inner_block split_half padding_lr_primary">

            <?php
        $media_list = $this->index_model->getMediaList(6);
        if ($media_list != NULL) {
            foreach ($media_list as $media_key => $media_row) {

                $customized_link = json_decode($media_row->custom_link, TRUE);
                $full_url = $this->index_model->getCustomUrl($customized_link);  
        ?>

            <div class="top_text_block">

                <div class="text_inner_head animate-typing ml12">

                    <?php echo $media_row->content_title; ?>

                </div>

                <div class="sub_text_inner_head">

                    <?php echo $media_row->brief_details; ?>

                </div>

                <div class="heading_Common_style dark_border mb0">

                    <a href="<?php echo $full_url; ?>" class="border_styles">

                        <span class="">

                            <?php echo $media_row->second_title; ?>

                        </span>

                        <div class="bottom_line"></div>

                    </a>

                </div>

            </div>

            <?php
            }
        }
        ?>

        </div>

        <div class="top_slider_block bg_gradient5 split_half">

        </div>

        <div class="slider">

            <div class="pogoSlider">

                <?php
                $media_list = $this->index_model->getMediaList(8);

                if ($media_list != NULL) {
                    foreach ($media_list as $media_key => $media_row) {
                      $images_arr = json_decode($media_row->images, TRUE);
                                                $image = $images_arr[0]['image'];   
                                                $image_alt = $images_arr[0]['seo_alt'];
                                                $image_title = $images_arr[0]['seo_title'];
                ?>

                <div class="pogoSlider-slide" data-transition="zipReveal" data-duration="2000">

                    <img alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'
                        src="<?php echo base_url() . 'media_library/' . $image; ?>">

                    <div class="slider_inner_text">

                        <?php echo $media_row->brief_details; ?>

                    </div>

                </div>

                <?php
                    }
                }
                ?>

            </div>

        </div>

    </div>

    <div class="scroll_to_section">

    </div>

    <div class="bottom_nav">

        <div class="main_menu margin_r_auto item_center padding_rl_35">

            <ul class="wrpr_flex common_ul_type_1">

                <?php 
                $media_list = $this->index_model->getMediaListMenu(1);

                if ($media_list != NULL) {
                    foreach ($media_list as $media_key => $media_row) {

                        $customized_link = json_decode($media_row->custom_link, TRUE);
                        $full_url = $this->index_model->getCustomUrl($customized_link); 

                        $active_class = "";
                        if(($this->uri->segment(1) == $customized_link['type3']) || ($media_row->home_menu_status == "yes")){
                            $active_class = "active";
                        }
                ?>

                <li class="dropdown ">

                    <a href="<?php echo $full_url; ?>" class="<?php echo $active_class; ?>"
                        target="<?php echo $customized_link['target_type']; ?>"><?php echo $media_row->category; ?></a>

                    <span class="icon gd_icon_down_f"></span>

                    <?php
                        if($media_row->sub_menu_status == "yes"){

                        ?>

                    <ul class="dropdown_list">

                        <?php
                                 $submenu_list= $this->index_model->get_submenu_list($media_row->id);

                                 if($submenu_list != NULL){                                 
                                  foreach ($submenu_list as $submenu) { 
                                    $customized_link_sub = json_decode($submenu->custom_link, TRUE);
                                    $full_url_sub = $this->index_model->getCustomUrl($customized_link_sub); 
                                ?>

                        <li class="">

                            <a href="<?php echo $full_url_sub; ?>" class=""
                                target="<?php echo $customized_link_sub['target_type']; ?>"><?php echo $submenu->category;  ?></a>

                        </li>

                        <?php
                                   }
                                }
                                ?>

                    </ul>

                    <?php    
                        }
                        ?>

                </li>

                <?php
                    }
                }
                ?>

            </ul>

        </div>

    </div>

</header>

<div class="hangburger_main"></div>