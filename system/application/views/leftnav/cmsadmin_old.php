<div id="wrapper">



    <!--Responsive navigation button-->  

    <div class="resBtn">

        <a href="#"><span class="icon16 minia-icon-list-3"></span></a>

    </div>



    <!--Sidebar collapse button-->  

    <div class="collapseBtn leftbar">

        <a href="#" class="tipR" title="Hide sidebar"><span class="icon12 minia-icon-layout"></span></a>

    </div>



    <!--Sidebar background-->

    <div id="sidebarbg"></div>

    <!--Sidebar content-->

    <div id="sidebar">



        <div class="shortcuts" style="height:43px; text-align:center;">



            <h3 style="margin: 6px 0px;"><?php echo strtoupper($this->common_model->option->project_name); ?></h3>

        </div><!-- End search -->  



        <div class="sidenav">







            <div class="sidebar-widget" style="margin: -1px 0 0 0;">

                <h5 class="title" style="margin-bottom:0">Navigation</h5>

            </div><!-- End .sidenav-widget -->



            <div class="mainnav">

                <ul>


                    <li>
                        <a href="<?php echo base_url(); ?>admin/home/"><span class="icon16 icomoon-icon-home-2 <?php
                            if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'home') {
                                ?>blue<?php } ?>"></span>Dashboard</a>

                    </li>

<!--                    <li><div class="sidebar-widget" style="margin: 0;">
                            <h5 class="title" style="margin: 0;">Shortcuts</h5>
                        </div></li>-->


                    






<!--                    <li><div class="sidebar-widget" style="margin: 0;">

                            <h5 class="title" style="margin: 0;">CMS</h5>

                        </div></li> -->





<?php /**/ ?> <li>



<?php
$menu_array = array(
    'add_pages',
    'view_pages',
    'edit_pages',
    'manage_pages',
    'trash_viewPage',
    'manage_pages_simple'
);



if ($this->uri->segment(1) == 'pageadmin' && in_array($this->uri->segment(2), $menu_array)) {



    $style_state = 'display:block';

    $class_state = 'blue';
} else {

    $style_state = '';

    $class_state = '';
}
?>  







                        <a href="javascript:void(0)"><span class="icon16 icomoon-icon-insert-template <?php echo $class_state; ?>"></span>Manage Pages</a>

                        <ul class="sub" style="<?php echo $style_state; ?>">



                            <li><a href="<?php echo base_url(); ?>pageadmin/view_pages/"><span class="icon16 icomoon-icon-arrow-right-3 "></span>View Pages

                                </a>

                            </li>



                        </ul>

                    </li>






                    <li>

<?php
$menu_array = array(
    'manage_menu',
    'viewmenu',
    'appearance2',
    'appearance3',
    'viewmenu',
    'trash_viewmenu',
    'add_menu_type',
    'view_menu_type',
    'edit_menu_type',
    'trash_view_menu_type',
    'add_menu',
    'edit_menu',
    'edit_menu_2'
);



if ($this->uri->segment(1) == 'appearanceadmin' && in_array($this->uri->segment(2), $menu_array) && $this->uri->segment(4) == 'menu') {

    $style_state = 'display:block';
    $class_state = 'blue';
} else if ($this->uri->segment(1) == 'appearanceadmin' && in_array($this->uri->segment(2), $menu_array) && $this->uri->segment(4) == '') {

    $style_state = 'display:block';
    $class_state = 'blue';
} else {
    $style_state = 'display:none';
    $class_state = '';
}
?>

                        <a href="javascript:void(0)"><span class="icon16 icomoon-icon-menu-3 <?php echo $class_state; ?>"></span>Manage Menu
                        </a>

                        <ul class="sub" style="<?php echo $style_state; ?>" >
                            <li><a href="<?php echo base_url(); ?>appearanceadmin/add_menu/"> <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Menu</a></li>
                            <li><a href="<?php echo base_url(); ?>appearanceadmin/viewmenu/"><span class="icon16 icomoon-icon-arrow-right-3"></span>View Menu</a></li>

                        </ul>

                    </li>




                    <li>

<?php
$menu_array = array(
    'addcategory',
    'edit',
    'viewcategory',
    'addcontent',
    'editcontent',
    'viewcontent',
    'view_content_gallery',
    'view_content_video_gallery',
    'trash_viewcategory',
    'trash_viewContent',
    'add_content',
    'edit_content',
    'edit_content_2',
    'edit_category2'
);

