<section class="full_wrapper scroll_class bg_img_cover_wrpr our_service_block hover_head_common" data-scroll-from="3">
    <div class="common_inner_wrpr padding_lr_primary padding_tb_primary">
        <!--START theme1-Home-BLOCK-wrapper1 (wrappercode_62) CLOSE SECTION-->
        <!--START BlockBox-11 -->
        <!--START theme1-theme1_content_image_box3-wrapper1 (wrappercode_63) OPEN SECTION-->

        <?php
            $media_list = $this->index_model->getMediaList(13);

            if ($media_list != NULL) {
                foreach ($media_list as $media_key => $media_row) {
                    $images_arr = json_decode($media_row->images, TRUE);
                    $image = $images_arr[0]['image']; 
                    $image_alt = $images_arr[0]['seo_alt'];
                    $image_title = $images_arr[0]['seo_title'];
            ?>

        <div class="full_wrapper">
            <!--START theme1-theme1_content_image_box3-wrapper1 (wrappercode_63) CLOSE SECTION-->
            <!--START theme1_content_image_box3-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_64) OPEN SECTION-->
            <div class="bg_img_wrpr rellax_wrpr rellax_action" data-rellax-speed="-4">
                <!--START theme1_content_image_box3-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_64) CLOSE SECTION-->

                <img alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'
                    src="<?php echo base_url() . 'media_library/' . $image; ?>">

                <!--EOF theme1_content_image_box3-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_64) OPEN SECTION-->
            </div>
            <!--EOF theme1_content_image_box3-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_64) CLOSE SECTION-->

            <!--START theme1_content_image_box3-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_65) OPEN SECTION-->
            <div class="heading_Common_style light_border">
                <div class="border_styles">
                    <!--START theme1_content_image_box3-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_65) CLOSE SECTION-->
                    <!--START theme1_content_image_box3-CONTENT_TITLE_BOX1-wrapper2 (wrappercode_66) OPEN SECTION-->

                    <span class="btn_gradient">
                        <!--START theme1_content_image_box3-CONTENT_TITLE_BOX1-wrapper2 (wrappercode_66) CLOSE SECTION-->

                        <?php echo $media_row->content_title; ?>

                        <!--EOF theme1_content_image_box3-CONTENT_TITLE_BOX1-wrapper2 (wrappercode_66) OPEN SECTION-->
                    </span>
                    <!--EOF theme1_content_image_box3-CONTENT_TITLE_BOX1-wrapper2 (wrappercode_66) CLOSE SECTION-->

                    <!--START Icon Bottom Line (wrappercode_34) OPEN SECTION-->
                    <div class="bottom_line"></div>
                    <!--START Icon Bottom Line (wrappercode_34) CLOSE SECTION-->
                    <!--EOF Icon Bottom Line (wrappercode_34) OPEN SECTION-->
                    <!--EOF Icon Bottom Line (wrappercode_34) CLOSE SECTION-->
                    <!--EOF theme1_content_image_box3-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_65) OPEN SECTION-->
                </div>
            </div>
            <!--EOF theme1_content_image_box3-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_65) CLOSE SECTION-->
            <!--EOF theme1-theme1_content_image_box3-wrapper1 (wrappercode_63) OPEN SECTION-->
        </div>

        <?php
                }
            }
            ?>

        <!--EOF theme1-theme1_content_image_box3-wrapper1 (wrappercode_63) CLOSE SECTION-->
        <!--EOF BlockBox-11 -->
        <!--START BlockBox-12 -->
        <!--START theme1-theme1_content_image_box4-wrapper1 (wrappercode_67) OPEN SECTION-->

        <div class="common_inner_wrpr ">
            <div class="full_wrapper block_slider_wrapr">
                <!--START theme1-theme1_content_image_box4-wrapper1 (wrappercode_67) CLOSE SECTION-->
                <!--START theme1_content_image_box4-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_68) OPEN SECTION-->
                <div class="owl_carousel_slider owl-carousel owl-theme owl-loaded">
                    <!--START theme1_content_image_box4-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_68) CLOSE SECTION-->
                    <!--START theme1_content_image_box4-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_70) OPEN SECTION-->

                    <?php
                        $media_list = $this->index_model->getAllCategoryList();

                        if ($media_list != NULL) {
                            foreach ($media_list as $media_key => $media_row) {
                               

                                $images_arr = json_decode($media_row->category_picture, TRUE);
                                $image = $images_arr[0]['image'];
                                $image_alt = $images_arr[0]['seo_alt'];
                                $image_title = $images_arr[0]['seo_title'];
                        ?>

                    <div class="item">
                        <div class="common_link_img_box_wrpr">
                            <!--START theme1_content_image_box4-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_70) CLOSE SECTION-->
                            <!--START theme1-customstructurebox_68-BLOCK-wrapper1 (wrappercode_69) OPEN SECTION-->
                            <div class="common_link_img_box_wrpr_content_wrpr common_hover_style"> <span
                                    class="hover_span"></span>
                                <!--START theme1-customstructurebox_68-BLOCK-wrapper1 (wrappercode_69) CLOSE SECTION-->
                                <!--START theme1_content_image_box4-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_71) OPEN SECTION--><span
                                    class="common_link_img_box_wrpr_content_cover zoom_hover">
                                    <!--START theme1_content_image_box4-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_71) CLOSE SECTION-->

                                    <img alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'
                                        src="<?php echo base_url() . 'media_library/' . $image; ?>">

                                    <!--EOF theme1_content_image_box4-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_71) OPEN SECTION-->
                                </span>
                                <!--EOF theme1_content_image_box4-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_71) CLOSE SECTION-->

                                <!--START theme1_content_image_box4-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_72) OPEN SECTION-->
                                <div class="common_link_img_box_wrpr_overlay"> <span
                                        class="common_link_img_box_wrpr_overlay_txt gl_services_title">
                                        <!--START theme1_content_image_box4-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_72) CLOSE SECTION-->

                                        <?php echo $media_row->category; ?>

                                        <!--EOF theme1_content_image_box4-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_72) OPEN SECTION-->
                                    </span> </div>
                                <!--EOF theme1_content_image_box4-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_72) CLOSE SECTION-->
                                <!--EOF theme1-customstructurebox_68-BLOCK-wrapper1 (wrappercode_69) OPEN SECTION-->
                            </div>
                            <!--EOF theme1-customstructurebox_68-BLOCK-wrapper1 (wrappercode_69) CLOSE SECTION-->
                            <!--START theme1_content_image_box4-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_73) OPEN SECTION-->
                            <div class="common_link_img_box_wrpr_link_wrpr">
                                <!--START theme1_content_image_box4-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_73) CLOSE SECTION-->

                                <a href="<?php echo base_url(). $media_row->full_slug; ?>"
                                    class="common_link_img_box_wrpr_link" target="_self">

                                    <!--START Icon Right Arrow 1 (wrappercode_75) OPEN SECTION--><i
                                        class="gd_icon_right_f"></i>
                                    <!--START Icon Right Arrow 1 (wrappercode_75) CLOSE SECTION-->
                                    <!--EOF Icon Right Arrow 1 (wrappercode_75) OPEN SECTION-->
                                    <!--EOF Icon Right Arrow 1 (wrappercode_75) CLOSE SECTION-->

                                    <!--START Span Tag (wrappercode_35) OPEN SECTION-->
                                    <span class="">
                                        <!--START Span Tag (wrappercode_35) CLOSE SECTION-->
                                        Discover More
                                        <!--EOF Span Tag (wrappercode_35) OPEN SECTION-->
                                    </span>
                                    <!--EOF Span Tag (wrappercode_35) CLOSE SECTION-->
                                </a>

                                <!--EOF theme1_content_image_box4-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_73) OPEN SECTION-->
                            </div>
                            <!--EOF theme1_content_image_box4-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_73) CLOSE SECTION-->
                            <!--EOF theme1_content_image_box4-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_70) OPEN SECTION-->
                        </div>
                    </div>

                    <?php
                            }
                        } 
                        ?>

                    <!--EOF theme1_content_image_box4-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_70) CLOSE SECTION-->

                    <!--START theme1_content_image_box4-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_70) OPEN SECTION-->

                    <!--EOF theme1_content_image_box4-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_70) CLOSE SECTION-->
                    <!--EOF theme1_content_image_box4-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_68) OPEN SECTION-->
                </div>
                <!--EOF theme1_content_image_box4-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_68) CLOSE SECTION-->
                <!--EOF theme1-theme1_content_image_box4-wrapper1 (wrappercode_67) OPEN SECTION-->
            </div>
        </div>

        <!--EOF theme1-theme1_content_image_box4-wrapper1 (wrappercode_67) CLOSE SECTION-->
        <!--EOF BlockBox-12 -->
        <!--EOF theme1-Home-BLOCK-wrapper1 (wrappercode_62) OPEN SECTION-->
    </div>
</section>