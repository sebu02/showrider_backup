<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('index/include/header_meta'); ?>

</head>

<body class="">

    <!--Page-171 start Tuesday 24th of October 2023 07:04:54 PM-->

    <?php $this->load->view('index/include/header'); ?>

    <div class="afterload-featurebox gd_hide afterload-featurebox24" data-featurebox_id="24" data-boxtype="2"
        data-relation_with_id="171"></div>
    <!--START BlockBox-31 -->

    <?php $this->load->view('index/include/associations_banner'); ?>

    <!--START theme1-theme1_content_image_box12-wrapper1 (wrappercode_152) OPEN SECTION-->

    <section class="full_wrapper clients_block padding_tb_primary bg_blocker">
        <!--START theme1-theme1_content_image_box12-wrapper1 (wrappercode_152) CLOSE SECTION-->
        <!--START theme1_content_image_box12-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_153) OPEN SECTION-->
        <div class="full_wrapper wrpr_flex padding_lr_primary">

            <?php
                        $media_list = $this->index_model->getMediaList(16);

                        if ($media_list != NULL) {
                            foreach ($media_list as $media_key => $media_row) {
                                $images_arr = json_decode($media_row->images, TRUE);
                                $image = $images_arr[0]['image'];
                                $image_alt = $images_arr[0]['seo_alt'];
                                $image_title = $images_arr[0]['seo_title'];
                        ?>

            <!--START theme1_content_image_box12-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_153) CLOSE SECTION-->
            <!--START theme1_content_image_box12-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_154) OPEN SECTION-->
            <div class="block_splitting">
                <!--START theme1_content_image_box12-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_154) CLOSE SECTION-->
                <!--START theme1-customstructurebox_172-BLOCK-wrapper1 (wrappercode_151) OPEN SECTION-->
                <div class="logo_thumbnails zoom_hover">
                    <!--START theme1-customstructurebox_172-BLOCK-wrapper1 (wrappercode_151) CLOSE SECTION-->

                    <img src='<?php echo base_url() . 'media_library/' . $image; ?>' alt='<?php echo $image_alt; ?>'
                        title='<?php echo $image_title; ?>'>

                    <!--START theme1_content_image_box12-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_155) OPEN SECTION-->
                    <div class="overlay assoc">
                        <div class="thumbail_text">
                            <!--START theme1_content_image_box12-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_155) CLOSE SECTION-->

                            <?php echo $media_row->content_title; ?>

                            <!--EOF theme1_content_image_box12-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_155) OPEN SECTION-->
                        </div>
                    </div>
                    <!--EOF theme1_content_image_box12-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_155) CLOSE SECTION-->
                    <!--EOF theme1-customstructurebox_172-BLOCK-wrapper1 (wrappercode_151) OPEN SECTION-->
                </div>
                <!--EOF theme1-customstructurebox_172-BLOCK-wrapper1 (wrappercode_151) CLOSE SECTION-->
                <!--START theme1_content_image_box12-CONTENT_LINK_BOX_2_WRAPPER_BOX-wrapper1 (wrappercode_156) OPEN SECTION-->
                <div class="common_link_img_box_wrpr_link_wrpr">
                    <!--START theme1_content_image_box12-CONTENT_LINK_BOX_2_WRAPPER_BOX-wrapper1 (wrappercode_156) CLOSE SECTION-->

                    <a href="<?php echo base_url() . 'associations-detail?id=' . $media_row->id; ?>"
                        class="common_link_img_box_wrpr_link" target="_self">

                        <!--START Icon Right Arrow 1 (wrappercode_75) OPEN SECTION-->

                        <i class="gd_icon_right_f"></i>

                        <!--START Icon Right Arrow 1 (wrappercode_75) CLOSE SECTION-->
                        <!--EOF Icon Right Arrow 1 (wrappercode_75) OPEN SECTION-->
                        <!--EOF Icon Right Arrow 1 (wrappercode_75) CLOSE SECTION-->

                        <!--START Span Tag (wrappercode_35) OPEN SECTION--><span class="">
                            <!--START Span Tag (wrappercode_35) CLOSE SECTION-->Discover More
                            <!--EOF Span Tag (wrappercode_35) OPEN SECTION-->
                        </span>
                        <!--EOF Span Tag (wrappercode_35) CLOSE SECTION-->
                    </a>
                    <!--EOF theme1_content_image_box12-CONTENT_LINK_BOX_2_WRAPPER_BOX-wrapper1 (wrappercode_156) OPEN SECTION-->
                </div>
                <!--EOF theme1_content_image_box12-CONTENT_LINK_BOX_2_WRAPPER_BOX-wrapper1 (wrappercode_156) CLOSE SECTION-->
                <!--EOF theme1_content_image_box12-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_154) OPEN SECTION-->
            </div>
            <!--EOF theme1_content_image_box12-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_154) CLOSE SECTION-->

            <?php
                            }
                        }
                        ?>

            <!--START theme1_content_image_box12-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_154) OPEN SECTION-->

            <!--EOF theme1_content_image_box12-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_154) CLOSE SECTION-->
            <!--EOF theme1_content_image_box12-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_153) OPEN SECTION-->

        </div>
        <!--EOF theme1_content_image_box12-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_153) CLOSE SECTION-->
        <!--EOF theme1-theme1_content_image_box12-wrapper1 (wrappercode_152) OPEN SECTION-->
    </section>

    <!--EOF theme1-theme1_content_image_box12-wrapper1 (wrappercode_152) CLOSE SECTION-->
    <!--EOF BlockBox-31 -->
    <!--START BlockBox-17 -->
    <!--START theme1-theme1_content_image_box7-wrapper1 (wrappercode_95) OPEN SECTION-->

    <?php $this->load->view('index/include/footer_turn_your_events'); ?>

    <!--EOF theme1-theme1_content_image_box7-wrapper1 (wrappercode_95) CLOSE SECTION-->
    <!--EOF BlockBox-17 -->

    <?php $this->load->view('index/include/footer'); ?>

    <?php $this->load->view('index/include/footer_meta'); ?>

</body>

</html>