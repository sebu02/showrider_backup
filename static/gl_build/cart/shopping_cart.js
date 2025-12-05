
var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

function submit_button_disable(button_selector) {


    $(button_selector).attr('disabled', 'disabled');
    $(button_selector).text("Loading");
    gl_btn_preloader_add(button_selector);

}
function submit_button_enable(button_selector) {

    if ($(button_selector).is(':disabled')) {
        delay(function () {
            $(button_selector).removeAttr('disabled');
            gl_btn_preloader_remove(button_selector);
            $(button_selector).text($(button_selector).attr("data_text"));
        }, 1500);
    }

}
//function a_tag_disable(button_selector) {
//  
//    $(button_selector).attr('disabled', 'disabled');
//
//}
//function a_tag_enable(button_selector) {
//
//    if ($(button_selector).is(':disabled')) {
//     debugger;
//        $(button_selector).removeAttr('disabled');
//         gl_span_preloader('.gl_sub_grand_total');
//    }
//
//}

var base_url = $(".base_url").val();
function common_function(functionname)
{
    var base_url = $(".base_url").val();

    var dataString = "";

    $.ajax({
        type: "POST",
        url: base_url + "common_controller/" + functionname,
        data: dataString,
        cache: false,

        success: function (html)
        {
            switch (functionname) {
                case 'totalcartcount':
                    //Cart

                    $(".gl_cart_count").html(html);
                    break;
                case 'total_cart_price':
                    //Total Cart price

                    $(".gl_total_cart_price").html(html);
                    break;
                case 'total_cart_currency_convertion_price':
                    //Total cuurency convertion Cart price
                    var obj = JSON.parse(html);
                    var price = obj['icon_class'] + ' ' + obj['price'];
                    var currency_key = obj['key'];

                    $(".gl_total_cart_currency_convertion_price").html(price);
//                    $(".gl_total_cart_currency_key").html(currency_key);
                    break;

                case 'gl_cart_total_only_product_price':
                    $(".gl_cart_total_only_product_price").html(html);
                    break;

                case 'gl_delivery_cart_price':
                    $(".gl_delivery_cart_price").html(html);
                    break;

                case 'gl_cart_coupon_amount':
                    $(".gl_cart_coupon_amount").html(html);
                    break;
                case 'gl_remove_coupon':

                    var gl_remove_coupon_return_data = JSON.parse(html);
                    if (gl_remove_coupon_return_data['status'] == 'removed') {

                        flash_message_style2(gl_remove_coupon_return_data['status_text']);

                        common_function('check_set_coupon_applied');
                        common_function('gl_cart_total_only_product_price');
                        common_function('gl_cart_coupon_amount');
                        common_function('total_cart_price');
                    }

                    break;


                case 'check_set_coupon_applied':

                    var coupon_object = JSON.parse(html);
                    if (coupon_object['status'] == 'invalid') {

                        $(".gl_invalid_message").html();
                        $(".gl_invalid_message").hide();
                        $(".gl_valid_coupon_container").hide();
                        $(".gl_apply_or_remove_container").text("Apply Coupon");
                        $(".gl_apply_or_remove_container").removeClass("gl_cart_remove_coupon");
                        $(".gl_apply_or_remove_container").attr("data-target", "#applycoupen_pop");

                    } else {

                        var coupon_object = JSON.parse(html);
                        $(".gl_invalid_message").html();
                        $(".gl_invalid_message").hide();
                        $(".gl_coupon_code").html(coupon_object['coupon_code']);
                        $(".gl_coupon_amount").html(coupon_object['coupon_balance']);
                        $(".gl_cart_coupon_amount").html(coupon_object['coupon_balance']);
                        $(".gl_cart_coupon_applied_amount").html(coupon_object['coupon_applied_amount']);
                        $(".gl_cart_coupon_balance_amount").html(coupon_object['coupon_remaining_balance']);

                        if (parseFloat(coupon_object['coupon_remaining_balance']) <= '0') {
                            $(".gl_couponbalanceamount_container").hide();
                        } else {
                            $(".gl_couponbalanceamount_container").show();
                        }
                        $(".gl_valid_coupon_container").show();

                    }

                    break;

                case 'countcompare':
                    //Comparison
                    $(".comparecount").html(html);
                    if (html > 0) {
                        if ($(".gl_compare_icon_section").hasClass('active') == false) {
//                            $(".compare_ico").css("left", "0px");
                            $(".gl_compare_icon_section").addClass('active');
                        }
                    } else {
                        if ($(".gl_compare_icon_section").hasClass('active') == true) {
                            $(".gl_compare_icon_section").removeClass('active');
                        }
                    }

                    break;
                case 'countwishlist':
                    //Wishlist


                    $(".gl_wishlistcount").html(html);
                    break;

                case 'emptycompare':
                    //Comparison

                    $(".overlay_compare").fadeOut();
                    $(".compareboxdiv").fadeOut();
                    var msg = 'Compare list is empty.';
                    flash_message_style2(msg);
                    common_function('countcompare');
                    break;

                default:


            }
        }
    });
}

