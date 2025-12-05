var base_url = $(".base_url").val();
// JavaScript Document
$.fn.preloader = function (options) {

    var defaults = {
        delay: 200,
        preload_parent: "",
        check_timer: 100,
        ondone: function () { },
        oneachload: function (image) { },
        fadein: 500,
    };

    // variables declaration and precaching images and parent container
    var options = $.extend(defaults, options),
        root = $(this), images = root.find("img").css({opacity: 0}), timer, counter = 0, i = 0, checkFlag = [], delaySum = options.delay;
    init = function () {

        timer = setInterval(function () {

            if (counter >= checkFlag.length)
            {
                clearInterval(timer);
                options.ondone();
                return;
            }

            for (i = 0; i < images.length; i++)
            {
                if (images[i].complete == true)
                {
                    if (checkFlag[i] == false)
                    {
                        checkFlag[i] = true;
                        options.oneachload(images[i]);
                        counter++;

                        delaySum = delaySum + options.delay;
                    }

                    $(images[i])
                            .delay(delaySum)
                            .animate(
                            {opacity: 1}, 
                            options.fadein,
                            function () {


                                if ($(this).parent().find(".gl_prodloader").remove())
                                {

                                    $(this).parent().find("img").removeAttr("style");
                                    $(this).parent().find("img").removeClass("gl_product_image");

                                }

                            });
                }
            }

        }, options.check_timer)


    };

    images.each(function () {

        checkFlag[i++] = false;


    });
    images = $.makeArray(images);


    var icon = jQuery("<img />", {

        id: 'loadingicon',
        src: base_url + 'static/frontend/gl_loader/loading2.gif'

    }).hide().appendTo("body");



    timer = setInterval(function () {

        if (icon[0].complete == true)
        {
            clearInterval(timer);
            init();
            icon.remove();
            return;
        }

    }, 10);

}