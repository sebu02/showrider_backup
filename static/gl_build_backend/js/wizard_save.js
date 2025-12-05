
//$('#combined-picker').datetimepicker({
//    dateFormat: "yy-mm-dd",
//    timeFormat:  "hh:mm"
//});

//$(function () {
//    $("#combined-picker").datepicker({
//        changeMonth: true,
//        changeYear: true,
//        yearRange: "-100:+0"
//    });
//});


function fieldValue(fid, full_attr) {
    var valSize = $(full_attr).attr('data-valuesize');
    var attrType = $(full_attr).attr('data-typeattr');

    if (valSize == 'single') {
        if (attrType == 'checkbox') {
            var setValue = "";
            if ($(full_attr).is(":checked")) {
                setValue = $(full_attr).val();
            }
            $('.customval_' + fid).val(setValue);

        } else if (attrType == 'datepicker1')
        {

            var setValue = $(full_attr).val();

//            var dateObj = new Date(setValue);
//            var date1 = $.datepicker.formatDate('yy-mm-dd', dateObj);
//            var time1 = dateObj.getHours() + ":" + dateObj.getMinutes() + ":" + dateObj.getSeconds();
//
//            setValue1=date1+" "+time1;

            $('.customval_' + fid).val(setValue);
        } else
        {
            var setValue = $(full_attr).val();
            $('.customval_' + fid).val(setValue);
        }


    } else if (valSize == 'multiple') {

        if (attrType == 'select') {

            var dropSelect = '+';
            $('.set_' + fid + ' option:selected').each(function () {

                if ($(this).val() != '') {

                    dropSelect += $(this).val() + '+';
                }

            });

            $('.customval_' + fid).val(dropSelect);

        } else if (attrType == 'checkbox') {

            var dropSelect = '+';
            $('.set_' + fid + ':checked').each(function () {

                if ($(this).val() != '') {

                    dropSelect += $(this).val() + '+';
                }

            });

            $('.customval_' + fid).val(dropSelect);
        }
    }

}



function savedynamicValues() {

    var dynamicValue = new Array();
    var obj = {};

    $('.sa_dynamic_form .gl_element').each(function () {

        var ckid = $(this).attr('id');
        var ckfid = $(this).attr('data-fid');

        var valsetck = CKEDITOR.instances[ckid].getData();
        var setValue = valsetck;
        $('.customval_' + ckfid).val(setValue);

//            obj[key] = valsetck;
    });

    $('.sa_dynamic_form .sa_element').each(function () {

        var key = $(this).attr('data-colname');
        var valset = $(this).val();

        obj[key] = valset;
    });


savevideoType();
savecontentvideoType();

    save_admore_field();

    $('.sa_dynamic_form .admore_element').each(function () {

        var key = $(this).attr('data-colname');
        var valset = $(this).val();
        obj[key] = valset;
    });

    dynamicValue.push(obj);
    document.getElementById("final_value_set").value = JSON.stringify(dynamicValue);
}



function save_admore_field()
{
    $('.main_wrapp .common_input_row_id').each(function () {
        var new_order = [];

        var common_input = $(this).val();
        var column_name = $(this).attr('data-colname');

        $('.main_wrapp div.data_value_key_' + common_input).each(function (e) {
            var obj = {};
            var right_val = $(this).find(".gl_right_value").val();
            var left_val = $(this).find(".gl_left_value").val();

            var right_rowname = $(this).find(".gl_right_value").attr('data-rowname');
            var left_rowname = $(this).find(".gl_left_value").attr('data-rowname');

            obj[left_rowname] = left_val;
            obj[right_rowname] = right_val;
            
            new_order.push(obj);
        });
        $('.customval_' + common_input).val(JSON.stringify(new_order));
    });
}

/*For Content title */
$(document).ready(function ()
{

    $('.common_input_row_id').each(function (e) {
        var common_input_id = $(this).attr('id');

        var first_a = $(".data_value_key_" + common_input_id).first();

        var firsta_a = first_a.find('a[class~="remove_source"]');
        firsta_a.hide();

    })


    $(".add_next_key").click(function (e)
    {

        var input_id = $(this).attr('data-inputid');
        e.preventDefault();

        var newid = 1;
        $(".main_wrapp div.data_value_key_" + input_id).each(function () {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
            newid++;
            //debugger;
        });


        var current = $(".data_value_key_" + input_id).last();
        var cloned = current.clone();
        cloned.find('.sa_element').attr('id', 'customval_' + input_id + '_' + newid);
        cloned.find('input,textarea,select').val('');
        cloned.find('input').attr('data-wrappval', '');
        cloned.find('input').attr('data-textval', '');
        cloned.find('a[class~="remove_source"]').show();
        cloned.find('label[class~="key_feature_label"]').text('');
        cloned.attr("id", newid);
        cloned.insertAfter(current);

        var first = $(".data_value_key_" + input_id).first();
        first.find('a[class~="remove_source"]').hide();



    });

    $('.main_wrapp').on("click", ".remove_source", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove();

    });

});

/*END of For Content title */



function savevideoType() {
    if ($('#types div.repeatvideoDiv').length > 0) {
        var new_video = [];
        $('#types div.repeatvideoDiv').each(function () {

            video_value = $(this).find("input[name^='video'][type=radio]:checked").val();
            source_value = $(this).find("input[name^='source']").val();
            video_source_value = $(this).find("input[name^='video_source_title']").val();
            video_desc_value = $(this).find("textarea[name^='video_source_desc']").val();
            new_video.push({videotype: video_value, source: source_value, video_source_title: video_source_value, video_source_desc: video_desc_value});
        });
        document.getElementById("final_videoResult").value = JSON.stringify(new_video);
    }
}


function savecontentvideoType() {

    if ($('#content_types2 div.repeatvideoDiv').length > 0) {
        var new_video = [];
        $('#content_types2 div.repeatvideoDiv').each(function () {

            var video_value = $(this).find("input[name^='video'][type=radio]:checked").val();
            var source_value = $(this).find("input[name^='source']").val();
            var video_source_value = $(this).find("input[name^='video_source_title']").val();
            var video_desc_value = $(this).find("textarea[name^='video_source_desc']").val();
            var video_order = $(this).find("input[name^='video_order']").val();
            new_video.push({videotype: video_value, source: source_value, video_source_title: video_source_value, video_source_desc: video_desc_value, video_order: video_order});
        });
        document.getElementById("final_videoResult_content").value = JSON.stringify(new_video);
    }


}