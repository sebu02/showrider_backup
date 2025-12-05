<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>Manage Branch</h3>                    

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:70%; margin-left:15%;">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Add Branch</span>
                        </h4>

                    </div>
                    <div class="content">

                        <form class="form-horizontal multiple_upload_form" action="<?php echo base_url() . 'cmsstorefinderadmin/add_branch/'; ?>" method="post" enctype="multipart/form-data" >
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
                                        <label class="form-label span4" for="branch_name">Branch name</label>
                                        <input class="span8 slug_ref" id="branch_name" type="text" name="branch_name"  value="<?php echo set_value('branch_name'); ?>" required />
                                        <span class="error">
                                            <?php echo form_error('branch_name'); ?>
                                            <?php echo form_error('uniq_branch_name'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row row-fluid hide">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="slug">Unique branch name<b style="color:#F00; font-size:11px;">*</b></label>
                                        <span style="font-size:11px;" class="sa_base_url_section"><?php echo base_url(); ?></span> 
                                        <span style="font-size:11px;" class="sa_remain_url_section"></span> 
                                        <input class="span6 read-slug slug_url_val" readonly id="slug" type="text" name="uniq_branch_name" value="<?php echo set_value('uniq_branch_name'); ?>" required/>
                                        <span class="right manipTxt slugShow"><a onclick="slugShow()" class="icomoon-icon-pencil">Write Mode On</a></span>
                                        <span class="right manipTxt slugHide" style="display: none;"><a onclick="slugHide()" class="icomoon-icon-link-5">Write Mode Off</a></span>
                                        <span class="error">
                                            <?php echo form_error('uniq_branch_name'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php /*?><div class="gl_location_wrapper">

                                <?php
                                foreach ($location_types as $location_type) {
                                    $child_location_type = $this->store_model->get_child_location_type($location_type->id);
                                    ?>
                                    <div class="form-row row-fluid">
                                        <div class="span12">                                   
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="loc_<?php echo $location_type->id; ?>"><?php echo $location_type->location_type; ?></label>
                                                <div class="span8 controls">   
                                                    <select class="gl_uniq_loc loc_<?php echo $location_type->id; ?>" 
                                                            name="loc_<?php echo $location_type->id; ?>" 
                                                            data-type="<?php echo $location_type->id; ?>"
                                                            data-childtype="<?php echo $child_location_type->id; ?>"
                                                            required>
                                                        <option value=''>--select--</option>
                                                        <?php
                                                        if ($location_type->id == 1) {
                                                            foreach ($country_list as $key => $cl) {
                                                                ?>
                                                                <option value="<?php echo $cl->id; ?>"><?php echo $cl->location; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <span class="error">
                                                        <?php echo form_error('loc_' . $location_type->id); ?>
                                                    </span>
                                                </div> 
                                            </div>
                                        </div> 
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                            
                            <input type="hidden" id="main_location_id" class="main_location_id" name="main_location_id" value="">
                            <input type="hidden" id="sub_location_id" class="sub_location_id" name="sub_location_id" value="">

                            <?php $default_combo_list = json_decode($this->common_model->option->default_combo_list, TRUE); ?>
                            
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        
                                        <label class="form-label span4" for="combo">Select File Property</label>
                                        <div class="span8 controls comboset">  
                                            <select name="combo" id="combo" class="combo" data-imageid="gl_image_upload1">
                                                <?php
                                                foreach ($values as $combos) {
//                                                    if ($combos->manipulation_status == 'Yes') { // (IMG_MANIPULATION_COMBO) when need all combos remove this condition
                                                    ?>
                                                    <option data-pref='<?php echo $combos->preferences; ?>' data-manip='<?php echo $combos->manipulation_status; ?>' value="<?php echo $combos->fid; ?>" <?php
                                                    
                                                                            
                                                    if (isset($_POST['combo'])) {
                                                        if ($_POST['combo'] == $combos->fid) {
                                                            echo 'selected';
                                                        }
                                                    }elseif (!empty($default_combo_list['branch_banner'])) {
                                                                                if ($default_combo_list['branch_banner'] == $combos->fid) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                    ?> ><?php echo $combos->combo_name; ?></option>
                                                            <?php
                                                        }

//                                                } 
                                                        ?>

                                            </select>
                                        </div>
                                        <span class="error">
                                            <?php echo form_error('combo'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div><?php */?>
                            <?php /*?><div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Banner Picture</label>
                                                                                
                                        <input type="file" data-formclass='multiple_upload_form' data-formtype="add" data-controller="cmsstorefinderadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="single" data-imageid="gl_image_upload1"  class="gl_image_upload1 gl_uploadimage ngo_proof_attach_input_file span8" name="images[]" id="images" data-input_name="images" data-combo_name="combo" >
                                        
                                        <input type="hidden" class="file_input_name" name="file_input_name" value="">
                                        <input type="hidden" class="combo_name" name="combo_name" value="">
                                        
                                        <div class="upload_note span12">
                                            <span class="span4"></span> <span class="span8">Size:Below&nbsp;<span class="gl_image_upload1-textSize"></span>  MB for each file<span class="dimensions">, width:&nbsp;<span class="gl_image_upload1-textWidth"></span> px, Height:&nbsp;<span class="gl_image_upload1-textHeight"></span> px</span></span> <span class="manipTxt"><a onclick="manipToggle('gl_image_upload1')">Show Manipulations</a></span>
                                        </div>
                                        
                                        <div class="ImageManipulation gl_image_upload1-ImageManipulation">
                                        </div>
                                        <div class="preloader5">
                                            <span class="gl_image_upload1-uploading" style="display:none;text-align: center;"><img src="<?php echo base_url(); ?>static/adminpanel/images/loaders/horizontal/018.gif" alt="" style="display: block;margin: 0 auto;"/></span>
                                        </div>
                                        <span id="gl_image_upload1-output"></span>
                                        <ul class="gl_image_upload1-image1 add_new_image1 sortable" id="sortable" data-img_id="gl_image_upload1"></ul>
                                        <input type="hidden" name="final_images" value="<?php echo set_value('final_images'); ?>" id="gl_image_upload1-final_images">
                                    </div>
                                </div>
                            </div><?php */?>


								<div class="form-row row-fluid">
                                <div class="span12">
                                    
                                        <label class="form-label span4" for="address">Address</label>
                                   
                                    
                                        <textarea required name="address" class="span8 " rows="3" ><?php echo set_value('address'); ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('address'); ?>
                                        </span>
                                   
                                </div>
                            </div>
                            
                            
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="pickup_after_time">Pickup After Minutes</label>
                                        <input class="span8 gl_number_digits_only" id="pickup_after_time" type="text" name="pickup_after_time"  value="<?php echo set_value('pickup_after_time'); ?>"  /> Minutes
                                        <span class="error">
                                            <?php echo form_error('pickup_after_time'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="pickup_after_date">Pickup After Days</label>
                                        <input class="span8 gl_number_digits_only" id="pickup_after_date" type="text" name="pickup_after_date"  value="<?php echo set_value('pickup_after_date'); ?>"  /> Days
                                        <span class="error">
                                            <?php echo form_error('pickup_after_date'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <?php /*?><div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="address">Address</label>
                                    </div>
                                    <div class="row-fluid">
                                        <textarea required name="address" class="span8 ckeditor" rows="3" ><?php echo set_value('address'); ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('address'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="latitude">Latitude</label>
                                        <input class="span8" id="latitude" type="text" name="latitude"  value="<?php echo set_value('latitude'); ?>"  />
                                        <span class="error">
                                            <?php echo form_error('latitude'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div><?php */?>
                            <?php /*?><div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="longitude">Longitude</label>
                                        <input class="span8" id="longitude" type="text" name="longitude"  value="<?php echo set_value('longitude'); ?>"  />
                                        <span class="error">
                                            <?php echo form_error('longitude'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div><?php */?>
                            <?php /*?><div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="textarea">Embed Map</label>
                                        <textarea class="span8 elastic tinymce" name="map"  id="map" rows="1"  ><?php echo set_value('map'); ?></textarea>
                                    </div>
                                </div>
                            </div><?php */?>
                            <?php /*?><div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="ip_address">IP_address</label>
                                        <input class="span8" id="ip_address" type="text" name="ip_address"  value="<?php echo set_value('ip_address'); ?>"  />
                                        <span class="error">
                                            <?php echo form_error('ip_address'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div><?php */?>

<?php /*?>                            <div class="body_1" id="body1" style="width: 90%;">

                                <div class="form-row row-fluid inc1" id="1" style="position:relative;">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="extra_item_label form-label span4" for="extra_items">Extra items</label>
                                            <input name="extra_items" type="text" class="extra_items span8" id="extra_items" value="<?php echo set_value('extra_items'); ?>">

                                        </div> </div>


                                    <button title="" data-toggle="tooltip" class="btn btn-info btn-sm remove_field_button1" type="button" data-original-title="Remove" style="position: absolute; left: 101%; bottom: 2px;">remove</button>
                                </div>
                                <span class="error">
                                    <?php echo form_error('extra_items'); ?>
                                </span>

                            </div> 
                            <button class="btn bg-purple margin addnextrow1 pull-right" type="button">Add Next</button>

                            <div class="body_2" id="body2" style="width: 90%;">

                                <div class="form-row row-fluid inc2" style="position:relative;">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="extra_item_label form-label span4" for="extra_items">Company rules</label>
                                            <input placeholder="title" name="rules_title" type="text" class="rules_title span8" id="rules_title" value="<?php echo set_value('rules_title'); ?>">
                                            <div class="row-fluid">
                                                <!--<label class="form-label span4" for="normal">Video Description</label>-->
                                                <textarea placeholder="description" id="rules_desc" class="span8 rules_desc" type="text" name="rules_desc" rows="3"><?php echo set_value('rules_desc'); ?></textarea>

                                            </div>

                                        </div> </div>


                                    <button class="btn btn-info btn-sm remove_field_button2" type="button" data-original-title="Remove" style="position: absolute; left: 101%; bottom: 2px;">remove</button>
                                </div>
                                <span class="error">
                                    <?php echo form_error('rules_title'); ?>
                                </span>

                            </div>
                            <button class="btn bg-purple margin addnextrow2 pull-right" type="button">Add Next</button>
<?php */?>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">

                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <input type="hidden" class="gl_extra_value" name="gl_extra_value" id="gl_extra_value" />
                                <input type="hidden" name="rules_title_desc" id="rules_title_desc" />

                                <button onclick="save_extra()" id="sub" type="submit" class="btn btn-info showhide-btn sub">Submit</button>

                            </div>


                        </form>

                    </div>

                </div><!-- End .box -->

            </div><!-- End .span6 --><!-- End .span6 --><!-- End .span6 -->


        </div><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid -->





    </div><!-- End contentwrapper -->
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="application/javascript" src="<?php echo base_url() . 'static/'; ?>ajaxupload/js/jquery.form.js"></script>   
<script type="text/javascript">
                                    $(document).ready(function () {
                                        $('.body_1 .inc1').first().find('.remove_field_button1').hide();
                                        $(".addnextrow1").click(function () {

                                            var current = $('.body_1 .inc1').last();
                                            current.find('.remove_field_button1').show();
                                            var cloned = current.clone();
                                            var newid = '';
                                            $('.body_1 .inc1').each(function () {
                                                newid = $(this).attr('id');
                                                newid++;
                                            });
                                            cloned.find('.extra_items').val('');

                                            cloned.attr('id', newid);
                                            cloned.insertAfter(current);
                                            $('.body_1 .inc1').first().find('.remove_field_button1').hide();
                                        });
                                        $('.body_1').on('click', '.remove_field_button1', function () {
                                            $(this).parent().remove();
                                        });



                                        $('.body_2 .inc2').first().find('.remove_field_button2').hide();
                                        $(".addnextrow2").click(function () {

                                            var current = $('.body_2 .inc2').last();
                                            current.find('.remove_field_button2').show();
                                            var cloned = current.clone();
                                            var newid = '';
                                            $('.body_2 .inc2').each(function () {
                                                newid = $(this).attr('id');
                                                newid++;
                                            });
                                            cloned.find('.rules_title').val('');
                                            cloned.find('.rules_desc').val('');

                                            cloned.attr('id', newid);
                                            cloned.insertAfter(current);
                                            $('.body_2 .inc2').first().find('.remove_field_button2').hide();
                                        });
                                        $('.body_2').on('click', '.remove_field_button2', function () {
                                            $(this).parent().remove();
                                        });
                                    });



                                    function save_extra() {

                                        var new_order = [];
                                        var extra_items;
                                        $('#body1 div.inc1').each(function () {

                                            extra_items = $(this).find(".extra_items").val();

                                            new_order.push({extra_items: extra_items});
                                        });
                                        document.getElementById("gl_extra_value").value = JSON.stringify(new_order);

                                        saveOrder1();
//                                        saveOrder();
                                        savelocation();
                                    }




                                    function saveOrder1() {

                                        var new_order1 = [];
                                        var rules_title;
                                        var rules_desc;
                                        $('#body2 div.inc2').each(function () {
                                            rules_title = $(this).find(".rules_title").val();
                                            rules_desc = $(this).find(".rules_desc").val();
                                            if (rules_title != "" && rules_desc != "")
                                            {
                                                new_order1.push({rules_title: rules_title, rules_desc: rules_desc});
                                            }
                                        });
                                        document.getElementById("rules_title_desc").value = JSON.stringify(new_order1);
                                    }
</script>
<!--    file upload js-->



<script type="text/javascript">

    $(document).ready(function () {

//        var p_id = $('.gl_uniq_loc').val();
//        var l_id = 2;attr('data-location-key');
//
//        $.ajax({
//            url: "<?php echo base_url(); ?>index/get_location_list",
//            type: "post",
//            data: {
//                p_id: p_id, l_id: l_id
//            },
//            success: function (msg)
//            {
//                $(".gl_state").html(msg);
//            }
//        });



        $('.gl_location_wrapper').on('change', '.gl_uniq_loc', function () {

//            $(".gl_district").html('<option value="">--select--</option>');
//            $(".gl_city").html('<option value="">--select--</option>');

            var loctype = $(this).attr('data-type');
            var child_loctype = $(this).attr('data-childtype');

            var parent_id = $('.' + 'loc_' + loctype).val();

            $.ajax({
                url: "<?php echo base_url(); ?>cmsstorefinderadmin/get_location_list",
                type: "post",
                data: {
                    p_id: parent_id, l_id: child_loctype
                },
                success: function (msg)
                {
                    $('.' + 'loc_' + child_loctype).html(msg);
                }
            });
        });



    });
    function savelocation() {

        var main_location_id = $('.gl_location_wrapper .gl_uniq_loc').first().val();

        var sub_location_id = $('.gl_location_wrapper .gl_uniq_loc option:selected').last().val();
        $('.main_location_id').val(main_location_id);
        $('.sub_location_id').val(sub_location_id);
    }
</script>

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