$(document).ready(function () {

    common_function('check_set_coupon_applied');
    common_function('gl_cart_total_only_product_price');
//    common_function('gl_delivery_cart_price');
    common_function('gl_cart_coupon_amount');
    common_function('total_cart_price');


    common_function('countwishlist');
    common_function('countcompare');

    $(".gl_product_modal_click").on("click", ".gl_addto", function () {
        var pid = $(this).attr('data-pid');
        var qty = $("#gl_cartqty" + pid).val();
        var flash_type = $(this).attr('data-flash_type');
        var gl_type = $(this).attr('data-addtype');
        var selected_pid = $(this).attr('data_selected_pid');

        if (qty == undefined) {
            qty = 1;
        }

        if (gl_type == "gl_cart") {
            addtocart(pid, qty, flash_type);
        }
    });
    $(".gl_product_list_featurebox_section").on("click", ".gl_addto", function () {
//        debugger;

        var pid = $(this).attr('data-pid');
        var qty = $("#gl_cartqty" + pid).val();
        var flash_type = $(this).attr('data-flash_type');
        var gl_type = $(this).attr('data-addtype');
        var selected_pid = $(this).attr('data_selected_pid');
        var gl_func = $(this).attr('data-func');
        if (qty == undefined) {
            qty = 1;
        }




        if (gl_type == "gl_cart") {
            addtocart(pid, qty, flash_type);
        } else if (gl_type == "gl_cart_wizard_1") {

            $('.services_div').removeAttr("checked");
            $(".wizard_option_item").css('background', 'none');

            $(this).find('.services_div').prop("checked", true);
            $(this).css('background', '#F3F3F3');



            var service_amount = $(this).attr('data-samt');
            var service_amount = parseInt(service_amount);

            var service_amount = service_amount.toFixed(2).replace(/./g, function (c, i, a) {
                return i && c !== "." && !((a.length - i) % 3) ? ',' + c : c;
            });


            $('.gl_total_service_amt').html(service_amount);

//            debugger;
            if (pid == selected_pid) {

            } else if (pid == 0 && selected_pid != 0) {
                update_cart(0, 0, 'none', selected_pid);

            } else if (selected_pid == 0 && pid != 0) {
                addtocart(pid, qty, 'none', gl_type);

            } else if (pid !== selected_pid) {

                update_cart(0, 0, 'none', selected_pid);

                addtocart(pid, qty, 'none', gl_type);

            }
            $(".wizard_option_item").each(function () {
                $(this).attr('data_selected_pid', pid);
            });
        }
        if (gl_type == "gl_comparison") {
//            addtocompare(pid, flash_type);
            var listType = "compare";
            addtolist(pid, 'none', listType);
        }
        if (gl_type == "gl_wishlist") {
            var listType = "wishlist";
//            debugger;
//            alert(gl_func);
//            if(gl_func=="add")
//            {
//                
//            var listType = "wishlist";
//            addtolist(pid, 'none', listType);
//        }
//        
//           if(gl_func=="remove")
//            {
//                alert(gl_func);
//            var listType = "wishlist";
//            removetolist(pid, 'none', listType);
//           }
//        
            switch (gl_func)
            {
                case "add":

                    addtolist(pid, 'none', listType);
                    break;

                case "remove":

                    removefromlist(pid, 'none', listType);
                    break;

            }


        }


    });








    $(".gl_remove_row").click(function ()
    {
//        debugger;
        var gl_cart_row = $(this).closest('.gl_cart_row');
        var cart_rowid = $(this).closest('.gl_cart_row').attr('data_rowid');



        gl_span_preloader(selector = ".gl_cart_total_only_product_price");
        gl_span_preloader(selector = ".gl_delivery_cart_price");
        gl_span_preloader(selector = ".gl_cart_coupon_amount");
        gl_span_preloader(selector = ".total_cart_price");

//        debugger;
        $.when(update_cart(cart_rowid))
                .done(function (data) {
                    gl_cart_row.animate({backgroundColor: "#fbc7c7"}, "fast")
                            .slideUp("slow", "linear");
                    common_function('totalcartcount');
                    common_function('gl_cart_total_only_product_price');
                    common_function('gl_delivery_cart_price');
                    common_function('gl_cart_coupon_amount');
                    common_function('total_cart_price');
                    common_function('total_cart_currency_convertion_price');
                    common_function('check_set_coupon_applied');
//                    console.log(data);
                    cart_flash_message(data);
//                    gl_cart_row.remove()
                    $.when(gl_cart_row.remove()).done(function () {
                        delay(function () {

//        debugger;

//                   alert($(".gl_cart_count").html());
                            if ($(".gl_cart_count").html() == 0) {
                                var base_url = $(".base_url").val();
                                window.location = base_url + "mycart";

                            }

                        }, 1000);

                    });



                });


    });




    /******* EOF To remove from cart  ****************/



    /******* To remove from wishlist,comparison,cart list type  ****************/
    $(".gl_list_rows_wrapper").on("click", ".gl_remove_list_row", function () {

        var item_list_row = $(this).parents('.gl_list_row');
        var pid = $(item_list_row).attr('data-pid');
        var listType = $(item_list_row).attr('data-type');
//        console.log(item_list_row);
//        console.log(pid);
//        debugger;

        var base_url = $(".base_url").val();
        var dataString = "";

        $.ajax({
            type: "POST",
            url: base_url + "index/removefromlist/" + pid + "/" + listType,
            data: dataString,
            cache: false,
            success: function (html)
            {

//                console.log(html);
                switch (html) {
                    case '-1':
                        var msg = 'Item removed from ' + listType;
                        flash_message_style2(msg);

                        switch (listType) {
                            case 'wishlist':
                                item_list_row.remove();
                                common_function('countwishlist');
                                break;
                            case 'compare':

                                var a = item_list_row.attr("data-remove");
                                item_list_row.parents('.Rtable').find('.item_' + a).empty();

                                var atrval = item_list_row.attr('data-rsp-remove');
                                item_list_row.parents('.rsp_cmpar_wrp').find('.product' + atrval).find('.cmpar_right_inr').empty();
                                item_list_row.addClass('empty_item');
                                item_list_row.find('.cmpr_p_search').children('.input_srch').focus();

                                common_function('countcompare');
                                testAnim();
                                break;
                            case 'cart':

                                break;
                            default:
                                break;
                        }






                        break;
                    default:
                        break;
                }



            }
        });


    });


    /*******EOF  To remove from wishlist,comparison,cart list type  ****************/







});






