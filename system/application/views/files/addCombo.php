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
                            <h4 class="header-title">Add Combo</h4>

                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'fileuploadadmin/addCombo/'; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                                <?php /**/ ?><?php /**/ ?>

                                <div class="form-group">
                                    <label for="combo_name">Name<a style="color:#F00; font-size:12px;">*</a></label>
                                    <input type="text" name="combo_name" class="form-control" id="combo_name" value="<?php echo set_value('combo_name'); ?>" placeholder="" required>

                                    <span class="error">
                                        <?php echo form_error('combo_name'); ?>
                                    </span>                                    
                                </div>                                                             

                                <div class="form-group">
                                    <label class="col-form-label">Upload Type</label>
                                    <select class="custom-select search_select" name="uploadtype" id="uploadtype" required style="cursor: pointer;">
                                        <option selected value="">--select--</option>
                                        <?php
                                        foreach ($data as $uploadtype) {
                                            ?>    
                                            <option value="<?php echo $uploadtype->id; ?>"                                                    
                                                    <?php                                                    
                                                    if(isset($_GET['uid'])) {
                                                        if($_GET['uid'] == $uploadtype->id) {
                                                            echo 'selected';
                                                        }
                                                    }                                                    
                                                    ?>><?php
                                                        echo $uploadtype->type_name;
                                                        ?>
                                            </option>
                                            <?php
                                        }
                                        ?>  
                                    </select>
                                    <span class="error">
                                         <?php echo form_error('uploadtype'); ?>
                                    </span>
                                </div>
                                
                                <?php
                                $manipulations = $this->file_model->Get_all('cms_image_manipulation');
                                ?>
                                
                                <div class="form-group">
                                    <label class="col-form-label">Manipulation<a style="color:#F00; font-size:12px;">*</a></label>
                                    <select class="custom-select search_select" name="manipulation" id="manipulation" required style="cursor: pointer;">
                                        <option selected value="0">--select--</option>
                                        <?php
                                        foreach ($manipulations as $manip_data) {
                                            ?>    
                                            <option value="<?php echo $manip_data->id; ?>">
                                                <?php
                                                     echo $manip_data->manipulation_name;
                                                ?>
                                            </option>
                                            <?php
                                        }
                                        ?>  
                                    </select>
                                    <span class="error">                                         
                                    </span>
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

