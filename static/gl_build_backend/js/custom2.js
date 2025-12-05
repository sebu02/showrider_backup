
//$(window).load(function() {
	
//setTimeout(function(){
		
//$("#qLoverlay").css('opacity','0.8');
//$("#qLoverlay").show();;
//$("#qLbar").show();

//lightWeightPage();
		
// }, 2000);

//});

$(document).ready(function() { 

//lightWeightPage();

});


function lightWeightPage() {
    var base_url = $(".base_url").val();
    $.ajax({
        //url: base_url + 'common_controller/lightWeightPageAction',
		url: base_url + 'common_controller/lightWeightPageAction_curl',
        async: false,
        type: "POST",
        data: {},
        cache: false,
        success: function () {
            
			WriteCustomStructureBox()
        }
    });
}


function WriteCustomStructureBox() {
    var base_url = $(".base_url").val();
    $.ajax({
		url: base_url + 'common_controller/WriteCustomStructureBox_url',
        async: false,
        type: "POST",
        data: {},
        cache: false,
        success: function () {
		
			WriteCacheUpdatedCache();
        }
    });
}



function WriteCacheUpdatedCache() {
    var base_url = $(".base_url").val();
    $.ajax({
        //url: base_url + 'index/WriteCacheUpdatedCache',
		url: base_url + 'common_controller/WriteCacheUpdatedCache_url',
        async: false,
        type: "POST",
        data: {},
        cache: false,
        success: function () {
			
		
		//$("#qLoverlay").css('opacity','0');
		//$("#qLoverlay").hide();;
		//$("#qLbar").hide();
			
			
        }
    });
}


//
if($(".gl_wrapper_category_type").length)
{
	
var wrapper_category_type = $(".gl_wrapper_category_type:checked").val();
       
wrapper_category_block(wrapper_category_type);

}

    $("body").on("change", ".gl_wrapper_category_type", function () {
		
 var value = $(this).val();
 
 wrapper_category_block(value);
       
    });

function wrapper_category_block(value)
{
	
		
if(value == 'structure')
{
		 	$(".gl_wrapper_structure_container").show();
			$(".gl_wrapper_featurebox_structure").prop("required", true);
			
			$(".gl_wrapper_feature_name_container").hide();
			$(".gl_wrapper_feature_name").prop("required", false);
		
}
else
if(value == 'featurebox')
{
			$(".gl_wrapper_feature_name_container").show();
			$(".gl_wrapper_feature_name").prop("required", true);
			
		 	$(".gl_wrapper_structure_container").hide();
			$(".gl_wrapper_featurebox_structure").prop("required", false);
			
		
}
else
{
			$(".gl_wrapper_feature_name_container").hide();
			$(".gl_wrapper_feature_name").prop("required", false);
			
		 	$(".gl_wrapper_structure_container").hide();
			$(".gl_wrapper_featurebox_structure").prop("required", false);
		
}
}

//



//

if($(".gl_wrapper_use_type").length)
{
	
var wrapper_use_type = $(".gl_wrapper_use_type:checked").val();
       
wrapper_usetype_block(wrapper_use_type);

}

    $("body").on("change", ".gl_wrapper_use_type", function () {
		
 var value = $(this).val();
 
 wrapper_usetype_block(value);
       
    });
	
function wrapper_usetype_block(value)
{
	
		
if(value == 'element')
{
		 	$(".gl_wrapper_elements_div").show();
			$(".gl_wrapper_element_value").prop("required", true);
			
}
else
{
			$(".gl_wrapper_elements_div").hide();
			$(".gl_wrapper_element_value").prop("required", false);
		
}
}
	
//	


$('body').on('click', '.create_shiprocket_order', function () {

var url = $(this).attr('data-url');
var shipping_box_list = $(".gl_shipping_box_list option:selected").val();

if(shipping_box_list == '')
{
$(".gl_shipping_box_list_error").html('Select Shipping Box First !');	
}
else
{
$(".gl_shipping_box_list_error").html('');

window.location = url+"&boxno="+shipping_box_list;

}
            

});


$('body').on('click', '.split_order_by_qty', function () {

var url = $(this).attr('data-url');

var ordered_qty_total = 0;
var choosed_products = '';
$( ".gl_ordered_product_qty_list" ).each(function() {
  ordered_qty_total += parseInt($( this ).val());
  choosed_products += $( this ).attr("data-pid")+"-"+$( this ).val()+"_";
});


if(ordered_qty_total == 0)
{
$(".gl_ordered_product_qty_list_error").html('Select Ordered Qty To Split !');		
}
else
{

if(parseInt(ordered_qty_total) <= 6)
{	
	
	if(choosed_products)
	{
	$(".gl_shipping_box_list_error").html('');
	
        if (confirm("Do you really want to continue ?")) {
            window.location.href = url+"&pid="+choosed_products;;
        }
	
	}
}
else
{
$(".gl_ordered_product_qty_list_error").html('Please choose qty upto 6 items !');			
}

}
            

});


$('.sort-layout div[class*="span"]').sortable({
	connectWith: '.sort-layout div[class*="span"]',
	handle: '.dragitem',
	placeholder: "sortable-placeholder",
	forcePlaceholderSize: true,
	helper: 'original',
	forceHelperSize: true,
	cursor: "move",
	/*delay: 150,
	distance: 5,*/
	opacity: 0.8,
	tolerance: "pointer",
	/*start: function(e, ui){
		ui.placeholder.height(ui.item.height());
	}*/
	
});



$('body').on('click', '.minimum_cart_status', function () {
	

var minimum_cart_status = $(this).val();

if(minimum_cart_status == 'yes')
{
$('#minimum_cart_amount').prop('required',true);
}
else
{
$('#minimum_cart_amount').prop('required',false);	
}
	
	
});
	
	

