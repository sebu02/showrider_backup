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

                            <h4 class="header-title">Common SEO Settings</h4>                          

                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'optionadmin/add_seo_contents/'; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                                <div class="form-group">
                                    <label for="seo_title">SEO Title</label>

                                    <?php
                                     $seo_title_array = json_decode($option_row->common_seo_contents,TRUE);
                                     $seo_tag = "";
                                     $seo_title = "";

                                     if(!empty($seo_title_array)){
                                        $seo_tag = $seo_title_array['tag'];
                                        $seo_title = $seo_title_array['text'];
                                     }

                                     $tags_array = array("h1" => "H1" , "h2" => "H2" , "h3" => "H3" , "h4" => "H4" , "h5" => "H5" , "h6" => "H6");
                                    ?>

                                    <?php /* ?><input type="text" name="seo_title" class="form-control" id="seo_title" value="<?php // echo $option_row->project_name; ?>" ><?php /**/ ?>

                                    <div class="input-group mb-3">
                                        <select class="custom-select" name="seo_tag" style="cursor: pointer;height:45px;">&nbsp;&nbsp;
                                                <option value="">--select tag--</option>                                                
                                                <?php
                                                foreach($tags_array as $tags_key => $tags_val){                                                    
                                                ?>
                                                <option value="<?php echo $tags_key; ?>" <?php if($tags_key == $seo_tag){ echo "selected"; } ?>><?php echo $tags_val; ?></option>
                                                <?php
                                                }
                                                ?>                                                
                                        </select>                                        
                                        <input type="text" class="form-control"  name="seo_title" style="width:60%;" placeholder="Title..." value="<?php echo $seo_title; ?>" required>   
                                    </div>   

                                    <span class="error"> 
                                       <?php echo form_error('seo_title');  ?>                                      
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
