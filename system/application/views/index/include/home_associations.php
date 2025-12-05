<section class="full_wrapper scroll_class bg_img_cover_wrpr animate_slider_block_wrpr hover_head_common artist_wrpr"
    data-scroll-from="4">
    <div class="common_inner_wrpr padding_lr_primary padding_tb_primary">
                                
        <?php
        $media_list = $this->index_model->getMediaList(15);

        if ($media_list != NULL) {
            foreach ($media_list as $media_key => $media_row) {

                $images_arr = json_decode($media_row->images, TRUE);
                $image = $images_arr[0]['image']; 
                $image_alt = $images_arr[0]['seo_alt'];
                $image_title = $images_arr[0]['seo_title'];
        ?>

        <div class="full_wrapper">
                       
            <div class="bg_img_wrpr rellax_wrpr rellax_action" data-rellax-speed="-4">
               
                <img src='<?php echo base_url() . 'media_library/' . $image; ?>' alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'>
               
            </div>
                      
            <div class="heading_Common_style light_border">
                <div class="border_styles">
                                                                            
                    <span
                        class="btn_gradient">
                                                                      
                        <?php echo $media_row->content_title; ?>
                       
                    </span>
                   
                    <div class="bottom_line"></div>
                                       
                </div>
            </div>
                                   
        </div>

        <?php
            }
        }
        ?>
                                   
        <div class="full_wrapper">
            <div class="full_wrapper animate_slider_wrpr">
                               
                <div id="dg-container" class="dg-container">
                    <div class="dg-wrapper">
                                             
                        <?php
                        $media_list = $this->index_model->getMediaList(16);

                        if ($media_list != NULL) {
                            foreach ($media_list as $media_key => $media_row) {
                                $images_arr = json_decode($media_row->images, TRUE);
                                $image = $images_arr[0]['image'];
                                $image_alt = $images_arr[0]['seo_alt'];
                                $image_title = $images_arr[0]['seo_title'];
                        ?>

                        <div class="dg_item">
                           
                            <a href="#" class="" target="_self"></a>

                            <img src='<?php echo base_url() . 'media_library/' . $image; ?>' alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'>
                           
                            <div class="">
                                                              
                                <?php echo $media_row->content_title; ?>
                                                               
                            </div>
                                                      
                        </div>

                        <?php
                            }
                        }
                        ?>
                                       
                    </div>
                    <nav> <span class="dg-prev"> <i class="gd_icon_arrow2_left_t"></i> </span> <span class="dg-next"> <i
                                class="gd_icon_arrow2_right_t"></i> </span> </nav>
                </div>
                               
            </div>
        </div>
                
    </div>
</section>