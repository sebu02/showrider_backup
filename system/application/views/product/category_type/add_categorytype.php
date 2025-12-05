<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">

            <h3>Manage Category Types</h3>                    

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:70%; margin-left:15%;">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Add Category Type</span>
                        </h4>

                    </div>
                    <div class="content">
                        <form class="form-horizontal extensionForm" action="<?php echo base_url() . 'ecproductadmin/add_categorytype/' ?>" method="post" enctype="multipart/form-data" >
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="error_messages">
                                            <?php echo form_error('input_name[]'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">

                                        <label class="form-label span4" for="checkboxes">Choose The Category Type</label>

                                        <div class="span8 controls">
                                            <?php
                                            if ($main_category_types != NULL) {
                                                foreach ($main_category_types as $main_key => $main_cat_type) {
                                                    ?>
                                                    <div class="left marginT5"> 
                                                        <input type="radio" name="category_type" 
                                                               value="<?php echo $main_cat_type->category_type_value . '|' . $main_cat_type->id; ?>" 
                                                               <?php
                                                               if (isset($_POST['category_type'])) {
                                                                   if ($_POST['category_type'] == $main_cat_type->category_type_value) {
                                                                       echo "checked='checked'";
                                                                   }
                                                               } else if ($main_key == 0) {
                                                                   echo "checked='checked'";
                                                               }
                                                               ?> />
                                                               <?php echo $main_cat_type->category_type_name; ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div> 
                            <div id="main_key">

                                <div class="data_value_key" data-id="1">
                                    <div class="form-row row-fluid ">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="normal">Category Type<b style="color:#F00; font-size:11px;">*</b></label>
                                                <input class="span5" id="input_name" type="text" name="input_name[]"  value="<?php echo set_value('input_name[]'); ?>" required />
                                                <span class="error">

                                                </span>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="save_database1">Save To Option</label>
                                                <div class="span8 controls">

                                                    <div class="left marginT5" style="width: 100%;"> 
                                                        <input style="float: left;width: auto;margin-right: 10px;" type="checkbox" class="save_database" id="save_database" name="save_database" value="yes" /><span>yes</span> 
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" style="float: right;position: absolute;margin-top: -36px;margin-left: 84%;" class="remove_source">Remove</a>

                                </div>

                            </div>


                            <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key" style="float: right;">Add New Category</a>


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">

                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <input type="hidden" class="gl_save_db" name="save_db">
                                <button type="submit" onclick="saveorder();" class="btn btn-info">Submit</button>

                            </div>


                        </form>

                    </div>

                </div><!-- End .box -->

            </div><!-- End .span6 --><!-- End .span6 --><!-- End .span6 -->


        </div><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid -->





    </div><!-- End contentwrapper -->
</div>

<?php
if ($this->session->flashdata('message')) {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            //Regular success

            $.pnotify({
                type: 'success',
                title: '<?php echo $this->session->flashdata('message'); ?>',
                text: '',
                icon: 'picon icon16 iconic-icon-check-alt white',
                opacity: 0.95,
                history: false,
                sticker: false
            });

        });
    </script>
    <?php
}
?> 

<script>

    function saveorder()
    {
        var new_order = [];
        $('.data_value_key').each(function () {

            if ($(this).find('.save_database').is(':checked'))
            {
                save_db = 'yes';
            } else
            {
                save_db = 'no';
            }

            new_order.push(save_db);
        })

        $('.gl_save_db').val(JSON.stringify(new_order));

    }

    $(window).load(function () {
        $(".save_database").parent().unwrap();
        $(".save_database").unwrap();
    });


    $(document).ready(function ()
    {
        /*For Hidden input */
        var first_a = $(".data_value_key").first();
        var firsta_a = first_a.find('a[class~="remove_source"]');
        firsta_a.hide();

        var wrapper_a = $("#main_key"); //Fields wrapper   

        $("#add_key").click(function (e)
        {
            e.preventDefault();


            var newid = 1;
            $("#main_key div.data_value_key").each(function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
                newid++;
                //debugger;
            });



            var current = $(".data_value_key").last();
            var cloned = current.clone();
            cloned.find('input[type=text],textarea').val('');
            cloned.find('input').prop('checked', false);
            cloned.find('a[class~="remove_source"]').show();
            cloned.attr("id", newid);
            cloned.insertAfter(current);

            var first = $(".data_value_key").first();
            first.find('a[class~="remove_source"]').hide();


        });

        $(wrapper_a).on("click", ".remove_source", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();

        });

    });

</script>   



<!--Script to add dynamic input field-->
<script type="text/javascript">
//    $(document).ready(function () {
//        var max_fields = 10; //maximum input boxes allowed
//        var wrapper = $(".gl_price"); //Fields wrapper
//        var add_button = $(".add_field_button"); //Add button ID
//
//        var x = 1; //initlal text box count
//        $(add_button).click(function (e) { //on add input button click
//            e.preventDefault();
//            append_string(max_fields, x, wrapper);
//        });
//
//        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
//            e.preventDefault();
//            $(this).parent().remove();
////            $(this).parent().parent().parent().remove();
//            /*Here Remove is placed inside nested divs of level3
//             * That is the reason of 3 parent().parent.parent()
//             * */
//            x--;
//        });
//    });


//    function append_string(max_fields, x, wrapper) {
//        if (x < max_fields) { //max input box allowed
//            x++; //text box increment
    //            var appendstr = "<div class='form-row row-fluid'>" +
//                    "<div class='span12'>" +
//                    "<div class='row-fluid'>" +
//                    "<label class='form-label span4' for='normal'>Category Type<b style='color:#F00; font-size:11px;'>*</b></label>" +
//                    "<input class='span5' id='suffix' type='text' name='input_name[]'  value='<?php echo set_value('input_name[]'); ?>' required />" +
    "<span class='error'><?php // echo form_error('input_name[]');            ?></span>" +
//                    "</div>" +
//                    "</div>" +
//                    "</div>" +
//                    "<div class='form-row row-fluid'>" +
//                    "<div class='span12'>" +
//                    "<div class='row-fluid'>" +
//                    "<label class='form-label span4' for='save_database'>Save To Database</label>" +
//                    "<div class='span8 controls'>" +
//                    "<div class='left marginT5'> " +
//                    "<input type='checkbox' id='save_database' name='save_database[]' value='yes' />" +
//                    "</div></div></div></div></div>";
//
//
//            $(wrapper).append(appendstr); //add input box
//        }
//    }


            function unique_handling() {
                var obj = {};
                var status_check = 1;
                $("#suffix").each(function () {
                    if ($(this).value === "") {
                        alert("Value can't be empty");
                        $(this).focus();
                        status_check = status_check * 0;
                        return false;
                    } else if (obj.hasOwnProperty($(this).value)) {

                        alert("There is a duplicate value " + $(this).value);
                        status_check = status_check * 0;
                        return false;
                    } else {
                        obj[$(this).value] = $(this).value;
                    }
                });

//  other way
                var current_value = $(this).val();
                $(this).attr('value', current_value);
                console.log(current_value);
                if ($('#suffix[value="' + current_value + '"]').not($(this)).length > 0 || current_value.length == 0) {
                    $(this).focus();
                    alert('You cannot use this');
                }
//  End of other way

                return status_check;
            }


</script>
<!-- End of Script to add dynamic input field-->