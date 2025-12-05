<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('index/include/header_meta'); ?>

</head>

<body class="">

    <!--Page-230 start Tuesday 24th of October 2023 06:58:49 PM-->

    <?php $this->load->view('index/include/header'); ?>

    <div class="afterload-featurebox gd_hide afterload-featurebox24" data-featurebox_id="24" data-boxtype="2"
        data-relation_with_id="230"></div>
    <!--START BlockBox-17 -->

    <?php $this->load->view('index/include/video_gallery_banner'); ?>

    <section class="full_wrapper clients_block padding_tb_primary bg_blocker">
        <!--START theme1-theme1_content_image_box12-wrapper1 (wrappercode_152) CLOSE SECTION-->
        <!--START theme1_content_image_box12-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_153) OPEN SECTION-->

        <div class="sub_category_block">

            <!--START theme1-theme1_content_title_box1-wrapper1 (wrappercode_201) CLOSE SECTION-->
            <!--START theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) OPEN SECTION-->

            <div class="category_item gl_category_item" data-cid="0">
                <!--START theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) CLOSE SECTION-->
                <a href="javascript:void(0);" class="">ALL</a>
                <!--EOF theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) OPEN SECTION-->
            </div>

            <?php
                $category_list = $this->index_model->getVideoGalleryCategories();

                if($category_list != NULL){
                    foreach($category_list as $category_row){
                    
                ?>

            <div class="category_item gl_category_item" data-cid="<?php echo $category_row->id; ?>">
                <!--START theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) CLOSE SECTION-->
                <a href="javascript:void(0);" class=""><?php echo $category_row->category; ?></a>
                <!--EOF theme1_content_title_box1-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_202) OPEN SECTION-->
            </div>

            <?php
                    }
                }
                ?>

        </div><br />

        <div class="full_wrapper wrpr_flex padding_lr_primary">

            <?php
            $media_list = $this->index_model->getAllGalleryVideos();

            if($media_list != NULL){
                foreach($media_list as $media_key => $media_row){

                    $video_url = $media_row->video_code;
                    $url_components = parse_url($video_url); 
                    parse_str($url_components['query'], $params);

                    if(!empty($params['v'])){
                    
            ?>

            <div class="block_splitting gl_gallery_videos gl_cat_video_<?php echo $media_row->main_category; ?>">

                <div class="logo_thumbnails zoom_hover">

                    <div>
                        <iframe width="100%" height="230" allowfullscreen="allowfullscreen"
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

    <?php $this->load->view('index/include/footer_turn_your_events'); ?>

    <!--EOF BlockBox-17 -->

    <?php $this->load->view('index/include/footer'); ?>

    <?php $this->load->view('index/include/footer_meta'); ?>

    <script>
    $("body").on("click", ".gl_category_item", function() {
        var cid = $(this).attr("data-cid");

        if (cid == 0) {
            $(".gl_gallery_videos").show();
        } else {
            $(".gl_gallery_videos").hide();
            $(".gl_cat_video_" + cid).show();
        }

    });
    </script>

</body>

</html>