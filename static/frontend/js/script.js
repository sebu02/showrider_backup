$(function () {






    $('.parallax-window').parally({
        speed: -0.4,
        mode: 'background',
        ypos: '50%',
        outer: false,



    });
    if ($('.text_inner_head').length) {
        text_animation();
    }
    if ($('.full_size_check').length) {
        checkbox();
    }

    $('body').on('click', '.checkbox_main', function (event) {
        $(this).parents('.choose_block').toggleClass('active');
    });








    // why showrider inner page scroll



    // var nav_height = $('.site-navbar').height();
    //      var data_link_val = get_url_parameter('section');

    //  var local_postn = $('body').find('.' + data_link_val);
    //      if ($('body').find('.' + data_link_val).length != 0) {
    //          $('html, body').animate({
    //              scrollTop: (local_postn.offset().top - (nav_height * 2))
    //          }, 1000);
    //      }
    //  })






    if ($('.gallery_filter').length) {
        gallery_filter();
    }

    var overlay = $('.overlay_close');
    var w_width = $(window).width();
    // alert(w_width);


    // hangburger
    $('body').on('click', '.hangburger_trigger', function () {
        $('.hangburger_main').addClass('active');
        overlay.addClass('active');
        overlay_deactive($('.hangburger_main'));
    });

    // $('body').on('click', '.overlay_close', function() {
    //     $('.hangburger_main').removeClass('active');
    //     overlay.removeClass('active');
    // });

    $('body').on('click', '.hangburger_main .dropdown .icon', function () {
        $(this).parent().toggleClass('active');
    });

    // appending
    $(".logo").clone().appendTo(".hangburger_main");
    // $(".quote_top").clone().appendTo(".hangburger_main");
    $(".common_ul_type_1").clone().appendTo(".hangburger_main");
    $(".water_tank_calc").clone().appendTo(".hangburger_main");
    $(".mail_enquiry").clone().appendTo(".hangburger_main");
    $(".call_enquiry").clone().appendTo(".hangburger_main");
    $(".social_media_icons").clone().appendTo(".hangburger_main");




    // new_append
    $(".hangburger_main .logo").clone().insertBefore(".bottom_nav .main_menu");
    $(".hangburger_main .call_enquiry").clone().appendTo(".bottom_nav");
    $(".hangburger_trigger").clone().appendTo(".bottom_nav");






    var header_height = $(".header_top").outerHeight();
    var position = $(window).scrollTop();
    // should start at 0
    $(window).scroll(function () {
        var scroll = $(document).scrollTop();
        if (scroll > 50) {
            $('header').addClass('active_logo');
        } else {
            $('header').removeClass('active_logo');
        }



        if (scroll > position) {
            $('header').css('top', '-' + header_height + 'px');
            $('header').addClass('active');

        } else {
            $('header').css('top', '0px');
            $('header').removeClass('active');
        }
        position = scroll;

    });



    if ($('.header_inner').length) {
        var header_inner_page = $('.header_inner');
        var bnr_height_elemt = $('.bottom_nav').outerHeight();
        header_inner_page.css('height', bnr_height_elemt);

    } else {
        var bnr_height_elemt = $('.bottom_nav').height();
        var bnr_height = $('.bottom_nav').position().top + bnr_height_elemt;

        $(window).scroll(function () {
            header_fixing(bnr_height);
        });
    }



    // $(document).smoothWheel();
    $(window).on('load', function () {

        $(this).impulse();
    });



    //     $(window).scroll(function () {

    //     }
    // $(".bottom_nav").scroll(function(){
    //   
    // });


    // fixing_block
    if ($('.fixing_block').length) {
        // fixing_block();
        fixing_click();
    }




    if ($('.form_group').length) {
        floating();
    }



    if ($('.get_a_quote_details_wrpr').length) {
        click_to_scroll_section('service');

    }


    // owl_sldier_initialization 
    if ($('.collapse_inner_wrpr').length) {
        click_to_append_1();
    }


    if ($('.owl_carousel_slider').length) {
        banner_slider();
    }



    $('.news_and_evnsts_details_slider').owlCarousel({

        items: 1,
        margin: 0,
        nav: false,
        loop: true,
        dots: true,

    });
    $('.service_details_slider').owlCarousel({

        items: 1,
        margin: 0,
        nav: false,
        loop: true,
        dots: true,

    });
    $('.slider_inner').owlCarousel({
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        items: 4,
        margin: 15,
        autoplay: true,
        autoplayTimeout: 3500,
        // autoplayHoverPause: false,
        nav: false,
        dots: false,
        loop: false,
        // mouseDrag: false,
        // touchDrag: false,
        responsive: {
            0: {
                items: 1,
            },

            480: {
                items: 2,
            },
            768: {
                items: 3,
            },
            1024: {
                loop: false,
                items: 4,
                margin: 30
            }

        }
    });


    /*mCustomScrollbar*/
    $(".hangburger_main").mCustomScrollbar({
        theme: "dark-thin",
        autoHideScrollbar: true,
        setLeft: 0
    });
    if (w_width > 768) {
        $(".common_page_scroll").mCustomScrollbar({
            theme: "dark-thin",
            autoHideScrollbar: true,
        });
        $(".map_palces_list").mCustomScrollbar({
            theme: "dark-thin",
            autoHideScrollbar: false,
        });
        $(".news_and_evnsts_details_block .details_para").mCustomScrollbar({
            theme: "dark-thin",
            autoHideScrollbar: false,
        });





    };
    if (w_width > 576) {
        $(".block_contents").mCustomScrollbar({
            theme: "dark-thin",
            autoHideScrollbar: false,
        });
    }


    /*choose file script*/
    $('#chooseFile').bind('change', function () {
        var filename = $("#chooseFile").val();
        if (/^\s*$/.test(filename)) {
            $(".file-upload").removeClass('active');
            $("#noFile").text("No file chosen");
        } else {
            $(".file-upload").addClass('active');
            $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
        }
    });


    // clouds animation
    // $("#pln1").clouds({
    //     fps: 30,
    //     speed: 3,
    //     dir: "right",
    //     type: "pan",
    //     loop: "autoplay",
    // });




    //back_top_top
    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        if (scroll >= 1000) {
            $('.back_to_top').addClass('active');
        } else {
            $('.back_to_top').removeClass('active');
        }
    });
    $('body').on('click', '.back_to_top', function () {
        $('html').animate({
            scrollTop: 0
        }, 'slow');
        return true;
    });





    if ($('.zoom_carousel_popup').length) {
        zoom_function();
    }


    if (w_width <= 1024) {
        var appending_wrp = $('.appending_block');
        var head_text = $('.appending_head').html();

        $('.appending_head_wraper').html(head_text);
        $('.category_listing_wraper').append(appending_wrp);

        $('.category_listing_wraper').mCustomScrollbar({
            theme: "dark-thin",
            autoHideScrollbar: true
        });
    }



    $('body').on('click', '.appending_head_wraper', function () {
        $('.category_listing_wraper').addClass('active');
        overlay.addClass('active');
        overlay_deactive($('.category_listing_wraper'));
    });


    /*scrollto function*/
    var scroll_leng = $('.scroll_class').length;
    var conter = 1;

    $('.scroll_class').each(function () {
        $(this).attr('data-scroll-from', conter);
        conter++;
    });

    for (var k = 1; k <= scroll_leng; k++) {
        var appending_div = '<div class="scroll_to_block" data-scroll-to="' + k + '"></div>';
        $('.scroll_to_section').append(appending_div);
    }

    $('.scroll_to_section').find('.scroll_to_block').first().addClass('active');


    $('body').on('click', '.scroll_to_block', function () {
        var this_attr = $(this).attr('data-scroll-to');

        var scroll_pos = parseInt($('.scroll_class[data-scroll-from="' + this_attr + '"]').position().top) - $('.header_main_wrpr ').outerHeight();

        $('html').animate({
            scrollTop: scroll_pos
        }, 2000);
    });



    if ($('body').find('.append_title').lenght != 0) {
        append_detail_txt();
    }





    // AOS
    var wwidth = $(window).width();
    // if (wwidth < 1024) {
    //     AOS.init({
    //         disable: true
    //     });
    // } else {
    //     AOS.init({
    //         easing: 'ease-in-out-sine'
    //     });
    // }


    // Product enquire append text 
    var prodct_value;
    $('body').on('click', '.pass_title_attribute', function () {
        prodct_value = $(this).attr('data-product-value');
        $('.product_name_label').text(prodct_value);
        $('.product_name_input').val(prodct_value);
    });








    // AJ KRISHNA CODE JS FOR SHOWRIDER 
    // animated slider
    $('#dg-container').gallery({
        autoplay: true,
        // interval: 4000
    });

    // Get a Quote detail page
    if ($('body').find('.collapse_inner_wrpr').length != 0) {
        collapse_next_click();
    }


    // Get a Modal attr value
    if ($('body').find('.get_attr_value').length != 0) {
        modal_attr_value_get();
    }




    // gallery 

    // ANEESH 
    // rellax
    var rellax = new Rellax('.rellax_action', {
        center: true
    });
    /*var rellax = new Rellax('.rellax_action');*/
    // var $gallery = $('.gallery_img_popup a').simpleLightbox();
    if ($('.gallery_img_popup').length) {

        $('.venobox').venobox({
            framewidth: '700px', // default: ''
            numeratio: true, // default: false
            infinigall: true // default: false
        });
        $('.venobox_inner').venobox({

            frameheight: '400px', // default: ''
            numeratio: true, // default: false
            infinigall: true // default: false
        });
    }









    // NEW CHANGES FOR UPDATIONS
    if ($('.dropdown').length){
        
        // $('.common_ul_type_1 li').each(function(){
        //     if ($(this).find('.dropdown_list').length != 0){
        //         $(this).addClass('submenu');
        //     }
        // });

        if($('body').find('.dropdown_list').length != 0){
            $(".dropdown_list").parent(".dropdown").addClass("submenu");
        }

    }

    // ABOUT PAGE JS FOR ALIGNMENT NEAREST SAME BLOCK CONCEPT
    if($("body").find(".about_section_wrpr").next().closest(".about_section_wrpr").length != 0){
        $(".subscribe_wrpr").insertAfter($("body").find(".about_section_wrpr").first());
        // $('body').addClass("shuffle_order");
    }





});



