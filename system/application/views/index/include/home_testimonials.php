<section class="slider-bg">
    <div class="common_inner_wrpr padding_lr_primary padding_tb_primary bg-black">

        <?php
        $media_list = $this->index_model->getMediaList(53);

        if ($media_list != NULL) {
            foreach ($media_list as $media_key => $media_row) {
        ?>

            <div class="slider-top-content">
                <div class="slider-title"><?php echo $media_row->content_title; ?></div>
                <div class="slider-subtitle"><?php echo $media_row->second_title; ?></div>
                <div class="slider-content"><?php echo $media_row->content_short_description; ?></div>
            </div>

            <?php
            }
        }
        ?>

        <div class="wrapper">
            <div class="carousel">

                <?php
                $media_list = $this->index_model->getMediaListByLimit(45 , 20);
                
                if ($media_list != NULL) {
                    foreach ($media_list as $media_key => $media_row) {
                ?>

                    <div class="slider-card">
                        <div class="quotes">
                            <svg height="40" viewBox="0 0 1792 1792" width="40" fill="#fff"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M832 320v704q0 104-40.5 198.5t-109.5 163.5-163.5 109.5-198.5 40.5h-64q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h64q106 0 181-75t75-181v-32q0-40-28-68t-68-28h-224q-80 0-136-56t-56-136v-384q0-80 56-136t136-56h384q80 0 136 56t56 136zm896 0v704q0 104-40.5 198.5t-109.5 163.5-163.5 109.5-198.5 40.5h-64q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h64q106 0 181-75t75-181v-32q0-40-28-68t-68-28h-224q-80 0-136-56t-56-136v-384q0-80 56-136t136-56h384q80 0 136 56t56 136z" />
                            </svg>
                        </div>
                        <div class="name_truncate">
                            <div class="card-content ">


                                <?php echo $media_row->brief_details; ?>

                            </div>
                        </div>
                        <div class="personal-data">
                            <div class="name">
                                <?php echo $media_row->content_title; ?><br><?php echo $media_row->second_title; ?></div>
                        </div>

                    </div>

                    <?php
                    }
                }
                ?>

            </div>
        </div>

        <div class="view-btn"><a href="<?php echo base_url(); ?>testimonials" title="View All">View All</a></div>

    </div>
</section>
<!------------------Slider--------------->