<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('index/include/header_meta'); ?>

</head>

<body class="">

    <?php $this->load->view('index/include/header'); ?>

    <div class="afterload-featurebox gd_hide afterload-featurebox24" data-featurebox_id="24" data-boxtype="2"
        data-relation_with_id="293"></div>
    <!--START BlockBox-49 -->

    <?php $this->load->view('index/include/get_a_quote_banner'); ?>

    <section class="full_wrapper relative_wrpr bg_img_cover_wrpr our_service_landing_block  bg_blocker">
        <div class="common_inner_wrpr padding_lr_primary_small padding_tb_primary">
            <!--START theme1-theme1_content_image_box20-wrapper1 (wrappercode_245) CLOSE SECTION-->
            <!--START theme1_content_image_box20-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_246) OPEN SECTION-->
            <div class="full_wrapper common_split_type4_wrpr get_a_quote_wrpr">

                <?php
                $media_list = $this->index_model->getAllCategoryList();

                if ($media_list != NULL) {
                    foreach ($media_list as $media_key => $media_row) {
                       
                        $images_arr = json_decode($media_row->category_picture, TRUE);
                        $image = $images_arr[0]['image'];
                        $image_alt = $images_arr[0]['seo_alt'];
                        $image_title = $images_arr[0]['seo_title'];
                ?>

                <div class="common_link_img_box_wrpr common_split_block common_radius common_hover_2">
                    <!--START theme1_content_image_box20-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_247) CLOSE SECTION-->
                    <!--START theme1_content_image_box20-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_248) OPEN SECTION-->
                    <div class="common_link_img_box_wrpr_content_wrpr mb0"> <span
                            class="common_link_img_box_wrpr_content_cover overlay_gradient image_manipulation">
                            <!--START theme1_content_image_box20-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_248) CLOSE SECTION-->

                            <img src='<?php echo base_url() . 'media_library/' . $image; ?>'
                                alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'>

                            <!--EOF theme1_content_image_box20-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_248) OPEN SECTION-->
                        </span> </div>
                    <!--EOF theme1_content_image_box20-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_248) CLOSE SECTION-->
                    <!--START theme1- customstructurebox_284-BLOCK-wrapper1 (wrappercode_254) OPEN SECTION-->
                    <div class="overlay overlay_flex_center">
                        <!--START theme1- customstructurebox_284-BLOCK-wrapper1 (wrappercode_254) CLOSE SECTION-->
                        <!--START theme1_content_image_box20-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_249) OPEN SECTION-->
                        <div class="bg_header_common"><span>
                                <!--START theme1_content_image_box20-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_249) CLOSE SECTION-->

                                <?php echo $media_row->category; ?>

                                <!--EOF theme1_content_image_box20-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_249) OPEN SECTION-->
                            </span></div>
                        <!--EOF theme1_content_image_box20-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_249) CLOSE SECTION-->
                        <!--START theme1- customstructurebox_284-BLOCK-wrapper2 (wrappercode_255) OPEN SECTION-->
                        <div class="hover_box hover_head_common">
                            <!--START theme1- customstructurebox_284-BLOCK-wrapper2 (wrappercode_255) CLOSE SECTION-->
                            <!--START theme1_content_image_box20-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_250) OPEN SECTION-->
                            <div class="common_inner_content">
                                <!--START theme1_content_image_box20-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_250) CLOSE SECTION-->

                                <p>

                                    <?php echo $media_row->banner_description; ?>

                                </p>

                                <!--EOF theme1_content_image_box20-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_250) OPEN SECTION-->
                            </div>
                            <!--EOF theme1_content_image_box20-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_250) CLOSE SECTION-->

                            <!--START theme1_content_image_box20-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_251) OPEN SECTION-->
                            <div class="heading_Common_style light_border coustom_spacing_txt_size ">
                                <!--START theme1_content_image_box20-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_251) CLOSE SECTION-->
                                <a href="<?php echo base_url() . 'get-a-quote-detail?id=' . $media_row->id; ?>"
                                    class="border_styles" target="_self">
                                    <!--START theme1_content_image_box20-LINK_MAIN_TITLE_BOX-wrapper1 (wrappercode_252) OPEN SECTION-->

                                    <span>
                                        <!--START theme1_content_image_box20-LINK_MAIN_TITLE_BOX-wrapper1 (wrappercode_252) CLOSE SECTION-->

                                        Let's
                                        Start

                                        <!--EOF theme1_content_image_box20-LINK_MAIN_TITLE_BOX-wrapper1 (wrappercode_252) OPEN SECTION-->
                                    </span>
                                    <!--EOF theme1_content_image_box20-LINK_MAIN_TITLE_BOX-wrapper1 (wrappercode_252) CLOSE SECTION-->

                                    <!--START icon Border Effect (wrappercode_253) OPEN SECTION-->
                                    <div class="bottom_line"></div>
                                    <!--START icon Border Effect (wrappercode_253) CLOSE SECTION-->
                                    <!--EOF icon Border Effect (wrappercode_253) OPEN SECTION-->
                                    <!--EOF icon Border Effect (wrappercode_253) CLOSE SECTION-->
                                </a>
                                <!--EOF theme1_content_image_box20-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_251) OPEN SECTION-->
                            </div>
                            <!--EOF theme1_content_image_box20-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_251) CLOSE SECTION-->
                            <!--EOF theme1- customstructurebox_284-BLOCK-wrapper2 (wrappercode_255) OPEN SECTION-->
                        </div>
                        <!--EOF theme1- customstructurebox_284-BLOCK-wrapper2 (wrappercode_255) CLOSE SECTION-->
                        <!--EOF theme1- customstructurebox_284-BLOCK-wrapper1 (wrappercode_254) OPEN SECTION-->
                    </div>
                    <!--EOF theme1- customstructurebox_284-BLOCK-wrapper1 (wrappercode_254) CLOSE SECTION-->
                    <!--EOF theme1_content_image_box20-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_247) OPEN SECTION-->
                </div>

                <?php
                    }
                } 
                ?>

            </div>
            <!--EOF theme1_content_image_box20-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_246) CLOSE SECTION-->
            <!--EOF theme1-theme1_content_image_box20-wrapper1 (wrappercode_245) OPEN SECTION-->
        </div>
    </section>

    <?php $this->load->view('index/include/footer_turn_your_events'); ?>

    <!--EOF theme1-theme1_content_image_box7-wrapper1 (wrappercode_95) CLOSE SECTION-->
    <!--EOF BlockBox-17 -->

    <?php $this->load->view('index/include/footer'); ?>

    <?php $this->load->view('index/include/footer_meta'); ?>

</body>

</html>