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

    <?php $this->load->view('index/include/book_a_show_address_banner'); ?>

    <?php
    if($event_row != NULL){

        if($final_amount != NULL){    
        ?>

    <section class="full_wrapper relative_wrpr book_a_show_final ">
        <div class="common_inner_wrpr padding_lr_primary padding_tb_primary wrpr_flex ">

            <div class="table_block book_a_show_table">
                <form id="gl_book_a_show_address_form" class="gl_validation_label" method="post"
                    action="javascript:void(0)">

                    <!-- <input type="hidden" name="frm_title" id="frm_title" value=""> -->

                    <div class="tabe_head">BOOK A SHOW - USER INFORMATION</div>
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
                                <label class="flaoating_name">Email Address</label>
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

                                <select class="common_form_input" name="frm_country"
                                    style="width:100%; padding:5px;font-size:12px;">
                                    <option value="India">India</option>
                                </select>

                            </div>
                        </div>
                        <div class="table_split_01">
                            <div class="form_group">

                                <select class="common_form_input" name="frm_state"
                                    style="width:100%; padding:5px;font-size:12px;">

                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala" selected>Kerala</option>
                                    <option value="Pondicherry">Pondicherry</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>

                                </select>

                            </div>
                        </div>
                        <div class="table_split_01">
                            <div class="form_group">
                                <label class="flaoating_name">Post Code</label>
                                <input class="common_form_input" type="text" name="frm_pincode" id="frm_pincode">

                            </div>
                        </div>
                        <div class="table_split_01">
                            <div class="form_group">
                                <label class="flaoating_name">House Name / No</label>
                                <input class="common_form_input" type="text" name="frm_locality" id="frm_locality">

                            </div>
                        </div>
                        <div class="table_split_01">
                            <div class="form_group">
                                <label class="flaoating_name">Address( Area / Street)</label>
                                <input class="common_form_input" type="text" name="frm_address" id="frm_address">

                            </div>
                        </div>
                        <div class="table_split_01">
                            <div class="form_group">
                                <label class="flaoating_name">City/District/Town</label>
                                <input class="common_form_input" type="text" name="frm_city" id="frm_city">

                            </div>
                        </div>

                        <div class="table_split_01">
                            <div class="form_group">
                                <label class="flaoating_name">Landmark (Optional)</label>
                                <input class="common_form_input" type="text" name="frm_landmark" id="frm_landmark">

                            </div>
                        </div>

                        <div class="table_split_01">
                            <div class="form_group">
                                <label class="flaoating_name">Alternate Phone (Optional)</label>
                                <input class="common_form_input" type="text" name="frm_alt_phone" id="frm_alt_phone">

                            </div>
                        </div>

                        <input type="hidden" name="form_type" id="form_type" value="book_a_show_address_form">
                        <input type="hidden" name="event_name" id="event_name" value="<?php echo $event_row->name; ?>">
                        <input type="hidden" name="total_amount" id="total_amount"
                            value="<?php echo trim($final_amount); ?>">
                        <input type="hidden" name="event_code" id="event_code" value="<?php echo $event_row->code; ?>">
                        <input type="hidden" name="eventticketcode_str" id="eventticketcode_str"
                            value="<?php echo $eventticketcode_str; ?>">
                        <input type="hidden" name="ticketnumber_str" id="ticketnumber_str"
                            value="<?php echo $ticketnumber_str; ?>">
                        <input type="hidden" name="ticketprice_str" id="ticketprice_str"
                            value="<?php echo $ticketprice_str; ?>">

                        <div class="table_split_01 price_table_wrpr">

                            <div class="common_heading04">
                                Event : <span> <?php echo $event_row->name; ?> </span>
                            </div>
                        </div>

                        <div class="table_split_01 price_table_wrpr">

                            <div class="common_heading04">
                                Total Amount : <span>Rs. <?php echo $final_amount; ?> </span>
                            </div>
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
        }
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
                $("#gl_book_a_show_address_form").validate({
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
                        frm_pincode: {
                            required: true
                        },
                        frm_locality: {
                            required: true
                        },
                        frm_address: {
                            required: true
                        },
                        frm_city: {
                            required: true
                        },
                        frm_country: {
                            required: true
                        },
                        frm_state: {
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
                                "gl_book_a_show_address_form")),
                            contentType: false,
                            processData: false,
                            success: function(html) {

                                $('#gl_book_a_show_address_form')[0].reset();

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