/******* To remove from wishlist  ****************/

function removefromlist(pid, flash_type, listType)
{
    var base_url = $(".base_url").val();
    var dataString = "";

    $.ajax({
        type: "POST",
        url: base_url + "index/removefromlist/" + pid + "/" + listType,
        data: dataString,
        cache: false,
        success: function (html)
        {
//                console.log(html);
            switch (html) {
                case '-1':
                    var msg = 'Item removed from ' + listType;
                    if (flash_type == "no_flash") {

                    } else {
                        flash_message_style2(msg);
                    }

                    switch (listType) {
                        case 'wishlist':
                            var list_item = $(".gl_product_list_featurebox_section")
                                    .find('.gl_product_item_wrapbox-' + pid)
                                    .find(".gl_addto[data-addtype='gl_wishlist']");
                            // item_list_row.remove();
                            list_item.attr('data-tooltip', 'add wishlist');
                            list_item.attr('data-func', 'add');
                            common_function('countwishlist');
                            break;
                        case 'all_list':
                            common_function('countwishlist');
                            common_function('countcompare');
                        default:
                            common_function('countwishlist');
                            common_function('countcompare');

                            break;
                    }


                    break;
                default:
                    break;
            }

        }
    });
}




/******* To remove from wishlist  ****************/




/** Wishlist,Comparison,Cart Section ********************************************************/

