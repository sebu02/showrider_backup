$(document).ready(function ()
{


	
});




$('.gl_input_disable').keydown(function(e) {
   e.preventDefault();
   return false;
});

$('.gl_input_disable').bind('copy cut paste', function (e) {
        e.preventDefault();
		return false;
    });




$('body').on('click', '.gl_click_for_featurebox_238', function()
{	

$(".wrapper_featurebox_238").fadeIn();

});


$('body').on('click', '.gl_click_for_featurebox_254', function()
{	

$(".wrapper_featurebox_254").fadeIn();

});


$('body').on('click', '.gl_paytype_action', function()
{	
	
var paytypeid = $(this).find('.gd_radio').val();

if($(".gl_product_list_section_wrap_box").length)
{

if(paytypeid == '6')
{
$(this).closest(".gl_product_list_section_wrap_box").find('.gl_price_breakup_wrapper').fadeIn();
}
else
{
$(this).closest(".gl_product_list_section_wrap_box").find('.gl_price_breakup_wrapper').hide();	
}
	
	
}
else
{

if(paytypeid == '6')
{
$('body').find('.gl_price_breakup_wrapper').fadeIn();
}
else
{
$('body').find('.gl_price_breakup_wrapper').hide();	
}

}



	
	
});

$('.gl_paytype_product_box_design').on('click', '.gl_paytype_action', function()
{
	
var paytypeid = $(this).find('.gd_radio').val();

if(paytypeid == '6')
{
	
$( '[data-listing="list"]' ).trigger( "click" );	
	
}
else
{

$( '[data-listing="grid"]' ).trigger( "click" );	
	
}


$('body').find('.gl_price_breakup_wrapper').show();

	
});


if($(".gl_mycart_payment_types").length)
{

$(".gl_mycart_payment_types").find( ".gd_radio:eq( 1 )" ).prop('checked',true);

var dataString = "" ;
    var base_url = $(".base_url").val();
    $.ajax({
        type: "POST",
        url: base_url + "index/check_mycart_payment_type/",
        data: dataString,
        cache: false,
        success: function (html) {
			
			if(html != '')
			{
			$(".gd_radio[value="+html+"]").prop('checked', true);	
			}

        }
    });

}


$('.gl_mycart_payment_types').on('click', '.gl_mycart_payment', function()
{

var payment_typeid = $(this).val();


var dataString = "payment_typeid=" + payment_typeid ;
    var base_url = $(".base_url").val();
    $.ajax({
        type: "POST",
        url: base_url + "index/update_cart_paymenttype/",
        data: dataString,
        cache: false,
        success: function (html) {

        }
    });



});



function do_paytype_auto_tigger()
{

var paytypeid = $('.gl_paytype_product_box_design').find('.gd_radio:checked').val();
	
if(paytypeid == '6')
{
$('body').find('.gl_price_breakup_wrapper').show();	
}


	
}


//get a quote section start

if($(".gl_quote_next_nav_btn").length){
	

	
var currenturl = window.location.href;	

var url_splite = currenturl.split("?");	
	
var button_url = $(".gl_quote_next_nav_btn:last").attr('href');
	
$(".gl_quote_next_nav_btn:last").attr('href',button_url+'?'+url_splite[1]);

	
}


//step 1
$('body').on('click', '.gl_std_feature_class_check', function()
{	

$(this).parents('.hover_overlay_effect1').toggleClass('checked');
if ($(this).parents('.hover_overlay_effect1').hasClass('checked')) {
$(this).parents('.hover_overlay_effect1.checked').find('.gd_radio').attr('checked','checked');

}
else
{
$(this).parents('.hover_overlay_effect1').find('.gd_radio').removeAttr('checked');

}
	
get_quote_std_feature()	;
	
});


function get_quote_std_feature()
{
	var inputvaluesarray = '';
	$(".gl_std_feature_class").each(function() {
	if(this.checked) {
	inputvaluesarray = inputvaluesarray+$(this).val()+"-";
	}
	});

var gl_std_feature_array = inputvaluesarray;

gl_std_feature_array = gl_std_feature_array.substring(0, gl_std_feature_array.length - 1);
	

var quoteid = getUrlParameter('quote');	
	
	
var dataparameter = "type=std_feature&std_feature="+gl_std_feature_array+"&quoteid="+quoteid;
quote_save_request('std_feature',dataparameter);

}

//step 1


//step 2

