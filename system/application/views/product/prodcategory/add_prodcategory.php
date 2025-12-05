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


        <div class="col-lg-6 col-ml-12">
            <div class="row">




                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Add Category</h4>
                            <a href="javascript:void(0);"><button style="background-color:#28a745;color: #fff;" type="button" class="btn btn-flat btn-outline-success mb-3">STEP 1</button></a>
                            <a href="javascript:void(0);"><button type="button" class="btn btn-flat btn-outline-success mb-3">STEP 2</button></a>



                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'ecproductadmin/add_prodcategory?' . $_SERVER['QUERY_STRING']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">





                                <div class="form-group" style="display:none;">
                                    <label class="col-form-label">Choose Menu<b style="color:#F00; font-size:11px;"></b></label>
                                    <select class="custom-select" name="menulist"  style="cursor: pointer;">
                                        <option selected value="0">--Menu--</option>
                                        <?php
                                                foreach ($menu_list as $cat) {
                                                    ?>
                                                    <option value="<?php echo $cat->id; ?>"<?php echo set_select('menulist', $cat->id); ?>> <?php echo $cat->category;?></option>
                                                    <?php
                                                }
                                                ?>
                                    </select>
                                 
                                </div>


                                <div class="form-group">
                                    <label for="input_name">Name<b style="color:#F00; font-size:11px;">*</b></label>
                                    <input type="text" name="input_name" class="form-control slug_ref" id="input_name" value="<?php echo set_value('input_name'); ?>" placeholder="" required>


                                    <span class="error">
                                        <?php echo form_error('input_name'); ?>
                                    </span>
                                    <input type="hidden" name="url_type" value="seo_url">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">SEO Friendly URL<b style="color:#F00; font-size:11px;">*</b></label>
                                    <p id="" class="form-text text-muted">

                                        <span style="font-size:13px;" class="sa_base_url_section"><?php echo base_url(); ?></span>
                                        <span style="font-size:13px;" class="sa_remain_url_section"></span>

                                    </p>

                                    <input type="text" name="slug" value="<?php echo set_value('slug'); ?>" required class="form-control slug_url_val" readonly id="slug" placeholder="" />

                                    <span class="error">
                                        <?php echo form_error('slug'); ?>
                                    </span>

                                    <input type="hidden" name="full_url_sec" class="sa_remain_url_section_input">

                                </div>

                                <div class="form-group" style="display: none;">
                                    <label for="short_name">Short Name</label>
                                    <input type="text" name="short_name" class="form-control" id="short_name" placeholder="" value="<?php echo set_value('short_name'); ?>" />
                                    <span class="error"><?php echo form_error('short_name'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">File Combo                                        
                                    </label>
                                    <select class="custom-select search_select" name="default_combo_id" id="default_combo_id" style="cursor: pointer;">
                                        
                                        <?php
                                        $i = 0;
                                        foreach ($values as $combos) {
                                            ?>    
                                            <option value="<?php echo $combos->fid; ?>" 
                                                <?php 
                                                if (isset($_POST['default_combo_id'])) {
                                                    if ($_POST['default_combo_id'] == $combos->fid) {
                                                        echo 'selected';
                                                    }
                                                }                                                
                                                ?>>
                                                        <?php
                                                        echo $combos->combo_name;
                                                        ?>
                                            </option>
                                            <?php
                                        }
                                        ?>  

                                    </select>
                                    <span class="error">                                        
                                    </span>
                                </div>  

                                <div class="form-group">
                                    <label for="order_number">Order</label>
                                    <input type="number" name="order_number" class="form-control" id="order_number" placeholder="" value="<?php
                                    if (isset($_POST['order_number']) && $_POST['order_number'] != '') {
                                        echo set_value('order_number');
                                    } else {
                                        echo '0';
                                    }
                                    ?>" required />
                                    <span class="error"><?php echo form_error('order_number'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="active_status">Active Status</label><br/>

                                  

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="a" id="active_status1" name="active_status" class="custom-control-input"

                                           <?php
                                           if (isset($_POST['active_status'])) {
                                               if ($_POST['active_status'] == 'a')
                                                   echo 'checked';
                                           }
                                           else {
                                               echo 'checked';
                                           }
                                           ?> />
                                    <label class="custom-control-label" for="active_status1" style="cursor: pointer;">Active</label>
                                </div>


                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="d" id="active_status2" name="active_status" class="custom-control-input"

                                           <?php
                                           if (isset($_POST['active_status'])) {
                                               if ($_POST['active_status'] == 'd')
                                                   echo 'checked';
                                           }
//                                        else {
//                                            echo 'checked';
//                                        }
                                           ?> />
                                    <label class="custom-control-label" for="active_status2" style="cursor: pointer;">Deactive</label>
                                </div>

                                </div>  

                                <div class="form-group">
                                  <input type="hidden" name="parentname" value="0">
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


<script type="text/javascript">
    $(document).ready(function () {
//    alert();
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


        $(".slug_url_val").keyup(function () {
            var string = $(this).val();
            var string = string.replace(/[^a-zA-Z0-9]/g, '-');

            var string = string.replace(/\-+/g, '-');

            var string = string.toLowerCase();

            $(".slug_url_val").val(string.trim());
        });


        $('.parentid').on('change', function () {
            var url_val = $('.parentid option:selected').attr('data-url');
            $('.sa_remain_url_section').html(url_val);
            $('.sa_remain_url_section_input').val(url_val);
        });

    });

</script>