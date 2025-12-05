<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url().'static/adminpanel'; ?>/assets/images/icon/favicon_new.png">
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets'; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets'; ?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets'; ?>/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets'; ?>/css/metisMenu.css">
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets'; ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets'; ?>/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets'; ?>/css/typography.css">
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets'; ?>/css/default-css.css">
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets'; ?>/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets'; ?>/css/responsive.css">
    
    
    <link href="<?php echo base_url() . 'static/'; ?>gl_build_backend/css/admin_custom.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() . 'static/'; ?>ajaxupload/css/uploadCustom.css" rel="stylesheet" type="text/css" /> 
    
    <!-- modernizr css -->
    <script src="<?php echo base_url().'static/adminpanel/assets'; ?>/js/vendor/modernizr-2.8.3.min.js"></script>
    
    <script src="<?php echo base_url().'static/adminpanel/assets'; ?>/js/vendor/jquery-2.2.4.min.js"></script>
    
    
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
    
    <style type="text/css">
        @media only screen and (min-width: 1000px){    
            .gl_search_select_div {
                width: 300px;
            }
        }
        .alert-success{
            color: darkgreen !important;
        }
        .alert-warning{
            color: darkred !important;
        }
        .alert-danger{
            color: darkred !important;
        }
    </style>
    
    <style type="text/css">
        thead tr th{
            font-family: 'Lato', sans-serif !important;
        }
    </style>
    
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="#">
                        <?php /*  ?><img src="<?php echo base_url() . 'static/'; ?>adminpanel/images/admin_panel.jpg" alt="logo"><?php /**/ ?>
                        <?php
                        $project_name = $this->common_model->option->project_name;
                        $project_name_arr = explode('_', $project_name);                        
                        
                        $project_name_val_full = '';
                        foreach ($project_name_arr as $project_name_val){
                            if($project_name_val != ''){
                                $project_name_val_full = $project_name_val_full . ' ' . $project_name_val;
                            }
                        }
                        
                        $project_name_val_final = trim($project_name_val_full);
                                                
                        ?>
                        <h4 class="user-name"> 
                            <B><?php echo strtoupper($project_name_val_final); ?></b>
                            
                        </h4>
                    </a>
                </div>
            </div>
            
            
            <?php
        $loged_type = '';
        if ($this->session->userdata('logged_adminpanel') == 'true') {

            $log_usernamez = $this->session->userdata('logged_username');
            $this->db->where('username', $log_usernamez);
            $loged_details = $this->db->get('admin')->row();
            $loged_type = $loged_details->type;
			$loged_location_city = $loged_details->location_city;
			
			$this->session->set_userdata('logged_admin_id', $loged_details->id);
			$this->session->set_userdata('logged_admin_type', $loged_type);
			$this->session->set_userdata('logged_admin_location_city', $loged_location_city);
        }
		



        switch ($loged_type) {
            case 'adminorderuser';
                $this->load->view('leftnav/purchaseadmin');
                break;
            case 'super';
                $this->load->view('leftnav/superadmin');
                break;
            case 'admin';
                $this->load->view('leftnav/cmsadmin');
                break;
			case 'subadmin';
                $this->load->view('leftnav/cmsadmin');
                break;
        }
        ?>
            
            
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            
            <!-- header area end -->
            <!-- page title area start -->
            
            <!-- page title area end -->
            
            <?php echo $contents; ?>
            
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            
             <?php
                      $date = date("Y");
                              
                ?>
            
            <div class="footer-area">
                <?php /* ?><p>© Copyright <?php echo $date; ?>. All right reserved. Website by <a href="http://www.godlandit.com/" target="_blank">Godlandit</a>.</p><?php /**/ ?>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    <div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
        <ul class="nav offset-menu-tab">
            <li><a class="active" data-toggle="tab" href="#activity">Activity</a></li>
            <li><a data-toggle="tab" href="#settings">Settings</a></li>
        </ul>
        <div class="offset-content tab-content">
            <div id="activity" class="tab-pane fade in show active">
                <div class="recent-activity">
                    <div class="timeline-task">
                        <div class="icon bg1">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Added</h4>
                            <span class="time"><i class="ti-time"></i>7 Minutes Ago</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>You missed you Password!</h4>
                            <span class="time"><i class="ti-time"></i>09:20 Am</span>
                        </div>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Member waiting for you Attention</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="ti-signal"></i>
                        </div>
                        <div class="tm-title">
                            <h4>You Added Kaji Patha few minutes ago</h4>
                            <span class="time"><i class="ti-time"></i>01 minutes ago</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg1">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Ratul Hamba sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Hello sir , where are you, i am egerly waiting for you.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="ti-signal"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                </div>
            </div>
            <div id="settings" class="tab-pane fade">
                <div class="offset-settings">
                    <h4>General Settings</h4>
                    <div class="settings-list">
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Notifications</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch1" />
                                    <label for="switch1">Toggle</label>
                                </div>
                            </div>
                            <p>Keep it 'On' When you want to get all the notification.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show recent activity</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch2" />
                                    <label for="switch2">Toggle</label>
                                </div>
                            </div>
                            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show your emails</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch3" />
                                    <label for="switch3">Toggle</label>
                                </div>
                            </div>
                            <p>Show email so that easily find you.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show Task statistics</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch4" />
                                    <label for="switch4">Toggle</label>
                                </div>
                            </div>
                            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Notifications</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch5" />
                                    <label for="switch5">Toggle</label>
                                </div>
                            </div>
                            <p>Use checkboxes when looking for yes or no answers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <input type="hidden" class="base_url" value="<?php echo base_url(); ?>">
    
    
    <script>

