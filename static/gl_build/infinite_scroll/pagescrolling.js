var request;
$.extend({
    getUrlVars: function (type) {
        if (type == "array_data") {
            var vars = [];
        } else if (type == "object_data") {
            var vars = {};
        }
        var parameter_values;

        var get_parameters_array = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

        for (var i = 0; i < get_parameters_array.length; i++)
        {
            parameter_values = get_parameters_array[i].split('=');
//            vars.push(hash[0]);
            vars[parameter_values[0]] = parameter_values[1];
        }
        return vars;
    },
    getUrlVar: function (name) {
        return $.getUrlVars("array_data")[name];
    }
});


function showObjectjQuery(obj) {
//JavaScript function iterate through object keys and values
// and return it as string
    var result = "";
    var objcount = Object.keys(obj).length;
    var i = 1;
    $.each(obj, function (objkey, objvalue) {
        result += objkey + "=" + objvalue;
        if (i < objcount) {
            result += "&";
        }
        i++;
    });
    return result;

}

function inArray(needle, haystack) {
    var length = haystack.length;
    for (var i = 0; i < length; i++) {
        if (haystack[i] == needle)
            return true;
    }
    return false;
}


function action_scroll_start() {
    var e = $(".base_url").val();
    var t = e.trim();
    $(".gl_product_list_section_wrap_box").append('<img src="' + t + 'static/images/loader3.gif" width="25" class="products_loding">');
    $(".gl_product_list_section_wrap_box DIV").css("opacity", "0.8");

}

function action_scroll_complete() {
    $(".products_loding").remove();
    $(".gl_product_list_section_wrap_box DIV").css("opacity", "");

}

