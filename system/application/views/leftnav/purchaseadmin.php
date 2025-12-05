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
                        <a href="javascript:void(0)"><span class="icon16  icomoon-icon-cart-4  <?php
                            if ($this->uri->segment(1) == 'ecorderadmin') {
                                ?>blue<?php } ?>"></span>Manage Orders</a>
                        <ul class="sub" <?php if ($this->uri->segment(1) == 'ecorderadmin') { ?> style="display:block;"<?php } ?>>

                            <li><a href="<?php echo base_url(); ?>ecorderadmin/vieworders/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 <?php
                                    if ($this->uri->segment(1) == 'ecorderadmin' &&
                                            $this->uri->segment(2) == 'vieworders') {
                                        ?>blue<?php } ?>"></span>View Orders
                                </a>
                            </li>
                        </ul>
                    </li> 
                    <li>
                        <a href="javascript:void(0)"><span class="icon16  icomoon-icon-grid    <?php
                            if ($this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'add_categorytype' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'view_categorytype' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'edit_categorytype' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'trash_view_categorytype' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'add_prodcategory' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'view_prodcategory' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'edit_prodcategory' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'trash_view_prodcategory' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'add_subprodcategory' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'view_subprodcategory' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'edit_subprodcategory' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'trash_view_subprodcategory' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'add_product' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'view_product' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'edit_product' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'editProducts2' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'editProducts3' ||
                                    $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'trash_view_product') {
                                ?>blue<?php } ?>"></span>Manage Products</a>
                        <ul class="sub" <?php
                        if ($this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'add_categorytype' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'view_categorytype' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'edit_categorytype' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'trash_view_categorytype' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'add_prodcategory' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'view_prodcategory' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'edit_prodcategory' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'trash_view_prodcategory' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'add_subprodcategory' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'view_subprodcategory' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'edit_subprodcategory' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'trash_view_subprodcategory' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'add_product' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'view_product' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'edit_product' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'editProducts2' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'editProducts3' ||
                                $this->uri->segment(1) == 'ecproductadmin' && $this->uri->segment(2) == 'trash_view_product') {
                            ?> style="display:block;"<?php } ?>>

                            <li><a href="<?php echo base_url(); ?>ecproductadmin/add_prodcategory/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 <?php
                                    if ($this->uri->segment(1) == 'ecproductadmin' &&
                                            $this->uri->segment(2) == 'add_prodcategory') {
                                        ?>blue<?php } ?>"></span>Add Category
                                </a>
                            </li>   <?php ?>                         
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/view_prodcategory/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 <?php
                                    if ($this->uri->segment(1) == 'ecproductadmin' &&
                                            $this->uri->segment(2) == 'view_prodcategory' ||
                                            $this->uri->segment(1) == 'ecproductadmin' &&
                                            $this->uri->segment(2) == 'edit_prodcategory') {
                                        ?>blue<?php } ?>"></span>View Category
                                </a>
                            </li>

                            <li><a href="<?php echo base_url(); ?>ecproductadmin/add_product/"><span class="icon16 icomoon-icon-arrow-right-3 <?php
                                    if ($this->uri->segment(1) == 'ecproductadmin' &&
                                            $this->uri->segment(2) == 'add_product') {
                                        ?>blue<?php } ?>"></span>Add Product
                                </a>
                            </li>                           
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/view_product/">
                                    <span class="icon16 icomoon-icon-arrow-right-3 <?php
                                    if ($this->uri->segment(1) == 'ecproductadmin' &&
                                            $this->uri->segment(2) == 'view_product' ||
                                            $this->uri->segment(1) == 'ecproductadmin' &&
                                            $this->uri->segment(2) == 'edit_product' ||
                                            $this->uri->segment(1) == 'ecproductadmin' &&
                                            $this->uri->segment(2) == 'editProducts2' ||
                                            $this->uri->segment(1) == 'ecproductadmin' &&
                                            $this->uri->segment(2) == 'editProducts3') {
                                        ?>blue<?php } ?>"></span>View Products
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>ecproductadmin/downloadproductlist"><span class="icon16 icomoon-icon-arrow-right-3 <?php
                                    if ($this->uri->segment(1) == 'ecproductadmin' &&
                                            $this->uri->segment(2) == 'downloadproductlist') {
                                        ?>blue<?php } ?>"></span>Download Product Lists</a></li>
                                    <?php ?> 


                        </ul>
                    </li>

                </ul>

            </div>
        </div><!-- End sidenav -->

    </div><!-- End #sidebar -->

    <!--Body content-->
    <?php echo $contents; ?>
    <!-- End #content -->

</div><!-- End #wrapper -->