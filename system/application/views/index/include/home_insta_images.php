<section class="full_wrapper scroll_class instagram_wrpr relative_wrpr " data-scroll-from="7">
       
    <div class="rellax_wrpr overlay rellax_action" data-rellax-speed="-6">
        <div class="rellax_heading relax_txt_clr rellax_position rellax_position1 relax_txt_clr1 rellax_heading1"
            data-scroll-from="1">
           
            Instagram
           
        </div>
    </div>
       
    <div class="common_inner_wrpr padding_lr_primary padding_tb_primary">
        <div class="full_wrapper common_split_type6_wrpr instagram_inner_wrpr">
                       
            <?php
            $media_list = $this->index_model->getMediaList(17);

            if ($media_list != NULL) {
                foreach ($media_list as $media_key => $media_row) {
                    $images_arr = json_decode($media_row->images, TRUE);
                    $image = $images_arr[0]['image'];  
                    $image_alt = $images_arr[0]['seo_alt'];
                    $image_title = $images_arr[0]['seo_title'];

                    $customized_link = json_decode($media_row->custom_link, TRUE);
                    $full_url = $this->index_model->getCustomUrl($customized_link); 
            ?>

                    <div class="common_split_block zoom_hover gl_position_relative gl_insta_links" data-link="<?php echo $full_url; ?>" style="cursor:pointer;">
                       
                        <a href="<?php echo $full_url; ?>" class="" target="<?php echo $customized_link['target_type']; ?>"></a>

                        <img src='<?php echo base_url() . 'media_library/' . $image; ?>' alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'>
                       
                    </div>

            <?php
                }
            }
            ?>
                               
        </div>
    </div>
        
</section>

<script>
    $("body").on("click" , ".gl_insta_links" , function(){
        var cur_link = $(this).attr("data-link");    
        window.open(cur_link);
    });
</script>