function text_animation() {
    var textWrapper = document.querySelector('.ml12');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: true })
        .add({
            targets: '.ml12 .letter',
            translateX: [40, 0],
            translateZ: 0,
            opacity: [0, 1],
            easing: "easeOutExpo",
            duration: 1200,
            delay: (el, i) => 500 + 30 * i
        }).add({
            targets: '.ml12 .letter',
            translateX: [0, -30],
            opacity: [1, 0],
            easing: "easeInExpo",
            duration: 1100,
            delay: (el, i) => 2000 + 30 * i
        });
}

function fixing_click() {
    var win_width = $(window).width();
    if (win_width <= 1024) {
        // clone selected items
        $(".get_a_quote_details_wrpr .sel_item_wrpr").clone().insertAfter(".collapse_grpup");



        // click open
        $('body').on('click', '.click_open', function (event) {
            $('.right_panel').addClass('mob_active');
            $('.overlay_close').addClass('active');
            $(".right_panel").mCustomScrollbar({
                theme: "dark-thin",
                autoHideScrollbar: true,
                setLeft: 0
            });
        });

        // click close
        $('body').on('click', '.overlay_close', function (event) {
            $('.right_panel').removeClass('mob_active');
            $('.overlay_close').removeClass('active');
        });



        // click close
        $('body').on('click', '.colse_btn', function (event) {
            $('.right_panel').removeClass('mob_active');
            $('.overlay_close').removeClass('active');
        });

    }

}