//URL js

            $(document).ready(function () {
                $(document).on('keyup keypress', 'form input[type="text"],form input[type="number"],form input[type="radio"],form input[type="checkbox"]', function (e) {
                    if (e.keyCode == 13) {
                        e.preventDefault();
                        return false;
                    }


                });
                $('.gl_wordcount').maxlength({
                    alwaysShow: true,
                    threshold: 10,
                    warningClass: "label label-success",
                    limitReachedClass: "label label-important",
                    separator: ' of ',
                    preText: 'You have ',
                    postText: ' chars remaining.'
                });

                $('#tree').checktree();

                $('.url_wrap').on('change', '.url_type', function () {
                    var url_type = $(this).val();

                    if (url_type == 'seo_url') {

                        $('.sa_base_url_section').show();
                        $('.sa_remain_url_section').show();
                        var slug_val = $('.slug_url_val').val();
                        var string = slug_val.replace(/[^a-zA-Z0-9]/g, '-');
                        $('.slug_url_val').val(string);
                        $('.slug_url_val').prop('readonly', true);
                        $('.slugShow').show();
                        $('.slugHide').hide();

                    } else if (url_type == 'auto_url') {

                        $('.sa_base_url_section').hide();
                        $('.sa_remain_url_section').hide();
                        $('.slug_url_val').prop('readonly', true);
                        $('.slugShow').show();
                        $('.slugHide').hide();


                    } else if (url_type == 'force_url') {

                        $('.sa_base_url_section').hide();
                        $('.sa_remain_url_section').hide();
                        var slug_val = $('.slug_url_val').val();
                        var string = slug_val.replace(/[^a-zA-Z0-9]/g, '-');
                        $('.slug_url_val').val(string);
                        $('.slug_url_val').prop('readonly', false);

                        $('.slugShow').hide();
                        $('.slugHide').show();
                    }
                });


                $(".slug_url_val").keyup(function () {

                    if ($('.url_type:checked').val() == 'force_url') {

                        var string = $(this).val();
                        var string = string.replace(/[^a-zA-Z0-9/]/g, '-');

                        var string = string.replace(/\-+/g, '-');

                        var string = string.toLowerCase();

                        $(".slug_url_val").val(string.trim());

                    } else {
                        var string = $(this).val();
                        var string = string.replace(/[^a-zA-Z0-9]/g, '-');

                        var string = string.replace(/\-+/g, '-');

                        var string = string.toLowerCase();

                        $(".slug_url_val").val(string.trim());
                    }



                });


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
                
                
                
                 $(".slug_ref_permission").keyup(function () {

                    var string = $(this).val();
                    var string = string.replace(/[^a-zA-Z0-9]/g, '-');

                    var string = string.replace(/\-+/g, '');

                    var string = string.toLowerCase();

                    $(".slug_url_val_permission").val(string.trim());

                });
                
                


                url_write_sec();
                url_write_sec_item();
//                clearNameString();

                $('.parentid').on('change', function () {
                    url_write_sec();
                });

                $('.sa_item_cat').on('change', function () {
                    url_write_sec_item();
                });

                $('.slug_ref').on('keyup', function () {
                    clearNameString();
                });



            });

//EOF URL js


//Clipboard Js


            var clipboard = new Clipboard('.btn');

            clipboard.on('success', function (e) {
                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);

                e.clearSelection();
            });

            clipboard.on('error', function (e) {
                console.error('Action:', e.action);
                console.error('Trigger:', e.trigger);
            });

//EOF Clipboard Js


        </script>
        
        <script type="text/javascript">
            $("body").on("click",".gl_refresh_btn",function(){
                var refresh = $(this).attr("data-refresh");
                window.location = refresh;
            });
        </script>  
    
    <!-- offset area end -->
    <!-- jquery latest version -->
    
    <!-- bootstrap 4 js -->
    <script src="<?php echo base_url().'static/adminpanel/assets'; ?>/js/popper.min.js"></script>
    <script src="<?php echo base_url().'static/adminpanel/assets'; ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url().'static/adminpanel/assets'; ?>/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url().'static/adminpanel/assets'; ?>/js/metisMenu.min.js"></script>
    <script src="<?php echo base_url().'static/adminpanel/assets'; ?>/js/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url().'static/adminpanel/assets'; ?>/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="<?php echo base_url().'static/adminpanel/assets'; ?>/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="<?php echo base_url().'static/adminpanel/assets'; ?>/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="<?php echo base_url().'static/adminpanel/assets'; ?>/js/plugins.js"></script>
    <script src="<?php echo base_url().'static/adminpanel/assets'; ?>/js/scripts.js"></script>
    
    
    <script type="application/javascript" src="<?php echo base_url() . 'static/'; ?>ajaxupload/js/jquery.form.js"></script> 
    <script type="application/javascript" src="<?php echo base_url() . 'static/'; ?>ajaxupload/js/imageupload.js"></script> 
    <script type="text/javascript" src="<?php echo base_url() . 'static/'; ?>gl_build_backend/js/custom.js"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'static/'; ?>gl_build_backend/js/wizard_save.js"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'static/'; ?>ajaxupload/js/ajaxLoader.js"></script>
    
    <?php /* ?><script type="text/javascript" src="<?php echo base_url() . 'static/'; ?>gl_build_backend/js/custom2.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script><?php /**/ ?>
    
    <script type="text/javascript" src="<?php echo base_url() . 'static/'; ?>ckeditor/ckeditor.js"></script>
    
    <script>
        CKEDITOR.replace('editor');
        CKEDITOR.replace('editor1');
    </script>
    
    <script>
    // In your Javascript
//    $(document).ready(function() {
//        $('.search_select').select2();
//    });
    </script>
    
    
</body>

</html>
