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
                <h4 class="page-title pull-left">Change Password</h4>





            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                <img class="avatar user-thumb" src="<?php echo base_url() . 'static/'; ?>adminpanel/images/administrator.png" alt="Administrator">
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-angle-down"></i></h4>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>admin/changepassword/">Change Password</a>
                    <!--<a class="dropdown-item" href="#">Settings</a>-->
                    <a class="dropdown-item" href="<?php echo base_url(); ?>admin/logout/">Log Out</a>
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
                            
                            
                            <h4 class="header-title">Change Password</h4>
                            <form action="<?php echo base_url() . 'admin/changepassword/'; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                
                                <div class="form-group">
                                    <!--<label for="old">Old Password</label>-->
                                    <input type="password" class="form-control" id="old" placeholder="Old Password" name="old" value="<?php echo set_value('old'); ?>" required>
                                    <span class="error">
                                        <?php echo form_error('old'); ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <!--<label for="new">New Password</label>-->
                                    <input type="password" class="form-control" id="new" placeholder="New Password" name="new" value="<?php echo set_value('new'); ?>" required>
                                    <span class="error">
                                        <?php echo form_error('new'); ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <!--<label for="confirm">Confirm Password</label>-->
                                    <input type="password" class="form-control" id="confirm" placeholder="Confirm Password" name="confirm" value="<?php echo set_value('confirm'); ?>" required>
                                    <span class="error">
                                        <?php echo form_error('confirm'); ?>
                                    </span>
                                </div>
                                <div class="form-check">
                                    
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





