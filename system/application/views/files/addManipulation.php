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
                            <h4 class="header-title">Add Manipulation</h4>

                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'fileuploadadmin/addManipulation?'.$_SERVER['QUERY_STRING']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                                                
                                <?php
                                $manipulation_name = set_value('manipulation_name');
                                if(isset($_GET['uid'])) {
                                $uid = $_GET['uid'];
                                $uploadtype_row = $this->file_model->GetByRow('cms_upload_types', $uid, 'id');
                                $manipulation_name = $uploadtype_row->type_name;
                                }
                                ?>

                                <div class="form-group">
                                    <label for="manipulation_name">Name<a style="color:#F00; font-size:12px;">*</a></label>
                                    <input type="text" name="manipulation_name" class="form-control" id="manipulation_name" value="<?php echo $manipulation_name; ?>" placeholder="" required>

                                    <span class="error">
                                        <?php echo form_error('manipulation_name'); ?>
                                    </span>                                    
                                </div>                                                             


                                <div class="form-group">
                                    <label for="original_width">Original Width (px)</label>
                                    <input type="number" name="original_width" class="form-control" id="original_width" min="1" placeholder="" value="<?php
                                    if (isset($_POST['original_width']) && $_POST['original_width'] != '') {
                                        echo set_value('original_width');
                                    } 
                                    else {
                                        echo '1';
                                    }
                                    ?>" required />
                                    <span class="error">                                        
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="original_height">Original Height (px)</label>
                                    <input type="number" name="original_height" class="form-control" id="original_height" min="1" placeholder="" value="<?php
                                    if (isset($_POST['original_height']) && $_POST['original_height'] != '') {
                                        echo set_value('original_height');
                                    } 
                                    else {
                                        echo '1';
                                    }
                                    ?>" required />
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

