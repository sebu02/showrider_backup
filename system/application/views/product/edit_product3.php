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

                            <h4 class="header-title">Edit Service</h4>

                            <a href="<?php echo base_url() . 'ecproductadmin/edit_product?id=' . $product->id . $per_page; ?>"><button type="button" class="btn btn-flat btn-outline-success mb-3">STEP 1</button></a>
                            <a href="<?php echo base_url() . 'ecproductadmin/editProducts2?id=' . $product->id . $per_page; ?>"><button  type="button" class="btn btn-flat btn-outline-success mb-3">STEP 2</button></a>
                            <a href="javascript:void(0);"><button style="background-color:#28a745;color: #fff;" type="button" class="btn btn-flat btn-outline-success mb-3">STEP 3</button></a>

                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'ecproductadmin/editProducts3?id=' . $product->id . $per_page; ?>" method="post" enctype="multipart/form-data" autocomplete="off" id="gl_current_image_upload_form_id">

                               

                                
                                <!-- <div class="form-group"></div> -->
                                
                                <div class="form-group">
                                    <label>Image Upload</label>
                                
                                
                                <?php
                                $cat_combo_id = $prod_cat_row->category_default_combo_id;
                               
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
                               
                                <div class="alert-items">
                                    <div class="alert alert-warning" role="alert">
                                        (Allowed Types => <?php echo $allowed_types; ?>) (File size must less than 2MB) <br>
                                        <?php                                     
                                        if ($upload_type_details->manipulation_status == "Yes") {
                                            ?>
                                            (thumbnail => Width : <?php echo $max_width; ?>px , Height : <?php echo $max_height; ?>px)<br>

                                            <!-- (thumbnail => Width : 300px , Height : 194px)<br> -->

                                            <!-- (banner => Width : 1920px , Height : 981px)  -->

                                            <!-- <br>(other => Width : any, Height : any) -->

                                            <!-- <br>(other - half width => Width : 820px, Height : 1200px)
                                            <br>(other - full width => Width : 1680px, Height : 1120px) -->
                                         
                                           <?php                                      
                                           }
                                        ?> 
                                       
                                          
                                    </div>
                                </div>
                                
                                <div class="input-group mb-3">
                                    <input type="hidden" name="combo" id="combo" data-imageid="gl_image_upload1" value="<?php echo $cat_combo_id; ?>" />

                                    <div class="custom-file">
                                        <input type="file" data-formclass="gl_multiple_upload_form" data-formtype="edit" data-controller="ecproductadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="multiple" data-imageid="gl_image_upload1" class="custom-file-input gl_image_upload1 gl_uploadimage" name="images[]" id="images" data-input_name="images" data-combo_name="combo" style="cursor: pointer;" multiple />
                                        <input type="hidden" class="file_input_name" name="file_input_name" value="">
                                        <input type="hidden" class="combo_name" name="combo_name" value="">

                                        <label class="custom-file-label" for="">Choose Image</label>

                                        <input type="hidden" name="final_images" value="<?php echo set_value('final_images'); ?>" id="gl_image_upload1-final_images" class="gl_upload1_final_images_string">
                                    </div>

                                </div>
                                
                                <div class="alert-items gl_upload_alert alert-dismiss">

                                </div>
                                </div> 

                                <div class="form-group">
                                   <a href="<?php echo base_url() . 'ecproductadmin/view_product_gallery/' . $product->id; ?>" target="_blank">
                                    <button type="button" class="btn btn-flat btn-info btn-sm mb-2 mt-2">
                                      View Service Gallery
                                    </button>
                                   </a>
                                </div>
                               
                                <div class="form-group">
                                    <label for="seo_title">Meta Title<b style="color:#F00; font-size:11px;"></b></label>
                            

                                <div class="input-group mb-3">
                                    <textarea rows="2" name="seo_title" id="page_title" class="form-control" required><?php echo $product->seo_title; ?></textarea>
                                </div>

                                </div>

                                <div class="form-group">
                                    <label for="seo_description">Meta Description<b style="color:#F00; font-size:11px;"></b></label>
                            

                                <div class="input-group mb-3">

                                    <textarea rows="3" name="seo_description" id="seo_description" class="form-control" required><?php echo $product->seo_description; ?></textarea>
                                </div>

                                </div>


                                <div class="form-group">
                                    <label for="seo_keywords">Meta Keywords<b style="color:#F00; font-size:11px;"></b></label>
                        

                                <div class="input-group mb-3">

                                    <textarea rows="3" name="seo_keywords" id="tags" class="form-control" required><?php echo $product->seo_keywords; ?></textarea>
                                </div>

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