function fixing_block() {
    var win_width = $(window).width();

    if (win_width > 1024) {

        var header_height = $('.bottom_nav').outerHeight();
        var fix_position = $('.main_panel').offset().top;
        var fix_pos = fix_position - header_height;
        var fix_child = $('.main_panel').offset().top;
        var fix_child_h = $('.main_panel').outerHeight();
        var hide_pos = fix_child + fix_child_h - header_height;


        $(window).scroll(function () {

            var scroll_pos = $(window).scrollTop();
            if (scroll_pos > fix_pos) {
                $(".right_panel").appendTo(".fixing_block");
                $('.fixing_block').addClass('active');
                $(".right_panel").mCustomScrollbar({
                    theme: "dark-thin"
                });

            } else {
                $(".right_panel").insertAfter(".main_panel");
                $('.fixing_block').removeClass('active');
            }


            if (scroll_pos > hide_pos) {
                $('.fixing_block').addClass('hide');
            } else {
                $('.fixing_block').removeClass('hide');
            }

        });
    }
}


function click_to_append() {
    // console.log('test');
    $('body').on('click', 'input.checkbox_main', function () {
        // console.log('hi');

        var heads = $(this);
        var head = $(this);
        var ident = $(this).parents('.collapse_inner_wrpr').attr('append_block');
        var oppident = $('.item_sel').attr('append_block_inner');
        // console.log('ident is ' + ident + 'oppident is ' + oppident  );

        // console.log(heads);
        // $(this).parents('.collapse_inner_wrpr').find('.heading_collapse').clone().appendTo(".item_name");


        // $('.item_sel').clone(heads);
        // $('.item_sel').clone(head);


        if ($('.checkbox_main').length) {
            $('.item_sel').append('<div class="item_sel" append_block_inner="' + ident + '"></div>');
            // heads.clone().appendTo($('.item_sel'));
            head.appendTo($('.item_sel'));


        }
        // else if(ident != oppident){
        //     $('.item_sel').append('<div class="item_sel" append_block_inner="'+ ident + '"></div>');
        //     // heads.clone().appendTo($('.item_sel'));
        //     head.appendTo($('.item_sel'));



        // }
        // else {

        //         head.clone().appendTo($('.item_sel'));
        // }










    });
}



