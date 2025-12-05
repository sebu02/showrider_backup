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
                <h4 class="page-title pull-left">Manage Videos</h4>

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
                            
                            <h4 class="header-title">Add Video</h4>                                                     
                            
                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'videogalleryadmin/add_video/'; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                               
                                <div class="form-group">
                                    <label class="col-form-label">Category<a style="color:#F00; font-size:12px;">*</a></label>
                                    <select class="custom-select parentid search_select" name="cat" required style="cursor: pointer;">
                                        <option selected value="">--select--</option>

                                        <?php
                                        $i = 0;
                                        foreach ($main_categories as $parent) {
                                            ?>    
                                            <option value="<?php echo $parent->id; ?>"                                                    
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
                                
                                <div class="form-group">
                                    <label for="title">Title<a style="color:#F00; font-size:12px;">*</a></label>
                                    <input type="text" name="title" class="form-control" id="title" value="<?php echo set_value('title'); ?>" placeholder="" required>


                                    <span class="error">
                                        <?php echo form_error('title'); ?>
                                    </span>                                    
                                </div>
                                
                                <div class="form-group" style="display:none;">
                                    <label for="description">Description</label>                                                                
                                    <div class="input-group mb-3">
                                        <textarea rows="4" name="description" id="description" class="form-control"></textarea>
                                    </div>                                 
                                </div>
                                                                
                                <div class="form-group gl_video_link_div">
                                    <label for="video_link">Video Link</label>
                                    <input type="text" name="video_link" class="form-control gl_video_link" id="video_link" value="<?php echo set_value('video_link'); ?>" required>

                                    <span class="error">
                                        <?php echo form_error('video_link'); ?>
                                    </span>                                    
                                </div>

                                <div class="form-group gl_video_file_div" style="display:none;">
                                    <label>Video Upload</label>

                                    <div class="alert-items">
                                        <div class="alert alert-warning" role="alert">
                                            (Allowed Types : mp4) &nbsp; (File size must less than 10MB)                                         
                                            
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <div class="custom-file">
                                             <input type="file" class="custom-file-input gl_video_file" name="video_file" id="video_file" style="cursor: pointer;" />
                                             <label class="custom-file-label" for="video">Choose File</label>
                                        </div>
                                    </div>
                                    <span class="error">
                                        <?php echo form_error('video_file'); ?>
                                    </span>  
                                </div>

                                <div class="alert-items gl_upload_alert alert-dismiss" style="display:none;">

                                </div>

                                <div class="form-group">
                                    <label for="order_number">Order</label>
                                    <input type="number" name="order_number" class="form-control" id="order_number" min="0" value="<?php
                                    if (isset($_POST['order_number']) && $_POST['order_number'] != '') {
                                        echo set_value('order_number');
                                    } else {
                                        echo '0';
                                    }
                                    ?>" required />
                                    <span class="error"><?php echo form_error('order_number'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="active_status">Active Status</label><br/>                                

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="a" id="active_status1" name="active_status" class="custom-control-input"

                                            <?php
                                            if (isset($_POST['active_status'])) {
                                                if ($_POST['active_status'] == 'a')
                                                    echo 'checked';
                                            }
                                            else {
                                                echo 'checked';
                                            }
                                            ?> />
                                        <label class="custom-control-label" for="active_status1" style="cursor: pointer;">Active</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="d" id="active_status2" name="active_status" class="custom-control-input"

                                            <?php
                                            if (isset($_POST['active_status'])) {
                                                if ($_POST['active_status'] == 'd')
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
    $("body").on("change", ".gl_video_file", function (e) {
        ajaxindicatorstart('');

        var file_name = e.target.files[0].name;
        var file_ext = $(this).val().split('.').pop().toLowerCase(); 
        var file_size = $(this)[0].files[0].size;        
        var fixed_file_size = 10 * 1048576;
        var check_type = 1;

        var string_data = '<div class="alert alert-success" role="alert">The file ' + file_name + ' has been selected.</div>';
        var error_string_data = '<div class="alert alert-danger alert-dismissible" role="alert">Error !  Please select the correct format file.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
        
        var ftypes = ["mp4"];

        if(jQuery.inArray(file_ext, ftypes) == -1) {                                                                     
            check_type = 0;
        }        
        
        if(file_size >= fixed_file_size){          

            error_string_data = '<div class="alert alert-danger alert-dismissible" role="alert">Error !  File size exceeded the limit.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
            
            check_type = 0;
        }

        if(check_type == 1){
            ajaxindicatorstop();
            $(".gl_upload_alert").html(string_data);
            
        }else{
            ajaxindicatorstop();
            $(".gl_video_file").val('');
            $(".gl_upload_alert").html(error_string_data);
            
        }        

    });

});
</script>   
