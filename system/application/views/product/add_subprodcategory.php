<style>

    label.radio-inline, label.checkbox-inline {
        background-color: #E5E5E5;
        cursor: pointer;
        font-weight: 400;
        margin-bottom: 10px !important;
        margin-right: 2%;
        margin-left:0;
        padding: 10px;
    }
    label.radio-inline.checked, label.checkbox-inline.checked {
        background-color: #49afcd;
        color: #fff !important;
        text-shadow: 1px 1px 2px #000 !important;
    }
    .checkbox-inline + .checkbox-inline, .radio-inline + .radio-inline {
        margin-left: 0;
    }
    .gl-columns label.radio-inline, .gl-columns label.checkbox-inline {
        min-width: 220px;
        vertical-align: top;
        width: 25%;
    }
    .gl-columns label {
        cursor: move;
    }

</style>



<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#slug").keyup(function ()
        {
            var string = $("#slug").val();
            var string = string.replace(/[^a-zA-Z0-9]/g, '-');
            var string = string.replace(/\-+/g, '-');
            var string = string.toLowerCase();
            $("#slug").val(string);
        });
        $("#input_name").keyup(function ()
        {
            var string = $("#input_name").val();
            var string = string.replace(/[^a-zA-Z0-9]/g, '-');
            var string = string.replace(/\-+/g, '-');
            var string = string.toLowerCase();
            $("#slug").val(string);
        });
    });
