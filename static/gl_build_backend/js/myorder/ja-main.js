$(function () {

    var WndwWidth = $(window).width();
    var scrpos = $(document).scrollTop();

    // document cliks
    $(document).click(function () {
        // right button nav click hide
        if ($(".header_btm_nav_wrap").hasClass('shw')) {
            $(".header_btm_nav_wrap").removeClass('shw');
            $('.ja_new_arriv_jew_sec').find('.filter_left_fix').removeClass('z_index_disapling');
        }

        if ($(".user_navwrapper_res").hasClass('shw')) {
            $(".user_navwrapper_res").removeClass('shw');
        }
    });

    // banner thumbnail click
    $(".ja_hmbnr_thumbnav_lst li").click(function () {
        $(".ja_hmbnr_thumbnav_lst li").removeClass('active');
        $(this).addClass('active');
    });


    $(".pin_changebtn").click(function () {
        var trigger_btn = $(this).attr("class");
        $(this).html("Check");
        $(this).prev(".change_loc_wrap").find(".loc_chng_inputbx").addClass("active");
        $(this).prev(".change_loc_wrap").find(".loc_chng_inputbx").focus();
        setTimeout(function () {
            $('.pin_changebtn').addClass("chk_pin");
        }, 500);
    });


    $(document).on("click", ".pin_changebtn.chk_pin", function () {
        if ($(".pin_changebtn").hasClass("chk_pin")) {
            $(this).prev(".change_loc_wrap").find(".loc_chng_inputbx").removeClass("active");
            $(this).html("Change");
            setTimeout(function () {
                $('.pin_changebtn').removeClass("chk_pin");
            }, 500);
        };
    });


    $(".head_subnav_list li a").click(function (e) {
        e.stopPropagation();
    });


    $(".ja_detail_price_break").click(function () {
        $(this).closest(".section-wrapper").find(".ja_pricebreakup_lst").slideToggle();
    });


    $(".progress_bar .circle").hover(function () {
        $(this).trigger('click');
    });


    $(".gift_wrap_popfullbtn").click(function () {
        var giftwrap_topsec = $(".giftwrap_poptop_sec");
        var girtwrap_botsec = $(".giftwrapdetails_container");
        giftwrap_topsec.slideToggle(300);
        girtwrap_botsec.slideToggle(300);
        $(this).toggleClass('open');
    });


    $(".RateChange_list li").click(function () {
        var SelectedCurrency = $(this).html();
        $(".active_currency").html(SelectedCurrency);
    });


    $(window).on("scroll", function () {
        var ScrPos = $(window).scrollTop();
        ShowScrolltopTrigger(ScrPos);
        FixNavbar(ScrPos);
    });


    $(".Gototop").click(function () {
        $("html, body").animate({
            scrollTop: $('body').offset().top - 10
        }), 2000;
    });


    $('#ja_latest_carrosle').on('slid.bs.carousel', function () {
        ChangeActiveslide();
    });


//    $(".filter_tag_close").click(function () {
//        
//        $(this).parent(".filter_tag").remove();
//    });


    $(".ja_filter_drpdwn").click(function () {
        $("body").trigger("hover");
    });





    // search suggesions
    var i = 1;
    $('body').on('keyup', 'input.suggension_box_input', function (e) {
        $(window).scroll(function () {
            $('.seach_option').hide();
        });
        var inval = $(this).val();

        $(this).siblings('.seach_option').show();
        var searchul = $(this).siblings('.seach_option').find('.searchul');
        var searchul_li = searchul.find('li');
        if (e.keyCode == 40) {
            searchul_li.filter('.searchlist' + i).addClass('active');
            searchul_li.not('.searchlist' + i).removeClass('active');
            searchul_li.filter('.searchlist' + i).closest('div.seach_option').scrollTop(searchul_li.filter('.searchlist' + i).index() * searchul_li.filter('.searchlist' + i).outerHeight());
            $(this).val(searchul_li.filter('.searchlist' + i).text().trim());

            if (searchul_li.length == i) {
                var o = searchul_li.length;
                searchul_li.filter('.searchlist' + o).addClass('active');
                $(this).val(searchul_li.filter('.searchlist' + o).text().trim());
            } else if (searchul_li.length < i) {
                return false;
            } else {
                i++;
            }
        } else if (e.keyCode == 38) {
            if (i > 1) {
                i--;
                searchul_li.filter('.searchlist' + i).addClass('active');
                searchul_li.not('.searchlist' + i).removeClass('active');
                searchul_li.filter('.searchlist' + i).closest('div.seach_option').scrollTop(searchul_li.filter('.searchlist' + i).index() * searchul_li.filter('.searchlist' + i).outerHeight());
                $(this).val(searchul_li.filter('.searchlist' + i).text().trim());

            } else if (i <= 1) {

                searchul_li.filter('.searchlist1').addClass('active');
                $(this).val(searchul_li.filter('.searchlist1').text().trim());
                i = i + 1;
            }

        } else if (e.keyCode == 13) {
            $('.seach_option').hide();
        }
    }).on('blur', 'input.suggension_box_input', function () {
        $(this).siblings('.seach_option').hide();
        i = 1;
    });


    // notifyMe
    $(".notivyme_ico").on('click', function () {
        $(".notifyMe_popwrap").show();
    });
    $(".close_notifyme").on('click', function () {
        $(".notifyMe_popwrap").hide();
    });


    // checkout affix
    if ($('.section-wrapper').hasClass('myAccount_bg')) {


        var top_height = $('.oro_headerSection').height();
        var top_height2 = $('.oro_nav_section').height();
        var affix_btm = $('.myAccount_bg').position();
        var affix_top = parseInt(affix_btm.top + $('.myAccount_bg').outerHeight());
        var affix_btmhgt = ($(document).outerHeight()) - (affix_top) + (top_height + top_height + top_height2);
        $(".mycart_rightWrap").affix({
            offset: {
                top: affix_btm.top,
                bottom: affix_btmhgt
            }
        });
    }

    // detail affix
    if ($('.ja_large_container').hasClass('ja_detail_affix')) {
        var detail_top = $('.ja_detail_affix').position().top;
        var detail_hgt = parseInt(detail_top + $('.ja_detail_affix').outerHeight());
        var detail_btm = ($(document).outerHeight()) - (detail_hgt);
        $('.prd_zoom_container').affix({
            offset: {
                top: detail_top,
                bottom: detail_btm
            }
        });
    }


    // whishlist icon
    //  $('.whislist_icon').on('click', function() {
    //     $(this).find('.active_heart_icon').show();
    //     $(this).find('.deactivate_heart_icon').hide();
    // });
    $('body').on('click', '.whislist_icon', function () {
        var gl_func = $(this).attr('data-func');
        if (gl_func == "add") {
            $(this).find('.active_heart_icon').show();
            $(this).find('.deactivate_heart_icon').hide();
        } else {
            $(this).find('.active_heart_icon').hide();
            $(this).find('.deactivate_heart_icon').show();
        }
    });


    // education page
    $('.diamond_btn_main_bg #toggle-view li').click(function () {
        $(this).toggleClass('active');
        $(this).siblings().removeClass('active');
    });




    /* responsive*/
    $(".nav2trigger").click(function (e) {
        e.stopPropagation();
        $(".header_btm_nav_wrap").toggleClass('shw');

    });

    if (WndwWidth < 1025) {

        // creating overlay
        $("body").find('.oro_nav_top_section').append('<span class="blk_overlaycstm"></span>');

        // user icon
        var gift_trigger_ico = $('.gift_trigger.user_responly').wrap();

        // appending scheme and giftcart to right click
        var gift_sec_lnks = $(".ja_nav_sec").find(".ja_giftcard_navlst").html();
        $(".head_subnav_list").append(gift_sec_lnks);

        // add user account nav section
        $(gift_trigger_ico).insertAfter(".headerSection .ja_tp_sin_supwrap");
        $(".ja_nav_sec").find(".ja_giftcard_navlst").remove();
        // $(".ja_nav_sec").find(".user_navlist").remove();
        $(".ja_nav_sec").find(".user_navlist").appendTo('.oro_navigation_wrapper');

        // add hangburger menu to left of header
        var collapsico = $(".ja_mega_nav").wrap();
        $(collapsico).insertBefore('.LogoWrapper');
        // $(".ja_nav_sec .ja_mega_nav").remove();

        var myAccountnav = $(".ja_tp_sin_supwrap .user_nav_trigger .user_navlist").wrap();
        $(myAccountnav).insertAfter('.ja_nav_lst');
        $(".ja_tp_sin_supwrap .user_nav_trigger .user_navlist").remove();

        var signinsec = $(".ja_tp_sin_supwrap").wrap();
        $(signinsec).insertAfter('.ja_nav_lst');
        $(".headerSection .ja_tp_sin_supwrap").remove();

        // overlay click
        $(".blk_overlaycstm").click(function () {
            $(".blk_overlaycstm").removeClass('shw');
            $(".navigation_wrapper").removeClass('res_nav_active');
            $("body").css("overflow", "auto");
            $('.ja_loc_nav').removeClass('active');
            $('header').removeClass('z-index-999');
        });

        // hangburg click
        $(".ja_mega_nav").click(function (e) {
            e.stopPropagation();
            $(".navigation_wrapper").toggleClass('res_nav_active');
            $(".blk_overlaycstm").toggleClass('shw');
            if ($(".navigation_wrapper").hasClass('res_nav_active')) {
                $("body").css("overflow", "hidden");
            } else {
                $("body").css("overflow", "auto");
            }
        });


        $(".ja_latest_cir_lst li a").click(function () {
            $("html, body").animate({
                scrollTop: $('.ja_latest_sliderwrapper').offset().top - 150
            }), 2000;
        });

        // responsive nav bar click -- arrow icon only
        $(document).on("click", ".ja_navbar li.has_sub .ja_nav_wrap .ja_nav_angelico", function (e) {
            $(this).parents("li.has_sub").find(".ja_meganav_wrapper").toggleClass('active');
            $(this).parents("li.has_sub").toggleClass('down_arw').siblings().removeClass('down_arw');
            $(this).parents("li.has_sub").siblings().find(".ja_meganav_wrapper.active").removeClass('active');
        });


        // responsive nav bar click inner li
        $(".ja_megnav_lnklst li").not(":nth-child(1)").css("display", "none");
        $(".ja_megnav_lnklst").click(function () {
            $(this).toggleClass('opn');
        });

        $(document).on("click", ".ja_navbar li.has_sub .ja_nav_wrap .ja_nav_angelico", function () {
            var focusElement = $(this).siblings().attr('class');
            document.querySelector('.' + focusElement).scrollIntoView({
                behavior: 'smooth'
            });
        });



    } else {

    }




    // compare responsive
    var resp_legth = $('.cmpar_right_vrtcl:nth-child(2) .cmpar_right_inr').length * 200;
    $('.cmpar_right_vrtcl').css({
        "width": resp_legth + "px"
    });
    $('.cmpr_head_inr').on('click', 'span.search_ico', function () {
        $(this).siblings('.cmpr_p_search').toggle();
        $(this).siblings('.cmpr_p_search').find('.input_srch').focus();
    }).on('keyup', '.input_srch', function () {
        $(this).next('.cmpr_p_sgsn').show();
    }).on('click', '.cmpr_p_sgsn li', function () {
        var sug_vl = $(this).find('a').text();
        $(this).parents('.cmpr_p_search').find('.input_srch').val(sug_vl);
        $(this).parents('.cmpr_p_name').find('.cmpr_name').html(sug_vl);
        $(this).parents('.cmpr_p_search').hide();
    });


    $('.input_srch').blur(function () {
        var par = $(this).parent('.cmpr_p_search');
        setTimeout(function () {
            par.hide();
        }, 100);
    });

    if (WndwWidth < 651) {
        $(".ja_megnav_lnklst li").not(":nth-child(1)").css("display", "none");
        var resp_legth = $('.cmpar_right_vrtcl:nth-child(2) .cmpar_right_inr').length * 150;
        $('.cmpar_right_vrtcl').css({
            "width": resp_legth + "px"
        });
    }

    if (WndwWidth < 392) {
        $(".ja_megnav_lnklst li").not(":nth-child(1)").css("display", "none");
        var resp_legth = $('.cmpar_right_vrtcl:nth-child(2) .cmpar_right_inr').length * 90;
        $('.cmpar_right_vrtcl').css({
            "width": resp_legth + "px"
        });
    }



    //media page
    $(".video_thumb_wrap").on("click", function () {
        $(".video_iframe").attr("src", " ");
        var video_lnk = $(this).attr("data-videourl");
        $(".video_iframe").attr("src", video_lnk);
    });

    $('.video_iframe').on('shown.bs.modal', function () {
        $(".video_iframe").attr("src", " ");
    });

    $(".video_cls_btn").on("click", function () {
        $(".video_iframe").attr("src", " ");

    });




    var wndw_width = $(window).width();

    var filtby_cunt = $('.ja_filter_drp_lst li .ja_filter_drpdwn').length;


    if (wndw_width >= 1025) {
        if (filtby_cunt == 3) {
            $('.ja_filter_wrapper.ja_filter_ul .ja_filter_drp_lst>li').css({
                "width": "33.3%"
            });
            $('.ja_filter_wrapper.ja_filter_ul .ja_filter_drp_lst>li:last-child').css({
                "padding-right": "0px"
            });
        } else if (filtby_cunt > 3) {
            $('.ja_filter_wrapper.ja_filter_ul .ja_filter_drp_lst>li').css({
                "width": "25%"
            });
            $('.ja_filter_wrapper.ja_filter_ul .ja_filter_drp_lst>li:nth-child(4n+4)').css({
                "padding-right": "0px"
            });
            $('.ja_filter_wrapper.ja_filter_ul .ja_filter_drp_lst>li:nth-child(5n+5)').css({
                "padding-left": "0px"
            });
        }




        // scroll filtering
        $(window).on("scroll", function () {
            var ScrPos = $(window).scrollTop();
            var filtd_hgt = parseInt($('.ja_filter_ul .ja_filter_ul_wrp').outerHeight());
            if (ScrPos > 200) {
                // copy the filter and sorting
                $('.filter_left_fix').addClass('active');
                $(".fiter_fixed_topbar .fiter_fixed_ul").append($(".ja_filter_wrapper.ja_filter_ul .ja_filter_ul_wrp"));
                $(".fiter_fixed_topbar .fiter_fixed_filtrd").append($(".filter_by_wrapper .ja_filterd_itm"));
                $(".fiter_fixed_topbar .fiter_fixed_filtrd").prepend($(".ja_hm_listing_inner .filter_by_txt"));
                $('.fiter_fixed_topbar_sort').append($('.ja_listing_sortng_wrp .ja_listing_filternav_lst'));
                $(".ja_filter_wrapper.ja_filter_ul").css({
                    "min-height": +filtd_hgt
                });

            } else {
                $('.filter_left_fix').removeClass('active');
                $(".ja_filter_wrapper.ja_filter_ul").append($(".fiter_fixed_topbar .fiter_fixed_ul .ja_filter_ul_wrp"));
                $(".filter_by_wrapper").append($(" .fiter_fixed_topbar .fiter_fixed_filtrd .ja_filterd_itm"));
                $('.ja_listing_sortng_wrp').append($('.fiter_fixed_topbar_sort .ja_listing_filternav_lst'));
                $(".ja_hm_listing_inner .filtr_text_wp").append($(".fiter_fixed_topbar .fiter_fixed_filtrd .filter_by_txt"));
                $(".ja_filter_wrapper.ja_filter_ul").css({
                    "min-height": "auto"
                });
            }
        });






        // megamenu list
        var ident = 0;
        $('.ja_nav_lst .has_sub').not(':first-child').find('.ja_meganav_wrapper .ja_megnav_lnklst').each(function () {
            // console.log($(this));
            var mega_list_h = $(this).outerHeight();
            if (mega_list_h > 306) {
                $(this).parents('.ja_meganav_wrapper').find('.left_nav_width.list_over_remove').remove();
                $(this).parent().parent().removeClass('col-md-6').removeClass(' col-sm-6');
                $(this).parent().parent().siblings().removeClass('col-md-6').removeClass(' col-sm-6');
                $(this).parent().parent().parent().parent().removeClass('col-md-6');
                $(this).parent().parent().parent().parent().addClass('col-md-12').addClass('col-sm-12');
                $(this).parent().parent().addClass('col-md-4').addClass(' col-sm-4').addClass('list_ext_ad');
                $(this).parent().parent().siblings('.left_nav_width').addClass('col-md-4').addClass(' col-sm-4');

                var first_li = $(this).find('li:first-child').wrap().clone();

                $("<div class='col-md-4 left_nav_width col-sm-4 ja_list_over" + ident + "'><div class='ja_megnav_innerlst_wrap'><ul class='ja_megnav_lnklst'></ul></div></div>").insertAfter($(this).parent().parent());
                $(".ja_list_over" + ident + " ul").append(first_li);

                var loc_li_h = 0;
                var count = 0;

                $(this).find('li').each(function () {
                    var li_h = $(this).outerHeight();
                    loc_li_h = loc_li_h + li_h;

                    if (loc_li_h < 270) {
                        count++;
                    } else {
                        count++;
                        var m_ex = $(this).clone();
                        $('.ja_list_over' + ident + ' ul').append(m_ex);
                        $(this).css("cssText", "display:none !important;");
                    }
                });
            }
            ident++;
        });
    }




    if (wndw_width >= 1025) {

        $('.filter_left_fix').on('click', '.filter_filter', function () {
            $('.fiter_fixed_topbar').toggleClass('active');
            $('.fiter_fixed_topbar_sort').removeClass('active');

            $(window).on("scroll", function () {
                setTimeout(function () {
                    $('.fiter_fixed_topbar').removeClass('active');
                    $('.fiter_fixed_topbar_sort').removeClass('active');
                }, 200);
            });
        });

        $('.filter_left_fix').on('click', '.filter_sort', function () {
            $('.fiter_fixed_topbar_sort').toggleClass('active');
            $('.fiter_fixed_topbar').removeClass('active');

            $(window).on("scroll", function () {
                setTimeout(function () {
                    $('.fiter_fixed_topbar_sort').removeClass('active');
                    $('.fiter_fixed_topbar').removeClass('active');
                }, 200);
            });
        });




        // list click filtering
        $('.ja_filter_wrapper ').on('click', '.ja_filter_ul_wrp .ja_filter_drpdwn', function () {
            $(this).parent().siblings().find('.ja_filter_drpdwn').removeClass('active');
            $(this).parent().siblings().find('.ja_filter_drpdwn.activing .ja_filter_sublst_wrapper, .ja_filter_sublst_wrapper').css({
                'height': '0px'
            });
            $(this).addClass('active');

            var ful_h = 0;
            $(this).find('.ja_filter_sublst li').each(function () {
                ful_h += parseInt($(this).height());
            });

            if (ful_h > 200) {
                $(this).find('.ja_filter_sublst').css({
                    'overflow-x': 'hidden',
                    'overflow-y': 'scroll'
                });
                $(this).find('.ja_filter_sublst_wrapper').css({
                    'height': '230px'
                });

            } else {
                $(this).addClass('activing').find('.ja_filter_sublst_wrapper').css({
                    'height': ful_h + 80
                });
                $(this).find('.ja_filter_sublst_wrapper .ja_filter_sublst').css({
                    'height': ful_h + 70
                });
            }
        });

        $('.fiter_fixed_ul').on('click', '.ja_filter_drp_lst .ja_filter_drpdwn', function () {
            $(this).parent().siblings().find('.ja_filter_drpdwn').removeClass('active');
            $(this).parent().siblings().find('.ja_filter_drpdwn.activing .ja_filter_sublst_wrapper, .ja_filter_sublst_wrapper').css({
                'height': '0px'
            });
            $(this).addClass('active');

            var ful_h = 0;
            $(this).find('.ja_filter_sublst li').each(function () {
                ful_h += parseInt($(this).height());
            });

            if (ful_h > 200) {
                $(this).find('.ja_filter_sublst').css({
                    'overflow-x': 'hidden',
                    'overflow-y': 'scroll'
                });
                $(this).find('.ja_filter_sublst_wrapper').css({
                    'height': '230px'
                });

            } else {
                $(this).addClass('activing').find('.ja_filter_sublst_wrapper').css({
                    'height': ful_h + 80
                });
                $(this).find('.ja_filter_sublst_wrapper .ja_filter_sublst').css({
                    'height': ful_h + 70
                });
            }
        });


        $('.ja_filter_ul_wrp').on('click', '.ja_filter_sublst_clse', function (e) {
            e.stopPropagation();
            $(this).parents('.ja_filter_drpdwn').removeClass('active');
            $(this).parent().css({
                'height': '0px'
            });
        });




    } else {
        $(".fiter_fixed_topbar .fiter_fixed_ul").append($(".ja_filter_wrapper.ja_filter_ul .ja_filter_ul_wrp"));
        $(".fiter_fixed_topbar .fiter_fixed_filtrd").append($(".filter_by_wrapper .ja_filterd_itm"));
        $(".fiter_fixed_topbar .fiter_fixed_filtrd").prepend($(".ja_hm_listing_inner  .filtr_text_wp .filter_by_txt"));
        $('.fiter_fixed_topbar .fiter_fixed_filtrd').insertBefore('.fiter_fixed_topbar .fiter_fixed_ul');
        $('.fiter_fixed_topbar_sort').append($('.ja_listing_sortng_wrp .ja_listing_filternav_lst'));

        $('.filter_left_fix').on('click', '.filter_filter', function () {
            $('.fiter_fixed_topbar').toggleClass('active');
            $('.fiter_fixed_topbar_sort').removeClass('active');
            $(this).toggleClass('active');
            $(this).parent().toggleClass('active');
        });

        $('.filter_left_fix').on('click', '.filter_sort', function () {
            $('.fiter_fixed_topbar_sort').toggleClass('active');
            $('.fiter_fixed_topbar').removeClass('active');

            $(window).on("scroll", function () {
                setTimeout(function () {
                    $('.fiter_fixed_topbar_sort').removeClass('active');
                }, 400);
            });
        });



        $('.filter_left_fix').on('click', '.filter_close', function () {
            $('.fiter_fixed_topbar').removeClass('active');
            $(this).parent().removeClass('active');
            $(this).siblings().removeClass('active');
        });


        // filter left collapsing
        $('.fiter_fixed_topbar').on('click', '.fiter_fixed_ul .ja_filter_drp_lst li.ja_filter_drp_li', function () {
            $(this).siblings().removeClass("active");
            $(this).toggleClass('active');
        });


        $(window).on("scroll", function () {
            setTimeout(function () {
                $('.store_finder').removeClass('active');
            }, 200);
        });




        // resp cfilter overlay clse
        $('.ja_prd_listing_wrapper ').on('click', '.fiter_fixed_topbar_overlay', function () {
            $(this).parent().find('.fiter_fixed_topbar').removeClass('active');
        });

    }

    // responsive filter

    if (wndw_width < 560) {
        $('.filter_left_fix').on("click", '.filter_filter', function () {
            $(this).removeClass('active');
            setTimeout(function () {
                $('.filter_left_fix .filter_close').insertBefore($('.fiter_fixed_topbar .fiter_fixed_filtrd'));
            }, 300);
        });

        $('.fiter_fixed_topbar').on('click', '.filter_close', function () {
            $(".filter_left_fix, .filter_filter").removeClass('active');
            $('.fiter_fixed_topbar .filter_close').insertBefore($('.filter_left_fix .filter_filter'));
            $('.fiter_fixed_topbar').removeClass('active');
        });
    }


    $(".ja_mega_nav").click(function (e) {
        $('.fiter_fixed_topbar_sort').removeClass('active');
    });
    $(".nav2trigger, .ja_notification_wrap").click(function (e) {
        $('.fiter_fixed_topbar_sort').removeClass('active');
        $('.fiter_fixed_topbar').removeClass('active');
        $(".filter_left_fix, .filter_filter").removeClass('active');
        $('.ja_new_arriv_jew_sec').find('.filter_left_fix').addClass('z_index_disapling');
    });


    // filter by load more
    //     filterTagCountAndCheck();

    $('.ja_prd_listing_wrapper').on('click', '.filter_by_hidden', function (event) {
        var wndw_width = $(window).width();
        if (wndw_width < 1025) {
            event.stopPropagation();
            var fltr_load = $('.filter_alltag').prop('scrollHeight');
            var fil_cnt = $('.filter_alltag .filter_tag').length;
            var fil_all_wdt = $('.filter_alltag').width();
            //        console.log(fltr_load);

            $(this).siblings('.filter_alltag').toggleClass('full_opn');
            setTimeout(function () {
                if ($('.filter_alltag').hasClass('full_opn')) {
                    $('.filter_alltag').css({
                        "max-height": fltr_load
                    });
                } else {
                    $('.filter_alltag').css({
                        "max-height": "29px"
                    });
                }
            }, 1);

            if ($(this).siblings('.filter_alltag').hasClass('full_opn')) {
                $('.filter_by_hidden.filter_by_show').show();
                $('.filter_by_hidden.filter_by_showing').hide();
            } else {
                $('.filter_by_hidden.filter_by_show').hide();
                $('.filter_by_hidden.filter_by_showing').show();
            }
        }
    });
    if (wndw_width < 1025) {
        // location
        $('.shop_nav_wrap_hd').append($('.shop_nav_wrap .shop_info_nav'));




        // goldrate
        $('.gold_rate_wrap').on('click', '.ja_gldratwrapper_trigger', function () {
            $(this).parent().addClass('active');
            $('.blk_overlaycstm').addClass('shw');
            $('header').addClass('z-index-999');
            $('body').css({
                'overflow': 'hidden'
            });
        });
        $('.gold_rate_wrap').mouseleave(function () {
            $('.blk_overlaycstm').removeClass('shw');
            $('header').removeClass('z-index-999');
            $(this).removeClass('active');
            $('body').css({
                'overflow': 'auto'
            });
        });
        $('.gold_rate_wrap').on('click', '.goldrate_clse', function () {
            $('.blk_overlaycstm').removeClass('shw');
            $('header').removeClass('z-index-999');
            $(this).parents('.gold_rate_wrap').removeClass('active');
            $('.gold_rate_wrap').unbind("hover");
            $('body').css({
                'overflow': 'auto'
            });

        });
    }

    // list view
    $('.prdlst_viewchangewrapper').on('click', '.prdview_chng_btn.ja_btn_list', function () {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $('.ja_prdct_listing_inner .ja_list_wrap').addClass('ja_listGrid_wrap');
    }).on('click', '.prdview_chng_btn.ja_btn_Grid', function () {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $('.ja_prdct_listing_inner .ja_list_wrap').removeClass('ja_listGrid_wrap');
    });


    // compare product
    // $('.Rtable-cell').on('click','.cls_btn',function(){
    //    var a = $(this).parent().attr("data-remove");
    //    $(this).parents('.Rtable ').find('.item_'+a).empty();
    // });

    // $('.rsp_cmpar_wrp').on('click','.cmpr_cls',function(){
    //     var atrval = $(this).parent().attr('data-rsp-remove');
    //     $(this).parents('.rsp_cmpar_wrp').find('.product'+atrval).find('.cmpar_right_inr').empty();
    //     $(this).parent('.rsp_cmpr_head').addClass('empty_item');
    //     $(this).parent('.rsp_cmpr_head').find('.cmpr_p_search').children('.input_srch').focus();
    //  });


    // loaction finder

    $('.shop_info_nav li').on('click', 'a', function () {
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');

        var scroll_cnt = $(this).parent().attr("data-scrollfrom");

        $('html, body').animate({
            scrollTop: ($('.' + scroll_cnt).offset().top - 108)
        }, 500);
    });


    $('.store_header').on('click', '.ja_loc_hang', function () {
        $('.ja_loc_nav').addClass('active');
        $('.blk_overlaycstm').addClass('shw');
    });

    $('.loc_find_btn').on('click', function () {
        $('.store_header .store_finder').toggleClass('active');
    });




    // detail page pincodecheck
    $(".chek_pincode").click(function () {
        $(this).parent().parent().hide();
        $(this).parents('.ja_detail_border_bottom ').find('.pincode_rsultwrap').show();
    });

    $('.pincode_rsultwrap .chng_pin').click(function () {
        $(this).parent().hide();
        $(this).parents('.ja_detail_border_bottom ').find('.chek_pin_fulwrp').show();
    });



    // resposive icon arraingements
    if (WndwWidth < 992) {
        $('.user_responly').insertAfter('.RateChange-Wrapper');


        $('.compare_ico').insertAfter('.headerSection .notifi_ico_tp');
        var leg1 = $('.ja_large_container .Ja_feedbacktbtn').length;
        if (leg1 == 1) {
            var somthng = $('.ja_large_container .Ja_feedbacktbtn').html();
            $('.head_subnav_list').append('<li>' + somthng + '</li>');
        }
        var leg2 = $('.Ja_live_chatbtn .ja_live_chatbtn_txt').length;

        if (leg2 == 1) {
            var somthng1 = $('.Ja_live_chatbtn .ja_live_chatbtn_txt').html();
            $('.head_subnav_list').append('<li><a href="">' + somthng1 + '</a></li>');
        }





        var fil_leg = $('.filter_left_fix').length;

        $('.ja_srch_wrapper').on('click', '.right_icon_cls', function () {
            $(this).parents('.ja_srch_wrapper').removeClass('active');
            $('.ja_new_arriv_jew_sec').find('.filter_left_fix').removeClass('z_index_disapling');
        });
        $('.ja_srch_wrapper').on('focus', '.top_search_input', function () {
            $('.ja_new_arriv_jew_sec').find('.filter_left_fix').addClass('z_index_disapling');
        });

        if (fil_leg == 1) {
            $('.ja_srch_wrapper').addClass('extra_width_adjst');

            $('.ja_srch_wrapper').on('focus', '.top_search_input', function () {
                $(this).parents('.ja_srch_wrapper').addClass('active');
                $('.ja_new_arriv_jew_sec').find('.filter_left_fix').addClass('z_index_disapling');
            });

        }

    }

    if (WndwWidth < 480) {

        $('.ja_srch_wrapper').on('focus', '.top_search_input', function () {
            $(this).parents('.ja_srch_wrapper').addClass('active');
        });
        $('.ja_srch_wrapper').on('click', '.search_btn', function () {
            $(this).parents('.ja_srch_wrapper').removeClass('active');
        });


        $('.compare_ico').removeAttr('data-placement data-toggle title data-original-title');
    }



    cristmas();





});