function addtolist(pid, flash_type, listType)
{
    var base_url = $(".base_url").val();
    var dataString = "";

    $.ajax({
        type: "POST",
        url: base_url + "index/addtolist/" + pid + "/" + listType,
        data: dataString,
        cache: false,
        success: function (html)
        {

//            console.log(html);
            switch (html) {
                case '1':
                    var msg = 'Item added to ' + listType;
                    flash_message_style2(msg);
                    break;
                case '3':
                    var msg = 'This Item already Exist.';
                    flash_message_style2(msg);
                    break;
                case '2':
                    var msg = 'Your ' + listType + ' limit has reached.';
                    flash_message_style2(msg);
                    break;

                default:
                    break;
            }

            switch (listType) {
                case 'wishlist':
                    var list_item = $(".gl_product_list_featurebox_section")
                            .find('.gl_product_item_wrapbox-' + pid)
                            .find(".gl_addto[data-addtype='gl_wishlist']");
                    list_item.attr('data-tooltip', 'remove wishlist');
                    list_item.attr('data-func', 'remove');
//                    console.log(list_item);
                    common_function('countwishlist');
                    break;
                case 'compare':
                    common_function('countcompare');
                    testAnim();
                    break;
                case 'cart':

                    break;
                default:
                    break;
            }

        }
    });

}







/** EOF Wishlist Section ********************************************************/
/** Comparison Section ********************************************************/




$(".compareclose").click(function ()
{

    $(".overlay_compare").fadeOut();
    $(".compareboxdiv").fadeOut();

});




/** EOF Comparison Section ********************************************************/
/** Cart Section ********************************************************/





function addtocart(pid, qty, flash_type, wizard_type)
{
    if (flash_type === undefined) {
        flash_type = 'none';
    }
    if (wizard_type === undefined) {
        wizard_type = '';
    }
    var dataString = "pid=" + pid + "&qty=" + qty;

    if (wizard_type == 'gl_cart_wizard_1') {
        dataString = dataString + "&wizard_type=" + wizard_type;
    }

    var base_url = $(".base_url").val();
    $.ajax({
        type: "POST",
        url: base_url + "cart/addcart_detail/",
        data: dataString,
        cache: false,
        success: function (status_signal) {
//            console.log(status_signal);
            common_function('totalcartcount');
            common_function('gl_cart_coupon_amount');
            common_function('gl_cart_total_only_product_price');
            common_function('total_cart_price');
            common_function('check_set_coupon_applied');
            switch (flash_type) {
                case 'cart_flash_message':
                    cart_flash_message(status_signal);
                    break;
                case 'cart_single_item_flash':
                    cart_single_item_flash(status_signal, pid);
                    break;
                case 'cart_modal_item_popup':
                    cart_modal_item_popup(status_signal);
                    break;
                case 'cart_text_message':
                    cart_text_message(status_signal);
                    break;

                default:
            }

            window.location = base_url + "mycart";

        }

    });

}

//To increment and decrement quantity in cart