$(".gl_product_customize_link").hide();
if($(".gl_product_customize_link").length){
	
var currenturl = window.location.href;	

var url_splite = currenturl.split("?");
	

var inputvaluesarray2 = '';
	$(".gl_product_customize_link").each(function() {
	
	inputvaluesarray2 = inputvaluesarray2+$(this).attr('pid')+"-";
	
//
var product_customize_link = $(this).attr('href');
var product_customize_link_splite = product_customize_link.split("?");


$(this).attr('href',product_customize_link_splite[0]+'?'+url_splite[1]+'&'+product_customize_link_splite[1]);

//
	
	});

var gl_product_customize_array = inputvaluesarray2;

gl_product_customize_array = gl_product_customize_array.substring(0, gl_product_customize_array.length - 1);	

var full_customize_href = $(".gl_all_product_customize_link:first").attr('href');

$(".gl_all_product_customize_link:first").attr('href',full_customize_href+'?'+url_splite[1]+'&cpid='+gl_product_customize_array);
	

//
$(".gl_product_customize_link").show();
//	
}

//step 2


//step 3

if($(".gl_quote_product_customize").length){


var quoteid = getUrlParameter('quote');	
var cpid = getUrlParameter('cpid');	
	
var dataparameter = "type=cpid&cpid="+cpid+"&quoteid="+quoteid;
quote_save_request('cpid',dataparameter);	
	
}

//step 3

//step 4


if($(".gl_property_type_class_check").length)
{
var quoteid = getUrlParameter('quote');	
var qtype = getUrlParameter('qtype');	
	
var dataparameter = "type=qtype&qtype="+qtype+"&quoteid="+quoteid;
quote_save_request('qtype',dataparameter);

var nexturl = $(".gl_quote_next_nav_btn:last").attr('href');
var url_splite = nexturl.split("?");

$(".gl_quote_next_nav_btn:last").attr('href',url_splite[0]+'?quote='+quoteid);

}


$('body').on('click', '.gl_property_type_class_check', function()
{	
         $('.hover_overlay_effect2').removeClass('checked').find('.gd_radio').removeAttr('checked');
        $(this).parents('.hover_overlay_effect2').addClass('checked').find('.gd_radio').attr('checked','checked');
		
get_quote_property_type();

   
    
});


function get_quote_property_type()
{
	
var inputvaluesarray3 = '';
	$(".gl_property_type_class").each(function() {
	if(this.checked) {
	inputvaluesarray3 = inputvaluesarray3+$(this).val()+"-";
	}
	});

var gl_property_type_array = inputvaluesarray3;

gl_property_type_array = gl_property_type_array.substring(0, gl_property_type_array.length - 1);

var quoteid = getUrlParameter('quote');		
	
var dataparameter = "type=property_type&property_type="+gl_property_type_array+"&quoteid="+quoteid;
quote_save_request('property_type',dataparameter);


}


//step 4


//step 5

$('.gl_quote_doors').on('change', '.gl_quote_standard_addons', function()
{	

var doorsno = $(this).val();

var label = 'door';

get_quote_standard_addons(doorsno,label);
    
});

$('.gl_quote_rooms').on('change', '.gl_quote_standard_addons', function()
{	

var roomsno = $(this).val();

var label = 'room';

get_quote_standard_addons(roomsno,label);
    
});


$('.gl_quote_perimeters').on('change', '.gl_quote_standard_addons', function()
{	

var perimeternos = $(this).val();

var label = 'perimeter';

get_quote_standard_addons(perimeternos,label);
    
});

$('body').on('click', '.gl_quote_service_class', function()
{	

var service = $(this).val();

var label = 'service';

get_quote_standard_addons(service,label);
    
});

$('body').on('click', '.gl_quote_installation_class', function()
{	

var install = $(this).val();

var label = 'install';

get_quote_standard_addons(install,label);
    
});


function get_quote_standard_addons(nos,label)
{

var quoteid = getUrlParameter('quote');		
	
var dataparameter = "type="+label+"&"+label+"="+nos+"&quoteid="+quoteid;
quote_save_request(label, dataparameter);

}



//


//step 5



function quote_save_request(type,dataString)
{
    
    var base_url = $(".base_url").val();
    $.ajax({
        type: "POST",
        url: base_url + "index/savegetaquote/",
        data: dataString,
        cache: false,
        success: function (html) {

        }
    });

}

//get a quote section end



	


