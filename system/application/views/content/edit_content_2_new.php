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

<?php
$single_detail = $images;

$cat_id = $single_detail->prod_cat;
$cat_details = $this->content_model->GetByRow_notrash('cms_dynamic_category', $cat_id, 'id');

$content_inputs_tree_array = array();

$display_style = "style='display:none;'";
?>

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

                            <h4 class="header-title">Edit Content</h4>
                            <a href="<?php echo base_url() . 'contentadmin/edit_content/'.$current_id.'?' . $_SERVER['QUERY_STRING']; ?>"><button type="button" class="btn btn-flat btn-outline-success mb-3">STEP 1</button></a>
                            <a href="javascript:void(0);"><button style="background-color:#28a745;color: #fff;" type="button" class="btn btn-flat btn-outline-success mb-3">STEP 2</button></a>

                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" id="gl_current_image_upload_form_id" action="<?php echo base_url() . 'contentadmin/edit_content_2/' . $current_id . '/?' . $_SERVER['QUERY_STRING']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                                            
                               
                                <?php
                                $banner_seo_alt = '';
                                $banner_seo_title = '';
                                ?>

                                <div class="form-group">
                                    <label for="first_title">First Title</label>
                                    <input type="text" name="first_title" class="form-control" id="first_title" value="<?php
                                    echo $single_detail->content_title;
                                    ?>" placeholder="" />

                                </div>
                                
                                <div class="form-group">
                                    <label for="second_title">Second Title</label>
                                    <input type="text" name="second_title" class="form-control" id="second_title" value="<?php
                                    echo $single_detail->second_title;
                                    ?>" placeholder="" />

                                </div>
                                
                                <div class="form-group">
                                    <label for="content_date">Date</label>
                                    <input type="date" name="content_date" class="form-control" id="content_date" placeholder="" value="<?php echo date('Y-m-d', strtotime($single_detail->content_date)); ?>" />

                                </div> 

                                <div class="form-group">
                                    <label for="short_description">Short Description</label>                                 

                                    <div class="input-group mb-3">
                                        <textarea rows="4" name="short_description" id="short_description" class="form-control" placeholder="" aria-label=""><?php echo $single_detail->content_short_description; ?></textarea>
                                    </div>                                    
                                </div>    
                                
                                <div class="form-group">
                                    <label for="brief_description">Brief Description</label>
                                                               
                                    <div class="input-group mb-3">

                                        <textarea rows="5" name="brief_description" id="editor" class="form-control" placeholder="" aria-label=""><?php echo $single_detail->brief_details; ?></textarea>
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label for="third_title">Video Link</label>
                                    <input type="text" name="third_title" class="form-control" id="third_title" value="<?php
                                    echo $single_detail->thirdtitle;
                                    ?>" placeholder="" />

                                </div>
                                
                                <div class="form-group">
                                    <a href="<?php echo base_url(); ?>contentadmin/view_content_gallery/<?php echo $images->id; ?>" target="_blank">
                                        <button type="button" class="btn btn-flat btn-info btn-sm mt-2 mb-1">View Content Gallery</button>
                                    </a>
                                </div>    
                                
                                <!--<div class="form-group"></div>-->
                                <?php
                                
                                
                                $cat_combo_id = $cat_details->category_default_combo_id;
                                $combo_details = $this->content_model->GetByRow_notrash('cms_image_combo', $cat_combo_id, 'id');
                                $upload_type = $combo_details->upload_type;
                                
                                $upload_type_details = $this->content_model->GetByRow_notrash('cms_upload_types', $upload_type, 'id');
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
                                                                
                                <div class="form-group">
                                    <label>File Upload</label>
                                                                
                                    <div class="alert-items">
                                        <div class="alert alert-warning" role="alert">
                                            (Allowed Types : <?php echo $allowed_types; ?>) &nbsp; (File size must less than 2MB) &nbsp; 
                                                <?php
                                                if($upload_type_details->manipulation_status == "Yes"){
                                                ?>
                                                (Width : <a class="gl_current_img_width"><?php echo $max_width; ?></a>px , Height : <a class="gl_current_img_height"><?php echo $max_height; ?></a>px)
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

                                            <label class="custom-file-label" for="inputGroupFile01">Choose File</label>

                                            <input type="hidden" name="final_images" value="<?php echo set_value('final_images'); ?>" id="gl_image_upload1-final_images" class="gl_upload1_final_images_string">
                                        </div>
                                    </div>                               
                                                                
                                    <div class="alert-items gl_upload_alert">

                                    </div>                                    
                                </div>     
                                
                                <?php
                                    $custom_link_array = json_decode($single_detail->custom_link, TRUE);
                                    $link_type = $custom_link_array['link_type'];
                                    $link_text = $custom_link_array['link_text'];
                                    $target_type = $custom_link_array['target_type'];
                                    $type3 = $custom_link_array['type3'];
                                ?>

                                <div class="form-group">
                                    <label for="customlink">Custom Link</label><br/>
                                  
                                
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="internal" id="customlink1" name="customlink" class="custom-control-input gl_customlink_type"

                                        <?php
                                        if (isset($custom_link_array['link_type'])){
                                              if($custom_link_array['link_type'] == 'internal'){
                                                  echo ' checked';
                                              }
                                        }else {
                                            echo ' checked';
                                        }
                                        ?> />
                                    <label class="custom-control-label" for="customlink1" style="cursor: pointer;">Internal</label>
                                </div>
                                
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="external" id="customlink2" name="customlink" class="custom-control-input gl_customlink_type"

                                           <?php
                                           if (isset($custom_link_array['link_type'])) {
                                               if ($custom_link_array['link_type'] == 'external'){
                                                   echo 'checked';
                                               }    
                                           }
                                           ?> />
                                    <label class="custom-control-label" for="customlink2" style="cursor: pointer;">External</label>
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
                                        <option value="_self">--target type--</option>
                                        <?php
                                        if ($target_array != NULL) {
                                            foreach ($target_array as $target_key => $targettype) {
                                                ?>

                                                <option value="<?php echo $target_key; ?>"
                                                        <?php /**/ if ($target_type == $target_key) {
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
                                
                                <div class="form-group" <?php echo $this->common_model->admin_or_super_admin(); ?>>
                                    <label for="icon_class">Icon Class</label> 
                                    <input type="text" name="icon_class" class="form-control" id="icon_class" placeholder="" value="<?php echo $single_detail->iconClass; ?>" /> 
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

<script type="text/javascript">
    $("body").on("change", ".gl_customlink_type", function () {
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