function ChangeActiveslide() {
    var ActiveIndi = $(".ja_carr_indicators").find("li.active");
    var ActiveSlideVal = ActiveIndi.attr("data-slide-to");

    $(".ja_latest_cir_lst li").removeClass('active');
    var CirSlideVal = $(".ja_latest_cir_lst").find("[data-slide-to='" + ActiveSlideVal + "']");
    CirSlideVal.addClass('active');
}


function ShowScrolltopTrigger(scrpos) {
    var scrHeight = $(document).height();
    var scrHalf = scrHeight / 2;
    if (scrpos > scrHalf) {
        $(".Gototop").addClass('shw');
    } else {
        $(".Gototop").removeClass('shw');
    }
}


function FixNavbar(scrpos) {
    var WndwWidth = $(window).width();
    if (WndwWidth >= 1025) {

        var top_height = $(".ja_nav_sec").offset().top;

        if (scrpos > 220) {

            // location finder
            $('.store_header .store_finder .store_submenu').append($('.shop_info .shop_info_nav'));


            if ($(".ja_nav_sec").hasClass('fixnav')) {

            } else {
                $(".ja_nav_sec").addClass('fixnav');
                $(".ja_nav_sec.fixnav .ja_navbar .LogoWrapper").remove();
                $(".ja_nav_sec.fixnav .ContainerFull .ja_srch_wrapper").remove();
                $(".ja_nav_sec.fixnav .ContainerFull .RateChange-Wrapper").remove();
                $(".ja_nav_sec.fixnav .ContainerFull .ja_tp_crtlnk").remove();

                var logowap = $(".LogoWrapper").wrap().clone();
                var srchbx = $(".ja_srch_wrapper").wrap().clone();
                var raterng = $(".RateChange-Wrapper").wrap().clone();
                var crtico = $(".ja_tp_crtlnk").wrap().clone();

                $(".ja_nav_sec.fixnav .ja_navbar").prepend(logowap);
                $(".ja_nav_sec.fixnav .ContainerFull .ja_giftcard_navlst").before(raterng);
                $(".ja_nav_sec.fixnav .ContainerFull .RateChange-Wrapper").before(crtico);
                $(".ja_nav_sec.fixnav .ContainerFull .RateChange-Wrapper").before(srchbx);


                $('body').addClass('oro_p_adjst');
            }

        } else {
            $(".ja_nav_sec").removeClass('fixnav');

            // location finder
            $('.shop_info .shop_nav_wrap').append($('.store_header .shop_info_nav'));

            $('body').removeClass('oro_p_adjst');


        }
    }
}




