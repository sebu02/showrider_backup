/*
 * GL Common Start
 */
function savevisitors(page, rsegment, width)
{

    var dataString = "page=" + page + "&rsegment=" + rsegment + "&width=" + width;
    var base_url = $(".base_url").val();
    $.ajax({
        type: "POST",
        url: base_url + "index/savevistors/",
        data: dataString,
        cache: false,
        success: function (html) {

        }
    });

}
function savewindowwidth(width)
{
    var dataString = "width=" + width;
    var base_url = $(".base_url").val();
    $.ajax({
        type: "POST",
        url: base_url + "index/savewindowwidth/",
        data: dataString,
        cache: false,
        success: function (html) {

        }
    });

}
/*
 * GL Common End 
 */

/*
 * GL Form Start
 */
function ValidateEmail(email) {
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return expr.test(email);
}

function SubmitForm(formclass)
{
    $("." + formclass).submit();
}
/*
 * GL Form End
 */
 
 
 function getUrlParameter(sParam)
{
    hash = window.location.href;
	
	if(hash.indexOf("?") >= 0)
	{

		var new_hash=hash.split('?');	
		
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





function getUrlParameter2(datastring,sParam)
{

			var sURLVariables = datastring.split('&');
			
			for (var i = 0; i < sURLVariables.length; i++) 
			{
				var sParameterName = sURLVariables[i].split('=');
				if (sParameterName[0] == sParam) 
				{
					return sParameterName[1];
				}
			}
	
	
}    

 


/*
 * GL Shopping Cart Start
 */
   /* $("body").on("click", ".gl_ec_common_action", function () {

        var base_url = $(".base_url").val();
		var elem = $(this);
		
        var action_type = $(this).attr("data-action_type");
        var response_effect = "";
        var dataString = "action_type=" + action_type;
		
		var gorequest = "yes";

            if (action_type == "add_to_cart" || action_type == "add_to_wishlist" || action_type == "add_to_compare") {

                var pid = $(this).attr("data-pid");
                var qty = $(this).attr("data-qty");
                var effect = $(this).attr("data-effect");
				
				var image = $(this).attr("data-image");
				var pname = $(this).attr("data-pname");
				
				
                var response_effect = effect;
                dataString += "&pid=" + pid + "&qty=" + qty;
            }
			
if (action_type == "check_qty")
{

var request = $(this).closest('.gl_ec_common_action_parent').attr("data-request");

if(request == 'yes')
{
gorequest = 'no';	
}
else
{
gorequest = 'yes';	
}

//
$(this).closest('.gl_ec_common_action_parent').attr("data-request", "yes"); 
//



var qty_type = $(this).attr("data-qty_type");
var qty = 1;
if(qty_type =='plus')
{
var $input = $(this).siblings('input');

qty = parseInt($input.val()) + 1 ;

//$input.val(qty);
	
}
else
if(qty_type =='minus')
{
//
var $input = $(this).siblings('input');
qty = parseInt($input.val()) - 1;
if(qty == 0)
{
qty = 1;	
}
//$input.val(qty);

//	
}

var pid = $(this).closest('.gl_ec_common_action_parent').attr("data-pid");
	
dataString += "&pid=" + pid + "&qty=" + qty;	
}


if(gorequest == 'yes')
{

            $.ajax({
                type: "POST",
                url: base_url + "common_controller/common_ec_actions",
                data: dataString,
                cache: false,
                success: function (response)
                {

if (action_type == "add_to_cart") {	
				
if(response == 'update')
{
$(".gl_cart_custom_message").html('Item has been Updated to cart');   
}
else
if(response == 'update')
{
$(".gl_cart_custom_message").html('Item has been added to cart');   
}

$(".gl_cart_cutom_image").attr("src", base_url+'media_library/original_'+image);

$(".gl_cart_cutom_name").html(pname);

//
var scroll_pos = $(window).scrollTop();
        if (scroll_pos != 0) {
            $("html, body").animate({
                scrollTop: (scroll_pos - 10)
            }, 300);
        }
        $('.mycart_popup_wrap').addClass('active');

        setTimeout(function() {
            $('.mycart_popup_wrap').removeClass('active');
        }, 3000);
		
		//

}
else
if(action_type == "add_to_wishlist")
{
window.location=base_url+"wishlist";	
}
else
if(action_type == "add_to_compare")
{
window.location=base_url+"comparelist";	
}
else
if(action_type == "check_qty")
{
	if(response == '2')
	{
	$input.val(qty);
	}
$(elem).closest('.gl_ec_common_action_parent').attr("data-request", "no");	

var cartrowid = $(elem).closest('.gl_ec_common_action_parent').attr("data-cartrowid");

var dataparameter = '&qty='+qty+'&cartrowid='+cartrowid;

common_request_results('update_qty',dataparameter);

}



                }
            });

			
}


});*/


 $("body").on("click", ".gl_ec_common_action", function () {

        var base_url = $(".base_url").val();
		var elem = $(this);
		
        var action_type = $(this).attr("data-action_type");
        var response_effect = "";
        var dataString = "action_type=" + action_type;
		
		var gorequest = "yes";

            if (action_type == "add_to_cart" || action_type == "add_to_wishlist" || action_type == "add_to_compare" || action_type == "delete_from_cart" || action_type == "delete_from_wishlist" || action_type == "delete_from_compare") {

                var pid = $(this).attr("data-pid");
                var qty = $(this).attr("data-qty");
                var effect = $(this).attr("data-effect");
				
				var image = $(this).attr("data-image");
				var pname = $(this).attr("data-pname");
				
				
                var response_effect = effect;
				
dataString += "&pid=" + pid + "&qty=" + qty + "&image=" + image + "&pname=" + pname;
            }


if (action_type == "add_to_cart")
{
	
if($(".gl_mycart_main_wrapper").length)
{	
//	
var overlay_html = $('.gl_overlay_hidden_wrapper').html();
$('.gl_mycart_main_wrapper').prepend(overlay_html);
//	
}	
	
}


if (action_type == "check_qty")
{

//	
var overlay_html = $('.gl_overlay_hidden_wrapper').html();
$('.gl_mycart_main_wrapper').prepend(overlay_html);
//	
	

var request = $(this).closest('.gl_ec_common_action_parent').attr("data-request");
var cartrowid = $(elem).closest('.gl_ec_common_action_parent').attr("data-cartrowid");

if(request == 'yes')
{
gorequest = 'no';	
}
else
{
gorequest = 'yes';	
}

//
$(this).closest('.gl_ec_common_action_parent').attr("data-request", "yes"); 
//



var qty_type = $(this).attr("data-qty_type");
var qty = 1;
if(qty_type =='plus')
{
var $input = $(this).siblings('input');

qty = parseInt($input.val()) + 1 ;

//$input.val(qty);
	
}
else
if(qty_type =='minus')
{
//
var $input = $(this).siblings('input');
qty = parseInt($input.val()) - 1;
if(qty == 0)
{
qty = 1;	
}
//$input.val(qty);

//	
}

var pid = $(this).closest('.gl_ec_common_action_parent').attr("data-pid");
	
dataString += "&pid=" + pid + "&qty=" + qty + "&cartrowid=" + cartrowid;	

}


if (action_type == "delete_from_cart")
{
	
//	
var overlay_html = $('.gl_overlay_hidden_wrapper').html();
$('.gl_mycart_main_wrapper').prepend(overlay_html);
//	
	
var cartrowid = $(this).attr("data-cartrowid");
dataString += "&cartrowid=" + cartrowid ;
	
}

if (action_type == "delete_from_wishlist" || action_type == "delete_from_compare")
{
	
var boxid = $(this).attr("data-boxid");
dataString += "&boxid=" + boxid ;
	
}


dataString += "&gorequest=" + gorequest ;	

if(gorequest == 'yes')
{
	
common_request_results(action_type,dataString)	
	
}


});


if($(".mycart_price_block").length)
{
	
//	
var overlay_html = $('.gl_overlay_hidden_wrapper').html();
$('.gl_mycart_main_wrapper').prepend(overlay_html);
//
	
var dataparameter = "gorequest=yes&action_type=total_cart_price";
common_request_results('total_cart_price',dataparameter);

$(".fixing_block_custom").hide();
 
	
}

if($(".gl_total_cart_count_class").length)
{
	
var dataparameter = "gorequest=yes&action_type=total_cart_count";
common_request_results('total_cart_count',dataparameter);

}


if($(".gl_total_cart_count_class").length)
{
	
var dataparameter = "gorequest=yes&action_type=total_cart_split_count";
common_request_results('total_cart_split_count',dataparameter);

}



/*function common_request_results(action_type,dataparameters)
{
//


var base_url = $(".base_url").val();

var dataString = "action_type=" + action_type;

var gorequest = "yes";

dataString += dataparameters;

if(gorequest == 'yes')
{

            $.ajax({
                type: "POST",
                url: base_url + "common_controller/common_ec_actions",
                data: dataString,
                cache: false,
                success: function (response)
                {
				
				if(action_type == "update_qty")
				{
				     common_request_results('total_cart_price','');
				}
				else
				if(action_type == "total_cart_price")
				{
				     $('.total_cart_price').html(response);
				}
				
				
				}
            });

			
}

//	
}*/



function common_request_results(action_type,dataString)
{
	
var base_url = $(".base_url").val();

var gorequest = getUrlParameter2(dataString,'gorequest');	

var datastringvalues = dataString ;

if(gorequest == 'yes')
{

            $.ajax({
                type: "POST",
                url: base_url + "common_controller/common_ec_actions",
                data: dataString,
                cache: false,
                success: function (response)
                {

if (action_type == "add_to_cart") {	
				
if(response == 'update')
{
$(".gl_cart_custom_message").html('Item has been Updated to cart');   
}
else
if(response == 'update')
{
$(".gl_cart_custom_message").html('Item has been added to cart');   
}

var image = getUrlParameter2(dataString,'image');
var pname = getUrlParameter2(dataString,'pname');

$(".gl_cart_cutom_image").attr("src", base_url+'media_library/original_'+image);

$(".gl_cart_cutom_name").html(pname);

//
var scroll_pos = $(window).scrollTop();
        if (scroll_pos != 0) {
            $("html, body").animate({
                scrollTop: (scroll_pos - 10)
            }, 300);
        }
        $('.mycart_popup_wrap').addClass('active');

        setTimeout(function() {
            $('.mycart_popup_wrap').removeClass('active');
        }, 3000);
		
		//
		

var dataparameter = "gorequest=yes&action_type=total_cart_count";
common_request_results('total_cart_count',dataparameter);	
		
var dataparameter = "gorequest=yes&action_type=total_cart_price";
common_request_results('total_cart_price',dataparameter);

}
else
if(action_type == "add_to_wishlist")
{
window.location=base_url+"wishlist";	
}
else
if(action_type == "add_to_compare")
{
window.location=base_url+"comparelist";	
}
else
if(action_type == "check_qty")
{
	
	if(response == '2')
	{

var qty = getUrlParameter2(datastringvalues,'qty');
var cartrowid = getUrlParameter2(datastringvalues,'cartrowid');
		
$(".gl_ec_common_action_parent[data-cartrowid='"+cartrowid+"']").find('.gl_mycart_qty_input').val(qty);
	
	}
	
$(".gl_ec_common_action_parent[data-cartrowid='"+cartrowid+"']").attr("data-request", "no");	

var cartrowid = $(".gl_ec_common_action_parent[data-cartrowid='"+cartrowid+"']").attr("data-cartrowid");

var dataparameter = '&qty='+qty+'&cartrowid='+cartrowid+"&gorequest=yes&action_type=update_qty" ;

common_request_results('update_qty',dataparameter);

}
else
if(action_type == "update_qty")
{

var dataparameter = "gorequest=yes&action_type=total_cart_count";
common_request_results('total_cart_count',dataparameter);
	
var dataparameter = "gorequest=yes&action_type=total_cart_price";
common_request_results('total_cart_price',dataparameter);
}
else
if(action_type == "total_cart_price")
{
//$('.total_cart_price').html(response);

var cart_total_array = JSON.parse(response);
    obj = cart_total_array;
    $.each(obj, function (objkey, objvalue) {
		
		$('.'+objkey).html(objvalue);
		
	});

//
$('.gl_mycart_main_wrapper').find('.gl_overlay_wrapper').remove();
//

}
else
if(action_type == "total_cart_count")
{

$('.gl_total_cart_count_class').html(response);

}
else
if(action_type == "total_cart_split_count")
{

var cart_total_array = JSON.parse(response);
    obj = cart_total_array;
    $.each(obj, function (objkey, objvalue) {
		
		$('.count_'+objkey).html(' ('+objvalue+') ');
		
	});


}
else
if(action_type == "delete_from_cart")
{

var dataparameter = "gorequest=yes&action_type=total_cart_count";
common_request_results('total_cart_count',dataparameter);	
	
var dataparameter = "gorequest=yes&action_type=total_cart_price";
common_request_results('total_cart_price',dataparameter);

var cartrowid = getUrlParameter2(datastringvalues,'cartrowid');

$('.gl_cart_item_wrapbox-'+cartrowid).fadeOut();

}
else
if(action_type == "delete_from_wishlist")
{

var boxid = getUrlParameter2(dataString,'boxid');

$('.gl_product_item_wrapbox-'+boxid).fadeOut();

}
else
if(action_type == "delete_from_compare")
{

window.location=base_url+"comparelist";	

}






                }
            });

			
}


}



//temp search actions

$(".searchinputbutton1").click(function () {

searchinput1();

});


$(".searchinput1").keyup(function (e) {

if (e.which == 13) {

searchinput1();

}

});


function searchinput1()
{

var base_url = $(".base_url").val();

if ($(".searchinput1").val() != '') {

                var name = $(".searchinput1").val();

				var name = name.replace(/\//g," ");
	
				var name = name.replace(/\s/g,"|");
				
				var name = '~'+name+'~';
				

				window.location = base_url+'search-products?s=' + name ;


            }

            else {

                $(".searchinput1").focus();

            }	
	
	
}


//temp search actions

//Block After Page Load
//$(document).ready(function() { 

 $(window).on('load', function () {
	 
	 
setTimeout(function(){

if($(".afterload-featurebox").length)
{

$(".afterload-featurebox").each(function() {	

var featurebox_id = $(this).attr('data-featurebox_id');
var boxtype = $(this).attr('data-boxtype');
var relation_with_id = $(this).attr('data-relation_with_id');

//

var dataString = "featurebox_id=" + featurebox_id+"&relation_with_id=" + relation_with_id;
var base_url = $(".base_url").val();
$.ajax({
type: "POST",
url: base_url + "index/pageblockafterload/",
data: dataString,
cache: false,
success: function (html) {


$(html).insertAfter(".afterload-featurebox"+featurebox_id).hide().fadeIn();	

//
if(boxtype == '3')
{

	if ($('body').find('.owl-carousel').length) {
	owlslider();
	}

}
//

$(".afterload-featurebox"+featurebox_id).remove();

//header_height_to_margin(true);

LoadCompressedImags();


}
});

//
		
});

}


},500);

});
//Block After Page Load


//Compressed Image Load
//$(document).ready(function() {
	
$(window).on('load', function () {	
	
LoadSingleCompressedImage() ;	
	
});	


function LoadCompressedImags()
{

if($("body").find(".gl_compressed_image_load").length)
{	
LoadSingleCompressedImage()	
}

}

function LoadSingleCompressedImage()
{
	
if($("body").find(".gl_compressed_image_load").length)
{	
	
	var elem = $("body").find(".gl_compressed_image_load:first");

	var original_image = $(elem).attr('data-compress');
	
	//$(this).attr("src",original_image);
	
	//$(this).attr("src",original_image).stop(true,true).hide().fadeIn();

	/*$(this).fadeOut(100, function() {
            $(this).attr('src',original_image);
			$(this).removeClass("gl_compressed_image_load");
        })
        .fadeIn();*/
		
//

$('<img src="'+original_image+'">').on('load', function() {


if($('<img src="'+original_image+'">').prop('complete'))
{

$(elem).attr("src",original_image);	

//$(elem).removeAttr("width");
//$(elem).removeAttr("height");
$(elem).removeClass("gl_compressed_image_load");	
$(elem).removeClass("gl_image_blur");

LoadSingleCompressedImage();

}
	
		

});
//
	
	
	
/*	$(this).on('load', function() {
	
	if($(this).prop('complete'))
	{
	
	$(this).removeAttr("width");
	$(this).removeAttr("height");
	$(this).removeClass("gl_compressed_image_load");	
		
	}
	   
	});*/



}
	
}

//Compressed Image Load

/*var width = $(window).width();

if(parseInt(width) < 600)
{
	

$('body').on('click', 'a', function(e)
{
	


e.preventDefault();

var href_url = $(this).attr('href');

var dataString = "";
$.ajax({
type: "POST",
url: href_url,
data: dataString,
cache: false,
success: function (html) {
	
$('body').html(html);	
	
}
});


   


});	
	
	
}*/
	
	




/*
 * GL Shopping Cart End
 */