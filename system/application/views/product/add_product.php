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
                            <h4 class="header-title">Add Service</h4>
                            <a href="javascript:void(0);"><button style="background-color:#28a745;color: #fff;" type="button" class="btn btn-flat btn-outline-success mb-3">STEP 1</button></a>
                            <a href="javascript:void(0);"><button type="button" class="btn btn-flat btn-outline-success mb-3">STEP 2</button></a>
                            <a href="javascript:void(0);"><button type="button" class="btn btn-flat btn-outline-success mb-3">STEP 3</button></a>

                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" action="<?php echo base_url() . 'ecproductadmin/add_product?' . $_SERVER['QUERY_STRING']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                                <input type="hidden"  name="product_type2" value="<?php echo $product_type_product[0]->id; ?>"> 
                                                            
                                <div class="form-group" style="display:none;">
                                    <label>Category</label>
                                
                                    <?php
                                    $condition_array = array(
                                          "parent_id" => 11  
                                    );        

                                    $sub_menu_list = $this->common_model->GetByResult_Where("cms_menu", "order_no", "asc", $condition_array); 
                                                                       
                                    if($sub_menu_list != NULL){
                                        foreach($sub_menu_list as $sub_menu_key => $sub_menu_row){                                                                               
                                    ?>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="parent_sub_menu[]" class="custom-control-input" id="parent_sub_menu_<?php echo $sub_menu_key; ?>" value="<?php echo $sub_menu_row->id; ?>">
                                            <label class="custom-control-label" for="parent_sub_menu_<?php echo $sub_menu_key; ?>"  style="cursor: pointer"><?php echo $sub_menu_row->category; ?></label>
                                        </div>

                                    <?php
                                        }
                                    }
                                    ?>
                                                                    
                                </div>

                                <?php /* ?><div class="form-group">
                                    <label for="featured_status">Featured Status</label><br/>                                  

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="yes" id="featured_status1" name="featured_status" class="custom-control-input gl_featured_status"

                                            <?php
                                            if (isset($_POST['featured_status'])) {
                                                if ($_POST['featured_status'] == 'yes')
                                                    echo 'checked';
                                            }                                             
                                            ?> />
                                        <label class="custom-control-label" for="featured_status1" style="cursor: pointer;">Yes</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="no" id="featured_status2" name="featured_status" class="custom-control-input gl_featured_status"

                                            <?php
                                            if (isset($_POST['featured_status'])) {
                                                if ($_POST['featured_status'] == 'no')
                                                    echo 'checked';
                                            }else {
                                                echo 'checked';
                                            } 
                                            ?> />

                                        <label class="custom-control-label" for="featured_status2" style="cursor: pointer;">No</label>
                                    </div>

                                </div><?php /**/ ?>

                                <input type="hidden" name="featured_status" id="gl_featured_status_hidden" value="no">                               

                                <div class="form-group" style="display:none;">
                                    <label>Special Types</label>

                                    <?php 

                                    $featured_types_list = array(                                                                                
                                        "hot_this_week" => "hot this week",                                       
                                        "past_stories" => "past stories",
                                        "must_read" => "must read",
                                        "recent_article" => "recent article",
                                        "trending_now" => "trending now"
                                    );
                                    
                                        foreach($featured_types_list as $featured_type_key => $featured_type_val){ 

                                    ?>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="featured_types_list[]" class="custom-control-input" id="featured_types_list<?php echo $featured_type_key; ?>" value="<?php echo $featured_type_key; ?>">
                                                <label class="custom-control-label" for="featured_types_list<?php echo $featured_type_key; ?>"  style="cursor: pointer"><?php echo ucfirst($featured_type_val); ?></label>
                                            </div>

                                    <?php
                                        }
                                    ?>

                                </div>

                                <div class="form-group gl_featured_type_div">
                                    <label class="col-form-label">Category<a style="color:#F00; font-size:12px;">*</a></label>
                                    <select class="custom-select parentid search_select" name="cat" required style="cursor: pointer;">

                                        <option selected data-url="" value="">--select--</option>

                                        <?php
                                        foreach ($categorylist as $cat) {
                                            $check_child_exist = $this->product_model->checkChildCatExists($cat['id']);
                                            ?>    
                                            <option data-url="<?php echo $this->product_model->arr_reverse($cat['categoryslugtree']); ?>" value="<?php echo $cat['id']; ?>"
                                                    data-ctype="<?php echo $cat['ctype']; ?>"
                                                    <?php if($cat['id'] == 11){ echo "selected"; } ?>
                                                    <?php if ($check_child_exist > 0) {
                                                                echo "disabled";
                                                            } ?>><?php
                                                        echo ucfirst($cat['name']);
                                                        ?></option>
                                            <?php
                                        }
                                        ?>  

                                    </select>
                                    <span class="error">
                                        <?php echo form_error('cat'); ?>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="product_display_name">Name<a style="color:#F00; font-size:12px;">*</a></label>
                                    <input type="text" name="product_display_name" class="form-control slug_ref gl_prod_same gl_disp_prod" id="product_display_name" value="<?php echo set_value('product_display_name'); ?>" required>

                                    <span class="error">
                                        <?php echo form_error('product_display_name'); ?>
                                    </span>
                                    
                                </div>
                                
                                <input type="hidden" name="url_type" value="seo_url">
                                <input type="hidden" name="sku_in_url" value="no">                                
                                <input type="hidden" name="product_name" value="<?php // echo $product_sku; ?>">

                                <div class="form-group">
                                    <label for="exampleInputPassword1">SEO Friendly URL<a style="color:#F00; font-size:12px;">*</a></label>
                                    <p id="" class="form-text text-muted">

                                        <span style="font-size:13px;" class="sa_base_url_section"><?php echo base_url(); ?></span>
                                        <span style="font-size:13px;" class="sa_remain_url_section"></span>

                                    </p>

                                    <input type="text" name="slug" value="<?php echo set_value('slug'); ?>" required class="form-control slug_url_val" readonly id="slug" />

                                    <span class="error">
                                        <?php echo form_error('slug'); ?>
                                    </span>

                                    <input type="hidden" name="full_url_sec" class="sa_remain_url_section_input">

                                </div> 
                                                              
                                
                                <div class="form-group" style="display:none;" <?php // echo $this->common_model->admin_or_super_admin(); ?>>
                                    <label for="sku">SKU Code</label>
                                    <input type="text" name="sku" class="form-control" id="sku" value="<?php  echo $product_sku; ?>" readonly>

                                    <span class="error">
                                        <?php // echo form_error('sku'); ?>
                                    </span>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="order_number">Order</label>
                                    <input type="number" name="order_number" class="form-control" id="order_number" value="<?php
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

<script type="text/javascript">
    $(document).ready(function () {

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

<script type="text/javascript">
$("body").on("change" , ".gl_featured_status" , function(){
  var cur_status = $(this).val();

//   if(cur_status == "yes"){
//      $(".gl_featured_type_div").show();
//   }else{
//      $(".gl_featured_type_div").hide();
//   }

});
</script> 

<script type="text/javascript">
$('.parentid').on('change', function () {
    var cur_cat = $(this).val();

    if(cur_cat == 11){
    
       $("#gl_featured_status_hidden").val("no");
    }else{
        $("#gl_featured_status_hidden").val("yes");
    }

});
</script> 