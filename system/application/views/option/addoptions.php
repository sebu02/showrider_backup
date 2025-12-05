<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>Manage Options</h3>                    



        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:100%; ">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Add Options</span>
                        </h4>

                    </div>
                    <div class="content noPad clearfix ">

                        <form  id="wizard" class="form-horizontal  ui-formwizard  multiple_upload_form" action="<?php echo base_url() . 'optionadmin/addoptions'; ?>" method="post" enctype="multipart/form-data" >

                            <div class="wizard-steps clearfix hide">
                                <div class="wstep current" data-step-num="0">
                                    <div class="donut">1</div>
                                    <span class="txt">STEP 1</span>
                                </div>
                                <div id="step_2" class="wstep" data-step-num="1">
                                    <div class="donut">2</div>
                                    <span class="txt">STEP 2</span>
                                </div>
                            </div>




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
                                                        <option data-pref='<?php echo $combos->preferences; ?>' data-manip='<?php echo $combos->manipulation_status; ?>' value="<?php echo $combos->fid; ?>" <?php
                                                        if (isset($_POST['combo'])) {
                                                            if ($_POST['combo'] == $combos->fid) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?> ><?php echo $combos->combo_name; ?></option>
                                                            <?php
                                                            }
                                                        }
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
                                        <label class="form-label span4" for="normal">Logo</label>
                                        <input type="file"  class="ngo_proof_attach_input_file span8" name="images[]" id="images" multiple>
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
                            
                            
                          <div class="hide">   <!--hide section-->

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Slogan</label>
                                        <input class="span8" id="slogan" type="text" name="slogan" />
                                        <span class="error">
<?php echo form_error('slogan'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    var max_fields = 5; //maximum input boxes allowed
                                    var wrapper = $(".input_fields_wrap"); //Fields wrapper
                                    var add_button = $(".add_field_button"); //Add button ID

                                    var x = 1; //initlal text box count
                                    $(add_button).click(function (e) { //on add input button click
                                        e.preventDefault();
                                        if (x < max_fields) { //max input box allowed
                                            x++; //text box increment
                                            $(wrapper).append('<div class="form-row row-fluid repeatPhone"><input class="span3" id="phonelabel" type="text" name="phone_label" placeholder="Phone Label" /><input class="span3" placeholder="1234569870"  type="text" name="Dataphone" required /><input class="span1" type="checkbox" name="header" value="head" />&nbsp;Header<input class="span1" type="checkbox" name="footer"  value="footer"/>&nbsp;Footer<input class="span1" type="checkbox" name="contact" value="contact"  />&nbsp;Contact&nbsp;<a href="#" class="remove_field">Remove</a></div><br>'); //add input box
                                        }

                                        if (x == 5) {
                                            $('.add_field_button').css("display", "none");
                                        } else {
                                            $('.add_field_button').css("display", "block");
                                        }

                                    });

                                    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                                        e.preventDefault();
                                        $(this).parent('div').remove();
                                        x--;


                                    })
                                });
                            </script>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    var max_fields = 5; //maximum input boxes allowed
                                    var wrapper = $(".input_fields_wrap1"); //Fields wrapper
                                    var add_button = $(".add_field_button1"); //Add button ID

                                    var x = 1; //initlal text box count
                                    $(add_button).click(function (e) { //on add input button click
                                        e.preventDefault();

                                        if (x < max_fields) { //max input box allowed
                                            x++; //text box increment
                                            $(wrapper).append('<div class="form-row row-fluid repeatEmail"><input class="span3" id="email_label" type="text" name="email_label" placeholder="Email Label" /><input class="span3" placeholder="abc@xyz.com"  type="email" name="Dataemail" required /><input class="span1" type="checkbox" name="header_1" value="header" />&nbsp;Header<input class="span1" type="checkbox" name="footer_1"  value="footer"/>&nbsp;Footer<input class="span1" type="checkbox" name="contact_1" value="contact"  />&nbsp;&nbsp;Contact&nbsp;<a href="#" class="remove_field1">Remove</a></div><br>'); //add input box
                                        }

                                        if (x == 5) {
                                            $('.add_field_button1').css("display", "none");
                                        } else {
                                            $('.add_field_button1').css("display", "block");
                                        }
                                    });

                                    $(wrapper).on("click", ".remove_field1", function (e) { //user click on remove text
                                        e.preventDefault();
                                        $(this).parent('div').remove();
                                        x--;

                                    })
                                });
                            </script>
                            <div class="form-row row-fluid">
                                <div class="form-row row-fluid input_fields_wrap" id="phoneType">
                                    <div class="form-row row-fluid repeatPhone">
                                        <input class="span3" id="phone_label" type="text" name="phone_label" placeholder="Phone Label" />
                                        <input class="span3"  type="text" name="Dataphone"  placeholder="1234569870"/>
                                        <input class="span1" type="checkbox" name="header" value="header" />&nbsp;Header
                                        <input class="span1" type="checkbox" name="footer"  value="footer"/>&nbsp;Footer
                                        <input class="span1" type="checkbox" name="contact" value="contact" />&nbsp;Contact
                                        <span class="error"><?php echo form_error('phone'); ?></span><br><br>
                                    </div>
                                </div>
                                <button class="add_field_button right" type="button">Add More Phone</button>
                            </div>
                            <input type="hidden" id="final_phoneResult" name="final_phone" >
                            <div class="form-row row-fluid">
                                <div class="form-row row-fluid input_fields_wrap1" id="emailType">
                                    <div class="form-row row-fluid repeatEmail">
                                        <input class="span3" id="email_label" type="text" name="email_label" placeholder="Email Label" />
                                        <input class="span3"  type="email" name="Dataemail" required placeholder="abc@xyz.com"/>
                                        <input class="span1" type="checkbox" name="header_1" value="header" />&nbsp;Header
                                        <input class="span1" type="checkbox" name="footer_1"  value="footer"/>&nbsp;Footer
                                        <input class="span1" type="checkbox" name="contact_1" value="contact"  />&nbsp;Contact
                                        <span class="error"><?php echo form_error('email'); ?></span><br><br>
                                    </div>
                                </div>
                                <button class="add_field_button1 right" type="button">Add More email</button>
                            </div>    
                            <input type="hidden" id="final_emailResult" name="final_email" >
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Fax</label>
                                        <input class="span8" id="fax" type="text" name="fax" />
                                        <span class="error">
