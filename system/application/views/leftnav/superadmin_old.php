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




                    <?php /**/ ?><li>
                        <a href="<?php echo base_url(); ?>admin/home/"><span class="icon16 icomoon-icon-home-2 <?php
                            if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'home') {
                                ?>blue<?php } ?>"></span>Dashboard</a>

                    </li><?php /**/ ?>

<!--                    <li><div class="sidebar-widget" style="margin: 0;">
                            <h5 class="title" style="margin: 0;">Manage Shortcuts</h5>
                        </div></li>-->
                    




<!--                    <li><div class="sidebar-widget" style="margin: 0;">
                            <h5 class="title" style="margin: 0;">Manage Users</h5>
                        </div></li> -->

                    <?php /**/ ?><li>
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
                            <li><a href="<?php echo base_url(); ?>useradmin/download_user_mail_list"><span class="icon16 icomoon-icon-arrow-right-3"></span>Download User Email Lists</a></li>
                        </ul>
                    </li><?php /**/ ?>


                    <?php /**/ ?><li>

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
                            <li><a href="<?php echo base_url(); ?>cmsmailsadmin/downloadformlist"><span class="icon16 icomoon-icon-arrow-right-3 "></span>Download Full Email Lists</a></li>
                            <li><a href="<?php echo base_url(); ?>cmsmailsadmin/viewmails/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 ">
                                    </span>View Mails</a></li><?php ?>

                            <li><a href="<?php echo base_url(); ?>cmsmailsadmin/trash_view_mails/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>Trash Mails
                                </a>
                            </li>

                        </ul>
                    </li><?php /**/ ?>



<!--                    <li><div class="sidebar-widget" style="margin: 0;">
                            <h5 class="title" style="margin: 0;">Manage Products</h5>
                        </div></li> -->
                        
                        
                    <li>

                        <?php
                        $menu_array = array(
                            'add_product',
                            'view_product',
                            'view_product',
                            'downloadproductlist',
                            'trash_view_product',
                            'edit_product',
                            'add_main_category_type',
                            'view_main_category_type',
                            'edit_main_categorytype',
                            'add_categorytype',
                            'view_categorytype',
                            'edit_categorytype',
                            'add_prodcategory',
                            'view_prodcategory',
                            'trash_view_categorytype',
                            'trash_view_prodcategory',
                            'edit_prodcategory2',
                            'edit_prodcategory',
                            'editProducts2'
                        );
                        $ftype = '';
                        if (!empty($_GET['ftype'])) {
                            $ftype = $_GET['ftype'];
                        }
                        if ($this->uri->segment(4) == 'shop') {
                            $ftype = 'shop';
                        }

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


                            <li>
                                <a href="<?php echo base_url(); ?>ecproductadmin/add_main_category_type/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Main Category Type</a>
                            </li>                           
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/view_main_category_type/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>View Main Category Type</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/add_categorytype/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Category Type</a>
                            </li>                           
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/view_categorytype/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Category Type</a>
                            </li>
                            
                            
                            
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
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/downloadproductlist"><span class="icon16 icomoon-icon-arrow-right-3"></span>Download Product Lists</a></li>

                            
                            
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/trash_view_categorytype/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Category Type
                                </a>
                            </li>
                            
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/trash_view_prodcategory/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Category
                                </a>
                            </li> 
                            
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/trash_view_product/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Products
                                </a>
                            </li>   
                        </ul>
                    </li>    

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
                            <li><a href="<?php echo base_url(); ?>pageadmin/add_pages/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>Add Page
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>pageadmin/view_pages/"><span class="icon16 icomoon-icon-arrow-right-3 "></span>View Page
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>pageadmin/trash_viewPage/"><span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Page
                                </a>
                            </li>
                        </ul>
                    </li><?php /**/ ?>



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

