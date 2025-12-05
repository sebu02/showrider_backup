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
                <h4 class="page-title pull-left">Manage File Upload</h4>


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
                            <h4 class="header-title">Edit Upload Type</h4>

                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'fileuploadadmin/editUpload_type/' . $this->uri->segment(3); ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                                <?php /**/ ?><div class="form-group">
                                    <label class="col-form-label">FIle Type<a style="color:#F00; font-size:12px;">*</a></label>
                                    <select class="custom-select search_select" name="file_type" required style="cursor: pointer;">
                                        <option selected value="">--select--</option>

                                        <?php
                                        $file_type = array("image", "brochure");
                                        foreach ($file_type as $type) {
                                            ?>    
                                            <option value="<?php echo $type; ?>" <?php if ($values->file_type == $type) {
                                            echo "selected";
                                        } ?>><?php
                                            echo $type;
                                            ?></option>
                                            <?php
                                        }
                                        ?>  

                                    </select>
                                    <span class="error">                                        
                                    </span>
                                </div><?php /**/ ?>

                                <div class="form-group">
                                    <label for="typename">Name<a style="color:#F00; font-size:12px;">*</a></label>
                                    <input type="text" name="typename" class="form-control" id="typename" value="<?php echo $values->type_name; ?>" placeholder="" required>

                                    <span class="error">
<?php echo form_error('typename'); ?>
                                    </span>                                    
                                </div>                                                             

                                <?php
                                $preferences = $values->preferences;
                                $preferences = json_decode($preferences);
                                ?>

                                <div class="form-group">
                                    <label for="max_width">Max Width (px)</label>
                                    <input type="number" name="max_width" class="form-control" id="max_width" min="0" placeholder="" value="<?php
                                    if ($preferences->max_width != '') {
                                        echo $preferences->max_width;
                                    } else {
                                        echo '0';
                                    }
                                    ?>" />
                                    <span class="error"><?php echo form_error('max_width'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="max_height">Max Height (px)</label>
                                    <input type="number" name="max_height" class="form-control" id="max_height" min="0" placeholder="" value="<?php
                                    if ($preferences->max_height != '') {
                                        echo $preferences->max_height;
                                    } else {
                                        echo '0';
                                    }
                                    ?>" />
                                    <span class="error"><?php echo form_error('max_height'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="manipualtion">Image Manipulation</label>

                                </div>    

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="Yes" id="manipualtionY" name="manipualtion" class="custom-control-input"

<?php if ($values->manipulation_status == 'Yes') {
    echo "checked='true'";
} ?> />
                                    <label class="custom-control-label" for="manipualtionY" style="cursor: pointer;">Yes</label>
                                </div>


                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="No" id="manipualtionN" name="manipualtion" class="custom-control-input"

<?php if ($values->manipulation_status == 'No') {
    echo "checked='true'";
} ?> />
                                    <label class="custom-control-label" for="manipualtionN" style="cursor: pointer;">No</label>
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

