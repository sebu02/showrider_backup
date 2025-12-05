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
                <h4 class="page-title pull-left">Manage Settings</h4>

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

                            <h4 class="header-title">Social Media Settings</h4>   
                            
                            <?php
                            $current_social_data = json_decode($option_row->social_media_data , TRUE);                            
                            ?>

                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'optionadmin/add_social_media/'; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                                <div class="form-group">
                                    <label for="facebook_fans">Facebook Fans</label>
                                    <input type="number" name="facebook_fans" class="form-control" id="facebook_fans" min="0" value="<?php echo $current_social_data["facebook_fans"]; ?>" required>

                                    <span class="error">                                       
                                    </span>                                   
                                </div>
                                
                                <div class="form-group">
                                    <label for="twitter_followers">Thread Followers</label>
                                    <input type="number" name="twitter_followers" class="form-control" id="twitter_followers" min="0" value="<?php echo $current_social_data["twitter_followers"]; ?>" required>

                                    <span class="error">                                       
                                    </span>                                   
                                </div>

                                <div class="form-group">
                                    <label for="instagram_followers">Instagram Followers</label>
                                    <input type="number" name="instagram_followers" class="form-control" id="instagram_followers" min="0" value="<?php echo $current_social_data["instagram_followers"]; ?>" required>

                                    <span class="error">                                       
                                    </span>                                   
                                </div>

                                <div class="form-group">
                                    <label for="youtube_subscribers">YouTube Subscribers</label>
                                    <input type="number" name="youtube_subscribers" class="form-control" id="youtube_subscribers" min="0" value="<?php echo $current_social_data["youtube_subscribers"]; ?>" required>

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



