<?php
$media_list = $this->index_model->getMediaList(14);
if ($media_list != NULL) {
    foreach ($media_list as $media_key => $media_row) {

        $customized_link = json_decode($media_row->custom_link, TRUE);
        $full_url = $this->index_model->getCustomUrl($customized_link);
?>

<section class="full_wrapper relative_wrpr why_showrider_block hover_head_common" data-scroll-from="4">

    <div class="rellax_wrpr overlay rellax_action" data-rellax-speed="-4">
        <div class="rellax_heading relax_txt_clr rellax_position rellax_position3 relax_txt_clr3 rellax_heading3">

            <?php echo $media_row->content_short_description; ?>

        </div>
    </div>

    <div class="common_inner_wrpr padding_lr_primary padding_tb_primary">

        <div class="heading_Common_style medium_border">
            <div class="border_styles">

                <span class="btn_gradient">

                    <?php echo $media_row->content_title; ?>

                </span>

                <div class="bottom_line"></div>

            </div>
        </div>

        <div class="full_wrapper content_para_type side_padding_type text_align_center">

            <?php echo $media_row->brief_details; ?>

        </div>

        <div class="heading_Common_style dark_border mb0">

            <a href="<?php echo $full_url; ?>" class="border_styles"
                target="<?php echo $customized_link['target_type']; ?>">

                <span class="">

                    <?php echo $media_row->second_title; ?>

                </span>

                <div class="bottom_line"></div>

            </a>

        </div>

    </div>

</section>

<?php
    }
}
?>