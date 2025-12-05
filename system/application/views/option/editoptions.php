<style>
    .wizard-steps .wstep .donut span.icon16 {
        margin-top: 0px !important;
        margin-left: 5px !important;
    }
    .wizard-steps .wstep.done a{
        color: #72b110;
    }
</style>
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
        margin-left: 35px !important;
    }
    .gl-columns label {
        cursor: move;
    }
    .gl_checkbox_style {
        position: relative;
        margin-right: 5px;
        width: 19px;
        height: 19px;
        display: inline-block;
        vertical-align: middle;
        margin: 0;
        padding: 0;
        zoom: 1;
    }



    .gl_radio_library label.assetradio {
        border-radius: 3px;
        margin-right: 0%;
        cursor: pointer;
        font-weight: 400;
        padding: 9px 18px 8px 9px;
        background-color: #dcdfd4;
        margin-bottom: 10px!important;
    }

    .gl_radio_library label.assetradio.checked {
        background-color:#266c8e;
        color:#fff!important;
        text-shadow:#000 1px 1px 2px!important;
    }

    .gl_radio_type label.assetradio {
        border-radius: 3px;
        margin-right: 0%;
        cursor: pointer;
        font-weight: 400;
        padding: 9px 18px 8px 9px;
        background-color: #dcdfd4;
        margin-bottom: 10px!important;
    }

    .gl_radio_type label.assetradio.checked {
        background-color:#266c8e;
        color:#fff!important;
        text-shadow:#000 1px 1px 2px!important;
    }


    .gl_indicator{
        margin-bottom: 20px;
    }
    .gl_indicator li{
        display: inline;
        list-style-type: none;
        padding: 10px;
        margin-right: 10px;
    }
</style>

