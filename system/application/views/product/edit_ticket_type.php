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
                <h4 class="page-title pull-left">Manage Events</h4>

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
                            
                            <h4 class="header-title">Edit Ticket Type</h4>
                                                        
                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'ecproductadmin/edit_ticket_type?id='.$single_detail->id; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                                <div class="form-group">
                                    <label class="col-form-label">Event<a style="color:#F00; font-size:12px;">*</a></label>
                                    <select class="custom-select search_select" name="category" required style="cursor: pointer;">
                                        <option selected value="">--select--</option>

                                        <?php

                                        // $i = 0;

                                        foreach ($events_list as $event) {
                                            ?>    
                                            <option value="<?php echo $event->id; ?>"
                                                    
                                                    <?php if($single_detail->category == $event->id){ echo "selected"; } ?>>
                                                        <?php
                                                        echo $event->name;
                                                        ?></option>
                                            <?php
                                        }
                                        ?>    

                                    </select>
                                    <span class="error">
                                        <?php echo form_error('category'); ?>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="ticket_name">Name<a style="color:#F00; font-size:12px;">*</a></label>
                                    <input type="text" name="ticket_name" class="form-control" id="ticket_name" value="<?php echo $single_detail->name; ?>" placeholder="" required>

                                    <span class="error">
                                        <?php echo form_error('ticket_name'); ?>
                                    </span>

                                </div>

                                <div class="form-group">
                                    <label for="ticket_code">Code</label>
                                    <input type="text" name="ticket_code" class="form-control" id="ticket_code" value="<?php echo $single_detail->code; ?>" required readonly>

                                    <span class="error">
                                        <?php echo form_error('ticket_code'); ?>
                                    </span>

                                </div>                              

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" value="<?php echo $single_detail->title; ?>">

                                    <span class="error">
                                        <?php // echo form_error('title'); ?>
                                    </span>

                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" class="form-control" id="price" value="<?php echo $single_detail->price; ?>">

                                    <span class="error">
                                        <?php // echo form_error('price'); ?>
                                    </span>

                                </div>

                                <div class="form-group">
                                    <label for="total_number">Total Number</label>
                                    <input type="number" name="total_number" class="form-control" id="total_number" value="<?php echo $single_detail->total_number; ?>" min="0">

                                    <span class="error">
                                        <?php // echo form_error('total_number'); ?>
                                    </span>

                                </div>                              
                                                          
                                                               
                                                                                                                                                                                               
                                                                
                                <div class="form-group">
                                    <label for="order_number">Order</label>
                                    <input type="number" name="order_number" class="form-control" id="order_number" placeholder="" value="<?php echo $single_detail->order_no; ?>" required min="0" />
                                    <span class="error"><?php echo form_error('order_number'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="active_status">Active Status</label><br/>
                                                                
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="a" id="active_status1" name="active_status" class="custom-control-input"

                                            <?php                                           
                                                
                                            if ($single_detail->active_status == 'a'){
                                                    echo 'checked';
                                            }                                           

                                            ?> />
                                        <label class="custom-control-label" for="active_status1" style="cursor: pointer;">Active</label>
                                    </div>
                                    
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="d" id="active_status2" name="active_status" class="custom-control-input"

                                            <?php                                           
                                            if ($single_detail->active_status == 'd'){
                                                    echo 'checked';
                                            }
                                            ?> />
                                        <label class="custom-control-label" for="active_status2" style="cursor: pointer;">Deactive</label>
                                    </div>

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