$(".gl_incre_decre").click(function () {

    var pid = $(this).closest('.gl_cart_row').attr('data-pid');
    var cart_rowid = $(this).closest('.gl_cart_row').attr('data_rowid');
    var gl_incre_decre_type = $(this).attr('data_inc_type');
    var current_gl_input_qty = $(this).closest('.gl_cart_row').find('.gl_input_qty');
    var current_gl_input_qty_val = parseInt(current_gl_input_qty.val());

    var gl_product_price = $(this).closest('.gl_cart_row').attr('data_price');

    var subtotal = gl_product_price * current_gl_input_qty_val;

    var gl_avail_qty_val = $(this).closest('.gl_cart_row').attr('data_avail_qty');
    var gl_avail_qty_info = $(this).closest('.gl_cart_row').find('.gl_avail_qty_info');

    var gl_sub_total = $(this).closest('.gl_cart_row').find('.gl_sub_total');


    var myCartlist_inner = $(this).closest('.myCartlist_inner');

    gl_avail_qty_info.hide();

    switch (gl_incre_decre_type) {
        case 'gl_plus':




            // If is not undefined
            if (!isNaN(current_gl_input_qty_val)) {


                // Increment

                var base_url = $(".base_url").val();
                $.ajax({

                    url: base_url + "cart/get_available_qty/",
                    type: "POST",
                    data: {pid: pid, current_gl_input_qty_val: current_gl_input_qty_val, gl_incre_decre_type: gl_incre_decre_type},
                    success: function (msg) {

//                        console.log(msg);
                        if (msg == "NO")
                        {
//                            $('.myCartlist_inner').removeClass('myCartlist_inner_outofstock');
                            myCartlist_inner.removeClass('myCartlist_inner_outofstock');

                            gl_avail_qty_info.html("Available Stock : " + gl_avail_qty_val);
                            gl_avail_qty_info.show();
                        } else if (msg == "OUT")
                        {
//                            $('.myCartlist_inner').addClass('myCartlist_inner_outofstock');
                            myCartlist_inner.addClass('myCartlist_inner_outofstock');

                            gl_avail_qty_info.html("Out Of Stock");
                            gl_avail_qty_info.show();
                            gl_sub_total.html('');
                            var new_current_gl_input_qty_val = current_gl_input_qty.val(0);
                            update_cart(cart_rowid, new_current_gl_input_qty_val);

                        } else
                        {
//                            $('.myCartlist_inner').removeClass('myCartlist_inner_outofstock');
                            myCartlist_inner.removeClass('myCartlist_inner_outofstock');
                            gl_avail_qty_info.hide();
                            var new_current_gl_input_qty_val = current_gl_input_qty_val + 1;
                            current_gl_input_qty.val(new_current_gl_input_qty_val);

                            subtotal = gl_product_price * new_current_gl_input_qty_val;
                            gl_sub_total.html(subtotal);

                            gl_span_preloader(selector = ".gl_total_cart_price");

                            update_cart(cart_rowid, new_current_gl_input_qty_val);

//                        //EOF To add subtotal and whole total
                        }
                    },
                });





            } else {
                // Otherwise put a 0 there
                current_gl_input_qty.val(1);
                // To add subtotal and whole total

            }





            break;
        case 'gl_minus':
            //Decrement

            // If is not undefined
            if (!isNaN(current_gl_input_qty_val) && current_gl_input_qty_val > 1) {
                // Decrement one
                var base_url = $(".base_url").val();
                $.ajax({

                    url: base_url + "cart/get_available_qty/",
                    type: "POST",
                    data: {pid: pid, current_gl_input_qty_val: current_gl_input_qty_val, gl_incre_decre_type: gl_incre_decre_type},
                    success: function (msg) {
//                        console.log(msg);
                        if (msg == "NO")
                        {
                            myCartlist_inner.addClass('myCartlist_inner_outofstock');
                            gl_avail_qty_info.html("Out Of Stock ");
                            gl_avail_qty_info.show();
                            gl_sub_total.html('');
                            var new_current_gl_input_qty_val = current_gl_input_qty.val(0);
                            update_cart(cart_rowid, new_current_gl_input_qty_val);
                        } else
                        {

                            myCartlist_inner.removeClass('myCartlist_inner_outofstock');
                            var new_current_gl_input_qty_val = current_gl_input_qty_val - 1;
                            current_gl_input_qty.val(new_current_gl_input_qty_val);

                            // To add subtotal and whole total
                            subtotal = gl_product_price * new_current_gl_input_qty_val;
                            gl_sub_total.html(subtotal);
                            gl_span_preloader(selector = ".gl_total_cart_price");
                            update_cart(cart_rowid, new_current_gl_input_qty_val);
                        }
                    },
                });







            } else if (current_gl_input_qty_val == 1) {
                //current_gl_input_qty.val(1);
                // To add subtotal and whole total

                var base_url = $(".base_url").val();
                $.ajax({

                    url: base_url + "cart/get_available_qty/",
                    type: "POST",
                    data: {pid: pid, current_gl_input_qty_val: current_gl_input_qty_val, gl_incre_decre_type: gl_incre_decre_type},
                    success: function (msg) {
//                        console.log(msg);
                        if (msg == "NO")
                        {
                            myCartlist_inner.addClass('myCartlist_inner_outofstock');
                            gl_avail_qty_info.html("Out Of Stock");
                            gl_avail_qty_info.show();
                            gl_sub_total.html('');
                            var new_current_gl_input_qty_val = current_gl_input_qty.val(0);
                            update_cart(cart_rowid, new_current_gl_input_qty_val);
                        }



                    },
                });

            }
            break;




        default:
            break;

    }



});


