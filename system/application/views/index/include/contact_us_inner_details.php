<section class="full_wrapper block_split_type2 map_full_wrpr">
    <!--START theme1-Contactus-BLOCK-wrapper1 (wrappercode_186) CLOSE SECTION-->
    <!--START BlockBox-36 -->
    <!--START theme1-theme1_content_icon_box3-wrapper1 (wrappercode_187) OPEN SECTION-->

    <?php
    $media_list = $this->index_model->getMediaList(41);

    if ($media_list != NULL) {
        foreach ($media_list as $media_key => $media_row) {
    ?>

    <div class="block_split_inner_wrpr map_inner_wrpr map_left_side">
        <!--START theme1-theme1_content_icon_box3-wrapper1 (wrappercode_187) CLOSE SECTION-->
        <!--START Icon Map Iframe (wrappercode_188) OPEN SECTION-->

        <iframe src="<?php echo $media_row->content_short_description; ?>" width="100%" height="100%" frameborder="0"
            style="border:0;" allowfullscreen=""></iframe>

        <!--START Icon Map Iframe (wrappercode_188) CLOSE SECTION-->
        <!--EOF Icon Map Iframe (wrappercode_188) OPEN SECTION-->
        <!--EOF Icon Map Iframe (wrappercode_188) CLOSE SECTION-->
        <!--EOF theme1-theme1_content_icon_box3-wrapper1 (wrappercode_187) OPEN SECTION-->
    </div>

    <?php
        }
    }
    ?>

    <!--EOF theme1-theme1_content_icon_box3-wrapper1 (wrappercode_187) CLOSE SECTION-->
    <!--EOF BlockBox-36 -->
    <!--START theme1-Contactus-BLOCK-wrapper2 (wrappercode_189) OPEN SECTION-->
    <div class="block_split_inner_wrpr block_split_type3 map_inner_wrpr map_right_side">
        <!--START theme1-Contactus-BLOCK-wrapper2 (wrappercode_189) CLOSE SECTION-->
        <!--START BlockBox-37 -->
        <!--START theme1-theme1_content_description_box6-wrapper1 (wrappercode_190) OPEN SECTION-->

        <?php
        $media_list = $this->index_model->getMediaList(41);

        if ($media_list != NULL) {
            foreach ($media_list as $media_key => $media_row) {
        ?>

        <div class="block_split_full_wrpr block_title_info_wrpr quick_address_wrpr">
            <!--START theme1-theme1_content_description_box6-wrapper1 (wrappercode_190) CLOSE SECTION-->
            <!--START theme1_content_description_box6-INPUT_PREFIX_ICON_BOX-wrapper1 (wrappercode_191) OPEN SECTION-->
            <div class="block_title_info_icon">
                <!--START theme1_content_description_box6-INPUT_PREFIX_ICON_BOX-wrapper1 (wrappercode_191) CLOSE SECTION-->
                <!--START Icon Location (wrappercode_192) OPEN SECTION-->
                <span class="gd_icon_location"></span>
                <!--START Icon Location (wrappercode_192) CLOSE SECTION-->
                <!--EOF Icon Location (wrappercode_192) OPEN SECTION-->
                <!--EOF Icon Location (wrappercode_192) CLOSE SECTION-->
                <!--EOF theme1_content_description_box6-INPUT_PREFIX_ICON_BOX-wrapper1 (wrappercode_191) OPEN SECTION-->
            </div>
            <!--EOF theme1_content_description_box6-INPUT_PREFIX_ICON_BOX-wrapper1 (wrappercode_191) CLOSE SECTION-->

            <!--START theme1_content_description_box6-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_193) OPEN SECTION-->
            <div class="block_title_info_head rellax_action" data-scroll-from="1">
                <!--START theme1_content_description_box6-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_193) CLOSE SECTION-->

                <?php echo $media_row->content_title; ?>

                <!--EOF theme1_content_description_box6-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_193) OPEN SECTION-->
            </div>
            <!--EOF theme1_content_description_box6-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_193) CLOSE SECTION-->

            <!--START theme1_content_description_box6-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_194) OPEN SECTION-->
            <div class="block_title_info_para">
                <!--START theme1_content_description_box6-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_194) CLOSE SECTION-->

                <?php echo $media_row->brief_details; ?>

                <!--EOF theme1_content_description_box6-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_194) OPEN SECTION-->
            </div>
            <!--EOF theme1_content_description_box6-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_194) CLOSE SECTION-->
            <!--EOF theme1-theme1_content_description_box6-wrapper1 (wrappercode_190) OPEN SECTION-->
        </div>

        <?php
            }
        }
        ?>

        <!--EOF theme1-theme1_content_description_box6-wrapper1 (wrappercode_190) CLOSE SECTION-->
        <!--EOF BlockBox-37 -->
        <!--START BlockBox-38 -->
        <!--START theme1-customstructurebox_215-BLOCK-wrapper1 (wrappercode_195) OPEN SECTION-->

        <?php
        $media_list = $this->index_model->getMediaList(42);

        if ($media_list != NULL) {
            foreach ($media_list as $media_key => $media_row) {

                $images_arr = json_decode($media_row->images, TRUE);
                $image = $images_arr[0]['image'];   
                $image_alt = $images_arr[0]['seo_alt'];
                $image_title = $images_arr[0]['seo_title'];
        ?>

        <div class="block_split_inner_wrpr quick_contact_call_wrpr contact_quick_link">
            <!--START theme1-customstructurebox_215-BLOCK-wrapper1 (wrappercode_195) CLOSE SECTION-->
            <!--START theme1_content_description_box7-CONTENT_ICON_BOX1-wrapper1 (wrappercode_196) OPEN SECTION-->
            <div class="quick_contact_call_icon">
                <!--START theme1_content_description_box7-CONTENT_ICON_BOX1-wrapper1 (wrappercode_196) CLOSE SECTION-->
                <!--START Icon Call 2 (wrappercode_197) OPEN SECTION-->

                <span class="gd_icon_baselinecall"></span>

                <!--START Icon Call 2 (wrappercode_197) CLOSE SECTION-->
                <!--EOF Icon Call 2 (wrappercode_197) OPEN SECTION-->
                <!--EOF Icon Call 2 (wrappercode_197) CLOSE SECTION-->
                <!--EOF theme1_content_description_box7-CONTENT_ICON_BOX1-wrapper1 (wrappercode_196) OPEN SECTION-->
            </div>
            <!--EOF theme1_content_description_box7-CONTENT_ICON_BOX1-wrapper1 (wrappercode_196) CLOSE SECTION-->

            <!--START theme1_content_description_box7-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_198) OPEN SECTION-->
            <div class="quick_contact_call_mail">
                <!--START theme1_content_description_box7-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_198) CLOSE SECTION-->

                <?php echo $media_row->brief_details; ?>

                <!--EOF theme1_content_description_box7-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_198) OPEN SECTION-->
            </div>
            <!--EOF theme1_content_description_box7-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_198) CLOSE SECTION-->
            <!--EOF theme1-customstructurebox_215-BLOCK-wrapper1 (wrappercode_195) OPEN SECTION-->
        </div>

        <!--EOF theme1-customstructurebox_215-BLOCK-wrapper1 (wrappercode_195) CLOSE SECTION-->
        <!--START theme1_content_description_box7-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_199) OPEN SECTION-->

        <div class="block_split_inner_wrpr contact_img">
            <!--START theme1_content_description_box7-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_199) CLOSE SECTION-->

            <img src='<?php echo base_url() . 'media_library/' . $image; ?>' alt='<?php echo $image_alt; ?>'
                title='<?php echo $image_title; ?>'>

            <!--EOF theme1_content_description_box7-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_199) OPEN SECTION-->
        </div>

        <?php
            }
        }
        ?>

        <!--EOF theme1_content_description_box7-CONTENT_IMAGE_WRAPPER_BOX1_WRAPPER_BOX-wrapper1 (wrappercode_199) CLOSE SECTION-->
        <!--EOF BlockBox-38 -->
        <!--EOF theme1-Contactus-BLOCK-wrapper2 (wrappercode_189) OPEN SECTION-->
    </div>
    <!--EOF theme1-Contactus-BLOCK-wrapper2 (wrappercode_189) CLOSE SECTION-->
    <!--EOF theme1-Contactus-BLOCK-wrapper1 (wrappercode_186) OPEN SECTION-->
</section>