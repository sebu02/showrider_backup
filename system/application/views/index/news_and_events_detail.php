<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('index/include/header_meta'); ?>

</head>

<body class="">

    <!--START theme1-Inner-Header-BLOCK-wrapper1 (wrappercode_120) OPEN SECTION-->

    <?php $this->load->view('index/include/header'); ?>

    <!--START theme1-Header-BLOCK-wrapper8 (wrappercode_50) CLOSE SECTION-->
    <!--EOF theme1-Header-BLOCK-wrapper8 (wrappercode_50) OPEN SECTION-->
    <!--EOF theme1-Header-BLOCK-wrapper8 (wrappercode_50) CLOSE SECTION-->

    <div class="afterload-featurebox gd_hide afterload-featurebox24" data-featurebox_id="24" data-boxtype="2"
        data-relation_with_id="378"></div>
    <!--START BlockBox-34 -->

    <?php $this->load->view('index/include/news_and_events_detail_banner'); ?>

    <!--START theme1-theme1_content_image_box14-wrapper1 (wrappercode_179) OPEN SECTION-->

    <?php
    if($content_row != NULL){
        $images_arr = json_decode($content_row->images, TRUE);
        $image = $images_arr[0]['image'];   
        $image_alt = $images_arr[0]['seo_alt'];
        $image_title = $images_arr[0]['seo_title'];
    ?>

    <section class="full_wrapper news_and_evnsts_details_block wrpr_flex padding_lr_primary padding_f2_tb">
        <!--START theme1-theme1_content_image_box14-wrapper1 (wrappercode_179) CLOSE SECTION-->
        <!--START BlockBox-35 -->
        <!--START theme1-theme1_content_image_box15-wrapper1 (wrappercode_182) OPEN SECTION-->
        <div class="block_split_half">
            <div class="full_wrapper thmbnail_wrpr">
                <!--START theme1-theme1_content_image_box15-wrapper1 (wrappercode_182) CLOSE SECTION-->
                <!--START theme1_content_image_box15-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_183) OPEN SECTION-->
                <div class="news_and_evnsts_details_slider owl-carousel owl-theme">
                    <!--START theme1_content_image_box15-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_183) CLOSE SECTION-->
                    <!--START theme1_content_image_box15-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_184) OPEN SECTION-->
                    <div class="thmbnail_wrpr ">
                        <!--START theme1_content_image_box15-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_184) CLOSE SECTION-->
                        <!--START theme1_content_image_box15-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_185) OPEN SECTION-->
                        <div class="image_wrpr">
                            <!--START theme1_content_image_box15-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_185) CLOSE SECTION-->

                            <img src='<?php echo base_url() . 'media_library/' . $image; ?>'
                                alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'>

                            <!--EOF theme1_content_image_box15-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_185) OPEN SECTION-->
                        </div>
                        <!--EOF theme1_content_image_box15-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_185) CLOSE SECTION-->
                        <!--EOF theme1_content_image_box15-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_184) OPEN SECTION-->
                    </div>
                    <!--EOF theme1_content_image_box15-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_184) CLOSE SECTION-->
                    <!--EOF theme1_content_image_box15-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_183) OPEN SECTION-->
                </div>
                <div class="overlay_wprp">
                    <div class="date_detail_block btn_gradient"> </div>
                </div>
                <!--EOF theme1_content_image_box15-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_183) CLOSE SECTION-->
                <!--EOF theme1-theme1_content_image_box15-wrapper1 (wrappercode_182) OPEN SECTION-->
            </div>
        </div>
        <!--EOF theme1-theme1_content_image_box15-wrapper1 (wrappercode_182) CLOSE SECTION-->
        <!--EOF BlockBox-35 -->
        <!--START theme1-customstructurebox_198-BLOCK-wrapper1 (wrappercode_178) OPEN SECTION-->
        <div class="block_split_half">
            <div class="details_page_content_block">
                <!--START theme1-customstructurebox_198-BLOCK-wrapper1 (wrappercode_178) CLOSE SECTION-->
                <!--START theme1_content_image_box14-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_180) OPEN SECTION-->
                <div class="detail_heading">
                    <!--START theme1_content_image_box14-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_180) CLOSE SECTION-->

                    <?php echo $content_row->content_title; ?>

                    <!--EOF theme1_content_image_box14-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_180) OPEN SECTION-->
                </div>
                <!--EOF theme1_content_image_box14-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_180) CLOSE SECTION-->

                <!--START theme1_content_image_box14-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_181) OPEN SECTION-->
                <div class="details_para">
                    <!--START theme1_content_image_box14-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_181) CLOSE SECTION-->

                    <?php echo $content_row->brief_details; ?>

                    <!--EOF theme1_content_image_box14-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_181) OPEN SECTION-->
                </div>
                <!--EOF theme1_content_image_box14-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_181) CLOSE SECTION-->
                <!--EOF theme1-customstructurebox_198-BLOCK-wrapper1 (wrappercode_178) OPEN SECTION-->
            </div>
        </div>
        <!--EOF theme1-customstructurebox_198-BLOCK-wrapper1 (wrappercode_178) CLOSE SECTION-->
        <!--EOF theme1-theme1_content_image_box14-wrapper1 (wrappercode_179) OPEN SECTION-->
    </section>

    <?php
    }
    ?>

    <!--EOF theme1-theme1_content_image_box14-wrapper1 (wrappercode_179) CLOSE SECTION-->
    <!--EOF BlockBox-34 -->
    <!--Page-2 start Tuesday 24th of October 2023 06:57:28 PM-->
    <!--START BlockBox-17 -->
    <!--START theme1-theme1_content_image_box7-wrapper1 (wrappercode_95) OPEN SECTION-->

    <?php $this->load->view('index/include/footer_turn_your_events'); ?>

    <!--EOF theme1-theme1_content_image_box7-wrapper1 (wrappercode_95) CLOSE SECTION-->
    <!--EOF BlockBox-17 -->
    <!--START theme1-Footer-BLOCK-wrapper1 (wrappercode_100) OPEN SECTION-->

    <?php $this->load->view('index/include/footer'); ?>

    <!--START theme1-Footer-BLOCK-wrapper5 (wrappercode_119) CLOSE SECTION-->
    <!--EOF theme1-Footer-BLOCK-wrapper5 (wrappercode_119) OPEN SECTION-->
    <!--EOF theme1-Footer-BLOCK-wrapper5 (wrappercode_119) CLOSE SECTION-->
    <!--Page-2 EOF Tuesday 24th of October 2023 06:57:28 PM-->

    <?php $this->load->view('index/include/footer_meta'); ?>

</body>

</html>