//EOF To increment and decrement quantity in cart

function update_cart(rowid, qty, flash_type, selected_product_id)
{
//    debugger;
    if (qty === undefined) {
        qty = '0';
    }
    if (flash_type === undefined) {
        flash_type = 'none';
    }
    if (selected_product_id === undefined) {
        selected_product_id = 'false';
    }

    var dataString = "rowid=" + rowid + "&qty=" + qty;

    if (selected_product_id !== 'false') {
        dataString = dataString + "&selected_product_id=" + selected_product_id;
    }

    var base_url = $(".base_url").val();

    return  $.ajax({
        type: "POST",
        url: base_url + "cart/update_cart/",
        data: dataString,
        cache: false,
        async: false,
        success: function (status_signal) {
//            console.log(status_signal);
            common_function('totalcartcount');
            common_function('total_cart_price');
            common_function('gl_cart_total_only_product_price');
            common_function('check_set_coupon_applied');
            switch (flash_type) {
                case 'cart_flash_message':
                    cart_flash_message(status_signal);
                    break;
                case 'cart_single_item_flash':
                    cart_single_item_flash(status_signal, pid);
                    break;
                case 'cart_modal_item_popup':
                    cart_modal_item_popup(status_signal);
                    break;
                case 'cart_text_message':
                    cart_text_message(status_signal);
                    break;
                default:
                    break;
            }


        }

    });


}





/*******  Cart  Return Message Methods ********************/
function cart_flash_message(status_signal) {


    var msg = '';

    if (status_signal == -1) {
        msg = 'Item has been Removed';
    }
    if (status_signal == 1) {
        msg = 'Item has been Updated';
    } else if (status_signal == 0) {
        msg = 'Item Added To Basket';
    }
//    flash_message_style1(msg);
    flash_message_style2(msg);
}
function cart_text_message(status_signal) {


    var msg = '';

    if (status_signal == -1) {
        msg = 'Item has been Removed';
    }
    if (status_signal == 1) {
        msg = 'Item has been Updated';
    } else if (status_signal == 0) {
        msg = 'Item Added To Basket';
    }
    text_message_style1(msg);
}


function cart_single_item_flash(status_signal, pid) {



    var dataString = '';

    var base_url = $(".base_url").val();
    $.ajax({
        type: "POST",
        url: base_url + "cart/get_product/" + pid,
        data: dataString,
        cache: false,
        dataType: "json",
        success: function (product_data) {
            cart_single_item_flash_message_style1(product_data);
        }

    });

}
function cart_modal_item_popup(status_signal, pid) {



}
/******* EOF Cart  Return Message Methods ****************/

/*******Cart Wizard Methods ****************/

$(document).ready(function () {

    $(".gl_wizard_click").click(function ()
    {
        var data_wizard_href = $(this).attr('href');
//        console.log(data_wizard_href);
        window.location = data_wizard_href;


    });
});


/******* EOF Cart Wizard Methods ****************/


