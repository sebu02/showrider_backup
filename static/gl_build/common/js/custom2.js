if ($(".gl_product_detail_price_block").length) {

    var cattype = $(".gl_product_item_wrapbox").attr('data-cattype');

    if (cattype == '4')
    {
        $(".gl_product_detail_stock_block").hide();
        $(".gl_product_detail_price_block").hide();
        $(".gl_product_details_button_block").hide();
        $(".gl_product_details_qty_block").hide();
    }


}


if ($(".gl_product_detail_price_block").length) {

    var catmainid = $(".gl_cart_linkbox:first").attr('data-catmainid');

    if (catmainid == '4')
    {
        $('.gl_product_detail_linkbox:eq( 0 )').hide();
    } else
    if (catmainid == '2')
    {
        $('.gl_product_detail_linkbox:eq( 1 )').hide();
    }


}



if ($(".gl_product_listing_category_title").length) {

    var catmainid = $(".gl_cart_linkbox:first").attr('data-catmainid');

    if (catmainid == '4')
    {

        $('.gl_product_listing_category_title').addClass('third_bg').removeClass('primary_bg');

    }


}


if ($(".gl_product_listing_category_title").length) {

    var catmainid = $(".gl_cart_linkbox:first").attr('data-catmainid');

    if (catmainid == '4')
    {

        $('.gl_categorypage_name_box').html('ORDER GROCERY');

    } else
    {
        $('.gl_categorypage_name_box').html('ORDER FOOD');
    }


}



combo_product_update();

function combo_product_update()
{
//


    if ($("body").find(".gl_listing_cart_linkbox").length) {

       

//	

            $("body").find(".gl_listing_cart_linkbox").each(function () {


                var catid = $(this).attr('data-catid');



                if (catid == '3')
                {

                    $(this).removeClass("gl_ec_common_action gl_cart_linkbox gl_product_item_wrapbox").addClass("gl_combo_product_item_wrapbox");
                    $(this).find('.gl_cart_linkbox_text').html('SELECT ITEMS');

                }


            });

        }

//	 
   
//	
}


$("body").on("click", ".gl_combo_product_item_wrapbox", function () {


    var linkurl = $(this).parent().parent().parent().parent().find('.gl_product_details_link').attr('href');

   window.location.href = linkurl;


});





var url = window.location.href;
var url_array = url.split('/');
var lastvalue = url_array[url_array.length - 1];

if (lastvalue == '')
{
    $(".gl_menu_li_box:eq( 0 )").addClass('active');
} else
if (lastvalue == 'about-us')
{
    $(".gl_menu_li_box:eq( 1 )").addClass('active');
} else
if (lastvalue == 'order-food-products' || lastvalue == 'order-grocery-products')
{
    $(".gl_menu_li_box:eq( 2 )").addClass('active');
} else
if (lastvalue == 'order-fruits-product')
{
    $(".gl_menu_li_box:eq( 3 )").addClass('active');
} else
if (lastvalue == 'find-us')
{
    $(".gl_menu_li_box:eq( 5 )").addClass('active');
}


//$(document).ready(function(){
//    if($(".gl_combo_item").length>0){
//        combo_product_grouping();
//    }  
//});

$(".gl_product_details_button_block").on("click", ".gl_cart_linkbox", function () {
    if ($(".gl_combo_item").length > 0) {
        combo_product_grouping();
    }
});
function combo_product_grouping() {
    var combo_array = [];
    var i = 0;
    var productid = "";
    $(".gl_combo_item").each(function () {
        if (i == 0) {
            productid += $(this).attr("data-product_id");
        }

        var combo_item_id = $(this).children("option:selected").val();
        var combo_item_text = $(this).children("option:selected").text();

        combo_array.push({item_id: combo_item_id, item: combo_item_text});
        i++;
    });

    var my_combo = JSON.stringify(combo_array);

    var base_url = $(".base_url").val();
    $.ajax({
        type: "POST",
        data: {combo: my_combo, productid: productid},
        url: base_url + "index/product_combo",
        cache: false,
        success: function () {
        }

    });

}


