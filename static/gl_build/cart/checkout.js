var base_url = $(".base_url").val();
$("form").attr('autocomplete', 'off');
(function ($, W, D)
{
    var JQUERY4U = {};
    JQUERY4U.UTIL =
            {

                setupFormValidation: function ()

                {
                    var base_url = $(".base_url").val();

//                        form validation rules 
                    var current_form_name = "gl_custom_delivery_address_form";
                    var current_form = $("#" + current_form_name);
                    jQuery.validator.addMethod("lettersonly", function (value, element)
                    {
                        return this.optional(element) || /^[a-z ]+$/i.test(value);
                    }, "Letters only please");
                    $(current_form).validate({
                        focusInvalid: true,
                        focusCleanup: true,
                        rules: {

                            frm_title: {

                                required: true

                            },
                            frm_email: {

                                required: true,
                                email: true

                            },

                            frm_first_name: {

                                required: true,
                                lettersonly: true,
                                minlength: 2,
                                maxlength: 20,

                            },
                            frm_last_name: {

                                required: true,
                                maxlength: 20,

                            },
                            frm_phoneno: {

                                required: true,
								maxlength: 10,
								

                            },

                            frm_pincode: {

                                required: true,
                                digits: true,
                                maxlength: 6,
                                minlength: 3,

                            },

                            frm_locality: {

                                required: true,
                                maxlength: 20,

                            },

                            frm_address: {

                                required: true

                            },

                            frm_city: {

                                required: true,
                                maxlength: 20,

                            },

                            frm_state: {

                                required: true,
                                maxlength: 20,

                            },
                            frm_country: {

                                required: true

                            },

                            frm_landmark: {

                                required: false,
                                maxlength: 20,

                            },

                            frm_alt_phone: {

                                required: false

                            },

                        },

                        messages: {

                        },

                        submitHandler: function (form) {


//                            if (action == "yes") {
                            ajaxindicatorstart("Please wait");
                            /*start*/
                            var pin_text = $('#frm_pincode').val();
                            var gl_current_uri = $('#gl_current_uri').val();
                            if (gl_current_uri == 'delivery-address')
                            {
                                var type = 'forms';
                                var param_pin_array = {"pin_text": pin_text, "gl_current_uri": gl_current_uri, "current_form_name": current_form_name, "type": type};
                                pincode_check(param_pin_array);

                                /*end*/
                            } else
                            {


                                if (gl_current_uri == 'edit_address')
                                {
                                    adminaddressformsubmission(current_form_name);
                                } else
                                {
                                    addressformsubmission(current_form_name);
                                }

                            }


                            /*end*/
//                            }


                        }

                    });

                }

            };

    //when the dom has loaded setup form validation rules

    $(D).ready(function ($) {

        JQUERY4U.UTIL.setupFormValidation();

    });

})(jQuery, window, document);



//nikhil admin add address
function adminaddressformsubmission(current_form_name)
{

    //
    //console.log(current_form_name);
    var base_url = $(".base_url").val();


    request = $.ajax({

        type: "POST",

        url: base_url + "useradmin/admin_save_user_address",

        cache: false,

        data: new FormData(document.getElementById(current_form_name)),

        contentType: false,

        processData: false,

        success: function (html) {

            $('#' + current_form_name)[0].reset();

            ajaxindicatorstop();
//            location.reload();
            window.location = base_url + html;


        }

    });


    //	
}

//EOF nikhil admin add address


function addressformsubmission(current_form_name)
{

    //
    //console.log(current_form_name);
    var base_url = $(".base_url").val();


    request = $.ajax({

        type: "POST",

        url: base_url + "index/save_user_address",

        cache: false,

        data: new FormData(document.getElementById(current_form_name)),

        contentType: false,

        processData: false,

        success: function (html) {
            $('#' + current_form_name)[0].reset();

            ajaxindicatorstop();
//            location.reload();
            window.location = base_url + html;


        }

    });


    //	
}