/** EOF Cart Section ********************************************************/





/******* Preloader styles ********************/
function gl_span_preloader(selector) {
    var span = $('<span />').addClass('se-pre-con');
    $(selector).html(span);
}
function gl_btn_preloader_add(selector) {
//    var span = $('<button />').addClass('se-pre-con');
    $(selector).addClass('se-btn-loader');
}
function gl_btn_preloader_remove(selector) {
//    var span = $('<button />').addClass('se-pre-con');
    $(selector).removeClass('se-btn-loader');
}



/******* Notification styles ********************/



/******* Notification styles ********************/

function flash_message_style1(msg) {
    //To Stop the previous animations
    $(".flash_message").stop();

    //To show message in specified style
    $(".flash_message").html(msg);
    $(".flash_message").fadeIn(400).delay(1000).fadeOut(400);
}
function flash_message_style2(msg, alert_type) {

    if (alert_type === undefined) {
        alert_type = 'warning';
    }

    notif({
        type: alert_type,
        msg: msg,
        width: 400,
        height: 60,
        position: "bottom"
    });


    $(".fixnav .ja_mini_cart").fadeIn(function () {
        setTimeout(function () {
            $('.fixnav .ja_mini_cart').fadeOut()
        }, 5000);
    });
}
function text_message_style1(msg) {
    //To Stop the previous animations
    $(".gl_cart_text_message").stop();

    //To show message in specified style
    $(".gl_cart_text_message").html(msg);
    $(".gl_cart_text_message").fadeIn(400).delay(1000).fadeOut(400);
}
function cart_single_item_flash_message_style1(msg) {
    //To Stop the previous animations
    $('.fa-click-buynow-show').stop();

    $(".single_item_cart_pop_up_prod_name").html(msg.prod_name);
    if (msg.prod_file != "") {
        prod_image = JSON.parse(msg.prod_file);
        $(".single_item_cart_pop_up_prod_image").attr("src", base_url + 'media_library/Thumb_' + prod_image.image);
    }
    $(".single_item_cart_pop_up_prod_code").html(msg.prod_code);
    $(".single_item_cart_pop_up_prod_price").html('?' + msg.prod_price);
    $('.fa-click-buynow-show').fadeIn(400).delay(7000).fadeOut(400);
}

/******* EOF Notification styles ****************/
/********** Coupon Code *************************/

$(".gl_right_cart_section").on("click", ".gl_cart_remove_coupon", function () {

    common_function('gl_remove_coupon');

});

/******* EOF Coupon Code **********************/