$("body").on("click", ".gl_cart_product_extra_text_btn", function () {
	
    if ($(".gl_cart_product_extra_text").length > 0) {
		
var elem = $(this);		

var productid = $(this).attr('data-pid');
var iconclass = $(this).attr('data-iconclass');
var cart_product_extra_text = $(".gl_cart_product_extra_text_"+productid).val();

	if(cart_product_extra_text === ''){
	
	$(".gl_cart_product_extra_text_"+productid).focus();

	}
	else
	{		
		
		
var overlay_html = $('.gl_overlay_hidden_wrapper').html();
$('body').prepend(overlay_html);  

    var base_url = $(".base_url").val();
    $.ajax({
        type: "POST",
        data: {cart_product_extra_text: cart_product_extra_text, productid: productid},
        url: base_url + "index/cart_product_extra_text",
        cache: false,
        success: function () {
		
		$('body').find('.gl_overlay_wrapper:first').remove();
	
		
//

                        var alert_message_class = "gd_bg_clr_green";
                        var alert_message = "Order note updated successfully !";
                        var alert_parameters = {
                            alert_content: alert_message, //String
                            alert_bg_clr: alert_message_class, //String
                            alert_effect: 'alert_fade', //String
                            // avilable effect
                            // 1.alert_fade//-default
                            alert_size: 'alert_small', //String+
                            // available size
                            // 1.alert_small
                            // 2.alert_medium//-default
                            // 3.alert_large
                            alert_time: 4000, //Number
                            // 3000-default
                            alert_position: {
                                // all are null default
                                top: '', //Number/String
                                right: '', //Number/String
                                bottom: '', //Number/String
                                left: '', //Number/String
                                mesurement: '' //String
                                        // availabel mesurement
                                        // 1.px//-default
                                        // 2.%
                                        // 3.vh
                                        // 4.em
                            },
                            alert_user_classes: '', //String - pass the user defined classes separate with commas
                            // gd_txt_clr_white & gd_txt_align_center are default
                        }
                        alert_ative(alert_parameters);


//


$(elem).html('<span class="'+iconclass+'"></span>');
			
			
        }

    });	
	
	}
		
		
    }
	
	
});



$("body").on("click", ".gl_detail_counter_minus", function () {
    var itm_count = $(this).next("input[type=text]").val();

    var pid = 0;
    if ($(".gl_product_list_section_wrap_box").length) {
        var pid = $(this).parents(".gl_product_item_block").find(".gl_ec_common_action").attr('data-pid');
    }

    if (itm_count == '0') {
        updated_qty = 1;

    } else {
        var decrementr = 1;
        var updated_qty = itm_count - decrementr;

        if (updated_qty == '0') {
            updated_qty = 1;
        }
    }

    setproductquantity(updated_qty, pid);
});
$("body").on("click", ".gl_detail_counter_plus", function () {
    var itm_count = $(this).prev("input[type=text]").val();

    var pid = 0;
    if ($(".gl_product_list_section_wrap_box").length) {
        var pid = $(this).parents(".gl_product_item_block").find(".gl_ec_common_action").attr('data-pid');
    }



    if (itm_count == '0') {
        itm_count = 1;
    }
    var incrementr = 1;
    var updated_qty = Number(itm_count) + Number(incrementr);

    setproductquantity(updated_qty, pid);
});

function setproductquantity(itm_count, pid) {


    if (parseInt(itm_count) == 0)
    {
        var itm_count = 0;
    }

    if ($(".gl_product_detail_qty_input").length) {

        if ($(".gl_product_detail_price_block").length) {
            var stockqty = $("body").find(".gl_cart_linkbox").attr('data-stockqty');
        } else if ($(".gl_product_list_section_wrap_box").length) {

            var stockqty = $(".gl_ec_common_action[data-pid='" + pid + "']").attr('data-stockqty');

        }

        if (parseInt(itm_count) > parseInt(stockqty))
        {
            var itm_count = stockqty;
        }

    }


    if ($(".gl_product_detail_price_block").length) {

        $(".gl_product_detail_qty_input").val(itm_count);

        $(".gl_product_details_button_block").find('.gl_product_item_wrapbox').attr('data-qty', itm_count);
    } else if ($(".gl_product_list_section_wrap_box").length) {


        $(".gl_product_item_wrapbox-" + pid + ":first").find('.gl_product_detail_qty_input').val(itm_count);

        $(".gl_product_item_wrapbox-" + pid + ":first").find(".gl_ec_common_action[data-pid='" + pid + "']").attr('data-qty', itm_count);

    }


}

