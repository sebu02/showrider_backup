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
                    <input type="text" name="name" placeholder="Search..." id="" value="" >
                    <i class="ti-search" id=""></i>
                </form>
            </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
                <li class="dropdown gl_refresh_btn" data-refresh="<?php echo base_url() . 'ecproductadmin/view_product_gallery/'.$this->uri->segment(3); ?>">
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
                <h4 class="page-title pull-left">Manage Services</h4>

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

                    <h4 class="header-title">View Gallery</h4>
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <!--<th scope="col">SLNO</th>-->

                                        <th scope="col">IMAGE TITLE</th>

                                        <!-- <th scope="col">IMAGE SIZE</th>  -->                                        

                                        <!-- <th scope="col">THUMBNAIL STATUS</th> -->

                                        <th scope="col">IMAGE</th>

                                        <th scope="col">ORDER</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    // $i = 0;

                                    if ($media_list_1 != NULL) {

                                        foreach ($media_list_1 as $im) {
                                            if ($im != '') {
                                                  
                                                $row_img = json_decode($im->images, TRUE);

                                                // $i++;

                                                ?>    

                                                <tr>
                                                    <!--<td><?php // echo $i;  ?></td>-->
                                                    
                                                    <td><?php 
                                                    
                                                                /* if($im->image_type == 'default_img')
                                                                {
                                                                    echo ucwords('featured');
                                                                }
                                                                else if($im->image_type == 'banner_img')
                                                                {
                                                                    echo ucwords('banner');
                                                                }
                                                                else if($im->image_type == 'featured')
                                                                {
                                                                    echo ucwords('featured');
                                                                }
                                                                else if($im->image_type == 'other')
                                                                {
                                                                    echo ucwords('other');
                                                                }
                                                                else if($im->image_type == 'thumbnail')
                                                                {
                                                                    echo ucwords('thumbnail');
                                                                }/**/ 

                                                                echo $im->title;

                                                      ?> </td>



                                                    <?php /* ?><td><?php if($im->image_size == 'half_right')
                                                                {
                                                                    echo ucwords('half right');
                                                                }
                                                                else if($im->image_size == 'half_left')
                                                                {
                                                                    echo ucwords('half left');
                                                                }
                                                                else if($im->image_size == 'full_width')
                                                                {
                                                                    echo ucwords('full width');
                                                                }                                                               
                                                                else if($im->image_size == 'normal')
                                                                {
                                                                    echo ucwords('normal');
                                                                }                                                             
                                                      
                                                      ?> 
                                                    </td><?php /**/ ?>                                                   
                                                    
                                                    <?php /* ?><td>
                                                        <?php
                                                        if ($im->default_img == 'yes') {
                                                            echo 'Yes';
                                                        } else {
                                                            echo 'No';
                                                        }                                                        
                                                        ?>

                                                    </td><?php /**/ ?>

                                                    <td><img src="<?php echo base_url() . 'media_library/' . $row_img['image']; ?>" width="100" /></td>    

                                                    <td>
                                                        <?php echo $im->order; ?> 
                                                    </td>

                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3"><a href="<?php echo base_url() . 'ecproductadmin/edit_product_image/' . $im->id . '/' . $product->id . '/' . $this->uri->segment(4); ?>" title="Edit" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                            
                                                            <li><a href="javascript:void(0);" title="Remove" class="text-danger" onclick="linkRef('<?php echo base_url() . 'ecproductadmin/delete_product_image/' . $im->id . '/' . $product->id . '/'; ?>')"><i class="ti-trash"></i></a></li>
                                                            
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                        }
                                    }
                                    ?>                                                                      

                                    <?php

                                    // $i = 0;

                                    if ($media_list_2 != NULL) {

                                        foreach ($media_list_2 as $im) {
                                            if ($im != '') {
                                                  
                                                $row_img = json_decode($im->images, TRUE);

                                                // $i++;

                                                ?>    

                                                <tr>
                                                    <!--<td><?php // echo $i;  ?></td>-->

                                                    <td><?php  /* if($im->image_type == 'default_img')
                                                                {
                                                                    echo ucwords('featured');
                                                                }
                                                                else if($im->image_type == 'banner_img')
                                                                {
                                                                    echo ucwords('banner');
                                                                }
                                                                else if($im->image_type == 'featured')
                                                                {
                                                                    echo ucwords('featured');
                                                                }
                                                                else if($im->image_type == 'other')
                                                                {
                                                                    echo ucwords('other');
                                                                }
                                                                else if($im->image_type == 'thumbnail')
                                                                {
                                                                    echo ucwords('thumbnail');
                                                                }/**/   

                                                                echo $im->title;
                                                      ?> </td>



                                                    <?php /* ?><td><?php if($im->image_size == 'half_right')
                                                                {
                                                                    echo ucwords('half right');
                                                                }
                                                                else if($im->image_size == 'half_left')
                                                                {
                                                                    echo ucwords('half left');
                                                                }
                                                                else if($im->image_size == 'full_width')
                                                                {
                                                                    echo ucwords('full width');
                                                                }                                                               
                                                                else if($im->image_size == 'normal')
                                                                {
                                                                    echo ucwords('normal');
                                                                }                                                             
                                                      
                                                      ?> 
                                                    </td><?php /**/ ?>                                                   
                                                    
                                                    <?php /* ?><td>
                                                        <?php
                                                        if ($im->default_img == 'yes') {
                                                            echo 'Yes';
                                                        } else {
                                                            echo 'No';
                                                        }                                                        
                                                        ?>

                                                    </td><?php /**/ ?>

                                                    <td><img src="<?php echo base_url() . 'media_library/' . $row_img['image']; ?>" width="100" /></td>    

                                                    <td>
                                                        <?php echo $im->order; ?> 
                                                    </td>

                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3"><a href="<?php echo base_url() . 'ecproductadmin/edit_product_image/' . $im->id . '/' . $product->id . '/' . $this->uri->segment(4); ?>" title="Edit" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                            
                                                            <li><a href="javascript:void(0);" title="Remove" class="text-danger" onclick="linkRef('<?php echo base_url() . 'ecproductadmin/delete_product_image/' . $im->id . '/' . $product->id . '/'; ?>')"><i class="ti-trash"></i></a></li>
                                                            
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                        }
                                    }
                                    ?>

                                    <?php

                                    // $i = 0;

                                    if ($media_list_3 != NULL) {

                                        foreach ($media_list_3 as $im) {
                                            if ($im != '') {
                                                  
                                                $row_img = json_decode($im->images, TRUE);

                                                // $i++;

                                                ?>    

                                                <tr>
                                                    <!--<td><?php // echo $i;  ?></td>-->

                                                    <td><?php   /* if($im->image_type == 'default_img')
                                                                {
                                                                    echo ucwords('featured');
                                                                }
                                                                else if($im->image_type == 'banner_img')
                                                                {
                                                                    echo ucwords('banner');
                                                                }
                                                                else if($im->image_type == 'featured')
                                                                {
                                                                    echo ucwords('featured');
                                                                }
                                                                else if($im->image_type == 'other')
                                                                {
                                                                    echo ucwords('other');
                                                                }
                                                                else if($im->image_type == 'thumbnail')
                                                                {
                                                                    echo ucwords('thumbnail');
                                                                }/**/  
                                                                
                                                                echo $im->title;
                                                      ?> </td>



                                                    <?php /* ?><td><?php if($im->image_size == 'half_right')
                                                                {
                                                                    echo ucwords('half right');
                                                                }
                                                                else if($im->image_size == 'half_left')
                                                                {
                                                                    echo ucwords('half left');
                                                                }
                                                                else if($im->image_size == 'full_width')
                                                                {
                                                                    echo ucwords('full width');
                                                                }                                                               
                                                                else if($im->image_size == 'normal')
                                                                {
                                                                    echo ucwords('normal');
                                                                }                                                             
                                                      
                                                      ?> 
                                                    </td><?php /**/ ?>                                                   
                                                    
                                                    <?php /* ?><td>
                                                        <?php
                                                        if ($im->default_img == 'yes') {
                                                            echo 'Yes';
                                                        } else {
                                                            echo 'No';
                                                        }                                                        
                                                        ?>

                                                    </td><?php /**/ ?>

                                                    <td><img src="<?php echo base_url() . 'media_library/' . $row_img['image']; ?>" width="100" /></td>    

                                                    <td>
                                                        <?php echo $im->order; ?> 
                                                    </td>

                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3"><a href="<?php echo base_url() . 'ecproductadmin/edit_product_image/' . $im->id . '/' . $product->id . '/' . $this->uri->segment(4); ?>" title="Edit" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                            
                                                            <li><a href="javascript:void(0);" title="Remove" class="text-danger" onclick="linkRef('<?php echo base_url() . 'ecproductadmin/delete_product_image/' . $im->id . '/' . $product->id . '/'; ?>')"><i class="ti-trash"></i></a></li>
                                                            
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                        }
                                    }
                                    ?>

                                     <?php

                                    // $i = 0;

                                    if ($media_list_4 != NULL) {

                                        foreach ($media_list_4 as $im) {
                                            if ($im != '') {
                                                  
                                                $row_img = json_decode($im->images, TRUE);

                                                // $i++;

                                                ?>    

                                                <tr>
                                                    <!--<td><?php // echo $i;  ?></td>-->

                                                    <td><?php   /* if($im->image_type == 'default_img')
                                                                {
                                                                    echo ucwords('featured');
                                                                }
                                                                else if($im->image_type == 'banner_img')
                                                                {
                                                                    echo ucwords('banner');
                                                                }
                                                                else if($im->image_type == 'featured')
                                                                {
                                                                    echo ucwords('featured');
                                                                }
                                                                else if($im->image_type == 'other')
                                                                {
                                                                    echo ucwords('other');
                                                                }
                                                                else if($im->image_type == 'thumbnail')
                                                                {
                                                                    echo ucwords('thumbnail');
                                                                }/**/
                                                                
                                                                echo $im->title;
                                                      ?> </td>



                                                    <?php /* ?><td><?php if($im->image_size == 'half_right')
                                                                {
                                                                    echo ucwords('half right');
                                                                }
                                                                else if($im->image_size == 'half_left')
                                                                {
                                                                    echo ucwords('half left');
                                                                }
                                                                else if($im->image_size == 'full_width')
                                                                {
                                                                    echo ucwords('full width');
                                                                }                                                               
                                                                else if($im->image_size == 'normal')
                                                                {
                                                                    echo ucwords('normal');
                                                                }                                                             
                                                      
                                                      ?> 
                                                    </td><?php /**/ ?>                                                   
                                                    
                                                    <?php /* ?><td>
                                                        <?php
                                                        if ($im->default_img == 'yes') {
                                                            echo 'Yes';
                                                        } else {
                                                            echo 'No';
                                                        }                                                        
                                                        ?>

                                                    </td><?php /**/ ?>

                                                    <td><img src="<?php echo base_url() . 'media_library/' . $row_img['image']; ?>" width="100" /></td>    

                                                    <td>
                                                        <?php echo $im->order; ?> 
                                                    </td>

                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3"><a href="<?php echo base_url() . 'ecproductadmin/edit_product_image/' . $im->id . '/' . $product->id . '/' . $this->uri->segment(4); ?>" title="Edit" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                            
                                                            <li><a href="javascript:void(0);" title="Remove" class="text-danger" onclick="linkRef('<?php echo base_url() . 'ecproductadmin/delete_product_image/' . $im->id . '/' . $product->id . '/'; ?>')"><i class="ti-trash"></i></a></li>
                                                            
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="single-table" style="height: 20px;"></div>
                    <nav aria-label="...">
                        <ul class="pagination">

                        </ul>
                    </nav>

                </div>
            </div>
        </div>

    </div>

</div>

<script type="text/javascript">

    function linkRef(yurl) {
        var linkref = yurl;
        if (confirm("Do you really want to delete ?")) {
            window.location.href = linkref;
        }
    }

</script>

