<?php
/* $media_list = $this->index_model->getMediaList(18);
if ($media_list != NULL) {
    foreach ($media_list as $media_key => $media_row) {

        $images_arr = json_decode($media_row->images, TRUE);
        $image = $images_arr[0]['image'];   
        $image_alt = $images_arr[0]['seo_alt'];
        $image_title = $images_arr[0]['seo_title'];

        $customized_link = json_decode($media_row->custom_link, TRUE);
        $full_url = $this->index_model->getCustomUrl($customized_link); 
?>

<section class="full_wrapper  relative_wrpr bg_img_cover_wrpr subscribe_wrpr hover_head_common" data-scroll-from="6">
       
    <div class="bg_img_wrpr rellax_wrpr rellax_action" data-rellax-speed="-2">
       
        <img src='<?php echo base_url() . 'media_library/' . $image; ?>' alt='<?php echo $image_alt; ?>' title='<?php echo $image_title; ?>'>
       
    </div>
      
    <div class="common_inner_wrpr padding_lr_primary padding_tb_primary">
        <div class="common_title_link_btn_wrpr subscribe_inner_wrpr">
                       
            <div class="common_title_link_btn_head">
                                               
                <?php echo $media_row->content_title; ?>
               
            </div>
                       
            <div class="heading_Common_style light_border">               
                
                <a href="<?php echo $full_url; ?>" class="border_styles" target="<?php echo $customized_link['target_type']; ?>">
                                       
                    <span class="">
                                                                      
                        <?php echo $media_row->second_title; ?>
                       
                        <div class="bottom_line"></div>
                                                                                              
                    </span>
                   
                </a>
               
            </div>
                      
        </div>
    </div>
       
</section>

<?php
    }
}/**/
?>