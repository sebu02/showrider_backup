<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3 class="gl_ftype_label">MANAGE PRODUCT IMAGES</h3>                    



        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:70%; margin-left:15%;">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span class="gl_ftype_label">Edit Product Image</span>
                        </h4>

                    </div>
                    <div class="content">

                        <form class="form-horizontal multiple_upload_form gl_multiple_upload_form" action="<?php echo base_url() . 'ecproductadmin/edit_product_brochure/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5); ?>" method="post" enctype="multipart/form-data" >
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
                                        <label class="form-label span4 gl_ftype_label">Product Name</label>
                                        <input class="span8" type="text" name="product_name" readonly value="<?php echo $product->prod_name; ?>" />
                                    </div>
                                </div> 
                            </div>


                            <?php
                            $banner = json_decode($product->brochure_file);
                            $pos = $this->uri->segment(3);

                            if ($banner[$pos]->image != '') {
                                ?>

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="normal">Current Brochure</label>
                                            <span class="icon icomoon-icon-file-6"></span><?php echo $banner[$pos]->image; ?>
                                            <input type="hidden" name="mediaID" value="<?php echo $banner[$pos]->media_id; ?>" >
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>
                            <div class="form-row row-fluid"> 
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4">Brochure Title</label>
                                        <input class="span8" type="text" name="brochure_title" value="<?php echo $banner[$pos]->image_title; ?>" />
                                    </div>
                                </div> 
                            </div>
                            <?php
                            $image_seo = $this->product_model->GetByRow_notrash('cms_media', $banner[$pos]->media_id, 'id');
                            $image_seo_details = json_decode($image_seo->images, true);
                            ?>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="seo_alt">SEO Alt <b style="color:#F00; font-size:11px;">*</b></label>
                                        <textarea class="span8 elastic tinymce" id="seo_alt"  name="seo_alt"  required /><?php echo $image_seo_details['seo_alt']; ?></textarea>
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
                                        <textarea class="span8 elastic tinymce" id="seo_title"  name="seo_title"  required /><?php echo $image_seo_details['seo_title']; ?></textarea>
                                        <span class="error">
<?php echo form_error('seo_title'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid combo-currentCombo">
                                        <label class="form-label span4" for="normal">File Property</label>
<?php foreach ($values as $combos) {
    if ($banner[$pos]->combo == $combos->fid) {
        ?>
                                                <input class="span8" readonly="true" value="<?php echo $combos->combo_name; ?>"  />
                                            <?php }
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
                                                    if ($combos->manipulation_status == 'No') { // (IMG_MANIPULATION_COMBO) when need all combos remove this condition
                                                        ?>
                                                        <option data-pref='<?php echo $combos->preferences; ?>' data-manip='<?php echo $combos->manipulation_status; ?>' <?php
                                                        if ($banner[$pos]->combo == $combos->fid) {
                                                            echo 'selected';
                                                        } elseif (isset($_POST['combo'])) {
                                                            if ($_POST['combo'] == $combos->fid) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>  value="<?php echo $combos->fid; ?>" ><?php echo $combos->combo_name; ?></option>
                                                            <?php
                                                            }
                                                        }
                                                        ?>

                                            </select>
                                        </div>
                                        <span class="error"><?php echo form_error('combo'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Image</label>

                                        <input  type="file" data-formclass='gl_multiple_upload_form' data-formtype="edit" data-controller="ecproductadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="single" data-imageid="gl_image_upload1"  class="gl_image_upload1 gl_uploadimage ngo_proof_attach_input_file span8" name="images[]" id="images" data-input_name="images" data-combo_name="combo"  >

                                        <input type="hidden" class="file_input_name" name="file_input_name" value="">
                                        <input type="hidden" class="combo_name" name="combo_name" value="">

                                        <div class="upload_note span12">
                                            <span class="span4"></span> <span class="span8">Size:Below&nbsp;<span class="gl_image_upload1-textSize"></span>  MB for each file<span class="dimensions">, width:&nbsp;<span class="gl_image_upload1-textWidth"></span> px, Height:&nbsp;<span class="gl_image_upload1-textHeight"></span> px</span></span>
                                            <span class="manipTxt manip_Txt"><a onclick="manipToggle('gl_image_upload1')">Show Manipulations</a></span>
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
<input type="hidden" class="gl_seg4" value="<?php echo $this->uri->segment(5); ?>">
<script type="text/javascript">
    $(document).ready(function () {
        var seg4 = $('.gl_seg4').val();
        if (seg4 == 'shop') {
            $('.gl_ftype_label').each(function () {
                var str = $(this).text();
                var str = str.replace('product', 'shop');
                var str = str.replace('Product', 'Shop');
                var str = str.replace('PRODUCT', 'SHOP');
                $(this).text(str);
            });
        }
    });
</script>
