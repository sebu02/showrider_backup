<style type="text/css">
    .error p{
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
                <h4 class="page-title pull-left">Manage Packages</h4>

            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                <img class="avatar user-thumb" src="<?php echo base_url() . 'static/'; ?>adminpanel/images/administrator.png" alt="Administrator">
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
                            
                            <h4 class="header-title">Edit Package</h4>
                                                        
                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'ecproductadmin/edit_package?id=' . $single_detail->id; ?>" method="post" enctype="multipart/form-data" autocomplete="off" id="gl_current_image_upload_form_id">

                                <div class="form-group">
                                    <label>Service</label>

                                    <?php
                                    $current_cat_arr = explode("+" , $single_detail->category_tree);

                                    $current_cat_arr = array_filter($current_cat_arr);                                   

                                    $condition_array = array(
                                        "parent_id" => 0  
                                    ); 

                                    $category_list = $this->common_model->GetByResult_Where("ec_category", "id", "asc", $condition_array); 

                                    if($category_list != NULL){
                                        foreach($category_list as $category_key => $category_row){    
                                    ?>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="category[]" class="custom-control-input gl_category" id="category_<?php echo $category_key; ?>" value="<?php echo $category_row->id; ?>" <?php if(in_array($category_row->id , $current_cat_arr)){ echo "checked"; } ?>>
                                            <label class="custom-control-label" for="category_<?php echo $category_key; ?>"  style="cursor: pointer"><?php echo $category_row->category; ?></label>
                                        </div>

                                            <?php
                                        }
                                    }
                                    ?> 
                                    
                                    <span class="error">
                                        <?php // echo form_error('category'); ?>
                                    </span>

                                </div>    

                                <div class="form-group">
                                    <label for="service_name">Name<a style="color:#F00; font-size:12px;">*</a></label>
                                    <input type="text" name="package_name" class="form-control" id="package_name" value="<?php echo $single_detail->name; ?>" required>

                                    <span class="error">
                                        <?php echo form_error('package_name'); ?>
                                    </span>

                                </div>                               

                                <div class="form-group">
                                    <label for="package_code">Code</label>
                                    <input type="text" name="package_code" class="form-control" id="package_code" value="<?php echo $single_detail->code; ?>" required readonly>

                                    <span class="error">
                                        <?php echo form_error('package_code'); ?>
                                    </span>

                                </div>                                                               

                                <div class="form-group">
                                    <label>Price Status</label><br/>
                                                                
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="yes" id="price_status1" name="price_status" class="custom-control-input gl_price_status"

                                            <?php                                                                                      

                                            if ($single_detail->price_status == 'yes') {
                                                    echo 'checked';
                                            }                                          

                                            ?> />
                                        <label class="custom-control-label" for="price_status1" style="cursor: pointer;">Yes</label>
                                    </div>
                                    
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="no" id="price_status2" name="price_status" class="custom-control-input gl_price_status"

                                            <?php                                         

                                            if ($single_detail->price_status == 'no') {
                                                    echo 'checked';
                                            }                                                                                      
                                            
                                            ?> />
                                        <label class="custom-control-label" for="price_status2" style="cursor: pointer;">No</label>
                                    </div>

                                </div>

                                <div class="form-group gl_price_input_div" <?php if ($single_detail->price_status != 'yes') { echo 'style="display:none;"'; } ?> >
                                    <label for="price">Price</label>
                                    <input type="number" name="price" class="form-control gl_price_input" id="price" value="<?php echo $single_detail->price; ?>" required>

                                    <span class="error">
                                        <?php echo form_error('price'); ?>
                                    </span>

                                </div>                                                    
                                                                                               
                                <?php
                                $banner_seo_alt = '';
                                $banner_seo_title = '';
                                $banner = json_decode($single_detail->image, true);
                                if (!empty($banner['seo_alt'])) {
                                    $banner_seo_alt = $banner['seo_alt'];
                                }
                                if (!empty($banner['seo_title'])) {
                                    $banner_seo_title = $banner['seo_title'];
                                }

                                if ($banner != NULL) {
                                    if ($banner['image'] != '') {
                                        ?>
                                        <div class="form-group">

                                            <label for="normal">Current Image</label>
                                        
                                            <div class="form-group">
                                                <!--<label for="normal">Current Image</label>-->
                                                <img src="<?php echo base_url() . 'media_library/' . $banner['image']; ?>" alt="" style="max-height: 300px;">

                                            </div>

                                        </div>

                                        <?php
                                    }
                                }
                                ?>    

                                <div class="form-group">

                                    <label>Image Upload</label>

                                    <?php
                                    $cat_combo_id = 67;
                                    $combo_details = $this->common_model->GetByRow_notrash('cms_image_combo', $cat_combo_id, 'id');
                                    $upload_type = $combo_details->upload_type;

                                    $upload_type_details = $this->common_model->GetByRow_notrash('cms_upload_types', $upload_type, 'id');
                                    $upload_preferences = $upload_type_details->preferences;

                                    $upload_preferences_arr = json_decode($upload_preferences, TRUE);
                                    $max_width = $upload_preferences_arr['max_width'];
                                    $max_height = $upload_preferences_arr['max_height'];

                                    $file_type = $upload_type_details->file_type;

                                    if ($file_type == "image") {
                                        $allowed_types = "gif , jpg , png";
                                    } else {
                                        $allowed_types = "jpg , png , pdf , doc , docx , ppt , pptx , txt";
                                    }
                                    ?>

                                    <div class="alert-items">
                                        <div class="alert alert-warning gl_attributes_div" role="alert">
                                            (Allowed Types : <?php echo $allowed_types; ?>) (File size must less than 2MB) 

                                            <?php
                                            if ($upload_type_details->manipulation_status == "Yes") {
                                                ?>
                                                (Width : <a class="gl_current_img_width"><?php echo $max_width; ?></a>px , Height : <a class="gl_current_img_height"><?php echo $max_height; ?></a>px)
                                                <?php
                                            }
                                            ?>

                                            <input type="hidden" name="combo" id="combo" data-imageid="gl_image_upload1" value="<?php echo $cat_combo_id; ?>" />

                                        </div>
                                    </div>

                                    <div class="input-group mb-3">

                                        <div class="custom-file">
                                            <input type="file" data-formclass="gl_multiple_upload_form" data-formtype="edit" data-controller="ecproductadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="single" data-imageid="gl_image_upload1" class="custom-file-input gl_image_upload1 gl_uploadimage" name="images[]" id="images" data-input_name="images" data-combo_name="combo" style="cursor: pointer;" />
                                            <input type="hidden" class="file_input_name" name="file_input_name" value="">
                                            <input type="hidden" class="combo_name" name="combo_name" value="">

                                            <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>

                                            <input type="hidden" name="final_images" value="<?php echo set_value('final_images'); ?>" id="gl_image_upload1-final_images" class="gl_upload1_final_images_string">
                                        </div>

                                    </div>

                                    <div class="alert-items gl_upload_alert">

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="order_number">Order</label>
                                    <input type="number" name="order_number" class="form-control" id="order_number" placeholder="" value="<?php echo $single_detail->order_no; ?>" required min="0" />
                                    <span class="error"><?php echo form_error('order_number'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="active_status">Active Status</label><br/>
                                                                
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="a" id="active_status1" name="active_status" class="custom-control-input"

                                            <?php                                           

                                            if ($single_detail->active_status == 'a') {
                                                    echo 'checked';
                                            }                                           

                                            ?> />
                                        <label class="custom-control-label" for="active_status1" style="cursor: pointer;">Active</label>
                                    </div>
                                    
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="d" id="active_status2" name="active_status" class="custom-control-input"

                                            <?php                                         

                                            if ($single_detail->active_status == 'd') {
                                                    echo 'checked';
                                            }
                                            ?> />
                                        <label class="custom-control-label" for="active_status2" style="cursor: pointer;">Deactive</label>
                                    </div>

                                </div>           
                                
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

    $(document).ready(function () {

        $("body").on("change", ".gl_image_upload1", function (e) {
            var file = e.target.files[0].name;

            var string_data = '<div class="alert alert-success" role="alert">The file ' + file + ' has been selected.</div>';
//        alert('The file "' + file + '" has been selected.');

            var error_string_data = '<div class="alert alert-danger" role="alert">Error !  Please select the correct format file.</div>';
            ajaxindicatorstart('');

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'commonimageadmin/bannerUpload'; ?>",
                cache: false,
                data: new FormData(document.getElementById("gl_current_image_upload_form_id")),
                contentType: false,
                processData: false,
                success: function (html) {
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

<script>
    $(".multiple_upload_form").submit(function(){

        var isFormValid = false;
        $(".multiple_upload_form .gl_category").each(function(){ // Note the :text
            if ($(this).is(':checked')){
                isFormValid = true;
            }
            
        });

        if (!isFormValid) {
            alert("Please select the service!");
        }

        return isFormValid;
        
    });
</script>

<script>
    $("body").on("change" , ".gl_price_status" , function(){

        var val = $(this).val();
    
        if(val == "yes"){
            $(".gl_price_input_div").show();
            $(".gl_price_input").prop('required' , true);
        }else{
            $(".gl_price_input_div").hide();
            $(".gl_price_input").prop('required' , false);
        }

    });
</script>