function checkbox() {
   $('body').on('click', '.full_size_check', function () {
        if ($(this).is(':checked')) {
            $(this).parents('.checkbox_inner').addClass('active');
        }
        else{
            $(this).parents('.checkbox_inner').removeClass('active');

        }

        if ($(this).parents('.checkbox_wrpr').find('.checkbox_inner.active').length) {
           $(this).parents('.get_a_quote_wrpr_inner').addClass('active');
        }else{
            $(this).parents('.get_a_quote_wrpr_inner').removeClass('active');
        }
   });
}

function click_to_append_1() {
    // console.log('test');
    $('body').on('click', 'input.checkbox_main', function () {
        // console.log('hi');

        var head = $(this).parents('.collapse_inner_wrpr').find('.heading_collapse').clone();

        var heads = $(this).parents('.choose_block').find('.block_header_with_icon').clone();

        var inner_wrpr = $(this).parents('.collapse_inner_wrpr').find('input.checkbox_main');
        var sub_in = $(this).parents('.choose_block').find('.block_header_with_icon').attr('data_sub_head');
        var ident = $(this).parents('.collapse_inner_wrpr').attr('append_block');
        var oppident = $('.item_sel').attr('append_block_inner');
        // console.log(inner_wrpr);



        // $('.item_sel').append('<div class="item_sel">'+ head +'</div>');
        if ($(this).is(':checked')) {
            if ($('.select_item_block').length) {
                if ($('[append_block_inner=' + ident + ']').length) {
                    $('[append_block_inner=' + ident + ']').append(heads);
                }
                else {
                    $('.select_item_block').append('<div class="item_sel" append_block_inner="' + ident + '"></div>');
                    $('[append_block_inner=' + ident + ']').append(head);
                    $('[append_block_inner=' + ident + ']').append(heads);
                }

            }
            else {
                $('.select_item_block').append('<div class="item_sel" append_block_inner="' + ident + '"></div>');
                $('[append_block_inner=' + ident + ']').append(head);
                $('[append_block_inner=' + ident + ']').append(heads);
            }

        }
        else {

            if (inner_wrpr.is(':checked')) {
                $('[append_block_inner=' + ident + ']').find('[data_sub_head=' + sub_in + ']').remove();
            }
            else {
                $('[append_block_inner=' + ident + ']').remove();
            }









        }






    });
}







