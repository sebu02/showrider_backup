<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Manage Content</h3>
        </div><!-- End .heading-->
        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="title">
                        <h4>
                            <span>Edit Category</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">                            
                            <form id="wizard" class="form-horizontal ui-formwizard gl_multiple_upload_form multiple_upload_form" action="<?php echo base_url() . 'contentadmin/edit_category2?' . $_SERVER['QUERY_STRING']; ?>" method="post" enctype="multipart/form-data" >
                            
                            
                            
                            <?php 
                                $data['type'] = 'edit';
                                $data['single_detail'] = $single_detail;
                                $data['step']="2";
                                $this->load->view('wizard_steps', $data);
                            ?>


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="error_messages">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="category_description">Category Description</label>
                                        <a href="<?php echo base_url(); ?>commonimageadmin/viewimages/" target="_blank" class="btn btn-inverse pull-right">
                                            <span class="icon16 icomoon-icon-image-3 white"></span>Add Image for Description</a>
                                    </div>
                                    <div class="row-fluid">
                                        <textarea class="span8 elastic ckeditor" id="category_description" name="category_description"><?php echo $single_detail->category_description; ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('category_description'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

<?php $default_combo_list = json_decode($this->common_model->option->default_combo_list, TRUE); ?>
                            <!--Image for category-->

                            <?php
                            
                      $banner_seo_alt = ''; $banner_seo_title = '';
                            $banner = json_decode($single_detail->banner_picture);
                      if(!empty($banner[0]->seo_alt)){ $banner_seo_alt = $banner[0]->seo_alt; }
                      if(!empty($banner[0]->seo_title)){ $banner_seo_title = $banner[0]->seo_title; }
                            
// dump($banner);
                            if ($banner != NULL) {
                                if ($banner[0]->image != '') {
                                    ?>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="normal">Current Category Picture</label>
                                                <img  class="span4"  src="<?php echo base_url() . 'media_library/' . $banner[0]->image; ?>" />  
                                                <input type="hidden" name="mediaID" value="<?php if(!empty($banner[0]->media_id)){ echo $banner[0]->media_id; } ?>" >
                                            </div>
                                        </div>
                                    </div>

                                    <?php
//                                    $image_seo = $this->content_model->GetByRow_notrash('cms_media', $banner[0]->media_id, 'id');
//                                    $image_seo_details = json_decode($image_seo->images, true);
                                }
                            }
                            ?>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="seo_alt">Banner SEO Alt </label>
                                        <textarea class="span8 elastic tinymce" id="seo_alt"  name="seo_alt"   /><?php
                                       echo $banner_seo_alt;
                                        ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('seo_alt'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="seo_title">Banner SEO Title </label>
                                        <textarea class="span8 elastic tinymce" id="seo_title"  name="seo_title"   /><?php
                                        echo $banner_seo_title
                                        ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('seo_title'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid comboSection">
                                        
                                        <label class="form-label span4" for="combo">Select File Property</label>
                                        <div class="span8 controls comboset">  
                                            <select name="combo" id="combo" class="combo" data-imageid="gl_image_upload1">
                                                <?php
                                                foreach ($values as $combos) {
                                                    if ($combos->manipulation_status == 'Yes') { // (IMG_MANIPULATION_COMBO) when need all combos remove this condition
                                                        ?>
                                                        
                                                        <option data-pref='<?php echo $combos->preferences; ?>' 
                                                                data-manip='<?php echo $combos->manipulation_status; ?>' 
                                                                <?php
                                                                if ($banner != NULL) {
                                                                    if ($banner[0]->image != '') {
                                                                        if ($banner[0]->combo == $combos->fid) {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                }else if (isset($_POST['combo'])) {
                                                                    if ($_POST['combo'] == $combos->fid) {
                                                                        echo 'selected';
                                                                    }
                                                                } else if (!empty($default_combo_list['content_category_picture'])) {
                                                                                if ($default_combo_list['content_category_picture'] == $combos->fid) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                ?>
                                                                value="<?php echo $combos->fid; ?>"><?php echo $combos->combo_name; ?></option>
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
                                        <label class="form-label span4" for="normal">Banner Picture</label>
                                       
                                        <input  type="file" data-formclass='gl_multiple_upload_form' data-formtype="edit" data-controller="contentadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="single" data-imageid="gl_image_upload1"  class="gl_image_upload1 gl_uploadimage ngo_proof_attach_input_file  span8" name="images[]" id="images" data-input_name="images" data-combo_name="combo">
                                        
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
                            </div>

                            

                            <!--End of Image for banner-->

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="bannertitle">Banner Title</label>
                                        <textarea class="span8 elastic" id="bannertitle" rows="2"  name="bannertitle"><?php echo $single_detail->banner_title; ?></textarea>
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
                                        <textarea class="span8 elastic ckeditor" id="banner_description" name="banner_description"><?php echo $single_detail->banner_description; ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('banner_description'); ?>
                                        </span>
                                    </div>


                                </div>
                            </div>


                           
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions full">
                                <a class="btn pull-left <?php echo $this->common_model->admin_or_super_admin();?>" href="<?php echo base_url() . 'contentadmin/edit?' . $_SERVER['QUERY_STRING']; ?>" > Back </a>
                                <button class="btn btn-info pull-right showhide-btn" type="submit" >Save & Continue</button>


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