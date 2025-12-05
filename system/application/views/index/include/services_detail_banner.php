<?php
$media_list = $this->index_model->getMediaList(23);

if ($media_list != NULL) {
    foreach ($media_list as $media_key => $media_row) {
        $images_arr = json_decode($media_row->images, TRUE);
        $image = $images_arr[0]['image'];  
        $image_alt = $images_arr[0]['seo_alt'];
        $image_title = $images_arr[0]['seo_title'];
?>

<section class="inner_page_banner_block full_wrapper hover_head_common" style="">

    <div class="inner_banner_img_block">

        <img src="<?php echo base_url() . 'media_library/' . $image; ?>" alt="<?php echo $image_alt; ?>"
            title="<?php echo $image_title; ?>" class="">

        <div class="overlay">
            <div class="heading_Common_style medium_border">
                <div class="border_styles">

                    <span class="btn_gradient">

                        <?php echo $media_row->content_title; ?>

                    </span>

                    <div class="bottom_line"></div>

                </div>
            </div>
        </div>

    </div>

</section>

<?php
    }
}
?>