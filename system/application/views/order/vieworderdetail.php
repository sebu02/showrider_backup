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
                <h4 class="page-title pull-left">Manage Orders</h4>

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
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-area">
                        <div class="invoice-head">
                            <div class="row">
                                <div class="iv-left col-6">
                                    <span>ORDER ID</span>
                                </div>
                                <div class="iv-right col-6 text-md-right">
                                    <span>

                                        <?php
                                        if ($myorders->order_id == 0) {
                                            $ordrid = "TMPODR" . $myorders->id;
                                        } else {
                                            $ordrid = "GLTODR" . $myorders->order_id;
                                        }

                                        echo $ordrid;
                                        ?>   

                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="invoice-address">
                                    <!--<h3>ORDER DETAILS</h3>-->
                                    
                                    <?php
                                    $billing_address = json_decode($myorders->billing_address, TRUE);
                                    if ($billing_address != NULL) {
                                        if (array_key_exists('frm_first_name', $billing_address) && $billing_address['frm_first_name'] != '') {

                                            $frm_first_name = $billing_address['frm_first_name'];
                                        } else {

                                            $frm_first_name = "";
                                        }

                                        if (array_key_exists('frm_last_name', $billing_address) && $billing_address['frm_last_name'] != '') {

                                            $frm_last_name = $billing_address['frm_last_name'];
                                        } else {
                                            $frm_last_name = "";
                                        }

                                        if (array_key_exists('frm_address', $billing_address) && $billing_address['frm_address'] != '') {

                                            $frm_address = $billing_address['frm_address'];
                                        } else {
                                            $frm_address = "";
                                        }

                                        if (array_key_exists('frm_locality', $billing_address) && $billing_address['frm_locality'] != '') {

                                            $frm_locality = $billing_address['frm_locality'];
                                        } else {
                                            $frm_locality = "";
                                        }

                                        if (array_key_exists('frm_email', $billing_address) && $billing_address['frm_email'] != '') {

                                            $frm_email = $billing_address['frm_email'];
                                        } else {
                                            $frm_email = "";
                                        }

                                        if (array_key_exists('frm_phoneno', $billing_address) && $billing_address['frm_phoneno'] != '') {

                                            $frm_phoneno = $billing_address['frm_phoneno'];
                                        } else {
                                            $frm_phoneno = "";
                                        }

                                        if (array_key_exists('frm_pincode', $billing_address) && $billing_address['frm_pincode'] != '') {

                                            $frm_pincode = $billing_address['frm_pincode'];
                                        } else {
                                            $frm_pincode = "";
                                        }

                                        if (array_key_exists('frm_city', $billing_address) && $billing_address['frm_city'] != '') {

                                            $frm_city = $billing_address['frm_city'];
                                        } else {
                                            $frm_city = "";
                                        }

                                        if (array_key_exists('frm_state', $billing_address) && $billing_address['frm_state'] != '') {

                                            $frm_state = $billing_address['frm_state'];
                                        } else {
                                            $frm_state = "";
                                        }

                                        if (array_key_exists('frm_country', $billing_address) && $billing_address['frm_country'] != '') {

                                            $frm_country = $billing_address['frm_country'];
                                        } else {
                                            $frm_country = "";
                                        }

                                        if (array_key_exists('frm_landmark', $billing_address) && $billing_address['frm_landmark'] != '') {

                                            $frm_landmark = $billing_address['frm_landmark'];
                                        } else {
                                            $frm_landmark = "";
                                        }

                                        if (array_key_exists('frm_alt_phone', $billing_address) && $billing_address['frm_alt_phone'] != '') {

                                            $frm_alt_phone = $billing_address['frm_alt_phone'];
                                        } else {
                                            $frm_alt_phone = "";
                                        }
                                        
                                        if (array_key_exists('frm_name', $billing_address) && $billing_address['frm_name'] != '') {

                                            $frm_name = $billing_address['frm_name'];
                                        }else{
                                            $frm_name = "";
                                        }
                                    }
                                    ?>
                                    
                                    <h5>Personal Information</h5>
                                    <p><?php echo $frm_name; ?></p>
                                    <p><?php echo $frm_email; ?></p>
                                    <p><?php echo $frm_phoneno; ?></p>
                                    <br><br>
                                    
                                    <h5>Billing Address</h5>                                    
                                    <p><?php echo $frm_first_name . ' ' . $frm_last_name; ?></p>                                                                     
                                    <p><?php echo $frm_address; ?></p>
                                    <p><?php echo $frm_pincode; ?></p>
                                    <p><?php echo $frm_locality; ?></p>                                    
                                    <p><?php echo $frm_city; ?></p>                                                
                                    <p><?php echo $frm_state; ?></p>
                                    <p><?php echo $frm_country; ?></p>
                                    <p><?php echo $frm_alt_phone; ?></p>
                                                                        
                                </div>
                            </div>
                                                        
                            <div class="col-md-6 text-md-right">
                                <ul class="invoice-date">
                                    <?php
                                    $ordr_date = date('jS F Y  H:i:s', strtotime($myorders->purchase_date));

                                    $order_status = "";
                                    if ($myorders->payment_status == '2') {
                                        $order_status = "Success";
                                    } else if ($myorders->payment_status == '6') {
                                        $order_status = "Aborted";
                                    } else if ($myorders->payment_status == '4') {
                                        $order_status = "Declined";
                                    } else if ($myorders->payment_status == '5') {
                                        $order_status = "Failed";
                                    } else {
                                        $order_status = "Pending";
                                    }
                                    ?>
                                    <li>Purchased Date : <?php echo $ordr_date; ?></li>
                                    <li>No. of Items : 1 Item</li>
                                    <li>Method : <?php echo $myorders->payment_method_string; ?></li>
                                    <li>Status : <?php echo $order_status; ?></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <?php
                            $my_order_products = $this->common_model->my_order_list($myorders->id);
                            $my_order_products_single = $my_order_products[0];
                            $product_details = $this->common_model->GetByRow_notrash('ec_products', $my_order_products_single->product_id, 'id');

                            $images_arr = json_decode($product_details->prod_file, TRUE);
                            $image = $images_arr['image'];
                            $image_alt = $images_arr['seo_alt'];
                            $image_title = $images_arr['seo_title'];
                            ?>
                            <div class="col-md-6">
                                <div class="invoice-address"><br><br><br>
                                    <h5>Template Details</h5>
                                    <img src="<?php echo base_url() . 'media_library/original_' . $image; ?>" alt="<?php echo $image_alt; ?>" title="<?php echo $image_title; ?>">
                                </div>                                                
                            </div> 
                            <div class="col-md-6 text-md-right">
                                <ul class="invoice-date">
                                    <li><?php echo $product_details->product_display_name; ?></li>
                                    <li>GLWT-<?php echo $product_details->id; ?></li>
                                    <li>$<?php echo $my_order_products_single->product_price; ?></li>
                                    <li>Qty x 1</li>
                                </ul>
                            </div>    
                        </div>

                        <div class="invoice-table table-responsive mt-5">
                            <h5 style="font-size: 17px;">Add-on Services</h5>
                            <?php
                            $add_on_services_json = $my_order_products_single->add_on_services;
                            $add_on_services_array = json_decode($add_on_services_json, TRUE);
                            $add_on_total_amount = 0;
                            if ($add_on_services_array == NULL) {
                                ?>
                                <br>
                                <p>None of the services has been selected.</p><br>

                                <?php
                            } else {
                                ?>
                                <table class="table table-bordered table-hover text-right">
                                    <thead>
                                        <tr class="text-capitalize">
                                            <th class="text-center" style="width: 20%;">Code</th>
                                            <th class="text-left" style="width: 40%;">Name</th>                                                                                                        
                                            <th style="min-width: 100px">Price</th>                                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($add_on_services_array as $add_on_val) {
                                            $add_on_details = $this->common_model->GetByRow_notrash('ec_category', $add_on_val, 'id');
//                                                   $add_on_total_amount = $add_on_total_amount + $add_on_details->amount;
                                            ?>   
                                            <tr>
                                                <td class="text-center">ADS-<?php echo $add_on_details->id; ?></td>
                                                <td class="text-left"><?php echo $add_on_details->category; ?></td>                                                  

                                                <td>$<?php echo $add_on_details->amount; ?></td>                                                    
                                            </tr>
                                            <?php
                                        }
                                        ?>                                                 

                                    </tbody>
                                    <tfoot>
                                        <tr>                                                   

                                        </tr>
                                    </tfoot>
                                </table>
                                <?php
                            }
                            ?>                                        

                        </div>
                        <br><br>
                        <div class="invoice-head">
                            <div class="row">
                                <div class="iv-left col-6">
                                    <span>TOTAL AMOUNT</span>
                                </div>
                                <div class="iv-right col-6 text-md-right">
                                    <span>

                                        <?php
                                        echo "$" . $myorders->amount;
                                        ?>   

                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>                                                             

                </div>
            </div>
        </div>
    </div>
</div>