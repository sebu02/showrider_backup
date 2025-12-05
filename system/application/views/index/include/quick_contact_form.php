<div class="common_split_right">
    <div class="footer_form">
        <form class="form_inner" action="javascript:void(0)" id="gl_quick_contact_form">
            <div class="form_header footer_header">Quick Contact</div>
            <div class="form_group form_group2">
                <label class="flaoating_name">Name</label>
                <input class="footer_form_input" type="text" name="name" id="name" placeholder="">
                
            </div>
            <div class="form_group form_group2">
                <label class="flaoating_name">Email</label>
                <input class="footer_form_input" type="email" name="frm_email" id="frm_email" placeholder="">
                
            </div>
            <div class="form_group">
                <label class="flaoating_name">Message</label>
                <textarea class="footer_form_input" placeholder="" name="message" id="message"></textarea>
                
            </div>
            <div class="form_group">
                <input type="hidden" name="form_type" id="form_type" value="quick_contact_form">
                <button class="form_submit">SUBMIT</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">   

    (function($, W, D) {
        var JQUERY4U = {};
        JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    //form validation rules                    
                    $("#gl_quick_contact_form").validate({
                        rules: {
                            frm_email: {
                                required: true,
                                email: true
                            },
                            name: {
                                required: true
                            },                            
                            message: {
                                required: true
                            }                          

                        },
                        messages: {},
                        submitHandler: function(form) {
                            request = $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>gl_coremail/action.php",
                                 cache: false,
                                 data: new FormData(document.getElementById("gl_quick_contact_form")),
                                 contentType: false,
                                 processData: false,
                                success: function(html) {

                                   $('#gl_quick_contact_form')[0].reset();
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