function pincode_check(param_pin_array)
{

    var pin_text = param_pin_array['pin_text'];
    var gl_current_uri = param_pin_array['gl_current_uri'];
    var current_form_name = param_pin_array['current_form_name'];
    var type = param_pin_array['type'];
    var status_checker = 'NO';

    $.ajax({

        url: base_url + "index/pincode_fetch",
        type: "post",
        async: false,
        data: {pin_text: pin_text},
        dataType: 'json',
        success: function (msg) {
            //alert(msg);
//            console.log(msg);

            if (type == 'forms')
            {

                if (msg.status == 'YES') {


                    status_checker = 'YES';
                    $('.shipping_error_wrap').hide();
                    $('.gl_pincode_error').hide();
                    $('.gl_pincode_error').text("");
                    var current_form_name = param_pin_array['current_form_name'];
                    //console.log(current_form_name);
                    addressformsubmission(current_form_name);

                } else if (msg.status == 'NO')
                {
                    status_checker = 'NO';
                    $('#frm_pincode').focus();
                    $('.gl_pincode_error').css('display', 'block');
                    $('.gl_pincode_error').text("We cannot deliver here!");
                    $('.shipping_error_wrap').fadeIn();
                    ajaxindicatorstop();


                }
            } else if (type == 'addresslist')
            {
                //
                ajaxindicatorstop();
                if (msg.status == 'NO') {

                    $('.location_check').removeClass('hide');
                    $('.gl_submit_delivery').hide();
                    $('.shipping_error_wrap2').fadeIn();




                } else if (msg.status == 'YES') {
                    $('.location_check').addClass('hide');
                    $('.gl_submit_delivery').show();
                    $('.shipping_error_wrap2').hide();
                }

                //	
            } else if (type == 'selectaddress')
            {

                if (msg.status == 'NO') {

                    ajaxindicatorstop();

                    $('.location_check').removeClass('hide');
                    $('.gl_submit_delivery').hide();
                    $('.shipping_error_wrap2').fadeIn();

                } else
                {
                    var data_address_id = param_pin_array['data_address_id'];
                    var data_address_type = param_pin_array['data_address_type'];


                    update_selected_address(data_address_id, data_address_type);

                }


            } else if (type == 'formsedit')
            {

                if (msg.status == 'YES') {


                    $('.shipping_error_wrap').hide();
                    $('.gl_pincode_error').hide();
                    $('.gl_pincode_error').text("");

                    var segment_url = param_pin_array['segment_url'];
                    var current_form_name = param_pin_array['current_form_name'];


                    editaddressform(segment_url, current_form_name);

                } else if (msg.status == 'NO')
                {
                    $('#frm_pincode').focus();
                    $('.gl_pincode_error').css('display', 'block');
                    $('.gl_pincode_error').text("We cannot deliver here!");
                    $('.shipping_error_wrap').fadeIn();
                    ajaxindicatorstop();


                }

            }





        }


    });//EOF ajax

    var status_checker = 'YES';
    return status_checker;

}


function update_selected_address(data_address_id, data_address_type)
{
    var dataString = "frm_address_id=" + data_address_id + "&gl_address_type=" + data_address_type;
    request = $.ajax({
        type: "POST",
        url: base_url + "index/update_session_selected_user_address",
        cache: false,
        data: dataString,
        success: function (html) {
//            console.log(html);
            ajaxindicatorstop();

            window.location = base_url + html;

        }

    });
}


