<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('index/include/header_meta'); ?>

</head>

<body class="">

    <!--START theme1-Inner-Header-BLOCK-wrapper1 (wrappercode_120) OPEN SECTION-->

    <?php $this->load->view('index/include/header'); ?>

    <div class="afterload-featurebox gd_hide afterload-featurebox24" data-featurebox_id="24" data-boxtype="2"
        data-relation_with_id="282"></div>

    <?php $this->load->view('index/include/get_a_quote_form_banner'); ?>

    <?php
    if($category_row != NULL){

        // if($final_amount != ""){   

        ?>

    <section class="full_wrapper relative_wrpr book_a_show_final ">
        <div class="common_inner_wrpr padding_lr_primary padding_tb_primary wrpr_flex ">

            <div class="table_block book_a_show_table">
                <form id="gl_get_a_quote_form" class="gl_validation_label" method="post" action="javascript:void(0)">

                    <div class="tabe_head">GET A QUOTE FORM</div>
                    <div class="tale_row">
                        <div class="table_split_01">
                            <div class="form_group">
                                <label class="flaoating_name">First Name</label>
                                <input class="common_form_input" type="text" name="frm_first_name" id="frm_first_name">

                            </div>
                        </div>
                        <div class="table_split_01">
                            <div class="form_group">
                                <label class="flaoating_name">Last Name</label>
                                <input class="common_form_input" type="text" name="frm_last_name" id="frm_last_name">

                            </div>
                        </div>
                        <div class="table_split_01">
                            <div class="form_group">
                                <label class="flaoating_name">Email</label>
                                <input class="common_form_input" type="email" name="frm_email" id="frm_email">

                            </div>
                        </div>
                        <div class="table_split_01">
                            <div class="form_group">
                                <label class="flaoating_name">Phone Number</label>
                                <input class="common_form_input" type="text" name="frm_phoneno" id="frm_phoneno">

                            </div>
                        </div>

                        <div class="table_split_01">
                            <div class="form_group">
                                <label class="flaoating_name">Address</label>
                                <input class="common_form_input" type="text" name="frm_address" id="frm_address">

                            </div>
                        </div>

                        <div class="table_split_01">
                            <div class="form_group">
                                <label class="flaoating_name">Message</label>
                                <input class="common_form_input" type="text" name="message" id="message">

                            </div>
                        </div>

                        <input type="hidden" name="form_type" id="form_type" value="get_a_quote_form">

                        <input type="hidden" name="category_name" id="category_name"
                            value="<?php echo $category_row->category; ?>">

                        <input type="hidden" name="total_amount" id="total_amount"
                            value="<?php echo trim($final_amount); ?>">

                        <div class="table_split_01 price_table_wrpr">

                            <div class="common_heading04">
                                Service : <span> <?php echo $category_row->category; ?> </span>
                            </div>
                        </div>

                        <div class="table_split_01 price_table_wrpr">

                            <?php
                            if($final_amount > 0){                        
                            ?>
                                <div class="common_heading04">
                                    Total Amount : <span>Rs. <?php echo $final_amount; ?> </span>
                                </div>

                            <?php
                            }
                            ?>
                            
                        </div>

                    </div>
                    
                    <div class="common_btn_3">

                        <input type="submit" class="btn_gradient" value="Continue"
                            style="padding-top:5px;padding-bottom:5px;border:none; color:#fff;padding-right:10px;padding-left:10px;">
                    </div>
                </form>
            </div>

        </div>
    </section>

    <?php

        // }
        
    }
    ?>

    <?php $this->load->view('index/include/footer_turn_your_events'); ?>

    <?php $this->load->view('index/include/footer'); ?>

    <?php $this->load->view('index/include/footer_meta'); ?>

    <script type="text/javascript" src="<?php echo base_url().'static/'; ?>gl_build/common/js/jquery.validate.min.js">
    </script>
    <script type="text/javascript" src="<?php echo base_url().'static/'; ?>gl_build/common/js/ajaxLoader_frontend.js">
    </script>

    <script type="text/javascript">
    (function($, W, D) {
        var JQUERY4U = {};
        JQUERY4U.UTIL = {
            setupFormValidation: function() {
                //form validation rules                    
                $("#gl_get_a_quote_form").validate({
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
                        frm_address: {
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
                            data: new FormData(document.getElementById(
                                "gl_get_a_quote_form")),
                            contentType: false,
                            processData: false,
                            success: function(html) {

                                $('#gl_get_a_quote_form')[0].reset();

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

</body>

</html>