$("body").on("keyup", ".gl_product_detail_typing_qty_input", function (event) {
	
	if ($(".gl_product_detail_price_block").length) {
		 
	var qty_input = $(".gl_product_detail_typing_qty_input").val();
	
	if (qty_input == '0' || qty_input == '') {
        qty_input = 1;
		$(".gl_product_detail_typing_qty_input").val(qty_input);
    }
	

    $(".gl_product_details_button_block").find('.gl_product_item_wrapbox').attr('data-qty', qty_input);
	
	}
	
});

$("body").on("submit", ".gl_pickup_or_delivery", function (event) {
    event.preventDefault();
    var process_type = $(".gl_process_type:checked").val();
    var process_date = $(".gl_process_date").val();
    var process_time = $(".gl_process_time").val();
	
	 var order_pickup_at_shop_status = $(".gl_order_pickup_at_shop_status").val();
	 var pickup_branch = 'no';
	 
	 var proceed_to_next = 'yes';
	 
	 if(order_pickup_at_shop_status == 'yes')
	 {
		pickup_branch  = $(".gl_pickup_branch").find('option:selected').val(); 
	
if(process_type == 'delivery')
{
	
}
else
{
		if (process_type != "" && process_date != "" && process_time != "" && pickup_branch != "") 
		 { 
		 }
		 else
		 {
			 proceed_to_next = 'no';
		 }
}
		
	 }
	 else
	 {
		 if (process_type != "" && process_date != "" && process_time != "" && pickup_branch != "") 
		 {  
		 }
		 else
		 {
			 proceed_to_next = 'no';
		 }
		 
	 }
	 
	 
	
    if (proceed_to_next == "yes") {

        var base_url = $(".base_url").val();
        $.ajax({
            type: "POST",
            data: {process_type: process_type, process_date: process_date, process_time: process_time, pickup_branch: pickup_branch},
            url: base_url + "index/updateprocesstype",
            cache: false,
            success: function (response) {
                window.location = response;
            }

        });

    } else {


        var alert_message_class = "gd_bg_clr_danger";
        var alert_message = "Fields are mandatory";
        var alert_parameters = {
            alert_content: alert_message, //String
            alert_bg_clr: alert_message_class, //String
            alert_effect: 'alert_fade', //String
            // avilable effect
            // 1.alert_fade//-default
            alert_size: 'alert_small', //String+
            // available size
            // 1.alert_small
            // 2.alert_medium//-default
            // 3.alert_large
            alert_time: 4000, //Number
            // 3000-default
            alert_position: {
                // all are null default
                top: '', //Number/String
                right: '', //Number/String
                bottom: '', //Number/String
                left: '', //Number/String
                mesurement: '' //String
                        // availabel mesurement
                        // 1.px//-default
                        // 2.%
                        // 3.vh
                        // 4.em
            },
            alert_user_classes: '', //String - pass the user defined classes separate with commas
            // gd_txt_clr_white & gd_txt_align_center are default
        }
        alert_ative(alert_parameters);
    }
});



$("body").on("change", ".gl_pickup_branch", function () {

var address = $(this).find('option:selected').attr('data-address');

$(".gl_branch_address").html(address);
	
});


$("body").on("click", ".gl_process_type", function (event) {
	
pickup_at_shop_action();	
	
});

if ($(".gl_order_pickup_at_shop_status").length) {
pickup_at_shop_action();	
}

function pickup_at_shop_action()
{
	
 var process_type = $(".gl_process_type:checked").val();
 
 var order_pickup_at_shop_status = $(".gl_order_pickup_at_shop_status").val();
 //var pickup_branch_count = $(".gl_pickup_branch_count").val();
 var pickup_branch_count = '2';
	
if(order_pickup_at_shop_status == 'yes')
{

if(process_type == 'delivery')
{	
$(".gl_datetime_process_block").hide();	
if(parseInt(pickup_branch_count) > 1)
{
$(".gl_pickup_branch_block").hide();
}
}
else
{
$(".gl_datetime_process_block").show();	
if(parseInt(pickup_branch_count) > 1)
{
$(".gl_pickup_branch_block").show();
}
}
	

}

}
	




if ($(".gl_active_type_links").length) {


    $("body").find(".gl_active_type_links").each(function () {


        var url = $(this).attr('href');
        var url2 = window.location.href;


        if (url == url2)
        {
//	

            $(this).closest('.gl_link_parent_active_block').addClass('active');


//	
        }


    });
}