$(document).ready(function () {

    var base_url = $(".base_url").val();

    $(".gl_submit_delivery").click(function () {
        ajaxindicatorstart("Please wait");
        var this_gl_address_item = $(this).closest('.gl_address_item');
        var data_address_id = this_gl_address_item.attr('data-address-id');
        var data_address_type = this_gl_address_item.find('#gl_address_type').val();

        // console.log(data_address_id);

        var gl_current_uri = $('#gl_current_uri').val();
        if (gl_current_uri == 'delivery-address')
        {

            var type = 'selectaddress';
            var gl_current_uri = $('#gl_current_uri').val();
            var addr = this_gl_address_item.attr('data_address');
            var adre = jQuery.parseJSON(addr);
            var pin_text = adre.frm_pincode;

            var current_form_name = '';

            var param_pin_array = {"pin_text": pin_text, "gl_current_uri": gl_current_uri, "current_form_name": current_form_name, "type": type, "data_address_id": data_address_id, "data_address_type": data_address_type};

            pincode_check(param_pin_array);

        } else
        {
            update_selected_address(data_address_id, data_address_type);
        }


    });


    $(".gl_submit_select_payment_methods").click(function () {
        ajaxindicatorstart("Please wait");

        var dataString = "";
        request = $.ajax({
            type: "POST",
            url: base_url + "index/select_payment_methods",
            cache: false,
            data: dataString,
            success: function (html) {

//                console.log(html);
                ajaxindicatorstop();
                var base_url = $(".base_url").val();
                window.location = base_url + html;

            }

        });

    });

    var checkd_address = $(".gl_address_selector:checked");
    address_section_show(checkd_address);
    $(".gl_checkout_step_list").on("change", '.gl_address_selector', function () {
        var checkd_address = $(this);
        address_section_show(checkd_address);
    });


    $(".gl_checkout_step_list").on("click", '.gl_address_edit', function () {
        var checkd_address = $(this);
        address_section_show(checkd_address);
    });

});
function address_section_show(checkd_address) {

    if (typeof checkd_address !== "undefined") {


        var form_html = $('.gl_address_form_container').html();
        var this_gl_address_item = checkd_address.closest('.gl_address_item');
        var this_edit_form_container = this_gl_address_item.find('.gl_edit_form_container');
//            console.log(form_html);

        checkd_address.closest('.gl_address_container').addClass("hide");
        checkd_address.parent().next('.deliver_btn').hide();
        $('.gl_edit_form_container').removeClass('inner_formdeliver');
        this_gl_address_item.find('.gl_edit_form_container').addClass('inner_formdeliver');
//        $('.gl_editaddress_label').addClass('hide');
//        this_gl_address_item.find('.gl_editaddress_label').removeClass('hide');
        this_gl_address_item.find('.gl_edit_form_container').removeClass('hide');
        this_gl_address_item.find('.gl_edit_form_container').html(form_html);
        var data_address = this_gl_address_item.attr('data_address');
        var data_address_id = this_gl_address_item.attr('data-address-id');

        var current_form_name = "gl_custom_delivery_address_form_edit";
        this_edit_form_container.find('.gl_address_form').attr('id', current_form_name);
        if (data_address != undefined) {
            var delivery_address = $.parseJSON(data_address);
            this_edit_form_container.find('#frm_title').val(delivery_address.frm_title);
            this_edit_form_container.find('#frm_email').val(delivery_address.frm_email);
            this_edit_form_container.find('#frm_first_name').val(delivery_address.frm_first_name);
            this_edit_form_container.find('#frm_last_name').val(delivery_address.frm_last_name);
            this_edit_form_container.find('#frm_phoneno').val(delivery_address.frm_phoneno);
            this_edit_form_container.find('#frm_pincode').val(delivery_address.frm_pincode);
            this_edit_form_container.find('#frm_locality').val(delivery_address.frm_locality);
            this_edit_form_container.find('#frm_address').text(delivery_address.frm_address);
            if (this_edit_form_container.find('#frm_city').val() == '') {
                this_edit_form_container.find('#frm_city').val(delivery_address.frm_city);
            }
            if (this_edit_form_container.find('#frm_state').val() == '') {
                this_edit_form_container.find('#frm_state').val(delivery_address.frm_state);
            }

			if ($(".gl_frm_state").length)
        	{
			this_edit_form_container.find('.gl_frm_country').attr("data-state_id",delivery_address.frm_state);
			}
			
			if ($(".gl_frm_city").length)
        	{
			this_edit_form_container.find('.gl_frm_country').attr("data-city_id",delivery_address.frm_city);
			}
			
            this_edit_form_container.find('#frm_country').val(delivery_address.frm_country);
            this_edit_form_container.find('#frm_landmark').val(delivery_address.frm_landmark);
            this_edit_form_container.find('#frm_alt_phone').val(delivery_address.frm_alt_phone);
            this_edit_form_container.find('#frm_address_id').val(data_address_id);
            if (delivery_address.frm_delivery_type == "Home") {
                this_edit_form_container.find('#frm_delivery_type_home').attr("checked", "checked");
            } else {
                this_edit_form_container.find('#frm_delivery_type_work').attr("checked", "checked");
            }
        }

        gl_form_validation(current_form_name);
		
if ($(".gl_frm_state").length)
{		
var current_element = $(".gl_frm_country");
form_country_action(current_element);
}

if ($(".gl_frm_city").length)
{		
var current_element = $(".gl_frm_state");
form_country_action(current_element);
}


//        $("input.inputbox,textarea.inputbox").each(function () {
//            if ($(this).val()) {
//                $(".inputbox").prev("label").addClass('active');
//                $("input.inputbox,textarea.inputbox").css("padding-top", "20px");
//            } else {
//                $(this).prev("label").removeClass('active');
//                $(this).css("padding-top", "0px");
//            }
//        });  
    }
}
$("a.add_new_address").click(function () {
    gl_address_item_reset();
    $(this).parents('.address_lst').find('.my_adrsedit_wrap.active').removeClass('active');
    $(this).parents('.address_lst').find('.radio_wrap').css('display', 'block');
	
if ($(".gl_frm_state").length)
{
    var current_element = $(".gl_frm_country");
    form_country_action(current_element);
}

if ($(".gl_frm_city").length)
{		
var current_element = $(".gl_frm_state");
form_country_action(current_element);
}
	
});
//    change

