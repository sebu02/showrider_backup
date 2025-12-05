<div class="main-menu">
    <div class="menu-inner">
        <nav>
            <ul class="metismenu" id="menu">
                <li class="<?php if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'home') { ?>active<?php } ?>">
                    <a href="<?php echo base_url(); ?>admin/home/" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                </li>

                <?php
                $style_state = '';
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';

                if ($this->uri->segment(1) == 'useradmin') {

                    $style_state = '';
                    $class_state_main = 'active';

                    if ($this->uri->segment(2) == 'viewusers') {
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'download_user_mail_list') {
                        $class_state_sub_2 = 'active';
                    }
                }
                ?>

                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>Manage Users</span></a>
                    <ul class="collapse">
                        <li class="<?php echo $class_state_sub_1; ?>"><a href="<?php echo base_url(); ?>useradmin/viewusers/">View Users</a></li>
                        <li class="<?php echo $class_state_sub_2; ?>"><a href="<?php echo base_url(); ?>useradmin/download_user_mail_list">Download Users List</a></li>
                    </ul>
                </li>

                <?php
                $style_state = '';
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';
                $class_state_sub_3 = '';

                if ($this->uri->segment(1) == 'cmsmailsadmin') {

                    $style_state = '';
                    $class_state_main = 'active';

                    if ($this->uri->segment(2) == 'viewmails') {
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'downloadformlist') {
                        $class_state_sub_2 = 'active';
                    }
                    if ($this->uri->segment(2) == 'trash_view_mails') {
                        $class_state_sub_3 = 'active';
                    }
                }
                ?>

                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-email"></i><span>Manage Mails</span></a>
                    <ul class="collapse">                        
                        <li class="<?php echo $class_state_sub_1; ?>"><a href="<?php echo base_url(); ?>cmsmailsadmin/viewmails/">View Mails</a></li>
                        <li class="<?php echo $class_state_sub_2; ?>"><a href="<?php echo base_url(); ?>cmsmailsadmin/downloadformlist">Download Emails List</a></li>
                        <?php /* ?><li class="<?php echo $class_state_sub_3; ?>"><a href="<?php echo base_url(); ?>cmsmailsadmin/trash_view_mails/">Trash Mails</a></li><?php /**/ ?>
                    </ul>
                </li>
                
                <?php
                /**/ $style_state = '';
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';
                $class_state_sub_3 = '';
                
                if ($this->uri->segment(1) == 'ecorderadmin') {
//                    $style_state = '';
                    $class_state_main = 'active';
                    
                    if ($this->uri->segment(2) == 'vieworders') {
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'trash_view_order') {
                        $class_state_sub_2 = 'active';
                    }
                }
                ?>
                
                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-shopping-cart"></i><span>Manage Orders</span></a>
                    <ul class="collapse">                        
                        <li class="<?php echo $class_state_sub_1; ?>"><a href="<?php echo base_url(); ?>ecorderadmin/vieworders/">View Orders</a></li>                        
                        <?php /* ?><li class="<?php echo $class_state_sub_2; ?>"><a href="javascript:void(0)">Trash Orders</a></li><?php /**/ ?>
                    </ul>
                </li><?php /**/ ?>

                <?php
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';
                $class_state_sub_3 = '';

                if ($this->uri->segment(1) == 'pageadmin') {
                    $class_state_main = 'active';

                    if ($this->uri->segment(2) == 'add_pages') {
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_pages') {
                        $class_state_sub_2 = 'active';
                    }
                    if ($this->uri->segment(2) == 'trash_viewPage') {
                        $class_state_sub_3 = 'active';
                    }
                }
                ?>

                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers"></i><span>Manage Pages</span></a>
                    <ul class="collapse">
                        <li class="<?php echo $class_state_sub_1; ?>"><a href="<?php echo base_url(); ?>pageadmin/add_pages/">Add Page</a></li>
                        <li class="<?php echo $class_state_sub_2; ?>"><a href="<?php echo base_url(); ?>pageadmin/view_pages/">View Pages</a></li>
                        <?php /*  ?><li class="<?php echo $class_state_sub_3; ?>"><a href="<?php echo base_url(); ?>pageadmin/trash_viewPage/">Trash Page</a></li><?php /* */ ?>
                    </ul>
                </li>

                <?php
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';
                $class_state_sub_3 = '';
                $class_state_sub_4 = '';
                $class_state_sub_5 = '';
                $class_state_sub_6 = '';

                if ($this->uri->segment(1) == 'appearanceadmin') {
                    $class_state_main = 'active';

                    if ($this->uri->segment(2) == 'add_menu_type') {
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_menu_type') {
                        $class_state_sub_2 = 'active';
                    }
                    if ($this->uri->segment(2) == 'add_menu') {
                        $class_state_sub_3 = 'active';
                    }
                    if ($this->uri->segment(2) == 'viewmenu') {
                        $class_state_sub_4 = 'active';
                    }
                    if ($this->uri->segment(2) == 'trash_viewmenu') {
                        $class_state_sub_5 = 'active';
                    }
                    if ($this->uri->segment(2) == 'trash_view_menu_type') {
                        $class_state_sub_6 = 'active';
                    }
                }
                ?>

                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-menu"></i>
                        <span>Manage Menu</span></a>
                    <ul class="collapse">
                        <li class="<?php echo $class_state_sub_1; ?>"><a href="<?php echo base_url(); ?>appearanceadmin/add_menu_type/">Add Type</a></li>
                        <li class="<?php echo $class_state_sub_2; ?>"><a href="<?php echo base_url(); ?>appearanceadmin/view_menu_type/">View Types</a></li>
                        <li class="<?php echo $class_state_sub_3; ?>"><a href="<?php echo base_url(); ?>appearanceadmin/add_menu/">Add Menu</a></li>
                        <li class="<?php echo $class_state_sub_4; ?>"><a href="<?php echo base_url(); ?>appearanceadmin/viewmenu/">View Menu</a></li>
                        <?php /* ?><li class="<?php echo $class_state_sub_5; ?>"><a href="<?php echo base_url(); ?>appearanceadmin/trash_viewmenu/">Trash Menu</a></li>
                          <li class="<?php echo $class_state_sub_6; ?>"><a href="<?php echo base_url(); ?>appearanceadmin/trash_view_menu_type/">Trash Menu Type</a></li><?php /* */ ?>
                    </ul>
                </li>

                <?php
               /**/ $style_state = '';
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';
                $class_state_sub_3 = '';
                $class_state_sub_4 = '';
                $class_state_sub_5 = '';
                $class_state_sub_6 = '';
                $class_state_sub_7 = '';
                $class_state_sub_8 = '';
                $class_state_sub_9 = '';
                $class_state_sub_10 = '';
                $class_state_sub_11 = '';
                $class_state_sub_12 = '';                

                if ($this->uri->segment(1) == 'ecproductadmin') {                    

                    if ($this->uri->segment(2) == 'add_main_category_type') {
                        $class_state_main = 'active';
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_main_category_type') {
                        $class_state_main = 'active';
                        $class_state_sub_2 = 'active';
                    }
                    if ($this->uri->segment(2) == 'add_categorytype') {
                        $class_state_main = 'active';
                        $class_state_sub_3 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_categorytype') {
                        $class_state_main = 'active';
                        $class_state_sub_4 = 'active';
                    }
                    if ($this->uri->segment(2) == 'add_prodcategory') {
                        $class_state_main = 'active';
                        $class_state_sub_5 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_prodcategory') {
                        $class_state_main = 'active';
                        $class_state_sub_6 = 'active';
                    }
                    if ($this->uri->segment(2) == 'add_product') {
                        $class_state_main = 'active';
                        $class_state_sub_7 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_product') {
                        $class_state_main = 'active';
                        $class_state_sub_8 = 'active';
                    }
                    if ($this->uri->segment(2) == 'downloadproductlist') {
                        $class_state_main = 'active';
                        $class_state_sub_9 = 'active';
                    }
                    if ($this->uri->segment(2) == 'trash_view_categorytype') {
                        $class_state_main = 'active';
                        $class_state_sub_10 = 'active';
                    }
                    if ($this->uri->segment(2) == 'trash_view_prodcategory') {
                        $class_state_main = 'active';
                        $class_state_sub_11 = 'active';
                    }
                    if ($this->uri->segment(2) == 'trash_view_product') {
                        $class_state_main = 'active';
                        $class_state_sub_12 = 'active';
                    }
                    if ($this->uri->segment(2) == 'edit_prodcategory') {
                        $class_state_main = 'active';
                    }
                    if ($this->uri->segment(2) == 'edit_prodcategory2') {
                        $class_state_main = 'active';
                    }
                    if ($this->uri->segment(2) == 'edit_product') {
                        $class_state_main = 'active';
                    }
                    if ($this->uri->segment(2) == 'editProducts2') {
                        $class_state_main = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_product_gallery') {
                        $class_state_main = 'active';
                    }
                    if ($this->uri->segment(2) == 'edit_product_image') {
                        $class_state_main = 'active';
                    }
                    if ($this->uri->segment(2) == 'editProducts3') {
                        $class_state_main = 'active';
                    }
                }
                ?>

                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-grid2-alt"></i><span>Manage Services</span></a>
                    <ul class="collapse">                       

                        <li class="<?php echo $class_state_sub_5; ?>"><a href="<?php echo base_url(); ?>ecproductadmin/add_prodcategory/">Add Category</a></li>
                        <li class="<?php echo $class_state_sub_6; ?>"><a href="<?php echo base_url(); ?>ecproductadmin/view_prodcategory/">View Category</a></li>
                        <li class="<?php echo $class_state_sub_7; ?>"><a href="<?php echo base_url(); ?>ecproductadmin/add_product/">Add Service</a></li>
                        <li class="<?php echo $class_state_sub_8; ?>"><a href="<?php echo base_url(); ?>ecproductadmin/view_product/">View Services</a></li>
                        <li class="<?php echo $class_state_sub_9; ?>"><a href="javascript:void(0)">Download Service Lists</a></li>

                    </ul>
                </li><?php /**/ ?>
                
                <?php
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';
                $class_state_sub_3 = '';
                $class_state_sub_4 = '';
                
                if ($this->uri->segment(1) == 'ecproductadmin') {
                    if ($this->uri->segment(2) == 'add_service') {
                        $class_state_main = 'active';
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_services') {
                        $class_state_main = 'active';
                        $class_state_sub_2 = 'active';
                    }
                    if ($this->uri->segment(2) == 'edit_service') {
                        $class_state_main = 'active'; 
                    }
                    if ($this->uri->segment(2) == 'add_ticket_type') {
                        $class_state_main = 'active';
                        $class_state_sub_3 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_ticket_types') {
                        $class_state_main = 'active';
                        $class_state_sub_4 = 'active';
                    }
                    if ($this->uri->segment(2) == 'edit_ticket_type') {
                        $class_state_main = 'active'; 
                    }
                }
                ?>
                
                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers"></i><span>Manage Events</span></a>
                    <ul class="collapse">
                        <li class="<?php echo $class_state_sub_1; ?>"><a href="<?php echo base_url(); ?>ecproductadmin/add_service/">Add Event</a></li>
                        <li class="<?php echo $class_state_sub_2; ?>"><a href="<?php echo base_url(); ?>ecproductadmin/view_services/">View Events</a></li>
                        <li class="<?php echo $class_state_sub_3; ?>"><a href="<?php echo base_url(); ?>ecproductadmin/add_ticket_type/">Add Ticket Type</a></li>
                        <li class="<?php echo $class_state_sub_4; ?>"><a href="<?php echo base_url(); ?>ecproductadmin/view_ticket_types/">View Ticket Types</a></li>                        
                    </ul>
                </li><?php /**/ ?>
        


                <?php
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';
                $class_state_sub_3 = '';
                $class_state_sub_4 = '';
                
                if ($this->uri->segment(1) == 'ecproductadmin') {

                    if ($this->uri->segment(2) == 'add_package') {
                        $class_state_main = 'active';
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_packages') {
                        $class_state_main = 'active';
                        $class_state_sub_2 = 'active';
                    }
                    if ($this->uri->segment(2) == 'edit_package') {
                        $class_state_main = 'active'; 
                    }
                   
                }
                ?>

                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers"></i><span>Manage Packages</span></a>
                    <ul class="collapse">
                        <li class="<?php echo $class_state_sub_1; ?>"><a href="<?php echo base_url(); ?>ecproductadmin/add_package/">Add Package</a></li>
                        <li class="<?php echo $class_state_sub_2; ?>"><a href="<?php echo base_url(); ?>ecproductadmin/view_packages/">View Packages</a></li>
                                                                    
                    </ul>
                </li>
        

                <?php
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';
                $class_state_sub_3 = '';
                $class_state_sub_4 = '';
                $class_state_sub_5 = '';
                $class_state_sub_6 = '';

                if ($this->uri->segment(1) == 'contentadmin'  && $this->uri->segment(2) != 'viewcomments') {
                    

                    if ($this->uri->segment(2) == 'addcategory') {
                        $class_state_main = 'active';
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'viewcategory') {
                        $class_state_main = 'active';
                        $class_state_sub_2 = 'active';
                    }
                    if ($this->uri->segment(2) == 'add_content') {
                        $class_state_main = 'active';
                        $class_state_sub_3 = 'active';
                    }
                    if ($this->uri->segment(2) == 'viewcontent') {
                        $class_state_main = 'active';
                        $class_state_sub_4 = 'active';
                    }
                    if ($this->uri->segment(2) == 'trash_viewcategory') {
                        $class_state_main = 'active';
                        $class_state_sub_5 = 'active';
                    }
                    if ($this->uri->segment(2) == 'trash_viewContent') {
                        $class_state_main = 'active';
                        $class_state_sub_6 = 'active';
                    }
                    if ($this->uri->segment(2) == 'edit_content') {
                        $class_state_main = 'active';                        
                    }
                    if ($this->uri->segment(2) == 'edit_content_2') {
                        $class_state_main = 'active';                       

                    }
                    if ($this->uri->segment(2) == 'view_content_gallery') {
                        $class_state_main = 'active';                       

                    }
                    if ($this->uri->segment(2) == 'edit_content_image') {
                        $class_state_main = 'active';                        

                    }
                }
                ?>

                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-server"></i> <span>Manage Contents</span></a>
                    <ul class="collapse">
                        <li class="<?php echo $class_state_sub_1; ?>"><a href="<?php echo base_url(); ?>contentadmin/addcategory/">Add Category</a></li>
                        <li class="<?php echo $class_state_sub_2; ?>"><a href="<?php echo base_url(); ?>contentadmin/viewcategory/">View Category</a></li>
                        <li class="<?php echo $class_state_sub_3; ?>"><a href="<?php echo base_url(); ?>contentadmin/add_content/">Add Content</a></li>
                        <li class="<?php echo $class_state_sub_4; ?>"><a href="<?php echo base_url(); ?>contentadmin/viewcontent/">View Contents</a></li>
                        <?php /*  ?><li class="<?php echo $class_state_sub_5; ?>"><a href="<?php echo base_url(); ?>contentadmin/trash_viewcategory/">Trash Category</a></li>
                          <li class="<?php echo $class_state_sub_6; ?>"><a href="<?php echo base_url(); ?>contentadmin/trash_viewContent/">Trash Content</a></li><?php /* */ ?>
                    </ul>
                </li>

                <?php
                $class_state_main = '';
                $class_state_sub_2 = '';
                

                if ($this->uri->segment(1) == 'contentadmin' && $this->uri->segment(2) == 'viewcomments')  {
                    $class_state_main = 'active';
                   
                    if ($this->uri->segment(2) == 'viewcomments' && $this->uri->segment(1) == 'contentadmin') {
                        $class_state_sub_2 = 'active';
                    }
                    
                }
                ?>

                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-comment"></i> <span>Manage Comments</span></a>
                    <ul class="collapse">
                        <li class="<?php echo $class_state_sub_2; ?>"><a href="<?php echo base_url(); ?>contentadmin/viewcomments/">View Comments</a></li>
                        
                    </ul>
                </li>


                <?php
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';
                $class_state_sub_3 = '';
                $class_state_sub_4 = '';
                $class_state_sub_5 = '';
                $class_state_sub_6 = '';

                if ($this->uri->segment(1) == 'commonimageadmin') {
                    $class_state_main = 'active';

                    if ($this->uri->segment(2) == 'addcategory') {
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'viewcategory') {
                        $class_state_sub_2 = 'active';
                    }
                    if ($this->uri->segment(2) == 'addimages') {
                        $class_state_sub_3 = 'active';
                    }
                    if ($this->uri->segment(2) == 'viewimages') {
                        $class_state_sub_4 = 'active';
                    }
                    if ($this->uri->segment(2) == 'trash_viewcategory') {
                        $class_state_sub_5 = 'active';
                    }
                    if ($this->uri->segment(2) == 'trash_viewImage') {
                        $class_state_sub_6 = 'active';
                    }
                }
                ?>

                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-image"></i>
                        <span>Manage Image Gallery</span></a>
                    <ul class="collapse">
                        <li class="<?php echo $class_state_sub_1; ?>"><a href="<?php echo base_url(); ?>commonimageadmin/addcategory/">Add Category</a></li>
                        <li class="<?php echo $class_state_sub_2; ?>"><a href="<?php echo base_url(); ?>commonimageadmin/viewcategory/">View Category</a></li>
                        <li class="<?php echo $class_state_sub_3; ?>"><a href="<?php echo base_url(); ?>commonimageadmin/addimages/">Add Image</a></li>
                        <li class="<?php echo $class_state_sub_4; ?>"><a href="<?php echo base_url(); ?>commonimageadmin/viewimages/">View Images</a></li>

                    </ul>
                </li>
                
                <?php
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';
                $class_state_sub_3 = '';
                $class_state_sub_4 = '';
                
                if ($this->uri->segment(1) == 'videogalleryadmin') {
                    $class_state_main = 'active';
                    
                    if ($this->uri->segment(2) == 'add_video') {                        
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_videos') {                        
                        $class_state_sub_2 = 'active';
                    }
                    if ($this->uri->segment(2) == 'add_category') {                        
                        $class_state_sub_3 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_category') {                        
                        $class_state_sub_4 = 'active';
                    }
                }
                ?>
                
                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-video-camera"></i>
                        <span>Manage Video Gallery</span></a>
                    <ul class="collapse">
                        <li class="<?php echo $class_state_sub_3; ?>"><a href="<?php echo base_url(); ?>videogalleryadmin/add_category/">Add Category</a></li>
                        <li class="<?php echo $class_state_sub_4; ?>"><a href="<?php echo base_url(); ?>videogalleryadmin/view_category/">View Category</a></li>
                        <li class="<?php echo $class_state_sub_1; ?>"><a href="<?php echo base_url(); ?>videogalleryadmin/add_video/">Add Video</a></li>
                        <li class="<?php echo $class_state_sub_2; ?>"><a href="<?php echo base_url(); ?>videogalleryadmin/view_videos/">View Videos</a></li>
                    </ul>
                </li>

                <?php
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';
                $class_state_sub_3 = '';
                
                if ($this->uri->segment(1) == 'fileuploadadmin') {
                    $class_state_main = 'active';

                    if ($this->uri->segment(2) == 'addUpload_type') {
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'viewUpload_type') {
                        $class_state_sub_2 = 'active';
                    }
                    if ($this->uri->segment(2) == 'addManipulation') {
                        $class_state_sub_3 = 'active';
                    }
                    if ($this->uri->segment(2) == 'viewallManipulation') {
                        $class_state_sub_4 = 'active';
                    }
                    if ($this->uri->segment(2) == 'addCombo') {
                        $class_state_sub_5 = 'active';
                    }
                    if ($this->uri->segment(2) == 'viewallCombo') {
                        $class_state_sub_6 = 'active';
                    }
                }
                ?>
                
                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-image"></i>
                        <span>Manage File Upload</span></a>
                    <ul class="collapse">
                        <li class="<?php echo $class_state_sub_1; ?>"><a href="<?php echo base_url(); ?>fileuploadadmin/addUpload_type/">Add Upload Type</a></li>
                        <li class="<?php echo $class_state_sub_2; ?>"><a href="<?php echo base_url(); ?>fileuploadadmin/viewUpload_type/">View Upload Types</a></li>
                        <li class="<?php echo $class_state_sub_3; ?>"><a href="<?php echo base_url(); ?>fileuploadadmin/addManipulation/">Add Manipulation</a></li>
                        <li class="<?php echo $class_state_sub_4; ?>"><a href="<?php echo base_url(); ?>fileuploadadmin/viewallManipulation/">View Manipulations</a></li>
                        <li class="<?php echo $class_state_sub_5; ?>"><a href="<?php echo base_url(); ?>fileuploadadmin/addCombo/">Add Combo</a></li>
                        <li class="<?php echo $class_state_sub_6; ?>"><a href="<?php echo base_url(); ?>fileuploadadmin/viewallCombo/">View Combos</a></li>

                    </ul>
                </li>

                <?php
                $class_state_main = '';
                $class_state_sub_1 = '';
                $class_state_sub_2 = '';
                $class_state_sub_3 = '';
                $class_state_sub_4 = '';
                $class_state_sub_5 = '';
                $class_state_sub_6 = '';

                if ($this->uri->segment(1) == 'cmsstorefinderadmin') {

                    if ($this->uri->segment(2) == 'add_location_type') {
                        $class_state_main = 'active';
                        $class_state_sub_1 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_location_type') {
                        $class_state_main = 'active';
                        $class_state_sub_2 = 'active';
                    }
                    if ($this->uri->segment(2) == 'add_location') {
                        $class_state_main = 'active';
                        $class_state_sub_3 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_location') {
                        $class_state_main = 'active';
                        $class_state_sub_4 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_trash_location_type') {
                        $class_state_main = 'active';
                        $class_state_sub_5 = 'active';
                    }
                    if ($this->uri->segment(2) == 'view_trash_location') {
                        $class_state_main = 'active';
                        $class_state_sub_6 = 'active';
                    }
                }
                ?>

                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-world"></i> <span>Manage Locations</span></a>
                    <ul class="collapse">                        
                        <li class="<?php echo $class_state_sub_2; ?>"><a href="<?php echo base_url(); ?>cmsstorefinderadmin/view_location_type/">View Types</a></li>                        
                        <li class="<?php echo $class_state_sub_4; ?>"><a href="<?php echo base_url(); ?>cmsstorefinderadmin/view_location/">View Locations</a></li>                        
                    </ul>
                </li>

                <?php
                $class_state_main = '';
                $class_state_sub_1 = '';

                if ($this->uri->segment(1) == 'optionadmin') {
                    $class_state_main = 'active';

                    if ($this->uri->segment(2) == 'viewoptions') {
                        $class_state_sub_1 = 'active';
                    }
                }
                ?>

                <li class="<?php echo $class_state_main; ?>">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i> <span>Manage Settings</span></a>
                    <ul class="collapse">
                        <li class="<?php echo $class_state_sub_1; ?>"><a href="<?php echo base_url(); ?>optionadmin/viewoptions/">View Settings</a></li>

                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</div>