


/***********    Common functions ************/
//      file size byte to mb conversion function 

function bytesToSizenotrounded(bytes) {

    if (bytes == 0)
        return '0 Bytes';
    var floatmb = (bytes / 1048576).toFixed(2) + "MB";
    return floatmb;

}


//  End of  file size byte to mb conversion function 


// element remove function from array
function remove(array, element) {
    const index = array.indexOf(element);
    array.splice(index, 1);
}
// End of  element remove function from array      



/***********  EOF Common functions **********/




//file order save function
function save_image_order(imageid) {

    finalImages = imageid + '-final_images';

    checkfilevalidation(imageid);

    var new_order = new Array();
    $('ul.' + imageid + '-image1 li').each(function () {
        new_order.push($(this).attr("id"));
    });
    document.getElementById(finalImages).value = new_order;


}
//    End of  file order save function    

var img_class = '';

$(document).ready(function () {
    $('.gl_uploadimage').on('change', function () {

        var imageid = $(this).attr('data-imageid');

        img_class = imageid;

        var manipulation = $(this).attr('data-manipulation');
        var upload_type = $(this).attr('data-uploadtype');
        var max_size = $(this).attr('data-maxsize');
//        var controller = $(this).attr('data-controller');
        var controller = 'commoninputadmin';
        var formtype = $(this).attr('data-formtype');
        var formclass = $(this).attr('data-formclass');

        var combo_name = $(this).attr('data-combo_name');
        var input_name = $(this).attr('data-input_name');
        $('.file_input_name').val(input_name);
        $('.combo_name').val(combo_name);
        $(this).prop("required", false);

        //validation

//            alert(imageid);
//            alert(manipulation);
//            alert(upload_type);
//            alert(max_size);
//            alert(controller);
//            alert(formtype);



        var base_url = $(".base_url").val();

        var check1 = 0;
        var check2 = 0;
        var check3 = 0;
        var check4 = 0;

        if (window.File && window.FileReader && window.FileList && window.Blob) {

            if (!$('.' + imageid).val()) //check empty input filed
            {
                $("#" + imageid + "-output").html("Please choose your Image !");

                check2 = 1;

            } else {

                check2 = 0;
            }

            var ftype = $('.' + imageid)[0].files[0].type; // get file type

            var fsize = $('.' + imageid)[0].files[0].size; //get file size




            var mime_types = [
                'text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', //csv
                'application/pdf', 'application/x-download', //pdf
                'application/excel', 'application/vnd.ms-excel', 'application/msexcel', //xls
                'application/powerpoint', 'application/vnd.ms-powerpoint', //ppt
                'audio/mpeg', , //mpga
                        'text/plain', //txt
                'audio/mpeg', //mp2
                'audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3', //mp3
                'image/bmp', //bmp
                'image/gif', //gif
                'image/jpeg', 'image/pjpeg', //jpeg
                'image/jpeg', 'image/pjpeg', //jpg
                'image/jpeg', 'image/pjpeg', //jpe
                'image/png', 'image/x-png', //png
				'image/webp', //webp
                'video/mpeg', //mpeg
                'video/mpeg', //mpg
                'video/mpeg', //mpe
                'video/quicktime', //qt
                'video/quicktime', //mov
                'video/x-msvideo', //avi
                'video/x-sgi-movie', //movie
                'application/msword', //doc
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', //docx
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', //xlsx
                'application/msword', 'application/octet-stream', //word
                'application/excel', //xl
                'image/svg+xml', //svg
				'video/mp4', //mp4
				'application/mp4' //mp4
            ];
            var element_key = mime_types.indexOf(ftype);
            if (element_key === -1) {
                $("#" + imageid + "-output").html("<b>" + ftype + "</b> Unsupported file type!");
                check3 = 1;
            } else {
                check3 = 0;
            }


            var result = $('.' + imageid)[0].files;
            for (var x = 0; x < result.length; x++) {
                var fle = result[x];
                // console.log(fle.size);  
                var fsize = fle.size;
                var maxSize = max_size;
                var fileSize = maxSize * 1048576;

                //Allowed file size is less than 5 MB (1048576)



                if (fsize > fileSize)
                {
                    $("#" + imageid + "-output").html("<b>" + bytesToSizenotrounded(fsize) + "</b>" + fle.name + " is too big, it should be less than " + bytesToSizenotrounded(fileSize));
                    check4 = 1;
                    throw new Error("File Size Is Maximum!");
                } else
                {
                    check4 = 0;

                }
            }



        } else
        {
            //Output error to older unsupported browsers that doesn't support HTML5 File API
            $("#" + imageid + "-output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
            check1 = 1;
        }


        //validation


        var checktotal = check1 + check2 + check3 + check4;



        if (checktotal == 0) {

            var formUrl = base_url + controller + "/bannerUpload";

            var files = new FormData($("." + formclass)[0]);


            $.ajax({
                url: formUrl,
                type: 'POST',
                data: files,
                mimeType: "multipart/form-data",
                beforeSend: function () {
                    $('.' + imageid + '-uploading').show();
                    $('.showhide-btn').prop('disabled', true);

                },
                contentType: false,
                cache: false,
                processData: false,
                success: function (data, textSatus, jqXHR) {
                    //now get here response returned by PHP in JSON fomat you can parse it using JSON.parse(data)

                    $('.' + imageid + '-uploading').hide();
                    $('.showhide-btn').prop('disabled', false);

                    if (data.indexOf('***') != -1)
                    {

                    } else
                    {

                        //$('.image1').html('');
                        var imagearray = data.split(",");

                        var filecount = $(".imagedivsGallery").length;

                        for (i = 0; i < imagearray.length; i++)
                        {

                            if (imagearray[i])
                            {

                                var imgcount = filecount + i;

                                var imagearray2 = "'" + imagearray[i] + "','" + imgcount + "','" + imageid + "'";
                                var seo_div = '';

                                if (formtype == 'add_title')
                                {
                                    seo_div = '<input type="text" required placeholder="Title" name="img_title[]" style="margin-bottom:10px";><textarea name="img_desc[]" rows="2" placeholder="Description"></textarea><div id="header' + imgcount + '" class="header"><i class="icon16 icomoon-icon-plus-circle"></i><span title="Used for Seo purposes on Image Alt,Title" class="tip">Seo Alt & Title</span></div><div id="description' + imgcount + '" class="description" style="display:none;"><input type="text" placeholder="Alt" name="seo_alt[]" style="margin-bottom:10px"><input type="text" placeholder="Title" name="seo_title[]"></div>';
                                } else if (formtype == 'add') {
                                    seo_div = '<div id="header' + imgcount + '" class="header"><i class="icon16 icomoon-icon-plus-circle"></i><span title="Used for Seo purposes on Image Alt,Title" class="tip">Seo Alt & Title</span></div><div id="description' + imgcount + '" class="description" style="display:none;"><input type="text" placeholder="Alt" name="seo_alt[]" style="margin-bottom:10px"><input type="text" placeholder="Title" name="seo_title[]"></div>';
                                }


                                if (manipulation == 'No') {

                                    var image_content = '<li class="ui-state-default productfile' + imgcount + ' imagedivsGallery ngo_imagedivs" id="' + imagearray[i] + '" > <span aria-hidden="true" style=font-size:25px;" class="icon icomoon-icon-file-6"></span>&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage(' + imagearray2 + ');" style="cursor:pointer;">X</span><br><a href="' + base_url + 'media_library/' + imagearray[i] + '" target="_blank">' + imagearray[i] + '</a>' + seo_div + '</li>';



                                } else {

                                    var image_content = '<li class="ui-state-default productfile' + imgcount + ' imagedivsGallery ngo_imagedivs form-row" id="' + imagearray[i] + '" ><img width="100" height="100" src="' + base_url + 'media_library/' + imagearray[i] + '">&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage(' + imagearray2 + ');" style="cursor:pointer;">X</span><a href="' + base_url + 'media_library/' + imagearray[i] + '" rel="prettyPhoto" title="' + imagearray[i] + '" class="txtcenter">' + imagearray[i] + '</a>' + seo_div + '</li>';
                                    prettyPhotoLoad();
                                }

                                if (upload_type == 'multiple')
                                {
                                    $("." + imageid + "-image1").append(image_content);
                                    sa_expandiv();

                                } else
                                {
                                    $("." + imageid + "-image1").html(image_content);
                                    sa_expandiv();

                                }



                            }

                        }

                        //To get focus for input type in mozilla firefox browser 
                        $(".ui-sortable li input").click(function () {
                            $(this).focus();
                        });
                        $(".ui-sortable li textarea").click(function () {
                            $(this).focus();
                        });

                        $('.' + imageid).val('');

                        $("#" + imageid + "-output").html('');

                    }


                    save_image_order(imageid);
                }
            });
        }

    });



});



// combo values assigning  
$(document).ready(function () {

    $(".combo").each(function () {


        var combo_id = $(this).attr('id');
        var imageid = $(this).attr('data-imageid');


        fileData(combo_id);
        manipulationData(combo_id);
        checkfilevalidation(imageid);
        setcheckFIle(imageid);

    })

    $(".comboset").on('change', '.combo', function () {

        var combo_id = $(this).attr('id');
        var imageid = $(this).attr('data-imageid');


        fileData(combo_id);
        manipulationData(combo_id);
        removeAllfiles(imageid);
    });
});

//EOF combo values assigning  



// image popup function
function prettyPhotoLoad() {

    $("a[rel^='prettyPhoto']").prettyPhoto({
        default_width: 800,
        default_height: 600,
        theme: 'facebook',
        social_tools: false,
        show_title: true
    });
}
// EOF image popup function


// file sorting function
$(function () {
//        $("#sortable").sortable();
//        $("#sortable").disableSelection();
//        

    $(".sortable").sortable({

        update: function (event, ui) {
            var imageid = $(this).attr('data-img_id');
            save_image_order(imageid)
        }
    });
    $(".sortable").disableSelection();

});
//EOF  file sorting function


// file configurations fetch function 

function fileData(combo_id) {


    var prefernces = $('#' + combo_id + ' option:selected').attr('data-pref');
    var manipulation = $('#' + combo_id).find(':selected').attr('data-manip');
    var imageid = $('#' + combo_id).attr('data-imageid');


    var myObj = $.parseJSON(prefernces);

    $('.' + imageid).attr('data-preference', prefernces);
    $('.' + imageid).attr('data-manipulation', manipulation);
    $('.' + imageid).attr('data-maxsize', myObj.max_size);

    $("." + imageid + "-textSize").text(myObj.max_size);
    $("." + imageid + "-textWidth").text(myObj.max_width);
    $("." + imageid + "-textHeight").text(myObj.max_height);

//    var combo_val = $('#' + combo_id + ' option:selected').val();
//    $('.combo_val').val(combo_val);



    //for reference

//        $("#max_size").val(myObj.max_size);
//        $("#max_width").val(myObj.max_width);
//        $("#max_height").val(myObj.max_height);
//        $("#manipulation").val(manipulation);
//        $(".textSize").text(myObj.max_size);
//        $(".textWidth").text(myObj.max_width);
//        $(".textHeight").text(myObj.max_height)

//EOF for reference

    if (myObj.max_width == false) {

        $(".dimensions").css('display', 'none');

    } else {

        $(".dimensions").css({'display': 'block',
            'float': 'right',
            'margin-right': '300px'
        });
    }


}

//    EOF   file configurations fetch function 



//  Manipulation Div hide show
function manipToggle(imageid) {

    $("." + imageid + "-ImageManipulation").slideToggle();

}


// EOF  Manipulation Div hide show

//  show all combos only in edit
function allComboshow(combo_id) {

    $('.' + combo_id + '-currentCombo').hide();
    $('.' + combo_id + '-comboSection').show();
    $('.' + combo_id + '-findAllcombo').hide();

}
// End of  show all combos only in edit  

// Manipulation details fetch 
function manipulationData(combo_id) {

    var manip = $('#' + combo_id).find(':selected').attr('data-manip');
    var imageid = $('#' + combo_id).attr('data-imageid');
    var controller = 'commoninputadmin';
//        var manip=$('.'+imageid).attr('data-manipulation');


    if (manip == 'Yes') {

        var comboid = $('#' + combo_id).val();
        var dataString = "comboid=" + comboid;

        var base_url = $(".base_url").val();
        $.ajax({
            type: "POST",
            url: base_url + controller + "/fetchManipdata/",
            data: dataString,
            cache: false,
            success: function (html) {


                $('.' + imageid + '-ImageManipulation').html(html);

            }
        });

    } else {

        $('.' + imageid + '-ImageManipulation').html('');
    }
}

//EOF  Manipulation details fetch 


//      file delete function 
function deleteproductimage(img, count, imageid) {

    var finalimageid = imageid + '-final_images';

    var controller = 'commoninputadmin';

    ajaxindicatorstart('please wait..');

    var dataString = "img=" + img;

    var base_url = $(".base_url").val();
    $.ajax({
        type: "POST",
        url: base_url + controller + "/delete_upload_image/",
        data: dataString,
        cache: false,
        success: function (html) {

            if (html == 'yes')
            {
                $('.productfile' + count).remove();

                var finalImages = $('#' + finalimageid).val();
                var fileArray = [];
                var fileArray = finalImages.split(",");
                remove(fileArray, img);
                var newstr = fileArray.toString();
                $('#' + finalimageid).val(newstr);

                ajaxindicatorstop();

            }

        }
    });
}

//    EOF  file delete function 


//      file delete on change function  
function removeAllfiles(imageid) {

    var finalimageid = imageid + '-final_images';

    var controller = 'commoninputadmin';

    var finalFiles = $('#' + finalimageid).val();

    if (finalFiles != '') {

        var base_url = $(".base_url").val();
        var dataString = "finalFiles=" + finalFiles;

        $.ajax({
            type: "POST",
            url: base_url + controller + "/deleteFilechange/",
            data: dataString,
            cache: false,
            success: function (html) {

                if (html == 'yes')
                {
                    $('.' + imageid + '-image1').html("");
                    $('#' + finalimageid).val("");
                }

            }
        });
    }

}

//  EOF file delete on change function  

//  file type required add/remove

function checkfilevalidation(imageid) {

    var finalimageid = imageid + '-final_images';

    if ($('#' + finalimageid).val() == '') {

        $("#" + imageid).attr("required");

    } else {

        $("#" + imageid).removeAttr("required");
    }

}

// EOF  file type required add/remove

// set filename after loading

function setcheckFIle(imageid) {

    var finalimageid = imageid + '-final_images';
    var manipulation = $('.' + imageid).attr('data-manipulation');
    var upload_type = $('.' + imageid).attr('data-uploadtype');
    var valFile = $('#' + finalimageid).val();
    var base_url = $('.base_url').val();
    if (valFile != '' && typeof valFile != 'undefined') {

        var fileArray = valFile.split(",");

        var filecount = $(".imagedivsGallery").length;

        for (i = 0; i < fileArray.length; i++)
        {

            if (fileArray[i])
            {

                var imgcount = filecount + i;

                var fileArray2 = "'" + fileArray[i] + "','" + imgcount + "','" + imageid + "'";

                if (manipulation == 'No') {

                    var image_content = '<li class="ui-state-default productfile' + imgcount + ' imagedivsGallery ngo_imagedivs" id="' + fileArray[i] + '" > <span aria-hidden="true" style=font-size:25px;" class="icon icomoon-icon-file-6"></span>&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage(' + fileArray2 + ');" style="cursor:pointer;">X</span><br><a href="' + base_url + 'media_library/' + fileArray[i] + '" target="_blank">' + fileArray[i] + '</a><input type="text" required placeholder="Title" name="img_title[]" style="margin-bottom:10px";><textarea name="img_desc[]" rows="2" placeholder="Description"></textarea></li>';
                } else {

                    var image_content = '<li class="ui-state-default productfile' + imgcount + ' imagedivsGallery ngo_imagedivs form-row" id="' + fileArray[i] + '" ><img width="100" height="100" src="' + base_url + 'media_library/' + fileArray[i] + '">&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage(' + fileArray2 + ');" style="cursor:pointer;">X</span><a href="' + base_url + 'media_library/' + fileArray[i] + '" rel="prettyPhoto" title="' + fileArray[i] + '" class="txtcenter">' + fileArray[i] + '</a><input type="text" required placeholder="Title" name="img_title[]" style="margin-bottom:10px";><textarea name="img_desc[]" rows="2" placeholder="Description"></textarea></li>';
                    prettyPhotoLoad();
                }


                if (upload_type == 'multiple')
                {
                    $("." + imageid + "-image1").append(image_content);

                } else
                {
                    $("." + imageid + "-image1").html(image_content);

                }



            }

        }
    }
}

//EOF  set filename after loading
