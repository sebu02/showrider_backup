<section class="full_wrapper contact_form_full_wrpr">

    <div class="common_inner_wrpr padding_lr_primary contact_form_inner_wrpr">

        <?php
        $media_list = $this->index_model->getMediaList(43);

        if ($media_list != NULL) {
            foreach ($media_list as $media_key => $media_row) {
        ?>

            <div class="common_sub_title_type1 contact_form_sub_title">
                <span class="icon gd_icon_right_f"></span>

                <?php echo $media_row->content_title; ?>

            </div>

            <?php    
            }
        }
        ?>

        <form action="javascript:void(0)" class="contact_form_type2 " id="gl_main_contact_form">
            <div class="form_group form_group_split2">
                <label class="flaoating_name">First Name</label>
                <input class="footer_form_input" type="text" name="frm_first_name">
                
            </div>
            <div class="form_group form_group_split2">
                <label class="flaoating_name">Last Name</label>
                <input class="footer_form_input" type="text" name="frm_last_name">
                
            </div>
            <div class="form_group form_group_split2">
                <div class="form_group">
                    <label class="flaoating_name">Email</label>
                    <input class="footer_form_input" type="text" name="frm_email">
                    
                </div>
                <div class="form_group">
                    <label class="flaoating_name">Phone</label>
                    <input class="footer_form_input" type="text" name="frm_phoneno">
                    
                </div>
            </div>
            <div class="form_group form_group_split2">
                <label class="flaoating_name">Comment</label>
                <textarea class="footer_form_input" name="comment" ></textarea>
                
            </div>
            <div class="form_group">

                <input type="hidden" name="form_type" id="form_type" value="main_contact_form">
                
                <button class="form_submit form_submit2">Submit</button>
            </div>
        </form>
    </div>
</section>

<script type="text/javascript">   

    (function($, W, D) {
        var JQUERY4U = {};
        JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    //form validation rules                    
                    $("#gl_main_contact_form").validate({
                        rules: {
                            frm_email: {
                                required: true,
                                email: true
                            },
                            frm_first_name: {
                                required: true
                            },
                            frm_last_name: {
                                required: true
                            },                          
                            frm_phoneno: {
                                required: true
                            },
                            comment: {
                                required: true
                            }
                        },
                        messages: {},
                        submitHandler: function(form) {
                            request = $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>gl_coremail/action.php",
                                 cache: false,
                                 data: new FormData(document.getElementById("gl_main_contact_form")),
                                 contentType: false,
                                 processData: false,
                                success: function(html) {

                                    $('#gl_main_contact_form')[0].reset();
                                    flash_message_style(html);

                                }
                            });
                          
                        }
                    });
                }
            }
            //when the dom has loaded setup form validation rules
        $(D).ready(function($) {
            JQUERY4U.UTIL.setupFormValidation();
        });
    })(jQuery, window, document);

</script>