if ($this->uri->segment(1) == 'contentadmin' && in_array($this->uri->segment(2), $menu_array)) {

    $style_state = 'display:block';
    $class_state = 'blue';
} else {
    $style_state = '';
    $class_state = '';
}
?>

                        <a href="javascript:void(0)"><span class="icon16 icomoon-icon-pencil-3 <?php echo $class_state; ?>"></span>Manage Contents</a>

                        <ul class="sub" style="<?php echo $style_state; ?>" >
                            <?php /*  ?><li><a href="<?php echo base_url(); ?>contentadmin/viewcategory/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Category
                                </a>
                            </li><?php /**/ ?>


                            <li><a href="<?php echo base_url(); ?>contentadmin/add_content/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Content
                                </a>
                            </li>                           
                            <li><a href="<?php echo base_url(); ?>contentadmin/viewcontent/">
                                    <span class="icon16 icomoon-icon-arrow-right-3  "></span>View Contents
                                </a>
                            </li>

                        </ul>
                    </li>
                    
<!--                    <li><div class="sidebar-widget" style="margin: 0;">
                            <h5 class="title" style="margin: 0;">Mails</h5>
                        </div></li> -->


                    <li>
                        <?php 
                         $menu_array = array(
                            'add_product',
                            'view_product',
                            'view_product',
                            'edit_product',
                            'add_prodcategory',
                            'view_prodcategory',
                            'edit_prodcategory2',
                            'edit_prodcategory',
                            'editProducts2' 
                         );
                         
                         $ftype = '';
//                        if (!empty($_GET['ftype'])) {
//                            $ftype = $_GET['ftype'];
//                        }
//                        if ($this->uri->segment(4) == 'shop') {
//                            $ftype = 'shop';
//                        }

                        if ($this->uri->segment(1) == 'ecproductadmin' && in_array($this->uri->segment(2), $menu_array) && $ftype != 'shop') {

                            $style_state = 'display:block';
                            $class_state = 'blue';
                        } else {
                            $style_state = '';
                            $class_state = '';
                        }
                        ?>
                        
                        <a href="javascript:void(0)"><span class="icon16  icomoon-icon-grid <?php echo $class_state; ?>"></span>Manage Products</a>
                        <ul class="sub" style="<?php echo $style_state; ?>" >
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/add_prodcategory/">
                                                <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Category</a>
                                        </li>
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/view_prodcategory/">
                                                <span class="icon16 icomoon-icon-arrow-right-3"></span>View Category</a>
                                        </li>
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/add_product/"><span class="icon16 icomoon-icon-arrow-right-3"></span>Add Product</a>
                            </li>                           
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/view_product/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Products</a>
                            </li>            
                        
                        </ul>
                    </li>

                    <li>

<?php
$menu_array = array(
    'viewmails',
    'trash_view_mails',
);