<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading <?php echo $this->common_model->admin_or_super_admin();?>">

            <h3>Manage Options</h3>                    
            <a href="<?php echo base_url() . 'optionadmin/viewoptions' ?>" class="btn btn-info right marginT5"><i class="icon16 icomoon-icon-backspace"></i> Back To Options</a>
        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:100%;">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Manage Settings</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">

                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <div class="error_messages">



                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($this->uri->segment(4) == 'security') {
                            ?>
                            <form  id="wizard" class="form-horizontal  ui-formwizard  multiple_upload_form_security gl_form gl_security" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/security' ?>" method="post" enctype="multipart/form-data" >

                                <div class="title">
                                    <h4> 
                                        <span>Security Settings</span>
                                    </h4>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="secure">Secure</label>
                                            <div class="span8 controls">
                                                <div class="left marginT5 ">
                                                    <input type="radio" name="secure" id="secure1" value="on" <?php
                                                    if ($option_row->secure == 'on') {
                                                        echo 'checked';
                                                    }
                                                    ?> />
                                                    On
                                                </div>
                                                <div class="left marginT5">
                                                    <input type="radio" name="secure" id="secure2" value="off" <?php
                                                    if ($option_row->secure == 'off') {
                                                        echo 'checked';
                                                    }
                                                    ?> />
                                                    Off
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="secured_pages">Security set to</label>
                                            <div class="span8 controls">
                                                <div class="left marginT5 ">
                                                    <input type="radio" name="secured_pages" id="secured_pages1" value="full" <?php
                                                    if ($option_row->secured_pages == 'full') {
                                                        echo 'checked';
                                                    }
                                                    ?> />
                                                    Full
                                                </div>
                                                <div class="left marginT5">
                                                    <input type="radio" name="secured_pages" id="secured_pages2" value="custom" <?php
                                                    if ($option_row->secured_pages == 'custom') {
                                                        echo 'checked';
                                                    }
                                                    ?> />
                                                    Custom
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" >Submit</button>

                                </div>

                            </form>  

                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'login') {
                            ?>

                            <form  id="wizard" class="form-horizontal  ui-formwizard  multiple_upload_form_security gl_form gl_login" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/login' ?>" method="post" enctype="multipart/form-data" >

                                <div class="title">
                                    <h4> 
                                        <span>Login Settings</span>
                                    </h4>
                                </div>

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="login_type">Login Type</label>
                                            <div class="span8 controls">
                                                <div class="left marginT5 ">
                                                    <input type="radio" name="login_type" id="login_type1" value="normal" <?php
                                                    if ($option_row->login_type == 'normal') {
                                                        echo 'checked';
                                                    }
                                                    ?> />
                                                    Normal
                                                </div>
                                                <div class="left marginT5">
                                                    <input type="radio" name="login_type" id="login_type2" value="advanced" <?php
                                                    if ($option_row->login_type == 'advanced') {
                                                        echo 'checked';
                                                    }
                                                    ?> />
                                                    Advanced
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" >Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>

                        <?php
                        if ($this->uri->segment(4) == 'scroll') {
                            ?>

                            <form  id="wizard" class="form-horizontal  ui-formwizard  multiple_upload_form_security gl_form gl_scroll" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/scroll' ?>" method="post" enctype="multipart/form-data" >

                                <div class="title">
                                    <h4> 
                                        <span>Scroll Settings</span>
                                    </h4>
                                </div>

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4 tip"
                                                   for="default_list_count"
                                                   title="This field is used for showing default items count">Default List Count</label>
                                            <input class="span8" value="<?php echo $option_row->default_list_count; ?>"  id="default_list_count" min="1" type="number" name="default_list_count" />
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
                                            <input class="span8" value="<?php echo $option_row->scroll_list_count; ?>" id="scroll_list_count" min="1" type="number" name="scroll_list_count"  />
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
                                            <input class="span8" value="<?php echo $option_row->scroll_limit; ?>" id="scroll_limit" min="1" type="number" name="scroll_limit"  />
                                            <span class="error">
                                                <?php echo form_error('scroll_limit'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" >Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>  


                        <?php
                        if ($this->uri->segment(4) == 'common') {
                            ?>                      



                            <form  id="wizard" class="gl_form gl_common form-horizontal  ui-formwizard gl_multiple_upload_form multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/common' ?>" method="post" enctype="multipart/form-data" >
                                <div class="title">
                                    <h4> 
                                        <span>Common Settings</span>
                                    </h4>
                                </div>
                                
                                 <div class="title">
                                            <h4> 
                                                <span>Website Logo</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="cust_scroll">Logo Type</label>
                                            <div class="span8 controls">

                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  for="logo">
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="image_type" name="image_type" 
                                                        <?php
                                                        if (!empty($option_row->logo_type)) {
                                                            if ($option_row->logo_type == 'logo') {
                                                                echo 'checked';
                                                            }
                                                        } else {
                                                            echo 'checked';
                                                        }
                                                        ?>  id="logo" value="logo"  />Logo</label>
                                                </div>

                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  for="svg">
                                                        <input required <?php
                                                        if ($option_row->logo_type == 'svg') {
                                                            echo 'checked';
                                                        }
                                                        ?>  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="image_type" name="image_type"  id="svg" value="svg"  />Svg</label>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>





                                <div class="logo_section  <?php
                                if ($option_row->logo_type == 'svg') {
                                    echo 'hide';
                                }
                                ?>">
                                    <div class="form-row row-fluid">
                                        <div class="span2"></div>
                                        <div class="span9"><a href="<?php echo base_url(); ?>optionadmin/viewLogos/<?php echo $option_row->id; ?>" target="_blank" class="btn btn-info pull-right">
                                                <span class="icon16 icomoon-icon-image-3 white"></span>View Logo Gallery</a></div>
                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="row-fluid comboSection">
                                                    <label class="form-label span4" for="combo">Select File Property</label>
                                                    <div class="span8 controls comboset">  
                                                        <select name="combo" id="combo" class="combo" data-imageid="gl_image_upload1">
                                                            <?php
                                                            foreach ($values as $combos) {
                                                                ?>
                                                                <option data-pref='<?php echo $combos->preferences; ?>' data-manip='<?php echo $combos->manipulation_status; ?>' value="<?php echo $combos->fid; ?>" <?php
                                                                if (isset($_POST['combo'])) {
                                                                    if ($_POST['combo'] == $combos->fid) {
                                                                        echo 'selected';
                                                                    }
                                                                } else if (!empty($default_combo_list['logo'])) {
                                                                    if ($default_combo_list['logo'] == $combos->fid) {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?> ><?php echo $combos->combo_name; ?></option>
                                                                        <?php
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
                                    </div>



                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="normal">Logo</label>
                                                <input  type="file" data-formclass='gl_multiple_upload_form'  data-formtype="edit" data-controller="optionadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="single" data-imageid="gl_image_upload1"  class="gl_image_upload1 gl_uploadimage ngo_proof_attach_input_file  span8" name="images[]" data-input_name="images" data-combo_name="combo" id="images" >

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
                                                <ul class="gl_image_upload1-image1 add_new_image1 sortable" data-img_id="gl_image_upload1" id="sortable"></ul>
                                                <input type="hidden" name="final_images" value="<?php // echo set_value('final_images');            ?>" id="gl_image_upload1-final_images">
                                            </div>
                                        </div>
                                    </div>






                                </div>

                                <div class="form-row row-fluid svg_section <?php
                                if ($option_row->logo_type == 'logo') {
                                    echo 'hide';
                                }
                                ?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="svg_image">Svg<b style="color:#F00; font-size:11px;">*</b></label>
                                            <textarea class="span8" id="svg_image"  name="svg_image"><?php echo $option_row->svg_text; ?></textarea>
                                        </div>
                                    </div>
                                </div>   


<div class="title">
<h4> 
<span>Copy Right</span>
</h4>
</div>

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="normal">Copy Right</label>
                                            <input class="span8" id="copyright" type="text" name="copyright" required  value="<?php echo $option_row->copyright; ?>"/>
                                        </div>
                                    </div>
                                </div>
                                

<div class="title">
<h4> 
<span>Embed Map</span>
</h4>
</div>                               


                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="textarea">Embed Map</label>
                                            <textarea class="span8 elastic tinymce" name="map"  id="map" rows="1"  ><?php echo $option_row->map_iframe; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
<div class="title">
<h4> 
<span>Google Analytics</span>
</h4>
</div> 

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="g_analytics">Google Analytics</label>
                                            <textarea class="span8 elastic tinymce" name="g_analytics"  id="g_analytics" rows="1"  ><?php echo $option_row->google_analytics; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                
<div class="title">
<h4> 
<span>Theme class</span>
</h4>
</div>
                                
                                
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="theme_color">Theme class</label>
                                            <div class="span8 controls">
                                                <input id="theme_color"  name="theme_color" type="text" value="<?php echo $option_row->theme_color; ?>" style="width:100%;" />
                                            </div>
                                            <span class="error">
                                                <?php echo form_error('theme_color'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
<div class="title">
<h4> 
<span>Default Banner</span>
</h4>
</div>
                                
                                <?php
                                $banner = json_decode($option_row->default_banner);
                                if ($banner[0]->image != '') {
                                    ?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="normal">Current Default Banner</label>
                                                <img  class="span4"  src="<?php echo base_url() . 'media_library/' . $banner[0]->image; ?>" />  
                                                <input type="hidden" name="mediaID" value="<?php echo $banner[0]->media_id; ?>" >
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                                ?>     
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid combo_b-currentCombo">
                                            <label class="form-label span4" for="normal">File Property</label>
                                            <?php
                                            foreach ($values as $combos) {
                                                if ($banner[0]->combo == $combos->fid) {
                                                    ?>
                                                    <input class="span8" readonly value="<?php echo $combos->combo_name; ?>"  />
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>


                                        <span class="manipTxt combo_b-findAllcombo"><a onclick="allComboshow('combo_b')">Show/ Change All File Properties</a></span>

                                        <div class="row-fluid combo_b-comboSection" style="display: none">



                                            <label class="form-label span4" for="combo_b">Select File Property</label>
                                            <div class="span8 controls comboset">  
                                                <select name="combo_b" id="combo_b" class="combo" data-imageid="gl_image_upload2">
                                                    <?php
                                                    foreach ($values as $combos) {
                                                        ?>
                                                        <option data-pref='<?php echo $combos->preferences; ?>' 
                                                                data-manip='<?php echo $combos->manipulation_status; ?>' 
                                                                value="<?php echo $combos->fid; ?>" <?php
                                                                if (!empty($banner[0]->combo)) {
                                                                    if ($banner[0]->combo == $combos->fid) {
                                                                        echo 'selected';
                                                                    }
                                                                } else if (isset($_POST['combo_b'])) {
                                                                    if ($_POST['combo_b'] == $combos->fid) {
                                                                        echo 'selected';
                                                                    }
                                                                } else if (!empty($default_combo_list['page_default_banner'])) {
                                                                    if ($default_combo_list['page_default_banner'] == $combos->fid) {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>  ><?php echo $combos->combo_name; ?></option>
                                                                <?php
//                                                            }
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
                                            <label class="form-label span4" for="normal">Image</label>

                                            <input  type="file" data-formclass='gl_multiple_upload_form'  data-formtype="edit" data-controller="optionadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="single" data-imageid="gl_image_upload2"  class="gl_image_upload2 gl_uploadimage ngo_proof_attach_input_file span8" name="images_b[]" data-input_name="images_b" data-combo_name="combo_b" id="images_b" >

                                            <div class="upload_note span12">
                                                <span class="span4"></span> <span class="span8">Size:Below&nbsp;<span class="gl_image_upload2-textSize"></span>  MB for each file<span class="dimensions">, width:&nbsp;<span class="gl_image_upload2-textWidth"></span> px, Height:&nbsp;<span class="gl_image_upload2-textHeight"></span> px</span></span>
                                                <span class="manipTxt"><a onclick="manipToggle('gl_image_upload2')">Show Manipulations</a></span>
                                            </div>

                                            <div class="ImageManipulation gl_image_upload2-ImageManipulation">
                                            </div>

                                            <div class="preloader5">
                                                <span class="gl_image_upload2-uploading" style="display:none;text-align: center;"><img src="<?php echo base_url(); ?>static/adminpanel/images/loaders/horizontal/018.gif" alt="" style="display: block;margin: 0 auto;"/></span>
                                            </div>

                                            <span id="gl_image_upload2-output"></span>
                                            <ul class="gl_image_upload2-image1 add_new_image1 sortable" data-img_id="gl_image_upload2" id="sortable"></ul>
                                            <input type="hidden" name="final_images_b" value="<?php echo set_value('final_images_b'); ?>" id="gl_image_upload2-final_images">
                                        </div>
                                    </div>
                                </div> 
                                
<?php
$value_status_array = array('yes','no');
?>
										<div class="title">
                                            <h4> 
                                                <span>Apply Coupon</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="cust_scroll">Enable Coupon</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="apply_coupon" name="apply_coupon" 
                                                        <?php
                                                        if (!empty($option_row->apply_coupon)) {
                                                            if ($option_row->apply_coupon == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="apply_coupon" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>
                                               



                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                

										<div class="title">
                                            <h4> 
                                                <span>Shipping Methods</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="cust_scroll">Enable Shipping</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="shipping_status" name="shipping_status" 
                                                        <?php
                                                        if (!empty($option_row->shipping_status)) {
                                                            if ($option_row->shipping_status == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="shipping_status" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                                
									<div class="title">
                                            <h4> 
                                                <span>Delivery Charge</span>
                                            </h4>
                                        </div>

<?php
$delivery_charge_status_array = array('no','yes','free');
?>
                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="cust_scroll">Delivery Charge Type</label>
                                            <div class="span8 controls">


<?php
foreach($delivery_charge_status_array as $delivery_charge_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="delivery_charge_status" name="delivery_charge_status" 
                                                        <?php
                                                        if (!empty($option_row->delivery_charge_status)) {
                                                            if ($option_row->delivery_charge_status == $delivery_charge_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="shipping_status" value="<?php echo $delivery_charge_status_row; ?>"  /><?php echo ucwords($delivery_charge_status_row); ?></label>
                                                </div>
<?php
}
?>

										</div>
                                        </div>
                                    </div>
                                </div>
                                
 
										<div class="title">
                                            <h4> 
                                                <span>Delivery Charge By Cart Total</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Delivery Charge By Cart Total Status</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                    <div class="left marginT5" style="margin-right:10px;">
                        <label  >
                            <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="delivery_charge_by_cart_total_status" name="delivery_charge_by_cart_total_status" 
                            <?php
                            if (!empty($option_row->delivery_charge_by_cart_total_status)) {
                                if ($option_row->delivery_charge_by_cart_total_status == $value_status_row) {
                                    echo 'checked';
                                }
                            } 
                            ?>  id="delivery_charge_by_cart_total_status" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                    </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                


				   <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="normal">Delivery Charge By Cart Condition</label>
                                            <input class="span8" id="delivery_charge_cart_condition" type="text" name="delivery_charge_cart_condition" value="<?php echo $option_row->delivery_charge_cart_condition; ?>"/>
                                        </div>
                                    </div>
                                </div> 
                                
                                
    <div class="form-row row-fluid">
        <div class="span12">
            <div class="row-fluid">
                <label class="form-label span4" for="normal">Delivery Charge Minimum Cart Amount</label>
<input class="span8 gl_number_digits_only delivery_charge_minimum_cart_amount" id="delivery_charge_minimum_cart_amount" type="text" name="delivery_charge_minimum_cart_amount" value="<?php echo $option_row->delivery_charge_minimum_cart_amount; ?>" <?php
        if (!empty($option_row->delivery_charge_by_cart_total_status)) {
            if ($option_row->delivery_charge_by_cart_total_status == 'yes') {
                echo 'required';
            }
        } 
        ?> />
            </div>
        </div>
    </div>  
    
    
    <div class="form-row row-fluid">
        <div class="span12">
            <div class="row-fluid">
                <label class="form-label span4" for="normal">Delivery Charge Amount</label>
<input class="span8 gl_number_digits_only delivery_charge_amount_by_cart_total" id="delivery_charge_amount_by_cart_total" type="text" name="delivery_charge_amount_by_cart_total" value="<?php echo $option_row->delivery_charge_amount_by_cart_total; ?>" <?php
        if (!empty($option_row->delivery_charge_by_cart_total_status)) {
            if ($option_row->delivery_charge_by_cart_total_status == 'yes') {
                echo 'required';
            }
        } 
        ?> />
            </div>
        </div>
    </div>                                
                                 
                                
                                
                                
                                
<div class="title">
                                            <h4> 
                                                <span>Cancel Order</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Enable Cancel Order</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="cancel_order_status" name="cancel_order_status" 
                                                        <?php
                                                        if (!empty($option_row->cancel_order_status)) {
                                                            if ($option_row->cancel_order_status == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="cancel_order_status" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                                
<div class="title">
                                            <h4> 
                                                <span>Return Order</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Enable Return Order</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="return_order_status" name="return_order_status" 
                                                        <?php
                                                        if (!empty($option_row->return_order_status)) {
                                                            if ($option_row->return_order_status == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="return_order_status" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                

										<div class="title">
                                            <h4> 
                                                <span>Retry Order Payment</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Enable Retry Order Payment</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="retry_order_payment" name="retry_order_payment" 
                                                        <?php
                                                        if (!empty($option_row->retry_order_payment)) {
                                                            if ($option_row->retry_order_payment == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="retry_order_payment" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>                                 
                                
                                 
                                
                                
<div class="title">
                                            <h4> 
                                                <span>Order Print Invoice</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Enable Order Print Invoice</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="order_print_invoice" name="order_print_invoice" 
                                                        <?php
                                                        if (!empty($option_row->order_print_invoice)) {
                                                            if ($option_row->order_print_invoice == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="order_print_invoice" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                
                                
<div class="title">
                                            <h4> 
                                                <span>Order Pickup</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Enable Order Pickup</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="order_pickup_status" name="order_pickup_status" 
                                                        <?php
                                                        if (!empty($option_row->order_pickup_status)) {
                                                            if ($option_row->order_pickup_status == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="order_pickup_status" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                
                                

									<div class="title">
                                            <h4> 
                                                <span>Order Pickup At Shops</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Order Pickup At Shops</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="order_pickup_at_shop_status" name="order_pickup_at_shop_status" 
                                                        <?php
                                                        if (!empty($option_row->order_pickup_at_shop_status)) {
                                                            if ($option_row->order_pickup_at_shop_status == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="order_pickup_at_shop_status" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>                                  
                                
                                
										<div class="title">
                                            <h4> 
                                                <span>Location Based Cart</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Enable Location Based Cart</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="location_cart_status" name="location_cart_status" 
                                                        <?php
                                                        if (!empty($option_row->location_cart_status)) {
                                                            if ($option_row->location_cart_status == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="location_cart_status" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                                
										<div class="title">
                                            <h4> 
                                                <span>Page Scroll By Product</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Enable Page Scroll By Product</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="page_scroll_by_product" name="page_scroll_by_product" 
                                                        <?php
                                                        if (!empty($option_row->page_scroll_by_product)) {
                                                            if ($option_row->page_scroll_by_product == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="page_scroll_by_product" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                
                                
<?php
$checkout_state_type_array = array('text','select');
?>
 										<div class="title">
                                            <h4> 
                                                <span>Checkout State Type</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Checkout State Type</label>
                                            <div class="span8 controls">


<?php
foreach($checkout_state_type_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="checkout_state_type" name="checkout_state_type" 
                                                        <?php
                                                        if (!empty($option_row->checkout_state_type)) {
                                                            if ($option_row->checkout_state_type == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="checkout_state_type" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                               
<?php
$checkout_district_type_array = array('text','select');
?>
 										<div class="title">
                                            <h4> 
                                                <span>Checkout District Type</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Checkout District Type</label>
                                            <div class="span8 controls">


<?php
foreach($checkout_district_type_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="checkout_district_type" name="checkout_district_type" 
                                                        <?php
                                                        if (!empty($option_row->checkout_district_type)) {
                                                            if ($option_row->checkout_district_type == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="checkout_district_type" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                
                                
									 <div class="title">
                                            <h4> 
                                                <span>Order Reference With District</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Enable Order Reference With District</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="order_reference_with_district" name="order_reference_with_district" 
                                                        <?php
                                                        if (!empty($option_row->order_reference_with_district)) {
                                                            if ($option_row->order_reference_with_district == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="order_reference_with_district" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="title">
                                            <h4> 
                                                <span>Print Bill</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Enable Print Bill</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="print_bill" name="print_bill" 
                                                        <?php
                                                        if (!empty($option_row->print_bill)) {
                                                            if ($option_row->print_bill == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="print_bill" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>                                                                                                   

                                <div class="title">
                                            <h4> 
                                                <span>Minimum Cart Amount</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Enable Minimum Cart Amount</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="minimum_cart_status" name="minimum_cart_status" 
                                                        <?php
                                                        if (!empty($option_row->minimum_cart_status)) {
                                                            if ($option_row->minimum_cart_status == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="minimum_cart_status" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                
                                
							   <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="normal">Minimum Cart Special Condition</label>
                                            <input class="span8" id="minimum_cart_special_condition" type="text" name="minimum_cart_special_condition" value="<?php echo $option_row->minimum_cart_special_condition; ?>"/>
                                        </div>
                                    </div>
                                </div> 
                                
                                
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="normal">Minimum Cart Amount</label>
                                            <input class="span8 gl_number_digits_only minimum_cart_amount" id="minimum_cart_amount" type="text" name="minimum_cart_amount" <?php
                                                        if (!empty($option_row->minimum_cart_status)) {
                                                            if ($option_row->minimum_cart_status == 'yes') {
                                                                echo 'required';
                                                            }
                                                        } 
                                                        ?>  value="<?php echo $option_row->minimum_cart_amount; ?>"/>
                                        </div>
                                    </div>
                                </div>  
                                

									   <div class="title">
                                            <h4> 
                                                <span>Cart Qty Update Type</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Cart Qty Update Type</label>
                                            <div class="span8 controls">

<?php
$cart_qty_update_type_array = array('qtybyclick','qtybytyping');
?>
<?php
foreach($cart_qty_update_type_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="cart_qty_update_type" name="cart_qty_update_type" 
                                                        <?php
                                                        if (!empty($option_row->cart_qty_update_type)) {
                                                            if ($option_row->cart_qty_update_type == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="cart_qty_update_type" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                
                                
 
 
									   <div class="title">
                                            <h4> 
                                                <span>Step After My Cart</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Step After My Cart</label>
                                            <div class="span8 controls">

<?php
$after_cart_step_array = array('checkout','orderform');
?>
<?php
foreach($after_cart_step_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="after_cart_action" name="after_cart_action" 
                                                        <?php
                                                        if (!empty($option_row->after_cart_action)) {
                                                            if ($option_row->after_cart_action == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="after_cart_action" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                                

										<div class="title">
                                            <h4> 
                                                <span>Save My Cart Product</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Save My Cart Product Status</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                    <div class="left marginT5" style="margin-right:10px;">
                        <label  >
                            <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="save_mycart_product_status" name="save_mycart_product_status" 
                            <?php
                            if (!empty($option_row->save_mycart_product_status)) {
                                if ($option_row->save_mycart_product_status == $value_status_row) {
                                    echo 'checked';
                                }
                            } 
                            ?>  id="save_mycart_product_status" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                    </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
 
                                
    <div class="form-row row-fluid">
        <div class="span12">
            <div class="row-fluid">
                <label class="form-label span4" for="normal">Delete My Cart Product After</label>
<input class="span6 gl_number_digits_only delete_mycart_product_days" id="delete_mycart_product_days" type="text" name="delete_mycart_product_days" value="<?php echo $option_row->delete_mycart_product_days; ?>" required /> Days
            </div>
        </div>
    </div> 
    
    

										<div class="title">
                                            <h4> 
                                                <span>Save Visitors</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Save Visitors Status</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="save_visitors_status" name="save_visitors_status" 
                                                        <?php
                                                        if (!empty($option_row->save_visitors_status)) {
                                                            if ($option_row->save_visitors_status == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="save_visitors_status" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>     
    


									<div class="title">
                                            <h4> 
                                                <span>Dealer Sub Admin Status</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Enable Dealer Sub Admin</label>
                                            <div class="span8 controls">


<?php
foreach($value_status_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="dealer_subadmin_status" name="dealer_subadmin_status" 
                                                        <?php
                                                        if (!empty($option_row->dealer_subadmin_status)) {
                                                            if ($option_row->dealer_subadmin_status == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="dealer_subadmin_status" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>                                                       


                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" >Submit</button>
                                </div>


                            </form>

                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'project') {
                            ?>


                            <?php /**/ ?>
                            <?php
                            $page_details = json_decode($option_row->page_details, true);
                            ?>

                            <form  id="wizard" class="gl_project gl_form form-horizontal  ui-formwizard    multiple_upload_form_basic" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/project' ?>" method="post" enctype="multipart/form-data" >

                                <div class="title">
                                    <h4>
                                        <span>Project Name Settings</span>
                                    </h4>
                                </div>

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4 tip"
                                                   for="project_name">Project Name</label>
                                            <input class="span8" value="<?php echo $option_row->project_name; ?>" id="project_name" type="text" name="project_name"  />
                                            <span class="error">
                                                <?php echo form_error('project_name'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4 tip"
                                                   for="base_url">Base URL</label>
                                            <input class="span8" value="<?php echo $option_row->base_url; ?>" id="base_url" type="url" name="base_url"  />
                                            <span class="error">
                                                <?php echo form_error('base_url'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">

                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" onclick="return save_option();" >Submit</button>

                                </div>
                            </form>


                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'basic') {
                            ?>


                            <form  id="wizard" class="gl_basic gl_form form-horizontal  ui-formwizard  multiple_upload_form_basic" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/basic' ?>" method="post" enctype="multipart/form-data" >

                                <div class="title">
                                    <h4>
                                        <span>Basic Page Settings</span>
                                    </h4>
                                </div>

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="textarea">Page Title</label>
                                            <textarea class="span8 elastic" id="textarea1" rows="3" required name="title"><?php echo $page_details['title']; ?></textarea>
                                            <span class="error">
                                                <?php echo form_error('title'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="textarea">Meta Description</label>
                                            <textarea class="span8 elastic" id="textarea1" rows="3" required name="description"><?php echo $page_details['description']; ?></textarea>
                                            <span class="error">
                                                <?php echo form_error('description'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="tags">Meta Keywords</label>
                                            <div class="span8 controls">
                                                <input id="tags" required name="keywords" type="text" value="<?php echo $page_details['keywords']; ?>" style="width:100%;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">

                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" onclick="return save_option();" >Submit</button>

                                </div>
                            </form>

                            <?php
                        }
                        ?>

                        <?php
                        if ($this->uri->segment(4) == 'forcefully') {
                            ?>

                <!--<form  id="wizard" class="gl_forcefully gl_form form-horizontal  ui-formwizard  multiple_upload_form_basic" action="<?php // echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/forcefully'                      ?>" method="post" enctype="multipart/form-data" >-->
                            <form  id="wizard" class="gl_forcefully gl_form form-horizontal  ui-formwizard  multiple_upload_form_basic" action="" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4>
                                        <span>Forcefully File Name Settings</span>
                                    </h4>
                                </div>
                                <input type="hidden" name="option_id" class="option_id" value="<?php echo $option_row->id; ?>">
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4 tip"
                                                   for="forcefully_filename">Forcefully File Name</label>
                                            <input class="span8 slug_ref forcefully_filename slug_url_val" value="<?php echo $option_row->forcefully_filename; ?>" id="forcefully_filename" type="text" name="forcefully_filename"  />
                                            <span class="error">
                                                <?php echo form_error('forcefully_filename'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">

                                    <button type="button" class="btn btn-info showhide-btn pull-right gl_force_submit gl_submit" >Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'mail') {
                            ?>



                            <form  id="wizard" class="gl_mail gl_form form-horizontal  ui-formwizard  multiple_upload_form_basic" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/mail' ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Mail Settings</span>
                                    </h4>
                                </div>

                                <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin(); ?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4 tip" 
                                                   for="contact_email">To Email (Order)</label>
                                            <input class="span8" value="<?php echo $option_row->contact_email; ?>" id="contact_email" type="text" name="contact_email"  />
                                            <span class="error">
                                                <?php echo form_error('contact_email'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin(); ?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4 tip" 
                                                   for="contact_from_email">From Email (Order)</label>
                                            <input class="span8" value="<?php echo $option_row->contact_from_email; ?>" id="contact_from_email" type="text" name="contact_from_email"  />
                                            <span class="error">
                                                <?php echo form_error('contact_from_email'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <?php
                                if (!empty($option_row->mail_formtype)) {
                                    $mail_array = json_decode($option_row->mail_formtype, true);
                                } else {
                                    $mail_array = array('1');
                                }
                                ?>



                                <div id="main_key4">


                                    <?php
                                    $i = 1;
                                    foreach ($mail_array as $mail_row) {
                                        ?>

                                        <div class="form-row row-fluid data_value_key4" data-count="<?php echo $i ?>" style="border-bottom: 1px solid #a8a8a8;padding-bottom: 2%;">
                                            <div class="span12">

                                                <div class="row-fluid">

                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span3" for="">Form Type</label>
                                                            <input  class="span8 gl_form_type gl_form_name2" placeholder="Form Type" id="form_type" type="text" name="form_type"   value="<?php
                                                            if (isset($mail_row['form_type'])) {
                                                                echo $mail_row['form_type'];
                                                            }
                                                            ?>" readonly="readonly" >
                                                        </div>
                                                    </div> 

                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span3" for="">From Mail</label>  
                                                            <input class="span8 gl_from_mail" placeholder="From Mail" id="from_mail" type="text" name="from_mail"   value="<?php
                                                            if (isset($mail_row['from_mail'])) {
                                                                echo $mail_row['from_mail'];
                                                            }
                                                            ?>" readonly="readonly" >
                                                        </div>
                                                    </div>  

                                                    <div class="span12">
                                                        <div class="row-fluid"> 
                                                            <label class="form-label span3" for="">To Mail</label>   
                                                            <input class="span8 gl_to_mail" placeholder="To Mail" id="to_mail" type="text" name="to_mail"   value="<?php
                                                            if (isset($mail_row['to_mail'])) {
                                                                echo $mail_row['to_mail'];
                                                            }
                                                            ?>" readonly="readonly" >
                                                            <span style="color:#AB5053; float:left; margin-bottom:10px; font-size:12px;" class="<?php echo $this->common_model->admin_or_super_admin(); ?>">User Comma(,) for multiple emails</span>
                                                        </div>
                                                    </div>

                                                    <div class="span12">
                                                        <div class="row-fluid"> 
                                                            <label class="form-label span3" for="">CC Mail</label>   
                                                            <input class="span8 gl_cc_mail" placeholder="CC Mail" id="cc_mail" type="text" name="cc_mail"   value="<?php
                                                            if (isset($mail_row['cc_mail'])) {
                                                                echo $mail_row['cc_mail'];
                                                            }
                                                            ?>" readonly="readonly" >
                                                            <span style="color:#AB5053; float:left; margin-bottom:10px; font-size:12px;" class="<?php echo $this->common_model->admin_or_super_admin(); ?>">User Comma(,) for multiple emails</span>
                                                        </div>
                                                    </div>

                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span3" for="">Mail Message</label>  
                                                            <input class="span8 gl_mail_msg" placeholder="Mail Message" id="mail_msg" type="text" name="mail_msg" value="<?php
                                                            if (isset($mail_row['mail_msg'])) {
                                                                echo $mail_row['mail_msg'];
                                                            }
                                                            ?>">
                                                        </div>
                                                    </div> 


                                                    <a href="javascript:void(0)" style= "margin-right:60px;" id="<?php echo $i ?>" class="remove_source4 right hide">Remove</a>
                                                </div>
                                            </div> 
                                        </div>



                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </div>  

                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-mini <?php echo $this->common_model->admin_or_super_admin();?>" id="add_key4" style="float: right; ">Add More</a>
                                            </div>
                                        </div> 
                                    </div>                                      
                                </div>





                                <div class="form-actions">

                                    <input type="hidden" value="" id="gl_mail_json"  name="mail_json">

                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit  gl_mail_submit" onclick="return save_option();" >Submit</button>
                                </div>
                            </form>


                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'product') {
                            ?>


                            <!--Product options Section-->
                            <form  id="wizard" class="gl_product gl_form form-horizontal  ui-formwizard gl_multiple_upload_form_product  multiple_upload_form_product" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/product' ?>" method="post" enctype="multipart/form-data" >

                                <div class="row-fluid">
                                    <div class="marginT10 span12">
                                        <div class="title">
                                            <h4> 
                                                <span>Product options</span>
                                            </h4>
                                        </div>


                                        <!--Banner content Section-->
                                        <?php
                                        $pro_banner_content = json_decode($option_row->default_product_banner_content, TRUE);
                                        ?>


                                        <div class="form-row row-fluid hide">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="banner_title">Default Slide Title</label>
                                                    <div class="span9" style="position:relative;">
                                                        <input type="text" id="banner_title" name="banner_title" value="<?php echo $pro_banner_content[0]['banner_title'] ?>" />
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
                                                    <label class="form-label span3" for="banner_description">Product Right Content</label>
                                                </div>

                                                <div class="form-row row-fluid">
                                                    <textarea class="span8 elastic ckeditor" id="banner_description" name="banner_description"><?php echo $pro_banner_content[0]['banner_description'] ?></textarea>
                                                    <span class="error">
                                                        <?php echo form_error('banner_description'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="row_border" value="<?php echo set_value('row_border') ?>" id="row_border">  





                                        <!--END OF Banner content Section--> 

                                        <!--Product Banner Image Section-->
                                        <?php
                                        if (!empty($option_row->default_product_banner_img)) {
                                            $pro_banner = json_decode($option_row->default_product_banner_img);

                                            if ($pro_banner[0]->image != '') {
                                                ?>

                                                <div class="form-row row-fluid">
                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span4" for="normal">Current Default Banner</label>
                                                            <img  class="span4"  src="<?php echo base_url() . 'media_library/' . $pro_banner[0]->image; ?>" />  
                                                            <input type="hidden" name="mediaID" value="<?php echo $pro_banner[0]->media_id; ?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                            }
                                        }
                                        ?>     
                                        <div class="form-row row-fluid ">
                                            <div class="span12">
                                                <div class="row-fluid combo_c-currentCombo">
                                                    <label class="form-label span4" for="normal">File Property</label>
                                                    <?php
                                                    foreach ($values as $combos) {
                                                        if (!empty($pro_banner[0]->combo)) {
                                                            if ($pro_banner[0]->combo == $combos->fid) {
                                                                ?>
                                                                <input class="span8" readonly value="<?php echo $combos->combo_name; ?>"  />
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                                <span class="manipTxt combo_c-findAllcombo"><a onclick="allComboshow('combo_c')">Show / Change All File Properties</a></span>
                                                <div class="row-fluid combo_c-comboSection" style="display: none">

                                                    <label class="form-label span4" for="combo_c" >Select File Property</label>
                                                    <div class="span8 controls comboset">  
                                                        <select name="combo_c" id="combo_c" class="combo" data-imageid="gl_image_upload3">
                                                            <?php
                                                            foreach ($values as $combos) {
                                                                if ($combos->manipulation_status == 'Yes') { // (IMG_MANIPULATION_COMBO) when need all combos remove this condition
                                                                    ?>
                                                                    <option data-pref='<?php echo $combos->preferences; ?>' 
                                                                            data-manip='<?php echo $combos->manipulation_status; ?>' 
                                                                            value="<?php echo $combos->fid; ?>" <?php
                                                                            if (!empty($pro_banner[0]->combo)) {
                                                                                if ($pro_banner[0]->combo == $combos->fid) {
                                                                                    echo 'selected';
                                                                                }
                                                                            } elseif (isset($_POST['combo_c'])) {
                                                                                if ($_POST['combo_c'] == $combos->fid) {
                                                                                    echo 'selected';
                                                                                }
                                                                            } elseif (!empty($default_combo_list['product_default_banner'])) {
                                                                                if ($default_combo_list['product_default_banner'] == $combos->fid) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                            ?>  ><?php echo $combos->combo_name; ?></option>
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




                                        <div class="form-row row-fluid ">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="images_c">Product Default Banner</label>


                                                    <input  type="file" data-formclass='gl_multiple_upload_form_product' data-formtype="edit" data-controller="optionadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="single" data-imageid="gl_image_upload3"  class="gl_image_upload3 
                                                            gl_uploadimage ngo_proof_attach_input_file  span8" name="images_c[]" data-input_name="images_c" data-combo_name="combo_c" id="images_c">    

                                                    <input type="hidden" class="file_input_name" name="file_input_name" value="">
                                                    <input type="hidden" class="combo_name" name="combo_name" value="">

                                                    <div class="upload_note span12">
                                                        <span class="span4"></span> <span class="span8">Size:Below&nbsp;<span class="gl_image_upload3-textSize"></span>  MB for each file<span class="dimensions">, width:&nbsp;<span class="gl_image_upload3-textWidth"></span> px, Height:&nbsp;<span class="gl_image_upload3-textHeight"></span> px</span></span>
                                                        <span class="manipTxt_c"><a onclick="manipToggle('gl_image_upload3')">Show Manipulations</a></span>
                                                    </div>
                                                    <div class="ImageManipulation gl_image_upload3-ImageManipulation">
                                                    </div>
                                                    <div class="preloader5">
                                                        <span class="gl_image_upload3-uploading" style="display:none;text-align: center;"><img src="<?php echo base_url(); ?>static/adminpanel/images/loaders/horizontal/018.gif" alt="" style="display: block;margin: 0 auto;"/></span>
                                                    </div>
                                                    <span id="gl_image_upload3-output"></span>

                                                    <ul class="gl_image_upload3-image1 add_new_image1_c sortable" id="sortable_c" data-img_id="gl_image_upload3"></ul>
                                                    <input type="hidden" name="final_images_c" value="<?php echo set_value('final_images_c'); ?>" id="gl_image_upload3-final_images">
                                                </div>
                                            </div>
                                        </div>   


                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4"
                                                           for="delivery_text">Delivery Text</label>
                                                    <input class="span8" value="<?php echo $option_row->delivery_text; ?>" id="delivery_text" type="text" name="delivery_text" />
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
                                                    <input class="span8" value="<?php echo $option_row->expected_day_count; ?>" id="expected_day_count" min="1" type="number" name="expected_day_count"  />
                                                    <span class="error">
                                                        <?php echo form_error('expected_day_count'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div> 



                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4 tip" 
                                                           for="expected_day_count"
                                                           title="">Offer after live</label>
                                                    <input class="span8" value="<?php echo $option_row->offer_after_live; ?>" id="offer_after_live" min="1" type="number" name="offer_after_live"  />
                                                    <span class="error">
                                                        <?php echo form_error('offer_after_live'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4 tip" 
                                                           for="offer_after_out_of_stock"
                                                           title="">Offer after out of stock</label>
                                                    <input class="span8" value="<?php echo $option_row->offer_after_out_of_stock; ?>" id="offer_after_out_of_stock" min="1" type="number" name="offer_after_out_of_stock"  />
                                                    <span class="error">
                                                        <?php echo form_error('offer_after_out_of_stock'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="title marginT10">
                                            <h4> 
                                                <span>Product Zero Quantity Action</span>
                                            </h4>
                                        </div> 


                                        <?php
                                        $qty_zero_status = array('inactive' => 'Inactive', 'sold_out' => 'Sold Out', 'enquiry' => 'Enquiry');
                                        ?>

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="inventory">Product Zero Quantity Action</label>
                                                    <div class="span8 controls">


                                                        <?php
                                                        if (!empty($qty_zero_status)) {
                                                            $qty_i = 0;
                                                            foreach ($qty_zero_status as $qty_key => $qty_status) {
                                                                ?>
                                                                <div class="left marginT5 ">
                                                                    <input type="radio"  name="qty_zero_action"  value="<?php echo $qty_key; ?>" <?php
                                                                    if (!empty($option_row->qty_zero_action)) {
                                                                        if ($option_row->qty_zero_action == $qty_key) {
                                                                            echo 'checked';
                                                                        }
                                                                    } else if ($qty_i == '0') {
                                                                        echo 'checked';
                                                                    }
                                                                    ?> />
                                                                           <?php echo $qty_status; ?>
                                                                </div>   

                                                                <?php
                                                                $qty_i++;
                                                            }
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="title marginT10">
                                            <h4> 
                                                <span>Product Page Quick Link</span>
                                            </h4>
                                        </div>


                                        <div class="gl_page_quick_link_wrapper">
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span5">Quick Link</label>   
                                                        <label class="form-label span5">Quick Link Title</label>   

                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="gl_quick_link_wrapper">


                                            <?php
                                            $quick_link_set = json_decode($option_row->quick_link, true);

                                            if (!empty($quick_link_set)) {
                                                $quik_key = 1;
                                                foreach ($quick_link_set as $quick_link) {
                                                    $quick_data["quick_link_set"] = $quick_link;
                                                    $quick_data["quik_key"] = $quik_key;
                                                    $this->load->view("include/quick_link_set", $quick_data);
                                                    $quik_key++;
                                                }
                                            } else {
                                                $this->load->view("include/quick_link_set");
                                            }
                                            ?>

                                        </div>


                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <a href="javascript:void(0)" 
                                                           class="btn btn-primary btn-mini gl_quick_add_more" 
                                                           style="float: right;">Add More</a>
                                                    </div>
                                                </div> 
                                            </div>                                      
                                        </div>
                                        
                                        
<!---->

										<div class="title marginT10">
                                            <h4> 
                                                <span>Shipping Box Set</span>
                                            </h4>
                                        </div>


                                        <div class="gl_page_shipping_box_wrapper">
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3">Shipping Box Name</label>   
                                                        <label class="form-label span3">Shipping Box Length</label>  
                                                        <label class="form-label span3">Shipping Box Breadth</label>   
                                                        <label class="form-label span3">Shipping Box Height</label>   

                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="gl_shipping_box_wrapper">


                                            <?php
                                            $shipping_box_set = json_decode($option_row->shipping_box_set, true);

                                            if (!empty($shipping_box_set)) {
                                                $shipping_box_key = 1;
                                                foreach ($shipping_box_set as $shipping_box) {
                                                    $shipping_box_data["shipping_box_set"] = $shipping_box;
                                                    $shipping_box_data["shipping_box_key"] = $shipping_box_key;
                                                    $this->load->view("include/shipping_box_set", $shipping_box_data);
                                                    $shipping_box_key++;
                                                }
                                            } else {
                                                $this->load->view("include/shipping_box_set");
                                            }
                                            ?>

                                        </div>


                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <a href="javascript:void(0)" 
                                                           class="btn btn-primary btn-mini gl_shipping_box_add_more" 
                                                           style="float: right;">Add More</a>
                                                    </div>
                                                </div> 
                                            </div>                                      
                                        </div>
                                        
                                             								

<!---->
                                        



                                        <!--END OF Product Banner Image Section-->

                                    </div>
                                </div>
                                <!--EOF Product options Section-->
                                <input type="hidden" class="gl_quick_link_set" name="quick_link">
                                <input type="hidden" class="gl_shipping_box_set" name="shipping_box_set">

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_quick_link_creation gl_submit" >Submit</button>

                                </div>
                            </form>

                            <?php
                        }
                        ?> 

                        <?php
                        if ($this->uri->segment(4) == 'route') {
                            ?>


                            <?php
                            $route_value_arr = json_decode($option_row->route_value, TRUE);
                            ?>   

                            <form  id="wizard" class="gl_route gl_form form-horizontal  ui-formwizard  multiple_upload_form_route" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/route' ?>" method="post" enctype="multipart/form-data" >
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
                                                        <input type="text" class="value_child seo_slug_check" value="<?php echo $route_value_arr[0]['route_value'] ?>" id="menu_route" name="menu_route"  />
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
                                                        <input type="text" class="value_child seo_slug_check" value="<?php echo $route_value_arr[1]['route_value'] ?>" id="page_route" name="page_route" />
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
                                                        <input type="text" class="value_child seo_slug_check" value="<?php echo $route_value_arr[2]['route_value'] ?>" id="content_item_route" name="content_item_route" />
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
                                                        <input type="text" class="value_child seo_slug_check" value="<?php echo $route_value_arr[3]['route_value'] ?>" id="content_category_route" name="content_category_route" />
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
                                                        <input type="text" class="value_child seo_slug_check" value="<?php echo $route_value_arr[4]['route_value'] ?>" id="product_item_route" name="product_item_route" />
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
                                                        <input type="text" class="value_child seo_slug_check" value="<?php echo $route_value_arr[5]['route_value'] ?>" id="product_category_route" name="product_category_route" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <input type="hidden" name="route_form_value" id="route_form_value">    


                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" onclick="routeformdata();" >Submit</button>

                                </div>
                            </form>

                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'prefix') {
                            ?>                        

                            <form  id="wizard" class="gl_prefix gl_form form-horizontal  ui-formwizard  multiple_upload_form_prefix" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/prefix' ?>" method="post" enctype="multipart/form-data" >

                                <div class="row-fluid route_wrapper">
                                    <div class="marginT10 span12">
                                        <div class="title">
                                            <h4> 
                                                <span>Prefix String</span>
                                            </h4>
                                        </div> 
                                        <div class="form-row row-fluid route_child">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="tmp_order_string">Temporary Order Prefix</label>
                                                    <div class="span9">
                                                        <input type="text" class="" value="<?php echo $option_row->tmp_order_string; ?>" id="tmp_order_string" name="tmp_order_string"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid route_child">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="org_order_string">Original Order Prefix</label>
                                                    <div class="span9">
                                                        <input type="text" class="" value="<?php echo $option_row->org_order_string; ?>" id="org_order_string" name="org_order_string" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row row-fluid route_child">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="sku_prefix">SKU Prefix</label>
                                                    <div class="span9">
                                                        <input type="text" class="" value="<?php echo $option_row->sku_prefix; ?>" id="sku_prefix" name="sku_prefix" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>





                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="checkboxes">SKU prefix Status</label>

                                                    <div class="left marginT5 marginR10">
                                                        <input type="radio" id="on" value="on"  <?php
                                                        if ($option_row->sku_prefix_off === 'on') {
                                                            echo 'checked';
                                                        }
                                                        ?> name="prefix_status" class="styled" /> On
                                                    </div>
                                                    <div class="left marginT5 marginR10">
                                                        <input type="radio" id="off" value="off" <?php
                                                        if ($option_row->sku_prefix_off === 'off') {
                                                            echo 'checked';
                                                        }
                                                        ?>  name="prefix_status" class="styled" /> Off
                                                    </div> 

                                                </div>
                                            </div> 
                                        </div>
                                        
                                        
<?php
$order_type_array = array('ordertext','orderyeartype1');
?>
 										<div class="title">
                                            <h4> 
                                                <span>Order Number Type</span>
                                            </h4>
                                        </div>


                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Order Number Type</label>
                                            <div class="span8 controls">


<?php
foreach($order_type_array as $value_status_row)
{
?>
                                                <div class="left marginT5" style="margin-right:10px;">
                                                    <label  >
                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="order_number_type" name="order_number_type" 
                                                        <?php
                                                        if (!empty($option_row->order_number_type)) {
                                                            if ($option_row->order_number_type == $value_status_row) {
                                                                echo 'checked';
                                                            }
                                                        } 
                                                        ?>  id="order_number_type" value="<?php echo $value_status_row; ?>"  /><?php echo ucwords($value_status_row); ?></label>
                                                </div>
<?php
}
?>


                                            </div>
                                        </div>
                                    </div>
                                </div>                                        



                                    </div>
                                </div> 
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" >Submit</button>

                                </div>
                            </form> 

                            <?php
                        }
                        ?>                            



                        <?php
                        if ($this->uri->segment(4) == 'hidden') {
                            ?>

                            <form  id="wizard" class="gl_hidden gl_form form-horizontal  ui-formwizard  multiple_upload_form_hidden" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/hidden' ?>" method="post" enctype="multipart/form-data" >

                                <div class="row-fluid route_wrapper">
                                    <div class="marginT10 span12">
                                        <div class="title">
                                            <h4> 
                                                <span>Hidden Input Options</span>
                                            </h4>
                                        </div> 
                                        <div id="main_key">
                                            <?php
                                            if ($option_row->hidden_inputs == "") {
                                                ?>
                                                <div class="form-row row-fluid data_value_key" id="1">
                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span2 key_feature_label" for="content_title_val">Hidden input</label>
                                                            <input class="span5" placeholder="id" id="hiddeninput_id" type="text" name="hiddeninput_id"  value="<?php echo set_value('hiddeninput_id'); ?>"  />
                                                            <input class="span5" placeholder="name" id="hiddeninput_name" type="text" name="hiddeninput_name"  value="<?php echo set_value('hiddeninput_name'); ?>"  />
                                                            <input class="span5" placeholder="class" id="hiddeninput_class" type="text" name="hiddeninput_class"  value="<?php echo set_value('hiddeninput_class'); ?>"  />
                                                            <input class="span5" placeholder="value" id="hiddeninput_value" type="text" name="hiddeninput_value"  value="<?php echo set_value('hiddeninput_value'); ?>"  />


                                                            <a href="javascript:void(0)" style= "margin-right:60px;" id="1" class="remove_source right">Remove</a>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <?php
                                            } else {
                                                $value_list_entered = json_decode($option_row->hidden_inputs, true);
//                                                dump($value_list_entered);
                                                $i = 1;
                                                foreach ($value_list_entered as $row) {
                                                    ?>
                                                    <div class="form-row row-fluid data_value_key" id="<?php echo $i ?>">
                                                        <div class="span12">
                                                            <div class="row-fluid">
                                                                <label class="form-label span2 key_feature_label" for="content_title_val<?php echo $i ?>"><?php
                                                                    if ($i == 1) {
                                                                        echo "Hidden Input";
                                                                    }
                                                                    ?></label>
                                                                <input class="span5" placeholder="id" id="hiddeninput_id<?php echo $i ?>" type="text" name="hiddeninput_id<?php echo $i ?>"  value="<?php echo $row['hiddeninput_id']; ?>"  />
                                                                <input class="span5" placeholder="name" id="hiddeninput_name<?php echo $i ?>" type="text" name="hiddeninput_name<?php echo $i ?>"  value="<?php echo $row['hiddeninput_name']; ?>"  />
                                                                <input class="span5" placeholder="class" id="hiddeninput_class<?php echo $i ?>" type="text" name="hiddeninput_class<?php echo $i ?>"  value="<?php echo $row['hiddeninput_class']; ?>"  />
                                                                <input class="span5" placeholder="value" id="hiddeninput_value<?php echo $i ?>" type="text" name="hiddeninput_value<?php echo $i ?>"  value="<?php echo $row['hiddeninput_value']; ?>"  />
                                                                <a href="javascript:void(0)" style= "margin-right:60px; <?php if ($i <= 3) { ?> display: none; <?php } ?>" id="<?php echo $i ?>" class="remove_source right">Remove</a>

                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                            <span class="error"></span>
                                        </div> 
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key" style="float: right;">Add More</a>
                                                    </div>
                                                </div> 

                                            </div>                                      
                                        </div>         

                                    </div>
                                </div> 



                                <div class="form-actions">
                                    <input type="hidden" class="hiddeninputjson" name="hiddeninputjson" id="hiddeninputjson" value="" />
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" onclick="saveOrder_key_features();" >Submit</button>

                                </div>
                            </form>  


                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'cache') {
                            ?>

                            <form  id="wizard" class="gl_cache gl_form form-horizontal  ui-formwizard  multiple_upload_form_cache" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/cache' ?>" method="post" enctype="multipart/form-data" >

                                <div class="title">
                                    <h4> 
                                        <span>Cache Settings</span>
                                    </h4>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="cache_date_modified">Last Modified</label>
                                            <div class="span9">
                                                <input type="text" readonly class="span5 cache_date_modified_text" value="<?php echo date("l jS \of F Y H:i:s A", strtotime($option_row->cache_date_modified)); ?>" id="cache_date_modified" name="cache_date_modified" />
                                                <div class="span7 pull-right">
                                                    <span class="startcalculation" style="color:#1B700A;display:none;"><img src="<?php echo base_url() . 'static/adminpanel/'; ?>images/loaders/circular/025.gif" style="margin-left:5%;"> <span class="calculationtext">Updating....</span></span>
                                                    <a href="javascript:void(0)" class="btn btn-info gl_update_cache pull-right">Update Cache Assets</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <!--                            <div class="form-actions">
                                                                <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" >Submit</button>
                                                            </div>-->
                            </form>

                            <?php
                        }
                        ?>                        


                        <?php
                        if ($this->uri->segment(4) == 'time_zone') {
                            ?>


                            <form  id="wizard" class="gl_time_zone gl_form form-horizontal  ui-formwizard  multiple_upload_form_cache" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/time_zone' ?>" method="post" enctype="multipart/form-data" >

                                <div class="title">
                                    <h4> 
                                        <span>Time Zone Settings</span>
                                    </h4>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <!--<div class="row-fluid">-->

                                            <label class="form-label span4" for="time_zone">Select Time Zone</label>
                                            <div class="span8 controls">  
                                                <select name="time_zone" id="time_zone" class="time_zone">
                                                    <option value="0">Please, select timezone</option>
                                                    <?php
                                                    if (!empty($time_zone_arr)) {
                                                        foreach ($time_zone_arr as $time_zone) {
                                                            ?>
                                                            <option <?php
                                                            if ($option_row->time_zone == $time_zone['zone']) {
                                                                echo 'selected';
                                                            }
                                                            ?> value="<?php print $time_zone['zone'] ?>"> <?php print $time_zone['diff_from_GMT'] . ' - ' . $time_zone['zone'] ?> </option>

                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                            <span class="error">
                                                <?php echo form_error('time_zone'); ?>
                                            </span>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" >Submit</button>

                                </div>

                            </form>

                            <?php
                        }
                        ?>

                        <?php
                        if ($this->uri->segment(4) == 'controller_class') {
                            ?>

                            <form  id="wizard" class="gl_controller_class gl_form form-horizontal  ui-formwizard  multiple_upload_form_hidden" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/controller_class' ?>" method="post" enctype="multipart/form-data" >

                                <div class="row-fluid route_wrapper">
                                    <div class="marginT10 span12">
                                        <div class="title">
                                            <h4> 
                                                <span>Controller Class Settings</span>
                                            </h4>
                                        </div> 
                                        <div id="main_key1">
                                            <?php
                                            if ($option_row->controller_class == "") {
                                                ?>
                                                <div class="form-row row-fluid data_value_key1" data-count="1">
                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span2 key_feature_label1" for="content1_title_val">Controller Class</label>
                                                            <input class="span5" placeholder="controller class name" id="controller_class_name" type="text" name="controller_class_name"  value="<?php echo set_value('controller_class_name'); ?>"  />

                                                            <a href="javascript:void(0)" style= "margin-right:60px;" class="remove_source1 right">Remove</a>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <?php
                                            } else {
                                                $value_list_entered1 = json_decode($option_row->controller_class, true);
//                                                dump($value_list_entered1);
                                                $i = 1;
                                                foreach ($value_list_entered1 as $row) {
                                                    ?>
                                                    <div class="form-row row-fluid data_value_key1" data-count="<?php echo $i ?>" >
                                                        <div class="span12">
                                                            <div class="row-fluid">
                                                                <label class="form-label span2 key_feature_label1" for="content1_title_val<?php echo $i ?>"><?php
                                                                    if ($i == 1) {
                                                                        echo "Controller Class";
                                                                    }
                                                                    ?></label>
                                                                <input class="span5" placeholder="controller class name" id="controller_class_name<?php echo $i ?>" type="text" name="controller_class_name<?php echo $i ?>"  value="<?php echo $row['controller_class_name']; ?>"  />

                                                                <a href="javascript:void(0)" style= "margin-right:60px;" id="<?php echo $i ?>" class="remove_source1 right">Remove</a>

                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                            <span class="error"></span>
                                        </div> 
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key1" style="float: right;">Add More</a>
                                                    </div>
                                                </div> 

                                            </div>                                      
                                        </div>         

                                    </div>
                                </div> 



                                <div class="form-actions">
                                    <input type="hidden" class="controller_class_name_json" name="controller_class_name_json" id="controller_class_name_json" value="" />
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" onclick="saveOrder_key_features1();" >Submit</button>

                                </div>
                            </form>

                            <?php
                        }
                        ?> 

                        <?php
                        if ($this->uri->segment(4) == 'error_report') {
                            ?>

                            <form  id="wizard" class="gl_error_report gl_form form-horizontal  ui-formwizard  multiple_upload_form_cache" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/error_report'; ?>" method="post" enctype="multipart/form-data" >

                                <div class="title">
                                    <h4> 
                                        <span>Error Report Settings</span>
                                    </h4>
                                </div>

                                <?php
                                $error_report_class_tree = $option_row->error_report_class_tree;
                                $error_report_class_arr = explode('+', $error_report_class_tree);
                                array_pop($error_report_class_arr);
                                array_shift($error_report_class_arr);

                                $decode_controller_class = json_decode($option_row->controller_class, true);
                                ?>

                                <!-- <div class="gl_err_class_wrp">
                                     <input type="checkbox" class="gl_check_all"> Check All
                                     <input type="checkbox" name="gl_checkbox" class="gl_checkbox" value="a"> Check
                                     <input type="checkbox" name="gl_checkbox" class="gl_checkbox" value="a"> Check
                                                     </div> -->
                                <div class="form-row row-fluid ">
                                    <div class="span12" >

                                        <div class="row-fluid">
                                            <label class="form-label span2">Controller Classes</label>
                                            <ul class="gl_indicator">
                                                <li style="border: 5px solid #E5E5E5; border-radius: 8px;">Show Error</li>
                                                <li style="border: 5px solid #266c8e; border-radius: 8px;">Hide Error</li>
                                            </ul>
                                            <!--<div class="span8 controls gl-columns ">--> 
                                        </div>



                                        <div class="row-fluid">
                                            <div class="span12 controls gl-columns"> 
                                                <label class="span6 checkbox-inline " style="width: 125px !important;min-width: 125px !important;">
                                                    <div class="gl_checkbox_style">
                                                        <input type="checkbox" class="gl_check_all "> 
                                                    </div>Check All
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row-fluid">
                                            <div class="span12 controls gl-columns "> 


                                                <input type="hidden" name="error_report_class_json" value="" class="error_report_class_json">



                                                <?php
                                                /**/
                                                if (!empty($decode_controller_class)) {
                                                    foreach ($decode_controller_class as $key => $controller_class) {
                                                        ?>
                                                        <label class=" span6 checkbox-inline" for="gl_Checkboxes_<?php echo $key; ?>">
                                                            <div class="gl_checkbox_style">
                                                                <input <?php
                                                                if (in_array($controller_class['controller_class_name'], $error_report_class_arr)) {
                                                                    echo "checked";
                                                                }
                                                                ?> type="checkbox" name="error_report_class_tree[]" id="gl_Checkboxes_<?php echo $key; ?>" value="<?php echo $controller_class['controller_class_name'] ?>" class="check_box gl_checkbox ">
                                                            </div>
                                                            <?php echo $controller_class['controller_class_name']; ?>
                                                        </label>
                                                        <?php
                                                    }
                                                } /**/
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="error"><?php echo form_error('error_report_class_tree'); ?></span>

                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit" onclick="save_class_tree()">Submit</button>

                                </div>

                            </form>

                            <?php
                        }
                        ?>



                        <input type="hidden" class="lib_array_length" value="<?php echo count($library_group); ?>">
                        <input type="hidden" class="type_array_length" value="<?php echo count($filetype); ?>">

                        <?php
                        if ($this->uri->segment(4) == 'header_asset') {
                            ?>




                            <form  id="wizard" class="gl_header_asset gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/asset'; ?>" method="post" enctype="multipart/form-data" >


                                <input type="hidden" name="option_asset" value="header">
                                <div class="title">
                                    <h4> 
                                        <span>Asset Settings (Header) </span>
                                    </h4>
                                </div><br>




                                <div id="main_key2">

                                    <?php
                                    if (!empty($header_options_meta)) {
                                        $i = 0;
                                        foreach ($header_options_meta as $meta_key => $option) {

                                            $i++;
                                            ?>
                                                                                                                                                                                                <!--id="<?php // echo $i;                     ?>"-->
                                            <div class="data_value_key2 gl_count_<?php echo $i; ?>" data-count2="<?php echo $i; ?>"   style="border: 1.4px solid #ccc;padding: 2px 2px 44px 5px; width: 78%;margin-left: 100px;margin-bottom: 20px;">
                                                <input type="hidden" name="metaid" value="<?php echo $option->id; ?>">


                                                <div class="form-row row-fluid gl_radio_library">
                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span4" for="cust_scroll">Library Group</label>
                                                            <div class="span8 controls">


                                                                <?php
                                                                $k = 0;
                                                                foreach ($library_group as $lgkey => $library) {
                                                                    ?> 

                                                                    <div class="left marginT5" style="margin-right:10px;">

                                                                        <label class="assetradio  <?php
                                                                        if ($option->library == $lgkey) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>" for="library_group<?php echo $k . $i; ?>">
                                                                            <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="library_group "
                                                                                   name="library_group_<?php echo $i; ?>" 
                                                                                   id="library_group<?php echo $k . $i; ?>" value="<?php echo $lgkey; ?>" 

                                                                                   <?php
                                                                                   if ($option->library == $lgkey) {
                                                                                       echo "checked";
                                                                                   }
                                                                                   ?>

                                                                                   />
                                                                            <?php echo $library; ?></label>
                                                                    </div>

                                                                    <?php
                                                                    $k++;
                                                                }
                                                                ?>



                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="form-row row-fluid gl_radio_type" id="nonscript_<?php echo $i; ?>" style="display:block;" >
                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span4" for="cust_scroll">Choose type</label>
                                                            <div class="span8 controls">



                                                                <?php
                                                                $k = 0;
                                                                foreach ($filetype as $type) {
                                                                    ?>

                                                                    <div class="left marginT5 " id="<?php echo $type . '_' . $i; ?>" style=" <?php
                                                                    if ($option->library == "script" || $option->library == "meta" || $option->library == "metacharset") {
                                                                        if ($type != 'manual') {
                                                                            ?>  display:none;
                                                                                 <?php
                                                                             }
                                                                         }
                                                                         ?>  margin-right:10px;">

                                                                        <label class="assetradio  <?php
                                                                        if ($option->type == $type) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>" for="type<?php echo $k . $i; ?>">  

                                                                            <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="type" name="type_<?php echo $i; ?>" id="type<?php echo $k . $i; ?>"  value="<?php echo $type; ?>" 
                                                                            <?php
                                                                            if ($option->type == $type) {
                                                                                echo "checked";
                                                                            }
                                                                            ?> /> <?php echo ucfirst($type); ?> </label>

                                                                    </div>

                                                                    <?php
                                                                    $k++;
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-row row-fluid" id="int_file_<?php echo $i; ?>"  >

                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span4" for="normal">Add File</label>

                                                            <span class="base_show" <?php if ($option->type != "internal") { ?> style="display:none;"   <?php } ?> > <?php echo base_url(); ?> </span>  <textarea required  rows="1"  class="span4"  name="int_link_<?php echo $i; ?>" ><?php
                                                                if (isset($option->filepath)) {
                                                                    echo $option->filepath;
                                                                }
                                                                ?></textarea>
                                                            <span class="error">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>  


                                                <?php
                                                if ($option->active_status == 'a') {

                                                    $active_class = 'hide';
                                                    $deactive_class = '';
                                                } else {
                                                    $active_class = '';
                                                    $deactive_class = 'hide';
                                                }
                                                if (!empty($option->id)) {
                                                    ?>
                                                    <a href="javascript:void(0)" style="margin-right: 28px;" data-status="d" data-option="<?php echo $option->id; ?>" class="gl_assetd_<?php echo $option->id; ?> btn btn-warning btn-mini gl_asset_active right <?php echo $deactive_class; ?>">Deactivate</a>

                                                    <a href="javascript:void(0)" style="margin-right: 28px;" data-status="a"  data-option="<?php echo $option->id; ?>" class="gl_asseta_<?php echo $option->id; ?> btn btn-success btn-mini gl_asset_active right <?php echo $active_class; ?>">Activate</a>     

                                                <?php } ?>


                                                <a href="javascript:void(0)" style="    margin-right: 28px; " id="remove_source2" data-option="<?php echo $option->id; ?>" class="btn btn-danger btn-mini remove_source2 right">Remove</a>


                                            </div> 


                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <!--id="1"-->
                                        <div class="data_value_key2 gl_count_1" data-count2="1" style="border: 1.4px solid #ccc;padding: 2px 2px 44px 5px; width: 78%;margin-left: 100px;margin-bottom: 20px;">
                                            <input type="hidden" name="metaid" >

                                            <?php $i = 1; ?>


                                            <div class="form-row row-fluid gl_radio_library">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span4" for="cust_scroll">Library Group</label>
                                                        <div class="span8 controls">


                                                            <?php
                                                            $k = 0;
                                                            foreach ($library_group as $lgkey => $library) {
                                                                ?> 

                                                                <div class="left marginT5" style="margin-right:10px;">

                                                                    <label class="assetradio  <?php
                                                                    if ($k == 0) {
                                                                        echo "checked";
                                                                    }
                                                                    ?>" for="library_group<?php echo $k . $i; ?>">
                                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="library_group "
                                                                               name="library_group_<?php echo $i; ?>" 
                                                                               id="library_group<?php echo $k . $i; ?>" value="<?php echo $lgkey; ?>" 

                                                                               <?php
                                                                               if ($k == 0) {
                                                                                   echo "checked";
                                                                               }
                                                                               ?>

                                                                               />
                                                                        <?php echo $library; ?></label>
                                                                </div>

                                                                <?php
                                                                $k++;
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>

                                                </div>



                                            </div>

                                            <div class="form-row row-fluid gl_radio_type" id="nonscript_1" >
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span4" for="cust_scroll">Choose type</label>
                                                        <div class="span8 controls">


                                                            <?php
                                                            $k = 0;
                                                            foreach ($filetype as $type) {
                                                                ?>

                                                                <div class="left marginT5 " id="<?php echo $type . '_' . $i; ?>" style="margin-right:10px;">

                                                                    <label class="assetradio  <?php
                                                                    if ($k == 0) {
                                                                        echo "checked";
                                                                    }
                                                                    ?>" for="type<?php echo $k . $i; ?>">  

                                                                        <input required style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="type" name="type_<?php echo $i; ?>" id="type<?php echo $k . $i; ?>"  value="<?php echo $type; ?>" 
                                                                        <?php
                                                                        if ($k == 0) {
                                                                            echo "checked";
                                                                        }
                                                                        ?> /> <?php echo ucfirst($type); ?> </label>

                                                                </div>

                                                                <?php
                                                                $k++;
                                                            }
                                                            ?>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-row row-fluid" id="int_file_1" >
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span4" for="normal">Add Internal File</label>

                                                        <span class="base_show" style="display:none;"> <?php echo base_url(); ?> </span><textarea rows="1"  class="span4"  name="int_link_1" required ></textarea>
                                                        <span class="error">
                                                            <?php //echo form_error('extra_link2');            ?>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>  


                                            <a href="javascript:void(0)"  id="remove_source2" data-option="" class="btn btn-danger btn-mini remove_source2 right">Remove</a>

                                        </div>  

                                    <?php }
                                    ?>


                                </div>    


                                <div class="form-row row-fluid">

                                    <div class="span12">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key2" style="margin-right: 57px;float: right;margin-top: 1%;">Add Next</a>
                                            </div>
                                        </div> 

                                    </div>                                      
                                </div>  
                                <!--EOF Product options Section-->

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">

                                        </div>
                                    </div>
                                </div>




                                <div class="form-actions">
                                    <input type="hidden" name="header_json" id="header_json">
            <!--                        <input type="hidden" name="footer_json" id="footer_json">-->
                                    <button type="submit" class="btn btn-info showhide-btn pull-right" onclick="save_order_asset()">Submit</button>

                                </div>
                            </form>

                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'footer_asset') {
                            ?>



                            <form  id="wizard" class="gl_footer_asset gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/asset'; ?>" method="post" enctype="multipart/form-data" >

                                <input type="hidden" name="option_asset" value="footer">

                                <div class="title">
                                    <h4> 
                                        <span>Asset Settings (Footer) </span>
                                    </h4>
                                </div><br>

                                <div id="main_key3">
                                    <?php
                                    if (!empty($footer_options_meta)) {
                                        $i = 0;
                                        foreach ($footer_options_meta as $meta_key => $option) {



                                            $i++;
                                            ?>
                                            <div class="data_value_key3 gl_count_<?php echo $i; ?>" data-count3="<?php echo $i; ?>"   style="border: 1.4px solid #ccc;padding: 2px 2px 44px 5px; width: 78%;margin-left: 100px;margin-bottom: 20px;">
                                                <input type="hidden" name="fmetaid" value="<?php echo $option->id; ?>">



                                                <div class="form-row row-fluid gl_radio_library">
                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span4" for="cust_scroll">Library Group</label>
                                                            <div class="span8 controls">

                                                                <?php
                                                                $k = 0;
                                                                foreach ($library_group as $lgkey => $library) {
                                                                    ?>

                                                                    <div class="left marginT5" style="margin-right:10px;">

                                                                        <label class="assetradio  <?php
                                                                        if ($option->library == $lgkey) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>" for="flibrary_group<?php echo $k . $i; ?>">


                                                                            <input data-count3="<?php echo $i; ?>" required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="flibrary_group"   name="flibrary_group_<?php echo $i; ?>" 
                                                                                   id="flibrary_group<?php echo $k . $i; ?>" value="<?php echo $lgkey; ?>" 

                                                                                   <?php
                                                                                   if ($option->library == $lgkey) {
                                                                                       echo "checked";
                                                                                   }
                                                                                   ?>

                                                                                   />
                                                                            <?php echo $library; ?></label>
                                                                    </div>

                                                                    <?php
                                                                    $k++;
                                                                }
                                                                ?> 

                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="form-row row-fluid gl_radio_type" id="fnonscript_<?php echo $i; ?>" <?php //if ($option->library == "script" || $option->library == "meta" || $option->library == "metacharset") {                   ?> style="display:block;"
                                                     <?php //}        ?>>
                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span4" for="cust_scroll">Choose type</label>
                                                            <div class="span8 controls">


                                                                <?php
                                                                $k = 0;
                                                                foreach ($filetype as $type) {
                                                                    ?>

                                                                    <div class="left marginT5 " id="<?php echo 'f' . $type . '_' . $i; ?>" style=" <?php
                                                                    if ($option->library == "script" || $option->library == "meta" || $option->library == "metacharset") {
                                                                        if ($type != 'manual') {
                                                                            ?>  display:none;
                                                                                 <?php
                                                                             }
                                                                         }
                                                                         ?>  margin-right:10px;">

                                                                        <label class="assetradio  <?php
                                                                        if ($option->type == $type) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>" for="ftype<?php echo $k . $i; ?>">  

                                                                            <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="ftype" name="ftype_<?php echo $i; ?>" id="ftype<?php echo $k . $i; ?>"  value="<?php echo $type; ?>" 
                                                                            <?php
                                                                            if ($option->type == $type) {
                                                                                echo "checked";
                                                                            }
                                                                            ?> /> <?php echo ucfirst($type); ?> </label>

                                                                    </div>

                                                                    <?php
                                                                    $k++;
                                                                }
                                                                ?>   

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-row row-fluid" id="fint_file_<?php echo $i; ?>"  >

                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span4" for="normal">Add File</label>

                                                            <span class="fbase_show" <?php if ($option->type != "internal") { ?> style="display:none;"   <?php } ?> > <?php echo base_url(); ?> </span>  <textarea required  rows="1"  class="span4"  name="fint_link_<?php echo $i; ?>" ><?php
                                                                if (isset($option->filepath)) {
                                                                    echo $option->filepath;
                                                                }
                                                                ?></textarea>
                                                            <span class="error">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>  

                                                <?php
                                                if ($option->active_status == 'a') {

                                                    $active_class = 'hide';
                                                    $deactive_class = '';
                                                } else {
                                                    $active_class = '';
                                                    $deactive_class = 'hide';
                                                }
                                                ?>
                                                <a href="javascript:void(0)" style="margin-right: 28px;" data-status="d" data-option="<?php echo $option->id; ?>" class="gl_assetd_<?php echo $option->id; ?> btn btn-warning btn-mini gl_asset_active right <?php echo $deactive_class; ?>">Deactivate</a>

                                                <a href="javascript:void(0)" style="margin-right: 28px;" data-status="a"  data-option="<?php echo $option->id; ?>" class="gl_asseta_<?php echo $option->id; ?> btn btn-success btn-mini gl_asset_active right <?php echo $active_class; ?>">Activate</a>



                                                <a href="javascript:void(0)" style="    margin-right: 28px;" id="remove_source3" data-option="<?php echo $option->id; ?>" class="btn btn-danger btn-mini remove_source3 right">Remove</a>


                                            </div> 


                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <!--id="1"-->
                                        <div class="data_value_key3 gl_count_1" data-count3="1" style="border: 1.4px solid #ccc;padding: 2px 2px 44px 5px; width: 78%;margin-left: 100px;margin-bottom: 20px;">
                                            <input type="hidden" name="fmetaid" >

                                            <?php
                                            $i = 1;
                                            ?>


                                            <div class="form-row row-fluid gl_radio_library">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span4" for="cust_scroll">Library Group</label>
                                                        <div class="span8 controls">

                                                            <?php
                                                            $k = 0;
                                                            foreach ($library_group as $lgkey => $library) {
                                                                ?>

                                                                <div class="left marginT5" style="margin-right:10px;">

                                                                    <label class="assetradio  <?php
                                                                    if ($k == 0) {
                                                                        echo "checked";
                                                                    }
                                                                    ?>" for="flibrary_group<?php echo $k . $i; ?>">


                                                                        <input data-count3="<?php echo $i; ?>" required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="flibrary_group"   name="flibrary_group_<?php echo $i; ?>" 
                                                                               id="flibrary_group<?php echo $k . $i; ?>" value="<?php echo $lgkey; ?>" 

                                                                               <?php
                                                                               if ($k == 0) {
                                                                                   echo "checked";
                                                                               }
                                                                               ?>

                                                                               />
                                                                        <?php echo $library; ?></label>
                                                                </div>

                                                                <?php
                                                                $k++;
                                                            }
                                                            ?> 



                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-row row-fluid gl_radio_type" id="fnonscript_1" >
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span4" for="cust_scroll">Choose type</label>
                                                        <div class="span8 controls">


                                                            <?php
                                                            $k = 0;
                                                            foreach ($filetype as $type) {
                                                                ?>

                                                                <div class="left marginT5 " id="<?php echo 'f' . $type . '_' . $i; ?>" style="margin-right:10px;">

                                                                    <label class="assetradio  <?php
                                                                    if ($k == 0) {
                                                                        echo "checked";
                                                                    }
                                                                    ?>" for="ftype<?php echo $k . $i; ?>">  

                                                                        <input required  style="opacity:1; width: 14px;margin-top: 0px;margin-left: 2px;" type="radio" class="ftype" name="ftype_<?php echo $i; ?>" id="ftype<?php echo $k . $i; ?>"  value="<?php echo $type; ?>" 
                                                                        <?php
                                                                        if ($k == 0) {
                                                                            echo "checked";
                                                                        }
                                                                        ?> /> <?php echo ucfirst($type); ?> </label>

                                                                </div>

                                                                <?php
                                                                $k++;
                                                            }
                                                            ?>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-row row-fluid" id="fint_file_1" >
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span4" for="normal">Add Internal File</label>

                                                        <span class="fbase_show" style="display:none;"> <?php echo base_url(); ?> </span><textarea rows="1"  class="span4"  name="fint_link_1" required ></textarea>
                                                        <span class="error">
                                                            <?php //echo form_error('extra_link2');              ?>
                                                        </span>
                                                    </div>


                                                </div>
                                            </div>  


                                            <a href="javascript:void(0)"  id="remove_source3" data-option="" class="btn btn-danger btn-mini remove_source3 right">Remove</a>

                                        </div>  

                                    <?php }
                                    ?>

                                </div>

                                <div class="form-row row-fluid">

                                    <div class="span12">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key3" style="margin-right: 57px;float: right;margin-top: 1%;">Add Next</a>
                                            </div>
                                        </div> 

                                    </div>                                      
                                </div>  
                                <!--EOF Product options Section-->

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">

                                        </div>
                                    </div>
                                </div>




                                <div class="form-actions">

                                    <input type="hidden" name="footer_json" id="footer_json">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right" onclick="footer_save_order_asset()">Submit</button>

                                </div>
                            </form>

                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'currency') {
                            ?>


                            <form  id="wizard" class="gl_currency gl_form form-horizontal  ui-formwizard  multiple_upload_form_basic" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/currency' ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Currency Settings</span>
                                    </h4>
                                </div>

                                <?php
                                $currency_array = json_decode($option_row->currency_list, true);
                                if (empty($currency_array)) {
                                    ?>      

                                    <div id="main_key5" class="main_key5">

                                        <div class="form-row row-fluid " >
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="currency_name">Name</label>   
                                                    <label class="form-label span2" for="currency_key">Key</label>   
                                                    <label class="form-label span2" for="currency_value">Value</label> 
                                                    <label class="form-label span2" for="currency_icon">Front End Icon</label>   
                                                    <label class="form-label span2" for="currency_icon_class">Icon Class</label>   
                                                    <label class="form-label span2" for="currency_price_prefix">Price Prefix</label>   
                                                    <label class="form-label span1" for="currency_default">Default</label>
                                                </div>
                                            </div> 
                                        </div>



                                        <div class="form-row row-fluid data_value_key5 " data-count="1">
                                            <div class="span12">
                                                <div class="row-fluid">

                                                    <input class="span3 gl_currency_name" placeholder="Currency Name" id="currency_name" type="text" name="currency_name"   value="<?php echo set_value('currency_name'); ?>" style="margin-left: 15px;" >
                                                    <input class="span2 gl_currency_key" placeholder="Currency key" id="currency_key" type="text" name="currency_key"   value="<?php echo set_value('key'); ?>">
                                                    <input readonly class="span2 gl_currency_value" placeholder="Currency Value" id="currency_value" type="text" name="currency_value" value="1">
                                                    <input class="span2 gl_currency_icon" placeholder="Currency Icon" id="currency_icon" type="text" name="currency_icon"   value="<?php echo set_value('currency_icon'); ?>" >
                                                    <input class="span2 gl_currency_icon_class" placeholder="Currency Icon Class" id="currency_icon_class" type="text" name="currency_icon_class"   value="<?php echo set_value('currency_icon_class'); ?>" >
                                                    <input class="span2 gl_currency_price_prefix" placeholder="Currency Price Prefix" id="currency_price_prefix" type="text" name="currency_price_prefix"   value="<?php echo set_value('currency_price_prefix'); ?>" >
                                                    
 <div class="left marginT5 marginR5 marginL5">
                                                    
                                                    <input type="radio" style="width: auto;" checked class="span1 gl_currency_default" name="currency_default" value="yes" ><span style="float:right;margin-left: 10px;margin-top: 10px;" class="gl_def_text"></span>
                                                    
</div>                                                    

                                                    <a href="javascript:void(0)" style= "margin-right:60px;" class="remove_source5 right">Remove</a>
                                                </div>
                                            </div> 
                                        </div>


                                    </div>


                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key5" style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>


                                <?php } else {
                                    ?>


                                    <div id="main_key5" class="main_key5">

                                        <div class="form-row row-fluid " >
                                            <div class="span12">
                                                <div class="row-fluid">

                                                    <label class="form-label span3" for="currency_name">Name</label>   
                                                    <label class="form-label span2" for="currency_key">Key</label>   
                                                    <label class="form-label span2" for="currency_value">Value</label> 
                                                    <label class="form-label span2" for="currency_icon">Front End Icon</label>   
                                                    <label class="form-label span2" for="currency_icon_class">Icon Class</label>   
                                                    <label class="form-label span2" for="currency_price_prefix">Price Prefix</label>   
                                                    <label class="form-label span1" for="currency_default">Default</label>
                                                </div>
                                            </div> 
                                        </div>
                                        <?php
                                        $i = 1;
                                        foreach ($currency_array as $currency_row) {
                                            ?>

                                            <div class="form-row row-fluid data_value_key5" data-count="<?php echo $i ?>">

                                                <div class="span12">

                                                    <div class="row-fluid">


                                                        <input class="span3 gl_currency_name" placeholder="Currency Name" id="currency_name" type="text" name="currency_name"   value="<?php echo $currency_row['name']; ?>" style="margin-left: 15px;" >
                                                        <input class="span2 gl_currency_key" placeholder="Currency key" id="currency_key" type="text" name="currency_key"   value="<?php echo $currency_row['key']; ?>">
                                                        <input class="span2 gl_currency_value" placeholder="Currency Value" id="currency_value" type="text" name="currency_value" value="<?php echo $currency_row['value']; ?>" <?php
                                                        if ($currency_row['def_status'] == 'yes') {
                                                            echo 'readonly';
                                                        }
                                                        ?>>
                                                        <input class="span2 gl_currency_icon" placeholder="Currency Icon" id="currency_icon" type="text" name="currency_name"   value="<?php echo $currency_row['icon']; ?>" >

                                                        <input class="span2 gl_currency_icon_class" placeholder="Currency Icon Class" id="currency_icon_class" type="text" name="currency_icon_class"   value="<?php echo $currency_row['icon_class']; ?>" >
                                                        <input class="span2 gl_currency_price_prefix" placeholder="Currency Price Prefix" id="currency_price_prefix" type="text" name="currency_price_prefix"   value="<?php echo $currency_row['price_prefix']; ?>" >

<div class="left marginT5 marginR5 marginL5">   

                                                        <input type="radio" style="width: auto;" <?php
                                                        if ($currency_row['def_status'] == 'yes') {
                                                            echo 'checked';
                                                        }
                                                        ?> class="span1 gl_currency_default" name="currency_default" value="yes" ><span style="float:right;margin-left: 10px;margin-top: 10px;" class="gl_def_text"></span> 
</div>





                                                        <a href="javascript:void(0)" style= "margin-right:60px;" id="<?php echo $i ?>" class="remove_source5 right">Remove</a>
                                                    </div>
                                                </div> 
                                            </div>



                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </div>  

                                    <div class="form-row row-fluid ">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key5" style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>

                                    <?php
                                }
                                ?>

                                <div class="title">
                                    <h4> 
                                        <span>Date Settings</span>
                                    </h4>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="last_updated_on">Last updated on</label>
                                            <input class="span8" readonly id="last_updated_on" type="text" name="last_updated_on" value="<?php echo date("d-m-Y H:i:s", strtotime($option_row->price_list_updated_datetime)); ?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="price_list_change_date">Need to Change</label>
                                            <div class="span8 controls">
                                                <div class="left marginT5 marginR10">
                                                    <input type="radio" class="price_list_change_date" name="price_list_change_date" id="price_list_change_date1" value="yes" >
                                                    Yes
                                                </div>
                                                <div class="left marginT5 marginL10">
                                                    <input type="radio"  class="price_list_change_date"  name="price_list_change_date" id="price_list_change_date2" checked   value="no" >
                                                    No
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="date_update_container">
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="price_list_date_type">Date Type</label>
                                                <div class="span8 controls">
                                                    <div class="left marginT5 marginR10">
                                                        <input type="radio" class="price_list_date_type" name="price_list_date_type" id="price_list_date_type1" value="current" <?php
                                                        if ($option_row->price_list_date_type === 'current') {
                                                            echo 'checked';
                                                        }
                                                        ?> />
                                                        Current
                                                    </div>
                                                    <div class="left marginT5 marginL10">
                                                        <input type="radio" class="price_list_date_type" name="price_list_date_type" id="price_list_date_type2" value="custom" <?php
                                                        if ($option_row->price_list_date_type === 'custom') {
                                                            echo 'checked';
                                                        }
                                                        ?> />
                                                        Custom
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row-fluid price_list_updated_datetime_container">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="combined-picker">Date Time</label>
                                                <?php
                                                if (empty($option_row->price_list_updated_datetime)) {

                                                    $newDate = '0000-00-00 00:00:00';
                                                } else {

                                                    $originalDate = $option_row->price_list_updated_datetime;
                                                    $newDate = date("d-m-Y H:i:s", strtotime($originalDate));
                                                }
                                                ?>
                                                <input  class="span8" type="text" name="price_list_updated_datetime" id="combined-picker" value="<?php echo $newDate; ?>" readonly>
                                                <span class="error">
                                                    <?php echo form_error('price_list_updated_datetime'); ?>
                                                </span>
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
                                    <input type="hidden" value="" id="gl_currency_json"  name="currency_json">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit  gl_currency_submit" onclick="return save_option_currency();" >Submit</button>

                                </div>
                            </form> 

                            <?php
                        }
                        ?>

                        <?php
                        if ($this->uri->segment(4) == 'file_combo') {
                            ?>


                            <?php /**/ ?>
                            <form  id="wizard" class="gl_form gl_file_combo form-horizontal  ui-formwizard  multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/file_combo' ?>" method="post" enctype="multipart/form-data" >
                                <div class="title">
                                    <h4> 
                                        <span>Default File Combo</span>
                                    </h4>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span6">
                                        <div class="row-fluid">
                                            <label class="form-label span6" for="file_upload_type">File Upload Type</label>

                                        </div>
                                    </div>

                                    <div class="span6">
                                        <div class="row-fluid">
                                            <div class="row-fluid comboSection">

                                                <label class="form-label span6" for="def_combo">Select File Property</label>

                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <?php
//                            $file_upload_type = $this->option_model->get_array_by_name('file_upload_type');
                                $file_upload_type = json_decode($option_row->file_upload_type, TRUE);


                                if (!empty($file_upload_type)) {
                                    foreach ($file_upload_type as $upload_type_val) {
                                        $upload_type = '';
                                        if (!empty($upload_type_val['file_upload_type'])) {
                                            $upload_type = $upload_type_val['file_upload_type'];
                                        }
                                        ?>

                                        <div class="form-row row-fluid gl_combo_set">
                                            <div class="span6">
                                                <div class="row-fluid">
                                                    <label class="form-label span2" for="file_upload_type"></label>
                                                    <input readonly class="span8 gl_file_upload_type" placeholder="value" type="text" name="file_upload_type"  value="<?php echo $upload_type; ?>" >
                                                </div>
                                            </div>

                                            <div class="span6">
                                                <div class="row-fluid">
                                                    <div class="row-fluid comboSection">

                                                        <label class="form-label span2" for="def_combo"></label>
                                                        <div class="span8 controls comboset">  
                                                            <select name="def_combo" class="gl_def_combo">

                                                                <?php foreach ($values as $combos) { ?>
                                                                    <option value="<?php echo $combos->fid; ?>" 
                                                                    <?php
                                                                    if (!empty($default_combo_list[$upload_type])) {
                                                                        if ($default_combo_list[$upload_type] == $combos->fid) {
                                                                            echo 'selected';
                                                                            ;
                                                                        }
                                                                    }
                                                                    ?> >
                                                                        <?php echo $combos->combo_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <span class="error">
                                                            <?php echo form_error('def_combo'); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>

                                <div class="form-actions">
                                    <input name="combo_json" id="gl_combo_json" type="hidden" value="" class="gl_combo_json">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_combo_submit" onclick="return save_option();" >Submit</button>
                                </div>

                            </form>

                            <?php
                        }
                        ?> 

                        <?php
                        if ($this->uri->segment(4) == 'theme_page_type_setting') {
                            ?>                     

                            <form  id="wizard" class="gl_theme_page_type_setting gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/theme_page_type_setting'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Theme Page Type Settings</span>
                                    </h4>
                                </div>
                                <div class="gl_theme_page_type_wrapper">

                                    <?php
                                    $theme_page_type_setting = json_decode($option_row->theme_page_type_setting, true);

                                    if (!empty($theme_page_type_setting)) {

                                        foreach ($theme_page_type_setting as $theme_page_type) {
                                            $slider_datas["data_theme_page_type_id"] = $theme_page_type['data_theme_page_type_id'];
                                            $slider_datas["data_theme_page_type_key"] = $theme_page_type['data_theme_page_type_key'];
                                            $slider_datas["page_theme_page_type_label"] = $theme_page_type['page_theme_page_type_label'];

                                            $slider_datas["quick_status"] = $theme_page_type['quick_status'];


                                            $this->load->view("include/theme_page_type", $slider_datas);
                                        }
                                    } else {
                                        $this->load->view("include/theme_page_type");
                                    }
                                    ?>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_theme_page_type_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>




                                <div class="form-actions">
                                    <input type="hidden" class="gl_data_page_type"
                                           name="theme_page_type_setting">
                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_theme_page_type_submit">Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?> 

                        <?php
                        if ($this->uri->segment(4) == 'element_setting') {
                            ?> 


                            <form  id="wizard" class="gl_element_setting gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/element_setting'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Element Box Values Setting</span>
                                    </h4>
                                </div>


                                <?php
                                $element_values_array = json_decode($option_row->element_box_values, true);

                                if (empty($element_values_array)) {
                                    ?>      

                                    <div id="main_key14">

                                        <div class="form-row row-fluid data_value_key14" data-count="1">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <!--<label class="form-label span4 key_feature_label4" for="content1_title_val">Add Mail</label>-->
                                                    <label class="form-label span3" for="">Element Value</label> <input class="span3 gl_element_value" placeholder="Element value" id="element_value" type="text" name="element_value"   value="<?php echo set_value('element_value'); ?>" style="margin-left: 15px;">

                                                    <a href="javascript:void(0)" style= "margin-right:60px;" class="remove_source14">Remove</a>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>


                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key14" style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>


                                <?php } else {
                                    ?>


                                    <div id="main_key14">

                                        <?php
                                        $i = 1;
                                        foreach ($element_values_array as $element_row) {
                                            ?>

                                            <div class="form-row row-fluid data_value_key14" data-count="<?php echo $i ?>">
                                                <div class="span12">

                                                    <div class="row-fluid">

                                                        <label class="form-label span3" for="">Element Value</label> <input class="span3 gl_element_value" placeholder="Element Value" id="<?php echo $i; ?>element_value" type="text" name="<?php echo $i; ?>element_value"   value="<?php echo $element_row; ?>" style="margin-left: 15px;">

                                                        <a href="javascript:void(0)" style= "margin-right:60px;" id="<?php echo $i ?>" class="remove_source14">Remove</a>
                                                    </div>
                                                </div> 
                                            </div>



                                            <?php
                                            $i++;
//                                    }
                                        }
                                        ?>
                                    </div>  

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key14" style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>



                                    <?php
                                }
                                ?>


                                <div class="form-actions">
                                    <input type="hidden" value="" id="gl_element_json"  name="element_json">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_element_button">Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>

                        <?php
                        if ($this->uri->segment(4) == 'fixed_data_setting') {
                            ?>


                            <form  id="wizard" class="gl_fixed_data_setting gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/fixed_data_setting'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Fixed Page Data Setting</span>
                                    </h4>
                                </div>


                                <?php
                                $fixed_values_array = json_decode($option_row->fixed_page_data, true);


                                if (isset($_GET['key'])) {
                                    $fixed_data_type = $_GET['key'];
                                } else {
                                    $fixed_data_type = '';
                                }
                                $fixed_data_title = ucwords(str_replace('_', " ", $fixed_data_type));

                                if (empty($fixed_values_array[$fixed_data_type])) {
                                    ?>      

                                    <div id="main_key15">


                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="fixed_data_type">Fixed Page Type</label>
                                                    <div class="span8 controls">
                                                        <div class="left marginT5 ">
                                                            <input type="radio"  name="fixed_data_type" class="gl_fixed_data_type" id="fixed_data_type" value="<?php echo $fixed_data_type; ?>" <?php
                                                            echo 'checked';
                                                            ?> />
                                                                   <?php echo $fixed_data_title; ?>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid data_value_key15" data-count="1">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <div class="span6">  
                                                        <label class="form-label span3" for="">Themes</label> <input class="span6 gl_fixed_value" placeholder="Themes" id="fixed_value" type="text" name="fixed_value" value="<?php echo set_value('fixed_value'); ?>" style="margin-left: 15px;" required></div>
                                                    <div class="span4 gl_fixed_page_theme_wrpr">  
                                                        <select name="fixed_page_theme"
                                                                class="gl_fixed_page_theme">
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            if (!empty($page_theme)) {
                                                                ?>
                                                                <optgroup label="Fixed Pages"><?php
                                                                    foreach ($page_theme as $page_theme_row) {
                                                                        ?>
                                                                        <option  value="<?php echo $page_theme_row->id; ?>">
                                                                            <?php echo $page_theme_row->page; ?></option>
                                                                    <?php }
                                                                    ?>
                                                                </optgroup>
                                                                <?php
                                                            }
                                                            if (!empty($wizard_theme)) {
                                                                ?>
                                                                <optgroup label="Fixed Wizards"><?php
                                                                    foreach ($wizard_theme as $wizard_theme_row) {
                                                                        ?>
                                                                        <option  value="<?php echo $wizard_theme_row->id; ?>">
                                                                            <?php echo $wizard_theme_row->wizard_name; ?></option>
                                                                    <?php }
                                                                    ?>
                                                                </optgroup>
                                                            <?php }
                                                            ?>

                                                        </select>

                                                    </div>
                                                    <a href="javascript:void(0)" style= "margin-right:60px;" class="remove_source15">Remove</a>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>


                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key15" style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>


                                <?php } else {
                                    ?>



                                    <div id="main_key15">

                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="fixed_data_type">Data Management</label>
                                                    <div class="span8 controls">
                                                        <div class="left marginT5 ">
                                                            <input type="radio"  name="fixed_data_type" class="gl_fixed_data_type" id="fixed_data_type" value="<?php echo $fixed_data_type; ?>" <?php
                                                            echo 'checked';
                                                            ?> />
                                                                   <?php echo $fixed_data_title; ?>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $i = 1;
                                        foreach ($fixed_values_array[$fixed_data_type] as $key_fixed => $data_row) {
                                            ?>

                                            <div class="form-row row-fluid data_value_key15" data-count="<?php echo $i ?>">
                                                <div class="span12">

                                                    <div class="row-fluid">
                                                        <div class="span6">  
                                                            <label class="form-label span3" for="">Value</label> <input class="span6 gl_fixed_value" placeholder="Value" id="<?php echo $i; ?>fixed_value" type="text" name="<?php echo $i; ?>fixed_value"   value="<?php echo $data_row["theme_value"]; ?>" style="margin-left: 15px;" required> </div>
                                                        <div class="span4 gl_fixed_page_theme_wrpr">  
                                                            <select name="fixed_page_theme"
                                                                    class="gl_fixed_page_theme">
                                                                <option value="">--Select--</option>

                                                                <?php
                                                                if (!empty($page_theme)) {
                                                                    ?>
                                                                    <optgroup label="Fixed Pages"><?php
                                                                        foreach ($page_theme as $page_theme_row) {
                                                                            ?>
                                                                            <option  value="<?php echo $page_theme_row->id; ?>"

                                                                                     <?php
                                                                                     if ($page_theme_row->id == $data_row["theme_page"]) {
                                                                                         echo " selected ";
                                                                                     }
                                                                                     ?>



                                                                                     >
                                                                                <?php echo $page_theme_row->page; ?></option>
                                                                        <?php }
                                                                        ?>
                                                                    </optgroup>
                                                                    <?php
                                                                }
                                                                if (!empty($wizard_theme)) {
                                                                    ?>
                                                                    <optgroup label="Fixed Wizards"><?php
                                                                        foreach ($wizard_theme as $wizard_theme_row) {
                                                                            ?>
                                                                            <option  value="<?php echo $wizard_theme_row->id; ?>"

                                                                                     <?php
                                                                                     if ($wizard_theme_row->id == $data_row["theme_page"]) {
                                                                                         echo " selected ";
                                                                                     }
                                                                                     ?>  


                                                                                     >
                                                                                <?php echo $wizard_theme_row->wizard_name; ?></option>
                                                                        <?php }
                                                                        ?>
                                                                    </optgroup>
                                                                <?php }
                                                                ?>


                                                            </select>

                                                        </div>

                                                        <a href="javascript:void(0)" style= "margin-right:60px;" id="<?php echo $i ?>" class="remove_source15">Remove</a>
                                                    </div>
                                                </div> 
                                            </div>



                                            <?php
                                            $i++;
//                                    }
                                        }
                                        ?>
                                    </div>  

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key15" style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>



                                    <?php
                                }
                                ?>


                                <div class="form-actions">
                                    <input type="hidden" value="" id="gl_fixed_data_json"  name="fixed_data_json">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_fixed_button">Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'fixed_page_assign') {
                            ?>


                            <form  id="wizard" class="gl_fixed_page_assign gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/fixed_page_assign'; ?>" method="post" enctype="multipart/form-data" >
                                <div class="title">
                                    <h4> 
                                        <span>Fixed Page Assign Setting</span>
                                    </h4>
                                </div>
                                <?php
                                $fixed_page_data_array = json_decode($option_row->fixed_page_data, true);

                                if (isset($_GET['key'])) {
                                    $fixed_data_type = $_GET['key'];
                                } else {
                                    $fixed_data_type = '';
                                }

                                $fixed_data_type_array = $fixed_page_data_array[$fixed_data_type];

                                $fixed_data_title = ucwords(str_replace('_', " ", $fixed_data_type));
                                ?>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3"
                                                   for="fixed_data_type">Data Management</label>
                                            <div class="span8 controls">
                                                <div class="left marginT5 ">
                                                    <input type="radio" 
                                                           name="fixed_page_key" 
                                                           value="<?php echo $fixed_data_type; ?>" <?php
                                                           echo 'checked';
                                                           ?> />
                                                           <?php echo $fixed_data_title; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="row-fluid ">
                                                <label class="form-label span3">Fixed Page Themes</label>
                                                <div class="span8 controls">  
                                                    <select name="fixed_page_theme"
                                                            class="gl_fixed_page_theme" required>
                                                        <option value="">--Select Theme--</option>
                                                        <?php
                                                        $fixed_theme_page_array_exist_data = json_decode($this->common_model->option->fixed_theme_page_array, TRUE);
                                                        $fixed_page_data_array = $fixed_page_data_array[$fixed_data_type];
                                                     
                                                        foreach ($fixed_page_data_array as $fixed_data_type1) {
                                                            ?> <option value="<?php echo $fixed_data_type1["theme_value"]; ?>" 
                                                            <?php
                                                            if ($fixed_theme_page_array_exist_data[$fixed_data_type] == $fixed_data_type1["theme_value"]) {
                                                                echo " selected ";
                                                            }
                                                            ?> ><?php echo $fixed_data_type1["theme_value"]; ?></option>
                                                                <?php } ?>
                                                    </select>
                                                </div>
                                                <span class="error">
                                                    <?php echo form_error('fixed_page_theme'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info showhide-btn
                                            pull-right">Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?> 


                        <?php
                        if ($this->uri->segment(4) == 'inventory') {
                            ?>


                            <form  id="wizard" class="gl_inventory gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/inventory'; ?>" method="post" enctype="multipart/form-data" >
                                <div class="title">
                                    <h4> 
                                        <span>Inventory Setting</span>
                                    </h4>
                                </div>

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="inventory">Inventory Management</label>
                                            <div class="span8 controls">
                                                <div class="left marginT5 ">
                                                    <input type="radio"  name="inventory" id="inventory1" value="on" <?php
                                                    if (!empty($option_row->inventory)) {
                                                        if ($option_row->inventory == 'on') {
                                                            echo 'checked';
                                                        }
                                                    } else {
                                                        echo 'checked';
                                                    }
                                                    ?> />
                                                    On
                                                </div>
                                                <div class="left marginT5">
                                                    <input type="radio" name="inventory" id="inventory2" value="off" <?php
                                                    if ($option_row->inventory == 'off') {
                                                        echo 'checked';
                                                    }
                                                    ?> />
                                                    Off
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right">Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?> 


                        <?php
                        if ($this->uri->segment(4) == 'theme_feature_box') {
                            ?>


                            <form  class="gl_form gl_theme_feature_box form-horizontal  ui-formwizard  multiple_upload_form_basic"
                                   action="" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4>
                                        <span>Theme Feature Box Types (Folder)Setting</span>
                                    </h4>
                                </div>


                                <div class="gl_theme_feature_box_wrapper">
                                    <?php
                                    $theme_feature_set = json_decode($option_row->theme_feature_box, true);

                                    if (!empty($theme_feature_set)) {

                                        foreach ($theme_feature_set as $theme_feature) {
                                            $theme_feature_data["theme_feature_set"] = $theme_feature['theme_feature'];
                                            $theme_feature_data["theme_feature_key"] = $theme_feature['theme_feature_key'];
                                            $theme_feature_data["theme_feature_box_status"] = $theme_feature['theme_feature_box_status'];

                                            $this->load->view("include/theme_feature_set", $theme_feature_data);
                                        }
                                    } else {
                                        $this->load->view("include/theme_feature_set");
                                    }
                                    ?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini gl_theme_feature_box_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>

                                </div>



                                <div class="title">
                                    <h4>
                                        <span>Slider Item type Setting</span>
                                    </h4>
                                </div>


                                <div class="gl_theme_feature_box_wrapper_slider">
                                    <?php
                                    $slider_item_type_set = json_decode($option_row->slider_item_type, true);

                                    if (!empty($slider_item_type_set)) {

                                        foreach ($slider_item_type_set as $slider_item_type) {


                                            $slider_item_type_data["slider_item_key"] = $slider_item_type['slider_item_key'];
                                            $slider_item_type_data["slider_item"] = $slider_item_type['slider_item'];
                                            $slider_item_type_data["slider_item_status"] = $slider_item_type['slider_item_status'];

                                            $this->load->view("include/slider_item_type_set", $slider_item_type_data);
                                        }
                                    } else {
                                        $this->load->view("include/slider_item_type_set");
                                    }
                                    ?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini gl_theme_feature_box_more_slider" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>

                                </div>  

                                <div class="title">
                                    <h4>
                                        <span>Slider Data Value Setting</span>
                                    </h4>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span6">
                                        <div class="row-fluid">
                                            <label class="form-label span6">Slider Type</label>
                                        </div>
                                    </div>

                                    <div class="span6">
                                        <div class="row-fluid">
                                            <div class="row-fluid">

                                                <label class="form-label span6" >Data value</label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gl_slider_data_value_wrapper">

                                    <?php
                                    $slider_data_set = json_decode($option_row->slider_data_set, true);

                                    if (!empty($slider_data_set)) {

                                        foreach ($slider_data_set as $slider_data1) {
                                            $slider_datas["data_slider"] = $slider_data1['data_slider'];
                                            $slider_datas["slider_item_type"] = $slider_data1['slider_item_type'];
                                            $slider_datas["data_slider_key"] = $slider_data1['data_slider_key'];
                                            $slider_datas["data_attr_value"] = $slider_data1['data_attr_value'];
                                            $slider_datas["quick_status"] = $slider_data1['quick_status'];


                                            $this->load->view("include/slider_data_value", $slider_datas);
                                        }
                                    } else {
                                        $this->load->view("include/slider_data_value");
                                    }
                                    ?>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_slider_value_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>


                                <div class="form-actions">

                                    <input type="hidden" class="gl_quick_link_set" value="" name="gl_quick_link_set">
                                    <input type="hidden" class="gl_quick_link_set_slider" value="" name="gl_quick_link_set_slider">
                                    <input type="hidden" class="gl_slider_data_set" value="" name="gl_slider_data_set">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_theme_feature_box_creation gl_submit" >Submit</button>
                                </div>
                            </form>


                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'return_type') {
                            ?>                       


                            <form  id="wizard" class="gl_return_type gl_form form-horizontal  ui-formwizard  multiple_upload_form_basic" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/return_type' ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Database Return Type Settings</span>
                                    </h4>
                                </div>


                                <?php
                                $return_type_arr = json_decode($option_row->db_return_types, true);

                                if (empty($return_type_arr)) {
                                    ?>      

                                    <div id="main_key6">
                                        <div class="form-row row-fluid " >
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="">Return Type Label</label>   
                                                    <label class="form-label span3" for="">Return Type</label>   

                                                </div>
                                            </div> 
                                        </div>





                                        <div class="form-row row-fluid data_value_key6" data-count="1">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <input class="span3 gl_return_type_label" placeholder="return type label"  type="text" name="return_type_label"   value="<?php echo set_value('return_type_label'); ?>" style="margin-left: 15px;">
                                                    <input class="span3 gl_return_type" placeholder="return type"  type="text" name="return_type" value="<?php echo set_value('return_type'); ?>">
                                                    <a href="javascript:void(0)" style= "margin-right:60px;" class="remove_source6 right">Remove</a>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key6" style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>


                                <?php } else {
                                    ?>


                                    <div id="main_key6">

                                        <div class="form-row row-fluid " >
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span3" for="">Return Type Label</label>   
                                                    <label class="form-label span3" for="">Return Type</label>   
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $i = 1;
                                        foreach ($return_type_arr as $return_type) {
                                            ?>

                                            <div class="form-row row-fluid data_value_key6" data-count="<?php echo $i ?>">
                                                <div class="span12">

                                                    <div class="row-fluid">

                                                        <input class="span3 gl_return_type_label" placeholder="return type label" type="text" name="return_type_label" value="<?php echo $return_type['return_type_label']; ?>" style="margin-left: 15px;">
                                                        <input class="span3 gl_return_type " placeholder="return type"  type="text" name="return_type"   value="<?php echo $return_type['return_type']; ?>">

                                                        <a href="javascript:void(0)" style= "margin-right:60px;" class="remove_source6 right ">Remove</a>
                                                    </div>
                                                </div> 
                                            </div>

                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </div>  

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key6" style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>



                                    <?php
                                }
                                ?>

                                <div class="form-actions">

                                    <input type="hidden" value="" id="gl_return_type_json"  name="return_type_json">

                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit  gl_return_type_submit" onclick="return save_option();" >Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'structure_file_include') {
                            ?>


                            <form class="gl_structure_file_include gl_form form-horizontal  ui-formwizard  multiple_upload_form_basic" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/structure_file_include' ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Structure File Include Settings</span>
                                    </h4>
                                </div>



                                <div id="main_key7">
                                    <div class="form-row row-fluid " >
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="">Structure File Include Label</label>   
                                                <label class="form-label span3" for="">Structure File Include</label>   

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $structure_file_include_arr = json_decode($option_row->structure_file_include, true);

                                    if (empty($structure_file_include_arr)) {

                                        $stcr_fl_data['structure_file_include_label'] = set_value('structure_file_include_label');
                                        $stcr_fl_data['structure_file_include'] = set_value('structure_file_include');
                                        $this->load->view("include/structure_file_include", $stcr_fl_data);
                                    } else {

                                        foreach ($structure_file_include_arr as $structure_file_include) {

                                            $stcr_fl_data['structure_file_include_label'] = $structure_file_include['structure_file_include_label'];
                                            $stcr_fl_data['structure_file_include'] = $structure_file_include['structure_file_include'];
                                            $this->load->view("include/structure_file_include", $stcr_fl_data);
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key7" style="float: right;">Add More</a>
                                            </div>
                                        </div> 
                                    </div>
                                </div>

                                <div class="form-actions">

                                    <input type="hidden" value="" id="gl_structure_file_include_json"  name="structure_file_include_json">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit  gl_structure_file_include_submit" onclick="return save_option();" >Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>



                        <?php
                        if ($this->uri->segment(4) == 'prod_type_fixed_page') {
                            ?>



                            <form  id="wizard" class="gl_prod_type_fixed_page gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/prod_type_fixed_page'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Product Type Fixed Page Assigning</span>
                                    </h4>
                                </div>


                                <?php
                                $fixed_values_array = json_decode($option_row->prod_type_fixed_page, true);

                                $fixed_prod_data_type = '';
                                if (isset($_GET['key'])) {
                                    $fixed_prod_data_type = $_GET['key'];
                                }
                                $fixed_data_title = ucwords(str_replace('_', " ", $fixed_prod_data_type));

                                $prod_type_fixed_page = '';
                                if (!empty($fixed_values_array[$fixed_prod_data_type])) {
                                    $prod_type_fixed_page = $fixed_values_array[$fixed_prod_data_type];
                                }
                                ?>

                                <?php
                                $fixed_theme_page_array_exist_data_ptype = json_decode($this->common_model->option->fixed_page_data, TRUE);
                                $fixed_page_data_array_ptype = $fixed_theme_page_array_exist_data_ptype[$fixed_prod_data_type];
                                ?>  




                                <div class="form-row row-fluid" >
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="fixed_prod_data_type">Fixed Product Page Type</label>
                                            <div class="span8 controls">
                                                <div class="left marginT5 ">
                                                    <input type="radio"  name="fixed_prod_data_type" class="gl_fixed_prod_data_type" id="fixed_prod_data_type" value="<?php echo $fixed_prod_data_type; ?>" <?php echo 'checked'; ?> >
                                                    <?php echo $fixed_data_title; ?>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>



                                <?php
                                if (!empty($prod_type_list)) {
                                    foreach ($prod_type_list as $prod_type) {

//            $prod_type_value = strtolower(str_replace(' ', '_', $prod_type->name)).'_'.$prod_type->id;
                                        $prod_type_value = $fixed_prod_data_type . '_' . $prod_type->id;

                                        $current_theme_page = '';
                                        if (!empty($prod_type_fixed_page)) {

                                            $prod_type_fixed_page_key = array_search($prod_type_value, array_column($prod_type_fixed_page, 'theme_value'));
                                            $current_theme_page = $prod_type_fixed_page[$prod_type_fixed_page_key]['theme_page'];
                                        }
                                        ?>
                                        <div class="form-row row-fluid gl_fixed_prod_data_wrp" >
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <div class="span6">  
                                                        <label class="form-label span6" for=""><?php echo $prod_type->name; ?></label> 

                                                    </div>

                                                    <input class="span6 gl_prod_type_value" placeholder="Themes" id="prod_type_value" type="hidden" name="prod_type_value" value="<?php echo $prod_type_value; ?>" style="margin-left: 15px;">
                                                    <?php //$prod_type_value      ?>                         


                                                    <div class="span4 gl_fixed_prod_type_page_theme_wrpr">  


                                                        <select name="prod_type_page_theme" class="gl_fixed_prod_type_page_theme">

                                                            <?php /* ?>                                           <option value="">--Select--</option>
                                                              <?php
                                                              if (!empty($page_theme)) {
                                                              ?>
                                                              <optgroup label="Fixed Pages"><?php
                                                              foreach ($page_theme as $page_theme_row) {
                                                              ?>
                                                              <option  value="<?php echo $page_theme_row->id; ?>"
                                                              <?php if($current_theme_page == $page_theme_row->id){ echo 'selected'; } ?>
                                                              >
                                                              <?php echo $page_theme_row->page; ?></option>
                                                              <?php }
                                                              ?>
                                                              </optgroup>
                                                              <?php
                                                              }
                                                              if (!empty($wizard_theme)) {
                                                              ?>
                                                              <optgroup label="Fixed Wizards"><?php
                                                              foreach ($wizard_theme as $wizard_theme_row) {
                                                              ?>
                                                              <option  value="<?php echo $wizard_theme_row->id; ?>"
                                                              <?php if($current_theme_page == $wizard_theme_row->id){ echo 'selected'; } ?>
                                                              >
                                                              <?php echo $wizard_theme_row->wizard_name; ?></option>
                                                              <?php }
                                                              ?>
                                                              </optgroup>
                                                              <?php }
                                                              ?>
                                                              <?php /* */ ?>                                        

                                                            <option value="">--Select Theme--</option>
                                                            <?php foreach ($fixed_page_data_array_ptype as $fixed_data_type1) { ?> 
                                                                <option value="<?php echo $fixed_data_type1["theme_value"]; ?>" 
                                                                <?php
                                                                if ($current_theme_page == $fixed_data_type1["theme_value"]) {
                                                                    echo " selected ";
                                                                }
                                                                ?> ><?php echo $fixed_data_type1["theme_value"]; ?></option>
                                                                    <?php } ?>                                          








                                                        </select>
                                                    </div>  
                                                </div>
                                            </div> 
                                        </div>                                      
                                        <?php
                                    }
                                }
                                ?>      
                                <div class="form-actions">
    <!--                                <input type="hidden" value="" id="gl_fixed_data_json"  name="fixed_data_json">
                                        <button type="submit" class="btn btn-info showhide-btn pull-right gl_fixed_button">Submit</button>-->


                                    <input type="hidden" value="" id="gl_prod_type_fixed_page_json"  name="prod_type_fixed_page_json">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_prod_type_fixed_page_button">Submit</button>
                                </div>
                            </form>


                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'predefined_box') {
                            ?>   



                            <form class="gl_predefined_box gl_form form-horizontal  ui-formwizard  multiple_upload_form_basic" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/predefined_box' ?>" method="post" enctype="multipart/form-data" >

                                <div class="title">
                                    <h4> 
                                        <span>Featurebox Predefined Box Setting</span>
                                    </h4>
                                </div>

                                <div id="main_key8">
                                    <div class="form-row row-fluid " >
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="">Predefined Box Label</label>   
                                                <label class="form-label span3" for="">Predefined Box</label>   
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $predefined_box_arr = json_decode($option_row->predefined_box, true);

                                    if (empty($predefined_box_arr)) {

                                        $prebx_data['predefined_box_label'] = set_value('predefined_box_label');
                                        $prebx_data['predefined_box'] = set_value('predefined_box');
                                        $this->load->view("include/predefined_box", $prebx_data);
                                    } else {

                                        foreach ($predefined_box_arr as $predefined_box) {

                                            $prebx_data['predefined_box_label'] = $predefined_box['predefined_box_label'];
                                            $prebx_data['predefined_box'] = $predefined_box['predefined_box'];
                                            $this->load->view("include/predefined_box", $prebx_data);
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key8" style="float: right;">Add More</a>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="hidden" value="" id="gl_predefined_box_json"  name="predefined_box_json">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit  gl_predefined_box_submit" onclick="return save_option();" >Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?> 


                        <?php
                        if ($this->uri->segment(4) == 'file_upload_type') {
                            ?>                      


                            <form class="gl_file_upload_type gl_form form-horizontal ui-formwizar multiple_upload_form_basic" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/file_upload_type' ?>" method="post" enctype="multipart/form-data" >

                                <div class="title">
                                    <h4> 
                                        <span>File Upload Type Setting</span>
                                    </h4>
                                </div>

                                <div id="main_key9">
                                    <div class="form-row row-fluid " >
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="">File Upload Type</label>   
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $file_upload_type_arr = json_decode($option_row->file_upload_type, true);

                                    if (empty($file_upload_type_arr)) {

                                        $prebx_data['file_upload_type'] = set_value('file_upload_type');
                                        $this->load->view("include/file_upload_types", $prebx_data);
                                    } else {
                                        foreach ($file_upload_type_arr as $file_upload_type) {

                                            $prebx_data['file_upload_type'] = $file_upload_type['file_upload_type'];
                                            $this->load->view("include/file_upload_types", $prebx_data);
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key9" style="float: right;">Add More</a>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="hidden" value="" id="gl_file_upload_type_json"  name="file_upload_type_json">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit  gl_file_upload_type_submit" onclick="return save_option();" >Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>  

                        <?php
                        if ($this->uri->segment(4) == 'result_row') {
                            ?>                      


                            <form  id="wizard" class="gl_result_row gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/result_row'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Result Row Variable Setting</span>
                                    </h4>
                                </div>

                                <div id="main_key10">
                                    <div class="form-row row-fluid ">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="">Result Row Variable</label>   
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $result_row_variable_arr = json_decode($option_row->result_row_variable, true);

                                    if (empty($result_row_variable_arr)) {

                                        $result_row_data['result_row_variable'] = set_value('result_row_variable');
                                        $this->load->view("include/result_row_variable", $result_row_data);
                                    } else {
                                        foreach ($result_row_variable_arr as $result_row_variable) {

                                            $result_row_data['result_row_variable'] = $result_row_variable['result_row_variable'];
                                            $this->load->view("include/result_row_variable", $result_row_data);
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-mini" id="add_key10" style="float: right;">Add More</a>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="hidden" value="" id="gl_result_row_variable_json"  name="result_row_variable_json">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_submit  gl_result_row_variable_submit" onclick="return save_option();" >Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>                   
                        <!--{Sbn} code-->   


                        <?php
                        if ($this->uri->segment(4) == 'add_content_fixed_area_block') {
                            ?>                 

                            <form  class="gl_form gl_add_content_fixed_area_block form-horizontal  ui-formwizard  multiple_upload_form_basic"
                                   action="" method="post" enctype="multipart/form-data" >



                                <div class="title">
                                    <h4>
                                        <span>Add Content Link Fixed Areas</span>
                                    </h4>
                                </div>


                                <div class="gl_add_content_fixed_area_wrapper">
                                    <?php
                                    $add_content_fixed_areas_set = json_decode($option_row->add_content_fixed_areas, true);

                                    if (!empty($add_content_fixed_areas_set)) {

                                        foreach ($add_content_fixed_areas_set as $add_content_fixed_areas_value) {


                                            $add_content_fixed_areas_data["add_content_fixed_area_key"] = $add_content_fixed_areas_value['add_content_fixed_area_key'];
                                            $add_content_fixed_areas_data["add_content_fixed_area"] = $add_content_fixed_areas_value['add_content_fixed_area'];
                                            $add_content_fixed_areas_data["add_content_fixed_area_status"] = $add_content_fixed_areas_value['add_content_fixed_area_status'];

                                            $this->load->view("include/add_content_fixed_areas", $add_content_fixed_areas_data);
                                        }
                                    } else {
                                        $this->load->view("include/add_content_fixed_areas");
                                    }
                                    ?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini gl_add_content_fixed_area_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>

                                </div>  

                                <div class="title">
                                    <h4>
                                        <span>Add Content Link Fixed Links</span>
                                    </h4>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span6">
                                        <div class="row-fluid">
                                            <label class="form-label span6">Slider Type</label>
                                        </div>
                                    </div>

                                    <div class="span6">
                                        <div class="row-fluid">
                                            <div class="row-fluid">

                                                <label class="form-label span6" >Data value</label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gl_add_content_fixed_area_data_value_wrapper">

                                    <?php
                                    $add_content_fixed_areas_links = json_decode($option_row->add_content_fixed_areas_links, true);

                                    if (!empty($add_content_fixed_areas_links)) {

                                        foreach ($add_content_fixed_areas_links as $slider_data1) {
                                            $slider_datas["add_content_fixed_area_link"] = $slider_data1['add_content_fixed_area_link'];
                                            $slider_datas["add_content_fixed_areas_value"] = $slider_data1['add_content_fixed_areas_value'];
                                            $slider_datas["add_content_fixed_area_link_key"] = $slider_data1['add_content_fixed_area_link_key'];
                                            $slider_datas["add_content_fixed_area_link_attr_value"] = $slider_data1['add_content_fixed_area_link_attr_value'];
                                            $slider_datas["add_content_fixed_area_link_status"] = $slider_data1['add_content_fixed_area_link_status'];


                                            $this->load->view("include/add_content_fixed_area_link", $slider_datas);
                                        }
                                    } else {
                                        $this->load->view("include/add_content_fixed_area_link");
                                    }
                                    ?>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_add_content_fixed_area_link_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>


                                <div class="form-actions">


                                    <input type="hidden" class="gl_add_content_fixed_area_json" value="" name="gl_add_content_fixed_area_json">
                                    <input type="hidden" class="gl_add_content_fixed_areas_link_json" value="" name="gl_add_content_fixed_areas_link_json">
                                    <button type="submit" class="btn btn-info showhide-btn pull-right gl_theme_feature_box_creation gl_submit" >Submit</button>
                                </div>
                            </form> 


                            <?php
                        }
                        ?>  


                        <?php
                        if ($this->uri->segment(4) == 'wrapper_types') {
                            ?>


                            <form  id="wizard" class="gl_wrapper_types gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/wrapper_types'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Wrapper Types Settings</span>
                                    </h4>
                                </div>
                                <div class="gl_wrapper_types_wrapper">

                                    <?php
                                    $wrapper_types = json_decode($option_row->wrapper_types, true);

                                    if (!empty($wrapper_types)) {

                                        foreach ($wrapper_types as $wrapper_type) {
                                            $wrapper_datas["data_wrapper_type_id"] = $wrapper_type['data_wrapper_type_id'];
                                            $wrapper_datas["data_wrapper_type_key"] = $wrapper_type['data_wrapper_type_key'];
                                            $wrapper_datas["data_wrapper_type_label"] = $wrapper_type['data_wrapper_type_label'];

                                            $wrapper_datas["data_wrapper_type_status"] = $wrapper_type['data_wrapper_type_status'];


                                            $this->load->view("include/wrapper_type", $wrapper_datas);
                                        }
                                    } else {
                                        $this->load->view("include/wrapper_type");
                                    }
                                    ?>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_wrapper_type_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>




                                <div class="form-actions">
                                    <input type="hidden" class="gl_wrapper_type_type"
                                           name="wrapper_types">
                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_wrapper_type_submit">Submit</button>
                                </div>
                            </form> 

                            <?php
                        }
                        ?>


                        <?php
                        if ($this->uri->segment(4) == 'date_formates') {
                            ?>


                            <form  id="wizard" class="gl_date_formates gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/date_formates'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Date Format Settings</span>
                                    </h4>
                                </div>
                                <div class="gl_date_formates_wrapper">

                                    <?php
                                    $date_formates = json_decode($option_row->date_formates, true);

                                    if (!empty($date_formates)) {

                                        foreach ($date_formates as $date_formate) {
                                            $date_formate_datas["data_date_formate_id"] = $date_formate['data_date_formate_id'];
                                            $date_formate_datas["data_date_formate_key"] = $date_formate['data_date_formate_key'];
                                            $date_formate_datas["data_date_formate_label"] = $date_formate['data_date_formate_label'];

                                            $date_formate_datas["data_date_formate_status"] = $date_formate['data_date_formate_status'];


                                            $this->load->view("include/date_formates", $date_formate_datas);
                                        }
                                    } else {
                                        $this->load->view("include/date_formates");
                                    }
                                    ?>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_date_formate_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>




                                <div class="form-actions">
                                    <input type="hidden" class="gl_date_formate_type"
                                           name="date_formates">
                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_date_formate_submit">Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?> 


                        <?php
                        if ($this->uri->segment(4) == 'element_main_types') {
                            ?>

                            <form  id="wizard" class="gl_element_main_types gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/element_main_types'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Element Main Types Settings</span>
                                    </h4>
                                </div>
                                <div class="gl_element_main_types_wrapper">

                                    <?php
                                    $element_main_types = json_decode($option_row->element_main_types, true);

                                    if (!empty($element_main_types)) {

                                        foreach ($element_main_types as $element_main_type) {
                                            $element_main_type_datas["data_element_main_type_id"] = $element_main_type['data_element_main_type_id'];
                                            $element_main_type_datas["data_element_main_type_key"] = $element_main_type['data_element_main_type_key'];
                                            $element_main_type_datas["data_element_main_type_label"] = $element_main_type['data_element_main_type_label'];

                                            $element_main_type_datas["data_element_main_type_status"] = $element_main_type['data_element_main_type_status'];


                                            $this->load->view("include/element_main_types", $element_main_type_datas);
                                        }
                                    } else {
                                        $this->load->view("include/element_main_types");
                                    }
                                    ?>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_element_main_type_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>




                                <div class="form-actions">
                                    <input type="hidden" class="gl_element_main_type_type"
                                           name="element_main_types">
                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_element_main_type_submit">Submit</button>
                                </div>
                            </form> 

                            <?php
                        }
                        ?> 


                        <?php
                        if ($this->uri->segment(4) == 'element_type_value_combos') {
                            ?>                       

                            <form  id="wizard" class="gl_element_type_value_combos gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/element_type_value_combos'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Element Type & Value Combo</span>
                                    </h4>
                                </div>
                                <div class="gl_element_type_value_combos_wrapper">

                                    <?php
                                    $element_type_value_combos = json_decode($option_row->element_type_value_combos, true);


                                    $element_list_array = json_decode($option_row->element_box_values, TRUE);

                                    if (!empty($element_list_array)) {
                                        foreach ($element_list_array as $list) {
                                            ?>


                                            <div class="form-row row-fluid gl_element_type_value_combo_item ">
                                                <div class="span12">
                                                    <div class="row-fluid">

                                                        <div class="span6" style="margin-right:1%;">
                                                            <div class="row-fluid">


                                                                <select name="element_combo_value_id"
                                                                        class="gl_element_combo_value_id"  style="width:200px;" >

                                                                    <option  value="<?php echo $list; ?>" ><?php echo $list; ?></option>

                                                                </select>            


                                                            </div>
                                                        </div>


                                                        <div class="span6">
                                                            <div class="row-fluid">




                                                                <select name="element_combo_type_id"
                                                                        class="gl_element_combo_type_id"  style="width:200px;" >

                                                                    <option value="" >Select Element Types</option> 
                                                                    <?php
                                                                    $element_main_types = json_decode($option_row->element_main_types, TRUE);

                                                                    if (!empty($element_main_types)) {
                                                                        foreach ($element_main_types as $element_main_type_row) {
                                                                            if ($element_main_type_row['data_element_main_type_status'] == 'active') {
                                                                                ?>
                                                                                <option 

                                                                                    <?php
                                                                                    if (isset($element_type_value_combos[$list])) {
                                                                                        if ($element_type_value_combos[$list] == $element_main_type_row['data_element_main_type_key']) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>


                                                                                    value="<?php echo $element_main_type_row['data_element_main_type_key']; ?>"><?php echo $element_main_type_row['data_element_main_type_key']; ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>


                                                                </select>    

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <?php
                                        }
                                    }
                                    ?>


                                </div>




                                <div class="form-actions">
                                    <input type="hidden" class="gl_element_type_value_combo_type"
                                           name="element_type_value_combos">
                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_element_type_value_combo_submit">Submit</button>
                                </div>
                            </form> 

                            <?php
                        }
                        ?>      



                        <?php
                        if ($this->uri->segment(4) == 'cms_category_fixed_page') {


                            $fixed_page_type = '';
                            if (isset($_GET['key'])) {
                                $fixed_page_type = $_GET['key'];
                            }

                            $fixed_theme_page_array = json_decode($this->common_model->option->fixed_page_data, TRUE);
                            $fixed_page_data_key_array = $fixed_theme_page_array[$fixed_page_type];

//
                            $cms_category_fixed_page_array = $this->common_model->option->cms_category_fixed_page;

                            if (!empty($cms_category_fixed_page_array)) {

                                $cms_category_fixed_page_array = json_decode($cms_category_fixed_page_array, TRUE);

                                $cms_category_fixed_page_array = $cms_category_fixed_page_array[$fixed_page_type];
                            }
//
                            //
$cms_category_fixed_page_data = $this->common_model->option->cms_category_fixed_page_data;



                            $cms_category_fixed_page_data = json_decode($cms_category_fixed_page_data, TRUE);

                            $cms_category_fixed_page_data = $cms_category_fixed_page_data[$fixed_page_type];


                            if (empty($cms_category_fixed_page_data)) {
                                $cms_category_fixed_page_data = array('1');
                            }

//
                            ?>


                            <form  id="wizard" class="gl_cms_category_fixed_page gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/cms_category_fixed_page'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>CMS Category Fixed Page Assigning</span>
                                    </h4>
                                </div>
                                <div class="gl_cms_categiory_theme_wrapper">
                                    <?php
                                    foreach ($cms_category_fixed_page_data as $category_page_row) {

                                        $data_cms_category = array();
                                        if (isset($category_page_row['data_cms_category'])) {
                                            $data_cms_category = $category_page_row['data_cms_category'];
                                        }

                                        $data_fixed_theme = array();
                                        if (isset($category_page_row['data_fixed_theme'])) {
                                            $data_fixed_theme = $category_page_row['data_fixed_theme'];
                                        }
                                        ?>                          
                                        <div class="form-row row-fluid gl_cms_categiory_theme_item">
                                            <div class="span12">
                                                <div class="row-fluid">

                                                    <?php
                                                    $content_category_full_list = $this->common_model->show_dynamic_category_maincat(0);
                                                    ?>

                                                    <div class="span8" style="margin-right:1%;">
                                                        <div class="row-fluid">
                                                            <label class="form-label span4">CMS Category</label>
                                                            <div class="span12 controls gl_cms_category_div">   
                                                                <select class="gl_cms_category gl_singleselect2 nostyle" 
                                                                        name="cms_category[]" multiple>
                                                                    <option value="" >--Select--</option>

                                                                    <?php
                                                                    foreach ($content_category_full_list as $clist) {
                                                                        ?>
                                                                        <option 
                                                                            value="<?php echo $clist['id']; ?>" <?php
                                                                            if (in_array($clist['id'], $data_cms_category)) {
                                                                                echo 'selected';
                                                                            }
                                                                            ?> 
                                                                            ><?php echo $clist['name']; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="span4">
                                                        <div class="row-fluid">

                                                            <div class="row-fluid">





                                                                <div class="span12 gl_cms_category_fixed_theme_page_wrpr">  

                                                                    <label class="form-label span6" for="">Fixed Page Themes</label>

                                                                    <div class="span12 gl_cms_category_fixed_theme_page_div">

                                                                        <select name="cms_category_fixed_theme_page" class="gl_cms_category_fixed_theme_page">


                                                                            <option value="">--Select Theme--</option>
                                                                            <?php foreach ($fixed_page_data_key_array as $fixed_data_type1) { ?> 
                                                                                <option value="<?php echo $fixed_data_type1["theme_value"]; ?>" 

                                                                                        <?php
                                                                                        if ($data_fixed_theme == $fixed_data_type1["theme_value"]) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                        ?>
                                                                                        ><?php echo $fixed_data_type1["theme_value"]; ?></option>
                                                                                    <?php } ?>                                          
                                                                        </select>
                                                                    </div> 

                                                                </div>  

                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <a href="javascript:void(0)" 
                                               style="margin-right:60px;margin-top:10px;"
                                               class="gl_cms_category_fixed_theme_remove2 right btn btn-mini btn-danger">Remove</a>
                                        </div> 
                                        <?php
                                    }
                                    ?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_cms_category_theme_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>

                                <input type="hidden" class="gl_cms_category_fixed_theme_value" name="cms_category_fixed_theme_value">


                                <input class="span6 gl_page_type_value"  id="page_type_value" type="hidden" name="page_type_value" value="<?php echo $fixed_page_type; ?>" >


                                <div class="form-actions">

                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_cms_category_fixed_theme_submit">Submit</button>
                                </div>
                            </form> 

                            <?php
                        }
                        ?>



                        <!--{sbn} code-->


                        <?php
                        if ($this->uri->segment(4) == 'language_setting') {
                            ?>


                            <form  id="wizard" class="gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/language_setting'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Language Settings</span>
                                    </h4>
                                </div>
                                <div class="gl_language_wrapper">

                                    <?php
                                    $languages = json_decode($option_row->language_type, true);
                                    if (!empty($languages)) {

                                        foreach ($languages as $language) {

                                            $data_language['language'] = $language['language'];
                                            $data_language['language_class'] = $language['language_class'];
                                            $this->load->view("include/language", $data_language);
                                        }
                                    } else {
                                        $this->load->view("include/language");
                                    }
                                    ?>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_language_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>




                                <div class="form-actions">
                                    <input type="hidden" class="gl_language_type"
                                           name="language_type">
                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_language_submit">Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>                    

                        <?php
                        if ($this->uri->segment(4) == 'language_column_assign') {
                            ?>


                            <form  id="wizard" class="gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/language_column_assign'; ?>" method="post" enctype="multipart/form-data" >
                                <?php
                                $language_postion = 0;
                                if (isset($_GET['position'])) {
                                    $language_postion = $_GET['position'];
                                }
                                $languages = json_decode($option_row->language_type, true);
                                $language_array = $languages[$language_postion];
                                $activated_language = $language_array['language'];
                                ?>

                                <div class="title">
                                    <h4> 
                                        <span><?php echo ucwords($activated_language); ?> Language Column Settings</span>
                                    </h4>
                                </div>
                                <div class="gl_language_column_wrapper">
                                    <?php
                                    $language_column_group = $option_row->admin_purpose_language;
                                    $language_column_group = json_decode($language_column_group, TRUE);
                                    if (!empty($language_column_group[$activated_language])) {

                                        $current_lang_set = $language_column_group[$activated_language];
                                        foreach ($current_lang_set as $language_column_key => $language_column) {

                                            $data['language_column_key'] = $language_column_key;
                                            $data['lang_table'] = $language_column['lang_table'];
                                            $data['lang_column'] = $language_column['lang_column'];
                                            $data['lang_to_column'] = $language_column['lang_to_column'];

                                            $this->load->view("include/language_column", $data);
                                        }
                                    } else {
                                        $data['language_column_key'] = 1;
                                        $data['lang_table'] = '';
                                        $data['lang_column'] = '';
                                        $data['lang_to_column'] = '';
                                        $this->load->view("include/language_column", $data);
                                    }
                                    ?>
                                    <input type="hidden" class="gl_activated_language" name="activated_language" value="<?php echo $activated_language; ?>" name="activated_language">
                                    <input type="hidden" class="gl_language_column_set" name="language_column_set">

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_language_column_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="hidden" class="gl_language_column"
                                           name="language_column">
                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_language_column_submit">Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>       

                        
                              <?php
                        if ($this->uri->segment(4) == 'fixed_value_setting') {
                            ?>


                            <form  id="wizard" class="gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/fixed_value_setting'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Fixed Value Setting</span>
                                    </h4>
                                </div>
                                <div class="gl_fixed_value_wrapper">

                                    <?php
                                    $fixed_values = json_decode($option_row->fixed_value_set, true);
                                    if (!empty($fixed_values)) {

                                        foreach ($fixed_values as $fixed_value) {

                                            $data_fixed_value['fixed_value'] = $fixed_value['fixed_value'];
                                            $data_fixed_value['fixed_value_status'] = $fixed_value['status'];
                                            $data_fixed_value['fixed_value_key'] = $fixed_value['value_key'];
                                            $this->load->view("include/fixed_value", $data_fixed_value);
                                        }
                                    } else {
                                        $data_fixed_value['fixed_value'] ='';
                                            $data_fixed_value['fixed_value_status'] = '';
                                            $data_fixed_value['fixed_value_key'] = '';
                                        $this->load->view("include/fixed_value",$data_fixed_value);
                                    }
                                    ?>
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_fixed_value_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>




                                <div class="form-actions">
                                    <input type="hidden" class="gl_fixed_value_set"
                                           name="fixed_value">
                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_fixed_value_submit">Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?> 
                        
                                     <?php
                        if ($this->uri->segment(4) == 'fixed_value_language') {
                            ?>


                            <form  id="wizard" class="gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/fixed_value_language'; ?>" method="post" enctype="multipart/form-data" >
 <?php
                                $language_postion = 0;
                                if (isset($_GET['position'])) {
                                    $language_postion = $_GET['position'];
                                }
                                $languages = json_decode($option_row->language_type, true);
                                $language_array = $languages[$language_postion];
                                $activated_language = $language_array['language'];
                                ?>
                                <div class="title">
                                    <h4> 
                                        <span><?php echo ucwords($activated_language); ?> Language Fixed Value Setting</span>
                                    </h4>
                                </div>
                                <div class="gl_fixed_value_language_wrapper">

                                    <?php
                                    $data_fixed_value['fixed_value_set']=$fixed_value_set = json_decode($option_row->fixed_value_set, true);                           

                                    $fixed_value_languages = json_decode($option_row->fixed_value_language_set, true);
                    
                                    if (!empty($fixed_value_languages[$activated_language])) {

                                        $fixed_value_languages = $fixed_value_languages[$activated_language];
                                         foreach ($fixed_value_languages as $fixed_value) {

                                            $data_fixed_value['fixed_value_item'] = $fixed_value['fixed_value'];
                                            $data_fixed_value['fixed_value_text'] = $fixed_value['fixed_value_text'];
                                            $this->load->view("include/fixed_value_language", $data_fixed_value);
                                        }
                                    } else {
                                        
                                        $data_fixed_value['fixed_value_item'] = '';
                                        $data_fixed_value['fixed_value_text'] = '';
                                        $this->load->view("include/fixed_value_language",$data_fixed_value);
                                    }
                                    ?>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_fixed_language_value_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>


<input type="hidden" class="gl_activated_language" name="activated_language" value="<?php echo $activated_language; ?>" name="activated_language">

                                <div class="form-actions">
                                    <input type="hidden" class="gl_fixed_language_value_set"
                                           name="fixed_language_value">
                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_fixed_language_value_submit">Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?> 
                        
                        
                        
                        
                         <?php
                        if ($this->uri->segment(4) == 'shortcut_setting') {
                            ?>


                            <form  id="wizard" class="gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/shortcut_setting'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Shortcut Value Setting</span>
                                    </h4>
                                </div>
                                <div class="gl_short_cut_value_wrapper">


<div class="sort-layout">
<div class="row-fluid">
<div class="span12">
                                    <?php
                                    $shortcut_data = json_decode($option_row->shortcut_value_set, true);
//                                    dump($shortcut_data);
                                    if (!empty($shortcut_data)) {

                                        foreach ($shortcut_data as $shortcut_value) {

                                            $data_shortcut_value['shortcut_value'] = $shortcut_value['shortcut_value'];
                                            $data_shortcut_value['shortcut_url'] = $shortcut_value['shortcut_url'];
                                            $data_shortcut_value['status'] = $shortcut_value['status'];
                                            $data_shortcut_value['value_key'] = $shortcut_value['value_key'];
                                            $this->load->view("include/short_cut_view", $data_shortcut_value);
                                        }
                                    } else {

                                        $this->load->view("include/short_cut_view",$data_shortcut_value);
                                    }
                                    ?>
</div>
</div>
</div>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_short_cut_value_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>




                                <div class="form-actions">
                                    <input type="hidden" class="gl_short_cut_value_set"
                                           name="shortcut_value_set">
                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_short_cut_value_submit">Submit</button>
                                </div>
                            </form>
                            

                            <?php
                        }
                        ?>
                        
                        

						<?php
                        if ($this->uri->segment(4) == 'css_file_setting') {
                            ?>                     

                           <form  id="wizard" class="gl_css_file_setting gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/css_file_setting'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Css File Settings</span>
                                    </h4>
                                </div>
                                <div class="gl_css_file_setting_wrapper">
                                

<div class="sort-layout">
<div class="row-fluid">
<div class="span12"> 

                                    <?php
                                    $css_file_setting = json_decode($option_row->css_file_setting, true);

                                    if (!empty($css_file_setting)) {

                                        foreach ($css_file_setting as $css_file_setting) {
                                            $slider_datas["data_css_file_setting_id"] = $css_file_setting['data_css_file_setting_id'];
                                            $slider_datas["data_css_file_setting_key"] = $css_file_setting['data_css_file_setting_key'];
                                            $slider_datas["page_css_file_setting_label"] = $css_file_setting['page_css_file_setting_label'];

                                            $slider_datas["quick_status"] = $css_file_setting['quick_status'];


                                            $this->load->view("include/css_file_setting", $slider_datas);
                                        }
                                    } else {
                                        $this->load->view("include/css_file_setting");
                                    }
                                    ?>
                                    
</div>
</div>
</div> 
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_css_file_setting_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>




                                <div class="form-actions">
                                    <input type="hidden" class="css_file_setting_class"
                                           name="css_file_setting">
                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_css_file_setting_submit">Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>  
                        

<?php
                        if ($this->uri->segment(4) == 'js_file_setting') {
                            ?>                     

                           <form  id="wizard" class="gl_js_file_setting gl_form form-horizontal ui-formwizard multiple_upload_form" action="<?php echo base_url() . 'optionadmin/editoption/' . $option_row->id . '/js_file_setting'; ?>" method="post" enctype="multipart/form-data" >


                                <div class="title">
                                    <h4> 
                                        <span>Js File Settings</span>
                                    </h4>
                                </div>
                                <div class="gl_js_file_setting_wrapper">
                                

<div class="sort-layout">
<div class="row-fluid">
<div class="span12"> 

                                    <?php
                                    $js_file_setting = json_decode($option_row->js_file_setting, true);

                                    if (!empty($js_file_setting)) {

                                        foreach ($js_file_setting as $js_file_setting) {
                                            $slider_datas["data_js_file_setting_id"] = $js_file_setting['data_js_file_setting_id'];
                                            $slider_datas["data_js_file_setting_key"] = $js_file_setting['data_js_file_setting_key'];
                                            $slider_datas["page_js_file_setting_label"] = $js_file_setting['page_js_file_setting_label'];

                                            $slider_datas["quick_status"] = $js_file_setting['quick_status'];


                                            $this->load->view("include/js_file_setting", $slider_datas);
                                        }
                                    } else {
                                        $this->load->view("include/js_file_setting");
                                    }
                                    ?>
                                    
</div>
</div>
</div> 
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <a href="javascript:void(0)" 
                                                       class="btn btn-primary btn-mini 
                                                       gl_js_file_setting_add_more" 
                                                       style="float: right;">Add More</a>
                                                </div>
                                            </div> 
                                        </div>                                      
                                    </div>
                                </div>




                                <div class="form-actions">
                                    <input type="hidden" class="js_file_setting_class"
                                           name="js_file_setting">
                                    <button type="submit" class="btn btn-info
                                            showhide-btn pull-right 
                                            gl_js_file_setting_submit">Submit</button>
                                </div>
                            </form>

                            <?php
                        }
                        ?>                          
                        
                        
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End .box -->
            </div><!-- End .span6 --><!-- End .span6 --><!-- End .span6 -->
        </div><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid -->



    </div><!-- End contentwrapper -->
</div>


<!--error class check all, tree start-->

<!--position: relative;margin-right: 5px;width: 19px;height: 19px;display: inline-block;
    vertical-align: middle;margin: 0;
    padding: 0;
    zoom: 1;-->
<script type="text/javascript" src="<?php echo base_url() . 'static/'; ?>adminpanel/js/jquery.sortable.js"></script>

<script type="text/javascript">



//result_row_variable starts
                                        $(document).ready(function () {

                                            var first_a = $(".data_value_key10").first();
                                            var firsta_a = first_a.find('a[class~="remove_source10"]');
                                            firsta_a.hide();

                                            var wrapper_a = $("#main_key10"); //Fields wrapper   

                                            $("#add_key10").click(function (e)
                                            {
                                                e.preventDefault();
                                                var current = $(".data_value_key10").last();
                                                var cloned = current.clone();
                                                cloned.find('input,text').val('');
                                                cloned.find('a[class~="remove_source10"]').show();

                                                cloned.insertAfter(current);

                                                var first = $(".data_value_key10").first();
                                                first.find('a[class~="remove_source10"]').hide();

                                            });
                                            $(wrapper_a).on("click", ".remove_source10", function (e) { //user click on remove text
                                                e.preventDefault();
                                                $(this).parent('div').parent('div').parent('div').remove();
                                            });
                                            $('.gl_result_row').on('click', '.gl_result_row_variable_submit', function () {

                                                var result_row_variable_json = [];
                                                $("#main_key10 div.data_value_key10").each(function () {

                                                    var result_row_variable = $(this).find('.gl_result_row_variable').val();
                                                    result_row_variable_json.push({result_row_variable: result_row_variable});
                                                });
                                                document.getElementById("gl_result_row_variable_json").value = JSON.stringify(result_row_variable_json);
                                            });
                                        });
                                        $('#main_key10').on('keyup', '.gl_result_row_variable', function () {
                                            var string = $(this).val();
                                            var string = string.replace(/[^a-zA-Z0-9]/g, '_');
                                            var string = string.replace(/\-+/g, '_');
                                            var string = string.toLowerCase();
                                            $(this).val(string.trim());
                                        });
//result_row_variable ends


//file upload type starts
                                        $(document).ready(function () {

                                            var first_a = $(".data_value_key9").first();
                                            var firsta_a = first_a.find('a[class~="remove_source9"]');
                                            firsta_a.hide();

                                            var wrapper_a = $("#main_key9"); //Fields wrapper   

                                            $("#add_key9").click(function (e)
                                            {
                                                e.preventDefault();
                                                var current = $(".data_value_key9").last();
                                                var cloned = current.clone();
                                                cloned.find('input,text').val('');
                                                cloned.find('a[class~="remove_source9"]').show();

                                                cloned.insertAfter(current);

                                                var first = $(".data_value_key9").first();
                                                first.find('a[class~="remove_source9"]').hide();

                                            });
                                            $(wrapper_a).on("click", ".remove_source9", function (e) { //user click on remove text
                                                e.preventDefault();
                                                $(this).parent('div').parent('div').parent('div').remove();

                                            });
                                            $('.gl_file_upload_type').on('click', '.gl_file_upload_type_submit', function () {

                                                var file_upload_type_json = [];
                                                $("#main_key9 div.data_value_key9").each(function () {

                                                    var file_upload_type = $(this).find('.gl_file_upload_type').val();
                                                    file_upload_type_json.push({file_upload_type: file_upload_type});
                                                });
                                                document.getElementById("gl_file_upload_type_json").value = JSON.stringify(file_upload_type_json);
                                            });
                                        });
                                        $('#main_key9').on('keyup', '.gl_file_upload_type', function () {
                                            var string = $(this).val();
                                            var string = string.replace(/[^a-zA-Z0-9]/g, '_');
                                            var string = string.replace(/\-+/g, '_');
                                            var string = string.toLowerCase();
                                            $(this).val(string.trim());
                                        });
//file upload type ends


//featurebox predefined box starts
                                        $(document).ready(function () {

                                            var first_a = $(".data_value_key8").first();
                                            var firsta_a = first_a.find('a[class~="remove_source8"]');
                                            firsta_a.hide();

                                            var wrapper_a = $("#main_key8"); //Fields wrapper   

                                            $("#add_key8").click(function (e)
                                            {
                                                e.preventDefault();

                                                var current = $(".data_value_key8").last();
                                                var cloned = current.clone();
                                                cloned.find('input,textarea').val('');
                                                cloned.find('a[class~="remove_source8"]').show();


                                                cloned.insertAfter(current);

                                                var first = $(".data_value_key8").first();
                                                first.find('a[class~="remove_source8"]').hide();

                                            });

                                            $(wrapper_a).on("click", ".remove_source8", function (e) { //user click on remove text
                                                e.preventDefault();
                                                $(this).parent('div').parent('div').parent('div').remove();

                                            });

                                            $('.gl_predefined_box').on('click', '.gl_predefined_box_submit', function () {

                                                var predefined_box_json = [];

                                                $("#main_key8 div.data_value_key8").each(function () {

                                                    var predefined_box_label = $(this).find('.gl_predefined_box_label').val();
                                                    var predefined_box = $(this).find('.gl_predefined_box').val();

                                                    predefined_box_json.push({predefined_box_label: predefined_box_label, predefined_box: predefined_box});
                                                });
                                                document.getElementById("gl_predefined_box_json").value = JSON.stringify(predefined_box_json);
                                            });
                                        });
                                        $('#main_key8').on('keyup', '.gl_predefined_box', function () {

                                            var string = $(this).val();
                                            var string = string.replace(/[^a-zA-Z0-9]/g, '_');
                                            var string = string.replace(/\-+/g, '_');
                                            var string = string.toLowerCase();
                                            $(this).val(string.trim());
                                        });
//featurebox predefined box ends





                                        $('.gl_prod_type_fixed_page').on('click', '.gl_prod_type_fixed_page_button', function () {

                                            var fixed_prod_data_type = $(".gl_fixed_prod_data_type:checked").val();

                                            var fixed_data_json = [];
                                            var prod_type_fixed_page = {};

                                            $(".gl_prod_type_fixed_page .gl_fixed_prod_data_wrp").each(function () {

                                                var prod_type_value = $(this).find('.gl_prod_type_value').val();
                                                var fixed_prod_type_page_theme = $(this).find('.gl_fixed_prod_type_page_theme option:selected').val();

                                                fixed_data_json.push({theme_value: prod_type_value, theme_page: fixed_prod_type_page_theme});
                                            });

                                            prod_type_fixed_page[fixed_prod_data_type] = fixed_data_json;
                                            document.getElementById("gl_prod_type_fixed_page_json").value = JSON.stringify(prod_type_fixed_page);


                                            var bb = JSON.stringify(prod_type_fixed_page);
                                            console.log(bb);
//console.log(fixed_data_json);
//return false;
                                        });




//structure file include starts
                                        $(document).ready(function () {

                                            var first_a = $(".data_value_key7").first();
                                            var firsta_a = first_a.find('a[class~="remove_source7"]');
                                            firsta_a.hide();

                                            var wrapper_a = $("#main_key7"); //Fields wrapper   

                                            $("#add_key7").click(function (e)
                                            {
                                                e.preventDefault();

                                                var current = $(".data_value_key7").last();
                                                var cloned = current.clone();
                                                cloned.find('input,textarea').val('');
                                                cloned.find('a[class~="remove_source7"]').show();
                                                cloned.find('label[class~="key_feature_labe7"]').text('');


                                                cloned.insertAfter(current);

                                                var first = $(".data_value_key7").first();
                                                first.find('a[class~="remove_source7"]').hide();

                                            });

                                            $(wrapper_a).on("click", ".remove_source7", function (e) { //user click on remove text
                                                e.preventDefault();
                                                $(this).parent('div').parent('div').parent('div').remove();

                                            });

                                            $('.gl_structure_file_include').on('click', '.gl_structure_file_include_submit', function () {

                                                var structure_file_include_json = [];

                                                $("#main_key7 div.data_value_key7").each(function () {

                                                    var structure_file_include_label = $(this).find('.gl_structure_file_include_label').val();
                                                    var structure_file_include = $(this).find('.gl_structure_file_include').val();

                                                    structure_file_include_json.push({structure_file_include_label: structure_file_include_label, structure_file_include: structure_file_include});

                                                });
                                                document.getElementById("gl_structure_file_include_json").value = JSON.stringify(structure_file_include_json);
                                            });
                                        });
                                        $('#main_key7').on('keyup', '.gl_structure_file_include', function () {

                                            var string = $(this).val();
                                            var string = string.replace(/[^a-zA-Z0-9]/g, '_');
                                            var string = string.replace(/\-+/g, '_');
                                            var string = string.toLowerCase();
                                            $(this).val(string.trim());
                                        });
//structure file include ends



                                        //return type start
                                        $(document).ready(function () {

                                            var first_a = $(".data_value_key6").first();
                                            var firsta_a = first_a.find('a[class~="remove_source6"]');
                                            firsta_a.hide();

                                            var wrapper_a = $("#main_key6"); //Fields wrapper   

                                            $("#add_key6").click(function (e)
                                            {
                                                e.preventDefault();
                                                var newid = 1;
                                                $("#main_key6 div.data_value_key6").each(function () {
                                                    if (parseInt($(this).data("id")) > newid) {
                                                        newid = parseInt($(this).data("id"));
                                                    }
                                                    newid++;
                                                    //debugger;
                                                });


                                                var current = $(".data_value_key6").last();
                                                var cloned = current.clone();
                                                cloned.find('input,textarea').val('');
                                                cloned.find('a[class~="remove_source6"]').show();
                                                cloned.find('label[class~="key_feature_labe6"]').text('');
                                                cloned.attr("id", newid);

                                                cloned.insertAfter(current);

                                                var first = $(".data_value_key6").first();
                                                first.find('a[class~="remove_source6"]').hide();

                                            });

                                            $(wrapper_a).on("click", ".remove_source6", function (e) { //user click on remove text
                                                e.preventDefault();
                                                $(this).parent('div').parent('div').parent('div').remove();

                                            });

                                            $('.gl_return_type').on('click', '.gl_return_type_submit', function () {

                                                var return_type_json = [];

                                                $("#main_key6 div.data_value_key6").each(function () {

                                                    var return_type_label = $(this).find('.gl_return_type_label').val();
                                                    var return_type = $(this).find('.gl_return_type').val();

                                                    return_type_json.push({return_type_label: return_type_label, return_type: return_type});

                                                });
                                                document.getElementById("gl_return_type_json").value = JSON.stringify(return_type_json);
                                            });
                                        });

                                        $('#main_key6').on('keyup', '.gl_return_type', function () {

                                            var string = $(this).val();
                                            var string = string.replace(/[^a-zA-Z0-9]/g, '_');
                                            var string = string.replace(/\-+/g, '_');
                                            var string = string.toLowerCase();
                                            $(this).val(string.trim());
                                        });
//return type end








                                        $('.gl_file_combo').on('click', '.gl_combo_submit', function () {

                                            var combo_json = {};

                                            $(".gl_combo_set").each(function () {

                                                var upload_type = $(this).find('.gl_file_upload_type').val();
                                                var def_combo = $(this).find('.gl_def_combo :selected').val();

                                                combo_json[upload_type] = def_combo;

                                            });
                                            document.getElementById("gl_combo_json").value = JSON.stringify(combo_json);


                                        });








//        currency part start
                                        $(window).on('load', function () {
                                            $('.gl_currency_default').unwrap();
                                            $('.gl_currency_default').unwrap();


                                            $('.main_key5 .gl_currency_default').each(function () {
                                                if ($(this).is(':checked')) {
//               $(this).siblings('.gl_currency_value').val('1');
                                                    $('.gl_def_text').text('');
                                                    $(this).siblings('.gl_def_text').text('Default');
                                                }
                                            });

                                        });

                                        $('.main_key5').on('keyup', '.gl_currency_value', function () {
//                                        this.value = this.value.replace(/[^\d.]/g, '');
                                            var val = $(this).val();
                                            if (isNaN(val)) {
                                                val = val.replace(/[^0-9\.]/g, '');
                                                if (val.split('.').length > 2)
                                                    val = val.replace(/\.+$/, "");
                                            }
                                            $(this).val(val);

                                        });


                                        $('.main_key5').on('click', '.gl_currency_default', function () {
                                            $(this).siblings('.gl_currency_value').val('1');
                                            $('.gl_currency_value').prop("readonly", false);
                                            $(this).siblings('.gl_currency_value').prop("readonly", true);
                                            $('.gl_def_text').text('');
                                            $(this).siblings('.gl_def_text').text('Default');
                                        });


                                        $(function () {
                                            $('.main_key5').sortable({

                                                start: function () {
//                $('.data_value_key5').css('border', 'none');
                                                    $('.data_value_key5').css('border', '1px dashed #999');
                                                },
                                                stop: function () {
                                                    $('.data_value_key5').css('border', 'none');
                                                },

                                            });
                                        });

                                        var first_a = $(".data_value_key5").first();
                                        var firsta_a = first_a.find('a[class~="remove_source5"]');
                                        firsta_a.hide();

                                        var wrapper_a = $("#main_key5"); //Fields wrapper   

                                        $("#add_key5").click(function (e)
                                        {
                                            e.preventDefault();


                                            var newid = 1;
                                            $("#main_key5 div.data_value_key5").each(function () {
                                                if (parseInt($(this).data("id")) > newid) {
                                                    newid = parseInt($(this).data("id"));
                                                }
                                                newid++;
                                                //debugger;
                                            });



                                            var current = $(".data_value_key5").last();
                                            var cloned = current.clone();
                                            cloned.find('input,text').val('');
                                            cloned.find('a[class~="remove_source5"]').show();
                                            cloned.find('label[class~="key_feature_labe5"]').text('');
                                            cloned.attr("id", newid);
                                            cloned.find('.gl_currency_default').prop("checked", false);
                                            cloned.find('.gl_currency_value').prop("readonly", false);
                                            cloned.find('.gl_def_text').text('');
                                            cloned.insertAfter(current);

                                            var first = $(".data_value_key5").first();
                                            first.find('a[class~="remove_source5"]').hide();


                                        });

                                        $(wrapper_a).on("click", ".remove_source5", function (e) { //user click on remove text
                                            e.preventDefault();
                                            $(this).parent('div').parent('div').parent('div').remove();

                                        });


                                        $('.gl_currency').on('click', '.gl_currency_submit', function () {

                                            currency_json = [];


                                            $("#main_key5 div.data_value_key5").each(function () {

                                                var def_status = 'no';
                                                var icon = $(this).find('.gl_currency_icon').val();
                                                var icon_class = $(this).find('.gl_currency_icon_class').val();
                                                var name = $(this).find('.gl_currency_name').val();
                                                var value = $(this).find('.gl_currency_value').val();
                                                var key = $(this).find('.gl_currency_key').val();
												var price_prefix = $(this).find('.gl_currency_price_prefix').val();
                                                if ($(this).find('.gl_currency_default').is(':checked')) {
                                                    def_status = 'yes';
                                                }

                                                currency_json.push({icon: icon, icon_class: icon_class, name: name, value: value, key: key, def_status: def_status, price_prefix: price_prefix});


                                            });
                                            document.getElementById("gl_currency_json").value = JSON.stringify(currency_json);


                                        });

                                        function save_option_currency() {
                                            var stat = false;
                                            var stat1 = true;
                                            $('.main_key5 .gl_currency_default').each(function () {
                                                if ($(this).is(':checked')) {
                                                    stat = true;
                                                }
                                            });
                                            var currency_key_arr = [];
                                            var gl_currency_key_repeat = '';
                                            $('.main_key5 .gl_currency_key').each(function () {

                                                var gl_currency_key = $(this).val();
                                                if ((jQuery.inArray(gl_currency_key, currency_key_arr) != -1)) {
                                                    stat1 = false;
                                                    gl_currency_key_repeat += gl_currency_key + ', ';
                                                }
                                                currency_key_arr.push(gl_currency_key);
                                            });



                                            if (stat == false) {
                                                $(".gl_def_text:first").text('Default selection is required');
                                                return false;
                                            } else if (stat1 == false) {
                                                alert('Currency keys ' + gl_currency_key_repeat + ' are repeating.');
                                                return false;
                                            } else {
                                                if (confirm("do you really want to submit ?")) {
                                                    return true;
                                                } else {
                                                    return false;
                                                }
                                            }
                                        }

                                        $(document).ready(function () {
                                            $('#combined-picker').datetimepicker({
                                                showSecond: true,
                                                timeFormat: 'hh:mm:ss',
                                                dateFormat: 'dd-mm-yy'
                                            });

                                            $(".date_update_container").hide();

                                            var price_list_date_type_val = $(".price_list_date_type:checked").val();
                                            if (price_list_date_type_val === "custom") {
                                                $(".price_list_updated_datetime_container").show();
                                            } else {
                                                $(".price_list_updated_datetime_container").hide();
                                            }

                                            $(".gl_currency").on("change", ".price_list_change_date", function () {
                                                var price_list_change_date_val = $(".price_list_change_date:checked").val();
                                                if (price_list_change_date_val === "yes") {
                                                    $(".date_update_container").show();
                                                } else {
                                                    $(".date_update_container").hide();
                                                }
                                            });
                                            $(".gl_currency").on("change", ".price_list_date_type", function () {
                                                var price_list_date_type_val = $(".price_list_date_type:checked").val();
                                                if (price_list_date_type_val === "custom") {
                                                    $(".price_list_updated_datetime_container").show();
                                                } else {
                                                    $(".price_list_updated_datetime_container").hide();
                                                }
                                            });

                                        });
//currency part end


                                        function save_class_tree() {

                                            var class_arr = [];
                                            $('.gl_error_report .gl_checkbox').each(function () {

                                                if ($(this).is(':checked')) {

                                                    var new_class_tree = $(this).val();
                                                    class_arr.push(new_class_tree);
                                                }

                                            });
                                            var myJSON = JSON.stringify(class_arr);
                                            $('.error_report_class_json').val(myJSON);
                                            var error_report_class_json = $('.error_report_class_json').val();
                                        }


                                        $(window).on('load', function () {
                                            $('.gl_checkbox').parents('.checker').removeClass('checker');
                                            $('.gl_check_all').parents('.checker').removeClass('checker');



                                        });

                                        $('.gl_error_report').on('change', '.gl_check_all', function () {

                                            $('.gl_checkbox').prop('checked', false);
                                            $('.gl_checkbox').parent().removeClass('checked');
                                            $('.gl_checkbox').parents('.checkbox-inline').removeClass('checked');

                                            if ($(this).is(':checked')) {
                                                $('.gl_checkbox').prop('checked', true);
                                                $('.gl_checkbox').parent().addClass('checked');
                                                $('.gl_checkbox').parents('.checkbox-inline').addClass('checked');
                                            } else {
                                                $('.gl_checkbox').prop('checked', false);
                                                $('.gl_checkbox').parent().removeClass('checked');
                                                $('.gl_checkbox').parents('.checkbox-inline').removeClass('checked');
                                            }
                                        });
                                        $('.gl_error_report').on('change', '.gl_checkbox', function () {

                                            check_all_checking();

                                        });
                                        function check_all_checking() {

                                            var tot_len = $(".gl_checkbox").length;
                                            var tot_checked_len = $(".gl_checkbox:checked").length;

                                            if (tot_len == tot_checked_len) {
                                                $('.gl_check_all').prop('checked', true);
                                                $('.gl_check_all').parent().addClass('checked');
                                                $('.gl_check_all').parents('.checkbox-inline').addClass('checked');
                                            } else {
                                                $('.gl_check_all').prop('checked', false);
                                                $('.gl_check_all').parent().removeClass('checked');
                                                $('.gl_check_all').parents('.checkbox-inline').removeClass('checked');
                                            }
                                        }

                                        $(document).ready(function () {
                                            //When checkboxes/radios checked/unchecked, toggle background color
                                            check_all_checking();
                                            $(".checkbox-inline .check_box").each(function () {
                                                if ($(this).is(':checked')) {
                                                    $(this).parents('.checkbox-inline').addClass('checked');
                                                }
                                            });
                                            $('.gl-columns').on('click', 'input[type=checkbox]', function () {
                                                $(this).closest('.checkbox-inline, .checkbox').toggleClass('checked');
                                            });
                                        });
</script>
<!--error class check all, tree end-->
<!--forcefully file name submission start-->
<script type="text/javascript">

    $('.gl_forcefully').on('click', '.gl_force_submit', function () {

        ajaxindicatorstart('please wait..');

        var forcefully_filename = $('.forcefully_filename').val();
        var option_id = $('.option_id').val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'optionadmin/update_forcefully_file_name'; ?>",
            data: {forcefully_filename: forcefully_filename, option_id: option_id},
            cache: false,
            success: function ()
            {
                ajaxindicatorstop();

                var linkref = '<?php echo base_url(); ?>optionadmin/viewoptions';
                window.location.href = linkref;
            }
        });

    });

</script>
<!--forcefully file name submission end-->
<script type="text/javascript">
    $(document).ready(function () {

//        var page_url1 = window.location;
        //var page_url1 = $(location).attr('href');
        //var page_url = page_url1.split('/').reverse();

        //alert(page_url);

        // $('.gl_form').hide();
        // $('.gl_' + page_url).show();

    });
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

<script type="text/javascript">


    function savejsonOrder() {
//              debugger;
        /* To save Packages and recommended and Key features,FAQ question and answer  in json format */

        saveOrder_key_features();
        saveOrder_key_features1();


        /* EOF To save Packages and recommended  in json format */
    }


    function save_option()
    {
        if (confirm("do you really want to submit ?")) {
            return true;
        } else {
            return false;
        }
    }

    //      file order save function
//    function saveOrder() {
//
////        saveOrder_key_features();
//        checkfilevalidation();
////        routeformdata();
////            savephoneType();
////            saveemailType();
//
//        var new_order = new Array();
//        $('ul#sortable li').each(function () {
//            new_order.push($(this).attr("id"));
//        });
//        document.getElementById("final_images").value = new_order;
//
//
//        checkfilevalidation_b();
//
//        var new_order_b = new Array();
//        $('ul#sortable_b li').each(function () {
//            new_order_b.push($(this).attr("id"));
//        });
//        document.getElementById("final_images_b").value = new_order_b;
////            debugger;
////            bordervalue();
//
//
//
//
//
//        checkfilevalidation_c();
//
//        var new_order_c = new Array();
//        $('ul#sortable_c li').each(function () {
//            new_order_c.push($(this).attr("id"));
//        });
//        document.getElementById("final_images_c").value = new_order_c;
//    }
    //    End of  file order save function    






    function saveOrder_key_features() {

//        debugger;
        var new_order = [];
        $('#main_key div.data_value_key').each(function () {
            hiddeninput_id = $(this).find("input[name^='hiddeninput_id']").val();
            hiddeninput_name = $(this).find("input[name^='hiddeninput_name']").val();
            hiddeninput_class = $(this).find("input[name^='hiddeninput_class']").val();
            hiddeninput_value = $(this).find("input[name^='hiddeninput_value']").val();

            new_order.push({
                hiddeninput_id: hiddeninput_id,
                hiddeninput_name: hiddeninput_name,
                hiddeninput_class: hiddeninput_class,
                hiddeninput_value: hiddeninput_value
            });
        });

        console.log(JSON.stringify(new_order));
        var hiddeninputjson_val = JSON.stringify(new_order);
        document.getElementById("hiddeninputjson").value = hiddeninputjson_val;
//        $("#hiddeninputjson").val(hiddeninputjson_val);
        console.log($("#hiddeninputjson").val());
        //debugger;
    }

    function saveOrder_key_features1() {

//        debugger;
        var new_order1 = [];
        $('#main_key1 div.data_value_key1').each(function () {
            var controller_class_name = $(this).find("input[name^='controller_class_name']").val();

            new_order1.push({controller_class_name: controller_class_name});

        });

//        console.log(JSON.stringify(new_order1));
        var controller_class_name_json_val = JSON.stringify(new_order1);
//        document.getElementById("hiddeninputjson").value = controller_class_name_json_val;
        document.getElementById("controller_class_name_json").value = controller_class_name_json_val;
    }

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
            cloned.find('input,textarea').val('');
            cloned.find('a[class~="remove_source"]').show();
            cloned.find('label[class~="key_feature_label"]').text('');
            cloned.attr("id", newid);
            cloned.insertAfter(current);

            var first = $(".data_value_key").first();
            first.find('a[class~="remove_source"]').hide();


        });

        $(wrapper_a).on("click", ".remove_source", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').remove();

        });

        /*END of For Content title */




        //controller class start


        var first_a1 = $(".data_value_key1").first();
        var firsta_a1 = first_a1.find('a[class~="remove_source1"]');
        firsta_a1.hide();

        var wrapper_a1 = $("#main_key1"); //Fields wrapper   

        $("#add_key1").click(function (e)
        {
            e.preventDefault();


            var newid1 = 1;
            $("#main_key1 div.data_value_key1").each(function () {
                if (parseInt($(this).data("count")) > newid1) {
                    newid1 = parseInt($(this).data("count"));
                }
                newid1++;
                //debugger;
            });



            var current = $(".data_value_key1").last();
            var cloned = current.clone();
            cloned.find('input,text').val('');
            cloned.find('a[class~="remove_source1"]').show();
            cloned.find('label[class~="key_feature_label1"]').text('');
            cloned.data("count", newid1);
            cloned.insertAfter(current);

            var first1 = $(".data_value_key1").first();
            first1.find('a[class~="remove_source1"]').hide();


        });

        $(wrapper_a1).on("click", ".remove_source1", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').remove();

        });


        //controller class end
    });





    $(document).ready(function ()
    {
        /*mail part */
        var first_a = $(".data_value_key4").first();
        var firsta_a = first_a.find('a[class~="remove_source4"]');
        firsta_a.hide();

        var wrapper_a = $("#main_key4"); //Fields wrapper   

        $("#add_key4").click(function (e)
        {
            e.preventDefault();


            var newid = 1;
            $("#main_key4 div.data_value_key4").each(function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
                newid++;
                //debugger;
            });



            var current = $(".data_value_key4").last();
            var cloned = current.clone();
            cloned.find('input,textarea').val('');
            cloned.find('a[class~="remove_source4"]').show();
            cloned.find('label[class~="key_feature_labe4"]').text('');
            cloned.attr("id", newid);
            cloned.insertAfter(current);

            var first = $(".data_value_key4").first();
            first.find('a[class~="remove_source4"]').hide();


        });

        $(wrapper_a).on("click", ".remove_source4", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').remove();

        });

        //mail part end


        $('.gl_mail').on('click', '.gl_mail_submit', function () {

            var mail_json = [];


            $("#main_key4 div.data_value_key4").each(function () {


                var form_type = $(this).find('.gl_form_type').val();
                var to_mail = $(this).find('.gl_to_mail').val();
                var cc_mail = $(this).find('.gl_cc_mail').val();
                var from_mail = $(this).find('.gl_from_mail').val();

                var mail_msg = $(this).find('.gl_mail_msg').val();

                mail_json.push({form_type: form_type, to_mail: to_mail, cc_mail: cc_mail, from_mail: from_mail, mail_msg: mail_msg});

            });
            document.getElementById("gl_mail_json").value = JSON.stringify(mail_json);


        });




    });





    function bordervalue() {

        var new_border = [];
        banner_title_val = $("#banner_title").val();
        banner_description_val = CKEDITOR.instances.banner_description.getData();
        new_border.push({banner_title: banner_title_val, banner_description: banner_description_val});
//        console.log(JSON.stringify(new_border));
        document.getElementById("row_border").value = JSON.stringify(new_border);

    }

</script>

<script type="text/javascript">
    $(function () {

        if ($('#optionsRadios1').is(':checked')) {
            $('#type_link').show();
            $('input[name="extra_link1"]').attr("required", "required");
            $('#type_page').hide();
        }
        if ($('#optionsRadios2').is(':checked')) {
            $('#type_page').show();
            $('#type_link').hide();
            $('input[name="extra_link1"]').removeAttr("required");
        }

        $('input[name="url_type"]').on('click', function () {
            if ($(this).val() == 'internal') {
                $('#type_page').show();
                $('#type_link').hide();
                $('input[name="extra_link1"]').removeAttr("required");
            }
            if ($(this).val() == 'external') {
                $('#type_link').show();
                $('input[name="extra_link1"]').attr("required", "required");
                $('#type_page').hide();
            }
        });
    });
</script>
<!--    file upload js-->





<!--    file_c upload_c js-->             



<script>


    function routeformdata() {

        var form_value = [];
        $('.route_wrapper .route_child').each(function () {

            route_key = $(this).find('.key_child').val();
            route_value = $(this).find('.value_child').val();

            form_value.push({route_key: route_key, route_value: route_value});
        });
//        console.log(JSON.stringify(form_value));
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

<script type="text/javascript">

    $(document).ready(function () {


        $(".gl_update_cache").click(function ()
        {
            $(".startcalculation").fadeIn();

            $.ajax({
                type: "GET",
                url: "<?php echo base_url() . 'optionadmin/update_cache_settings/' . $option_row->id; ?>",
                cache: false,
                success: function (html)
                {
                    console.log(html);
                    $(".cache_date_modified_text").val(html);
                    $(".startcalculation").hide();

                    location.reload();
                }
            });


        });



    });



</script>   






<!--asset data option js start-->



<script type="text/javascript">
    $(function () {

        $('#main_key2').sortable({

            start: function () {
                $('.data_value_key2').css('border', '2px dashed #999');
            },

            stop: function () {
                $('.data_value_key2').css('border', '1.4px solid #ccc');
            },

        });

<?php
if (empty($header_options_meta)) {
    ?>

            var num = 1;
            $('input[name="library_group_' + num + '"]').each(function () {

                if ($(this).val() == 'js' || $(this).val() == 'css') {
                    $('#nonscript_' + num).find("#external_" + num).css('display', 'block');
                    $('#nonscript_' + num).find("#internal_" + num).css('display', 'block');
                    $('#nonscript_' + num).find("#manual_" + num).css('display', 'block');
                }
            });
            $('input[name="type_' + num + '"]').each(function () {
                $('#int_file_' + num).find(".base_show").css('display', 'block');

            });

    <?php
}
?>


        $('.gl_header_asset').on('click', '.library_group', function () {

            $(this).closest('.gl_radio_library').find('.assetradio').removeClass('checked');
            $(this).closest(' .assetradio').addClass('checked');

            var num = $(this).closest('.data_value_key2').attr('data-count2');



            if ($(this).val() == 'js' || $(this).val() == 'css') {
                $('#nonscript_' + num).find("#external_" + num).css('display', 'block');
                $('#nonscript_' + num).find("#internal_" + num).css('display', 'block');
                $('#nonscript_' + num).find("#manual_" + num).css('display', 'block');

                $('#nonscript_' + num).find("input:not(:checked)").closest('.assetradio').removeClass('checked');

            } else if ($(this).val() == 'script' || $(this).val() == 'meta' || $(this).val() == 'metacharset') {

                $('#nonscript_' + num).find("#external_" + num).css('display', 'none');
                $('#nonscript_' + num).find("#internal_" + num).css('display', 'none');
                $('#nonscript_' + num).find("#manual_" + num).css('display', 'block');
                $('#nonscript_' + num).find($("input[name='type_" + num + "']")).prop("checked", "checked");

                $('#nonscript_' + num).find("input[name='type_" + num + "']").closest('.assetradio').addClass('checked');

                $('#int_file_' + num).find(".base_show").css('display', 'none');
            }
        });



        $('.gl_header_asset').on('click', '.type', function () {

            $(this).closest('.gl_radio_type').find('.assetradio').removeClass('checked');
            $(this).closest(' .assetradio').addClass('checked');


            var num = $(this).closest('.data_value_key2').attr('data-count2');

            if ($(this).val() == 'internal') {



                $('#int_file_' + num).find(".base_show").css('display', 'block');

            } else if ($(this).val() == 'external' || $(this).val() == 'manual') {



                $('#int_file_' + num).find(".base_show").css('display', 'none');
            }
        });



    });
</script>

<script type="text/javascript">

    $(document).ready(function ()
    {
        //$('.radio').removeAttr('id');
        var first_a2 = $(".data_value_key2").first();
        var firsta_a2 = first_a2.find('a[class~="remove_source2"]');
        firsta_a2.hide();

        var wrapper_a2 = $("#main_key2"); //Fields wrapper   

        $("#add_key2").click(function (e)
        {
            e.preventDefault();


            var newid = 1;
            var optionid = 0;
            $("#main_key2 div.data_value_key2").each(function () {
                if (parseInt($(this).data("count2")) > newid) {
                    newid = parseInt($(this).data("count2"));
                }
                newid++;
                optionid++
                //debugger;
            });


            var lib_array_length = $('.lib_array_length').val();
            var type_array_length = $('.type_array_length').val();



            var current = $(".data_value_key2").last();
            var cloned = current.clone();
            cloned.attr('class', 'data_value_key2 gl_count_' + newid);
            cloned.attr('data-count2', newid);
            cloned.find('textarea').val("");
            cloned.find('input[type=radio]').removeAttr('checked');
            cloned.find('label').removeClass('checked');
            cloned.find('input[type=hidden]').val('');
            cloned.find('.gl_asset_active').hide();


            $("input[name='library_group_" + optionid + "']", cloned).prop('name', 'library_group_' + newid);
            $("input[name='type_" + optionid + "']", cloned).prop("name", "type_" + newid);

            for (var i = 0; i < lib_array_length; i++)
            {
                var label_for = $("input[id='library_group" + i + optionid + "']").attr('id');

                $("input[id='library_group" + i + optionid + "']", cloned).prop('id', 'library_group' + i + newid)

                $('label[for=' + label_for + ']', cloned).prop('for', 'library_group' + i + newid);
            }



            for (var i = 0; i < type_array_length; i++)
            {
                var label_for = $("input[id='type" + i + optionid + "']").attr('id');

                $("input[id='type" + i + optionid + "']", cloned).prop('id', 'type' + i + newid)

                $('label[for=' + label_for + ']', cloned).prop('for', 'type' + i + newid);
            }







            $("input[name='page_" + optionid + "']", cloned).prop("name", "page_" + newid);
            $("textarea[name='int_link_" + optionid + "']", cloned).prop("name", "int_link_" + newid);
            $("#nonscript_" + optionid, cloned).prop("id", "nonscript_" + newid);
            $("#internal_" + optionid, cloned).prop("id", "internal_" + newid);
            $("#external_" + optionid, cloned).prop("id", "external_" + newid);
            $("#manual_" + optionid, cloned).prop("id", "manual_" + newid);

            $("#int_file_" + optionid, cloned).prop("id", "int_file_" + newid);



            cloned.find('a[class~="remove_source2"]').show();
            cloned.find('a[class~="remove_source2"]').attr('data-option', '');
//            cloned.find('.radio').attr('id');
//            cloned.attr("id", newid);

            cloned.find('.radio').data('count2');
            cloned.data("count2", newid);

            cloned.insertAfter(current);

            var first = $(".data_value_key2").first();
            first.find('a[class~="remove_source2"]').hide();


        })




        //});

        $(wrapper_a2).on("click", ".remove_source2", function (e) { //user click on remove text
            e.preventDefault();


            var opt_id = $(this).attr('data-option');
            if (opt_id != '')
            {
                if (confirm("Do you really want to Delete ?")) {
                    ajaxindicatorstart('please wait..');
                    $.ajax({

                        url: "<?php echo base_url(); ?>optionadmin/deleteoptionmeta",
                        type: "post",
                        data: {opt_id: opt_id},
                        success: function ()
                        {
                            ajaxindicatorstop();
                            $.pnotify({
                                type: 'success',
                                title: 'Deleted Successfully',
                                text: '',
                                icon: 'picon icon16 iconic-icon-check-alt white',
                                opacity: 0.95,
                                history: false,
                                sticker: false
                            });

                            //alert("deleted successfull");
                            //location.reload(true);
                        }


                    })
                    $(this).closest(".data_value_key2").remove();

                }

            } else
            {
                $(this).closest(".data_value_key2").remove();
            }
        });
    });
    function save_order_asset()
    {
        var header_json = [];
        var filepath1 = "";
        var order_no = 1;

        $("#main_key2 div.data_value_key2").each(function () {
            var data_key = $(this).data('count2');
            var metaid = $('.gl_count_' + data_key).find('input[name^="metaid"]').val();

            var page = 'header';
            var library = $(this).find('input[name^="library_group_' + data_key + '"]:checked').val();
            var type = $(this).find('input[name^="type_' + data_key + '"]:checked').val();
            $(this).find('#int_file_' + data_key).each(function () {
                var path2 = $(this).find('textarea[name^="int_link_' + data_key + '"]').val();
                if (path2 != " ")
                {
                    filepath1 = path2.replace(/"/g, "'");
                }
            })


            header_json.push({metaid: metaid, page: page, library: library, type: type, filepath: filepath1, order_no: order_no});
            document.getElementById("header_json").value = JSON.stringify(header_json);

            order_no++;
        });
    }


    $('body').on("click", ".gl_asset_active", function (e) { //user click on remove text
        e.preventDefault();

        var opt_id = $(this).attr('data-option');
        var status = $(this).attr('data-status');
        var alert_msg = '';
        if (status == 'a') {
            alert_msg = 'Do you really want to activate ?';
        } else if (status == 'd') {
            alert_msg = 'Do you really want to deactivate ?';
        }
        if (opt_id != '') {
            if (confirm(alert_msg)) {
                ajaxindicatorstart('please wait..');
                $.ajax({
                    url: "<?php echo base_url(); ?>optionadmin/active_optionmeta",
                    type: "post",
                    data: {opt_id: opt_id, status: status},
                    success: function ()
                    {
                        ajaxindicatorstop();
                        $.pnotify({
                            type: 'success',
                            title: 'Edited Successfully',
                            text: '',
                            icon: 'picon icon16 iconic-icon-check-alt white',
                            opacity: 0.95,
                            history: false,
                            sticker: false
                        });

                        var asset_a = '.gl_asseta_' + opt_id;
                        var asset_d = '.gl_assetd_' + opt_id;

                        if (status == 'a') {
                            if (!$(asset_a).hasClass('hide')) {
                                $(asset_a).addClass('hide');
                            }
                            $(asset_d).removeClass('hide');
                        } else if (status == 'd') {
                            if (!$(asset_d).hasClass('hide')) {
                                $(asset_d).addClass('hide');
                            }
                            $(asset_a).removeClass('hide');
                        }

                    }
                });
            }
        }




    });








</script>




<!--footer asset start-->



<script type="text/javascript">
    $(function () {

        $('#main_key3').sortable({

            start: function () {
                $('.data_value_key3').css('border', '2px dashed #999');
            },

            stop: function () {
                $('.data_value_key3').css('border', '1.4px solid #ccc');
            },

        });


<?php
if (empty($footer_options_meta)) {
    ?>

            var num = 1;

            $('input[name="flibrary_group_' + num + '"]').each(function () {

                if ($(this).val() == 'js' || $(this).val() == 'css') {
                    $('#fnonscript_' + num).find("#fexternal_" + num).css('display', 'block');
                    $('#fnonscript_' + num).find("#finternal_" + num).css('display', 'block');
                    $('#fnonscript_' + num).find("#fmanual_" + num).css('display', 'block');
                }
            });
            $('input[name="ftype_' + num + '"]').each(function () {


                $('#fint_file_' + num).find(".fbase_show").css('display', 'block');

            });
    <?php
}
?>


        $('.gl_footer_asset').on('click', '.flibrary_group', function () {


            $(this).closest('.gl_radio_library').find('.assetradio').removeClass('checked');
            $(this).closest(' .assetradio').addClass('checked');


            var num = $(this).closest('.data_value_key3').attr('data-count3');

            if ($(this).val() == 'js' || $(this).val() == 'css') {

                $('#fnonscript_' + num).find("#fexternal_" + num).css('display', 'block');
                $('#fnonscript_' + num).find("#finternal_" + num).css('display', 'block');
                $('#fnonscript_' + num).find("#fmanual_" + num).css('display', 'block');

                $('#fnonscript_' + num).find("input:not(:checked)").closest('.assetradio').removeClass('checked');

            } else if ($(this).val() == 'script' || $(this).val() == 'meta' || $(this).val() == 'metacharset') {

                $('#fnonscript_' + num).find("#fexternal_" + num).css('display', 'none');
                $('#fnonscript_' + num).find("#finternal_" + num).css('display', 'none');
                $('#fnonscript_' + num).find("#fmanual_" + num).css('display', 'block');
                $('#fnonscript_' + num).find($("input[name='ftype_" + num + "']")).prop("checked", "checked");
                $('#fint_file_' + num).find(".fbase_show").css('display', 'none');


                $('#fnonscript_' + num).find("input[name='ftype_" + num + "']").closest('.assetradio').addClass('checked');

            }
        });


        $('.gl_footer_asset').on('click', '.ftype', function () {

            $(this).closest('.gl_radio_type').find('.assetradio').removeClass('checked');
            $(this).closest(' .assetradio').addClass('checked');



            var num = $(this).closest('.data_value_key3').attr('data-count3');
            if ($(this).val() == 'internal') {
                $('#fint_file_' + num).find(".fbase_show").css('display', 'block');

            } else if ($(this).val() == 'external' || $(this).val() == 'manual') {

                $('#fint_file_' + num).find(".fbase_show").css('display', 'none');
            }
        });


    });
</script>

<script type="text/javascript">

    $(document).ready(function ()
    {
        var first_a3 = $(".data_value_key3").first();
        var firsta_a3 = first_a3.find('a[class~="remove_source3"]');
        firsta_a3.hide();

        var wrapper_a3 = $("#main_key3"); //Fields wrapper   

        $("#add_key3").click(function (e)
        {
            e.preventDefault();


            var newid = 1;
            var optionid = 0;
            $("#main_key3 div.data_value_key3").each(function () {
                if (parseInt($(this).data("count3")) > newid) {
                    newid = parseInt($(this).data("count3"));
                }
                newid++;
                optionid++
                //debugger;
            });


            var lib_array_length = $('.lib_array_length').val();
            var type_array_length = $('.type_array_length').val();

            var current = $(".data_value_key3").last();
            var cloned = current.clone();
            cloned.attr('class', 'data_value_key3 gl_count_' + newid);
            cloned.attr('data-count3', newid);

            cloned.find('textarea').val("");
            cloned.find('input[type=radio]').removeAttr('checked');
            cloned.find('label').removeClass('checked');
            cloned.find('input[type=hidden]').val('');
            cloned.find('.gl_asset_active').hide();

            $("input[name='flibrary_group_" + optionid + "']", cloned).prop("name", "flibrary_group_" + newid);
            $("input[name='ftype_" + optionid + "']", cloned).prop("name", "ftype_" + newid);



            for (var i = 0; i < lib_array_length; i++)
            {
                var label_for = $("input[id='flibrary_group" + i + optionid + "']").attr('id');

                $("input[id='flibrary_group" + i + optionid + "']", cloned).prop('id', 'flibrary_group' + i + newid)

                $('label[for=' + label_for + ']', cloned).prop('for', 'flibrary_group' + i + newid);
            }



            for (var i = 0; i < type_array_length; i++)
            {
                var label_for = $("input[id='ftype" + i + optionid + "']").attr('id');

                $("input[id='ftype" + i + optionid + "']", cloned).prop('id', 'ftype' + i + newid)

                $('label[for=' + label_for + ']', cloned).prop('for', 'ftype' + i + newid);
            }


            $("textarea[name='fint_link_" + optionid + "']", cloned).prop("name", "fint_link_" + newid);
            $("#fnonscript_" + optionid, cloned).prop("id", "fnonscript_" + newid);
            $("#finternal_" + optionid, cloned).prop("id", "finternal_" + newid);
            $("#fexternal_" + optionid, cloned).prop("id", "fexternal_" + newid);
            $("#fmanual_" + optionid, cloned).prop("id", "fmanual_" + newid);
            $("#fint_file_" + optionid, cloned).prop("id", "fint_file_" + newid);



            cloned.find('a[class~="remove_source3"]').show();
            cloned.find('a[class~="remove_source3"]').attr('data-option', '');

            cloned.find('.radio').data('count3');
            cloned.data("count3", newid);

            cloned.insertAfter(current);

            var first = $(".data_value_key3").first();
            first.find('a[class~="remove_source3"]').hide();




        })

        $(wrapper_a3).on("click", ".remove_source3", function (e) { //user click on remove text
            e.preventDefault();


            var opt_id = $(this).attr('data-option');
            if (opt_id != '')
            {
                if (confirm("Do you really want to Delete ?")) {
                    ajaxindicatorstart('please wait..');
                    $.ajax({

                        url: "<?php echo base_url(); ?>optionadmin/deleteoptionmeta",
                        type: "post",
                        data: {opt_id: opt_id},
                        success: function ()
                        {
                            ajaxindicatorstop();
                            $.pnotify({
                                type: 'success',
                                title: 'Deleted Successfully',
                                text: '',
                                icon: 'picon icon16 iconic-icon-check-alt white',
                                opacity: 0.95,
                                history: false,
                                sticker: false
                            });

                            //alert("deleted successfull");
                            //location.reload(true);
                        }


                    })
                    $(this).closest(".data_value_key3").remove();

                }

            } else
            {
                $(this).closest(".data_value_key3").remove();
            }
        });
    });
    function footer_save_order_asset()
    {
        var footer_json = [];
        var filepath1 = "";
        var order_no = 1;
        $("#main_key3 div.data_value_key3").each(function () {
            var data_key = $(this).data('count3');
            var metaid = $('.gl_count_' + data_key).find('input[name^="fmetaid"]').val();

//            var page = $(this).find('input[name^="page_' + data_key + '"]:checked').val();
            var page = 'footer';
            var library = $(this).find('input[name^="flibrary_group_' + data_key + '"]:checked').val();
            var type = $(this).find('input[name^="ftype_' + data_key + '"]:checked').val();
            $(this).find('#fint_file_' + data_key).each(function () {
                var path2 = $(this).find('textarea[name^="fint_link_' + data_key + '"]').val();
                if (path2 != " ")
                {
                    filepath1 = path2.replace(/"/g, "'");
                }
            })
            footer_json.push({metaid: metaid, page: page, library: library, type: type, filepath: filepath1, order_no: order_no});
            document.getElementById("footer_json").value = JSON.stringify(footer_json);

            order_no++;

        });

//        console.log(footer_json);

    }



</script>

<!--asset data option js end-->




<!--FOR FHA-->



<script type="text/javascript">
    $(document).ready(function ()
    {
        var first_a = $(".gl_quick_link_element").first();
        var firsta_a = first_a.find('a[class~="gl_quick_remove"]');
        var firsta_b = first_a.find('a[class~="gl_quick_remove2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_quick_link_wrapper");






        $(".gl_quick_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_quick_link_wrapper .gl_quick_link_element").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_quick_link_element").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="quick_link"]').attr('data-key', keyid);
            cloned.find('input[name^="quick_link"]').attr('data-status', "active");
            cloned.find('a[class~="gl_quick_remove"]').show();
            cloned.find('a[class~="gl_quick_remove2"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_quick_link_element").first();
            first.find('a[class~="gl_quick_remove"]').hide();


        });

        $(wrapper_a).on("click", ".gl_quick_remove", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_quick_link").attr('data-status', "deactive");
                $(this).siblings().find(".gl_quick_link").prop('readonly', true);
                $(this).siblings().find(".gl_quick_link_text").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_quick_link").attr('data-status', "active");
                $(this).siblings().find(".gl_quick_link").prop('readonly', false);
                $(this).siblings().find(".gl_quick_link_text").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }

        });
        $(wrapper_a).on("click", ".gl_quick_remove2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_quick_link").attr('data-status', "delete");
            $(this).parent().parent().hide();

        });


        $('body').on('click', '.gl_quick_link_creation', function () {

            var quick_json = [];
            $(".gl_quick_link_wrapper .gl_quick_link_element").each(function () {
                var quick_link = $(this).find('input[name^="quick_link"]').val();
                var quick_key = $(this).find('input[name^="quick_link"]').attr("data-key");
                var quick_status = $(this).find('input[name^="quick_link"]').attr("data-status");
                var quick_link_text = $(this).find('input[name^="quick_link_text"]').val();

                quick_json.push({quick_link: quick_link, quick_link_text: quick_link_text, quick_key: quick_key, quick_status: quick_status});
            });
            $(".gl_quick_link_set").val(JSON.stringify(quick_json));

        });

//
//        $(".gl_quick_link_wrapper").sortable({
//
//            revert: true,
//            start: function () {
//                $('.gl_quick_link_element').css('border', '2px dashed #999');
//            },
//            stop: function () {
//                $('.gl_quick_link_element').css('border', '');
//            }
//
//
//        });

    });



    $(document).ready(function ()
    {
        var first_a = $(".gl_theme_feature_box_element").first();
        var firsta_a = first_a.find('a[class~="gl_theme_feature_box_remove"]');
        var firsta_b = first_a.find('a[class~="gl_theme_feature_box_remove2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_theme_feature_box_wrapper");



        $(".gl_theme_feature_box_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_theme_feature_box_wrapper .gl_theme_feature_box_element").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_theme_feature_box_element").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="theme_feature_box"]').attr('data-key', keyid);
            cloned.find('input[name^="theme_feature_box"]').attr('data-status', "active");
            cloned.find('input[name^="theme_feature_box"]').removeAttr('readonly');
            cloned.find('a[class~="gl_theme_feature_box_remove"]').attr('data-remove', 'Activate');
            cloned.find('a[class~="gl_theme_feature_box_remove"]').text('Deactivate');
            cloned.find('a[class~="gl_theme_feature_box_remove"]').show();
            cloned.find('a[class~="gl_theme_feature_box_remove2"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_theme_feature_box_element").first();
            first.find('a[class~="gl_theme_feature_box_remove"]').hide();


        });

        $(wrapper_a).on("click", ".gl_theme_feature_box_remove", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_theme_feature_box_text").attr('data-status', "deactive");
                $(this).siblings().find(".gl_theme_feature_box_text").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_theme_feature_box_text").attr('data-status', "active");
                $(this).siblings().find(".gl_theme_feature_box_text").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }


        });




        $(wrapper_a).on("click", ".gl_theme_feature_box_remove2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_theme_feature_box_text").attr('data-status', "delete");
            $(this).parent().parent().hide();

        });



        var first_a = $(".gl_theme_feature_box_element_slider").first();
        var firsta_a = first_a.find('a[class~="gl_theme_feature_box_remove_slider"]');
        var firsta_b = first_a.find('a[class~="gl_theme_feature_box_remove_slider2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_theme_feature_box_wrapper_slider");



        $(".gl_theme_feature_box_more_slider").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_theme_feature_box_wrapper_slider .gl_theme_feature_box_element_slider").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_theme_feature_box_element_slider").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="slider_item_type"]').attr('data-key', keyid);
            cloned.find('input[name^="slider_item_type"]').attr('data-status', "active");
            cloned.find('input[name^="slider_item_type"]').removeAttr('readonly');
            cloned.find('a[class~="gl_theme_feature_box_remove_slider"]').attr('data-remove', 'Activate');
            cloned.find('a[class~="gl_theme_feature_box_remove_slider"]').text('Deactivate');
            cloned.find('a[class~="gl_theme_feature_box_remove_slider"]').show();
            cloned.find('a[class~="gl_theme_feature_box_remove_slider2"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_theme_feature_box_element_slider").first();
            first.find('a[class~="gl_theme_feature_box_remove_slider"]').hide();


        });

        $(wrapper_a).on("click", ".gl_theme_feature_box_remove_slider", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_theme_feature_box_text_slider").attr('data-status', "deactive");
                $(this).siblings().find(".gl_theme_feature_box_text_slider").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_theme_feature_box_text_slider").attr('data-status', "active");
                $(this).siblings().find(".gl_theme_feature_box_text_slider").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }


        });




        $(wrapper_a).on("click", ".gl_theme_feature_box_remove_slider2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_theme_feature_box_text_slider").attr('data-status', "delete");
            $(this).parent().parent().hide();

        });


        $('body').on('click', '.gl_theme_feature_box_creation', function () {

            var quick_json = [];
            var quick_json2 = [];

            $(".gl_theme_feature_box_wrapper .gl_theme_feature_box_element").each(function () {
                var theme_feature = $(this).find('input[name^="theme_feature_box"]').val();
                var theme_feature_key = $(this).find('input[name^="theme_feature_box"]').attr("data-key");
                var theme_feature_box_status = $(this).find('input[name^="theme_feature_box"]').attr("data-status");
                quick_json.push({
                    theme_feature_key: theme_feature_key,
                    theme_feature: theme_feature,
                    theme_feature_box_status: theme_feature_box_status});
            });


            $(".gl_theme_feature_box_wrapper_slider .gl_theme_feature_box_element_slider").each(function () {
                var theme_feature_slider = $(this).find('input[name^="slider_item_type"]').val();
                var theme_feature_key_slider = $(this).find('input[name^="slider_item_type"]').attr("data-key");
                var theme_feature_box_status_slider = $(this).find('input[name^="slider_item_type"]').attr("data-status");
                quick_json2.push({
                    slider_item_key: theme_feature_key_slider,
                    slider_item: theme_feature_slider,
                    slider_item_status: theme_feature_box_status_slider});
            });


            $(".gl_quick_link_set").val(JSON.stringify(quick_json));
            $(".gl_quick_link_set_slider").val(JSON.stringify(quick_json2));

        });

//
//        $(".gl_quick_link_wrapper").sortable({
//
//            revert: true,
//            start: function () {
//                $('.gl_quick_link_element').css('border', '2px dashed #999');
//            },
//            stop: function () {
//                $('.gl_quick_link_element').css('border', '');
//            }
//
//
//        });

    });
</script>
<!--EOF FOR FHA-->

<script type="text/javascript">
    $(document).ready(function ()
    {
        /*mail part */
        var first_a = $(".data_value_key14").first();
        var firsta_a = first_a.find('a[class~="remove_source14"]');
        firsta_a.hide();

        var wrapper_a = $("#main_key14"); //Fields wrapper   

        $("#add_key14").click(function (e)
        {
            e.preventDefault();
//alert();

            var newid = 1;
            $("#main_key14 div.data_value_key14").each(function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
                newid++;
                //debugger;
            });



            var current = $(".data_value_key14").last();
            var cloned = current.clone();
            cloned.find('input,textarea').val('');
            cloned.find('a[class~="remove_source14"]').show();
            cloned.attr("id", newid);
            cloned.insertAfter(current);

            var first = $(".data_value_key14").first();
            first.find('a[class~="remove_source14"]').hide();

        });

        $(wrapper_a).on("click", ".remove_source14", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').remove();

        });


        $('.gl_element_setting').on('click', '.gl_element_button', function () {

            var element_json = [];

            $("#main_key14 div.data_value_key14").each(function () {

                var element_value = $(this).find('.gl_element_value').val();
                element_json.push(element_value);

            });
            document.getElementById("gl_element_json").value = JSON.stringify(element_json);

        });

    });
</script>

<!-- Fixed Page Data Setting Starts -->
<script type="text/javascript">
    $(document).ready(function () {

        var first_a = $(".data_value_key15").first();
        var firsta_a = first_a.find('a[class~="remove_source15"]');
        firsta_a.hide();

        var wrapper_a = $("#main_key15"); //Fields wrapper   

        $("#add_key15").click(function (e)
        {

            e.preventDefault();

            var newid = 1;
            $("#main_key15 div.data_value_key15").each(function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
                newid++;
                //debugger;
            });



            var current = $(".data_value_key15").last();
            var cloned = current.clone();
            cloned.find('input').val('');
//            cloned.find('select').val('');
            cloned.find('a[class~="remove_source15"]').show();
            cloned.attr("id", newid);
            cloned.insertAfter(current);

            var selectcloned = $(".gl_fixed_page_theme:first").clone();
            $("#main_key15").find(".gl_fixed_page_theme_wrpr:last").html(selectcloned);
            var first = $(".data_value_key15").first();
            first.find('a[class~="remove_source15"]').hide();

        });

        $(wrapper_a).on("click", ".remove_source15", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').remove();

        });

        var dynamicVal = new Array();
        var obj = {};


        $('.gl_fixed_data_setting').on('click', '.gl_fixed_button', function () {

            var fixed_type_value = $(".gl_fixed_data_type:checked").val();

            var key = fixed_type_value;
            var fixed_data_json = [];

            $("#main_key15 div.data_value_key15").each(function () {

                var fixed_data_value = $(this).find('.gl_fixed_value').val();
                var fixed_page_theme = $(this).find('.gl_fixed_page_theme option:selected').val();
                fixed_data_json.push({theme_value: fixed_data_value,
                    theme_page: fixed_page_theme});

            });
            obj[key] = fixed_data_json;

            dynamicVal = obj;
            document.getElementById("gl_fixed_data_json").value = JSON.stringify(dynamicVal);

        });

    });


    $(document).ready(function ()
    {
        var first_a = $(".gl_slider_value_item").first();
        var firsta_a = first_a.find('a[class~="gl_slider_value_remove"]');
        var firsta_b = first_a.find('a[class~="gl_slider_value_remove2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_slider_data_value_wrapper");



        $(".gl_slider_value_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_slider_data_value_wrapper .gl_slider_value_item").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_slider_value_item").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('select').val('');
            cloned.find('input[name^="data_slider"]').attr('data-key', keyid);
            cloned.find('input[name^="data_slider"]').attr('data-status', "active");

            cloned.find('a[class~="gl_slider_value_remove"]').show();
            cloned.find('a[class~="gl_slider_value_remove2"]').show();
            cloned.insertAfter(current);
            var selectcloned = $(".gl_slider_item_type:first").clone();
            $(".gl_slider_data_value_wrapper").find(".slider_item_type_div:last").html(selectcloned);

            var first = $(".gl_slider_value_item").first();
            first.find('a[class~="gl_slider_value_remove"]').hide();


        });

        $(wrapper_a).on("click", ".gl_slider_value_remove", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_data_slider").attr('data-status', "deactive");
                $(this).siblings().find(".gl_data_slider").prop('readonly', true);
                $(this).siblings().find(".gl_data_attr_value").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_data_slider").attr('data-status', "active");
                $(this).siblings().find(".gl_data_slider").prop('readonly', false);
                $(this).siblings().find(".gl_data_attr_value").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }

        });
        $(wrapper_a).on("click", ".gl_slider_value_remove2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_data_slider").attr('data-status', "delete");
            $(this).parent().hide();

        });


        $('body').on('click', '.gl_theme_feature_box_creation', function () {

            var quick_json = [];
            $(".gl_slider_data_value_wrapper .gl_slider_value_item").each(function () {

                var data_slider = $(this).find('input[name^="data_slider"]').val();
                var slider_item_type = $(this).find('select[name^="slider_item_type"]').val();
                var data_slider_key = $(this).find('input[name^="data_slider"]').attr("data-key");
                var quick_status = $(this).find('input[name^="data_slider"]').attr("data-status");
                var data_attr_value = $(this).find('input[name^="data_attr_value"]').val();


                quick_json.push({data_slider: data_slider,
                    slider_item_type: slider_item_type,
                    data_slider_key: data_slider_key,
                    quick_status: quick_status,
                    data_attr_value: data_attr_value});
            });


            $(".gl_slider_data_set").val(JSON.stringify(quick_json));

        });
    });


    $(document).ready(function ()
    {
        var first_a = $(".gl_theme_page_type_item").first();
        var firsta_a = first_a.find('a[class~="gl_theme_page_type_remove"]');
        var firsta_b = first_a.find('a[class~="gl_theme_page_type_remove2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_theme_page_type_wrapper");



        $(".gl_theme_page_type_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_theme_page_type_wrapper .gl_theme_page_type_item").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_theme_page_type_item").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="theme_page_type_key"]').attr('data-key', keyid);
            cloned.find('input[name^="theme_page_type_key"]').attr('data-status', "active");
            cloned.find('a[class~="gl_theme_page_type_remove"]').show();
            cloned.find('a[class~="gl_theme_page_type_remove2"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_theme_page_type_item").first();
            first.find('a[class~="gl_theme_page_type_remove"]').hide();


        });

        $(wrapper_a).on("click", ".gl_theme_page_type_remove", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_theme_page_type_key").attr('data-status', "deactive");
                $(this).siblings().find(".gl_theme_page_type_key").prop('readonly', true);
                $(this).siblings().find(".gl_theme_page_type_label").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_theme_page_type_key").attr('data-status', "active");
                $(this).siblings().find(".gl_theme_page_type_key").prop('readonly', false);
                $(this).siblings().find(".gl_theme_page_type_label").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }

        });
        $(wrapper_a).on("click", ".gl_theme_page_type_remove2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_theme_page_type_key").attr('data-status', "delete");
            $(this).parent().hide();

        });


        $('body').on('click', '.gl_theme_page_type_submit', function () {

            var data_page_type = [];
            $(".gl_theme_page_type_wrapper .gl_theme_page_type_item").each(function () {

                var data_type = $(this).find('input[name^="theme_page_type_key"]').val();

                var data_type_key = $(this).find('input[name^="theme_page_type_key"]').attr("data-key");
                var quick_status = $(this).find('input[name^="theme_page_type_key"]').attr("data-status");
                var page_type_label = $(this).find('input[name^="theme_page_type_label"]').val();


                data_page_type.push({data_theme_page_type_id: data_type_key,
                    data_theme_page_type_key: data_type,
                    quick_status: quick_status,
                    page_theme_page_type_label: page_type_label,
                    quick_status: quick_status});
            });


            $(".gl_data_page_type").val(JSON.stringify(data_page_type));

        });
    });



</script> 


<!--{sbn} code--> 

<script>

    $(document).ready(function ()
    {


        var first_a = $(".gl_add_content_fixed_area_element").first();
        var firsta_a = first_a.find('a[class~="gl_add_content_fixed_area_remove"]');
        var firsta_b = first_a.find('a[class~="gl_add_content_fixed_area_remove2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_add_content_fixed_area_wrapper");



        $(".gl_add_content_fixed_area_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_add_content_fixed_area_wrapper .gl_add_content_fixed_area_element").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_add_content_fixed_area_element").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="add_content_fixed_areas_value"]').attr('data-key', keyid);
            cloned.find('input[name^="add_content_fixed_areas_value"]').attr('data-status', "active");
            cloned.find('input[name^="add_content_fixed_areas_value"]').removeAttr('readonly');
            cloned.find('a[class~="gl_add_content_fixed_area_remove"]').attr('data-remove', 'Activate');
            cloned.find('a[class~="gl_add_content_fixed_area_remove"]').text('Deactivate');
            cloned.find('a[class~="gl_add_content_fixed_area_remove"]').show();
            cloned.find('a[class~="gl_add_content_fixed_area_remove2"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_add_content_fixed_area_element").first();
            first.find('a[class~="gl_add_content_fixed_area_remove"]').hide();


        });

        $(wrapper_a).on("click", ".gl_add_content_fixed_area_remove", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_add_content_fixed_area_text").attr('data-status', "deactive");
                $(this).siblings().find(".gl_add_content_fixed_area_text").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_add_content_fixed_area_text").attr('data-status', "active");
                $(this).siblings().find(".gl_add_content_fixed_area_text").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }


        });




        $(wrapper_a).on("click", ".gl_add_content_fixed_area_remove2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_add_content_fixed_area_text").attr('data-status', "delete");
            $(this).parent().parent().hide();

        });


        $('body').on('click', '.gl_theme_feature_box_creation', function () {


            var quick_json2 = [];

            $(".gl_theme_feature_box_wrapper .gl_theme_feature_box_element").each(function () {});


            $(".gl_add_content_fixed_area_wrapper .gl_add_content_fixed_area_element").each(function () {
                var theme_feature_slider = $(this).find('input[name^="add_content_fixed_areas_value"]').val();
                var theme_feature_key_slider = $(this).find('input[name^="add_content_fixed_areas_value"]').attr("data-key");
                var theme_feature_box_status_slider = $(this).find('input[name^="add_content_fixed_areas_value"]').attr("data-status");
                quick_json2.push({
                    add_content_fixed_area_key: theme_feature_key_slider,
                    add_content_fixed_area: theme_feature_slider,
                    add_content_fixed_area_status: theme_feature_box_status_slider});
            });



            $(".gl_add_content_fixed_area_json").val(JSON.stringify(quick_json2));

        });



    });




    $(document).ready(function ()
    {
        var first_a = $(".gl_add_content_fixed_area_link_item").first();
        var firsta_a = first_a.find('a[class~="add_content_fixed_area_link_remove"]');
        var firsta_b = first_a.find('a[class~="add_content_fixed_area_link_remove2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_add_content_fixed_area_data_value_wrapper");



        $(".gl_add_content_fixed_area_link_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_add_content_fixed_area_data_value_wrapper .gl_add_content_fixed_area_link_item").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_add_content_fixed_area_link_item").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('select').val('');
            cloned.find('input[name^="add_content_fixed_area_link"]').attr('data-key', keyid);
            cloned.find('input[name^="add_content_fixed_area_link"]').attr('data-status', "active");

            cloned.find('a[class~="add_content_fixed_area_link_remove"]').show();
            cloned.find('a[class~="add_content_fixed_area_link_remove2"]').show();
            cloned.insertAfter(current);
            var selectcloned = $(".gl_add_content_fixed_areas_value:first").clone();
            $(".gl_add_content_fixed_area_data_value_wrapper").find(".add_content_fixed_areas_value_div:last").html(selectcloned);

            var first = $(".gl_add_content_fixed_area_link_item").first();
            first.find('a[class~="add_content_fixed_area_link_remove"]').hide();


        });

        $(wrapper_a).on("click", ".add_content_fixed_area_link_remove", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_add_content_fixed_area_link").attr('data-status', "deactive");
                $(this).siblings().find(".gl_add_content_fixed_area_link").prop('readonly', true);
                $(this).siblings().find(".gl_add_content_fixed_area_link_attr_value").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_add_content_fixed_area_link").attr('data-status', "active");
                $(this).siblings().find(".gl_add_content_fixed_area_link").prop('readonly', false);
                $(this).siblings().find(".gl_add_content_fixed_area_link_attr_value").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }

        });
        $(wrapper_a).on("click", ".add_content_fixed_area_link_remove2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_add_content_fixed_area_link").attr('data-status', "delete");
            $(this).parent().hide();

        });


        $('body').on('click', '.gl_theme_feature_box_creation', function () {

            var quick_json = [];
            $(".gl_add_content_fixed_area_data_value_wrapper .gl_add_content_fixed_area_link_item").each(function () {

                var add_content_fixed_area_link = $(this).find('input[name^="add_content_fixed_area_link"]').val();
                var add_content_fixed_areas_value = $(this).find('select[name^="add_content_fixed_areas_value"]').val();
                var add_content_fixed_area_link_key = $(this).find('input[name^="add_content_fixed_area_link"]').attr("data-key");
                var add_content_fixed_area_link_status = $(this).find('input[name^="add_content_fixed_area_link"]').attr("data-status");
                var add_content_fixed_area_link_attr_value = $(this).find('input[name^="add_content_fixed_area_link_attr_value"]').val();


                quick_json.push({add_content_fixed_area_link: add_content_fixed_area_link,
                    add_content_fixed_areas_value: add_content_fixed_areas_value,
                    add_content_fixed_area_link_key: add_content_fixed_area_link_key,
                    add_content_fixed_area_link_status: add_content_fixed_area_link_status,
                    add_content_fixed_area_link_attr_value: add_content_fixed_area_link_attr_value});
            });


            $(".gl_add_content_fixed_areas_link_json").val(JSON.stringify(quick_json));

        });
    });



</script>


<script type="text/javascript">
    $(document).ready(function ()
    {
        var first_a = $(".gl_wrapper_type_item").first();
        var firsta_a = first_a.find('a[class~="gl_wrapper_type_remove"]');
        var firsta_b = first_a.find('a[class~="gl_wrapper_type_remove2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_wrapper_types_wrapper");



        $(".gl_wrapper_type_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_wrapper_types_wrapper .gl_wrapper_type_item").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_wrapper_type_item").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="wrapper_type_key"]').attr('data-key', keyid);
            cloned.find('input[name^="wrapper_type_key"]').attr('data-status', "active");
            cloned.find('a[class~="gl_wrapper_type_remove"]').show();
            cloned.find('a[class~="gl_wrapper_type_remove2"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_wrapper_type_item").first();
            first.find('a[class~="gl_wrapper_type_remove"]').hide();


        });

        $(wrapper_a).on("click", ".gl_wrapper_type_remove", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_wrapper_type_key").attr('data-status', "deactive");
                $(this).siblings().find(".gl_wrapper_type_key").prop('readonly', true);
                $(this).siblings().find(".gl_wrapper_type_label").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_wrapper_type_key").attr('data-status', "active");
                $(this).siblings().find(".gl_wrapper_type_key").prop('readonly', false);
                $(this).siblings().find(".gl_wrapper_type_label").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }

        });
        $(wrapper_a).on("click", ".gl_wrapper_type_remove2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_wrapper_type_key").attr('data-status', "delete");
            $(this).parent().hide();

        });


        $('body').on('click', '.gl_wrapper_type_submit', function () {

            var data_page_type = [];
            $(".gl_wrapper_types_wrapper .gl_wrapper_type_item").each(function () {

                var data_type = $(this).find('input[name^="wrapper_type_key"]').val();

                var data_type_key = $(this).find('input[name^="wrapper_type_key"]').attr("data-key");
                var quick_status = $(this).find('input[name^="wrapper_type_key"]').attr("data-status");
                var page_type_label = $(this).find('input[name^="wrapper_type_label"]').val();


                data_page_type.push({data_wrapper_type_id: data_type_key,
                    data_wrapper_type_key: data_type,
                    data_wrapper_type_status: quick_status,
                    data_wrapper_type_label: page_type_label});
            });


            $(".gl_wrapper_type_type").val(JSON.stringify(data_page_type));

        });
    });



</script> 


<script type="text/javascript">
    $(document).ready(function ()
    {
        var first_a = $(".gl_date_formate_item").first();
        var firsta_a = first_a.find('a[class~="gl_date_formate_remove"]');
        var firsta_b = first_a.find('a[class~="gl_date_formate_remove2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_date_formates_wrapper");



        $(".gl_date_formate_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_date_formates_wrapper .gl_date_formate_item").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_date_formate_item").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="date_formate_key"]').attr('data-key', keyid);
            cloned.find('input[name^="date_formate_key"]').attr('data-status', "active");
            cloned.find('a[class~="gl_date_formate_remove"]').show();
            cloned.find('a[class~="gl_date_formate_remove2"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_date_formate_item").first();
            first.find('a[class~="gl_date_formate_remove"]').hide();


        });

        $(wrapper_a).on("click", ".gl_date_formate_remove", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_date_formate_key").attr('data-status', "deactive");
                $(this).siblings().find(".gl_date_formate_key").prop('readonly', true);
                $(this).siblings().find(".gl_date_formate_label").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_date_formate_key").attr('data-status', "active");
                $(this).siblings().find(".gl_date_formate_key").prop('readonly', false);
                $(this).siblings().find(".gl_date_formate_label").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }

        });
        $(wrapper_a).on("click", ".gl_date_formate_remove2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_date_formate_key").attr('data-status', "delete");
            $(this).parent().hide();

        });


        $('body').on('click', '.gl_date_formate_submit', function () {

            var data_page_type = [];
            $(".gl_date_formates_wrapper .gl_date_formate_item").each(function () {

                var data_type = $(this).find('input[name^="date_formate_key"]').val();

                var data_type_key = $(this).find('input[name^="date_formate_key"]').attr("data-key");
                var quick_status = $(this).find('input[name^="date_formate_key"]').attr("data-status");
                var page_type_label = $(this).find('input[name^="date_formate_label"]').val();


                data_page_type.push({data_date_formate_id: data_type_key,
                    data_date_formate_key: data_type,
                    data_date_formate_status: quick_status,
                    data_date_formate_label: page_type_label});
            });


            $(".gl_date_formate_type").val(JSON.stringify(data_page_type));

        });
    });



</script> 


<script type="text/javascript">
    $(document).ready(function ()
    {
        var first_a = $(".gl_element_main_type_item").first();
        var firsta_a = first_a.find('a[class~="gl_element_main_type_remove"]');
        var firsta_b = first_a.find('a[class~="gl_element_main_type_remove2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_element_main_types_wrapper");



        $(".gl_element_main_type_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_element_main_types_wrapper .gl_element_main_type_item").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_element_main_type_item").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="element_main_type_key"]').attr('data-key', keyid);
            cloned.find('input[name^="element_main_type_key"]').attr('data-status', "active");
            cloned.find('a[class~="gl_element_main_type_remove"]').show();
            cloned.find('a[class~="gl_element_main_type_remove2"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_element_main_type_item").first();
            first.find('a[class~="gl_element_main_type_remove"]').hide();


        });

        $(wrapper_a).on("click", ".gl_element_main_type_remove", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_element_main_type_key").attr('data-status', "deactive");
                $(this).siblings().find(".gl_element_main_type_key").prop('readonly', true);
                $(this).siblings().find(".gl_element_main_type_label").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_element_main_type_key").attr('data-status', "active");
                $(this).siblings().find(".gl_element_main_type_key").prop('readonly', false);
                $(this).siblings().find(".gl_element_main_type_label").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }

        });
        $(wrapper_a).on("click", ".gl_element_main_type_remove2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_element_main_type_key").attr('data-status', "delete");
            $(this).parent().hide();

        });


        $('body').on('click', '.gl_element_main_type_submit', function () {

            var data_page_type = [];
            $(".gl_element_main_types_wrapper .gl_element_main_type_item").each(function () {

                var data_element_main_type_key = $(this).find('input[name^="element_main_type_key"]').val();

                var data_element_main_type_id = $(this).find('input[name^="element_main_type_key"]').attr("data-key");
                var data_element_main_type_status = $(this).find('input[name^="element_main_type_key"]').attr("data-status");
                var data_element_main_type_label = $(this).find('input[name^="element_main_type_label"]').val();


                data_page_type.push({data_element_main_type_id: data_element_main_type_id,
                    data_element_main_type_key: data_element_main_type_key,
                    data_element_main_type_status: data_element_main_type_status,
                    data_element_main_type_label: data_element_main_type_label});
            });


            $(".gl_element_main_type_type").val(JSON.stringify(data_page_type));

        });
    });



</script> 



<script type="text/javascript">
    $(document).ready(function ()
    {


        $('body').on('click', '.gl_element_type_value_combo_submit', function () {

            var element_type_value_combo = {};
            $(".gl_element_type_value_combos_wrapper .gl_element_type_value_combo_item").each(function () {

                var element_combo_value_id = $(this).find('select[name^="element_combo_value_id"]').val();

                var element_combo_type_id = $(this).find('select[name^="element_combo_type_id"]').val();

                if (element_combo_value_id != '')
                {

                    element_type_value_combo[element_combo_value_id] = element_combo_type_id;

                }


                $(".gl_element_type_value_combo_type").val(JSON.stringify(element_type_value_combo));

            });
        });


    });



</script>


<script type="text/javascript">
    $(document).ready(function ()
    {


        $(".gl_cms_category_fixed_theme_remove2").show();
        $(".gl_cms_category_fixed_theme_remove2:first").hide();

        $(".gl_cms_category_theme_add_more").click(function (e)
        {
            $(".gl_cms_categiory_theme_wrapper").find(".gl_cms_category").select2("destroy");
            var current = $(".gl_cms_categiory_theme_item").last();
            var cloned = current.clone();
            cloned.show();

            cloned.find('select').val('');

            cloned.insertAfter(current);

            var selectcloned = $(".gl_cms_category_fixed_theme_page:first").clone();

            $(".gl_cms_categiory_theme_wrapper").find(".gl_cms_category_fixed_theme_page_div:last").html(selectcloned);

            $(".gl_cms_category_fixed_theme_page:last").val('');

            $(".gl_cms_category_fixed_theme_remove2").show();
            $(".gl_cms_category_fixed_theme_remove2:first").hide();

            $(".gl_cms_categiory_theme_wrapper").find(".gl_cms_category").select2();


        });


        $(".gl_cms_categiory_theme_wrapper").on("click", ".gl_cms_category_fixed_theme_remove2", function (e) {

            $(this).parent().remove();

        });


        $('body').on('click', '.gl_cms_category_fixed_theme_submit', function (e) {



            var data_cms_category_fixed_theme = [];
            $(".gl_cms_categiory_theme_wrapper .gl_cms_categiory_theme_item").each(function () {

                var data_cms_category = $(this).find('.gl_cms_category_div').find('select').val();

                var data_fixed_theme = $(this).find('.gl_cms_category_fixed_theme_page_div').find('select').val();




                data_cms_category_fixed_theme.push({
                    data_cms_category: data_cms_category,
                    data_fixed_theme: data_fixed_theme
                });
            });


            $(".gl_cms_category_fixed_theme_value").val(JSON.stringify(data_cms_category_fixed_theme));

        });


    });



</script> 




<!--{sbn} code-->




<script type="text/javascript">
    $(document).ready(function ()
    {
        var first_a = $(".gl_language_item").first();
        var firsta_a = first_a.find('a[class~="gl_language_item_remove"]');
        firsta_a.hide();
        var wrapper_a = $(".gl_language_wrapper");



        $(".gl_language_add_more").click(function (e)
        {
            e.preventDefault();


            var current = $(".gl_language_item").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('a[class~="gl_language_item_remove"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_language_item").first();
            first.find('a[class~="gl_language_item_remove"]').hide();
        });


        $(wrapper_a).on("click", ".gl_language_item_remove", function (e) {
            e.preventDefault();
            $(this).parent().remove();

        });


        $('body').on('click', '.gl_language_submit', function () {

            var data_page_type = [];
            $(".gl_language_wrapper .gl_language_item").each(function () {

                var language = $(this).find('input[name^="language"]').val();
                var language_class = $(this).find('input[name^="language_class"]').val();
                data_page_type.push({language: language,language_class:language_class});
            });


            $(".gl_language_type").val(JSON.stringify(data_page_type));

        });
    });



</script> 





<script type="text/javascript">
    $(document).ready(function ()
    {
        var first_a = $(".gl_fixed_value_item").first();
        var firsta_a = first_a.find('a[class~="gl_fixed_value_item_remove"]');
        var firsta_b = first_a.find('a[class~="gl_fixed_value_item_ad"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_fixed_value_wrapper");



        $(".gl_fixed_value_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_fixed_value_wrapper .gl_fixed_value_item").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_fixed_value_item").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="fixed_value"]').attr('data-key', keyid);
            cloned.find('input[name^="fixed_value"]').attr('data-status', "active");
            cloned.find('a[class~="gl_fixed_value_item_remove"]').show();
            cloned.find('a[class~="gl_fixed_value_item_ad"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_fixed_value_item").first();
            first.find('a[class~="gl_fixed_value_item_remove"]').hide();
        });


       $(wrapper_a).on("click", ".gl_fixed_value_item_ad", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_fixed_value_item_value").attr('data-status', "deactive");
                $(this).siblings().find(".gl_fixed_value_item_value").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_fixed_value_item_value").attr('data-status', "active");
                $(this).siblings().find(".gl_fixed_value_item_value").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }

        });



        $(wrapper_a).on("click", ".gl_fixed_value_item_remove", function (e) {
            e.preventDefault();
            $(this).parent().remove();

        });


        $('body').on('click', '.gl_fixed_value_submit', function () {

            var data_page_type = [];
            $(".gl_fixed_value_wrapper .gl_fixed_value_item").each(function () {

                var fixed_value = $(this).find('input[name^="fixed_value"]').val();
                var value_key = $(this).find('input[name^="fixed_value"]').attr("data-key");
                var status = $(this).find('input[name^="fixed_value"]').attr("data-status");
                data_page_type.push({value_key:value_key,status:status,fixed_value:fixed_value});
            });


            $(".gl_fixed_value_set").val(JSON.stringify(data_page_type));

        });
    });



</script> 
<script type="text/javascript">
    $(document).ready(function ()
    {
        var first_a = $(".gl_fixed_value_language_item").first();
        var firsta_a = first_a.find('a[class~="gl_fixed_value_language_item_remove"]');
        firsta_a.hide();
        var wrapper_a = $(".gl_fixed_value_language_wrapper");



        $(".gl_fixed_language_value_add_more").click(function (e)
        {

            e.preventDefault();
            
            var current = $(".gl_fixed_value_language_item").last();
            var cloned = current.clone();
            cloned.find('input').val('');
            cloned.find('a[class~="gl_fixed_value_language_item_remove"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_fixed_value_language_item").first();
            first.find('a[class~="gl_fixed_value_language_item_remove"]').hide();
            
            var selectcloned1 = $(".gl_fixed_value:first").clone();
            $(".gl_fixed_value_language_wrapper").find(".gl_fixed_value_wrapper:last").html(selectcloned1);

        });

        $(wrapper_a).on("click", ".gl_fixed_value_language_item_remove", function (e) {
            e.preventDefault();
            $(this).parent().remove();

        });


        $('body').on('click', '.gl_fixed_language_value_submit', function () {
            var fixed_language_value = [];
            $(".gl_fixed_value_language_wrapper .gl_fixed_value_language_item").each(function () {

                var fixed_value = $(this).find('select[name^="fixed_value"]').val();
                var fixed_value_text = $(this).find('input[name^="fixed_value_text"]').val();

                fixed_language_value.push({fixed_value: fixed_value,
                    fixed_value_text: fixed_value_text});
            });

            $(".gl_fixed_language_value_set").val(JSON.stringify(fixed_language_value));

        });
    });



</script> 
<script>
    $(document).ready(function () {
        load_table_set();
        $("body").on("change", ".gl_lang_table", function () {
            var current_table = $(this).find('option:selected').val();
            var data_key = $(this).attr('data-key');
            load_table_data(current_table, data_key);
        });
    });


    function load_table_data(current_table, data_key) {
        load_column(current_table, data_key);
        load_to_column(current_table, data_key);
    }


    function load_column(current_table, data_key) {
        var base_url = $(".base_url").val();
        var frmcolumn = $(".gl_current_column" + data_key).val();
        $.ajax({
            type: "POST",
            url: base_url + "optionadmin/load_table_data",
            data: {current_table: current_table, column: frmcolumn},
            cache: false,
            success: function (response) {
                $(".gl_lang_column" + data_key).html(response);
                $.uniform.update();
            }
        });
    }

    function load_to_column(current_table, data_key) {
        var base_url = $(".base_url").val();
        var to_column = $(".gl_current_to_column" + data_key).val();

        $.ajax({
            type: "POST",
            url: base_url + "optionadmin/load_table_data",
            data: {current_table: current_table, column: to_column},
            cache: false,
            success: function (response) {
                $(".gl_lang_to_column" + data_key).html(response);
                $.uniform.update();
            }
        });
    }
    function load_table_set() {

        $(".gl_language_column_item").each(function () {
            var data_key = $(this).attr('data-key');
            var lang_table = $('.gl_lang_table' + data_key).val();
            load_table_data(lang_table, data_key);
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function ()
    {
        var first_a = $(".gl_language_column_item").first();
        var firsta_a = first_a.find('a[class~="gl_language_column_item_remove"]');
        firsta_a.hide();
        var wrapper_a = $(".gl_language_column_wrapper");



        $(".gl_language_column_add_more").click(function (e)
        {

            e.preventDefault();

            var keyid = 1;
            $(".gl_language_column_wrapper .gl_language_column_item").each(function () {
                if (parseInt($(this).attr("data-key")) > keyid) {
                    keyid = parseInt($(this).attr("data-key"));
                }
                keyid++;
            });
            
            var current = $(".gl_language_column_item").last();
            var cloned = current.clone();
            cloned.show();
            var oldkey = keyid - 1;
            cloned.attr('data-key', keyid);

            cloned.find('a[class~="gl_language_column_item_remove"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_language_column_item").first();
            first.find('a[class~="gl_language_column_item_remove"]').hide();
            
            var selectcloned1 = $(".gl_lang_table:first").clone();
            $(".gl_language_column_wrapper").find(".gl_lang_table_wrp:last").html(selectcloned1);
            $(".gl_language_column_wrapper").find('.gl_lang_table').attr('data-key', keyid);
            
            var selectcloned2 = $(".gl_lang_column:first").clone();
            $(".gl_language_column_wrapper").find(".gl_lang_column_wrp:last").html(selectcloned2);
            $(".gl_language_column_wrapper").find('.gl_lang_column').removeClass('gl_lang_column' + oldkey);
            $(".gl_language_column_wrapper").find('.gl_lang_column:last').addClass('gl_lang_column' + keyid);
            $(".gl_lang_column:last").val('');
            
            var selectcloned3 = $(".gl_lang_to_column:first").clone();
            $(".gl_language_column_wrapper").find(".gl_lang_to_column_wrp:last").html(selectcloned3);   
            $(".gl_language_column_wrapper").find('.gl_lang_to_column').removeClass('gl_lang_to_column' + oldkey);
            $(".gl_language_column_wrapper").find('.gl_lang_to_column:last').addClass('gl_lang_to_column' + keyid);  
            $(".gl_lang_to_column_wrp:last").val('');


        });

        $(wrapper_a).on("click", ".gl_language_column_item_remove", function (e) {
            e.preventDefault();
            $(this).parent().remove();

        });


        $('body').on('click', '.gl_language_column_submit', function () {
            var language_column = [];
            $(".gl_language_column_wrapper .gl_language_column_item").each(function () {

                var lang_table = $(this).find('select[name^="lang_table"]').val();
                var lang_column = $(this).find('select[name^="lang_column"]').val();
                var lang_to_column = $(this).find('select[name^="lang_to_column"]').val();

                language_column.push({lang_table: lang_table,
                    lang_column: lang_column,
                    lang_to_column: lang_to_column});
            });


            $(".gl_language_column_set").val(JSON.stringify(language_column));

        });
    });



</script> 




<script type="text/javascript">
    $(document).ready(function ()
    {
        var first_a = $(".gl_short_cut_value_item").first();
        var firsta_a = first_a.find('a[class~="gl_short_cut_value_item_remove"]');

        firsta_a.hide();

        var wrapper_a = $(".gl_short_cut_value_wrapper");



        $(".gl_short_cut_value_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_short_cut_value_wrapper .gl_short_cut_value_item").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_short_cut_value_item").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="shortcut_value"]').attr('data-key', keyid);
            cloned.find('input[name^="shortcut_value"]').attr('data-status', "active");
//            cloned.find('a[class~="gl_short_cut_value_item_remove"]').show();
            
            
            
            cloned.find('input[name^="shortcut_url"]').attr('data-key', keyid);
            cloned.find('input[name^="shortcut_url"]').attr('data-status', "active");
            
            
            cloned.find('a[class~="gl_short_cut_value_item_remove"]').show();
            
            
            
//            cloned.find('a[class~="gl_short_cut_value_item_ad"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_short_cut_value_item").first();
            first.find('a[class~="gl_short_cut_value_item_remove"]').hide();
        });





        $(wrapper_a).on("click", ".gl_short_cut_value_item_remove", function (e) {
            e.preventDefault();
            $(this).parent().remove();

        });


        $('body').on('click', '.gl_short_cut_value_submit', function () {

            var data_page_type = [];
            var key_value = 0;
            $(".gl_short_cut_value_wrapper .gl_short_cut_value_item").each(function () {
                key_value++;
                var shortcut_value = $(this).find('input[name^="shortcut_value"]').val();
                var value_key = $(this).find('input[name^="shortcut_value"]').attr("data-key");
                var status = $(this).find('input[name^="shortcut_value"]').attr("data-status");
                
                
                var shortcut_url = $(this).find('input[name^="shortcut_url"]').val();
                var value_key_2 = $(this).find('input[name^="shortcut_url"]').attr("data-key");
                var status_2 = $(this).find('input[name^="shortcut_url"]').attr("data-status");
                
                
                data_page_type.push({value_key:key_value,status:status,shortcut_value:shortcut_value, shortcut_url:shortcut_url});
            });


            $(".gl_short_cut_value_set").val(JSON.stringify(data_page_type));

        });
    });



</script>



                                        
<script type="text/javascript">
    $(document).ready(function ()
    {
        var first_a = $(".gl_shipping_box_element").first();
        var firsta_a = first_a.find('a[class~="gl_shipping_box_remove"]');
        var firsta_b = first_a.find('a[class~="gl_shipping_box_remove2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_shipping_box_wrapper");






        $(".gl_shipping_box_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_shipping_box_wrapper .gl_shipping_box_element").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_shipping_box_element").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="shipping_box_name"]').attr('data-key', keyid);
            cloned.find('input[name^="shipping_box_name"]').attr('data-status', "active");
            cloned.find('a[class~="gl_shipping_box_remove"]').show();
            cloned.find('a[class~="gl_shipping_box_remove2"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_shipping_box_element").first();
            first.find('a[class~="gl_shipping_box_remove"]').hide();


        });

        $(wrapper_a).on("click", ".gl_shipping_box_remove", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_shipping_box_name").attr('data-status', "deactive");
                $(this).siblings().find(".gl_shipping_box_name").prop('readonly', true);
                $(this).siblings().find(".gl_shipping_box_length").prop('readonly', true);
				$(this).siblings().find(".gl_shipping_box_breadth").prop('readonly', true);
				$(this).siblings().find(".gl_shipping_box_height").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_shipping_box_name").attr('data-status', "active");
                $(this).siblings().find(".gl_shipping_box_name").prop('readonly', false);
                $(this).siblings().find(".gl_shipping_box_length").prop('readonly', false);
				$(this).siblings().find(".gl_shipping_box_breadth").prop('readonly', false);
				$(this).siblings().find(".gl_shipping_box_height").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }

        });
        $(wrapper_a).on("click", ".gl_shipping_box_remove2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_shipping_box_name").attr('data-status', "delete");
            $(this).parent().parent().hide();

        });


        $('body').on('click', '.gl_quick_link_creation', function () {

            var shipping_box_json = [];
            $(".gl_shipping_box_wrapper .gl_shipping_box_element").each(function () {
                var shipping_box_name = $(this).find('input[name^="shipping_box_name"]').val();
                var shipping_box_key = $(this).find('input[name^="shipping_box_name"]').attr("data-key");
                var shipping_box_status = $(this).find('input[name^="shipping_box_name"]').attr("data-status");
                var shipping_box_length = $(this).find('input[name^="shipping_box_length"]').val();
				var shipping_box_breadth = $(this).find('input[name^="shipping_box_breadth"]').val();
				var shipping_box_height = $(this).find('input[name^="shipping_box_height"]').val();

                shipping_box_json.push({shipping_box_name: shipping_box_name, shipping_box_length: shipping_box_length, shipping_box_breadth: shipping_box_breadth,shipping_box_height: shipping_box_height, shipping_box_key: shipping_box_key, shipping_box_status: shipping_box_status});
            });
            $(".gl_shipping_box_set").val(JSON.stringify(shipping_box_json));

        });

//
//        $(".gl_shipping_box_wrapper").sortable({
//
//            revert: true,
//            start: function () {
//                $('.gl_shipping_box_element').css('border', '2px dashed #999');
//            },
//            stop: function () {
//                $('.gl_shipping_box_element').css('border', '');
//            }
//
//
//        });

    });
	
	
</script>	


<script type="text/javascript">

$('body').on('click', '.delivery_charge_by_cart_total_status', function () {

var delivery_charge_by_cart_total_status = $(".delivery_charge_by_cart_total_status:checked").val();

if(delivery_charge_by_cart_total_status == 'yes')
{	
$(".delivery_charge_minimum_cart_amount").prop('required',true);
$(".delivery_charge_amount_by_cart_total").prop('required',true);
}
else
{
$(".delivery_charge_minimum_cart_amount").prop('required',false);
$(".delivery_charge_amount_by_cart_total").prop('required',false)	
}
		

});


$('body').on('click', '.minimum_cart_status', function () {

var minimum_cart_status = $(".minimum_cart_status:checked").val();

if(minimum_cart_status == 'yes')
{	
$(".minimum_cart_amount").prop('required',true);
}
else
{
$(".minimum_cart_amount").prop('required',false);	
}
		

});

</script>


<script type="text/javascript">

$(document).ready(function ()
    {
        var first_a = $(".gl_css_file_setting_item").first();
        var firsta_a = first_a.find('a[class~="gl_css_file_setting_remove"]');
        var firsta_b = first_a.find('a[class~="gl_css_file_setting_remove2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_css_file_setting_wrapper");



        $(".gl_css_file_setting_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_css_file_setting_wrapper .gl_css_file_setting_item").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_css_file_setting_item").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="css_file_setting_key"]').attr('data-key', keyid);
            cloned.find('input[name^="css_file_setting_key"]').attr('data-status', "active");
            cloned.find('a[class~="gl_css_file_setting_remove"]').show();
            cloned.find('a[class~="gl_css_file_setting_remove2"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_css_file_setting_item").first();
            first.find('a[class~="gl_css_file_setting_remove"]').hide();


        });

        $(wrapper_a).on("click", ".gl_css_file_setting_remove", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_css_file_setting_key").attr('data-status', "deactive");
                $(this).siblings().find(".gl_css_file_setting_key").prop('readonly', true);
                $(this).siblings().find(".gl_css_file_setting_label").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_css_file_setting_key").attr('data-status', "active");
                $(this).siblings().find(".gl_css_file_setting_key").prop('readonly', false);
                $(this).siblings().find(".gl_css_file_setting_label").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }

        });
        $(wrapper_a).on("click", ".gl_css_file_setting_remove2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_css_file_setting_key").attr('data-status', "delete");
            $(this).parent().hide();

        });


        $('body').on('click', '.gl_css_file_setting_submit', function () {

            var data_page_type = [];
            $(".gl_css_file_setting_wrapper .gl_css_file_setting_item").each(function () {

                var data_type = $(this).find('input[name^="css_file_setting_key"]').val();

                var data_type_key = $(this).find('input[name^="css_file_setting_key"]').attr("data-key");
                var quick_status = $(this).find('input[name^="css_file_setting_key"]').attr("data-status");
                var page_type_label = $(this).find('input[name^="css_file_setting_label"]').val();


                data_page_type.push({data_css_file_setting_id: data_type_key,
                    data_css_file_setting_key: data_type,
                    quick_status: quick_status,
                    page_css_file_setting_label: page_type_label,
                    quick_status: quick_status});
            });


            $(".css_file_setting_class").val(JSON.stringify(data_page_type));

        });
    });

</script>


<script type="text/javascript">

$(document).ready(function ()
    {
        var first_a = $(".gl_js_file_setting_item").first();
        var firsta_a = first_a.find('a[class~="gl_js_file_setting_remove"]');
        var firsta_b = first_a.find('a[class~="gl_js_file_setting_remove2"]');
        firsta_a.hide();
        firsta_b.hide();
        var wrapper_a = $(".gl_js_file_setting_wrapper");



        $(".gl_js_file_setting_add_more").click(function (e)
        {
            e.preventDefault();

            var keyid = 1;
            $(".gl_js_file_setting_wrapper .gl_js_file_setting_item").each(function () {
                if (parseInt($(this).data("key")) > keyid) {
                    keyid = parseInt($(this).data("key"));
                }
                keyid++;
            });
            var current = $(".gl_js_file_setting_item").last();
            var cloned = current.clone();
            cloned.show();
            cloned.find('input').val('');
            cloned.find('input[name^="js_file_setting_key"]').attr('data-key', keyid);
            cloned.find('input[name^="js_file_setting_key"]').attr('data-status', "active");
            cloned.find('a[class~="gl_js_file_setting_remove"]').show();
            cloned.find('a[class~="gl_js_file_setting_remove2"]').show();
            cloned.insertAfter(current);

            var first = $(".gl_js_file_setting_item").first();
            first.find('a[class~="gl_js_file_setting_remove"]').hide();


        });

        $(wrapper_a).on("click", ".gl_js_file_setting_remove", function (e) {
            e.preventDefault();
            if ($(this).attr("data-remove") == "Deactivate") {
                $(this).siblings().find(".gl_js_file_setting_key").attr('data-status', "deactive");
                $(this).siblings().find(".gl_js_file_setting_key").prop('readonly', true);
                $(this).siblings().find(".gl_js_file_setting_label").prop('readonly', true);
                $(this).text('Activate');
                $(this).attr("data-remove", "Activate");

            } else if ($(this).attr("data-remove") == "Activate") {
                $(this).siblings().find(".gl_js_file_setting_key").attr('data-status', "active");
                $(this).siblings().find(".gl_js_file_setting_key").prop('readonly', false);
                $(this).siblings().find(".gl_js_file_setting_label").prop('readonly', false);
                $(this).text('Deactivate');
                $(this).attr("data-remove", "Deactivate");
            }

        });
        $(wrapper_a).on("click", ".gl_js_file_setting_remove2", function (e) {
            e.preventDefault();
            $(this).siblings().find(".gl_js_file_setting_key").attr('data-status', "delete");
            $(this).parent().hide();

        });


        $('body').on('click', '.gl_js_file_setting_submit', function () {

            var data_page_type = [];
            $(".gl_js_file_setting_wrapper .gl_js_file_setting_item").each(function () {

                var data_type = $(this).find('input[name^="js_file_setting_key"]').val();

                var data_type_key = $(this).find('input[name^="js_file_setting_key"]').attr("data-key");
                var quick_status = $(this).find('input[name^="js_file_setting_key"]').attr("data-status");
                var page_type_label = $(this).find('input[name^="js_file_setting_label"]').val();


                data_page_type.push({data_js_file_setting_id: data_type_key,
                    data_js_file_setting_key: data_type,
                    quick_status: quick_status,
                    page_js_file_setting_label: page_type_label,
                    quick_status: quick_status});
            });


            $(".js_file_setting_class").val(JSON.stringify(data_page_type));

        });
    });

</script>

