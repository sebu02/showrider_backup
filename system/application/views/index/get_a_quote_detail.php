<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('index/include/header_meta'); ?>

</head>

<body class="">

    <?php $this->load->view('index/include/header'); ?>

    <div class="afterload-featurebox gd_hide afterload-featurebox24" data-featurebox_id="24" data-boxtype="2"
        data-relation_with_id="269"></div>
    <!--START BlockBox-45 -->

    <?php $this->load->view('index/include/get_a_quote_detail_banner'); ?>

    <?php
    if($category_row != NULL){
    
    ?>

    <section class="full_wrapper relative_wrpr bg_img_cover_wrpr our_service_landing_block  bg_blocker">
        <div class="common_inner_wrpr padding_lr_primary_small padding_tb_primary">
            <!--START theme1-theme1_content_image_box19-wrapper1 (wrappercode_234) CLOSE SECTION-->
            <!--START theme1_content_image_box19-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_235) OPEN SECTION-->
            <div class="full_wrapper common_split_type4_wrpr get_a_quote_wrpr_extra">

                <form class="full_wrapper gl_get_a_quote_packages"
                    action="<?php echo base_url() . 'get-a-quote-form?id=' . $category_row->id; ?>" method="post">

                    <?php
                    $package_list = $this->index_model->getPackagesByCategory($category_row->id);
                   
                    if ($package_list != NULL) {
                        foreach ($package_list as $package_key => $package_row) {

                            $images_arr = json_decode($package_row->image, TRUE);
                            $image = $images_arr['image'];  
                            $image_alt = $images_arr['seo_alt'];
                            $image_title = $images_arr['seo_title'];

                            $package_price = 0;
                            $package_string = "";

                            if($package_row->price_status == "yes"){
                                $package_price = trim($package_row->price);
                                $package_string = "Rs. " . $package_price;
                            }
                    ?>

                    <div class="block_splitting">
                        <div class="get_a_quote_wrpr_inner">
                            <!--START theme1_content_image_box19-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_236) CLOSE SECTION-->
                            <!--START theme1_content_image_box19-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_237) OPEN SECTION-->
                            <div class="common_header_03">
                                <!--START theme1_content_image_box19-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_237) CLOSE SECTION-->

                                <?php
                                echo $package_row->name;
                                ?>

                                <!--EOF theme1_content_image_box19-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_237) OPEN SECTION-->
                            </div>
                            <!--EOF theme1_content_image_box19-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_237) CLOSE SECTION-->

                            <!--START theme1_content_image_box19-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_238) OPEN SECTION-->
                            <div class="block_img_wrpr">
                                <div class="block_img bg_color_design">
                                    <!--START theme1_content_image_box19-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_238) CLOSE SECTION-->

                                    <img src='<?php echo base_url() . 'media_library/' . $image; ?>'
                                        alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'>

                                    <!--EOF theme1_content_image_box19-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_238) OPEN SECTION-->
                                </div>
                            </div>
                            <!--EOF theme1_content_image_box19-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_238) CLOSE SECTION-->
                            <!--START BlockBox-47 -->
                            <!--START theme1-theme1_content_title_box2-wrapper1 (wrappercode_239) OPEN SECTION-->
                            <div class="checkbox_wrpr">
                                <!--START theme1-theme1_content_title_box2-wrapper1 (wrappercode_239) CLOSE SECTION-->
                                <!--START theme1_content_title_box2-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_240) OPEN SECTION-->
                                <div class="block_splitting01">
                                    <div class="checkbox_inner">
                                        <!--START theme1_content_title_box2-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_240) CLOSE SECTION-->

                                        <input class="full_size_check gl_package_check" type="checkbox"
                                            name="package_val[]" value="<?php echo $package_price; ?>">
                                        <label for="" class=""></label>

                                        <!--EOF theme1_content_title_box2-FORM_CHECKBOX-wrapper1 (wrappercode_241) OPEN SECTION-->

                                        <div class="checking_box_custom"> </div>

                                        <!--EOF theme1_content_title_box2-FORM_CHECKBOX-wrapper1 (wrappercode_241) CLOSE SECTION-->

                                        <!--START theme1_content_title_box2-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_242) OPEN SECTION-->
                                        <div class="checkbox_txt">
                                            <!--START theme1_content_title_box2-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_242) CLOSE SECTION-->

                                            <?php echo $package_string; ?>

                                            <!--EOF theme1_content_title_box2-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_242) OPEN SECTION-->
                                        </div>
                                        <!--EOF theme1_content_title_box2-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_242) CLOSE SECTION-->
                                        <!--EOF theme1_content_title_box2-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_240) OPEN SECTION-->
                                    </div>
                                </div>
                                <!--EOF theme1_content_title_box2-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_240) CLOSE SECTION-->
                                <!--EOF theme1-theme1_content_title_box2-wrapper1 (wrappercode_239) OPEN SECTION-->
                            </div>
                            <!--EOF theme1-theme1_content_title_box2-wrapper1 (wrappercode_239) CLOSE SECTION-->
                            <!--EOF BlockBox-47 -->
                            <!--EOF theme1_content_image_box19-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_236) OPEN SECTION-->
                        </div>
                    </div>

                    <?php
                        }
                    }
                    ?>

                    <div class=" full_wrapper quote_submit gl_quote_submit">
                        <div class="common_btn_2">SUBMIT</div>
                    </div>

                </form>

            </div>
            <!--EOF theme1_content_image_box19-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_235) CLOSE SECTION-->
            <!--EOF theme1-theme1_content_image_box19-wrapper1 (wrappercode_234) OPEN SECTION-->
        </div>
    </section>

    <?php
    }
    ?>

    <?php $this->load->view('index/include/footer_turn_your_events'); ?>

    <?php $this->load->view('index/include/footer'); ?>

    <?php $this->load->view('index/include/footer_meta'); ?>

    <script>
    $("body").on("click", ".gl_quote_submit", function() {

        var check_val = 0;

        $(".gl_get_a_quote_packages .gl_package_check").each(function() {

            if ($(this).is(':checked')) {
                check_val = 1;
            }

        });

        if (check_val == 1) {
            $(".gl_get_a_quote_packages").submit();
        } else {
            alert("Please select the package!");
        }

    });
    </script>

</body>

</html>