(function ($, W, D)
{
    var JQUERY4U = {};
    JQUERY4U.UTIL =
            {

                setupFormValidation: function ()

                {
                    var base_url = $(".base_url").val();

//                        form validation rules 
                    var current_form_name = "gl_buygiftcard_form";
                    var current_form = $("#" + current_form_name);
                    $.validator.addMethod("lettersonly", function (value, element)
                    {
                        return this.optional(element) || /^[a-z ]+$/i.test(value);
                    }, "Letters only please");
//                    jQuery.validator.addMethod('captcha', function (value, element) {
//                        var captcha_num1 = $("#" + current_form_name).find('.captcha_num1').text();
//                        var captcha_num2 = $("#" + current_form_name).find('.captcha_num2').text();
//                        return this.optional(element) || value == parseInt(captcha_num1) + parseInt(captcha_num2);
//
//
//                    }, 'Incorrect value, please try again.');
                    $.validator.methods.equal1 = function (value, element, params) {
                        return this.optional(element) || value == (parseInt(params[0]) + parseInt(params[1]));
                    };
                    $(current_form).validate({
                        focusInvalid: true,
                        focusCleanup: true,
                        rules: {

                            type: {

                                required: true

                            },
                            ship_email: {

                                required: true,
                                email: true

                            },
                            giftamount: {

                                required: true,
                                digits: true,
                                maxlength: 6,
                                minlength: 4,

                            },
                            captcha_sum: {
                                required: true,
                                equal1: [$(current_form).find('.captcha_num1').text(), $(current_form).find('.captcha_num2').text()],
                            },
                            qty: {

                                required: true,
                                digits: true,

                            },

                            s_firstname: {

                                required: true,
                                maxlength: 20,

                            },
                            ur_phone: {

                                required: true

                            },

                            comments: {

                                required: true

                            },

                        },
                        messages: {
                            captcha_sum: {
                                equal1: "Incorrect value,please try again",
                            }
                        },
                        submitHandler: function (form) {

                            ajaxindicatorstart("Please wait");
                            /*start*/
                            $.ajax({
                                type: "POST",
                                url: base_url + "index/buy_gift_cards",
                                cache: false,
                                data: new FormData(document.getElementById(current_form_name)),
                                contentType: false,
                                processData: false,
                                dataType: "JSON",
                                success: function (data) {
                                    $(current_form)[0].reset();
//                                    console.log(data);
                                    var pid = data.id;
                                    var qty = data.qty;
                                    addtocart(pid, qty);
                                    ajaxindicatorstop();
                                }
                            });
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

//currency calculation start

$(window).on('load', function () {
    if ($('.gl_active_currency').length > 0) {
        var key = $('.gl_active_currency .gl_currency').data("key");

        currency_calc_on_load(key);
    }
});

$('body').on('click', '.gl_rate_change_list li', function () {
//    $(".gl_rate_change_list li").click(function () {


    var SelectedCurrency = $(this).html();
    $(".active_currency").html(SelectedCurrency);


    var key = $(this).find('.gl_currency').data("key");

    currency_calc(key);

});
function currency_calc_on_load(key) {

    var dataString = "key=" + key;

    var base_url = $(".base_url").val();
    $.ajax({
        type: "POST",
        url: base_url + "index/currency_calc_on_load",
        data: dataString,
        cache: false,
        success: function (msg) {
            currency_calc_display(msg);
        }
    });

}
function currency_calc(key) {

    var dataString = "key=" + key;

    var base_url = $(".base_url").val();
    $.ajax({
        type: "POST",
        url: base_url + "index/currency_calc",
        data: dataString,
        cache: false,
        success: function (msg) {
            currency_calc_display(msg);
            location.reload();
        }
    });

}
function currency_calc_display(msg) {

    var obj = JSON.parse(msg);
    var value = obj['value'];
    var icon_class = obj['icon_class'];
    var icon = obj['icon'];
    var key = obj['key'];
    var def_status = obj['def_status'];
    var name = obj['name'];
    
//    $cur_active = '<span class="gl_currency CurrCode '.$icon.'" data-country="'.$name.'" data-value="'.$cvalue.'" data-def="'.$def_status.'" data-key="'.$key.'">'.$key.'</span>'
    
    if ($('.gl_active_currency').length > 0) {      
        $span_class = 'gl_currency CurrCode '+icon;
        $('.gl_active_currency span').removeAttr('class');
        $('.gl_active_currency span').addClass($span_class);
        $('.gl_active_currency span').attr('data-country', name);
        $('.gl_active_currency span').attr('data-value', value);
        $('.gl_active_currency span').attr('data-def', def_status);
        $('.gl_active_currency span').attr('data-key', key);
        $('.gl_active_currency span').html(key);
        
    }
    if ($('.gl_cart_row').length > 0) {

        $('.gl_cart_row').each(function () {

            var sub_total = $(this).find('.gl_sub_total').data("sub_total").replace(",", "");
            var comp_price = sub_total / value;
            var comp_price_text = '[ '+icon_class +' '+ comp_price.toFixed(2)+' ]';

            if (def_status != 'yes') {
                $(this).find('.gl_comp_price').removeClass('hide');
                $(this).find('.gl_comp_price').html(comp_price_text);
            } else {
                if (!$(this).find('.gl_comp_price').hasClass('hide')) {
                    $(this).find('.gl_comp_price').addClass('hide');
                }
                $(this).find('.gl_comp_price').html(comp_price_text);
            }
        });
    }
    if ($('.gl_total_cart_currency_convertion_price').length > 0) {
        common_function('total_cart_currency_convertion_price');
    }
}
//currency calculation end