function getUrlParameter(sParam) {
    hash = window.location.hash;

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

function replaceUrlParam(url, paramName, paramValue) {
    var pattern = new RegExp('(\\?|\\&)(' + paramName + '=).*?(&|$)');
    var newUrl = url;
    if (url.search(pattern) >= 0) {
        newUrl = url.replace(pattern, '$1$2' + paramValue + '$3');
    } else {
        newUrl = newUrl + (newUrl.indexOf('?') > 0 ? '&' : '?') + paramName + '=' + paramValue;
    }
    return newUrl;
}
function querystringtojsonobject(input) {
//debugger;
    var output = input.split('&').reduce(function (o, pair) {

        pair = pair.split('=');
        if (pair[1] != undefined) {
            return o[pair[0]] = pair[1], o;
        }
//        else{
//            return o, o;
//        }
        else {
            return  o;
        }


    }, {});
    return output;

}


function offsetofdiv(el) {
    var rect = el.getBoundingClientRect(),
            scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
            scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return {top: rect.top + scrollTop, left: rect.left + scrollLeft};
}





function getSortwrapperinputsvalues(sortinput_data_main_wrap)
{


    var data_attrclass = $("." + sortinput_data_main_wrap).attr('data-attrclass');
    var data_searchkey = $("." + sortinput_data_main_wrap).attr('data-searchkey');
    var data_fixed_type = $("." + sortinput_data_main_wrap).attr('data-fixed_type');
    var data_fixed_status = $("." + sortinput_data_main_wrap).attr('data-fixed_status');

    var looping_element = "." + data_attrclass + ":checked";

    var sortinput_values = '';
    $(looping_element).each(function () {
        var sortinput_key = $(this).attr('value');
        var sortinput_name = $(this).attr('name');
        var sortinput_valtype = $(this).attr('data-valtype');
        var sortinput_data_main = $(this).attr('data-main');
        var sortinput_data_fixed_status = $(this).attr('data-fixed_status');
        var sortinput_data_fixed_type = $(this).attr('data-fixed_type');

        sortinput_values = sortinput_values + '~' + sortinput_key;


    });
    if (sortinput_values != "") {

        sortinput_values = sortinput_values + '~';

        if (data_fixed_type == "fprice")
        {
           // sortinput_values = sortinput_values.slice(1, -1);
        }

        //
    }
    return sortinput_values;
}

function filternullvalues(val) {
    return val != '';
}

function makeCheckSortingInputs() {
    var url_data_value_json = JSON.parse($(".url_data_value").val());
    obj = url_data_value_json;
    $.each(obj, function (objkey, objvalue) {
//debugger;

        var objvalue_array = objvalue.split("~");
        var objvalue_array = objvalue_array.filter(filternullvalues);

        var fixed_array = ["m", "page"];
        $.each(objvalue_array, function (objarray_key, objarray_val) {

            if (fixed_array.indexOf(objkey) == -1)
            {
                if (objkey == 's') {
                    objkey = 's';
                    objarray_val = objarray_val.replace("+", "");
                }

                var sortinput_key = $("#" + objkey + objarray_val).attr('value');
                if (sortinput_key != undefined) {
                    var sortinput_name = $("#" + objkey + objarray_val).attr('name'); //
                    var sortinput_valtype = $("#" + objkey + objarray_val).attr('data-valtype'); //multiple or single
                    var sortinput_data_main = $("#" + objkey + objarray_val).attr('data-main');
                    var sortinput_data_boxnumber = $("#" + objkey + objarray_val).attr('data-boxnumber');
                    var sortinput_data_input_label = $("#" + objkey + objarray_val).attr('data-input_label');
                    var sortinput_id = $("#" + objkey + objarray_val).attr('id');


                    var data_attrclass = $("." + sortinput_data_main).attr('data-attrclass');
                    var data_searchkey = $("." + sortinput_data_main).attr('data-searchkey');



                    $("#" + objkey + objarray_val).prop("checked", true);


                    var search_input_tag = $(".gl_common_search_input_tag_model").html();
                    search_input_tag = search_input_tag.replace(/\{{sortinput_id}}/g, sortinput_id);
                    search_input_tag = search_input_tag.replace(/\{{sortinput_data_boxnumber}}/g, sortinput_data_boxnumber);
                    search_input_tag = search_input_tag.replace(/\{{sortinput_data_input_label}}/g, sortinput_data_input_label);
                    search_input_tag = search_input_tag.replace(/\{{sortinput_key}}/g, sortinput_key);
                    search_input_tag = search_input_tag.replace(/\{{sortinput_name}}/g, sortinput_name);

                    $(".gl_common_search_input_tag_main_wrapper").append(search_input_tag);
                }

            }




        });




    });

    //// filterTagCountAndCheck();



}
$('body').on('click', '.gl_load_more_scroll_btn', function () {
    $(".gl_load_more_scroll_btn").hide();
    var page_data_value = $(".page_data_value").val();
    var page_data_value_json = JSON.parse(page_data_value);
    page_data_value_json.scroll_range = 0;
    $(".page_data_value").val(JSON.stringify(page_data_value_json));

    load_send_page_request();

});



$(document).ready(function () {

    prodpreloader('0');

    var product_display_type = $(".gl_product_listing_style.active").attr("data-display_type");

//    console.log(product_display_type);

    var base_url = $(".base_url").val();

    var featurebox_id = $(".gl_product_list_section_wrap_box").attr("data-featurebox_id");
    var default_list_count = $(".gl_product_list_section_wrap_box").attr("data-default_list_count");
    var scroll_list_count = $(".gl_product_list_section_wrap_box").attr("data-scroll_list_count");
    var scroll_limit = $(".gl_product_list_section_wrap_box").attr("data-scroll_limit");
    var page_load = $(".gl_product_list_section_wrap_box").attr("data-page_load");
    var page_position = $(".gl_product_list_section_wrap_box").attr("data-page_position");
    var scroll_range = $(".gl_product_list_section_wrap_box").attr("data-scroll_range");
    var scroll_type = $(".gl_product_list_section_wrap_box").attr("data-scroll_type");
    var allsegment = "";
    var devicetype = "website";
    var rsegment = $(".gl_product_list_section_wrap_box").attr("data-rsegment");
    var page_string = $(".gl_product_list_section_wrap_box").attr("data-page_string");
    var product_display_type = product_display_type;
	
	var connection_page_id = $(".gl_product_list_section_wrap_box").attr("data-connection_page_id");
	var connection_special_page_type = $(".gl_product_list_section_wrap_box").attr("data-connection_special_page_type");
	var connection_product_category_id = $(".gl_product_list_section_wrap_box").attr("data-connection_product_category_id");
	var connection_product_main_category_id = $(".gl_product_list_section_wrap_box").attr("data-connection_product_main_category_id");
	var connection_page_product_type_id = $(".gl_product_list_section_wrap_box").attr("data-connection_page_product_type_id");




    var page_data_value_json = {
        featurebox_id: featurebox_id,
        default_list_count: default_list_count,
        scroll_list_count: scroll_list_count,
        scroll_limit: scroll_limit,
        page_load: page_load,
        page_position: page_position,
        scroll_range: scroll_range,
        scroll_type: scroll_type,
        allsegment: allsegment,
        devicetype: devicetype,
        rsegment: rsegment,
        page_string: page_string,
        product_display_type: product_display_type,
		
		connection_page_id: connection_page_id,
		connection_special_page_type: connection_special_page_type,
		connection_product_category_id: connection_product_category_id,
		connection_product_main_category_id: connection_product_main_category_id,
		connection_page_product_type_id: connection_page_product_type_id,
    };

    $(".page_data_value").val(JSON.stringify(page_data_value_json));


    var url_data_value_json = $.getUrlVars("object_data");

    $(".url_data_value").val(JSON.stringify(url_data_value_json));
    makeCheckSortingInputs();

    var footer_height = 0;
    $(".gl_footerfullwrapcontainer").each(function () {
        footer_height += $(".gl_footerfullwrapcontainer").height();
    });


    footer_height = Math.round(footer_height);

    var scroll_point = parseInt(footer_height);

//var scroll_point = 4000;

//console.log(scroll_point);


    $(document).infiniteJscroll({
        offset: scroll_point,
        topOfPage: function () {


        },
        bottomOfPage: function () {

            page_data_value_json = JSON.parse($(".page_data_value").val());


            //
//if (request) {
//request.abort();
//}	  

            var scroll_range = parseInt(page_data_value_json.scroll_range);
            var scroll_limit = parseInt(page_data_value_json.scroll_limit);


            if (scroll_range == scroll_limit) {

                $(".gl_load_more_scroll_btn").show();
                $(".gl_paged_scroll_loading").hide();

            } else
            {

                if ($('.gl_product_list_section_wrap_box').length > 0)
                {


                    var pageload = page_data_value_json.page_load;

                    if (pageload == 'yes')
                    {

                        load_send_page_request();


                    }

                }

            }



            //

        },
        pageInit: function () {

        }
    });

});










function load_send_page_request()
{

    var page_data_value_json = '';
    var url_data_value_json = '';

    var base_url = $(".base_url").val();
    page_data_value_json = JSON.parse($(".page_data_value").val());
    url_data_value_json = JSON.parse($(".url_data_value").val());


    var page_position = parseInt(page_data_value_json.page_position);
    var start_page_position = parseInt(page_data_value_json.page_position);


//

    var allsegment = page_data_value_json.allsegment;
//var allsegment = sessionStorage.getItem("allsegment");

    var allsegmentarray = allsegment.split(",");


    var dorequest = 'yes';
    if (inArray(page_position, allsegmentarray))
    {
        var dorequest = 'no';

        if (page_position == 0)
        {
            dorequest = 'yes';
        }

    } else
    {

        var dorequest = 'yes';

        allsegment = allsegment + ',' + page_position;

        page_data_value_json.allsegment = allsegment;
        $(".page_data_value").val(JSON.stringify(page_data_value_json));

        //sessionStorage.setItem("allsegment", allsegment);

    }

//$(".testdiv").html($(".allsegment").val()+"--"+$("#segment").val()+"--"+$(".pageload").val());


//
    //check request	
    if (dorequest == 'yes')
    {


        //
		
		var page_scroll_by_product = $(".gl_page_scroll_by_product").val();

        var main_height = $(".gl_product_list_section_wrap_box").height();
		
		if(page_scroll_by_product == 'yes')
		{
        var product_box = $(".gl_product_item_wrapbox").height();
        product_box = parseInt(product_box) / 2;
        var totalscrollheight = parseInt(main_height) + parseInt(product_box);
		}
		else
		{
		var totalscrollheight = parseInt(main_height);	
		}

        //	


        page_data_value_json = JSON.parse($(".page_data_value").val());
        url_data_value_json = JSON.parse($(".url_data_value").val());


        var post_string = showObjectjQuery(page_data_value_json);
        var get_string = showObjectjQuery(url_data_value_json);

        var scroll_list_count = parseInt(page_data_value_json.scroll_list_count);
        var default_list_count = parseInt(page_data_value_json.default_list_count);
        var scroll_range = parseInt(page_data_value_json.scroll_range);

//
        var url = window.location.href;
        var url_splite = url.split("?");
        var new_url = url_splite[0] + "?" + get_string;
//        console.log(get_string);
        history.pushState('', '', new_url);

//

        var dataString = post_string;

        $(".gl_paged_scroll_loading").show();

        request = $.ajax({
            type: "POST",
            url: base_url + "page_scroll/" + "?" + get_string,
            data: dataString,
            cache: false,
            success: function (html) {
                var check_html = html;

                check_html = check_html.replace(/(<([^>]+)>)/ig, "");
//                console.log(check_html.trim());

                if (check_html.trim() != "noitems") {


                    if (start_page_position == 0)
                    {
                        var loader_position = start_page_position;

                    } else
                    {
                        var loader_position = page_position;
                    }



                    //
                    if (start_page_position == 0)
                    {
                        // page_position = default_list_count + scroll_list_count;
                        page_position = default_list_count;
                    } else
                    {
                        page_position = page_position + scroll_list_count;
                    }




                    scroll_range = scroll_range + 1;


                    page_data_value_json.scroll_range = scroll_range;
                    page_data_value_json.page_position = page_position;
                    page_data_value_json.allsegment = allsegment;
                    // url_data_value_json.page = page_position;

                    $(".page_data_value").val(JSON.stringify(page_data_value_json));
                    $(".url_data_value").val(JSON.stringify(url_data_value_json));


                    //	
                    if (start_page_position == 0)
                    {
                        $(".gl_product_list_section_wrap_box").html(html);
                    } else
                    {
                        $(".gl_product_list_section_wrap_box").append(html);
                    }

                    prodpreloader(loader_position);

                    if (start_page_position == 0)
                    {
                        // $(window).scrollTop($(".gl_product_list_section_wrap_box").offset().top - 200);

                        $('html, body').animate({
                            scrollTop: $(".gl_product_list_section_wrap_box").offset().top - 200
                        }, 1000);

                    } else
                    {
                        $(window).scrollTop(totalscrollheight);
                    }


                } else
                {
                    var pageload = page_data_value_json.page_load;

                    if (pageload == 'yes' && start_page_position == 0)
                    {
                        var gl_no_data_hidden_wrapper = $(".gl_no_data_hidden_wrapper").html();
                        $(".gl_product_list_section_wrap_box").html(gl_no_data_hidden_wrapper);
                    }

                    if (pageload == 'no')
                    {
                        $(".gl_product_list_section_wrap_box").append('<div class="list-page-read-more gl_no_more">No more Items to load</div>');

                    }

                    page_data_value_json.page_load = "no";
                    $(".page_data_value").val(JSON.stringify(page_data_value_json));
                    $(".url_data_value").val(JSON.stringify(url_data_value_json));
                }
                //imgload();
                $(".gl_paged_scroll_loading").hide();
//             

//after the scoll load
DoActionAfterScrollLoad();
//after the scoll load 
            }
        });



//}
//testing



//check request						
    }
//check request	

}


$('.gl_commonsortwrapper').on('click', '.gl_commonsortinput', function () {

    $(".gl_no_more").hide();
    $(".gl_load_more_scroll_btn").hide();

    //  var data_attrclass = $(this).attr('data-attrclass');
    /// var data_searchkey = $(this).attr('data-searchkey');

    var sortinput_key = $(this).attr('value');
    var sortinput_name = $(this).attr('name'); //
    var sortinput_valtype = $(this).attr('data-valtype'); //multiple or single
    var sortinput_data_main = $(this).attr('data-main');
    var sortinput_data_boxnumber = $(this).attr('data-boxnumber');
    var sortinput_data_input_label = $(this).attr('data-input_label');
    var sortinput_data_filterblock = $(this).attr('data-filterblock');
    var sortinput_id = $(this).attr('id');


    var data_attrclass = $("." + sortinput_data_main).attr('data-attrclass');
    var data_searchkey = $("." + sortinput_data_main).attr('data-searchkey');
    var data_fixed_type = $("." + sortinput_data_main).attr('data-fixed_type');
    var data_fixed_status = $("." + sortinput_data_main).attr('data-fixed_status');

    var sort_click_checked = "yes";


    if ($(this).is(":checked")) {
        sort_click_checked = "yes";

        if (sortinput_valtype == "single") {

            $(".gl_attributeclass" + sortinput_data_boxnumber).prop("checked", false);
            $(this).prop("checked", true);

        }

    } else if ($(this).is(":not(:checked)")) {
        sort_click_checked = "no";

    }



    if (sort_click_checked == "yes") {

        if (sortinput_valtype == "single") {

            $(".gl_common_search_input_box_number_" + sortinput_data_boxnumber).remove();

        }
        var search_input_tag = $(".gl_common_search_input_tag_model").html();
        search_input_tag = search_input_tag.replace(/\{{sortinput_id}}/g, sortinput_id);
        search_input_tag = search_input_tag.replace(/\{{sortinput_data_boxnumber}}/g, sortinput_data_boxnumber);
        search_input_tag = search_input_tag.replace(/\{{sortinput_data_input_label}}/g, sortinput_data_input_label);
        search_input_tag = search_input_tag.replace(/\{{sortinput_key}}/g, sortinput_key);
        search_input_tag = search_input_tag.replace(/\{{sortinput_name}}/g, sortinput_name);

        $(".gl_common_search_input_tag_main_wrapper").append(search_input_tag);


        sortinput_values = getSortwrapperinputsvalues(sortinput_data_main);
        if (sortinput_values != '') {

            url_data_value_json = JSON.parse($(".url_data_value").val());
            url_data_value_json[sortinput_name] = sortinput_values;

            $(".url_data_value").val(JSON.stringify(url_data_value_json));
        }


    } else {
        $(".gl_common_search_input_tagline_" + sortinput_id).remove();

        sortinput_values = getSortwrapperinputsvalues(sortinput_data_main);
        url_data_value_json = JSON.parse($(".url_data_value").val());
        url_data_value_json[sortinput_name] = sortinput_values;

        if (sortinput_values == '') {

            delete url_data_value_json[sortinput_name];

        }
        $(".url_data_value").val(JSON.stringify(url_data_value_json));
    }


    url_data_value_json = JSON.parse($(".url_data_value").val());
    page_data_value_json = JSON.parse($(".page_data_value").val());
    page_data_value_json.scroll_range = 0;
    page_data_value_json.page_position = 0;
    page_data_value_json.allsegment = ',';
    page_data_value_json.page_load = 'yes';

    delete url_data_value_json.page;

    $(".page_data_value").val(JSON.stringify(page_data_value_json));
    $(".url_data_value").val(JSON.stringify(url_data_value_json));

    load_send_page_request();
    // filterTagCountAndCheck();

});

$('.gl_common_search_input_tag_main_wrapper').on('click', '.gl_common_search_input_tag_remove', function () {

    var sortinput_id = $(this).attr('data-input_id');
    $("#" + sortinput_id).trigger("click");
    // filterTagCountAndCheck();
});



function prodpreloader(position)
{
	
if($(".gl_extra_product_listing_block").length)
{		
	
	//$('.gl_extra_product_listing_block').find(".gl_product_listing_img_wrapper" + position).preloader();
	$('.gl_extra_product_listing_block').find(".gl_product_listing_img_wrapper").preloader();
	
}	
	
	
    $('.gl_product_list_section_wrap_box').find(".gl_product_listing_img_wrapper" + position).preloader();
	



}


function DoActionAfterScrollLoad()
{

//	fha_custom
//do_paytype_auto_tigger();
LoadCompressedImags() ;	
combo_product_update();
//  fha_custom
	
//	custom
if ($(".gl_wihlist_active").length > 0) {
        checkproductinwishlist(); 
    }
    if ($(".gl_ec_common_action").length > 0) {
       product_name_change(); 
    }
//	custom
	
}
