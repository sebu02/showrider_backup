<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('index/include/header_meta'); ?>

</head>

<body class="">

    <!--Page-241 start Tuesday 24th of October 2023 07:04:20 PM-->

    <?php $this->load->view('index/include/header'); ?>

    <div class="afterload-featurebox gd_hide afterload-featurebox24" data-featurebox_id="24" data-boxtype="2"
        data-relation_with_id="241"></div>
    <!--START BlockBox-43 -->

    <?php $this->load->view('index/include/book_a_show_banner'); ?>

    <!--START theme1-theme1_content_image_box17-wrapper1 (wrappercode_207) OPEN SECTION-->
    <section class="full_wrapper relative_wrpr book_a_show_wrpr ">
        <!--START theme1-theme1_content_image_box17-wrapper1 (wrappercode_207) CLOSE SECTION-->
        <!--START theme1_content_image_box17-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_208) OPEN SECTION-->
        <div class="common_inner_wrpr padding_lr_primary padding_tb_primary wrpr_flex ">

            <?php
            $media_list = $this->index_model->getAllEvents();

            if ($media_list != NULL) {
                foreach ($media_list as $media_key => $media_row) {

                    $images_arr = json_decode($media_row->image, TRUE);
                    $image = $images_arr['image'];  
                    $image_alt = $images_arr['seo_alt'];
                    $image_title = $images_arr['seo_title'];
            ?>

            <div class="block_split_half">
                <div class="splitting_inner">
                    <!--START theme1_content_image_box17-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_209) CLOSE SECTION-->
                    <!--START theme1_content_image_box17-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_210) OPEN SECTION-->
                    <div class="block_img">
                        <!--START theme1_content_image_box17-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_210) CLOSE SECTION-->

                        <img src='<?php echo base_url() . 'media_library/' . $image; ?>' alt='<?php echo $image_alt; ?>'
                            title='<?php echo $image_title; ?>'>

                        <!--EOF theme1_content_image_box17-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_210) OPEN SECTION-->
                    </div>
                    <!--EOF theme1_content_image_box17-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_210) CLOSE SECTION-->

                    <!--START theme1_content_image_box17-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_211) OPEN SECTION-->

                    <div class="common_header_04">
                        <!--START theme1_content_image_box17-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_211) CLOSE SECTION-->

                        <?php echo $media_row->name; ?>

                        <!--EOF theme1_content_image_box17-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_211) OPEN SECTION-->

                    </div>

                    <!--EOF theme1_content_image_box17-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_211) CLOSE SECTION-->

                    <!--START theme1_content_image_box17-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_212) OPEN SECTION-->
                    <div class="common_para">
                        <!--START theme1_content_image_box17-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_212) CLOSE SECTION-->

                        <?php echo $media_row->short_description; ?>

                        <!--EOF theme1_content_image_box17-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_212) OPEN SECTION-->
                    </div>
                    <!--EOF theme1_content_image_box17-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_212) CLOSE SECTION-->

                    <!--START theme1_content_image_box17-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_213) OPEN SECTION-->
                    <div class="common_btn_3">
                        <!--START theme1_content_image_box17-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_213) CLOSE SECTION-->

                        <a href="<?php echo base_url() . 'show-event?id=' . $media_row->id; ?>" class="btn_gradient" target="_self">Book Now</a><br />

                        <!--EOF theme1_content_image_box17-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_213) OPEN SECTION-->
                    </div>
                    <!--EOF theme1_content_image_box17-CONTENT_LINK_BOX_WRAPPER_BOX-wrapper1 (wrappercode_213) CLOSE SECTION-->
                    <!--EOF theme1_content_image_box17-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_209) OPEN SECTION-->
                </div>
            </div>

            <?php
                }
            }
            ?>

        </div>
        <!--EOF theme1_content_image_box17-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_208) CLOSE SECTION-->
        <!--EOF theme1-theme1_content_image_box17-wrapper1 (wrappercode_207) OPEN SECTION-->
    </section>

    <!--EOF theme1-theme1_content_image_box17-wrapper1 (wrappercode_207) CLOSE SECTION-->
    <!--EOF BlockBox-43 -->
    <!--START BlockBox-17 -->
    <!--START theme1-theme1_content_image_box7-wrapper1 (wrappercode_95) OPEN SECTION-->

    <?php $this->load->view('index/include/footer_turn_your_events'); ?>

    <!--EOF theme1-theme1_content_image_box7-wrapper1 (wrappercode_95) CLOSE SECTION-->
    <!--EOF BlockBox-17 -->

    <?php $this->load->view('index/include/footer'); ?>

    <?php $this->load->view('index/include/footer_meta'); ?>

</body>

</html>