if ($this->uri->segment(1) == 'cmsmailsadmin' && in_array($this->uri->segment(2), $menu_array)) {

    $style_state = 'display:block';
    $class_state = 'blue';
} else {
    $style_state = '';
    $class_state = '';
}
?> 

                        <a href="javascript:void(0)"><span class="icon16 icomoon-icon-cabinet <?php echo $class_state; ?>"></span>Manage Mails</a>

                        <ul class="sub" style="<?php echo $style_state; ?>">

                            <li><a href="<?php echo base_url(); ?>cmsmailsadmin/viewmails/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 ">
                                    </span>View Mails</a></li>

                        </ul>

                    </li>
                    
                    <?php /*  ?><li>
                        <?php
                            $menu_array = array(
                                'viewallCombo',
                                'editCombo',
                                'edit_combo_img'
                            );
                            
                            if ($this->uri->segment(1) == 'fileuploadadmin' && in_array($this->uri->segment(2), $menu_array)) {

                                $style_state = 'display:block';
                                $class_state = 'blue';
                            } else {
                                $style_state = '';
                                $class_state = '';
                            }
                        ?>
                        <a href="javascript:void(0)"><span class="icon16  icomoon-icon-upload-2 <?php echo $class_state; ?>"></span>Manage File Property</a>
                        <ul class="sub" style="<?php echo $style_state; ?>">
                            
                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/viewallCombo/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>View Combos
                                </a>
                            </li>
                        
                        </ul>
                        
                    </li><?php /**/ ?>
                    
                    
                    <li>
                       <?php
                         $menu_array = array(
                             'viewoptions',
                             'editoption'
                         );
                         
                        if ($this->uri->segment(1) == 'optionadmin' && in_array($this->uri->segment(2), $menu_array)) {

                            $style_state = 'display:block';
                            $class_state = 'blue';
                        } else {
                            $style_state = '';
                            $class_state = '';
                        }
                       ?>
                        <a href="javascript:void(0)"><span class="icon16 icomoon-icon-cogs <?php echo $class_state; ?> "></span>Manage Settings</a>
                        <ul class="sub" style="<?php echo $style_state; ?>">
                            <li><a href="<?php echo base_url(); ?>optionadmin/viewoptions">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Settings
                                </a>
                            </li> 

                        </ul>
                    </li>
                    
                    <?php /*  ?><li>
                        <?php
                        $menu_array = array(
                            'add_commonform',
                            'edit_commonforms',
                            'add_liveform',
                            'view_all_liveforms',
                            'trash_view_all_commonforms',
                            'trash_view_all_liveforms',
                        );

                        if ($this->uri->segment(1) == 'dynamicformadmin' && in_array($this->uri->segment(2), $menu_array)) {

                            $style_state = 'display:block';
                            $class_state = 'blue';
                        } else {
                            $style_state = '';
                            $class_state = '';
                        }
                        ?>  
                        
                        <a href="javascript:void(0)"><span class="icon16 icomoon-icon-file <?php echo $class_state; ?>"></span>Manage Forms
                        </a>
                        <ul class="sub" style="<?php echo $style_state; ?>">
                            <li><a href="<?php echo base_url(); ?>dynamicformadmin/view_all_liveforms/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Live Forms
                                </a>
                            </li>
                        </ul>
                    </li><?php /**/ ?>
                    
                    
                    <li>
                        <?php
                        $menu_array = array(
                            'viewusers',
                            'download_user_mail_list',
                        );

                        if ($this->uri->segment(1) == 'useradmin' && in_array($this->uri->segment(2), $menu_array)) {

                            $style_state = 'display:block';
                            $class_state = 'blue';
                        } else {
                            $style_state = '';
                            $class_state = '';
                        }
                        ?>
                        <a href="javascript:void(0)"><span class="icon16 icomoon-icon-users  <?php echo $class_state; ?>"></span>Manage Users</a>
                        <ul class="sub" style=" <?php echo $style_state; ?> ">

                            <li><a href="<?php echo base_url(); ?>useradmin/viewusers/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View User</a></li>
                            <?php /* ?><li><a href="<?php echo base_url(); ?>useradmin/download_user_mail_list"><span class="icon16 icomoon-icon-arrow-right-3"></span>Download User Email Lists</a></li><?php /**/ ?>
                        </ul>
                    </li>

                    
                    
                    <li>
                        <?php
                          $menu_array = array(
                              'view_branch'
                          );
                          
                          if ($this->uri->segment(1) == 'cmsstorefinderadmin' && in_array($this->uri->segment(2), $menu_array)) {

                                $style_state = 'display:block';
                                $class_state = 'blue';
                            } else {
                                $style_state = '';
                                $class_state = '';
                            }
                        ?>
                        <a href="javascript:void(0)"><span class="icon16 icomoon-icon-location-2 <?php echo $class_state; ?>"></span>Manage Store</a>
                        <ul class="sub" style="<?php echo $style_state; ?>">
                            
                            <li><a href="<?php echo base_url(); ?>cmsstorefinderadmin/view_branch/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Branch
                                </a>
                            </li>
                        
                        </ul>
                    </li>


                    <li>
                        <?php
                          $menu_array = array(
                              'view_location'
                          );
                          if ($this->uri->segment(1) == 'cmsstorefinderadmin' && in_array($this->uri->segment(2), $menu_array)) {

                            $style_state = 'display:block';
                            $class_state = 'blue';
                        } else {
                            $style_state = '';
                            $class_state = '';
                        }
                        ?>
                        <a href="javascript:void(0)"><span class="icon16 icomoon-icon-map-3  <?php echo $class_state; ?> "></span>Manage Locations</a>
                        <ul class="sub" style="<?php echo $style_state; ?>" >
                        
                            <li><a href="<?php echo base_url(); ?>cmsstorefinderadmin/view_location/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Location
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    
                    <li>

                        <?php
                        $menu_array = array(
                            'viewpincode',
                        );

                        if ($this->uri->segment(1) == 'ecpincodeadmin' && in_array($this->uri->segment(2), $menu_array)) {

                            $style_state = 'display:block';
                            $class_state = 'blue';
                        } else {
                            $style_state = '';
                            $class_state = '';
                        }
                        ?>  
                        <a href="javascript:void(0)"><span class="icon16  icomoon-icon-cart-4 <?php echo $class_state; ?>"></span>Manage Pincode</a>
                        <ul class="sub" style="<?php echo $style_state; ?>">
                            <li><a href="<?php echo base_url(); ?>ecpincodeadmin/viewpincode/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Pincode
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <?php
                    $this->load->view('commoninclude/admin_shortcut_menus');
                    ?>

<!--                    <li><div class="sidebar-widget" style="margin: 0;">

                            <h5 class="title" style="margin: 0;"></h5>

                        </div></li> -->














                </ul>



            </div>

        </div><!-- End sidenav -->



    </div><!-- End #sidebar -->



    <!--Body content-->

<?php echo $contents; ?>

    <!-- End #content -->



</div><!-- End #wrapper -->