function fieldValue(fid, full_attr){
    var valSize = $(full_attr).attr('data-valuesize');
        var attrType = $(full_attr).attr('data-typeattr');

        if (valSize == 'single') {
            if (attrType == 'checkbox') {
                var setValue = "";
                if ($(full_attr).is(":checked")) {
                    setValue = $(full_attr).val();
                }
                $('.customval_' + fid).val(setValue);

            } else {
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
        
        dynamicValue.push(obj);
//            console.log(JSON.stringify(dynamicValue));
        document.getElementById("final_value_set").value = JSON.stringify(dynamicValue);
    }