$("a.addnewaddrs_btn").click(function () {

    gl_address_item_reset();

//    $(this).parents('.address_lst ').find('.my_adrsedit_wrap.active').removeClass('active');
//    $(this).parents('.address_lst').find('.radio_wrap').css('display', 'block');
//    $(this).parents('.address_lst').find('.gl_edit').css('display', 'none');

    $(this).parents('.myacct_contentwrapper').find('.my_adrsedit_wrap').addClass('active');
    $(this).parents('.myacct_contentwrapper').find('.new_address_formouter').css('display', 'block');


    $('.address_lst ').find('.gl_edit_form_container').removeClass('inner_formdeliver');
    $('.address_lst ').find('.my_adrsedit_rmv').removeClass('active');
    $('.address_lst ').find('.my_adrsedit_wrap').removeClass('active');

    $("input.inputbox,textarea.inputbox").prev("label").removeClass('active');
	
if ($(".gl_frm_state").length)
{
    var current_element = $(".gl_frm_country");
    form_country_action(current_element);	
}

if ($(".gl_frm_city").length)
{		
var current_element = $(".gl_frm_state");
form_country_action(current_element);
}

});
//change
$(document).ready(function () {


    localStorage.setItem("lastid", $('.gl_local_selected_id:checked').attr('id'));


});

$(".Checkout_stepslist").on("click", '.gl_delivery_edit_cancel', function () {

    $(this).parents('.address_lst').find('.my_adrsedit_wrap.active').removeClass('active');
    $(this).parents('.address_lst').find('.radio_wrap').css('display', 'block');
    $(this).parent('.gl_address_item').find(".edit_btn").show();
    gl_address_item_reset();

//    change
    $(".new_address_formouter").hide();

    var lastid = localStorage.getItem("lastid");
    $('#' + lastid).prop('checked', true);

//    $('#'+lastid).parent(".radio_wrap").parent("li").parent("ul").find(".edit_btn").hide();
//        $(".new_address_formouter").hide();
//        $(".btn_wrap").hide();
//        $(".addreslst_radio").removeAttr('checked');
//        $('#'+lastid).attr("checked", "checked");

    if ($('#' + lastid).attr("checked", "checked")) {
        $('#' + lastid).next("label").find(".btn_wrap").show();
        $('#' + lastid).parent(".radio_wrap").parent("li").find(".edit_btn").show();
    }

    localStorage.removeItem("lastid");

});

