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
                            
                            <h4 class="header-title">Add Category</h4>                                                     
                            
                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'videogalleryadmin/add_category/'; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                               
                                <div class="form-group">
                                    <label for="catname">Name<a style="color:#F00; font-size:12px;">*</a></label>
                                    <input type="text" name="catname" class="form-control slug_ref" id="catname" value="<?php echo set_value('catname'); ?>" placeholder="" required>

                                    <span class="error">
                                        <?php echo form_error('catname'); ?>
                                    </span>
                                    <!--<input type="hidden" name="url_type" value="seo_url">-->
                                </div>

                                <?php /**/  ?><div class="form-group">
                                    <label for="slug">URL Name<a style="color:#F00; font-size:12px;">*</a></label>
                                    
                                    <input type="text" name="slug" value="<?php echo set_value('slug'); ?>" required class="form-control slug_url_val" readonly id="slug" placeholder="" />

                                    <span class="error">
                                        <?php echo form_error('slug'); ?>
                                    </span>

                                    <input type="hidden" name="full_url_sec" class="sa_remain_url_section_input">

                                </div><?php /**/ ?>                               

                                <div class="form-group">
                                    <label for="order_number">Order</label>
                                    <input type="number" name="order_number" class="form-control" id="order_number" placeholder="" value="<?php
                                    if (isset($_POST['order_number']) && $_POST['order_number'] != '') {
                                        echo set_value('order_number');
                                    } else {
                                        echo '0';
                                    }
                                    ?>" required />
                                    <span class="error"><?php echo form_error('order_number'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="active_status">Active Status</label>

                                </div>    

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
//                                        else {
//                                            echo 'checked';
//                                        }
                                           ?> />
                                    <label class="custom-control-label" for="active_status2" style="cursor: pointer;">Deactive</label>
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

<?php /**/  ?><script type="text/javascript">
    $(document).ready(function () {
//    alert();
        $(".slug_ref").keyup(function () {

            var string = $(this).val().trim();
            var string = string.replace(/[^a-zA-Z0-9]/g, '-');

            var string = string.replace(/\-+/g, '-');

            var string = string.toLowerCase();

            $(".slug_url_val").val(string.trim());

        });

        $(".slug_ref").blur(function () {
            var string = $(this).val().trim();
            $(".slug_ref").val(string);
        });


        $(".slug_url_val").keyup(function () {
            var string = $(this).val();
            var string = string.replace(/[^a-zA-Z0-9]/g, '-');

            var string = string.replace(/\-+/g, '-');

            var string = string.toLowerCase();

            $(".slug_url_val").val(string.trim());
        });


       

    });

</script><?php /**/ ?>