//                    $menu_array2 = array(
//                        'menu',
//                        'featurebox',
//                        
//                    );

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

                            <li><a href="<?php echo base_url(); ?>appearanceadmin/add_menu_type/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Menu Type</a></li>       
                            <li><a href="<?php echo base_url(); ?>appearanceadmin/view_menu_type/"><span class="icon16 icomoon-icon-arrow-right-3"></span>View Menu Type</a></li>             


                            <li><a href="<?php echo base_url(); ?>appearanceadmin/add_menu/"> <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Menu</a></li>
                            <li><a href="<?php echo base_url(); ?>appearanceadmin/viewmenu/"><span class="icon16 icomoon-icon-arrow-right-3"></span>View Menu</a></li>



                            <li><a href="<?php echo base_url(); ?>appearanceadmin/trash_viewmenu/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Menu</a></li>
                            <li><a href="<?php echo base_url(); ?>appearanceadmin/trash_view_menu_type/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Menu Type</a></li>

                        </ul>
                    </li>





                    <?php /**/ ?><li>

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

                            <?php ?><li><a href="<?php echo base_url(); ?>contentadmin/addcategory/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Category
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>contentadmin/viewcategory/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Category
                                </a>
                            </li>


                            <li><a href="<?php echo base_url(); ?>contentadmin/add_content/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Content
                                </a>
                            </li>                           
                            <li><a href="<?php echo base_url(); ?>contentadmin/viewcontent/">
                                    <span class="icon16 icomoon-icon-arrow-right-3  "></span>View Contents
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>contentadmin/trash_viewcategory/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Category
                                </a>
                            </li>

                            <li><a href="<?php echo base_url(); ?>contentadmin/trash_viewContent/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Content
                                </a>
                            </li>
                        </ul>
                    </li><?php /**/ ?>

                    <?php /**/ ?><li>

                        <?php
                        $menu_array = array(
                            'addimages',
                            'addcategory',
                            'viewcategory',
                            'viewimages',
                            'editimage',
                            'trash_viewcategory',
                            'trash_viewImage',
                        );

                        if ($this->uri->segment(1) == 'commonimageadmin' && in_array($this->uri->segment(2), $menu_array)) {

                            $style_state = 'display:block';
                            $class_state = 'blue';
                        } else {
                            $style_state = '';
                            $class_state = '';
                        }
                        ?>

                        <a href="javascript:void(0)"><span class="icon16 icomoon-icon-image-5 <?php echo $class_state; ?>"></span>Manage Common Image</a>
                        <ul class="sub" style="<?php echo $style_state; ?>">

                            <li><a href="<?php echo base_url(); ?>commonimageadmin/addcategory/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Category
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>commonimageadmin/viewcategory/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Category
                                </a>
                            </li>


                            <li><a href="<?php echo base_url(); ?>commonimageadmin/addimages/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Images
                                </a>
                            </li>                           
                            <li><a href="<?php echo base_url(); ?>commonimageadmin/viewimages/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>View Images
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>commonimageadmin/trash_viewcategory/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Category
                                </a>
                            </li>

                            <li><a href="<?php echo base_url(); ?>commonimageadmin/trash_viewImage/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Images
                                </a>
                            </li>
                        </ul>
                    </li><?php /**/ ?>