$(".myacct_contentwrapper").on("click", '.gl_delivery_edit_cancel', function () {

    $(this).parents('.address_lst').find('.my_adrsedit_wrap.active').removeClass('active');
    $(this).parents('.address_lst').find('.radio_wrap').css('display', 'block');
    $(this).parent('.gl_address_item').find(".edit_btn").show();
    gl_address_item_reset();

//    change    
//    new_address_formouter
//    my_adrsedit_wrap
//    gl_edit_form_container inner_formdeliver
//    $(this).parents('.row').find('.my_adrsedit_wrap.active').removeClass('active');
//    $(this).parents('.row').find('.my_adrsedit_rmv.active').removeClass('active');

//    $(this).parents('.address_lst').find('.gl_edit_form_container.inner_formdeliver').removeClass('inner_formdeliver');
    $('.gl_edit_form_container').removeClass('inner_formdeliver');
    $('.my_adrsedit_rmv').removeClass('active');
    $('.my_adrsedit_wrap').removeClass('active');





});

function gl_address_item_reset() {

    $('.gl_edit_form_container').addClass('hide');
    $('.gl_edit_form_container').html('');
}


$(".gl_address_item").click(function () {

    $(this).siblings().find('.gl_edit_form_container').addClass('hide');
    $(this).siblings().find('.gl_edit_form_container').html('');

    $('.gl_address_form_container').hide();

//    change
    localStorage.setItem("lastid", $('.gl_local_selected_id:checked').attr('id'));

});



function editaddressform(segment_url, current_form_name)
{
//    console.log(segment_url);
//    console.log(current_form_name);
    var base_url = $(".base_url").val();

    var current_form = $("#" + current_form_name);

    request = $.ajax({
        type: "POST",
        url: base_url + segment_url,
        cache: false,
        data: new FormData(document.getElementById(current_form_name)),
        contentType: false,
        processData: false,
        success: function (html) {

//            console.log(html);

            $(current_form)[0].reset();

            ajaxindicatorstop();
//location.reload();
            window.location = base_url + html;

        }

    });


}