function click_to_scroll_section(identifier) {
    // console.log(identifier);
    $('body').on('click', '.scroll_wrpr_' + identifier + ' [data-scroll-to-' + identifier + ']', function () {

        var selector = $(this).attr('data-scroll-to-' + identifier);
        var from_element_selector = $('[data-scroll-from-' + identifier + '="' + selector + '"]');
        var header_height = $('header').outerHeight() + 10;
        $(this).addClass('active').siblings().removeClass('active');

        var open_collapse_offset;
        if ($('.accordion').find('.collapse').hasClass('show')) {
            var open_collapse_height = $('.accordion').find('.show').outerHeight();
            open_collapse_offset = $('.accordion').find('.show').offset().top;
        } else {
            open_collapse_height = 0;
        }
        var element_top = from_element_selector.offset().top;
        from_element_selector.find('.collapse_main').trigger('click');
        if (element_top > open_collapse_offset) {
            $('html, body').animate({
                scrollTop: element_top - header_height - open_collapse_height
            }, 1000);

        } else {
            $('html, body').animate({
                scrollTop: element_top - header_height
            }, 1000);
        }

        $('.right_panel').removeClass('mob_active');
        $('.overlay_close').removeClass('active');

    });


    // $('body').on('click','.scroll_wrpr_' + identifier + ' [data-scroll-to-' + identifier + ']', function(){
    //     var xd = $(this).attr('data-scroll-to-service');
    //     $('bod').find(xd).
    // });



    $(window).scroll(function () {
        var scrolling = $(window).scrollTop();

        $('[data-scroll-from-' + identifier + ']').each(function () {
            var this_item_top = Math.round($(this).offset().top);
            var this_item_height = Math.round(($(this).outerHeight()) + (this_item_top + $('header').outerHeight()));
            var data_indenti_val = $(this).attr('data-scroll-from-' + identifier);


            if (scrolling + 250 >= this_item_top && scrolling + 250 < this_item_height) {
                $('body').find('[data-scroll-to-' + identifier + ']').removeClass('active');
                $('body').find('[data-scroll-to-' + identifier + '="' + data_indenti_val + '"]').addClass('active');
            }
        })
    });
}






// function gallery_filter(class_name) {
//     // var filter = $(".category_item");




//     if (class_name) {
//         $('.gallery_inner_wrpr').find("." + class_name).addClass('active');
//         $('.category_item').removeClass('active');
//         $('.category_item[data-subcategory="' + class_name + '"]').addClass('active');
//     } else {
//         $('.gallery_inner_wrpr a').addClass('active');
//     }

//     $('body').on('click', '.category_item', function () {
//         $('.category_item').removeClass('active');
//         $(this).addClass('active');

//         // $('.gallery_inner_wrpr').addClass('gallery_active');

//         var attr = $(this).attr('data-subcategory');
//         $('.gallery_inner_wrpr a').removeClass('active');

//         if (attr == 'a0') {
//             $('.gallery_inner_wrpr a').addClass('active');
//         } else {
//             // $(".gallery_img_wrpr").removeClass('active');
//             $('.gallery_inner_wrpr').find("." + attr).addClass('active');
//         }
//     });
// }

function overlay_deactive(identifier) {
    $('body').on('click', '.overlay_close', function () {
        $(this).removeClass('active');
        identifier.removeClass('active');
    });
}


// floating style
function floating() {
    $('body').on('focus', '.form_group input , .form_group textarea', function () {
        $(this).parent('.form_group').addClass('active');
    }).on('blur', '.form_group input , .form_group textarea', function () {
        if ($(this).val() == '') {
            $(this).parent('.form_group').removeClass('active');
        }
    });


    $('.form_group input , .form_group textarea').each(function () {
        if ($(this).val()) {
            $(this).parent('.form_group').removeClass('active').addClass('active');
        }
    });
}