</script>
<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Manage Product Categories</h3>
        </div><!-- End .heading-->
        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->
        <div class="row-fluid">
            <div class="span6" style="width:70%; margin-left:15%;">
                <div class="box">
                    <div class="title">
                        <h4>
                            <span>Add Category</span>
                        </h4>
                    </div>
                    <div class="content">
                        <form class="form-horizontal multiple_upload_form" action="<?php echo base_url() . 'ecproductadmin/add_subprodcategory/'; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="error_messages">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span4" for="checkboxes">Select Category</label>
                                    <div class="span8 controls">
                                        <select name="parentname" required id="category_type">
                                            <option value="">--Select--</option>
                                            <?php
                                            foreach ($categorylist as $cat)
                                            {
                                                ?>
                                                <option value="<?php echo $cat['id']; ?>" data-ctype="<?php echo $cat['ctype']; ?>" <?php echo set_select('cat', $cat['id']); ?>><?php echo $cat['name'].'--'.$cat['ctype_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="error"><?php echo form_error('parentname'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="input_name">Category Name<b style="color:#F00; font-size:11px;">*</b></label>
                                        <input class="span8" id="input_name" type="text" name="input_name" value="<?php echo set_value('input_name'); ?>" required/>
                                        <span class="error"><?php echo form_error('input_name'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="slug">Slug/Url Name<b style="color:#F00; font-size:11px;">*</b></label>
                                        <input class="span8 read-slug" readonly="true" id="slug" type="text" name="slug" value="<?php echo set_value('slug'); ?>" required/>
                                        <span class="right manipTxt slugShow"><a onclick="slugShow()" class="icomoon-icon-pencil">Write Mode On</a></span>
                                        <span class="right manipTxt slugHide" style="display: none;"><a onclick="slugHide()" class="icomoon-icon-link-5">Write Mode Off</a></span>
                                        <span class="error">
                                            <?php echo form_error('slug'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="short_name">Short Name
                                            <b style="color:#F00; font-size:11px;">*</b></label>
                                        <input class="span8" id="short_name" type="text" name="short_name" required value="<?php echo set_value('short_name'); ?>"/>
                                        <span class="error"><?php echo form_error('short_name'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="category_description">Category Description</label>
                                        <a href="<?php echo base_url(); ?>commonimageadmin/viewimages/" target="_blank" class="btn btn-inverse pull-right">
                                            <span class="icon16 icomoon-icon-image-3 white"></span>Add Image for Description</a>
                                    </div>
                                    <div class="row-fluid">
                                        <textarea class="span8 elastic ckeditor" id="category_description" name="category_description"><?php echo set_value('category_description'); ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('category_description'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <!--Image for category-->


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <input type="hidden" id="preferences" value="">
                                        <input type="hidden" id="allowed_types" value="">
                                        <input type="hidden" id="max_size" value="">
                                        <input type="hidden" id="max_width" value="">
                                        <input type="hidden" id="max_height" value="">
                                        <input type="hidden" id="manipulation" value="">
                                        <label class="form-label span4" for="combo">Select File Property</label>
                                        <div class="span8 controls comboset">  
                                            <select name="combo" id="combo" class="combo">
                                                <?php
                                                foreach ($values as $combos) {
                                                    if ($combos->manipulation_status == 'Yes') { // (IMG_MANIPULATION_COMBO) when need all combos remove this condition
                                                        ?>
                                                    ?>
                                                    <option data-pref='<?php echo $combos->preferences; ?>' data-manip='<?php echo $combos->manipulation_status; ?>' value="<?php echo $combos->fid; ?>" <?php if (isset($_POST['combo'])) {
                                                    if ($_POST['combo'] == $combos->fid) {
                                                        echo 'selected';
                                                    }
                                                } ?> ><?php echo $combos->combo_name; ?></option>
                                                <?php } } ?>

                                            </select>
                                        </div>
                                        <span class="error">
<?php echo form_error('combo'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Category Picture</label>
                                        <input type="file"  class="ngo_proof_attach_input_file span8" name="images[]" id="images"  >
                                        <div class="upload_note span12">
                                            <span class="span4"></span> <span class="span8">Size:Below&nbsp;<span class="textSize"></span>  MB for each file<span class="dimensions">, width:&nbsp;<span class="textWidth"></span> px, Height:&nbsp;<span class="textHeight"></span> px</span></span>
                                            <span class="manipTxt"><a onclick="manipToggle()">Show Manipulations</a></span>
                                        </div>
                                        <div class="ImageManipulation">
                                        </div>
                                        <div class="preloader5">
                                            <span class="uploading" style="display:none;text-align: center;"><img src="<?php echo base_url(); ?>static/adminpanel/images/loaders/horizontal/018.gif" alt="" style="display: block;margin: 0 auto;"/></span>
                                        </div>
                                        <span id="output"></span>
                                        <ul class="image1 add_new_image1" id="sortable"></ul>
                                        <input type="hidden" name="final_images" value="<?php echo set_value('final_images'); ?>" id="final_images">
                                    </div>
                                </div>
                            </div>
                                                       
                            
                            

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <input type="hidden" id="preferences_b" value="">
                                        <input type="hidden" id="allowed_types_b" value="">
                                        <input type="hidden" id="max_size_b" value="">
                                        <input type="hidden" id="max_width_b" value="">
                                        <input type="hidden" id="max_height_b" value="">
                                        <input type="hidden" id="manipulation_b" value="">
                                        <label class="form-label span4" for="combo_b">Select File Property</label>
                                        <div class="span8 controls comboset_b">  
                                            <select name="combo_b" id="combo_b" class="combo_b">
                                                <?php
                                                foreach ($values as $combos) {
                                                    ?>
                                                    <option data-pref='<?php echo $combos->preferences; ?>' 
                                                            data-manip='<?php echo $combos->manipulation_status; ?>' 
                                                            value="<?php echo $combos->fid; ?>" <?php if (isset($_POST['combo_b'])) {
                                                    if ($_POST['combo_b'] == $combos->fid) {
                                                        echo 'selected';
                                                    }
                                                } ?> ><?php echo $combos->combo_name; ?></option>
                                            <?php } ?>

                                            </select>
                                        </div>
                                        <span class="error">
                                            <?php echo form_error('combo_b'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>                            
                            
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="images_b">Banner Picture</label>
                                        <input type="file"  class="ngo_proof_attach_input_file span8" name="images_b[]" id="images_b"  >
                                        <div class="upload_note span12">
                                            <span class="span4"></span> <span class="span8">Size:Below&nbsp;<span class="textSize_b"></span>  MB for each file<span class="dimensions_b">, width:&nbsp;<span class="textWidth_b"></span> px, Height:&nbsp;<span class="textHeight_b"></span> px</span></span>
                                            <span class="manipTxt_b"><a onclick="manipToggle_b()">Show Manipulations</a></span>
                                        </div>
                                        <div class="ImageManipulation_b">
                                        </div>
                                        <div class="preloader5">
                                            <span class="uploading_b" style="display:none;text-align: center;"><img src="<?php echo base_url(); ?>static/adminpanel/images/loaders/horizontal/018.gif" alt="" style="display: block;margin: 0 auto;"/></span>
                                        </div>
                                        <span id="output_b"></span>
                                        <ul class="image1_b add_new_image1_b" id="sortable_b"></ul>
                                        <input type="hidden" name="final_images_b" value="<?php echo set_value('final_images_b'); ?>" id="final_images_b">
                                    </div>
                                </div>
                            </div>
                   

                            <!--End of Image for banner-->

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="bannertitle">Banner Title</label>
                                        <textarea class="span8 elastic" id="bannertitle" rows="2"  name="bannertitle"><?php echo set_value('bannertitle'); ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('bannertitle'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="banner_description">Banner Description</label>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <textarea class="span8 elastic ckeditor" id="banner_description" name="banner_description"><?php echo set_value('banner_description'); ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('banner_description'); ?>
                                        </span>
                                    </div>


                                </div>
                            </div>


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="order_number">Order</label>
                                        <input class="span8" id="order_number" type="number" name="order_number"  value="<?php
                                        if (isset($_POST['order_number']) && $_POST['order_number'] != '') {
                                            echo set_value('order_number');
                                        } else {
                                            echo '0';
                                        }
                                        ?>" required />
                                        <span class="error"><?php echo form_error('order_number'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="active_status">Status</label>
                                        <div class="span8 controls">
                                            <div class="left marginT5">
                                                <input type="radio" name="active_status" id="active_status1" value="a" <?php
                                                if (isset($_POST['active_status'])) {
                                                    if ($_POST['active_status'] == 'a')
                                                        echo 'checked';
                                                }
                                                else {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                Active
                                            </div>
                                            <div class="left marginT5">
                                                <input type="radio" name="active_status" id="active_status2" value="d" <?php
                                                if (isset($_POST['active_status'])) {
                                                    if ($_POST['active_status'] == 'd')
                                                        echo 'checked';
                                                }
                                                ?> />
                                                Deactivate
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid" id="spl_cat_container"  style=" display: none;">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="spl_categories">Special Categories</b></label>
                                        <div class="span8 controls gl-columns "> 
                                            <?php foreach ($main_categories as $key => $category_row) { ?>
                                                <label class="span6 checkbox-inline" for="gl_Checkboxes_<?php echo $key; ?>">
                                                    <input type="checkbox" name="Checkboxes" id="gl_Checkboxes_<?php echo $key; ?>" data_id="<?php echo $category_row->id; ?>"  data_slug="<?php echo $category_row->slug; ?>" value="<?php echo $category_row->category; ?>">
                                                <?php echo $category_row->category; ?>
                                                </label>
                                            <?php } ?>
                                        </div>

                                        <input type="hidden" name="final_spl_categories" value="<?php echo set_value('final_spl_categories'); ?>" id="final_spl_categories">

                                    </div>
                                </div>
                            </div>

                            <!--                            <div class="form-row row-fluid">
                                                            <div class="span12">
                                                                <div class="row-fluid">
                                                                    <label class="form-label span8"><i class="text-center">Mainly used for Seo Purpose</i></label>
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="page_title">Page Title<b style="color:#F00; font-size:11px;">*</b></label>
                                        <textarea class="span8 elastic" id="page_title" rows="2" required name="page_title"><?php echo set_value('page_title'); ?></textarea>
                                        <span class="error"><?php echo form_error('page_title'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="seo_description">Meta Description<b style="color:#F00; font-size:11px;">*</b></label>
                                        <textarea class="span8 elastic" id="seo_description" rows="3" required name="seo_description"><?php echo set_value('seo_description'); ?></textarea>
                                        <span class="error"><?php echo form_error('seo_description'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="seo_keywords">Meta Keywords<b style="color:#F00; font-size:11px;">*</b></label>
                                        <div class="span8 controls">
                                            <input id="tags" required name="seo_keywords" type="text" value="<?php echo set_value('seo_keywords'); ?>" style="width:100%;"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                 <button type="submit" class="btn btn-info showhide-btn" onclick="saveOrder()">Submit</button>
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
        $(document).ready(function ()
        {
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


<script type="text/javascript">
    $(document).ready(function ()
    {
        //When checkboxes/radios checked/unchecked, toggle background color
        $('.gl-columns').on('click', 'input[type=radio]', function () {
            $(this).closest('.gl-columns').find('.radio-inline, .radio').removeClass('checked');
            $(this).closest('.radio-inline, .radio').addClass('checked');
        });
        $('.gl-columns').on('click', 'input[type=checkbox]', function () {
            $(this).closest('.checkbox-inline, .checkbox').toggleClass('checked');
        });


        $(".gl-columns").sortable({

        });




     
        
    $("#category_type").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("data-ctype");
            if (optionValue == '2') {
                $('#spl_cat_container').show();
            } else{
                $("#spl_cat_container").hide();
            }
        });
    });
    
    
    var selectedoptionValue = $("#category_type option:selected" ).attr("data-ctype");
    if (selectedoptionValue == '2') {
                $('#spl_cat_container').show();
            } else {
                $("#spl_cat_container").hide();
            }

    });



    function brand_spl_categories() {
        var new_order = new Array();
        $('.gl-columns label').each(function () {

            cat_status = $(this).find("input[type=checkbox][id^='gl_Checkboxes']").is(":checked");
            cat_name = $(this).find("input[type=checkbox][id^='gl_Checkboxes']").val();
            cat_id = $(this).find("input[type=checkbox][id^='gl_Checkboxes']").attr('data_id');
            cat_slug = $(this).find("input[type=checkbox][id^='gl_Checkboxes']").attr('data_slug');
            if (cat_status == true) {
                new_order.push({category_name: cat_name, category_id: cat_id,category_slug:cat_slug});
            }

        });
//        console.log(JSON.stringify(new_order));
        document.getElementById("final_spl_categories").value = JSON.stringify(new_order);
    }
</script>
    
    
    
    
    
<!--    file upload js-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="application/javascript" src="<?php echo base_url() . 'static/'; ?>ajaxupload/js/jquery.form.js"></script>   
   
<script type="text/javascript">
    
    
/***********    Common functions ************/
    //      file size byte to mb conversion function 
    function bytesToSizenotrounded(bytes) {

        if (bytes == 0)
            return '0 Bytes';
        var floatmb = (bytes / 1048576).toFixed(2) + "MB";
        return floatmb;

    }
    //  End of  file size byte to mb conversion function 


//        element remove function from array
    function remove(array, element) {
        const index = array.indexOf(element);
        array.splice(index, 1);
    }
    //      End of  element remove function from array      



/***********  EOF Common functions **********/
    
    
    
    
    
        //      file order save function
    function saveOrder() {
brand_spl_categories();
        checkfilevalidation();

        var new_order = new Array();
        $('ul#sortable li').each(function () {
            new_order.push($(this).attr("id"));
        });
        document.getElementById("final_images").value = new_order;
        
        
        checkfilevalidation_b();

        var new_order_b = new Array();
        $('ul#sortable_b li').each(function () {
            new_order_b.push($(this).attr("id"));
        });
        document.getElementById("final_images_b").value = new_order_b;
    }
    //    End of  file order save function    

    
    
    $(document).ready(function () {

        $('#images').on('change', function () {
            var finalImages = $('#final_images').val();

            if (finalImages == '') {

                //validation

                var check1 = 0;
                var check2 = 0;
                var check3 = 0;
                var check4 = 0;

                if (window.File && window.FileReader && window.FileList && window.Blob) {

                    if (!$('#images').val()) //check empty input filed
                    {
                        $("#output").html("Please choose your Image !");

                        check2 = 1;

                    } else {

                        check2 = 0;
                    }

                    // var fsize = $('#images')[0].files[0].size; //get file size

                    var ftype = $('#images')[0].files[0].type; // get file type


                    var result = $('#images')[0].files;

                    for (var x = 0; x < result.length; x++) {
                        var fle = result[x];
                        // console.log(fle.size);  
                        var fsize = fle.size;
                        var maxSize = $("#max_size").val();
                        var fileSize = maxSize * 1048576;

                        //Allowed file size is less than 5 MB (1048576)
                        if (fsize > fileSize)
                        {
                            $("#output").html("<b>" + bytesToSizenotrounded(fsize) + "</b>" + fle.name + " is too big, it should be less than 2 MB.");
                            check4 = 1;
                            //alert(fle.name);
                        } else
                        {
                            check4 = 0;

                        }
                    }



                } else
                {
                    //Output error to older unsupported browsers that doesn't support HTML5 File API
                    $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
                    check1 = 1;
                }


                //validation


                var checktotal = check1 + check2 + check3 + check4;


                if (checktotal == 0) {

                    var formUrl = "<?php echo base_url() . 'ecproductadmin/bannerUpload'; ?>";

                    var files = new FormData($(".multiple_upload_form")[0]);

                    $.ajax({
                        url: formUrl,
                        type: 'POST',
                        data: files,
                        mimeType: "multipart/form-data",
                        beforeSend: function () {
                            $('.uploading').show();
                             $('.showhide-btn').prop('disabled', true);

                        },
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data, textSatus, jqXHR) {
                            //now get here response returned by PHP in JSON fomat you can parse it using JSON.parse(data)

                            $('.uploading').hide();
                             $('.showhide-btn').prop('disabled', false);

                            if (data.indexOf('***') != -1)
                            {

                            } else
                            {

                                //$('.image1').html('');
                                var imagearray = data.split(",");

                                var filecount = $(".imagedivs").length;

                                for (i = 0; i < imagearray.length; i++)
                                {

                                    if (imagearray[i])
                                    {

                                        var imgcount = filecount + i;

                                        var imagearray2 = "'" + imagearray[i] + "','" + imgcount + "'";

                                        if ($('#manipulation').val() == 'No') {

                                            $('.image1').append('<li class="ui-state-default productfile' + imgcount + ' imagedivs ngo_imagedivs" id="' + imagearray[i] + '" > <span aria-hidden="true" style=font-size:25px;" class="icon icomoon-icon-file-6"></span>&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage(' + imagearray2 + ');" style="cursor:pointer;">X</span><br><a href="<?php echo base_url() . 'media_library/'; ?>' + imagearray[i] + '" target="_blank">' + imagearray[i] + '</a></li>');
                                        } else {

                                            $('.image1').append('<li class="ui-state-default productfile' + imgcount + ' imagedivs ngo_imagedivs" id="' + imagearray[i] + '" ><img width="100" height="100" src="<?php echo base_url() . 'media_library/'; ?>' + imagearray[i] + '">&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage(' + imagearray2 + ');" style="cursor:pointer;">X</span><a href="<?php echo base_url() . 'media_library/'; ?>' + imagearray[i] + '" rel="prettyPhoto" title="' + imagearray[i] + '" class="txtcenter">' + imagearray[i] + '</a></li>');
                                            prettyPhotoLoad();
                                        }
                                    }

                                }

                                $('#images').val('');

                                $('#output').html('');

                            }


                            saveOrder();
                        }
                    });
                }
            }
        });



    });
</script>

<!--  combo values assigning  -->
<script type="text/javascript">
    $(document).ready(function () {

        fileData();
        manipulationData();
        checkfilevalidation();
        setcheckFIle();

        $(".comboset").on('change', '.combo', function () {

            fileData();
            manipulationData();
            removeAllfiles();
        });
    });
</script>
<!--  End of combo values assigning  -->




<script type="text/javascript">

    //      image popup function
    function prettyPhotoLoad() {

        $("a[rel^='prettyPhoto']").prettyPhoto({
            default_width: 800,
            default_height: 600,
            theme: 'facebook',
            social_tools: false,
            show_title: true
        });
    }
    //     End of image popup function  


    //      file sorting function
    $(function () {
        $("#sortable").sortable();
        $("#sortable").disableSelection();
    });
    //  End of  file sorting function 




    //      file configurations fetch function 

    function fileData() {
        var prefernces = $('.combo option:selected').attr('data-pref');
        var manipulation = $('.combo').find(':selected').attr('data-manip');

        var myObj = $.parseJSON(prefernces);

        $("#preferences").val(prefernces);
        $("#allowed_types").val(myObj.allowed_types);
        $("#max_size").val(myObj.max_size);
        $("#max_width").val(myObj.max_width);
        $("#max_height").val(myObj.max_height);
        $("#manipulation").val(manipulation);
        $(".textSize").text(myObj.max_size);
        $(".textWidth").text(myObj.max_width);
        $(".textHeight").text(myObj.max_height);

        if (myObj.max_width == false) {

            $(".dimensions").css('display', 'none');

        } else {

            $(".dimensions").css({'display': 'block',
                'float': 'right',
                'margin-right': '119px'
            });
        }


    }

    //   End of   file configurations fetch function 


   

    //  Manipulation Div hide show
    function manipToggle(bytes) {

        $(".ImageManipulation").slideToggle();

    }

    // End of Manipulation Div hide show
    // Manipulation details fetch 
    function manipulationData() {
        
        var manip = $('#manipulation').val();
        if (manip == 'Yes') {

            var comboid = $('#combo').val();
            var dataString = "comboid=" + comboid;

            var base_url = $(".base_url").val();
            $.ajax({
                type: "POST",
                url: base_url + "ecproductadmin/fetchManipdata/",
                data: dataString,
                cache: false,
                success: function (html) {

                    $('.ImageManipulation').html(html);

                }
            });

        } else {

            $('.ImageManipulation').html('');
        }
    }
    //End of Manipulation detauls fetch


//      file delete function 
    function deleteproductimage(img, count) {



        ajaxindicatorstart('please wait..');

        var dataString = "img=" + img;

        var base_url = $(".base_url").val();
        $.ajax({
            type: "POST",
            url: base_url + "ecproductadmin/delete_upload_image/",
            data: dataString,
            cache: false,
            success: function (html) {

                if (html == 'yes')
                {
                    $('.productfile' + count).remove();

                    var finalImages = $('#final_images').val();
                    var fileArray = [];
                    var fileArray = finalImages.split(",");
                    remove(fileArray, img);
                    var newstr = fileArray.toString();
                    $('#final_images').val(newstr);

                    ajaxindicatorstop();

                }

            }
        });
    }
    //   End of  file delete function   

//      file delete on change function  
    function removeAllfiles() {

        var finalFiles = $('#final_images').val();

        if (finalFiles != '') {

            var base_url = $(".base_url").val();
            var dataString = "finalFiles=" + finalFiles;

            $.ajax({
                type: "POST",
                url: base_url + "ecproductadmin/deleteFilechange/",
                data: dataString,
                cache: false,
                success: function (html) {

                    if (html == 'yes')
                    {
                        $('.image1').html("");
                        $('#final_images').val("");
                    }

                }
            });
        }

    }
//  End of file delete on change function    

//        file type required add/remove
    function checkfilevalidation() {

        if ($('#final_images').val() == '') {

            $("#images").attr("required");

        } else {

            $("#images").removeAttr("required");
        }

    }
    //        End of file type required add/remove 

// set filename after loading
    function setcheckFIle() {

        var valFile = $('#final_images').val();

        if (valFile != '') {

            var fileArray = valFile.split(",");

            var filecount = $(".imagedivs").length;

            for (i = 0; i < fileArray.length; i++)
            {

                if (fileArray[i])
                {

                    var imgcount = filecount + i;

                    var fileArray2 = "'" + fileArray[i] + "','" + imgcount + "'";

                    if ($('#manipulation').val() == 'No') {

                        $('.image1').append('<li class="ui-state-default productfile' + imgcount + ' imagedivs ngo_imagedivs" id="' + fileArray[i] + '" > <span aria-hidden="true" style=font-size:25px;" class="icon icomoon-icon-file-6"></span>&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage(' + fileArray2 + ');" style="cursor:pointer;">X</span><br><a href="<?php echo base_url() . 'media_library/'; ?>' + fileArray[i] + '" target="_blank">' + fileArray[i] + '</a></li>');
                    } else {

                        $('.image1').append('<li class="ui-state-default productfile' + imgcount + ' imagedivs ngo_imagedivs" id="' + fileArray[i] + '" ><img width="100" height="100" src="<?php echo base_url() . 'media_library/'; ?>' + fileArray[i] + '">&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage(' + fileArray2 + ');" style="cursor:pointer;">X</span><a href="<?php echo base_url() . 'media_library/'; ?>' + fileArray[i] + '" rel="prettyPhoto" title="' + fileArray[i] + '" class="txtcenter">' + fileArray[i] + '</a></li>');
                        prettyPhotoLoad();
                    }
                }

            }
        }
    }
    // End of set filename after loading
</script>
<!-- End of   file upload js-->


<!--    file_b upload_b js-->
<script type="text/javascript">
    $(document).ready(function () {

        $('#images_b').on('change', function () {
            var finalImages_b = $('#final_images_b').val();

            if (finalImages_b == '') {

                //validation

                var check1 = 0;
                var check2 = 0;
                var check3 = 0;
                var check4 = 0;

                if (window.File && window.FileReader && window.FileList && window.Blob) {

                    if (!$('#images_b').val()) //check empty input filed
                    {
                        $("#output_b").html("Please choose your Image !");

                        check2 = 1;

                    } else {

                        check2 = 0;
                    }

                    // var fsize = $('#images_b')[0].files[0].size; //get file size

                    var ftype = $('#images_b')[0].files[0].type; // get file type


                    var result = $('#images_b')[0].files;

                    for (var x = 0; x < result.length; x++) {
                        var fle = result[x];
                        // console.log(fle.size);  
                        var fsize = fle.size;
                        var maxSize = $("#max_size_b").val();
                        var fileSize = maxSize * 1048576;

                        //Allowed file size is less than  MB (1048576)
                        if (fsize > fileSize)
                        {
                            $("#output_b").html("<b>" + bytesToSizenotrounded(fsize) + "</b>" + fle.name + " is too big, it should be less than "+ fileSize +" MB.");
                            check4 = 1;
                            //alert(fle.name);
                        } else
                        {
                            check4 = 0;

                        }
                    }



                } else
                {
                    //Output error to older unsupported browsers that doesn't support HTML5 File API
                    $("#output_b").html("Please upgrade your browser, because your current browser lacks some new features we need!");
                    check1 = 1;
                }


                //validation


                var checktotal = check1 + check2 + check3 + check4;


                if (checktotal == 0) {

                    var formUrl = "<?php echo base_url() . 'ecproductadmin/bannerUpload'; ?>";

                    var files = new FormData($(".multiple_upload_form")[0]);

                    $.ajax({
                        url: formUrl,
                        type: 'POST',
                        data: files,
                        mimeType: "multipart/form-data",
                        beforeSend: function () {
                            $('.uploading_b').show();
                            $('.showhide-btn').prop('disabled', true);

                        },
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data, textSatus, jqXHR) {
                            //now get here response returned by PHP in JSON fomat you can parse it using JSON.parse(data)

                            $('.uploading_b').hide();
                            $('.showhide-btn').prop('disabled', false);

                            if (data.indexOf('***') != -1)
                            {

                            } else
                            {

                                //$('.image1_b').html('');
                                var imagearray = data.split(",");

                                var filecount = $(".imagedivs_b").length;

                                for (i = 0; i < imagearray.length; i++)
                                {

                                    if (imagearray[i])
                                    {

                                        var imgcount = filecount + i;

                                        var imagearray2 = "'" + imagearray[i] + "','" + imgcount + "'";

                                        if ($('#manipulation_b').val() == 'No') {

                                            $('.image1_b').append('<li class="ui-state-default productfile_b' + imgcount + ' imagedivs_b ngo_imagedivs" id="' + imagearray[i] + '" > <span aria-hidden="true" style=font-size:25px;" class="icon icomoon-icon-file-6"></span>&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage_b(' + imagearray2 + ');" style="cursor:pointer;">X</span><br><a href="<?php echo base_url() . 'media_library/'; ?>' + imagearray[i] + '" target="_blank">' + imagearray[i] + '</a></li>');
                                        } else {

                                            $('.image1_b').append('<li class="ui-state-default productfile_b' + imgcount + ' imagedivs_b ngo_imagedivs" id="' + imagearray[i] + '" ><img width="100" height="100" src="<?php echo base_url() . 'media_library/'; ?>' + imagearray[i] + '">&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage_b(' + imagearray2 + ');" style="cursor:pointer;">X</span><a href="<?php echo base_url() . 'media_library/'; ?>' + imagearray[i] + '" rel="prettyPhoto" title="' + imagearray[i] + '" class="txtcenter">' + imagearray[i] + '</a></li>');
                                            prettyPhotoLoad();
                                        }
                                    }

                                }

                                $('#images_b').val('');

                                $('#output_b').html('');

                            }


                            saveOrder();
                        }
                    });
                }
            }
        });



    });
</script>

<!--  combo values assigning  -->
<script type="text/javascript">
    $(document).ready(function () {

        fileData_b();
        manipulationData_b();
        checkfilevalidation_b();
        setcheckFIle_b();

        $(".comboset_b").on('change', '.combo_b', function () {

            fileData_b();
            manipulationData_b();
            removeAllfiles_b();
        });
    });
</script>
<!--  End of combo values assigning  -->




<script type="text/javascript">

    //      image popup function
    function prettyPhotoLoad() {

        $("a[rel^='prettyPhoto']").prettyPhoto({
            default_width: 800,
            default_height: 600,
            theme: 'facebook',
            social_tools: false,
            show_title: true
        });
    }
    //     End of image popup function  


    //      file sorting function
    $(function () {
        $("#sortable_b").sortable();
        $("#sortable_b").disableSelection();
    });
    //  End of  file sorting function 


 

    //      file configurations fetch function 

    function fileData_b() {
        var prefernces = $('.combo_b option:selected').attr('data-pref');
        var manipulation = $('.combo_b').find(':selected').attr('data-manip');

        var myObj = $.parseJSON(prefernces);

        $("#preferences_b").val(prefernces);
        $("#allowed_types_b").val(myObj.allowed_types);
        $("#max_size_b").val(myObj.max_size);
        $("#max_width_b").val(myObj.max_width);
        $("#max_height_b").val(myObj.max_height);
        $("#manipulation_b").val(manipulation);
        $(".textSize_b").text(myObj.max_size);
        $(".textWidth_b").text(myObj.max_width);
        $(".textHeight_b").text(myObj.max_height);

        if (myObj.max_width == false) {

            $(".dimensions_b").css('display', 'none');

        } else {

            $(".dimensions_b").css({'display': 'block',
                'float': 'right',
                'margin-right': '119px'
            });
        }


    }

    //   End of   file configurations fetch function 



    //  Manipulation Div hide show
    function manipToggle_b(bytes) {

        $(".ImageManipulation_b").slideToggle();

    }

    // End of Manipulation Div hide show
    // Manipulation details fetch 
    function manipulationData_b() {
        
        var manip = $('#manipulation_b').val();
        if (manip == 'Yes') {

            var comboid = $('#combo_b').val();
            var dataString = "comboid=" + comboid;

            var base_url = $(".base_url").val();
            $.ajax({
                type: "POST",
                url: base_url + "ecproductadmin/fetchManipdata/",
                data: dataString,
                cache: false,
                success: function (html) {

                    $('.ImageManipulation_b').html(html);

                }
            });

        } else {

            $('.ImageManipulation_b').html('');
        }
    }
    //End of Manipulation detauls fetch


//      file delete function 
    function deleteproductimage_b(img, count) {



        ajaxindicatorstart('please wait..');

        var dataString = "img=" + img;

        var base_url = $(".base_url").val();
        $.ajax({
            type: "POST",
            url: base_url + "ecproductadmin/delete_upload_image/",
            data: dataString,
            cache: false,
            success: function (html) {

                if (html == 'yes')
                {
                    $('.productfile_b' + count).remove();

                    var finalImages = $('#final_images_b').val();
                    var fileArray = [];
                    var fileArray = finalImages.split(",");
                    remove(fileArray, img);
                    var newstr = fileArray.toString();
                    $('#final_images_b').val(newstr);

                    ajaxindicatorstop();

                }

            }
        });
    }
    //   End of  file delete function   

//      file delete on change function  
    function removeAllfiles_b() {

        var finalFiles = $('#final_images_b').val();

        if (finalFiles != '') {

            var base_url = $(".base_url").val();
            var dataString = "finalFiles=" + finalFiles;

            $.ajax({
                type: "POST",
                url: base_url + "ecproductadmin/deleteFilechange/",
                data: dataString,
                cache: false,
                success: function (html) {

                    if (html == 'yes')
                    {
                        $('.image1_b').html("");
                        $('#final_images_b').val("");
                    }

                }
            });
        }

    }
//  End of file delete on change function    

//        file type required add/remove
    function checkfilevalidation_b() {

        if ($('#final_images_b').val() == '') {

            $("#images_b").attr("required");

        } else {

            $("#images_b").removeAttr("required");
        }

    }
    //        End of file type required add/remove 

// set filename after loading
    function setcheckFIle_b() {

        var valFile = $('#final_images_b').val();

        if (valFile != '') {

            var fileArray = valFile.split(",");

            var filecount = $(".imagedivs_b").length;

            for (i = 0; i < fileArray.length; i++)
            {

                if (fileArray[i])
                {

                    var imgcount = filecount + i;

                    var fileArray2 = "'" + fileArray[i] + "','" + imgcount + "'";

                    if ($('#manipulation_b').val() == 'No') {

                        $('.image1_b').append('<li class="ui-state-default productfile_b' + imgcount + ' imagedivs_b ngo_imagedivs" id="' + fileArray[i] + '" > <span aria-hidden="true" style=font-size:25px;" class="icon icomoon-icon-file-6"></span>&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage_b(' + fileArray2 + ');" style="cursor:pointer;">X</span><br><a href="<?php echo base_url() . 'media_library/'; ?>' + fileArray[i] + '" target="_blank">' + fileArray[i] + '</a></li>');
                    } else {

                        $('.image1_b').append('<li class="ui-state-default productfile_b' + imgcount + ' imagedivs_b ngo_imagedivs" id="' + fileArray[i] + '" ><img width="100" height="100" src="<?php echo base_url() . 'media_library/'; ?>' + fileArray[i] + '">&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage_b(' + fileArray2 + ');" style="cursor:pointer;">X</span><a href="<?php echo base_url() . 'media_library/'; ?>' + fileArray[i] + '" rel="prettyPhoto" title="' + fileArray[i] + '" class="txtcenter">' + fileArray[i] + '</a></li>');
                        prettyPhotoLoad();
                    }
                }

            }
        }
    }
    // End of set filename after loading
</script>
<!--    file_b upload_b js-->