<section class="full_wrapper relative_wrpr bg_img_cover_wrpr our_service_landing_block hover_head_common bg_blocker">
    <div class="common_inner_wrpr padding_lr_primary padding_tb_primary">

        <div class="full_wrapper common_split_type4_wrpr our_service_landing_inner_wrpr">

            <?php
            $media_list = $this->index_model->getAllCategoryList();

            if ($media_list != NULL) {
                foreach ($media_list as $media_key => $media_row) {

                    // $prod_image_details = $this->index_model->getProductThumbnailImage($media_row->id);

                    $images_arr = json_decode($media_row->category_picture, TRUE);
                    $image = $images_arr[0]['image'];
                    $image_alt = $images_arr[0]['seo_alt'];
                    $image_title = $images_arr[0]['seo_title'];
            ?>

            <div class="common_link_img_box_wrpr common_split_block">

                <div class="common_link_img_box_wrpr_content_wrpr common_hover_style"> <span class="hover_span"></span>

                    <span class="common_link_img_box_wrpr_content_cover zoom_hover">

                        <img src='<?php echo base_url() . 'media_library/' . $image; ?>' alt='<?php echo $image_alt; ?>'
                            title='<?php echo $image_title; ?>'>

                    </span>

                    <div class="common_link_img_box_wrpr_overlay"> <span class="common_link_img_box_wrpr_overlay_txt gl_services_title">

                            <?php echo $media_row->category; ?>

                        </span> </div>

                </div>

                <div class="common_link_img_box_wrpr_link_wrpr">

                    <a href="<?php echo base_url(). $media_row->full_slug; ?>" class="common_link_img_box_wrpr_link"
                        target="_self">

                        <i class="gd_icon_right_f"></i>

                        <span class="">

                            <?php // echo $media_row->second_title; ?>

                            Discover More

                        </span>

                    </a>

                </div>

            </div>

            <?php
                }
            } 
            ?>

        </div>

    </div>
</section>