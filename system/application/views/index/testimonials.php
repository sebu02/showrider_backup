<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('index/include/header_meta'); ?>

</head>

<body class="">

    <?php $this->load->view('index/include/header'); ?>

    <div class="afterload-featurebox gd_hide afterload-featurebox24" data-featurebox_id="24" data-boxtype="2"
        data-relation_with_id="184"></div>

    <?php $this->load->view('index/include/testimonials_banner'); ?>

    <section class="full_wrapper testimonials_block bg_graish  hover_head_common">

        <div class="padding_lr_primary padding_tb_primary wrpr_flex">

            <?php
            $media_list = $this->index_model->getMediaList(45);

            if ($media_list != NULL) {
                foreach ($media_list as $media_key => $media_row) {
            ?>

            <div class="wprp_split_common">
                <div class="block_with_avatar">
                    <div class="block_inner_over content-card">

                        <div class="block_contents">

                            <?php echo $media_row->brief_details; ?>

                        </div>
                        <div class="name_user">
                            <?php echo $media_row->content_title; ?><br><?php echo $media_row->second_title; ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php        
                }
            }
            ?>

        </div>
    </section>

    <?php $this->load->view('index/include/footer_turn_your_events'); ?>

    <?php $this->load->view('index/include/footer'); ?>

    <?php $this->load->view('index/include/footer_meta'); ?>

</body>

</html>