function filterTagCountAndCheck() {
    var wndw_width = $(window).width();
    // filter by load more
    if (wndw_width < 1025) {
        var fltr_load = $('.filter_alltag').prop('scrollHeight');
        var fil_cnt = $('.filter_alltag .filter_tag').length;
        var fil_all_wdt = $('.filter_alltag').width();



        var fitr_temp_wdt = 0;
        var fil_tem_cnt = 0;

        $('.filter_alltag .filter_tag').each(function () {
            var width = $(this).outerWidth() + 2;
            fitr_temp_wdt = fitr_temp_wdt + width;
            if (fitr_temp_wdt <= fil_all_wdt) {
                fil_tem_cnt++;
                $('.filter_by_hidden.filter_by_showing').hide();
                $('.fiter_fixed_filtrd .ja_filterd_itm').css({
                    "margin-bottom": "10px"
                });
            } else {
                $('.filter_by_hidden.filter_by_showing').show();
                $('.fiter_fixed_filtrd .ja_filterd_itm').css({
                    "margin-bottom": "20px"
                });
            }
        });

        var fil_bal_cnt = fil_cnt - fil_tem_cnt;
        $('.filter_by_hidden span').html(fil_bal_cnt);

        $('.filter_tag .filter_tag_close').on('click', function () {
            fil_bal_cnt = fil_bal_cnt - 1;
            $('.filter_by_hidden span').html(fil_bal_cnt);

            var fitr_temp_wdt = 0;
            $('.filter_alltag .filter_tag').each(function () {
                var width = $(this).outerWidth() + 2;
                fitr_temp_wdt = fitr_temp_wdt + width;
            });

            if (fitr_temp_wdt <= fil_all_wdt) {
                $('.filter_by_hidden.filter_by_showing').hide();
                $('.fiter_fixed_filtrd .ja_filterd_itm').css({
                    "margin-bottom": "10px"
                });
            }

            if (fil_bal_cnt < 1) {
                $('.filter_by_hidden.filter_by_show').hide();
            }

        });
    }


}















function cristmas() {
    if ($('body.cristmas').length) {

        if ($('.ja_hm_bnr_slider_wrapper').length) {
            $('.ja_hm_bnr_slider_wrapper').append("<div class='cristmas_santa'><img src='images/santa.gif' alt=''></div>")
        }

    }
}