function zoom_function() {

    var item_array_thumb = [];
    var item_zoom = [];
    var item_zoom_thumb = [];
    var items_length = $('.detail_product_wrpr  .item').length;
    var img_counter = 0;



    /*detailpage slider*/
    $('.detail_product_wrpr').owlCarousel({
        items: 1,
        loop: false,
        nav: false,
        dots: false
    });



    $('.detail_product_wrpr .item').each(function () {
        $(this).find('img').attr('data-img-selector', 'image_' + img_counter);

        var this_clone = $(this).clone();
        var this_clone_1 = $(this).clone();
        var this_clone_2 = $(this).clone();

        var this_img = $(this).find('img').attr('data-img-thumb');
        var this_img_org = $(this).find('img').attr('data-img-orginal');
        var this_img_thumb = $(this).find('img').attr('data-img-thumb');

        this_clone.find('img').attr('src', this_img);
        this_clone_1.find('img').attr('src', this_img_org);
        this_clone_2.find('img').attr('src', this_img_thumb);

        item_array_thumb.push(this_clone);
        item_zoom.push(this_clone_1);
        item_zoom_thumb.push(this_clone_2);

        img_counter++;
    });


    if (items_length > 1) {
        slider_thumb();
    }



    function slider_thumb() {

        for (var i = 0; i < items_length; i++) {
            $('.detail_product_wrpr_thumb').append(item_array_thumb[i]);
        }
        $('.detail_product_wrpr_thumb .item:first-child').addClass('zoom_active');


        $('.detail_product_wrpr_thumb').owlCarousel({
            items: 2,
            loop: false,
            nav: true,
            dots: false,
            navText: ["<div class='prev'><span class='gd_icon_arrow2_left_t'></span></div>", "<div class='next'><span class='gd_icon_arrow2_right_t'></span></div>"],
            responsive: {
                0: {
                    items: 3
                },
                769: {
                    items: 2
                }
            }

        });

    }



    carousel_sync('detail_product_wrpr', 'detail_product_wrpr_thumb');
    zoom_carousel(item_zoom, item_zoom_thumb);


    $('body').on('click', '.detail_product_wrpr .item , .detail_product_wrpr_thumb .item', function () {
        $('.zoom_carousel_popup').addClass('active');
        $('body').addClass('detail_zoom_popup');
        zoom_carousel_linking('detail_product_wrpr_thumb', 'detail_zoom_carousel');
    });

    $('body').on('click', '.detail_zoom_carousel_close', function () {
        $('.zoom_carousel_popup').removeClass('active');
        $('body').removeClass('detail_zoom_popup');
        zoom_carousel_linking('detail_zoom_carousel_thumb', 'detail_product_wrpr');

    });
}


function carousel_sync(carousel_calss_1, carousel_calss_2, indicator_click) {

    var first_carousel = $("." + carousel_calss_1);
    var second_carousel = $("." + carousel_calss_2);
    var first_carousel_item = 0;
    var second_carousel_item = 0;
    var tem_count = 0;

    second_carousel.find('.item').each(function () {
        $(this).attr('data-item-count', tem_count);
        tem_count++;
    });

    first_carousel.on('translated.owl.carousel', function (event) {
        first_carousel_item = event.item.index;
        // var this_img = $(this).find('.active img').attr('src');
        var this_img = $(this).find('.active img').attr('data-img-selector');
        second_carousel.find('.item').removeClass('zoom_active');
        // second_carousel.find('img[src="' + this_img + '"]').parents('.item').addClass('zoom_active');
        second_carousel.find('[data-img-selector="' + this_img + '"]').parents('.item').addClass('zoom_active');
        second_carousel.trigger("to.owl.carousel", [first_carousel_item]);

    });


    if (indicator_click) {
        $('body').on('click', '.' + carousel_calss_2 + ' .item', function (e) {
            $(this).parent().siblings().find('.item').removeClass('zoom_active');
            $(this).addClass('zoom_active');
            var item_attr = $(this).attr('data-item-count');
            first_carousel.trigger("to.owl.carousel", [item_attr]);
        });
    }
}


function zoom_carousel(item_zoom, item_zoom_thumb) {
    // var item_array = [];
    // var item_array_1 = [];

    var items_length = $('.detail_product_wrpr  .item').length;

    // $('.detail_product_wrpr .item').each(function () {
    //     var this_clone = $(this).clone();
    //     var this_img = $(this).find('img').attr('data-large-img');
    //     this_clone.find('img').attr('src', this_img);
    //     item_array.push(this_clone);
    // });
    // $('.detail_product_wrpr_thumb .item').each(function () {
    //     var this_clone = $(this).clone();
    //     var this_img = $(this).find('img').attr('data-large-img');
    //     this_clone.find('img').attr('src', this_img);
    //     item_array_1.push(this_clone);

    // });


    for (var i = 0; i < items_length; i++) {
        $('.detail_zoom_carousel').append(item_zoom[i]);
        $('.detail_zoom_carousel_thumb').append(item_zoom_thumb[i]);
    }

    $('.detail_zoom_carousel').owlCarousel({
        items: 1,
        nav: true,
        navText: ["<span class='gd_icon_arrow2_left_t'></span>", "<span class='gd_icon_arrow2_right_t'></span>"],
        animateOut: "fadeOut",
        dots: false,
        responsive: {
            577: {
                dots: false
            }
        }
    });
    $('.detail_zoom_carousel_thumb').owlCarousel({
        items: 6,
        margin: 10,
        responsive: {
            0: {
                items: 3
            },
            577: {
                items: 4
            }
        }
    });

    carousel_sync('detail_zoom_carousel', 'detail_zoom_carousel_thumb', true);
}


