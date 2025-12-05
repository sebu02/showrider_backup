<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>Manage File Upload</h3>                   

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:70%; margin-left:15%;">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Edit Combo Image</span>
                        </h4>

                    </div>
                    <div class="content noPad clearfix">

                        <form class="form-horizontal multiple_upload_form gl_multiple_upload_form" action="<?php echo base_url() .'fileuploadadmin/edit_combo_img/' . $this->uri->segment(3); ?>" method="post" enctype="multipart/form-data" >
                            
                            <div class="wizard-steps clearfix show gl_wizard">
                                            <div class="wstep done" data-step-num="0">
                                                <a href="<?php echo base_url().'fileuploadadmin/editCombo/'.$values1->id;?>">
                                                <div class="donut">1</div>
                                                <span class="txt">STEP 1</span>
                                                </a>                                                
                                            </div>
                                            <div class="wstep current" data-step-num="1">
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
                      <?php
                      
                           $banner = json_decode($values1->combo_no_image);
                           if(!empty($banner)){
                                if ($banner[0]->image != '') {
                                    ?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="normal">Current Picture</label>
                                                <img  class="span4"  src="<?php echo base_url().'media_library/'.$banner[0]->image; ?>" />  
                                                <input type="hidden" name="mediaID" value="<?php echo $banner[0]->media_id; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                           }
                            
                            ?>
                    
                       <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="seo_alt">Picture SEO Alt </label>
                                        <textarea class="span8 elastic tinymce" id="seo_alt"  name="seo_alt"><?php if(!empty($banner[0]->seo_alt)){  echo $banner[0]->seo_alt; } ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('seo_alt'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="seo_title">Picture SEO Title </label>
                                        <textarea class="span8 elastic tinymce" id="seo_title"  name="seo_title"   /><?php if(!empty($banner[0]->seo_title)){  echo $banner[0]->seo_title; } ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('seo_title'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                    <?php 
                    
                         ?>
                    
                            <div class="form-row row-fluid hide">
                                <div class="span12">
                                    <div class="row-fluid comboSection">
                                        
                                        <label class="form-label span4" for="combo">Select File Property</label>
                                        <div class="span8 controls comboset">  
                                            <select name="combo" id="combo" class="combo" data-imageid="gl_image_upload1">
                                                <?php
                                                foreach ($values as $combos) {
                                                        ?>
                                                   <option data-pref='<?php echo $combos->preferences; ?>' 
                                                           data-manip='<?php echo $combos->manipulation_status; ?>' 
                                                           
                                                         <?php if ($combos->fid == $id) { echo 'selected'; } ?>
                                                           
                                                           value="<?php echo $combos->fid; ?>" 
                                                          ><?php echo $combos->combo_name; ?></option>
                                               
                                                <?php  } ?>

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
                                        <label class="form-label span4" for="normal">Combo No Image</label>
                                                                                
                                        <input  type="file" data-formclass='gl_multiple_upload_form' data-formtype="edit" data-controller="fileuploadadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="single" data-imageid="gl_image_upload1"  class="gl_image_upload1 gl_uploadimage ngo_proof_attach_input_file span8" name="images[]" data-input_name="images" data-combo_name="combo" id="images">
                                        
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
                                        <input type="hidden" name="final_images" value="<?php echo set_value('final_images')?>" id="gl_image_upload1-final_images">
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
                                <button type="submit" class="btn btn-info showhide-btn" >Submit</button>

                            </div>


                        </form>

                    </div>

                </div><!-- End .box -->

            </div><!-- End .span6 --><!-- End .span6 --><!-- End .span6 -->


        </div><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid -->

    </div><!-- End contentwrapper -->
</div>