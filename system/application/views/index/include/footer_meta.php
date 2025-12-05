<?php
$media_list = $this->index_model->getMediaList(51);

if ($media_list != NULL) {
    foreach ($media_list as $media_key => $media_row) {
?>

    <a href="https://wa.me/<?php echo $media_row->content_title; ?>" target="_blank" class="wsp-icon">
        <img class="width-100" src="<?php echo base_url(); ?>static/frontend/images/whts-app.png">
    </a>

<?php
    }
}
?>

<div class="flash_message" style="display: none"></div>    

<input type="hidden" class="base_url" id="base_url" value=""   >
<input type="hidden" class="cache_date_modified" id="cache_date_modified" value="1698142361">
<input type="hidden" class="uri_segment_1" value=""  id="uri_segment_1" >
    <input type="hidden" class="base_url1" name="base_url1" value="d/"  id="base_url1" >
    <input type="hidden" class="page_data_value" name="page_data_value" value=""  id="page_data_value" >
    <input type="hidden" class="url_data_value" name="url_data_value" value=""  id="url_data_value" >
    <input type="hidden" class="" name="" value=""  id="" >


<script>
    $(document).ready(function () {
        var width = $(window).width();
     //    savevisitors('3', 'index', width);

    });
</script>

<script src='<?php echo base_url(); ?>static/frontend/js/bootstrap.bundle.min.js?1698142361'></script>
<script src='<?php echo base_url(); ?>static/frontend/js/owl.carousel.min.js?1698142361'></script>
<script src='<?php echo base_url(); ?>static/frontend/js/jquery.mCustomScrollbar.js?1698142361'></script>
<script src='<?php echo base_url(); ?>static/frontend/js/rellax.min.js?1698142361'></script>
<script src='<?php echo base_url(); ?>static/frontend/js/modernizr.custom.js?1698142361'></script>
<script src='<?php echo base_url(); ?>static/frontend/js/jquery.gallery.js?1698142361'></script>
<script src='<?php echo base_url(); ?>static/frontend/js/venobox.min.js?1698142361'></script>
<script src='<?php echo base_url(); ?>static/frontend/js/jquery.pogo-slider.js?1698142361'></script>
<script src='<?php echo base_url(); ?>static/frontend/js/anime.min.js?1698142361'></script>
<script src='<?php echo base_url(); ?>static/frontend/js/parally.min.js?1698142361'></script>
<script src='<?php echo base_url(); ?>static/frontend/js/slick.min.js'></script>

<?php /* ?><script src='<?php echo base_url(); ?>static/frontend/js/lucid.js?1698142361'></script><?php /**/ ?>

<script src='<?php echo base_url(); ?>static/frontend/js/script.js?1698142361'></script>
<script src='<?php echo base_url(); ?>static/gl_build/common/js/gl_front_end_library.js?1698142361'></script>
<script src='<?php echo base_url(); ?>static/gl_build/common/js/showrider_custom.js?1698142361'></script>
<script type="text/javascript" src="<?php echo base_url().'static/'; ?>gl_build/common/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'static/'; ?>gl_build/common/js/ajaxLoader_frontend.js"></script>

<script type="text/javascript">
    function flash_message_style(msg) {

        //To Stop the previous animations

        $(".flash_message").stop();

        $(".flash_message").show();

        $(".flash_message").html(msg);

        $(".flash_message").fadeIn(400).delay(6000).fadeOut(400);

    }
</script>

<script>
$(document).ready(function() {
    $('.carousel').slick({
        slidesToShow: 4,
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});
</script>