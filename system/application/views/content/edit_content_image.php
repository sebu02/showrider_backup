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
                <h4 class="page-title pull-left">Manage Contents</h4>


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

                            <h4 class="header-title">Edit File</h4>





                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" id="gl_current_image_upload_form_id" action="<?php echo base_url() . 'contentadmin/edit_content_image/' . $this->uri->segment(3) . '/' . $this->uri->segment(4); ?>" method="post" enctype="multipart/form-data" autocomplete="off">


                                <?php /**/ ?><div class="form-group">
                                    <label for="product_name">Content Name</label>
                                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="" value="<?php echo $values1->title; ?>" readonly />
                                    <span class="error"><?php // echo form_error('title');  ?></span>
                                </div><?php /**/ ?>
                                
                                <?php
                                                                
                                $category_details = $this->content_model->GetByRow('cms_dynamic_category', $values1->prod_cat, 'id');
                                $cat_combo_id = $category_details->category_default_combo_id;
                                
                                $combo_details = $this->content_model->GetByRow_notrash('cms_image_combo', $cat_combo_id, 'id');
                                $upload_type = $combo_details->upload_type;
                                
                                $upload_type_details = $this->content_model->GetByRow_notrash('cms_upload_types', $upload_type, 'id');
                                $upload_preferences = $upload_type_details->preferences;
                                
                                $upload_preferences_arr = json_decode($upload_preferences , TRUE);                                                              
                                $img_width = $upload_preferences_arr['max_width'];
                                $img_height = $upload_preferences_arr['max_height'];
                                
                                $file_type = $upload_type_details->file_type;
                                
                                if($file_type == "image"){
                                    $allowed_types = "gif , jpg , png , svg";                                    
                                }else{
                                    $allowed_types = "jpg , png , pdf , doc , docx , ppt , pptx , txt";
                                }
                                
                                $banner = json_decode($values1->images);
                                $pos = $this->uri->segment(4);

                                $seo_alt = '';$seo_title = '';$title = '';$brief_details = '';
                                if(!empty($banner[$pos]->seo_alt)){ $seo_alt = $banner[$pos]->seo_alt; }
                                if(!empty($banner[$pos]->seo_title)){ $seo_title = $banner[$pos]->seo_title; }
                                if(!empty($banner[$pos]->title)){ $title = $banner[$pos]->title; }
                                if(!empty($banner[$pos]->brief_details)){ $brief_details = $banner[$pos]->brief_details; }

                                if ($banner != NULL) {
                                    if ($banner[$pos]->image != '') {
                                        ?>
                                        <div class="form-group">
                                            <label for="normal">Current File</label>
                                        
                                        <div class="form-group">                                            
                                            <img src="<?php echo base_url() . 'media_library/' . $banner[$pos]->image; ?>" alt="file" title="file" style="max-height: 300px;">
                                            <input type="hidden" name="mediaID" value="<?php echo $banner[$pos]->media_id; ?>" >
                                        </div>

                                        </div>

                                        <?php
                                    }
                                }
                                ?> 


                                <div class="form-group">
                                    <label for="seo_alt">File SEO Alt</label>
                                    <input type="text" name="seo_alt" class="form-control" id="seo_alt" value="<?php
                                echo $seo_alt;
                                ?>" placeholder="" required />

                                </div>


                                <div class="form-group">
                                    <label for="seo_title">File SEO Title</label>
                                    <input type="text" name="seo_title" class="form-control" id="seo_title" placeholder="" value="<?php echo $seo_title; ?>" required />

                                </div>

                                <div class="form-group">
                                    <label>File Upload</label>
                                

                                <div class="alert-items">
                                    <div class="alert alert-warning" role="alert">
                                        (Allowed Types : <?php echo $allowed_types; ?>) &nbsp; (File size must less than 2MB) &nbsp;
                                        <?php
                                        if($upload_type_details->manipulation_status == "Yes"){
                                        ?>
                                          (Width : <?php echo $img_width; ?>px , Height : <?php echo $img_height; ?>px)
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="hidden" name="combo" id="combo" data-imageid="gl_image_upload1" value="<?php echo $cat_combo_id; ?>" />


                                    <div class="custom-file">
                                        <input type="file" data-formclass="gl_multiple_upload_form" data-formtype="edit" data-controller="ecproductadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="single" data-imageid="gl_image_upload1" class="custom-file-input gl_image_upload1 gl_uploadimage" name="images[]" id="images" data-input_name="images" data-combo_name="combo" style="cursor: pointer;" />
                                        <input type="hidden" class="file_input_name" name="file_input_name" value="">
                                        <input type="hidden" class="combo_name" name="combo_name" value="">

                                        <label class="custom-file-label" for="">Choose File</label>

                                        <input type="hidden" name="final_images" value="<?php echo set_value('final_images'); ?>" id="gl_image_upload1-final_images" class="gl_upload1_final_images_string">
                                    </div>

                                </div>

                                <div class="alert-items gl_upload_alert">

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