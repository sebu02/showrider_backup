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
                <li class="gl_refresh_btn" data-refresh="">
                    <i class="ti-reload" data-toggle="">                        
                    </i>
                </li>
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
                <h4 class="page-title pull-left">Dashboard</h4>

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
    <!-- sales report area start -->

    <!-- row area end -->
    <div class="row">
        <!-- latest news area start -->

        <div class="col-lg-8 mt-4">
            <div class="row">

                <div class="col-md-6 mt-md-5 mb-3">
                    <div class="card">
                        <div class="seo-fact sbg3">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="ti-layout-grid2-alt"></i> </div>
                                <a href="<?php echo base_url(); ?>ecproductadmin/view_product/"><h5 style="color: white;">View Services</h5></a>
                            </div>
                            <canvas id="" height="30"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-md-5 mb-3">
                    <div class="card">
                        <div class="seo-fact sbg2">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="ti-layers"></i> </div>
                                <a href="<?php echo base_url(); ?>pageadmin/view_pages/"><h5 style="color: white;">View Pages</h5></a>
                            </div>
                            <canvas id="" height="30"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-md-5 mb-3">
                    <div class="card">
                        <div class="seo-fact sbg1">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="ti-server"></i> </div>
                                <a href="<?php echo base_url(); ?>contentadmin/viewcontent/"><h5 style="color: white;">View Contents</h5></a>
                            </div>
                            <canvas id="" height="30"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-md-5 mb-3">
                    <div class="card">
                        <div class="seo-fact sbg4">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="ti-email"></i> </div>
                                <a href="<?php echo base_url(); ?>cmsmailsadmin/viewmails/"><h5 style="color: white;">View Mails</h5></a>
                            </div>
                            <canvas id="" height="30"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php /* ?><div class="col-lg-4 mt-5">
                        <div class="card h-full">
                            <div class="card-body">
                                <h4 class="header-title">Advertising & Marketing</h4>
                                <canvas id="seolinechart8" height="233" style="max-height : 233px;max-width : 266px;"></canvas>
                            </div>
                        </div>
                    </div>
                                     
                                                     
                    <div class="col-xl-12 col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="header-title mb-0">Overview</h4>
                                    <select class="custome-select border-0 pr-3">
                                        <option selected>Last 24 Hours</option>
                                        <option value="0">01 January 2023</option>
                                    </select>
                                </div>
                                <div id="verview-shart"></div>
                            </div>
                        </div>
                    </div><?php /**/ ?>

        <!-- exchange area end -->
    </div>
    
    <!-- row area start-->
</div>

<!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->

    <!-- <script src="https://code.highcharts.com/modules/exporting.js"></script> -->
    <!-- <script src="https://code.highcharts.com/modules/export-data.js"></script> -->
    <!-- start amcharts -->

    <!-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script> -->

    <!-- <script src="https://www.amcharts.com/lib/3/ammap.js"></script> -->
    <!-- <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script> -->

    <!-- <script src="https://www.amcharts.com/lib/3/serial.js"></script> -->

    <!-- <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script> -->
    
    <!-- <script src="https://www.amcharts.com/lib/3/themes/light.js"></script> -->

    <!-- <script src="<?php // echo base_url().'static/adminpanel/assets'; ?>/js/maps.js"></script> -->