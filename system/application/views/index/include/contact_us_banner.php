<?php
$media_list = $this->index_model->getMediaList(40);

if ($media_list != NULL) {
    foreach ($media_list as $media_key => $media_row) {

        $images_arr = json_decode($media_row->images, TRUE);
        $image = $images_arr[0]['image'];   
        $image_alt = $images_arr[0]['seo_alt'];
        $image_title = $images_arr[0]['seo_title'];
?>

<section class="inner_page_banner_block full_wrapper hover_head_common" style="">
    <!--START theme1-theme1_content_image_box9-wrapper1 (wrappercode_122) CLOSE SECTION-->
    <!--START theme1_content_image_box9-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_123) OPEN SECTION-->
    <div class="inner_banner_img_block">
        <!--START theme1_content_image_box9-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_123) CLOSE SECTION-->

        <img src="<?php echo base_url() . 'media_library/' . $image; ?>" alt="<?php echo $image_alt; ?>" title="<?php echo $image_title; ?>">

        <!--START theme1_content_image_box9-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_124) OPEN SECTION-->
        <div class="overlay">
            <div class="heading_Common_style medium_border">
                <div class="border_styles">
                    <!--START theme1_content_image_box9-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_124) CLOSE SECTION-->
                    <!--START theme1_content_image_box9-CONTENT_TITLE_BOX1-title_sub_wrapper1 (wrappercode_125) OPEN SECTION-->
                    
                    <span class="btn_gradient">
                        <!--START theme1_content_image_box9-CONTENT_TITLE_BOX1-title_sub_wrapper1 (wrappercode_125) CLOSE SECTION-->                        
                                                
                        <?php echo $media_row->content_title; ?>

                        <!--EOF theme1_content_image_box9-CONTENT_TITLE_BOX1-title_sub_wrapper1 (wrappercode_125) OPEN SECTION-->
                    </span>
                    <!--EOF theme1_content_image_box9-CONTENT_TITLE_BOX1-title_sub_wrapper1 (wrappercode_125) CLOSE SECTION-->

                    <!--START Icon Bottom Line (wrappercode_34) OPEN SECTION-->
                    <div class="bottom_line"></div>
                    <!--START Icon Bottom Line (wrappercode_34) CLOSE SECTION-->
                    <!--EOF Icon Bottom Line (wrappercode_34) OPEN SECTION-->
                    <!--EOF Icon Bottom Line (wrappercode_34) CLOSE SECTION-->
                    <!--EOF theme1_content_image_box9-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_124) OPEN SECTION-->
                </div>
            </div>
        </div>
        <!--EOF theme1_content_image_box9-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_124) CLOSE SECTION-->
        <!--EOF theme1_content_image_box9-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_123) OPEN SECTION-->
    </div>
    <!--EOF theme1_content_image_box9-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_123) CLOSE SECTION-->
    <!--EOF theme1-theme1_content_image_box9-wrapper1 (wrappercode_122) OPEN SECTION-->
</section>

<?php
    }
}
?>