if ($(".gl_associate_products").length) {



    $("body").on("change", ".gl_associate_products", function () {
        var pid = $(this).find('option:selected').attr('data-pid');
        var product_name = $(this).find('option:selected').attr('data-product_name');
        var selling_price = $(this).find('option:selected').attr('data-selling_price');
        var original_price = $(this).find('option:selected').attr('data-original_price');
        var qty = $(this).find('option:selected').attr('data-qty');
        var discount_percentage = $(this).find('option:selected').attr('data-discount_percentage');
        var discount_text = $(this).find('option:selected').attr('data-discount_text');
        var discount_currency = $(this).find('option:selected').attr('data-currency');
        var product_url = $(this).find('option:selected').attr('data-prod_url');
        var prod_image = $(this).find('option:selected').attr('data-prod_image');
        var discount_status = $(this).find('option:selected').attr('data-discount_status');
        var parent_product = $(this).find('option:selected').attr('data-parent_product');





        if ($(this).hasClass("gl_associate_product_list")) {

            $(this).parents(".gl_product_item_wrapbox-"+parent_product).find('.gl_ec_common_action').attr('data-pid', pid);
            $(this).parents(".gl_product_item_wrapbox-"+parent_product).find('.gl_ec_common_action').attr('data-pname', product_name);
            $(this).parents(".gl_product_item_wrapbox-"+parent_product).find('.gl_ec_common_action').attr('data-stockqty', qty);
            $(this).parents(".gl_product_item_wrapbox-"+parent_product).find('.gl_ec_common_action').attr('data-productprice', selling_price);
            $(this).parents(".gl_product_item_wrapbox-"+parent_product).find('.gl_ec_common_action').attr('data-image', prod_image);



            var offer_text = "";
            var price_strike = "";
            if (discount_status == "yes") {
                offer_text = '<div class="gd_top_0 gd_left_15 gd_shape_rect gd_shape_rect_b primary_bg icon_offer_1 gl_product_offer_list">' + discount_text + '</div';
                $(this).parents(".gl_product_item_wrapbox-"+parent_product).find(".gl_ec_common_action[data-action_type='add_to_wishlist']").after(offer_text);
                
                price_strike = '<span class="gd_product_price_breakup gd_m_b_5 third_clr gl_product_original_price_list"><i class="' + discount_currency + '"></i>'+original_price+'</span>';
                $(this).parents(".gl_product_item_wrapbox-"+parent_product).find(".gl_product_selling_price_box").after(price_strike);
            } else {
                 $(this).parents(".gl_product_item_wrapbox-"+parent_product).find(".gl_product_offer_list").remove();
                 $(this).parents(".gl_product_item_wrapbox-"+parent_product).find(".gl_product_original_price_list").remove();
            }






            var selling_price_block = "<i class='" + discount_currency + "'></i>" + selling_price;
            $(this).parents(".gl_product_item_wrapbox").find(".gl_productname_url_box").find('a').attr('href', product_url);
            $(this).parents(".gl_product_item_wrapbox").find(".gl_productname_url_box").find('a').text(product_name);
            $(this).parents(".gl_product_item_wrapbox").find(".gl_product_listing_img_wrapper ").find('img').attr('src', prod_image);

            $(this).parents(".gl_product_item_wrapbox").find(".gl_product_selling_price_box").html(selling_price_block);
            


        } else {
            $(".gl_product_details_button_block").find('.gl_product_item_wrapbox').attr('data-pid', pid);
            $(".gl_product_details_button_block").find('.gl_product_item_wrapbox').attr('data-pname', product_name);
            $(".gl_product_details_button_block").find('.gl_product_item_wrapbox').attr('data-stockqty', qty);
            $(".gl_product_details_button_block").find('.gl_product_item_wrapbox').attr('data-productprice', selling_price);



            $(".gl_product_name_box").html(product_name);
            $(".gl_product_selling_price_box").html(selling_price);
            $(".gl_product_original_price_box").html(original_price);
            $(".gl_product_offer_text_box").html(discount_text);
        }


    });



}


$("body").find(".dropdown_megamenu").each(function () {

    var data_url = $("body").find('.dropdown_megamenu_left').find('li:first').find('a').attr('data-megamenu-img-url');
    $(this).find('img').attr("src", data_url);



});

