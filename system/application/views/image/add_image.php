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
                <h4 class="page-title pull-left">Manage Images</h4>

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

                            <h4 class="header-title">Add Images</h4>

                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" id="gl_current_image_upload_form_id" action="<?php echo base_url() . 'commonimageadmin/addimages/?' . $_SERVER['QUERY_STRING']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                                <div class="form-group">
                                    <label class="col-form-label">Category<a style="color:#F00; font-size:12px;">*</a></label>
                                    <select class="custom-select parentid search_select gl_parent_id" name="cat" required style="cursor: pointer;">
                                        <option selected value="">--select--</option>

                                        <?php
                                        $i = 0;
                                        foreach ($main_categories as $parent) {
                                            ?>    
                                            <option data-url="" value="<?php echo $parent->id; ?>"
                                                    data-ctype=""
                                                    <?php echo set_select('cat', $parent->id); ?>>
                                                        <?php
                                                        echo $parent->category;
                                                        ?></option>
                                            <?php
                                        }
                                        ?>    

                                    </select>
                                    <span class="error">
                                        <?php echo form_error('cat'); ?>
                                    </span>
                                </div>

                                <div class="form-group" style="display:none;">
                                    <label class="col-form-label">Service</label>
                                    <select class="custom-select search_select" name="parent_product" style="cursor: pointer;">
                                        <option selected value="0">--select--</option>

                                        <?php                                                                              
                                        foreach ($products_list as $products_val) {
                                            ?>    
                                            <option value="<?php echo $products_val->id; ?>"
                                                    
                                                    <?php echo set_select('parent_product', $products_val->id); ?>>
                                                        <?php
                                                        echo $products_val->product_display_name;
                                                        ?></option>
                                            <?php
                                        }
                                        ?>    

                                    </select>
                                    <span class="error">
                                        <?php // echo form_error('parent_product'); ?>
                                    </span>
                                </div>

                                <div class="form-group" style="display:none;">
                                    <label class="col-form-label">Type<a style="color:#F00; font-size:12px;">*</a></label>
                                    <select class="custom-select search_select gl_image_type" name="image_type" style="cursor: pointer;">
                                        <option selected value="">--select--</option>

                                        <?php
                                        $i = 0;
                                        $image_type_list = array("medium", "large");
                                        foreach ($image_type_list as $image_type) {
                                            ?>    
                                            <option value="<?php echo $image_type; ?>"
                                                    data-ctype=""
                                                    <?php echo set_select('image_type', $image_type); ?>>
                                                        <?php
                                                        echo $image_type;
                                                        ?></option>
                                            <?php
                                        }
                                        ?>    

                                    </select>
                                    <span class="error">
                                        <?php echo form_error('image_type'); ?>
                                    </span>
                                </div>

                                <?php /**/ ?><div class="form-group" style="display:none;">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="" value="<?php // echo set_value('title'); ?>Image" />
                                    <span class="error"><?php echo form_error('title'); ?></span>
                                </div><?php /**/ ?>

                                <?php
                                $banner_seo_alt = '';
                                $banner_seo_title = '';
                                ?>

                                <div class="form-group" <?php // echo $this->common_model->admin_or_super_admin(); ?> style="display:none;">
                                    <label for="description">Description</label>

                                    <div class="input-group mb-3" <?php // echo $this->common_model->admin_or_super_admin(); ?>>
                                        <textarea rows="4" name="description" id="description" class="form-control" placeholder="" aria-label=""></textarea>
                                    </div>  

                                </div>                                  

                                <div class="form-group">
                                    <label for="seo_alt">Image SEO Alt</label>
                                    <input type="text" name="seo_alt" class="form-control" id="seo_alt" value="<?php
                                      echo set_value('seo_alt');
                                    ?>" placeholder="" required />

                                </div>         

                                <div class="form-group">
                                    <label for="seo_title">Image SEO Title</label>
                                    <input type="text" name="seo_title" class="form-control" id="seo_title" placeholder="" value="<?php echo set_value('seo_title'); ?>" required />

                                </div>                                                 
                            
                                <div class="form-group">

                                    <label>Image Upload</label>

                                    <?php
                                    $cat_combo_id = 64;
                                    $combo_details = $this->image_model->GetByRow_notrash('cms_image_combo', $cat_combo_id, 'id');
                                    $upload_type = $combo_details->upload_type;

                                    $upload_type_details = $this->image_model->GetByRow_notrash('cms_upload_types', $upload_type, 'id');
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
                                            <input type="file" data-formclass="gl_multiple_upload_form" data-formtype="edit" data-controller="ecproductadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="multiple" data-imageid="gl_image_upload1" class="custom-file-input gl_image_upload1 gl_uploadimage" name="images[]" id="images" data-input_name="images" data-combo_name="combo" style="cursor: pointer;" multiple required />
                                            <input type="hidden" class="file_input_name" name="file_input_name" value="">
                                            <input type="hidden" class="combo_name" name="combo_name" value="">

                                            <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>

                                            <input type="hidden" name="final_images" value="<?php echo set_value('final_images'); ?>" id="gl_image_upload1-final_images" class="gl_upload1_final_images_string">
                                        </div>

                                    </div>

                                    <div class="alert-items gl_upload_alert alert-dismiss">

                                    </div>

                                </div>

                                <?php /**/ ?><div class="form-group">
                                    <label for="order_number">Order</label>
                                    <input type="number" name="order_number" class="form-control" id="order_number" placeholder="" value="<?php
                                    if (isset($_POST['order_number']) && $_POST['order_number'] != '') {
                                        echo set_value('order_number');
                                    } else {
                                        echo '0';
                                    }
                                    ?>" required />
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