function zoom_carousel_linking(carousel_thumb, carousel_selectors) {
    var selected = $('.' + carousel_selectors).find('.active img').attr('data-img-selector');
    $('.' + carousel_selectors + '_thumb').find('[data-img-selector="' + selected + '"]').parents('.item').addClass('zoom_active');
    var selected_attr = $('.' + carousel_thumb).find('.item.zoom_active').attr('data-item-count');
    var carousel = $('.' + carousel_selectors);
    carousel.trigger("to.owl.carousel", [selected_attr]);
}


var mySlider = $('.pogoSlider').pogoSlider({
    generateNav: false,
    pauseOnHover: false
});



function append_detail_txt() {
    var append_txt = $('.append_title').attr('data-append-size');
    if ($(window).width() <= append_txt) {
        $('.append_title').parents('.detail_table_full_wraper').addClass('resp');
        $('.detail_table_col').each(function () {
            $(this).find('.detail_table_title').appendTo($(this).parents('.detail_table_full_wraper').find('.detail_title_wrpr'));
        });
        $(".detail_table_full_wraper.resp .detail_table_cover").mCustomScrollbar({
            axis: "x",
            theme: "dark-thin",
            autoHideScrollbar: true,
        });
    }
}


function header_fixing(bnr_height) {
    var scroll_pos = $(window).scrollTop();
    // console.log(sasd);
    //  var scroll = $(window).scrollTop();
    if (scroll_pos < bnr_height) {
        $('.bottom_nav').removeClass('active');
    } else {
        $('.bottom_nav').addClass('active');
    }


    var block_height = $('.top_inner_block').height();
    var w_height = block_height / 2;

    // console.log(block_height);

    if (scroll_pos < w_height) {
        $('.bottom_nav').removeClass('pos_dropdown');
    } else {
        $('.bottom_nav').addClass('pos_dropdown');
    }
}






function banner_slider() {

    var banner_slider = $('.owl_carousel_slider');
    var counter_set = 0;
    banner_slider.owlCarousel({
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        items: 4,
        margin: 15,
        autoplay: true,
        autoplayTimeout: 3500,
        // autoplayHoverPause: false,
        nav: false,
        dots: false,
        loop: false,
        // mouseDrag: false,
        // touchDrag: false,
        responsive: {
            0: {
                items: 1,
            },

            480: {
                items: 2,
            },
            768: {
                items: 3,
            },
            1024: {
                loop: false,
                items: 4,
                margin: 30
            }

        }
    });

    // banner_slider.owlCarousel({
    //     animateOut: 'fadeOut',
    //     animateIn: 'fadeIn',
    //     items: 4,
    //     margin: 30,
    //     autoplay: true,
    //     autoplayTimeout: 5000,
    //     // autoplayHoverPause: false,
    //     nav: true,
    //     // loop: false,
    //     mouseDrag: false,
    //     touchDrag: false,
    //     navText: ["<div class='prev'><span class='gd_icon_arrow2_left_t'></span></div>", "<div class='next'><span class='gd_icon_arrow2_right_t'></span></div>"]
    // });

    // $('.owl_carousel_slider video').each(function () {
    //     $(this).addClass('video_identfier_' + counter_set);
    //     counter_set++;
    // });

    // banner_slider.on('translate.owl.carousel', function (event) {
    //     var vid = document.getElementsByClassName("video_identfier_" + event.item.index)[0];
    //     vid.currentTime = 0;
    //     vid.play();
    // })
}



function collapse_next_click() {

    $('body').on('click', '.common_btn_2', function () {
        if ($(this).parents('.collapse_inner_wrpr').next().find('.collapse_main').length != 0) {
            $(this).parents('.collapse_inner_wrpr').next().find('.collapse_main').trigger('click');
        }
    });

}

function modal_attr_value_get() {

    $('body').on('click', '.get_attr_value', function () {
        var val = $(this).attr('data-attr-val');
        if (val != 0) {
            $('body').find('.get_attr_val_holder').text(val);
        } else {
            $('body').find('.get_attr_val_holder').text(" ");
        }

    });

}