//$(window).on("load", function() {
//    var cat_id = $(".gl_parent_category_menu").find(".gl_category_menu_item:first").attr("data-item_id");
//    var fetch_item = $(".gl_parent_category_menu").find(".gl_category_menu_item:first").attr("data-fetch");
//    fetch_item_data(cat_id, fetch_item);
//});

$(document).on("mouseover", ".gl_all_cat_main_menu", function () {
    $(".gl_product_category_menu").html("");
    $(".gl_product_menu").html("");
    var cat_id = $(".gl_parent_category_menu").find(".gl_category_menu_item:first").attr("data-item_id");
    var fetch_item = $(".gl_parent_category_menu").find(".gl_category_menu_item:first").attr("data-fetch");
    var fetch_image = $(".gl_parent_category_menu").find(".gl_category_menu_item:first").attr("data-image");
    fetch_item_data(cat_id, fetch_item, fetch_image);

});
$(document).on("mouseover", ".gl_category_menu_item", function () {
    var cat_id = $(this).attr("data-item_id");
    var fetch_item = $(this).attr("data-fetch");
    var fetch_image = $(this).attr("data-image");
    fetch_item_data(cat_id, fetch_item, fetch_image);
});


function fetch_item_data(parent_id, fetch_item, fetch_image) {
    $(".gl_cat_image").attr("src", fetch_image);
    var base_url = $(".base_url").val();
//    var loader = "<img src='" + base_url + "static/gl_build/common/images/loading.gif'>";
    var loader = "<div class='loader'></div>";
    if (fetch_item == "category") {
        $(".gl_product_category_menu").html(loader);
    }
    if (fetch_item == "product") {
        $(".gl_product_menu").html(loader);
    }


    $.ajax({
        url: base_url + "index/fetch_item_data",
        data: {parent_id: parent_id, fetch_item: fetch_item},
        type: "POST",
        success: function (response)
        {

            var response_set = JSON.parse(response);
            var count = response_set.count;
            var list_view = response_set.list_view;

            if (count > 0) {

                if (fetch_item == "category") {
                    $(".gl_product_category_menu").html(list_view);

                    var cat_id = $(".gl_product_category_menu").find(".gl_category_menu_item:first").attr("data-item_id");
                    var fetch_item1 = $(".gl_product_category_menu").find(".gl_category_menu_item:first").attr("data-fetch");
                    var fetch_image1 = $(".gl_product_category_menu").find(".gl_category_menu_item:first").attr("data-image");
                    fetch_item_data(cat_id, fetch_item1, fetch_image1);

                }
                if (fetch_item == "product") {
                    $(".gl_product_menu").html(list_view);
                }
                megamenuScroll();
            }
            if (count == 0 && fetch_item == "category") {
                $(".gl_product_category_menu").html("");
                $(".gl_product_menu").html("");
            }
            if (count == 0 && fetch_item == "product") {
                $(".gl_product_menu").html("");
            }
        }
    });
}


if ($(".gl_backto_main_detail").length) {
	
var base_url = $(".base_url").val();

    var catmainid = $(".gl_product_details_button_block").find(".gl_cart_linkbox:first").attr('data-catmainid');

    if (catmainid == '2')
    {

        $('.gl_backto_main_detail').html('Order Food');
		$('.gl_backto_main_detail').attr('href',base_url+'order-food');

    } else
    {
        $('.gl_backto_main_detail').html('Order Grocery');
		$('.gl_backto_main_detail').attr('href',base_url+'order-grocery');
    }


}


$("body").on("click", ".gl_mycart_continue_popup_link", function () 
{

setTimeout(function () {
$('.mycart_popup_wrap').removeClass('active');
}, 100);	
	
});


if ($(".gl_page_main_category_list_block").length) {

var page_main_category_id = $("body").find('.gl_continue_to_mycart').attr('data-page_main_category_id');	

if(page_main_category_id == '2')
{
$('.gl_page_main_category_list_block').removeClass('active');	
$('.gl_page_main_category_list_block:eq( 0 )').addClass('active');	
}
else
if(page_main_category_id == '5')
{
$('.gl_page_main_category_list_block').removeClass('active');	
$('.gl_page_main_category_list_block:eq( 1 )').addClass('active');		
}


}