<?php /* ?><script type="text/javascript">

    $(document).ready(function () {

        $("body").on("change", ".gl_image_upload1", function (e) {
            var file = e.target.files[0].name;

            var string_data = '<div class="alert alert-success" role="alert">The file ' + file + ' has been selected.</div>';
        //  alert('The file "' + file + '" has been selected.');

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
        //  alert(html);
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

</script><?php /**/ ?>

<script type="text/javascript">
    $("body").on("change", ".gl_image_type", function () {
        var type_val = $(this).val();

        if (type_val == 'large') {
            $(".gl_image_type_parameters2").show();
            $(".gl_image_type_parameters1").hide();
        } else {
            $(".gl_image_type_parameters1").show();
            $(".gl_image_type_parameters2").hide();
        }
    });
</script>

<script type="text/javascript">
    $("body").on("change", ".gl_parent_id", function () {
        var cat_id = $(this).val();
        
        if(cat_id != ""){
        
            $.ajax({
                url: "<?php echo base_url(); ?>commonimageadmin/get_image_attributes",
                type: "post",
                data: {catid: cat_id},
                cache: false,
                success: function (response) {

                    $(".gl_attributes_div").html(response);

                }

            });

        }

    });
</script>

<script type="text/javascript">

    $(document).ready(function () {
        //var i=1;  
       
        $("body").on("change", ".gl_image_upload1", function (e) {
            $(".gl_danger_alert_div").hide();
            
            var current_image_string = "";
            var current_image_string_final = "";

            var error_string_data = '<div class="alert alert-danger gl_danger_alert_div alert-dismissible" role="alert">Error !  Please select the correct format file.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
            //alert($("#combo").val());
            ajaxindicatorstart('');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'commonimageadmin/bannerUpload'; ?>",
                cache: false,
                data: new FormData(document.getElementById("gl_current_image_upload_form_id")),
                contentType: false,
                processData: false,
                success: function (html) {
                   //alert(html);
                    ajaxindicatorstop();
                    if (html != '') {
                        for(var c_i=0;c_i<e.target.files.length;c_i++){
            
                            var file = e.target.files[c_i].name;                            
                            var string_data = '<div class="alert alert-success" role="alert">The file ' + file + ' has been selected.</div><div class="form-group" style="display: none;"><select required name="imagetype[]" class="custom-select" style="cursor: pointer;"><option value="other">other</option></select></div>';
                            $(".gl_upload_alert").append(string_data);
                        }
                        
                    } else {
                        $(".gl_upload_alert").append(error_string_data);

                        $(".gl_image_upload1").val();
                    }
                    
                        current_image_string = $(".gl_upload1_final_images_string").val();
                        
                        if(current_image_string != ''){
                            if(html != ''){
                                current_image_string_final = current_image_string + ',' + html;
                            }else{
                                current_image_string_final = current_image_string; 
                            }
                            
                        }else{
                            current_image_string_final = html;
                        }    
                        $(".gl_upload1_final_images_string").val(current_image_string_final);
                    
                }
            });


        });    
    });

</script>