<!--                    <li><div class="sidebar-widget" style="margin: 0;">
                            <h5 class="title" style="margin: 0;">Store Location</h5>
                        </div></li>-->

                    <?php /**/ ?><li>

                        <?php
                        $menu_array = array(
                            'add_branch',
                            'view_branch',
                            'edit_branch',
                            'view_trash_branch',
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


                            <li><a href="<?php echo base_url(); ?>cmsstorefinderadmin/add_branch/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Branch
                                </a>
                            </li>                           
                            <li><a href="<?php echo base_url(); ?>cmsstorefinderadmin/view_branch/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Branch
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>cmsstorefinderadmin/view_trash_branch/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Branch
                                </a>
                            </li>
                        </ul>
                    </li><?php /**/ ?> 

                    <?php /**/ ?><li>

                        <?php
                        $menu_array = array(
                            'add_location_type',
                            'view_location_type',
                            'edit_location_type',
                            'add_location',
                            'view_location',
                            'edit_location',
                            'view_trash_location_type',
                            'view_trash_location',
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
                            <li><a href="<?php echo base_url(); ?>cmsstorefinderadmin/add_location_type/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Location Type
                                </a>
                            </li>                           
                            <li><a href="<?php echo base_url(); ?>cmsstorefinderadmin/view_location_type/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>View Location Type
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>cmsstorefinderadmin/add_location/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>Add Location
                                </a>
                            </li>                           
                            <li><a href="<?php echo base_url(); ?>cmsstorefinderadmin/view_location/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Location
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>cmsstorefinderadmin/view_trash_location_type/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>Trash Location Type
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>cmsstorefinderadmin/view_trash_location/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Location
                                </a>
                            </li> 
                        </ul>                   
                    </li><?php /**/ ?>




                    <?php /**/ ?><li>

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
                    </li><?php /**/ ?>


<!--                    <li><div class="sidebar-widget" style="margin: 0;">
                            <h5 class="title" style="margin: 0;">File Upload Management</h5>
                        </div></li>    -->

                    <?php /**/ ?><li>

                        <?php
                        $menu_array = array(
                            'addExtension',
                            'viewExtension',
                            'editExtension',
                            'addUpload_type',
                            'viewUpload_type',
                            'editUpload_type',
                            'addManipulation',
                            'viewallManipulation',
                            'editManipulation',
                            'addCombo',
                            'viewallCombo',
                            'editCombo',
                            'trash_viewExtension',
                            'trash_Upload_type',
                            'trash_Manipulation',
                            'trash_Combo',
                            'edit_combo_img',
                        );

                        if ($this->uri->segment(1) == 'fileuploadadmin' && in_array($this->uri->segment(2), $menu_array)) {

                            $style_state = 'display:block';
                            $class_state = 'blue';
                        } else {
                            $style_state = '';
                            $class_state = '';
                        }
                        ?>  




                        <a href="javascript:void(0)"><span class="icon16  icomoon-icon-upload-2 <?php echo $class_state; ?>"></span>Manage File Upload</a>
                        <ul class="sub" style="<?php echo $style_state; ?>">

                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/addExtension/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>Add Extension
                                </a>
                            </li>                           
                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/viewExtension/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>View Extensions
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/addUpload_type/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>Add Upload Type
                                </a>
                            </li> 
                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/viewUpload_type/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>View Upload Types
                                </a>
                            </li> 
                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/addManipulation/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>Add Manipulation
                                </a>
                            </li> 
                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/viewallManipulation/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>View Manipulations
                                </a>
                            </li> 
                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/addCombo/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>Add Combo
                                </a>
                            </li> 
                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/viewallCombo/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>View Combos
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/trash_viewExtension/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>Trash Extensions
                                </a>
                            </li> 
                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/trash_Upload_type/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>Trash Upload Types
                                </a>
                            </li> 
                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/trash_Manipulation/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>Trash Manipulations
                                </a>
                            </li> 
                            <li><a href="<?php echo base_url(); ?>fileuploadadmin/trash_Combo/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>Trash Combos
                                </a>
                            </li> 


                        </ul>
                    </li><?php /**/ ?>






<!--                    <li><div class="sidebar-widget" style="margin: 0;">
                            <h5 class="title" style="margin: 0;">Manage Forms</h5>
                        </div></li> -->




                    <?php /**/ ?><li>

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

                            <li><a href="<?php echo base_url(); ?>dynamicformadmin/add_liveform/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Add Live Forms
                                </a>
                            </li>                           
                            <li><a href="<?php echo base_url(); ?>dynamicformadmin/view_all_liveforms/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Live Forms
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>dynamicformadmin/trash_view_all_liveforms/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash Live Forms
                                </a>
                            </li> 

                        </ul>
                    </li><?php /**/ ?> 








                    <?php /**/ ?> <?php
                    $menu_array = array(
                        'addpushmsg',
                        'viewpushmsg',
                    );

                    if ($this->uri->segment(1) == 'commonadmin' && in_array($this->uri->segment(2), $menu_array)) {

                        $style_state = 'display:block';
                        $class_state = 'blue';
                    } else {
                        $style_state = '';
                        $class_state = '';
                    }
                    ?>

                    <li>
                        <a href="javascript:void(0)"><span class="icon16 icomoon-icon-books  <?php echo $class_state; ?>"></span>Manage Push Message</a>
                        <ul class="sub" style="<?php echo $style_state; ?>" >
                            <li><a href="<?php echo base_url(); ?>commonadmin/addpushmsg/"><span class="icon16 minia-icon-plus"></span>Add Push Message</a></li>
                            <li><a href="<?php echo base_url(); ?>commonadmin/viewpushmsg/"><span class="icon16 icomoon-icon-file"></span>View Push Messages</a></li> 
                        </ul>
                    </li> <?php /**/ ?>                       





<!--                    <li><div class="sidebar-widget" style="margin: 0;">
                            <h5 class="title" style="margin: 0;">Software Settings</h5>
                        </div></li>-->

                    <?php /**/ ?><li>

                        <?php
                        $menu_array = array(
                            'viewoptions',
                            'editoptions',
                            'viewLogos',
                            'edit_logo_image',
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
                            <li><a href="<?php echo base_url(); ?>optionadmin/viewoptions/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>View Settings
                                </a>
                            </li> 

                        </ul>
                    </li><?php /**/ ?>   








<!--                    <li><div class="sidebar-widget" style="margin: 0;">
                            <h5 class="title" style="margin: 0;">Manage Others</h5>
                        </div></li> -->

                    <?php /**/ ?><li>

                        <?php
                        $menu_array = array(
                            'add_route',
                            'view_route',
                            'edit_route',
                            'trash_view_route',
                        );

                        if ($this->uri->segment(1) == 'routesadmin' && in_array($this->uri->segment(2), $menu_array)) {

                            $style_state = 'display:block';
                            $class_state = 'blue';
                        } else {
                            $style_state = '';
                            $class_state = '';
                        }
                        ?>


                        <a href="javascript:void(0)"><span class="icon16 icomoon-icon-link-2 <?php echo $class_state; ?>"></span>Manage Routes</a>
                        <ul class="sub" style="<?php echo $style_state; ?>">

                            <li><a href="<?php echo base_url(); ?>routesadmin/add_route/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 ">
                                    </span>Add Route</a></li><?php ?>
                            <li><a href="<?php echo base_url(); ?>routesadmin/view_route/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 "></span>View Routes</a></li>
                            <li><a href="<?php echo base_url(); ?>routesadmin/trash_view_route/">
                                    <span class="icon16 icomoon-icon-arrow-right-3"></span>Trash View Routes</a></li>
                        </ul>
                    </li><?php /**/ ?>

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