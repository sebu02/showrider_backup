<style type="text/css">
.error p {
    color: #ff0000;
    font-size: 12px;
}
</style>

<div class="header-area">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-6 col-sm-8 clearfix">
            <div class="nav-btn pull-left">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="search-box pull-left">
                <form action="#">
                    <input type="text" name="search" placeholder="Search..." required>
                    <i class="ti-search"></i>
                </form>
            </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
                <li id="full-view"><i class="ti-fullscreen"></i></li>
                <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                <li class="dropdown">
                    <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                        <!--<span></span>-->
                    </i>

                </li>
                <li class="dropdown">
                    <i class="fa fa-envelope-o dropdown-toggle" data-toggle="dropdown">
                        <!--<span>3</span>-->
                    </i>

                </li>
                <!--                            <li class="settings-btn">
                                                <i class="ti-settings"></i>
                                            </li>-->
            </ul>
        </div>
    </div>
</div>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Manage Services</h4>

            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                <img class="avatar user-thumb"
                    src="<?php echo base_url() . 'static/'; ?>adminpanel/images/administrator.png" alt="Administrator">
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-angle-down"></i></h4>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>admin/changepassword/">Change Password</a>
                    <!--<a class="dropdown-item" href="#">Settings</a>-->
                    <a class="dropdown-item" href="<?php echo base_url(); ?>secureadmin/logout/">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content-inner">
    <div class="row">

        <div class="col-lg-6 col-ml-12">
            <div class="row">

                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <?php
                            if ($this->session->flashdata('message')) {
                                ?>
                            <div class="alert-dismiss">

                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong><?php echo $this->session->flashdata('message'); ?></strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span class="fa fa-times"></span>
                                    </button>
                                </div>

                            </div>
                            <?php
                            }
                            ?>

                            <h4 class="header-title">Edit Image</h4>

                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" id="gl_current_image_upload_form_id"
                                action="<?php echo base_url() . 'ecproductadmin/edit_product_image/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5); ?>"
                                method="post" enctype="multipart/form-data" autocomplete="off">


                                <?php /**/ ?><div class="form-group">
                                    <label for="product_name">Service Name</label>
                                    <input type="text" name="product_name" class="form-control" id="product_name"
                                        placeholder="" value="<?php echo $product->product_display_name; ?>" readonly />
                                    <span class="error"><?php // echo form_error('title');  ?></span>
                                </div><?php /**/ ?>

                                <div class="form-group">
                                    <label for="image_title">Image Title</label>
                                    <input type="text" name="image_title" class="form-control" id="" placeholder=""
                                        value="<?php echo $media->title; ?>" />
                                    <span class="error"><?php // echo form_error('title');  ?></span>
                                </div>

                                <div class="form-group" style="display:none;">

                                    <?php  
                                   
                                    // if($media->image_type=="banner_img" || $media->image_type=="default_img" || $media->image_type=="featured" || $media->image_type=="other" || $media->image_type=="more")
                                    // {

                                        $image_type = array("other" => "other");                                           

                                    // }   

                                    if($media->image_type=="other"){
                                        
                                        // $image_size=array("half_left" => "half left","half_right" => "half right","full_width" => "full width"); 

                                        $image_size=array("normal" => "normal"); 
                                    }
                                    else{
                                        $image_size=array("normal" => "normal"); 

                                    }                                   
                                    ?>

                                    <label for="image_title">Image Type</label>
                                    <select required name="imagetype" class="custom-select gl_imagetype"
                                        style="cursor: pointer;">

                                        <!-- <option value="">--select--</option> -->

                                        <?php  foreach($image_type as $key => $image_val) { ?>

                                        <option value="<?php echo $key; ?>" <?php if ($media->image_type == $key) {
                                                                echo "selected";
                                                            } ?>><?php echo $image_val; ?></option>

                                        <?php } ?>

                                    </select>
                                </div>



                                <div class="form-group " style="display:none;">
                                    <label for="image_title">Image Size</label>
                                    <select name="imagesize" required class="custom-select gl_imagesize"
                                        style="cursor: pointer;">

                                        <!-- <option value="">--select--</option> -->

                                        <?php  foreach($image_size as $key => $image_val) { ?>

                                        <option value="<?php echo $key; ?>" <?php if ($media->image_size == $key) {
                                                                echo "selected";
                                                            } ?>><?php echo $image_val; ?></option>

                                        <?php } ?>

                                    </select>
                                </div>

                                

                                <?php
                                $banner_seo_alt = '';
                                $banner_seo_title = '';
                                $banner = json_decode($media->images, TRUE);
                                
                                $img_width = '';
                                $img_height = '';
                                if($media->image_width != 0){
                                    $img_width = $media->image_width.'px';
                                }
                                if($media->image_height != 0){
                                    $img_height = $media->image_height.'px';
                                }                             

                                if ($banner != NULL) {
                                    if ($banner['image'] != '') {
                                        ?>
                                <div class="form-group">
                                    <label for="normal">Current Image</label>

                                    <div class="form-group">
                                        <!--<label for="normal">Current Image</label>-->
                                        <img src="<?php echo base_url() . 'media_library/' . $banner['image']; ?>"
                                            alt="image" title="image" style="max-height: 300px;">

                                    </div>

                                </div>

                                <?php
                                    }
                                }
                                ?>

                                <div class="form-group" style="display:none;">
                                    <label>Image Quote Title</label>

                                    <?php /* ?><input type="text" name="quote_title" class="form-control"
                                        id="quote_title" value="<?php echo $media->image_quote_title; ?>"
                                        placeholder="" /><?php /**/ ?>

                                    <?php
                                     $quote_title_array = json_decode($media->image_quote_title_json,TRUE);
                                     $quote_tag = "";
                                     $quote_title = "";

                                     if(!empty($quote_title_array)){
                                        $quote_tag = $quote_title_array['tag'];
                                        $quote_title = $quote_title_array['text'];
                                     }

                                     $tags_array = array("h2" => "H2" , "h3" => "H3" , "h4" => "H4" , "h5" => "H5" , "h6" => "H6");
                                    ?>

                                    <div class="input-group mb-3">
                                        <select class="custom-select gl_select_style" name="quote_tag"
                                            style="cursor: pointer;height:45px;">&nbsp;&nbsp;
                                            <option value="">--select tag--</option>
                                            <?php
                                                foreach($tags_array as $tags_key => $tags_val){                                                    
                                                ?>
                                            <option value="<?php echo $tags_key; ?>"
                                                <?php if($tags_key == $quote_tag){ echo "selected"; } ?>>
                                                <?php echo $tags_val; ?></option>
                                            <?php
                                                }
                                                ?>
                                        </select>
                                        <input type="text" class="form-control" name="quote_title" style="width:60%;"
                                            placeholder="Quote..." value="<?php echo $quote_title; ?>">
                                    </div>

                                </div>

                                <div class="form-group" style="display:none;">
                                    <label for="short_description">Short Description</label>

                                    <div class="input-group mb-3">

                                        <textarea rows="4" name="short_description" id="editor1" class="form-control"
                                            placeholder=""
                                            aria-label=""><?php echo $media->content_short_description; ?></textarea>
                                    </div>

                                </div>

                                <div class="form-group" style="display:none;">
                                    <label for="brief_description">Brief Description</label>

                                    <div class="input-group mb-3">

                                        <textarea rows="5" name="brief_description" id="editor" class="form-control"
                                            placeholder="" aria-label=""><?php echo $media->brief_details; ?></textarea>
                                    </div>

                                </div>
                                
                                <div class="form-group">
                                    <label for="seo_alt">Image SEO Alt</label>
                                    <input type="text" name="seo_alt" class="form-control" id="seo_alt" value="<?php
                                echo $banner['seo_alt'];
                                ?>" placeholder="" required />

                                </div>

                                <div class="form-group">
                                    <label for="seo_title">Image SEO Title</label>
                                    <input type="text" name="seo_title" class="form-control" id="seo_title"
                                        placeholder="" value="<?php echo $banner['seo_title']; ?>" required />

                                </div>

                                <?php

                                $prod_cat_details = $this->product_model->GetByRow_notrash('ec_category', $product->parent_sub_id, 'id');

                                $cat_combo_id = $prod_cat_details->category_default_combo_id;

                               /* if($media->default_img == 'yes'){
                                    $cat_combo_id = 7;
                                }else{
                                    $cat_combo_id = 42;
                                }/**/
                                                                                               
                                $combo_details = $this->product_model->GetByRow_notrash('cms_image_combo', $cat_combo_id, 'id');
                                $upload_type = $combo_details->upload_type;
                                
                                $upload_type_details = $this->product_model->GetByRow_notrash('cms_upload_types', $upload_type, 'id');
                                $upload_preferences = $upload_type_details->preferences;
                                
                                $upload_preferences_arr = json_decode($upload_preferences , TRUE);
                                $max_width = $upload_preferences_arr['max_width'];
                                $max_height = $upload_preferences_arr['max_height'];
                                
                                $file_type = $upload_type_details->file_type;
                                
                                if($file_type == "image"){
                                    $allowed_types = "gif , jpg , png , svg";                                    
                                }else{
                                    $allowed_types = "jpg , png , pdf , doc , docx , ppt , pptx , txt";
                                } 

                                if($media->image_type == 'banner_img'){
                                    $max_width = '1920';
                                    $max_height = '981';
                                }else if($media->image_type == 'other'){
                                
                                        if($media->image_size == 'half_left'){
                                            $max_width = '820';
                                            $max_height = '1200';
                                        }
                                        else if($media->image_size == 'half_right'){
                                            $max_width = '820';
                                            $max_height = '1200';
                                        }
                                        else if($media->image_size == 'full_width'){
                                            $max_width = '1680';
                                            $max_height = '1120';
                                        }

                                        /*else if($media->image_type == 'large_width'){
                                            $max_width = '808';
                                            $max_height = '489';
                                        }
                                        else if($media->image_type == 'featured'){
                                            $max_width = '317';
                                            $max_height = '449';
                                        }/**/

                                }
                                
                                /*else if($media->image_type == 'thumbnail'){
                                    $max_width = '580';
                                    $max_height = '473';
                                }/**/                               
                                ?>

                                <div class="form-group">
                                    <label>Image Upload</label>

                                    <div class="alert-items">
                                        <div class="alert alert-warning" role="alert">
                                            (Allowed Types : <?php echo $allowed_types; ?>) &nbsp; (File size must less
                                            than 2MB) &nbsp;
                                            <?php
                                            if($upload_type_details->manipulation_status == "Yes"){
                                                if($media->image_type == 'other'){
                                            ?>
                                                (Width : <?php echo $max_width; ?>px , Height :
                                                <?php echo $max_height; ?>px)
                                            <?php
                                                }else{
                                            ?>        
                                                (Width : any , Height : any)
                                            <?php        
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="hidden" name="combo" id="combo" data-imageid="gl_image_upload1"
                                            value="<?php echo $cat_combo_id; ?>" />

                                        <div class="custom-file">
                                            <input type="file" data-formclass="gl_multiple_upload_form"
                                                data-formtype="edit" data-controller="ecproductadmin" data-manipulation
                                                data-maxsize data-preference="" data-uploadtype="single"
                                                data-imageid="gl_image_upload1"
                                                class="custom-file-input gl_image_upload1 gl_uploadimage"
                                                name="images[]" id="images" data-input_name="images"
                                                data-combo_name="combo" style="cursor: pointer;" />
                                            <input type="hidden" class="file_input_name" name="file_input_name"
                                                value="">
                                            <input type="hidden" class="combo_name" name="combo_name" value="">

                                            <label class="custom-file-label" for="">Choose Image</label>

                                            <input type="hidden" name="final_images"
                                                value="<?php echo set_value('final_images'); ?>"
                                                id="gl_image_upload1-final_images"
                                                class="gl_upload1_final_images_string">
                                        </div>

                                    </div>

                                    <div class="alert-items gl_upload_alert">

                                    </div>

                                </div>

                                <?php
                                    $custom_link_array = json_decode($media->custom_link, TRUE);
                                    $link_type = $custom_link_array['link_type'];
                                    $link_text = $custom_link_array['link_text'];
                                    $target_type = $custom_link_array['target_type'];
                                    $type3 = $custom_link_array['type3'];
                                ?>

                                <div class="form-group" style="display:none;">
                                    <label for="customlink">Custom Link</label><br />


                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="internal" id="customlink1" name="customlink"
                                            class="custom-control-input gl_customlink_type" <?php
                                        if (isset($custom_link_array['link_type'])){
                                              if($custom_link_array['link_type'] == 'internal'){
                                                  echo ' checked';
                                              }
                                        }else {
                                            echo ' checked';
                                        }
                                        ?> />
                                        <label class="custom-control-label" for="customlink1"
                                            style="cursor: pointer;">Internal</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="external" id="customlink2" name="customlink"
                                            class="custom-control-input gl_customlink_type" <?php
                                           if (isset($custom_link_array['link_type'])) {
                                               if ($custom_link_array['link_type'] == 'external'){
                                                   echo 'checked';
                                               }    
                                           }
                                           ?> />
                                        <label class="custom-control-label" for="customlink2"
                                            style="cursor: pointer;">External</label>
                                    </div>

                                    <div class="form-group"></div>
                                    <?php $target_array = array('_self' => 'current tab', '_blank' => 'new tab'); ?>

                                    <div class="form-group slug_area" <?php
                                    /**/ if (isset($custom_link_array['type2'])){
                                            if($custom_link_array['type2'] == 'slug') {
                                                echo "style='display:block;'";
                                            } else {
                                                echo "style='display:none;'";
                                            }
                                         }
                                            /**/
                                    ?>>
                                        <p id="" class="form-text text-muted">
                                            <span style="font-size:13px;" class=""><?php echo base_url(); ?></span>
                                        </p>

                                        <input type="text" name="custom_slug" value="<?php
                                                   /**/ if (isset($custom_link_array['type3']) &&
                                                                $custom_link_array['type2'] == 'slug') {
                                                            echo $custom_link_array['type3'];
                                                        }/**/
                                                    ?>" class="form-control slug" id="custom_slug" placeholder="" />

                                    </div>

                                    <div class="form-group url_area" <?php
                           /**/ if (isset($custom_link_array['link_type']) &&
                                    $custom_link_array['link_type'] == 'external') {
                                        echo "style='display:block;'";
                                    } else {/**/
                                        echo "style='display:none;'";
                                    }
                                    ?>>

                                        <input type="url" name="url" value="<?php
                                                 /**/   if (isset($custom_link_array['type3']) &&
                                                           $custom_link_array['type2'] == 'link') {
                                                            echo $custom_link_array['type3'];
                                                        }/**/
                                                        ?>" class="form-control url_text" id="url" placeholder="" />

                                    </div>

                                    <div class="form-group">
                                        <select class="custom-select" name="target_type" style="cursor: pointer;">
                                            <option value="_self">--view type--</option>
                                            <?php
                                        if ($target_array != NULL) {
                                            foreach ($target_array as $target_key => $targettype) {
                                                ?>

                                            <option value="<?php echo $target_key; ?>" <?php /**/ if ($target_type == $target_key) {
                                                            echo "selected";
                                                        } /**/ ?>><?php echo $targettype; ?></option>

                                            <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>

                                    <input type="hidden" name="linktxt" value="">

                                </div>

                                <?php /**/ ?><div class="form-group">
                                    <label for="order_number">Order</label>
                                    <input type="number" name="order_number" class="form-control" id="order_number"
                                        placeholder="" value="<?php echo $media->order; ?>" required />
                                    <span class="error"><?php echo form_error('order_number'); ?></span>
                                </div><?php /**/ ?>

                                <div class="form-group">

                                </div>
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>

</div>

<script type="text/javascript">
$(document).ready(function() {

    $("body").on("change", ".gl_image_upload1", function(e) {
        var file = e.target.files[0].name;

        var string_data = '<div class="alert alert-success" role="alert">The file ' + file +
            ' has been selected.</div>';


        var error_string_data =
            '<div class="alert alert-danger" role="alert">Error !  Please select the correct format file.</div>';

        ajaxindicatorstart('');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'commonimageadmin/bannerUpload'; ?>",
            cache: false,
            data: new FormData(document.getElementById("gl_current_image_upload_form_id")),
            contentType: false,
            processData: false,
            success: function(html) {
                //                alert(html);
                ajaxindicatorstop();
                if (html != '') {
                    $(".gl_upload_alert").html(string_data);
                    $(".gl_upload1_final_images_string").val(html);
                } else {
                    $(".gl_upload_alert").html(error_string_data);
                    $(".gl_upload1_final_images_string").val();
                    $(".gl_image_upload1").val();
                }
            }
        });
    });
});
</script>

<script type="text/javascript">
$("body").on("change", ".gl_customlink_type", function() {
    var cust_val = $(this).val();
    if (cust_val == 'internal') {
        $(".slug_area").show();
        $(".url_area").hide();
    } else {
        $(".slug_area").hide();
        $(".url_area").show();
    }
});
</script>
<script type="text/javascript">
$("body").on("change", ".gl_imagetype", function() {

    var img_typ = $(this).val();
    if (img_typ == 'other') {


        // var imagesize = '<option value="">--select--</option><option value="half_left">half left</option><option value="half_right">half right</option><option value="full_width">full width</option>';

            var imagesize = '<option value="normal">normal</option>';
            
        $(".gl_imagesize").html(imagesize);
    } else {
        var imagesize = '<option value="normal">normal</option>';
        $(".gl_imagesize").html(imagesize);

    }
});
</script>