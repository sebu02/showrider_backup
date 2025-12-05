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
                            <span>Edit Branch</span>
                        </h4>

                    </div>
                    <div class="content">

                        <form class="form-horizontal multiple_upload_form" action="<?php echo base_url() . 'cmsstorefinderadmin/edit_branch?' . $_SERVER['QUERY_STRING']; ?>" method="post" enctype="multipart/form-data" >
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
                                        <input class="span8 slug_ref" id="branch_name" type="text" name="branch_name"  value="<?php echo $val->branch_name; ?>" required />
                                        <span class="error">
                                            <?php echo form_error('branch_name'); ?>
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
                                        <input class="span6 read-slug slug_url_val" readonly id="slug" type="text" name="uniq_branch_name" value="<?php echo $val->uniq_branch_name; ?>" required/>
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
                                $location_id_tree = $val->location_id_tree;

                                $location_id_tree_array = array();
                                $location_id_tree_array = explode('+', $location_id_tree);

                                array_pop($location_id_tree_array);
                                $location_id_tree_array = array_slice($location_id_tree_array, 1);
                                $location_id_tree_array = array_reverse($location_id_tree_array);

                                foreach ($location_types as $location_type) {
                                    $child_location_type = $this->store_model->get_child_location_type($location_type->id);
                                    $type_location_detail = $this->store_model->get_locations_by_idtree($location_type->id, $location_id_tree_array);
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
                                                                <option value="<?php echo $cl->id; ?>"<?php
                                                                if (in_array($cl->id, $location_id_tree_array)) {
                                                                    echo 'selected';
                                                                }
                                                                ?>><?php echo $cl->location; ?></option>
                                                                        <?php
                                                                    }
                                                                } elseif (!empty($type_location_detail)) {
                                                                    foreach ($type_location_detail as $p) {
                                                                        ?>
                                                                <option value="<?php echo $p->id; ?>" <?php
                                                                if (in_array($p->id, $location_id_tree_array)) {
                                                                    echo 'selected';
                                                                }
                                                                ?>><?php echo $p->location; ?></option>
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
                                <?php } ?>
                            </div>
                            <input type="hidden" id="main_location_id" class="main_location_id" name="main_location_id" value="">
                            <input type="hidden" id="sub_location_id" class="sub_location_id" name="sub_location_id" value="">
                            <?php
                            $banner = json_decode($val->image);

                            $banner_seo_alt = ''; $banner_seo_title = '';
                     $banner = json_decode($val->image);
                      if(!empty($banner[0]->seo_alt)){ $banner_seo_alt = $banner[0]->seo_alt; }
                      if(!empty($banner[0]->seo_title)){ $banner_seo_title = $banner[0]->seo_title; }
                            
                            if ($banner[0]->image != '') {
                                ?>

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="normal">Current Branch Picture</label>
                                            <img  class="span4"  src="<?php echo base_url() . 'media_library/' . $banner[0]->image; ?>" />  
                                            <input type="hidden" name="mediaID" value="<?php echo $banner[0]->media_id; ?>" >
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>  

                            <?php
//                            $image_seo = $this->common_model->GetByRow_notrash('cms_media', $banner[0]->media_id, 'id');
//                            $image_seo_details = json_decode($image_seo->images, true);
                            ?>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="seo_alt">SEO Alt <b style="color:#F00; font-size:11px;">*</b></label>
                                        <textarea class="span8 elastic tinymce" id="seo_alt"  name="seo_alt"  required /><?php echo $banner_seo_alt; ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('seo_alt'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="seo_title">SEO Title <b style="color:#F00; font-size:11px;">*</b></label>
                                        <textarea class="span8 elastic tinymce" id="seo_title"  name="seo_title"  required /><?php echo $banner_seo_title; ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('seo_title'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid currentCombo">
                                        <label class="form-label span4" for="normal">File Property</label>
                                        <?php
                                        foreach ($values as $combos) {
                                            if ($banner[0]->combo == $combos->fid) {
                                                ?>
                                                <input class="span8" readonly value="<?php echo $combos->combo_name; ?>"  >
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <span class="manipTxt combo-findAllcombo"><a onclick="allComboshow('combo')">Show/ Change All File Properties</a></span>
                                    <div class="row-fluid combo-comboSection" style="display: none">
                                        
                                        <label class="form-label span4" for="combo">Select File Property</label>
                                        <div class="span8 controls comboset">  
                                            <select name="combo" id="combo" class="combo" data-imageid="gl_image_upload1">
                                                <?php
                                                foreach ($values as $combos) {
//                                                    if ($combos->manipulation_status == 'Yes') { // (IMG_MANIPULATION_COMBO) when need all combos remove this condition
                                                    ?>
                                                    <option data-pref='<?php echo $combos->preferences; ?>' data-manip='<?php echo $combos->manipulation_status; ?>' <?php
                                                    if ($banner[0]->combo == $combos->fid) {
                                                        echo 'selected';
                                                    }elseif (isset($_POST['combo'])) {
                                                                if ($_POST['combo'] == $combos->fid) {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                    ?> value="<?php echo $combos->fid; ?>" ><?php echo $combos->combo_name; ?></option>
                                                            <?php
                                                        }

//                                                    } 
                                                        ?>

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
                                        <label class="form-label span4" for="normal">Branch Picture</label>
                                                                                
                                        <input type="file" data-formclass='multiple_upload_form' data-formtype="edit" data-controller="cmsstorefinderadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="single" data-imageid="gl_image_upload1"  class="gl_image_upload1 gl_uploadimage ngo_proof_attach_input_file span8" name="images[]" id="images" data-input_name="images" data-combo_name="combo" >
                                        
                                        <input type="hidden" class="file_input_name" name="file_input_name" value="">
                                        <input type="hidden" class="combo_name" name="combo_name" value="">
                                        
                                        <div class="upload_note span12">
                                            <span class="span4"></span> <span class="span8">Size:Below&nbsp;<span class="gl_image_upload1-textSize"></span>  MB for each file<span class="dimensions">, width:&nbsp;<span class="gl_image_upload1-textWidth"></span> px, Height:&nbsp;<span class="gl_image_upload1-textHeight"></span> px</span></span>
                                            <span class="manipTxt"><a onclick="manipToggle('gl_image_upload1')">Show Manipulations</a></span>
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
                                   
                                    
                                        <textarea required name="address" class="span8 " rows="3" ><?php echo $val->address; ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('address'); ?>
                                        </span>
                                   
                                </div>
                            </div>
                            
                            
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="pickup_after_time">Pickup After Minutes</label>
                                        <input class="span8 gl_number_digits_only" id="pickup_after_time" type="text" name="pickup_after_time"  value="<?php echo $val->pickup_after_time; ?>"  /> Minutes
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
                                        <input class="span8 gl_number_digits_only" id="pickup_after_date" type="text" name="pickup_after_date"  value="<?php echo $val->pickup_after_date; ?>"  /> Days
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
                                        <textarea required name="address" class="span8 ckeditor" rows="3" ><?php echo $val->address; ?></textarea>
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
                                        <input class="span8" id="latitude" type="text" name="latitude"  value="<?php echo $val->latitude; ?>"  />
                                        <span class="error">
                                            <?php echo form_error('latitude'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="longitude">Longitude</label>
                                        <input class="span8" id="longitude" type="text" name="longitude"  value="<?php echo $val->longitude; ?>"  />
                                        <span class="error">
                                            <?php echo form_error('longitude'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="textarea">Embed Map</label>
                                        <textarea class="span8 elastic tinymce" name="map"  id="map" rows="1"  ><?php echo $val->map_iframe; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="ip_address">IP_address</label>
                                        <input class="span8" id="ip_address" type="text" name="ip_address"  value="<?php echo $val->ip_address; ?>"  />
                                        <span class="error">
                                            <?php echo form_error('ip_address'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div><?php */?>
                            
                            
                            <div class="form-row row-fluid ">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="active_status">Active Status</label>
                                        <div class="span8 controls">
                                            <div class="left marginT5">
                                                <label><input type="radio" name="active_status" id="active_status1" value="a" <?php
                                                if (!empty($val->active_status)) {
                                                    if ($val->active_status == 'a') {
                                                        echo 'checked';
                                                    }
                                                } else {
                                                    echo 'checked';
                                                }
                                                ?> >
                                                Activate</label>
                                            </div>
                                            <div class="left marginT5 ">
                                                <label><input type="radio" name="active_status" id="active_status2" value="d" <?php
                                                if ($val->active_status == 'd') {
                                                    echo 'checked';
                                                }
                                                ?> >
                                                Deactivate</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php /*?><div class="body_1" id="body1" style="width: 90%;">


                                <?php
                                $value_list_entered = json_decode($val->extra_items, true);
                                $i = 1;
                                if (!empty($value_list_entered)) {
                                    foreach ($value_list_entered as $row) {
                                        ?>
                                        <div class="form-row row-fluid inc1" id="1" style="position:relative;">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="extra_item_label form-label span4" for="extra_items"><?php
                                                        if ($i == 1) {
                                                            echo "Extra items";
                                                        }
                                                        ?></label>
                                                    <input name="extra_items" type="text" class="extra_items span8" id="extra_items" value="<?php echo $row['extra_items']; ?>">

                                                </div> </div>


                                            <button title="" data-toggle="tooltip" class="btn btn-info btn-sm remove_field_button1" type="button" data-original-title="Remove" style="position: absolute; left: 101%; bottom: 2px;">remove</button>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    ?>
                                    <div class="form-row row-fluid inc1" id="1" style="position:relative;">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="extra_item_label form-label span4" for="extra_items">Extra items</label>
                                                <input name="extra_items" type="text" class="extra_items span8" id="extra_items" value="<?php echo set_value('extra_items'); ?>">

                                            </div> </div>


                                        <button title="" data-toggle="tooltip" class="btn btn-info btn-sm remove_field_button1" type="button" data-original-title="Remove" style="position: absolute; left: 101%; bottom: 2px;">remove</button>
                                    </div>
                                <?php } ?>
                                <span class="error">
                                    <?php echo form_error('extra_items'); ?>
                                </span>

                            </div> 
                            <button class="btn bg-purple margin addnextrow1 pull-right" type="button">Add Next</button>

                            <div class="body_2" id="body2" style="width: 90%;">
                                <?php
                                $company_rules = json_decode($val->company_rules, true);
                                $j = 1;
                                if (!empty($company_rules)) {
                                    foreach ($company_rules as $values) {
                                        ?>

                                        <div class="form-row row-fluid inc2" style="position:relative;">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="extra_item_label form-label span4" for="extra_items">Company rules</label>
                                                    <input placeholder="title" name="rules_title" type="text" class="rules_title span8" id="rules_title" value="<?php echo $values['rules_title']; ?>">
                                                    <div class="row-fluid">
                                                        <!--<label class="form-label span4" for="normal">Video Description</label>-->
                                                        <textarea placeholder="description" id="rules_desc" class="span8 rules_desc" type="text" name="rules_desc" rows="3"><?php echo $values['rules_desc']; ?></textarea>

                                                    </div>

                                                </div> </div>


                                            <button class="btn btn-info btn-sm remove_field_button2" type="button" data-original-title="Remove" style="position: absolute; left: 101%; bottom: 2px;">remove</button>
                                        </div>
                                        <?php
                                        $j++;
                                    }
                                } else {
                                    ?>
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
                                <?php } ?>
                                <span class="error">
                                    <?php echo form_error('rules_title'); ?>
                                </span>

                            </div>
                            <button class="btn bg-purple margin addnextrow2 pull-right" type="button">Add Next</button><?php */?>


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
//        saveOrder();
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


<script type="text/javascript">

    $(document).ready(function () {


        $('.gl_location_wrapper').on('change', '.gl_uniq_loc', function () {

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