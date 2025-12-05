<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('index/include/header_meta'); ?>

</head>

<body class="">

    <!--Page-223 start Tuesday 24th of October 2023 06:59:09 PM-->

    <?php $this->load->view('index/include/header'); ?>

    <div class="afterload-featurebox gd_hide afterload-featurebox24" data-featurebox_id="24" data-boxtype="2"
        data-relation_with_id="223"></div>
    <!--START BlockBox-17 -->

    <?php $this->load->view('index/include/photo_gallery_banner'); ?>

    <section class="full_wrapper relative_wrpr bg_img_cover_wrpr gallery_block_wrpr hover_head_common">
        <div class="common_inner_wrpr padding_lr_primary padding_tb_primary ">
            <!--START theme1-Gallery-BLOCK-wrapper1 (wrappercode_200) CLOSE SECTION-->
            <!--START BlockBox-40 -->
            <!--START theme1-theme1_content_title_box1-wrapper1 (wrappercode_201) OPEN SECTION-->

            <div class="sub_category_block">

                <!--START theme1-theme1_content_title_box1-wrapper1 (wrappercode_201) CLOSE SECTION-->
                <!--START theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) OPEN SECTION-->

                <div class="category_item gl_category_item" data-cid="0">
                    <!--START theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) CLOSE SECTION-->
                    <a href="javascript:void(0);" class="">ALL</a>
                    <!--EOF theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) OPEN SECTION-->
                </div>

                <?php
                $category_list = $this->index_model->getGalleryCategories();

                if($category_list != NULL){
                    foreach($category_list as $category_row){
                    
                ?>

                <div class="category_item gl_category_item" data-cid="<?php echo $category_row->id; ?>">
                    <!--START theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) CLOSE SECTION-->
                    <a href="javascript:void(0);" class=""><?php echo $category_row->category; ?></a>
                    <!--EOF theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) OPEN SECTION-->
                </div>

                <?php
                    }
                }
                ?>

                <!--EOF theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) CLOSE SECTION-->

                <!--START theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) OPEN SECTION-->

                <!--EOF theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) CLOSE SECTION-->
                <!--EOF theme1-theme1_content_title_box1-wrapper1 (wrappercode_201) OPEN SECTION-->

            </div><br />

            <!--EOF theme1-theme1_content_title_box1-wrapper1 (wrappercode_201) CLOSE SECTION-->
            <!--EOF BlockBox-40 -->
            <!--START BlockBox-41 -->
            <!--START theme1-theme1_content_image_box16-wrapper1 (wrappercode_203) OPEN SECTION-->

            <div
                class="gallery_inner_wrpr_nis full_wrapper common_split_type4_wrpr gallery_block_inner_wrpr gallery_img_popup_nis">
                <!--START theme1-theme1_content_image_box16-wrapper1 (wrappercode_203) CLOSE SECTION-->

                <?php
                $media_list = $this->index_model->getGalleryImages();

                if($media_list != NULL){
                    foreach($media_list as $media_key => $media_row){

                        $images_arr = json_decode($media_row->images, TRUE);
                        $image = $images_arr['image'];   
                        $image_alt = $images_arr['seo_alt'];
                        $image_title = $images_arr['seo_title'];
                    
                ?>

                <a href="javascript:void(0);"
                    class="venobox gallery_img_wrpr zoom_hover gl_gallery_images gl_cat_image_<?php echo $media_row->prod_cat; ?>"
                    data-large-image="customimageurl">

                    <img src='<?php echo base_url() . 'media_library/' . $image; ?>' alt='<?php echo $image_alt; ?>'
                        title='<?php echo $image_title; ?>'>

                </a>

                <?php
                    }
                }
                ?>

                <!--EOF theme1-theme1_content_image_box16-wrapper1 (wrappercode_203) OPEN SECTION-->
            </div>

            <!--EOF theme1-theme1_content_image_box16-wrapper1 (wrappercode_203) CLOSE SECTION-->
            <!--EOF BlockBox-41 -->
            <!--EOF theme1-Gallery-BLOCK-wrapper1 (wrappercode_200) OPEN SECTION-->

        </div>
    </section>

    <!--START theme1-theme1_content_image_box7-wrapper1 (wrappercode_95) OPEN SECTION-->

    <?php $this->load->view('index/include/footer_turn_your_events'); ?>

    <!--EOF theme1-theme1_content_image_box7-wrapper1 (wrappercode_95) CLOSE SECTION-->
    <!--EOF BlockBox-17 -->

    <?php $this->load->view('index/include/footer'); ?>

    <?php $this->load->view('index/include/footer_meta'); ?>

    <script>
    $("body").on("click", ".gl_category_item", function() {
        var cid = $(this).attr("data-cid");

        if (cid == 0) {
            $(".gl_gallery_images").show();
        } else {
            $(".gl_gallery_images").hide();
            $(".gl_cat_image_" + cid).show();
        }

    });
    </script>

</body>

</html>