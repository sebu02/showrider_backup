<footer class="footer_bg padding_lr_primary padding_f_tb flex-wrap scroll_class full_wrapper relative_wrpr">

    <div class="rellax_wrpr overlay rellax_action rellax_wrpr1" data-rellax-speed="-2">
        <div class="rellax_heading relax_txt_clr rellax_position rellax_position2 relax_txt_clr2 rellax_heading2">

            <?php

            $media_list = $this->index_model->getMediaList(9);

            if ($media_list != NULL) {
                foreach ($media_list as $media_key => $media_row) {

                    echo $media_row->content_title;

                }
            }
            ?>

        </div>
    </div>

    <div class="wrpr_flex full_wrapper common_split_2 footer_inner_wrpr">

        <div class="common_split_left">

            <div class="footer_about">

                <?php
                    $media_list = $this->index_model->getMediaList(10);

                    if ($media_list != NULL) {
                        foreach ($media_list as $media_key => $media_row) {
                            $images_arr = json_decode($media_row->images, TRUE);
                            $image = $images_arr[0]['image'];   
                            $image_alt = $images_arr[0]['seo_alt'];
                            $image_title = $images_arr[0]['seo_title'];

                            $customized_link = json_decode($media_row->custom_link, TRUE);
                            $full_url = $this->index_model->getCustomUrl($customized_link);  
                    ?>

                <div class="footer_header">

                    <?php
                            echo $media_row->content_title;
                            ?>

                </div>

                <div class="footer_logo">

                    <a href="<?php echo $full_url; ?>" class="footer_logo_link"
                        target="<?php echo $customized_link['target_type']; ?>">
                        <img src='<?php echo base_url() . 'media_library/' . $image; ?>' alt='<?php echo $image_alt; ?>'
                            title='<?php echo $image_title; ?>'>

                    </a>

                </div>

                <div class="footer_txt">

                    <?php echo $media_row->brief_details; ?>

                </div>

                <?php
                        }
                    }
                    ?>

            </div>

            <div class="quick_link">

                <div class="footer_header">

                    <?php
                    $media_list = $this->index_model->getMediaList(11);

                    if ($media_list != NULL) {
                        foreach ($media_list as $media_key => $media_row) {
                                                                                                
                            echo $media_row->content_title;

                        }
                    }
                    ?>

                </div>

                <ul class="footer_list">

                    <?php 
                    $media_list = $this->index_model->getMediaListMenu(1);

                    if ($media_list != NULL) {
                        foreach ($media_list as $media_key => $media_row) {

                            $customized_link = json_decode($media_row->custom_link, TRUE);
                            $full_url = $this->index_model->getCustomUrl($customized_link);

                            $main_menu_title = strtolower($media_row->category);
                            $main_menu_title = ucwords($main_menu_title);
                    ?>

                    <li>

                        <a href="<?php echo $full_url; ?>" class=""
                            target="<?php echo $customized_link['target_type']; ?>"><?php echo $main_menu_title; ?></a>

                    </li>

                    <?php
                        }
                    }
                    ?>

                </ul>

            </div>

            <div class="quick_link">

                <div class="footer_header">

                    <?php
                    $media_list = $this->index_model->getMediaList(11);

                    if ($media_list != NULL) {
                        foreach ($media_list as $media_key => $media_row) {
                                                                         
                            echo $media_row->second_title;

                        }
                    }
                    ?>

                </div>

                <ul class="footer_list">

                    <?php
                    $submenu_list = $this->index_model->get_submenu_list(4);

                    if($submenu_list != NULL){                                 
                        foreach ($submenu_list as $submenu) { 
                          $customized_link_sub = json_decode($submenu->custom_link, TRUE);
                          $full_url_sub = $this->index_model->getCustomUrl($customized_link_sub);

                          $submenu_title = strtolower($submenu->category);
                          $submenu_title = ucwords($submenu_title);

                    ?>

                    <li>

                        <a href="<?php echo $full_url_sub; ?>" class=""
                            target="<?php echo $customized_link_sub['target_type']; ?>"><?php echo $submenu_title; ?></a>

                    </li>

                    <?php
                                   }
                                }
                                ?>

                </ul>

            </div>

            <div class="quick_link gl_m_t_25">

                <div class="footer_header">

                    <?php
                    $media_list = $this->index_model->getMediaList(11);

                    if ($media_list != NULL) {
                        foreach ($media_list as $media_key => $media_row) {
                                                                           
                            echo $media_row->content_short_description;

                        }
                    }
                    ?>

                </div>

                <ul class="footer_list footer_list2">

                    <?php
                    $media_list = $this->index_model->getMediaList(3);

                    if ($media_list != NULL) {
                      foreach ($media_list as $media_key => $media_row) {

                        $customized_link = json_decode($media_row->custom_link, TRUE);
                        $full_url = $this->index_model->getCustomUrl($customized_link);  
                    ?>

                    <li>

                        <a href="<?php echo $full_url; ?>" class="hover_footer"
                            target="<?php echo $customized_link['target_type']; ?>">

                            <span class="<?php echo $media_row->iconClass; ?>"></span>

                        </a>

                    </li>

                    <?php
                      }
                    }
                    ?>

                </ul>

            </div>

        </div>

        <?php $this->load->view('index/include/quick_contact_form'); ?>

    </div>

</footer>

<div class="copright footer_bg padding_lr_primary common_p_footer full_wrapper">
    Copyright © <?php echo date("Y"); ?> Showrider. Designed by <a class="lx_gl" target="_blank"
        href="https://www.glinfotech.net/">
        <span>GL Infotech</span></a>. All Rights Reserved.
</div>

<div class="overlay_close"></div>
<div class="back_to_top"> <span class="gd_icon_arrow2_top_t"></span> </div>