<?php echo form_error('fax'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <label class="form-label span4" for="normal">Address</label>
                            </div>
                            <div class="form-row row-fluid">
                                <textarea class="ckeditor" name="address" id="editor_content2" ><?php echo set_value('address'); ?></textarea>
<?php // echo display_ckeditor($ckeditor2);  ?>
                            </div>
                            <div class="form-row row-fluid">
                                <label class="form-label span4" for="normal">Extra Content 1</label>
                                <a href="<?php echo base_url(); ?>commonimageadmin/viewimages/" target="_blank" class="btn btn-inverse pull-right"><span class="icon16 icomoon-icon-image-3 white"></span>Add Image</a>
                            </div>
                            <div class="form-row row-fluid">
                                <textarea class="ckeditor" name="extra_content" id="editor_content3" ><?php echo set_value('extra_content'); ?></textarea>
<?php // echo display_ckeditor($ckeditor2);  ?>
                            </div>
                            <div class="form-row row-fluid">
                                <label class="form-label span4" for="normal">Extra Content 2</label>
                                <a href="<?php echo base_url(); ?>commonimageadmin/viewimages/" target="_blank" class="btn btn-inverse pull-right"><span class="icon16 icomoon-icon-image-3 white"></span>Add Image</a>
                            </div>
                            <div class="form-row row-fluid">
                                <textarea class="ckeditor" name="extra_content2" id="editor_content4" ><?php echo set_value('extra_content2'); ?></textarea>
<?php // echo display_ckeditor($ckeditor2);  ?>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">

                                        <label class="form-label span4" for="checkboxes">Choose Type of URL</label>

                                        <div class="span8 controls">

                                            <div class="left marginT5">
                                                <input type="radio" name="url_type" id="optionsRadios1" value="external" 
                                                <?php
                                                if (isset($_POST['url_type'])) {
                                                    if ($_POST['url_type'] == 'external')
                                                        echo "checked='checked'";
                                                }
                                                ?> />
                                                External
                                            </div>
                                            <div class="left marginT5">
                                                <input type="radio" name="url_type" id="optionsRadios2" value="internal" 

                                                       <?php
                                                       if (isset($_POST['url_type'])) {
                                                           if ($_POST['url_type'] == 'internal')
                                                               echo "checked='checked'";
                                                       }
                                                       ?>
                                                       />
                                                Internal
                                            </div>


                                        </div>

                                    </div>
                                </div> 
                            </div>

                            <script type="text/javascript">
                                $(function () {

                                    $('input[name="url_type"]').on('click', function () {
                                        if ($(this).val() == 'internal') {
                                            $('#type_page').show();
                                            $('#type_link').hide();
                                            $('input[name="extra_link1"]').removeAttr("required");
                                        } else if ($(this).val() == 'external') {
                                            $('#type_link').show();
                                            $('input[name="extra_link1"]').attr("required", "required");
                                            $('#type_page').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="form-row row-fluid" id="type_link" style="display: none">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Add External URL<b style="color:#F00; font-size:11px;"></b></label>

                                        <input  class="span8" type="url" name="extra_link1" value="<?php echo set_value('extra_link1'); ?>">
                                        <span class="error">
<?php echo form_error('extra_link1'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid" id="type_page" style="display: none">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Add Internal URL<b style="color:#F00; font-size:11px;"></b></label>

                                            <?php echo base_url(); ?> <input  class="span4" type="text" name="extra_link2" value="<?php echo set_value('extra_link2'); ?>">
                                        <span class="error">
<?php echo form_error('extra_link2'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>   
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Contact Email</label>
                                        <input class="span8" required id="contact_email" type="email" name="contact_email" />
                                        <span class="error">
<?php echo form_error('contact_email'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Contact From Email (Mail Purpose)</label>
                                        <input class="span8" required id="contact_from_email" type="email" name="contact_from_email" />
                                        <span class="error">
<?php echo form_error('contact_from_email'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                          </div><!--hide section-->
                          
                          
                          
                          
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Copy Right<b style="color:#F00; font-size:11px;">*</b></label>
                                        <input class="span8" id="copyright" type="text" name="copyright" required />
                                        <span class="error">
<?php echo form_error('copyright'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="textarea">Embed Map</label>
                                        <textarea class="span8 elastic tinymce" name="map"  id="map" rows="1"  ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="g_analytics">Google Analytics</label>
                                        <textarea class="span8 elastic tinymce" name="g_analytics"  id="g_analytics" rows="1"  ></textarea>
                                    </div>
                                </div>
                            </div>
                          
                          
                            <div class="form-row row-fluid">
                                  <div class="span12">
                                      <div class="row-fluid">
                                          <label class="form-label span4 tip"
                                                 for="default_list_count"
                                                  title="This field is used for showing default items count">Default List Count</label>
                                          <input class="span8" id="default_list_count" min="1" type="number" name="default_list_count" />
                                          <span class="error">
                                                  <?php echo form_error('default_list_count'); ?>
                                          </span>
                                      </div>
                                  </div>
                            </div>
                            <div class="form-row row-fluid">
                                  <div class="span12">
                                      <div class="row-fluid">
                                          <label class="form-label span4 tip" 
                                                 for="scroll_list_count"
                                                 title="This field is used for showing after first scroll items count">Scroll List Count</label>
                                          <input class="span8" id="scroll_list_count" min="1" type="number" name="scroll_list_count"  />
                                          <span class="error">
                                                  <?php echo form_error('scroll_list_count'); ?>
                                          </span>
                                      </div>
                                  </div>
                            </div>
                            
                            <div class="form-row row-fluid">
                                  <div class="span12">
                                      <div class="row-fluid">
                                          <label class="form-label span4 tip" 
                                                 for="scroll_limit"
                                                 title="This field is used to show the items after the scroll limit">Scroll Limit</label>
                                          <input class="span8" id="scroll_limit" min="1" type="number" name="scroll_limit"  />
                                          <span class="error">
                                                  <?php echo form_error('scroll_limit'); ?>
                                          </span>
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
                                                    if ($combos->manipulation_status == 'Yes') { // (IMG_MANIPULATION_COMBO) when need all combos remove this condition
                                                        ?>
                                                        <option data-pref='<?php echo $combos->preferences; ?>' 
                                                                data-manip='<?php echo $combos->manipulation_status; ?>' 
                                                                value="<?php echo $combos->fid; ?>" <?php
                                                                if (isset($_POST['combo_b'])) {
                                                                    if ($_POST['combo_b'] == $combos->fid) {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?> ><?php echo $combos->combo_name; ?></option>
                                                            <?php }
                                                        }
                                                        ?>

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
                                        <label class="form-label span4" for="images_b">Default Banner</label>
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
                            <!--Product options Section-->
                            <div class="row-fluid">
                                <div class="marginT10 span12">
                                    <div class="title">
                                        <h4> 
                                            <span>Product options</span>
                                        </h4>
                                    </div>


                                    <!--Banner content Section-->
                                    <?php
//                                        $pro_banner_content = json_decode($values1->default_product_banner_content, TRUE);
                                    ?>


                                    <div class="form-row row-fluid hide">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="banner_title">Slide Title</label>
                                                <div class="span9" style="position:relative;">
                                                    <input type="text" id="banner_title" name="banner_title" value="" />
                                                    <span class="error">
<?php echo form_error('banner_title'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid hide">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="banner_description">Slide Content</label>
                                            </div>

                                            <div class="form-row row-fluid">
                                                <textarea class="span8 elastic ckeditor" id="banner_description" name="banner_description"></textarea>
                                                <span class="error">
<?php echo form_error('banner_description'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="row_border" value="<?php echo set_value('row_border') ?>" id="row_border">  





                                    <!--END OF Banner content Section--> 

                                    <!--Product Banner Image Section-->


                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid currentCombo_c" style="display: none">
                                                <label class="form-label span3" for="normal">File Property</label>
                                                <?php
                                                foreach ($values as $combos) {
                                                    if ($pro_banner[0]->combo == $combos->fid) {
                                                        ?>
                                                        <input class="span9" readonly="true" value="<?php echo $combos->combo_name; ?>"  />
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
<?php /* ?> <span class="manipTxt findAllcombo_c"><a onclick="allCombosho_c()">Show/ Change All File Properties</a></span><?php */ ?>
                                            <div class="row-fluid comboSection_c" >
                                                <input type="hidden" id="preferences_c" value="">
                                                <input type="hidden" id="allowed_types_c" value="">
                                                <input type="hidden" id="max_size_c" value="">
                                                <input type="hidden" id="max_width_c" value="">
                                                <input type="hidden" id="max_height_c" value="">
                                                <input type="hidden" id="manipulation_c" value="">
                                                <label class="form-label span3" for="combo_c">Select File Property</label>
                                                <div class="span9 controls comboset_c">  
                                                    <select name="combo_c" id="combo_c" class="combo_c">
                                                        <?php
                                                        foreach ($values as $combos) {
                                                            if ($combos->manipulation_status == 'Yes') { // (IMG_MANIPULATION_COMBO) when need all combos remove this condition
                                                                ?>
                                                                ?>
                                                                <option data-pref='<?php echo $combos->preferences; ?>' 
                                                                        data-manip='<?php echo $combos->manipulation_status; ?>' 

                                                                        value="<?php echo $combos->fid; ?>" 
                                                                        <?php
                                                                        if (isset($_POST['combo_c'])) {
                                                                            if ($_POST['combo_c'] == $combos->fid) {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?> ><?php echo $combos->combo_name; ?></option>

                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                                <span class="error">
<?php echo form_error('combo_c'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="images_c">Product Default Banner</label>
                                                <input type="file"  class="ngo_proof_attach_input_file span9" name="images_c[]" id="images_c">
                                                <div class="upload_note span12">
                                                    <span class="span3"></span> <span class="span9">Size:Below&nbsp;<span class="textSize_c"></span>  MB for each file<span class="dimensions_c">, width:&nbsp;<span class="textWidth_c"></span> px, Height:&nbsp;<span class="textHeight_c"></span> px</span></span>
                                                    <span class="manipTxt_c"><a onclick="manipToggle_c()">Show Manipulations</a></span>
                                                </div>
                                                <div class="ImageManipulation_c">
                                                </div>
                                                <div class="preloader5">
                                                    <span class="uploading_c" style="display:none;text-align: center;"><img src="<?php echo base_url(); ?>static/adminpanel/images/loaders/horizontal/018.gif" alt="" style="display: block;margin: 0 auto;"/></span>
                                                </div>
                                                <span id="output"></span>
                                                <ul class="image1_c add_new_image1_c" id="sortable_c"></ul>
                                                <input type="hidden" name="final_images_c" value="<?php echo set_value('final_images_c') ?>" id="final_images_c">
                                            </div>
                                        </div>
                                    </div>
                                    <!--END OF Product Banner Image Section-->

                                    
                                <div class="form-row row-fluid">
                                  <div class="span12">
                                      <div class="row-fluid">
                                          <label class="form-label span4"
                                                 for="delivery_text">Delivery Text</label>
                                          <input class="span8" id="delivery_text" type="text" name="delivery_text" />
                                          <span class="error">
                                                  <?php echo form_error('delivery_text'); ?>
                                          </span>
                                      </div>
                                  </div>
                            </div>
                            <div class="form-row row-fluid">
                                  <div class="span12">
                                      <div class="row-fluid">
                                          <label class="form-label span4 tip" 
                                                 for="expected_day_count"
                                                 title="This field is used for setting expected delivery day count after purchase">Expected Day Count</label>
                                          <input class="span8" id="expected_day_count" min="1" type="number" name="expected_day_count"  />
                                          <span class="error">
                                                  <?php echo form_error('expected_day_count'); ?>
                                          </span>
                                      </div>
                                  </div>
                            </div> 
                                    
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                            <!--EOF Product options Section-->

                           <div class="row-fluid route_wrapper">
                                <div class="marginT10 span12">
                                    <div class="title">
                                        <h4> 
                                            <span>Route options</span>
                                        </h4>
                                    </div> 
                                    <div class="form-row row-fluid route_child">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="menu_route">Menu Route</label>
                                                    <div class="span9">
                                                        <input type="hidden" class="key_child" value="menu_route" id="menu_route_key" name="menu_route_key"  />
                                                        <input type="text" class="value_child seo_slug_check" id="menu_route" name="menu_route"  />
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid route_child">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="page_route">Page Route</label>
                                                    <div class="span9">
                                                        <input type="hidden" class="key_child" value="page_route" id="page_route_key" name="page_route_key"  />
                                                        <input type="text" class="value_child seo_slug_check" id="page_route" name="page_route" />
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid route_child">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="content_item_route">CMS Item Route</label>
                                                    <div class="span9">
                                                        <input type="hidden" class="key_child" value="content_item_route" id="cms_item_route_key" name="cms_item_route_key"  />
                                                        <input type="text" class="value_child seo_slug_check" id="content_item_route" name="content_item_route" />
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid route_child">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="content_category_route">CMS Category Route</label>
                                                    <div class="span9">
                                                        <input type="hidden" class="key_child" value="content_category_route" id="cms_category_route_key" name="cms_category_route_key"  />
                                                        <input type="text" class="value_child seo_slug_check" id="content_category_route" name="content_category_route" />
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid route_child">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="product_item_route">Product Item Route</label>
                                                    <div class="span9">
                                                        <input type="hidden" class="key_child" value="product_item_route" id="product_item_route_key" name="product_item_route_key"  />
                                                        <input type="text" class="value_child seo_slug_check" id="product_item_route" name="product_item_route" />
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid route_child">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="product_category_route">Product Category Route</label>
                                                    <div class="span9">
                                                        <input type="hidden" class="key_child" value="product_category_route" id="product_category_route_key" name="product_category_route_key"  />
                                                        <input type="text" class="value_child seo_slug_check" id="product_category_route" name="product_category_route" />
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <input type="hidden" name="route_form_value" id="route_form_value">
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">

                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-info showhide-btn pull-right" onclick="saveOrder()">Submit</button>

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

<!--    file upload js-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'static/'; ?>ajaxupload/js/jquery.form.js"></script>   
   

<script type="text/javascript">

                    function bordervalue() {

                        var new_border = [];
                        banner_title_val = $("#banner_title").val();
                        banner_description_val = CKEDITOR.instances.banner_description.getData();
                        new_border.push({banner_title: banner_title_val, banner_description: banner_description_val});
//                        console.log(JSON.stringify(new_border));
                        document.getElementById("row_border").value = JSON.stringify(new_border);

                    }

</script>



<script type="text/javascript">
    function savephoneType() {

        var new_phone = [];
        $('#phoneType div.repeatPhone').each(function () {

            header_value = $(this).find("input[name^='header'][type=checkbox]:checked").val();
            footer_value = $(this).find("input[name^='footer'][type=checkbox]:checked").val();
            contact_value = $(this).find("input[name^='contact'][type=checkbox]:checked").val();
            phone_label_value = $(this).find("input[name^='phone_label']").val();
            phone_num_source_value = $(this).find("input[name^='Dataphone']").val();
            new_phone.push({phone_label: phone_label_value, phone: phone_num_source_value, header: header_value, footer: footer_value, contact: contact_value});
        });

//        console.log(JSON.stringify(new_phone));
        document.getElementById("final_phoneResult").value = JSON.stringify(new_phone);

    }
    function saveemailType() {

        var new_email = [];
        $('#emailType div.repeatEmail').each(function () {

            header_value = $(this).find("input[name^='header_1'][type=checkbox]:checked").val();
            footer_value = $(this).find("input[name^='footer_1'][type=checkbox]:checked").val();
            contact_value = $(this).find("input[name^='contact_1'][type=checkbox]:checked").val();
            email_label_value = $(this).find("input[name^='email_label']").val();
            email_value = $(this).find("input[name^='Dataemail']").val();
            new_email.push({email_label: email_label_value, email: email_value, header: header_value, footer: footer_value, contact: contact_value});
        });

//        console.log(JSON.stringify(new_email));
        document.getElementById("final_emailResult").value = JSON.stringify(new_email);

    }

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

        checkfilevalidation();
        routeformdata();
//        savephoneType();
//        saveemailType();

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

//        bordervalue();
        checkfilevalidation_c();

        var new_order_c = new Array();
        $('ul#sortable_c li').each(function () {
            new_order_c.push($(this).attr("id"));
        });
        document.getElementById("final_images_c").value = new_order_c;
    }
    //    End of  file order save function    



    $(document).ready(function () {

        $('#images').on('change', function () {
            var finalImages = $('#final_images').val();


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
                        $("#output").html("<b>" + bytesToSizenotrounded(fsize) + "</b>" + fle.name + " is too big, it should be less than " + bytesToSizenotrounded(fileSize));
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
                $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
                check1 = 1;
            }


            //validation


            var checktotal = check1 + check2 + check3 + check4;


            if (checktotal == 0) {

                var formUrl = "<?php echo base_url() . 'optionadmin/bannerUpload'; ?>";

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
                url: base_url + "optionadmin/fetchManipdata/",
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
            url: base_url + "optionadmin/delete_upload_image/",
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
                url: base_url + "optionadmin/deleteFilechange/",
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
                            $("#output").html("<b>" + bytesToSizenotrounded(fsize) + "</b>" + fle.name + " is too big, it should be less than " + bytesToSizenotrounded(fileSize));
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
                    $("#output_b").html("Please upgrade your browser, because your current browser lacks some new features we need!");
                    check1 = 1;
                }


                //validation


                var checktotal = check1 + check2 + check3 + check4;


                if (checktotal == 0) {

                    var formUrl = "<?php echo base_url() . 'optionadmin/bannerUpload'; ?>";

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
                url: base_url + "optionadmin/fetchManipdata/",
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
            url: base_url + "optionadmin/delete_upload_image/",
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
                url: base_url + "optionadmin/deleteFilechange/",
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


<!--    file_c upload_c js-->
<script type="text/javascript">
    $(document).ready(function () {

        $('#images_c').on('change', function () {
            var finalImages_c = $('#final_images_c').val();

            if (finalImages_c == '') {

                //validation

                var check1 = 0;
                var check2 = 0;
                var check3 = 0;
                var check4 = 0;

                if (window.File && window.FileReader && window.FileList && window.Blob) {

                    if (!$('#images_c').val()) //check empty input filed
                    {
                        $("#output_c").html("Please choose your Image !");

                        check2 = 1;

                    } else {

                        check2 = 0;
                    }

                    // var fsize = $('#images_c')[0].files[0].size; //get file size

                    var ftype = $('#images_c')[0].files[0].type; // get file type


                    var result = $('#images_c')[0].files;

                    for (var x = 0; x < result.length; x++) {
                        var fle = result[x];
                        // console.log(fle.size);  
                        var fsize = fle.size;
                        var maxSize = $("#max_size_c").val();
                        var fileSize = maxSize * 1048576;

                        //Allowed file size is less than  MB (1048576)
                        if (fsize > fileSize)
                        {
                            $("#output_c").html("<b>" + bytesToSizenotrounded(fsize) + "</b>" + fle.name + " is too big, it should be less than " + bytesToSizenotrounded(fileSize));
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
                    $("#output_c").html("Please upgrade your browser, because your current browser lacks some new features we need!");
                    check1 = 1;
                }


                //validation


                var checktotal = check1 + check2 + check3 + check4;


                if (checktotal == 0) {

                    var formUrl = "<?php echo base_url() . 'optionadmin/bannerUpload'; ?>";

                    var files = new FormData($(".multiple_upload_form")[0]);

                    $.ajax({
                        url: formUrl,
                        type: 'POST',
                        data: files,
                        mimeType: "multipart/form-data",
                        beforeSend: function () {
                            $('.uploading_c').show();
                            $('.showhide-btn').prop('disabled', true);

                        },
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data, textSatus, jqXHR) {
                            //now get here response returned by PHP in JSON fomat you can parse it using JSON.parse(data)

                            $('.uploading_c').hide();
                            $('.showhide-btn').prop('disabled', false);

                            if (data.indexOf('***') != -1)
                            {

                            } else
                            {

                                //$('.image1_c').html('');
                                var imagearray = data.split(",");

                                var filecount = $(".imagedivs_c").length;

                                for (i = 0; i < imagearray.length; i++)
                                {

                                    if (imagearray[i])
                                    {

                                        var imgcount = filecount + i;

                                        var imagearray2 = "'" + imagearray[i] + "','" + imgcount + "'";

                                        if ($('#manipulation_c').val() == 'No') {

                                            $('.image1_c').append('<li class="ui-state-default productfile_c' + imgcount + ' imagedivs_c ngo_imagedivs" id="' + imagearray[i] + '" > <span aria-hidden="true" style=font-size:25px;" class="icon icomoon-icon-file-6"></span>&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage_c(' + imagearray2 + ');" style="cursor:pointer;">X</span><br><a href="<?php echo base_url() . 'media_library/'; ?>' + imagearray[i] + '" target="_blank">' + imagearray[i] + '</a></li>');
                                        } else {

                                            $('.image1_c').append('<li class="ui-state-default productfile_c' + imgcount + ' imagedivs_c ngo_imagedivs" id="' + imagearray[i] + '" ><img width="100" height="100" src="<?php echo base_url() . 'media_library/'; ?>' + imagearray[i] + '">&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage_c(' + imagearray2 + ');" style="cursor:pointer;">X</span><a href="<?php echo base_url() . 'media_library/'; ?>' + imagearray[i] + '" rel="prettyPhoto" title="' + imagearray[i] + '" class="txtcenter">' + imagearray[i] + '</a></li>');
                                            prettyPhotoLoad();
                                        }
                                    }

                                }

                                $('#images_c').val('');

                                $('#output_c').html('');

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

        fileData_c();
        manipulationData_c();
        checkfilevalidation_c();
        setcheckFIle_c();

        $(".comboset_c").on('change', '.combo_c', function () {

            fileData_c();
            manipulationData_c();
            removeAllfiles_c();
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
        $("#sortable_c").sortable();
        $("#sortable_c").disableSelection();
    });
    //  End of  file sorting function 




    //      file configurations fetch function 

    function fileData_c() {
        var prefernces = $('.combo_c option:selected').attr('data-pref');
        var manipulation = $('.combo_c').find(':selected').attr('data-manip');

        var myObj = $.parseJSON(prefernces);

        $("#preferences_c").val(prefernces);
        $("#allowed_types_c").val(myObj.allowed_types);
        $("#max_size_c").val(myObj.max_size);
        $("#max_width_c").val(myObj.max_width);
        $("#max_height_c").val(myObj.max_height);
        $("#manipulation_c").val(manipulation);
        $(".textSize_c").text(myObj.max_size);
        $(".textWidth_c").text(myObj.max_width);
        $(".textHeight_c").text(myObj.max_height);

        if (myObj.max_width == false) {

            $(".dimensions_c").css('display', 'none');

        } else {

            $(".dimensions_c").css({'display': 'block',
                'float': 'right',
                'margin-right': '119px'
            });
        }


    }

    //   End of   file configurations fetch function 



    //  Manipulation Div hide show
    function manipToggle_c(bytes) {

        $(".ImageManipulation_c").slideToggle();

    }

    // End of Manipulation Div hide show
    // Manipulation details fetch 
    function manipulationData_c() {

        var manip = $('#manipulation_c').val();
        if (manip == 'Yes') {

            var comboid = $('#combo_c').val();
            var dataString = "comboid=" + comboid;

            var base_url = $(".base_url").val();
            $.ajax({
                type: "POST",
                url: base_url + "optionadmin/fetchManipdata/",
                data: dataString,
                cache: false,
                success: function (html) {

                    $('.ImageManipulation_c').html(html);

                }
            });

        } else {

            $('.ImageManipulation_c').html('');
        }
    }
    //End of Manipulation detauls fetch


//      file delete function 
    function deleteproductimage_c(img, count) {



        ajaxindicatorstart('please wait..');

        var dataString = "img=" + img;

        var base_url = $(".base_url").val();
        $.ajax({
            type: "POST",
            url: base_url + "optionadmin/delete_upload_image/",
            data: dataString,
            cache: false,
            success: function (html) {

                if (html == 'yes')
                {
                    $('.productfile_c' + count).remove();

                    var finalImages = $('#final_images_c').val();
                    var fileArray = [];
                    var fileArray = finalImages.split(",");
                    remove(fileArray, img);
                    var newstr = fileArray.toString();
                    $('#final_images_c').val(newstr);

                    ajaxindicatorstop();

                }

            }
        });
    }
    //   End of  file delete function   

//      file delete on change function  
    function removeAllfiles_c() {

        var finalFiles = $('#final_images_c').val();

        if (finalFiles != '') {

            var base_url = $(".base_url").val();
            var dataString = "finalFiles=" + finalFiles;

            $.ajax({
                type: "POST",
                url: base_url + "optionadmin/deleteFilechange/",
                data: dataString,
                cache: false,
                success: function (html) {

                    if (html == 'yes')
                    {
                        $('.image1_c').html("");
                        $('#final_images_c').val("");
                    }

                }
            });
        }

    }
//  End of file delete on change function    

//        file type required add/remove
    function checkfilevalidation_c() {

        if ($('#final_images_c').val() == '') {

            $("#images_c").attr("required");

        } else {

            $("#images_c").removeAttr("required");
        }

    }
    //        End of file type required add/remove 

// set filename after loading
    function setcheckFIle_c() {

        var valFile = $('#final_images_c').val();

        if (valFile != '') {

            var fileArray = valFile.split(",");

            var filecount = $(".imagedivs_c").length;

            for (i = 0; i < fileArray.length; i++)
            {

                if (fileArray[i])
                {

                    var imgcount = filecount + i;

                    var fileArray2 = "'" + fileArray[i] + "','" + imgcount + "'";

                    if ($('#manipulation_c').val() == 'No') {

                        $('.image1_c').append('<li class="ui-state-default productfile_c' + imgcount + ' imagedivs_c ngo_imagedivs" id="' + fileArray[i] + '" > <span aria-hidden="true" style=font-size:25px;" class="icon icomoon-icon-file-6"></span>&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage_c(' + fileArray2 + ');" style="cursor:pointer;">X</span><br><a href="<?php echo base_url() . 'media_library/'; ?>' + fileArray[i] + '" target="_blank">' + fileArray[i] + '</a></li>');
                    } else {

                        $('.image1_c').append('<li class="ui-state-default productfile_c' + imgcount + ' imagedivs_c ngo_imagedivs" id="' + fileArray[i] + '" ><img width="100" height="100" src="<?php echo base_url() . 'media_library/'; ?>' + fileArray[i] + '">&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage_c(' + fileArray2 + ');" style="cursor:pointer;">X</span><a href="<?php echo base_url() . 'media_library/'; ?>' + fileArray[i] + '" rel="prettyPhoto" title="' + fileArray[i] + '" class="txtcenter">' + fileArray[i] + '</a></li>');
                        prettyPhotoLoad();
                    }
                }

            }
        }
    }
    // End of set filename after loading
//  show all combos only in edit
    function allComboshow_c() {
        $('.currentCombo_c').hide();
        $('.comboSection_c').show();
        $('.findAllcombo_c').hide();

    }
// End of  show all combos only in edit        

</script>
<!--    file_c upload_c js-->        
<script>
    
   
    function routeformdata() {
         
        var form_value = [];
         $('.route_wrapper .route_child').each(function(){
             
            route_key=$(this).find('.key_child').val();
            route_value=$(this).find('.value_child').val();
            
            form_value.push({route_key: route_key,route_value:route_value});
         });
        console.log(JSON.stringify(form_value));
        document.getElementById("route_form_value").value = JSON.stringify(form_value);
            
    }
    
    $('.seo_slug_check').keyup(function () {
        

        var string = $(this).val();
        var string = string.replace(/[^a-zA-Z0-9]/g, '-');

        var string = string.replace(/\-+/g, '-');

        var string = string.toLowerCase();

        $(this).val(string.trim());

    });
</script>