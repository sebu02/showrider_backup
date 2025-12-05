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

                            <h4 class="header-title">Special Types Settings</h4>   
                            
                            <?php
                             $current_special_types_data = json_decode($option_row->special_types_data , TRUE);   
                                                          
                            ?>

                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'optionadmin/add_heading_texts/'; ?>" method="post" autocomplete="off">

                                <div class="form-group">
                                    <label for="hot_this_week_title">Hot This Week Title</label>
                                    <input type="text" name="hot_this_week_title" class="form-control" id="hot_this_week_title" value="<?php echo $current_special_types_data["hot_this_week"]; ?>" required>

                                    <span class="error">                                       
                                    </span>                                   
                                </div>
                                
                                <div class="form-group">
                                    <label for="past_stories_title">Past Stories Title</label>
                                    <input type="text" name="past_stories_title" class="form-control" id="past_stories_title" value="<?php echo $current_special_types_data["past_stories"]; ?>" required>

                                    <span class="error">                                       
                                    </span>                                   
                                </div>

                                <div class="form-group">
                                    <label for="must_read_title">Must Read Title</label>
                                    <input type="text" name="must_read_title" class="form-control" id="must_read_title" value="<?php echo $current_special_types_data["must_read"]; ?>" required>

                                    <span class="error">                                       
                                    </span>                                   
                                </div>

                                <div class="form-group">
                                    <label for="recent_article_title">Recent Article Title</label>
                                    <input type="text" name="recent_article_title" class="form-control" id="recent_article_title" value="<?php echo $current_special_types_data["recent_article"]; ?>" required>

                                    <span class="error">                                       
                                    </span>                                   
                                </div> 
                                
                                <div class="form-group">
                                    <label for="trending_now_title">Trending Now Title</label>
                                    <input type="text" name="trending_now_title" class="form-control" id="trending_now_title" value="<?php echo $current_special_types_data["trending_now"]; ?>" required>

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



