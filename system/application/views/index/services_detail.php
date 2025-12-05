<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('index/include/header_meta'); ?>

</head>

<body class="">

    <!--Page-153 start Tuesday 24th of October 2023 07:03:11 PM-->
    <!--START theme1-Inner-Header-BLOCK-wrapper1 (wrappercode_120) OPEN SECTION-->

    <?php $this->load->view('index/include/header'); ?>

    <div class="afterload-featurebox gd_hide afterload-featurebox24" data-featurebox_id="24" data-boxtype="2"
        data-relation_with_id="153"></div>

    <?php $this->load->view('index/include/services_detail_banner'); ?>

    <!--START theme1-Service-Detail-BLOCK-wrapper1 (wrappercode_137) OPEN SECTION-->

    <section class="full_wrapper relative_wrpr our_service_detail_block">
        <div class="common_inner_wrpr padding_lr_primary padding_tb_primary">

            <?php
        $images_arr = json_decode($category_row->banner, TRUE);
        $image = $images_arr[0]['image'];
        $image_alt = $images_arr[0]['seo_alt'];
        $image_title = $images_arr[0]['seo_title'];
        ?>

            <div class="service_details_wrpr wrpr_flex our_service_detail_inner_block">

                <div class="block_split_half">
                    <div class="about_wrpr widget full_wrapper">

                        <div class="service_details_slider  owl-carousel owl-theme">

                            <div class="item">

                                <img src='<?php echo base_url() . 'media_library/' . $image; ?>'
                                    alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'>

                            </div>

                        </div>

                    </div>
                </div>

                <div class="block_split_half flex_center">

                    <div class="details_with_btn_border">

                        <div class="common_sub_title"><span>

                                <?php echo $category_row->banner_title; ?>

                            </span></div>

                        <div class="para_common_times para_font text_center">

                            <?php echo $category_row->category_description; ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

    <!--EOF theme1-Service-Detail-BLOCK-wrapper1 (wrappercode_137) CLOSE SECTION-->
    <!--START BlockBox-50 -->
    <!--START theme1-theme1_content_image_box11-wrapper1 (wrappercode_145) OPEN SECTION-->

    <?php
    
    if($products_result != NULL){
        foreach($products_result as $product_row){
        
    ?>

    <section class="full_wrapper wrpr_flex ">
        <div class="common_inner_wrpr  padding_lr_primary padding_tb_primary ">
            <div class="listing_block">

                <div class="common_sub_title">
                    <span>

                        <?php echo $product_row->product_title; ?>

                    </span>
                </div>

                <ul class="listing_block_group">

                    <?php
                    $media_list = $this->index_model->getProductMediaListGallery($product_row->id);

                    if ($media_list != NULL) {                            
                        foreach ($media_list as $media_key => $media_row) { 
                            $images_arr = json_decode($media_row->images, TRUE);
                            $image = $images_arr['image'];   
                            $image_alt = $images_arr['seo_alt'];
                            $image_title = $images_arr['seo_title']; 

                            $customized_link = json_decode($media_row->custom_link, TRUE);
                            $full_url = $this->index_model->getCustomUrl($customized_link); 
                    ?>

                    <li class="listing_block_item">

                        <a href="<?php echo $full_url; ?>" class="venobox_inner listing_img zoom_hover"
                            target="<?php echo $customized_link['target_type']; ?>">

                            <img src='<?php echo base_url(). 'media_library/' . $image; ?>'
                                alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'>

                        </a>

                        <div class="listing_block_text">

                            <?php echo $media_row->title; ?>

                        </div>

                    </li>

                    <?php
                        }
                    }
                    ?>

                </ul>

            </div>
        </div>
    </section>

    <?php
        }
    }
    ?>

    <!--EOF theme1-theme1_content_image_box11-wrapper1 (wrappercode_145) CLOSE SECTION-->
    <!--EOF BlockBox-50 -->
    <!--START BlockBox-51 -->
    <!--START theme1-theme1_content_image_box11-wrapper1 (wrappercode_145) OPEN SECTION-->

    <?php $this->load->view('index/include/footer_turn_your_events'); ?>

    <!--EOF theme1-theme1_content_image_box7-wrapper1 (wrappercode_95) CLOSE SECTION-->
    <!--EOF BlockBox-17 -->
    <!--START theme1-Footer-BLOCK-wrapper1 (wrappercode_100) OPEN SECTION-->

    <?php $this->load->view('index/include/footer'); ?>

    <?php $this->load->view('index/include/footer_meta'); ?>

</body>

</html>