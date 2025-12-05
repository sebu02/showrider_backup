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


                <?php
                $per_page = '';
                if (isset($_GET['per_page'])) {
                    $per_page = '&per_page=' . $_GET['per_page'];
                }


                $ftype = '';
                $shop_url = '';

                $function_type = 'product';

                $catname = "";
                $ctypeid = "";
                $ctypeurl = "";
                ?>



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

                            <h4 class="header-title">Edit Category</h4>

                            <a href="<?php echo base_url() . 'ecproductadmin/edit_prodcategory?id=' . $single_detail->id . $per_page; ?>"><button type="button" class="btn btn-flat btn-outline-success mb-3">STEP 1</button></a>
                            <a href="javascript:void(0);"><button style="background-color:#28a745;color: #fff;" type="button" class="btn btn-flat btn-outline-success mb-3">STEP 2</button></a>
                            <a href="<?php echo base_url() . 'ecproductadmin/edit_prodcategory3?id=' . $single_detail->id . $per_page; ?>"><button type="button" class="btn btn-flat btn-outline-success mb-3">STEP 3</button></a>



                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'ecproductadmin/edit_prodcategory2?' . $_SERVER['QUERY_STRING']; ?>" method="post" enctype="multipart/form-data" autocomplete="off" id="gl_current_image_upload_form_id">



                                <div class="form-group">
                                    <label for="bannertitle">Title</label>
                                    <input type="text" name="bannertitle" class="form-control" id="bannertitle" placeholder="" value="<?php echo $single_detail->banner_title; ?>" />

                                </div>

                                <div class="form-group">
                                    <label for="banner_description">Short Description</label>
                            
                                    <div class="input-group mb-3">

                                        <textarea rows="5" name="banner_description" id="banner_description" class="form-control"><?php echo $single_detail->banner_description; ?></textarea>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="category_description">Brief Description</label>
                                  
                                    <div class="input-group mb-3">

                                        <textarea rows="5" name="category_description" id="editor" class="form-control" placeholder="" aria-label=""><?php echo $single_detail->category_description; ?></textarea>
                                    </div>

                                </div> 


                                <?php $default_combo_list = json_decode($this->common_model->option->default_combo_list, TRUE); ?>

                                <?php
                                $banner_seo_alt = '';
                                $banner_seo_title = '';
                                $banner = json_decode($single_detail->category_picture);
                                if (!empty($banner[0]->seo_alt)) {
                                    $banner_seo_alt = $banner[0]->seo_alt;
                                }
                                if (!empty($banner[0]->seo_title)) {
                                    $banner_seo_title = $banner[0]->seo_title;
                                }



                                if ($banner != NULL) {
                                    if ($banner[0]->image != '') {
                                        ?>
                                        <div class="form-group" >
                                                <label for="normal">Category Image</label>
                                                
                                                <div class="form-group" >

                                                    <img src="<?php echo base_url() . 'media_library/' . $banner[0]->image; ?>" alt="image" title="image" style="max-height: 500px;">
                                                    <input type="hidden" name="mediaID" value="<?php echo $banner[0]->media_id; ?>" />
                                                </div>

                                        </div>

                                        <?php
                                    }
                                }
                                ?>      



                                <?php /* ?><div class="form-group">
                                    <label for="seo_alt"><b>Image SEO Alt</b></label>
                                    <input type="text" name="seo_alt" class="form-control" id="seo_alt" value="<?php
                                echo $banner_seo_alt;
                                ?>" placeholder="" />


                                </div><?php /**/ ?>

                                <?php /* ?><div class="form-group">
                                    <label for="seo_title"><b>Image SEO Title</b></label>
                                    <input type="text" name="seo_title" class="form-control" id="seo_title" placeholder="" value="<?php echo $banner_seo_title; ?>" />

                                </div><?php /**/ ?>
                                
                                <?php
                                $cat_combo_id = 60;
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
                                ?>

                                <div class="form-group" >
                                    <label>Image Upload</label>
                                 

                                    <div class="alert-items">
                                        <div class="alert alert-warning" role="alert">
                                            (Allowed Types : <?php echo $allowed_types; ?>) &nbsp; (File size must less than 2MB) &nbsp; 
                                            <?php
                                            if ($upload_type_details->manipulation_status == "Yes") {
                                                ?>
                                                (Width : <?php echo $max_width; ?>px , Height : <?php echo $max_height; ?>px)
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

                                            <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>

                                            <input type="hidden" name="final_images" value="<?php echo set_value('final_images'); ?>" id="gl_image_upload1-final_images" class="gl_upload1_final_images_string">
                                        </div>

                                    </div>

                                    <div class="alert-items gl_upload_alert">

                                    </div>

                                </div>


                                <?php /* ?><div class="form-group">
                                    <label for="page_title">Meta Title<b style="color:#F00; font-size:11px;"></b></label>
                            

                                    <div class="input-group mb-3">

                                        <textarea rows="2" name="page_title" id="page_title" class="form-control" placeholder="" aria-label="" required><?php echo $single_detail->title; ?></textarea>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="seo_description">Meta Description<b style="color:#F00; font-size:11px;"></b></label>
                            

                                    <div class="input-group mb-3">

                                        <textarea rows="3" name="seo_description" id="seo_description" class="form-control" placeholder="" aria-label="" required><?php echo $single_detail->description; ?></textarea>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label for="seo_keywords">Meta Keywords<b style="color:#F00; font-size:11px;"></b></label>
                                

                                    <div class="input-group mb-3">

                                        <textarea rows="3" name="seo_keywords" id="tags" class="form-control" placeholder="" aria-label="" required><?php echo $single_detail->keywords; ?></textarea>
                                    </div>

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

    $(document).ready(function () {
//    $('input[type="file"]').change(function(e) {
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