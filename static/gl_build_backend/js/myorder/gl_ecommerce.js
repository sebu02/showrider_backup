$(function() {

    $(".addreslst_radio").on('change', function() {
        $(this).parent(".radio_wrap").parent("li").parent("ul").find(".edit_btn").hide();
        $(".new_address_formouter").hide();
        $(".btn_wrap").hide();
        $(".addreslst_radio").removeAttr('checked');
        $(this).attr("checked", "checked");

        if ($(this).attr("checked", "checked")) {
            $(this).next("label").find(".btn_wrap").show();
            $(this).parent(".radio_wrap").parent("li").find(".edit_btn").show();
        }
    });

    $("a.add_new_address").click(function() {
        $(".new_address_formouter").show();
        $(".btn_wrap").hide();
        $(".addreslst_radio").removeAttr('checked');
    });

    $(".Checkout_stepslist .btn_change").on("click", function(e) {
        $(".Checkout_stepslist li").removeClass('active');
        $(this).parent(".header").parent("li").addClass('active');
        $(".Checkout_stepslist li.whitebox.active").prevAll("li.whitebox").addClass('closed');
        $(".Checkout_stepslist li.whitebox.active").nextAll("li.whitebox").removeClass('closed');
    });

    $(".btn_next_step").click(function() {
        $(".Checkout_stepslist li.whitebox.active").prevAll("li.whitebox").addClass('closed');
        $(".Checkout_stepslist li.whitebox.active").nextAll("li.whitebox").removeClass('closed');
    });
    $(".Checkout_stepslist li.whitebox.active").prevAll("li.whitebox").addClass('closed');




    $('.input_animation_wrap').on('click', 'input.inputbox,textarea.inputbox', function(event) {
        if ($(this).is(":focus")) {
            $(this).prev("label").addClass('active');
            $(this).css("padding-top", "20px");
        }
    });

    $('.input_animation_wrap').on('focus', 'input.inputbox,textarea.inputbox', function(event) {
        if ($(this).is(":focus")) {
            $(this).prev("label").addClass('active');
            $(this).css("padding-top", "20px");
        }
    });

    $('.input_animation_wrap').on('blur', 'input.inputbox,textarea.inputbox', function(event) {
        if ($(this).val()) {} else {
            $(this).prev("label").removeClass('active');
            $(this).css("padding-top", "0px");
        }
    });

    $('.input_animation_wrap').find("input.inputbox,textarea.inputbox").each(function() {

        if ($(this).val()) {
            $(".inputbox").prev("label").addClass('active');
            $("input.inputbox,textarea.inputbox").css("padding-top", "20px");
        } else {
            $(this).prev("label").removeClass('active');
            $(this).css("padding-top", "0px");
        }
    });
    // animated input box 


    // edit address
    $('.my_adrs_edit').click(function() {
        $(this).siblings('.my_adrsedit_wrap').addClass('active');
        $(this).parents('.addresslabel').find('.my_adrsedit_rmv').addClass('active');
        $(this).parents('.addresslabel').parent().siblings().find('.my_adrsedit_rmv').removeClass('active');
        $(this).parents('.addresslabel').parent().siblings().find('.my_adrsedit_wrap').removeClass('active');
    });

    $('.my_adr_btn').click(function() {
        $(this).parents('.addresslabel').find('.my_adrsedit_wrap,.my_adrsedit_rmv').removeClass('active');
    });



    // checkout
    $('.edit_btn').click(function() {
        $(this).css('display', 'none');
        $(this).siblings('.my_adrsedit_wrap').addClass('active');
        $(this).parent().find('.new_address_formouter').css('display', 'block');
        $(this).siblings('.radio_wrap').css('display', 'none');

    });

    $('.my_adr_btn').click(function() {
        $(this).parents('.my_adrsedit_wrap').removeClass('active');
        $(this).parents('.my_adrsedit_wrap').siblings('.edit_btn,.radio_wrap').css('display', 'block');
    });

    $(".addreslst_radio").on('change', function() {
        $(this).parents('.address_lst').find('.my_adrsedit_wrap.active').removeClass('active');
        $(this).parents('.address_lst').find('.radio_wrap').css('display', 'block');
    });

    $('.address_lstwrap .add_new_address_li').click(function() {
        $(this).siblings().find('.radio_wrap .test1').removeClass('test1');
        $(this).siblings().find(".addreslst_radio").prop('checked', false);
        $(this).siblings().find(".edit_btn").hide();
        $(this).siblings().find('.new_address_formouter').hide();
        $(this).siblings().find('.radio_wrap').show();
        $(this).siblings().find('.my_adrsedit_wrap.active').removeClass('active');

    });

    $('.address_lst').on('click', '.addreslst_radio', function() {
        $('.addreslst_radio').siblings('label').removeClass('test1');

    });


    $('.gift_card_wrap').on('click', function() {
        $('.gift_checkbox').prop('checked', false);
    });


    // track order progressbar

    var numSteps = $('.progress_bar:first .steps').length - 1;
    var per = 100 / numSteps;
    $('.progress_bar .steps').css({
        "width": per + "%"
    });


    var numTlte = $('.item_status_progresswrap:first ul.text_lst li').length;
    var pert = 100 / numTlte;
    $('.item_status_progresswrap ul.text_lst li').css({
        "width": pert + "%"
    });

    if (numSteps >= 1 && numSteps < 5) {
        $('.item_status_progresswrap ul.text_lst li:first-child').addClass('text-left-imp');
        $('.item_status_progresswrap ul.text_lst li:last-child').addClass('text-right-imp');
    } else {
        $('.item_status_progresswrap ul.text_lst li').removeClass('text-right-imp').removeClass('text-left-imp');
    }


    
    if ( $('.tab-pane.active .trck-detail').length > 2) {
        $('.tab-pane.active .trck-detail').parent().next('.trck-detail-more').show();
        var hgt = $('.tab-pane.active .trck-detail').height() + $('.tab-pane.active .trck-detail').next('.trck-detail').height() + 3;
        $('.tab-pane.active .trck-detail').parent('.trck-detail-wrp').css({
            "height": hgt,
            "overflow": "hidden"
        });

    } else {
        $('.tab-pane.active .trck-detail').parent().next('.trck-detail-more').hide();
    }


    $('.progress_bar .steps.active .circle, .progress_bar .steps.error .circle').hover(function() {
        $('.progress_bar .circle').removeClass('arwbtm');
        $(this).addClass('arwbtm');


        var locvar = $(this).parents('.item_status_progresswrap').find('.tab-pane.active .trck-detail');
        var leng = locvar.length;

        if (leng > 2) {
            locvar.parent().next('.trck-detail-more').show();
            var hgt = locvar.height() + locvar.next('.trck-detail').height() + 3;
            locvar.parent('.trck-detail-wrp').css({
                "height": hgt,
                "overflow": "hidden"
            });

        } else {
            locvar.parent().next('.trck-detail-more').hide();
        }
    });

    $('.tab-content').on('click', '.trck-detail-more', function() {
        $(this).siblings('.trck-detail-wrp').toggleClass('expand');
    });

    var locvar = $('.item_status_progresswrap').find('.tab-pane.active .trck-detail');
    var leng = locvar.length;

    if (leng <= 2) {
        locvar.parent().next('.trck-detail-more').hide();
    }

    $('.item_status_progresswrap_rsp').on('click', '.text_lst_rsp', function() {
        $(this).hide();
        $(this).next('.text_lst_rsp_dtl').show().addClass('active');
        $(this).nextAll('.text_lst_rtrn').show();

    }).on('click', '.text_lst_rtrn', function() {
        $(this).hide();
        $(this).prev('.text_lst_rsp_dtl').hide();
        $(this).prevAll('.text_lst_rsp').show();
    });



    // checkout page active 
    var wndw_width = $(window).width();
    var smp_chk = $('.myAcctcontainer .Checkout_stepslist').find('li.active').length;

    if (wndw_width < 1025) {

        if (smp_chk == 1) {
            var pos_top = $('.myAcctcontainer .Checkout_stepslist li.active').position().top;
            $("html, body").animate({
                scrollTop: $('body').offset().top = pos_top - 100
            }, 2000);
        }
    } else {
        if (smp_chk == 1) {
            var pos_top = $('.myAcctcontainer .Checkout_stepslist li.active').position().top;
            $("html, body").animate({
                scrollTop: $('body').offset().top = pos_top - 110
            }, 2000);
        }
    }



});