function gl_form_validation(current_form_name) {

    //form validation rules
    //var current_form_name = "gl_custom_delivery_address_form_edit";
    var base_url = $(".base_url").val();
    var current_form = $("#" + current_form_name);
    jQuery.validator.addMethod("lettersonly", function (value, element)
    {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "Letters only please");
    $(current_form).validate({
        rules: {
            frm_title: {
                required: true

            },
            frm_email: {
                required: true,
                email: true

            },
            frm_first_name: {
                required: true,
                lettersonly: true,
                minlength: 2,

            },
            frm_last_name: {
                required: true

            },
            frm_phoneno: {
                required: true,
				maxlength: 10,

            },
            frm_pincode: {
                 required: true,
                 digits: true,
                 maxlength: 6,
                 minlength: 3,

            },
            frm_locality: {
                required: true,
                maxlength: 20,

            },
            frm_address: {
                required: true

            },
            frm_city: {
                required: true,
                maxlength: 20,

            },
            frm_state: {
                required: true,

            },
            frm_country: {
                required: true

            },
            frm_landmark: {
                required: false,
                maxlength: 20,

            },
            frm_alt_phone: {
                required: false

            },
        },

        focusInvalid: true,
        focusCleanup: true,
        messages: {
        },
        submitHandler: function (form) {
            //

            var pin_text = $('#frm_pincode').val();
            var gl_current_uri = $('#gl_current_uri').val();


            if (gl_current_uri == 'edit_address')
            {
                var segment_url = "useradmin/update_admin_user_address";

            } else
            {
                var segment_url = "index/update_user_address";
            }


            if (gl_current_uri == 'delivery-address')
            {
                var type = 'formsedit';



                var param_pin_array = {"pin_text": pin_text, "gl_current_uri": gl_current_uri, "current_form_name": current_form_name, "type": type, "segment_url": segment_url};

                pincode_check(param_pin_array);

                /*end*/
            } else
            {


                editaddressform(segment_url, current_form_name);

            }

            //


        }

    });
}




(function ($, W, D)

{

    var JQUERY4U = {};

    JQUERY4U.UTIL =
            {
                setupFormValidation: function ()

                {

                    //form validation rules
                    var current_form_name = "gl_custom_delivery_address_form_edit";
                    var current_form = $("#" + current_form_name);
                    jQuery.validator.addMethod("lettersonly", function (value, element)
                    {
                        return this.optional(element) || /^[a-z ]+$/i.test(value);
                    }, "Letters only please");
                    $(current_form).validate({
                        rules: {
                            frm_title: {
                                required: true

                            },
                            frm_email: {
                                required: true,
                                email: true

                            },
                            frm_first_name: {

                                required: true,
                                lettersonly: true,
                                minlength: 2,
                                maxlength: 20,

                            },
                            frm_last_name: {
                                required: true,
                                maxlength: 20,

                            },
                            frm_phoneno: {
                                required: true,
								maxlength: 10,

                            },
                            frm_pincode: {

                                required: true,
                                digits: true,
                                maxlength: 6,
                                minlength: 3,

                            },
                            frm_locality: {
                                required: true,
                                maxlength: 20,

                            },
                            frm_address: {
                                required: true

                            },
                            frm_city: {
                                required: true,
                                maxlength: 20,

                            },
                            frm_state: {
                                required: true,
                                maxlength: 20,

                            },
                            frm_country: {
                                required: true

                            },
                            frm_landmark: {
                                required: false,
                                maxlength: 20,

                            },
                            frm_alt_phone: {
                                required: false

                            },
                        },

                        focusInvalid: true,
                        focusCleanup: true,
                        messages: {
                        },
                        submitHandler: function (form) {

                            /*start*/

                            var gl_current_uri = $('#gl_current_uri').val();


                            if (gl_current_uri == 'edit_address')
                            {
                                var segment_url = "useradmin/update_admin_user_address";

                            } else
                            {
                                var segment_url = "index/update_user_address";
                            }


                            var pin_text = $('input[name="frm_pincode"]').val();



                            if (gl_current_uri == 'delivery-address')
                            {
                                var type = 'formsedit';



                                var param_pin_array = {"pin_text": pin_text, "gl_current_uri": gl_current_uri, "current_form_name": current_form_name, "type": type, "segment_url": segment_url};

                                pincode_check(param_pin_array);

                                /*end*/
                            } else
                            {

                                editaddressform(segment_url, current_form_name);

                            }

                            //



                            /*end*/

                        }

                    });

                }

            };

    //when the dom has loaded setup form validation rules

    $(D).ready(function ($) {

        JQUERY4U.UTIL.setupFormValidation();

    });

})(jQuery, window, document);





$(".gl_myaccount_address").on("click", '.gl_address_edit', function () {
//myacct_contentwrapper

    var form_html = $('.gl_address_form_container').html();


    var this_gl_address_item = $(this).closest('.gl_address_item');
    $('.gl_edit_form_container').removeClass('inner_formdeliver');
    this_gl_address_item.find('.gl_edit_form_container').addClass('inner_formdeliver');

    var data_address = this_gl_address_item.attr('data_address');
    var data_address_id = this_gl_address_item.attr('data-address-id');

    var this_edit_form_container = $(".gl_edit_form_" + data_address_id);
    this_edit_form_container.removeClass('hide');
    this_edit_form_container.html(form_html);

    var current_form_name = "gl_custom_delivery_address_form_edit";
    this_edit_form_container.find('.gl_address_form').attr('id', current_form_name);
    var delivery_address = $.parseJSON(data_address);

    this_edit_form_container.find('#frm_title').val(delivery_address.frm_title);
    this_edit_form_container.find('#frm_email').val(delivery_address.frm_email);
    this_edit_form_container.find('#frm_first_name').val(delivery_address.frm_first_name);
    this_edit_form_container.find('#frm_last_name').val(delivery_address.frm_last_name);
    this_edit_form_container.find('#frm_phoneno').val(delivery_address.frm_phoneno);
    this_edit_form_container.find('#frm_pincode').val(delivery_address.frm_pincode);
    this_edit_form_container.find('#frm_locality').val(delivery_address.frm_locality);
    this_edit_form_container.find('#frm_address').text(delivery_address.frm_address);
    this_edit_form_container.find('#frm_city').val(delivery_address.frm_city);
    this_edit_form_container.find('#frm_state').val(delivery_address.frm_state);
	
	if ($(".gl_frm_state").length)
	{
	this_edit_form_container.find('.gl_frm_country').attr("data-state_id",delivery_address.frm_state);
	}
	
	if ($(".gl_frm_city").length)
	{
	this_edit_form_container.find('.gl_frm_country').attr("data-city_id",delivery_address.frm_city);
	}
	
    this_edit_form_container.find('#frm_country').val(delivery_address.frm_country);
    this_edit_form_container.find('#frm_landmark').val(delivery_address.frm_landmark);
    this_edit_form_container.find('#frm_alt_phone').val(delivery_address.frm_alt_phone);
    this_edit_form_container.find('#frm_address_id').val(data_address_id);
    this_edit_form_container.find('.frm_delivery_type_home').attr("id", "frm_delivery_type_home" + data_address_id);
    this_edit_form_container.find('.frm_delivery_type_home_label').attr("for", "frm_delivery_type_home" + data_address_id);
    this_edit_form_container.find('.frm_delivery_type_work').attr("id", "frm_delivery_type_work" + data_address_id);
    this_edit_form_container.find('.frm_delivery_type_work_label').attr("for", "frm_delivery_type_work" + data_address_id);
    if (delivery_address.frm_delivery_type == "Home") {
        this_edit_form_container.find('#frm_delivery_type_home').attr("checked", "checked");
    } else {
        this_edit_form_container.find('#frm_delivery_type_work').attr("checked", "checked");
    }
//    if (delivery_address.frm_delivery_type == "Home") {
//        this_edit_form_container.find('.frm_delivery_type_home').attr("checked", "checked");
//        this_edit_form_container.find('.frm_delivery_type_work').removeAttr("checked");
//    } else {
//        this_edit_form_container.find('.frm_delivery_type_work').attr("checked", "checked");
//        this_edit_form_container.find('.frm_delivery_type_home').removeAttr("checked");
//    }
    floating();// this function in form_input js
    gl_form_validation(current_form_name);


});




$("body").on('change', '.checkbox_1', function () {
//    myacct_contentwrapper
    var value = $(this).attr('value');
    var addresstype = $(this).attr('data_addresstype');
    var base_url = $(".base_url").val();
    var current_uri = $("#gl_uri").val();




    if (this.checked) {

        if (current_uri == 'edit_address')
        {
            var userid = $(".gl_userid").val();
            var url = base_url + 'useradmin/admin_set_user_address_default_type';
            var postdata = {addressid: value, addresstype: addresstype, userid: userid};
        } else
        {
            var url = base_url + 'index/set_user_address_default_type';
            var postdata = {addressid: value, addresstype: addresstype};
        }
        ajaxindicatorstart("Please wait");
    } else {


    }

    $.ajax({
        url: url,
        async: false,
        type: "POST",
        data: postdata,
        cache: false,
        success: function () {
            ajaxindicatorstop();
            location.reload();
        }
    });


});


$(".gl_remove_address_row").click(function ()
{
    var address_rowid = $(this).attr('data-address-id');

    var base_url = $(".base_url").val();
    ajaxindicatorstart("Please wait");


    var current_uri = $("#gl_uri").val();

    if (current_uri == 'edit_address')
    {
        var userid = $(".gl_userid").val();
        var dataString = "frm_address_id=" + address_rowid + '&userid=' + userid;
        var url = "useradmin/admin_delete_user_address";
    } else
    {
        var dataString = "frm_address_id=" + address_rowid;
        var url = "index/delete_user_address";

    }
    $('.address_' + address_rowid).remove();
    request = $.ajax({
        type: "POST",
        url: base_url + url,
        cache: false,
        data: dataString,
        success: function (html) {
            ajaxindicatorstop();

            if (html == 'log-in') {
                var base_url = $(".base_url").val();
                window.location = base_url + html;

            } else {
                // console.log(html);
                $('.address_' + address_rowid).remove();
                if (current_uri == 'edit_address')
                {
                    admin_flash_message_style(html);

                } else
                {
                    flash_message_style2(html);
                }

            }

        }

    });

});


function admin_flash_message_style(msg) {

    $.pnotify({
        type: 'success',
        title: msg,
        text: '',
        icon: 'picon icon16 iconic-icon-check-alt white',
        opacity: 0.95,
        history: false,
        sticker: false
    });


}

$('.input_animation_wrap').on('click', '.addreslst_radio', function (event) {

    var gl_current_uri = $('#gl_current_uri').val();
    if (gl_current_uri == 'delivery-address')
    {
        ajaxindicatorstart("Please wait");
        var addr = $(this).parent(".radio_wrap").parent("li").attr('data_address');
        var adre = jQuery.parseJSON(addr);
        var pin_text = adre.frm_pincode;

        var type = 'addresslist';
        var current_form_name = '';


        var param_pin_array = {"pin_text": pin_text, "gl_current_uri": gl_current_uri, "current_form_name": current_form_name, "type": type};

        pincode_check(param_pin_array);


    } else {
        ajaxindicatorstop();
    }

});


$("body").on("change", ".gl_frm_country", function () {
    var current_element = $(this);

var checkout_state_type = $(".gl_checkout_state_type").val();

$(".gl_frm_country").attr("data-state_id","");	

if(checkout_state_type == 'select')
{	
    form_country_action(current_element);
}


});

$("body").on("change", ".gl_frm_state", function () {
	
	var state =  $(this).val();
    var current_element = $(this);

var checkout_state_type = $(".gl_checkout_state_type").val();

$(".gl_frm_country").attr("data-state_id",state);	
$(".gl_frm_country").attr("data-city_id","");

if(checkout_state_type == 'select')
{	
    form_country_action(current_element);
}


});

function form_country_action(current_element) {
    var field_format = current_element.attr("data-state_format");
	var location_type_id = current_element.attr("data-location_type_id");
	var child_class = current_element.attr("data-child_class");
	
    var current_country = $(".gl_frm_country").find("option:selected").val();
	
	var current_state = $(".gl_frm_country").attr("data-state_id");
	var current_city = $(".gl_frm_country").attr("data-city_id");
	
   // var current_state = $(".gl_frm_state").find("option:selected").val();
	
	//var current_city = $(".gl_frm_city").find("option:selected").val();

		
        var base_url = $(".base_url").val();
        $.ajax({
            type: "POST",
            url: base_url + 'index/state_fetch',
            cache: false,
            data: {country: current_country, state: current_state,city: current_city,location_type_id: location_type_id},
            success: function (response) {
                $("."+child_class).html(response);
            }
        });
    
}