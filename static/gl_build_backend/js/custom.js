$(document).ready(function ()
{
    var baseurl = $('.base_url').val();

    /*
     * form name spl chars avoid function 
     */

    $(".gl_form_name").keyup(function ()
    {
        var string = $(".gl_form_name").val();
        var string = string.replace(/[^a-zA-Z0-9]/g, '-');
        var string = string.replace(/\-+/g, '-');
        var string = string.toLowerCase();
        $(".gl_form_name").val(string);
    });
	
	$('body').on('keyup', '.gl_form_name2', function () {

		var string = $(this).val();
        var string = string.replace(/[^a-zA-Z0-9]/g, '-');
        var string = string.replace(/\-+/g, '');
        var string = string.toLowerCase();
        $(this).val(string);
		
    });

    /*
     * EOF form name spl chars avoid function 
     */


    /*
     * get common input view from commin input
     */

    $('.gl_load_input').on('click', function (e) {
        e.preventDefault();
        var countx = $("#input_count").val();
        var field_common_input = $("#field_common_input").val();

        if (countx > 0 && field_common_input > 0 && countx < 6) {

            ajaxindicatorstart('please wait..');

            var url = baseurl + 'dynamicformadmin/loadCommonInputForm';
            var inp_length = $('.parent_field').find('.child_field').length;
            var cmmn_arr = [];
            $('.parent_field .child_field').each(function () {
                cmmn_arr.push(parseInt($(this).data("id")));
            });

            if (inp_length > 0) {

                inp_length = Math.max.apply(Math, cmmn_arr);
                inp_length = parseInt(inp_length) + 1;
            }
            $.ajax({
                url: url,
                async: false,
                type: "POST",
                data: {common_input_id: field_common_input, inp_length: inp_length, count: countx},
                cache: false,
                success: function (data) {
                    $('.parent_field').append(data);
                    ajaxindicatorstop();
                }
            });


        } else {

            $("#countinfo").html("<div class='alert alert-danger text-center'>Please follow steps chronologically.</div>");
            $("#field_format_type").focus();
        }

    });




    /*
     * EOF get common input view from commin input
     */




    /*
     *  remove common input row
     */
    $('.parent_field').on('click', '.row-remove', function () {
        $(this).closest("tr").remove();
    });
    /*
     * EOF remove common input row
     */


    /*
     *  disabled fileds enabled for common attr
     */

    $('.parent_field').on('change', '.comm_attr', function () {
        var att_val = $(this).attr('data_val');
        var att_type = $(this).attr('data-attr');

        if ($(this).is(":checked")) {
            $("#fci_t_attrib_" + att_type + att_val).prop("disabled", false);
        } else {
            $("#fci_t_attrib_" + att_type + att_val).prop("disabled", true);
        }

    });

    $('.parent_field').on('change', '.comm_attr_valid', function () {
        var att_val = $(this).attr('data_val');
        var att_type = $(this).attr('data-attr');

        if ($(this).is(":checked")) {
            $("#fci_t_validat_" + att_type + att_val).prop("disabled", false);
        } else {
            $("#fci_t_validat_" + att_type + att_val).prop("disabled", true);
        }

    });

    /*
     * EOF disabled fileds enabled for common attr
     */

    /*
     *  sortable jquery
     */

    var fixHelperModified = function (e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function (index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
    };
    $(".table-sortable tbody").sortable({
        helper: fixHelperModified

    }).disableSelection();
    $(".table-sortable thead").disableSelection();

    /*
     *  EOF sortable jquery
     */


    $('.only_amount_numeric').on('input', function () {
        this.value = this.value.replace(/[^\d.]/g, '');
    });
    $('.only_amount_numeric').on('keypress', function () {
        return isNumber(event, this)
    });


});



/*
 *  static control types fetching from common input
 */

function getControlType(val) {
    var baseurl = $('.base_url').val();
    $('.load_attr').show();
    $.ajax({
        type: "POST",
        async: false,
        url: baseurl + 'dynamicformadmin/sel_inputs_based_type',
        data: 'control_type=' + val,
        cache: false,
        beforeSend: function () {
            $("#field_common_input option").remove();
        },
        success: function (data) {
            /*get response as json */
            $('.load_attr').hide();
            if (data != "no_values") {
                var obj = jQuery.parseJSON(data);
                $(obj).each(function ()
                {
                    var option = $('<option />');
                    option.attr('value', this.value).text(this.label);
                    $('#field_common_input').append(option);
                });
                /*ends */
            } else if (data == "no_values") {
                attr_no_value(val);
            }
        }

    });
}


function attr_no_value(val) {
    $.pnotify({
        type: 'danger',
        title: 'Common input empty for  ' + val,
        text: '',
        icon: 'picon icon16 iconic-icon-check-alt white',
        opacity: 0.95,
        history: false,
        sticker: false
    });
}

/*
 *   EOF static control types fetching from common input 
 */






/*
 *   create common  json
 */
function savefrmOrder() {
    alreadyExistAttr();


    var new_order = [];
    $('.table-sortable tbody tr').each(function () {

        field_id = $(this).find("input[name^='fci_id']").val();
        field_name = $(this).find("input[name^='fci_name']").val();
        field_format_type = $(this).find("input[name^='fci_field_format_type']").val();
        field_label = $(this).find("input[name^='fci_field_label']").val();



        att_class_status = $(this).find("input[id^='fci_attrib_class']").is(":checked");
        att_class_value = $(this).find("input[id^='fci_t_attrib_class']").val();

        att_name_status = $(this).find("input[id^='fci_attrib_name']").is(":checked");
        att_name_value = $(this).find("input[id^='fci_t_attrib_name']").val();

        att_label_status = $(this).find("input[id^='fci_attrib_label']").is(":checked");
        att_label_value = $(this).find("input[id^='fci_t_attrib_label']").val();

        att_id_status = $(this).find("input[id^='fci_attrib_id']").is(":checked");
        att_id_value = $(this).find("input[id^='fci_t_attrib_id']").val();

        att_rows_status = $(this).find("input[id^='fci_attrib_rows']").is(":checked");
        att_rows_value = $(this).find("input[id^='fci_t_attrib_rows']").val();

        att_placeholder_status = $(this).find("input[id^='fci_attrib_placeholder']").is(":checked");
        att_placeholder_value = $(this).find("input[id^='fci_t_attrib_placeholder']").val();

        att_size_status = $(this).find("input[id^='fci_attrib_size']").is(":checked");
        att_size_value = $(this).find("input[id^='fci_t_attrib_size']").val();

        att_cols_status = $(this).find("input[id^='fci_attrib_cols']").is(":checked");
        att_cols_value = $(this).find("input[id^='fci_t_attrib_cols']").val();


        validat_required_status = $(this).find("input[id^='fci_validat_required']").is(":checked");

        validat_min_status = $(this).find("input[id^='fci_validat_min']").is(":checked");
        validat_min_value = $(this).find("input[id^='fci_t_validat_min']").val();

        validat_max_status = $(this).find("input[id^='fci_validat_max']").is(":checked");
        validat_max_value = $(this).find("input[id^='fci_t_validat_max']").val();

        validat_step_status = $(this).find("input[id^='fci_validat_step']").is(":checked");
        validat_step_value = $(this).find("input[id^='fci_t_validat_step']").val();

        validat_disabled_status = $(this).find("input[id^='fci_validat_disabled']").is(":checked");

        validat_readonly_status = $(this).find("input[id^='fci_validat_readonly']").is(":checked");

        validat_maxlength_status = $(this).find("input[id^='fci_validat_maxlength']").is(":checked");
        validat_maxlength_value = $(this).find("input[id^='fci_t_validat_maxlength']").val();

        validat_accept_status = $(this).find("input[id^='fci_validat_accept']").is(":checked");
        validat_accept_value = $(this).find("input[id^='fci_t_validat_accept']").val();


        new_order.push(
                {
                    field_id: field_id,
                    field_name: field_name,
                    field_format_type: field_format_type,
                    field_label: field_label,
                    attributes: {
                        class: {
                            status: att_class_status,
                            value: att_class_value,
                        },
                        name: {
                            status: att_name_status,
                            value: att_name_value,
                        },
                        label: {
                            status: att_label_status,
                            value: att_label_value,
                        },
                        id: {
                            status: att_id_status,
                            value: att_id_value,
                        },
                        rows: {
                            status: att_rows_status,
                            value: att_rows_value,
                        },
                        placeholder: {
                            status: att_placeholder_status,
                            value: att_placeholder_value,
                        },
                        size: {
                            status: att_size_status,
                            value: att_size_value,
                        },
                        cols: {
                            status: att_cols_status,
                            value: att_cols_value,
                        },
                    },
                    validation: {
                        required: {
                            status: validat_required_status,
                        },
                        min: {
                            status: validat_min_status,
                            value: validat_min_value,
                        },
                        max: {
                            status: validat_max_status,
                            value: validat_max_value,
                        },
                        step: {
                            status: validat_step_status,
                            value: validat_step_value,
                        },
                        disabled: {
                            status: validat_disabled_status,
                        },
                        readonly: {
                            status: validat_readonly_status,
                        },
                        maxlength: {
                            status: validat_maxlength_status,
                            value: validat_maxlength_value,
                        },
                        accept: {
                            status: validat_accept_status,
                            value: validat_accept_value,
                        },
                    },
                });
    });

//    console.log(JSON.stringify(new_order));
    document.getElementById("row_order").value = JSON.stringify(new_order);
}
/*
 * EOF create common  json
 */




function check_validatexist(val_Ex) {

    $('.common_formsbmt').prop('disabled', false);

    var str = $(val_Ex).attr('id');
    var cur_val = $(val_Ex).val();

    var gl_frmatr_name = 0;
    var gl_frmatr_id = 0;
    var gl_frmatr_label = 0;

    var gl_frmatr_name_alert = 0;
    var gl_frmatr_id_alert = 0;
    var gl_frmatr_label_alert = 0;


    if (str.includes("name") == true) {
        $('.table-sortable tbody tr').each(function () {

            if (str != 'fci_t_attrib_name' + gl_frmatr_name) {

                var exval = $(this).find("input[id^='fci_t_attrib_name']").val();
                if (exval != undefined) {
                    if (exval == cur_val) {
                        gl_frmatr_name_alert = 1;
                    } else {
                        gl_frmatr_name_alert = 0;
                    }
                }
            }
            gl_frmatr_name++;
        });
    }


    if (str.includes("id") == true) {
        $('.table-sortable tbody tr').each(function () {

            if (str != 'fci_t_attrib_id' + gl_frmatr_id) {

                var exval = $(this).find("input[id^='fci_t_attrib_id']").val();
                if (exval != undefined) {

                    if (exval == cur_val) {
                        gl_frmatr_id_alert = 1;
                    } else {
                        gl_frmatr_id_alert = 0;
                    }
                }
            }
            gl_frmatr_id++;
        });
    }


    if (str.includes("label") == true) {
        $('.table-sortable tbody tr').each(function () {
            if (str != 'fci_t_attrib_label' + gl_frmatr_label) {

                var exval = $(this).find("input[id^='fci_t_attrib_label']").val();
                if (exval != undefined) {

                    if (exval == cur_val) {
                        gl_frmatr_label_alert = 1;
                    } else {
                        gl_frmatr_label_alert = 0;
                    }
                }
            }
            gl_frmatr_label++;
        });
    }

    if (gl_frmatr_name_alert == 1) {

        alert('This name already exist');
    }

    if (gl_frmatr_id_alert == 1) {

        alert('This id already exist');
    }

    if (gl_frmatr_label_alert == 1) {

        alert('This label already exist');
    }

}



function alreadyExistAttr() {
    var gl_frmatr_name_arr = [];
    var gl_frmatr_id_arr = [];
    var gl_frmatr_label_arr = [];

    $('.table-sortable tbody tr').each(function () {
        var exval = $(this).find("input[id^='fci_t_attrib_name']").val();
        var chkstat = $(this).find("input[id^='fci_attrib_name']").is(':checked');
        if (chkstat == true) {
            if (exval != undefined) {
                gl_frmatr_name_arr.push(exval);
            }
        }
    });

    $('.table-sortable tbody tr').each(function () {
        var exval = $(this).find("input[id^='fci_t_attrib_id']").val();
        var chkstat_id = $(this).find("input[id^='fci_attrib_id']").is(':checked');
        if (chkstat_id == true) {
            if (exval != undefined) {
                gl_frmatr_id_arr.push(exval);
            }
        }
    });

    $('.table-sortable tbody tr').each(function () {
        var exval = $(this).find("input[id^='fci_t_attrib_label']").val();
        var chkstat_lbl = $(this).find("input[id^='fci_attrib_label']").is(':checked');
        if (chkstat_lbl == true) {
            if (exval != undefined) {
                gl_frmatr_label_arr.push(exval);
            }
        }
    });



    if (gl_frmatr_name_arr.length > 0) {
        var return_match_arr = unique_arr(gl_frmatr_name_arr);
        if (parseInt(gl_frmatr_name_arr.length) > parseInt(return_match_arr.length)) {
            $('.common_formsbmt').prop('disabled', true);
            alert('This name already exist');
        } else {
            $('.common_formsbmt').prop('disabled', false);
        }
    }


    if (gl_frmatr_id_arr.length > 0) {
        var return_match_arr_id = unique_arr(gl_frmatr_id_arr);
        if (parseInt(gl_frmatr_id_arr.length) > parseInt(return_match_arr_id.length)) {
            $('.common_formsbmt').prop('disabled', true);
            alert('This id already exist');
        } else {
            $('.common_formsbmt').prop('disabled', false);
        }
    }


    if (gl_frmatr_label_arr.length > 0) {

        var return_match_arr_lbl = unique_arr(gl_frmatr_label_arr);
        if (parseInt(gl_frmatr_label_arr.length) > parseInt(return_match_arr_lbl.length)) {
            $('.common_formsbmt').prop('disabled', true);
            alert('This label already exist');
        } else {
            $('.common_formsbmt').prop('disabled', false);
        }
    }

}



function unique_arr(array) {
    return array.filter(function (el, index, arr) {
        return index == arr.indexOf(el);
    });
}







function chk_clear_word(field) {

    var string = $(field).val();
    var string = string.replace(/ /g, '');
    var string = string.toLowerCase();

    $(field).val(string.trim());
}

function chk_clear_word2(field) {

    var string = $(field).val();
    var string = string.replace(/ /g, '');
    //var string = string.toLowerCase();

    $(field).val(string.trim());
}


function chk_clear_word_trim(field) {
    var string = $(field).val();
    $(field).val(string.trim());
}


function slugShow() {
    $('.read-slug').prop('readonly', false);
    $('.slugShow').hide();
    $('.slugHide').show();
}

function slugHide() {
    $('.read-slug').prop('readonly', true);
    $('.slugShow').show();
    $('.slugHide').hide();
}

function url_write_sec() {

    var url_val = $('.parentid option:selected').attr('data-url');
    $('.sa_remain_url_section').html(url_val);
    $('.sa_remain_url_section_input').val(url_val);


}

function url_write_sec_item() {


    var url_val = $('.sa_item_cat:checked').attr('data-url');
    $('.sa_remain_url_section').html(url_val);
    $('.sa_remain_url_section_input1').val(url_val);

}

function clearNameString() {

    var string = $('.slug_ref').val();
    var string = string.replace(/([<;'"!(){}>])/g, ' ');
    $(".slug_ref").val(string);
}


// THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
function isNumber(evt, element) {

    var charCode = (evt.which) ? evt.which : event.keyCode

    if (
//            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-�? CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) && // “.�? CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
        return false;

    return true;
}

$(document).ready(function () {
    var urltext = $('body').find('.gl_quick_link_name').val();

    $('body').on('click', '.gl_quick_link', function () {
        if (!$(this).is(':checked'))
        {
            $('body').find('.gl_quick_link_name').prop('disabled', true);

        } else
        {
            $('body').find('.gl_quick_link_name').prop('disabled', false);
            $('body').find('.gl_quick_link_name').val(urltext);
        }

    });

});



$('.gl_search_sorting_form').submit(function (e) {
    var form_action = $(this).attr('action');
//console.log(form_action);
    e.preventDefault();

    var gl_search_sorting_form_object = $(".gl_search_sorting_form").serializeArray();
//       var gl_form_input_length = gl_search_sorting_form_object.length;
    var gl_url = "";
    $.each(gl_search_sorting_form_object, function (i, field) {

        var field_value = field.value;
        field_value = field_value.trim();
        field_value = field_value.replace("'", "");
        field_value = field_value.replace('"', '');
        field_value = field_value.replace('/', '');
        field_value = field_value.replace('&', '');
        field_value = field_value.replace(' ', '-');

        if (field_value !== "") {
            gl_url = gl_url + field.name + "=" + field_value + "&";
        }

    });
    var base_url = $(".base_url").val();
//        window.location = base_url + 'ecproductadmin/view_product?' + gl_url;
    var str_check = form_action.indexOf('?');
    str_con = '&';
    if (str_check < 0) {
        str_con = '?';
    }

    window.location = form_action + str_con + gl_url;

});


function custom_validate()
{
    var sort_radio = $('.sort_radio').val();
    var custom_sort = $('.custom_sort').val();

    if (sort_radio !== '' && custom_sort === '')
    {
        $('.custom_sort_error').html('field should not be empty');
        $('.sort_radio_error').html('');
        return false;
    } else if (sort_radio === '' && custom_sort !== '')
    {
        $('.custom_sort_error').html('');
        $('.sort_radio_error').html('field should not be empty');
        return false;
    } else
    {
        return true;
    }

}


//icon class js nikhil

$('body').on('click', ".icon_type", function () {

    var icon_val = $(this).val();

    var customlink_val = $('.customlink:checked').val();
    if (icon_val == 'icon_image')
    {
        $('.gl_icon_image').removeClass('hide');

        if (customlink_val == 'internal')
        {
            $('.internal_area').removeClass('hide');
            $('.external_area').addClass('hide');

        } else if (customlink_val == 'external')
        {
            $('.external_area').removeClass('hide');
            $('.internal_area').addClass('hide');

        }

        $('.gl_icon_class').addClass('hide');
        $('.gl_icon_html').addClass('hide');
    } else if (icon_val == 'icon_class')
    {
        $('.gl_icon_class').removeClass('hide');
        $('.gl_icon_image').addClass('hide');
        $('.gl_icon_html').addClass('hide');
    } else if (icon_val == 'icon_html')
    {
        $('.gl_icon_html').removeClass('hide');
        $('.gl_icon_image').addClass('hide');
        $('.gl_icon_class').addClass('hide');

    }
})

$('body').on('click', ".icon_customlink", function () {
    var customlink_val = $(this).val();
//alert(customlink_val);
    if (customlink_val == 'internal')
    {
        $('.icon_internal_area').removeClass('hide');
        $('.icon_external_area').addClass('hide');

    } else if (customlink_val == 'external')
    {
        $('.icon_external_area').removeClass('hide');
        $('.icon_internal_area').addClass('hide');
    }
});




//EOF icon class js nikhil

//Enter Key Submit Functionality By Sheron Starts

$(".gl_enter_submit").keypress(function (event) {
    var sort_status = custom_validate();
    custom_validate();
    if (sort_status == true) {
        if (event.which == 13) {
            event.preventDefault();
            $("form").submit();
        }
    }
});

//Ends



//$(".gl_multiselect2").select2();
//$(".gl_singleselect2").select2();


//$(".gl_multiselect2").find(".select2-choices").sortable({
//    containment: 'parent',
//    cursor: "move",
//    opacity: 0.5,
//
//});
function get_url_parameter(sParam)
{
    hash = window.location.href;
    if (hash.indexOf("?") >= 0)
    {

        var new_hash = hash.split('?');

        var sPageURL = new_hash[1];
        var sURLVariables = sPageURL.split('&');

        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return sParameterName[1];
            }
        }


    }
}

$(document).ready(function () {
    var ftype = get_url_parameter('ftype');
    if (ftype == 'shop') {
        $('.gl_ftype_label').each(function () {
            var str = $(this).text();
            var str = str.replace('product', 'shop');
            var str = str.replace('Product', 'Shop');
            var str = str.replace('PRODUCT', 'SHOP');
            $(this).text(str);
        });
    }
});


//wrapper tag js starts

update_main_type_wrp('');

$('.gl_wrp_main_type_wrp').on('change', '.gl_wrp_main_type', function(){
    
    var count = $(this).data('count');

    update_main_type_wrp(count);

});


function update_main_type_wrp(count)
{


$('.gl_start_section_wrp_'+count).hide();
    $('.gl_end_section_wrp_'+count).hide();
    $('.gl_html_tag_wrp_'+count).hide();
    $('.gl_tag_class_wrp_'+count).hide();
    
    var wrapper_type = $(".gl_wrp_main_type:checked").val();
        
    if(wrapper_type == 'html_wrp'){
        $('.gl_start_section_wrp_'+count).show();
        $('.gl_end_section_wrp_'+count).show();
    }else if(wrapper_type == 'class_wrp'){
        $('.gl_html_tag_wrp_'+count).show();
        $('.gl_tag_class_wrp_'+count).show();
    }	
	
}

//wrapper tag js ends
$(document).ready(function () {
    if($(".gl_discount_status").length>0){
        var discount_item = $(".gl_discount_status:checked");
        discount_checking_input(discount_item); 
    }

});
 
 $("body").on("change",".gl_discount_status",function(){ 
    var discount_item=$(this);
    discount_checking_input(discount_item);
 });

function discount_checking_input(item){
  if(item.prop("checked") == true){
      var item_value=item.val();
      if(item_value=="no"){
          $(".gl_discount_field").hide(); 
          $('.gl_selling_price').attr('readonly', false);
          $(".gl_dicount_selling_text").text('');
          $(".gl_selling_price").parent().hide();
      }else if(item_value=="yes"){
          $(".gl_discount_field").show(); 
          $('.gl_selling_price').attr('readonly', true);
          $(".gl_dicount_selling_text").text("Discount Activated So Selling Price Can't Edit");
          $(".gl_selling_price").parent().show();
      }
   }  
}


$(".gl_common_input_wrapper_discount_type").on('change','input[type=radio]',function(){
    var discount_val=$(".gl_discount_value").val();
    var discount_type=$(this).val();
    var original_price=$(".gl_original_price").val(); 
    if(discount_val!="" && discount_type!="" && original_price!=""){
      discount_checking(discount_val,discount_type,original_price);  
    }
});

$("body").on("blur",".gl_original_price",function(){
    var discount_val=$(".gl_discount_value").val();
    var discount_type=$(".gl_common_input_wrapper_discount_type").find("input[type=radio]:checked").val();
    var original_price=$(this).val();
    if(discount_val!="" && discount_type!="" && original_price!=""){
      discount_checking(discount_val,discount_type,original_price);  
    }
});

$("body").on("blur",".gl_discount_value",function(){
    var discount_val=$(this).val();
    var discount_type=$(".gl_common_input_wrapper_discount_type").find("input[type=radio]:checked").val();
    var original_price=$(".gl_original_price").val();
    if(discount_val!="" && discount_type!="" && original_price!=""){
      discount_checking(discount_val,discount_type,original_price);  
    }
});


function discount_checking(discount_val,discount_type,original_price) {
    ajaxindicatorstart('please wait..');
    var url = $(".base_url").val() + 'ecproductadmin/discount_value_checking';
    $.ajax({
        url: url,
        async: false,
        type: "POST",
        data: {discount_val: discount_val, discount_type: discount_type, original_price: original_price},
        cache: false,
        success: function (response) {
            $(".gl_selling_price").val(response);
            if(response==0){
              $(".gl_selling_price_error").text('Discount not applied');  
            }else{
               $(".gl_selling_price_error").text('');   
            }
           ajaxindicatorstop(); 
        }
    });
}


$('body').on('keypress', '.gl_number_digits_only', function (e) {
//if the letter is not digit then display error and don't type anything
if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
//display error message

return false;
}
});	