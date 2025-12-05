<section class="full_wrapper clients_block padding_tb_primary bg_blocker">

    <div class="full_wrapper wrpr_flex padding_lr_primary">

        <?php
            $media_list = $this->index_model->getMediaListByLimit(52 , 3);

            if($media_list != NULL){
                foreach($media_list as $media_key => $media_row){

                    $video_url = $media_row->thirdtitle;
                    $url_components = parse_url($video_url); 
                    parse_str($url_components['query'], $params);

                    if(!empty($params['v'])){
                    
            ?>

        <div class="block_splitting gl_gallery_videos">

            <div class="logo_thumbnails zoom_hover">

                <div>
                    <iframe width="100%" height="260" allowfullscreen="allowfullscreen"
                        src="https://www.youtube.com/embed/<?php echo $params['v']; ?>">
                    </iframe>
                </div>

            </div>

        </div>

        <?php   
                    }     
                }
            }
            ?>

    </div>

</section>