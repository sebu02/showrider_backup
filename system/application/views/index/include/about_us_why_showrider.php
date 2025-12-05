<?php
$media_list = $this->index_model->getMediaList(30);

if ($media_list != NULL) {
    foreach ($media_list as $media_key => $media_row) {
?>

<section class="full_wrapper about_section_wrpr about_details_section_wrpr overflow_hidden hover_head_common" id="why">
    <div class="common_p_2 relative_wrpr full_wrapper">

        <!--START theme1-theme1_content_description_box3-wrapper2 (wrappercode_130) CLOSE SECTION-->
        <!--START theme1_content_description_box3-FEATURE_BOX_TITLE_BOX1-wrapper1 (wrappercode_127) OPEN SECTION-->
        <div class="rellax_wrpr overlay rellax_action" data-rellax-speed="-4">
            <div class="rellax_heading relax_txt_clr rellax_position">
                <!--START theme1_content_description_box3-FEATURE_BOX_TITLE_BOX1-wrapper1 (wrappercode_127) CLOSE SECTION-->

                <?php echo $media_row->content_title; ?>

                <!--EOF Br (wrappercode_2) OPEN SECTION-->
                <!--EOF Br (wrappercode_2) CLOSE SECTION-->
                <!--EOF theme1_content_description_box3-FEATURE_BOX_TITLE_BOX1-wrapper1 (wrappercode_127) OPEN SECTION-->
            </div>
        </div>
        <!--EOF theme1_content_description_box3-FEATURE_BOX_TITLE_BOX1-wrapper1 (wrappercode_127) CLOSE SECTION-->

        <!--START theme1_content_description_box3-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_131) OPEN SECTION-->
        <div class="why_showrider_block wrpr_flex">
            <!--START theme1_content_description_box3-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_131) CLOSE SECTION-->
            <!--START theme1_content_description_box3-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_128) OPEN SECTION-->
            <div class="details_with_btn_border">
                <!--START theme1_content_description_box3-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_128) CLOSE SECTION-->
                <!--START theme1_content_description_box3-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_132) OPEN SECTION-->
                <div class="heading_Common_style medium_border">
                    <div class="border_styles">
                        <!--START theme1_content_description_box3-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_132) CLOSE SECTION-->
                        <!--START theme1_content_description_box3-CONTENT_TITLE_BOX1-wrapper2 (wrappercode_133) OPEN SECTION-->

                        <span class="btn_gradient">

                            <!--START theme1_content_description_box3-CONTENT_TITLE_BOX1-wrapper2 (wrappercode_133) CLOSE SECTION-->

                            <?php echo $media_row->second_title; ?>

                            <!--EOF theme1_content_description_box3-CONTENT_TITLE_BOX1-wrapper2 (wrappercode_133) OPEN SECTION-->
                        </span>
                        <!--EOF theme1_content_description_box3-CONTENT_TITLE_BOX1-wrapper2 (wrappercode_133) CLOSE SECTION-->

                        <!--START Icon Bottom Line (wrappercode_34) OPEN SECTION-->
                        <div class="bottom_line"></div>
                        <!--START Icon Bottom Line (wrappercode_34) CLOSE SECTION-->
                        <!--EOF Icon Bottom Line (wrappercode_34) OPEN SECTION-->
                        <!--EOF Icon Bottom Line (wrappercode_34) CLOSE SECTION-->
                        <!--EOF theme1_content_description_box3-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_132) OPEN SECTION-->
                    </div>
                </div>
                <!--EOF theme1_content_description_box3-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_132) CLOSE SECTION-->

                <!--START theme1_content_description_box3-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_129) OPEN SECTION-->
                <div class="para_common_times para_font text_center">
                    <!--START theme1_content_description_box3-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_129) CLOSE SECTION-->

                    <?php echo $media_row->brief_details; ?>

                    <!--EOF theme1_content_description_box3-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_129) OPEN SECTION-->
                </div>
                <!--EOF theme1_content_description_box3-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_129) CLOSE SECTION-->
                <!--EOF theme1_content_description_box3-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_128) OPEN SECTION-->
            </div>
            <!--EOF theme1_content_description_box3-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_128) CLOSE SECTION-->
            <!--EOF theme1_content_description_box3-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_131) OPEN SECTION-->
        </div>
        <!--EOF theme1_content_description_box3-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_131) CLOSE SECTION-->
        <!--EOF theme1-theme1_content_description_box3-wrapper2 (wrappercode_130) OPEN SECTION-->
    </div>
</section>

<?php
    }
}
?>