<?php
        $media_list = $this->index_model->getMediaList(12);

        if ($media_list != NULL) {
            foreach ($media_list as $media_key => $media_row) {
                $images_arr = json_decode($media_row->images, TRUE);
                $image = $images_arr[0]['image'];
                $image_alt = $images_arr[0]['seo_alt'];
                $image_title = $images_arr[0]['seo_title'];

                $customized_link = json_decode($media_row->custom_link, TRUE);
                $full_url = $this->index_model->getCustomUrl($customized_link);
        ?>

<section class="full_wrapper about_section_wrpr overflow_hidden hover_head_common scroll_class">

    <div class="common_p_2 relative_wrpr full_wrapper">

        <div class="rellax_wrpr overlay rellax_action" data-rellax-speed="-4">
            <div class="rellax_heading relax_txt_clr rellax_position">

                <?php echo $media_row->content_short_description; ?>

            </div>
        </div>

        <div class="about_wprp wrpr_flex">

            <div class="block_split_half">
                <div class="about_wrpr widget full_wrapper">

                    <img alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'
                        src="<?php echo base_url() . 'media_library/' . $image; ?>">

                    <div class="overlay">

                        <a href="<?php echo $full_url; ?>" class="gradient_click gradient1_mirror"
                            target="<?php echo $customized_link['target_type']; ?>"><?php echo $media_row->content_title; ?></a>

                    </div>

                </div>
            </div>

            <div class="block_split_half flex_center">
                <div class="details_with_btn_border">

                    <div class="para_common_times para_font text_center">

                        <?php echo $media_row->brief_details; ?>

                    </div>

                    <div class="heading_Common_style dark_border mb0">

                        <a href="<?php echo $full_url; ?>" class="border_styles"
                            target="<?php echo $customized_link['target_type']; ?>">

                            <span class="">

                                <?php echo $media_row->second_title; ?>

                                <div class="bottom_line"></div>

                            </span>

                        </a>

                    </div>

                </div>
            </div>

        </div>

    </div>

</section>

<?php
            }
        }
        ?>