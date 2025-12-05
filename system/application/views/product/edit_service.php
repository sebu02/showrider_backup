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
                <h4 class="page-title pull-left">Manage Events</h4>

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
                            
                            <h4 class="header-title">Edit Event</h4>
                                                        
                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'ecproductadmin/edit_service?id='.$single_detail->id; ?>" method="post" enctype="multipart/form-data" autocomplete="off" id="gl_current_image_upload_form_id">
                               
                                
                                <div class="form-group">
                                    <label for="service_name">Name<a style="color:#F00; font-size:12px;">*</a></label>
                                    <input type="text" name="service_name" class="form-control" id="service_name" value="<?php echo $single_detail->name; ?>" placeholder="" required>

                                    <span class="error">
                                        <?php echo form_error('service_name'); ?>
                                    </span>

                                </div>

                                <div class="form-group">
                                    <label for="event_code">Code</label>
                                    <input type="text" name="event_code" class="form-control" id="event_code" value="<?php echo $single_detail->code; ?>" required readonly>

                                    <span class="error">
                                        <?php echo form_error('event_code'); ?>
                                    </span>

                                </div>

                                <div class="form-group" style="display:none;">
                                    <label for="part_number">Part Number                                       
                                    </label>
                                    <input type="text" name="part_number" class="form-control" id="part_number" value="<?php echo $single_detail->part_number; ?>">

                                    <span class="error">                                        
                                    </span>

                                </div>

                                <div class="form-group">
                                    <label for="part_number">Title</label>

                                    <input type="text" name="title" class="form-control" id="title" value="<?php echo $single_detail->title; ?>">

                                    <span class="error">                                        
                                    </span>

                                </div>
                                
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>                               
                                
                                    <div class="input-group mb-3">

                                        <textarea rows="4" name="short_description" id="short_description" class="form-control" ><?php echo $single_detail->short_description; ?></textarea>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="brief_description">Brief Description</label>
                                                               
                                    <div class="input-group mb-3">

                                        <textarea rows="5" name="brief_description" id="editor" class="form-control" ><?php echo $single_detail->brief_details; ?></textarea>
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="event_date">Date</label>
                                    <input type="date" name="event_date" class="form-control" id="event_date" value="<?php echo date('Y-m-d', strtotime($single_detail->date)); ?>" required />

                                </div>
                                
                                <div class="form-group">
                                    <label for="from_time">From Time</label>
                                    <input type="time" name="from_time" class="form-control" id="from_time" value="<?php echo $single_detail->from_time; ?>" />

                                </div>

                                <div class="form-group">
                                    <label for="to_time">To Time</label>
                                    <input type="time" name="to_time" class="form-control" id="to_time" value="<?php echo $single_detail->to_time; ?>" />

                                </div>
                                                                
                                <div class="form-group" style="display:none;">
                                    <label for="alt_pn">Alt Pn</label>
                                    <input type="text" name="alt_pn" class="form-control" id="alt_pn" value="<?php echo $single_detail->alt_pn; ?>" />

                                </div> 
                                
                                <div class="form-group" style="display:none;">
                                    <label for="cage">Cage</label>
                                    <input type="text" name="cage" class="form-control" id="cage" value="<?php echo $single_detail->cage; ?>" />

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
                                    $cat_combo_id = 66;
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
                                    <input type="number" name="order_number" class="form-control" id="order_number" placeholder="" value="<?php
                                        echo $single_detail->order_no;
                                    ?>" required min="0" />
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