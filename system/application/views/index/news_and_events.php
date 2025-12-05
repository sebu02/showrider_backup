<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('index/include/header_meta'); ?>

</head>

<body class="">

    <!--Page-196 start Tuesday 24th of October 2023 06:59:29 PM-->

    <?php $this->load->view('index/include/header'); ?>

    <div class="afterload-featurebox gd_hide afterload-featurebox24" data-featurebox_id="24" data-boxtype="2"
        data-relation_with_id="196"></div>
    <!--START BlockBox-33 -->

    <?php $this->load->view('index/include/news_and_events_banner'); ?>

    <!--START theme1-theme1_content_image_box13-wrapper1 (wrappercode_168) OPEN SECTION-->
    <section class="full_wrapper event_page_block wrpr_flex">
        <!--START theme1-theme1_content_image_box13-wrapper1 (wrappercode_168) CLOSE SECTION-->
        <!--START theme1_content_image_box13-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_169) OPEN SECTION-->

        <?php
        $media_list = $this->index_model->getMediaList(24);

        if ($media_list != NULL) {
            foreach ($media_list as $media_key => $media_row) {
                $images_arr = json_decode($media_row->images, TRUE);
                $image = $images_arr[0]['image']; 
                $image_alt = $images_arr[0]['seo_alt'];
                $image_title = $images_arr[0]['seo_title'];
        ?>

        <div class="wprp_split_common split_shadow">
            <!--START theme1_content_image_box13-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_169) CLOSE SECTION-->
            <!--START theme1-customstructurebox_186-BLOCK-wrapper1 (wrappercode_166) OPEN SECTION-->
            <div class="thmbnail_wrpr">
                <!--START theme1-customstructurebox_186-BLOCK-wrapper1 (wrappercode_166) CLOSE SECTION-->
                <!--START theme1_content_image_box13-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_170) OPEN SECTION-->
                <div class="image_wrpr zoom_hover">
                    <!--START theme1_content_image_box13-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_170) CLOSE SECTION-->

                    <img src='<?php echo base_url() . 'media_library/' . $image; ?>' alt='<?php echo $image_alt; ?>'
                        title='<?php echo $image_title; ?>'>

                    <!--EOF theme1_content_image_box13-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_170) OPEN SECTION-->
                </div>
                <!--EOF theme1_content_image_box13-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_170) CLOSE SECTION-->

                <!--START theme1_content_image_box13-CONTENT_TITLE_2_BOX1-wrapper1 (wrappercode_171) OPEN SECTION-->
                <div class="overlay_wprp">
                    <div class="date_detail_block btn_gradient">
                        <!--START theme1_content_image_box13-CONTENT_TITLE_2_BOX1-wrapper1 (wrappercode_171) CLOSE SECTION-->

                        <?php 
                        if($media_row->content_date != "0000-00-00 00:00:00"){
                            echo date('d-m-Y', strtotime($media_row->content_date));
                        }else{
                            echo "00-00-0000";
                        }
                                                
                        ?>

                        <!--EOF theme1_content_image_box13-CONTENT_TITLE_2_BOX1-wrapper1 (wrappercode_171) OPEN SECTION-->
                    </div>
                </div>
                <!--EOF theme1_content_image_box13-CONTENT_TITLE_2_BOX1-wrapper1 (wrappercode_171) CLOSE SECTION-->
                <!--EOF theme1-customstructurebox_186-BLOCK-wrapper1 (wrappercode_166) OPEN SECTION-->
            </div>
            <!--EOF theme1-customstructurebox_186-BLOCK-wrapper1 (wrappercode_166) CLOSE SECTION-->
            <!--START theme1-customstructurebox_186-BLOCK-wrapper2 (wrappercode_167) OPEN SECTION-->
            <div class="details_wrpr">
                <!--START theme1-customstructurebox_186-BLOCK-wrapper2 (wrappercode_167) CLOSE SECTION-->
                <!--START theme1_content_image_box13-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_172) OPEN SECTION-->
                <div class="heading_with_icon">
                    <!--START theme1_content_image_box13-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_172) CLOSE SECTION-->

                    <?php echo $media_row->content_title; ?>

                    <!--EOF theme1_content_image_box13-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_172) OPEN SECTION-->
                </div>
                <!--EOF theme1_content_image_box13-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_172) CLOSE SECTION-->

                <!--START theme1_content_image_box13-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_175) OPEN SECTION-->
                <div class="inner_para">
                    <!--START theme1_content_image_box13-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_175) CLOSE SECTION-->

                    <p><?php echo $media_row->content_short_description; ?></p>

                    <!--EOF theme1_content_image_box13-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_175) OPEN SECTION-->
                </div>
                <!--EOF theme1_content_image_box13-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_175) CLOSE SECTION-->

                <!--START theme1_content_image_box13-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_176) OPEN SECTION-->
                <div class="common_link_img_box_wrpr_link_wrpr dark_link">
                    <!--START theme1_content_image_box13-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_176) CLOSE SECTION-->

                    <a href="<?php echo base_url() . 'news-and-events-detail?id=' . $media_row->id; ?>"
                        class="common_link_img_box_wrpr_link dark_link" target="_self">

                        <!--START Icon Right Arrow 1 (wrappercode_75) OPEN SECTION-->

                        <i class="gd_icon_right_f"></i>

                        <!--START Icon Right Arrow 1 (wrappercode_75) CLOSE SECTION-->
                        <!--EOF Icon Right Arrow 1 (wrappercode_75) OPEN SECTION-->
                        <!--EOF Icon Right Arrow 1 (wrappercode_75) CLOSE SECTION-->

                        <!--START Span Tag (wrappercode_35) OPEN SECTION-->

                        <span class="">

                            <!--START Span Tag (wrappercode_35) CLOSE SECTION-->

                            <?php echo $media_row->second_title; ?>

                            <!--EOF Span Tag (wrappercode_35) OPEN SECTION-->
                        </span>
                        <!--EOF Span Tag (wrappercode_35) CLOSE SECTION-->
                    </a>
                    <!--EOF theme1_content_image_box13-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_176) OPEN SECTION-->
                </div>
                <!--EOF theme1_content_image_box13-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_176) CLOSE SECTION-->
                <!--EOF theme1-customstructurebox_186-BLOCK-wrapper2 (wrappercode_167) OPEN SECTION-->
            </div>
            <!--EOF theme1-customstructurebox_186-BLOCK-wrapper2 (wrappercode_167) CLOSE SECTION-->
            <!--EOF theme1_content_image_box13-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_169) OPEN SECTION-->
        </div>

        <?php
            }
        }
        ?>

        <!--EOF theme1_content_image_box13-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_169) CLOSE SECTION-->

        <!--START theme1_content_image_box13-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_169) OPEN SECTION-->

        <!--EOF theme1_content_image_box13-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_169) CLOSE SECTION-->
        <!--EOF theme1-theme1_content_image_box13-wrapper1 (wrappercode_168) OPEN SECTION-->
    </section>

    <!--EOF theme1-theme1_content_image_box13-wrapper1 (wrappercode_168) CLOSE SECTION-->
    <!--EOF BlockBox-33 -->
    <!--START BlockBox-17 -->
    <!--START theme1-theme1_content_image_box7-wrapper1 (wrappercode_95) OPEN SECTION-->

    <?php $this->load->view('index/include/footer_turn_your_events'); ?>

    <!--EOF theme1-theme1_content_image_box7-wrapper1 (wrappercode_95) CLOSE SECTION-->
    <!--EOF BlockBox-17 -->

    <?php $this->load->view('index/include/footer'); ?>

    <?php $this->load->view('index/include/footer_meta'); ?>

</body>

</html>