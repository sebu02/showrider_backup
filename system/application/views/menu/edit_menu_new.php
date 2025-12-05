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
                <h4 class="page-title pull-left">Manage Menu</h4>

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

                            <h4 class="header-title">Edit Menu</h4>

                            <div style="height: 30px;"></div>
                            <form class="multiple_upload_form" id="gl_current_image_upload_form_id" action="<?php echo base_url() . 'appearanceadmin/edit_menu/' . $id; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                                <?php
                                $current_menu_type_tree = $cat->menu_type_tree;
                                ?>
                                
                                <div class="form-group">
                                    <label class="col-form-label">Type<a style="color:#F00; font-size:12px;">*</a></label>
                                    <select class="custom-select search_select" name="menu_type" required style="cursor: pointer">
                                        <option selected value="" data-url="">--select--</option>

                                        <?php
//                                        $i = 0;
                                        foreach ($menu_type_result as $menu_type) {
                                            ?>    
                                            <option data-url="" value="<?php echo $menu_type->id; ?>" <?php
                                            if (!empty($current_menu_type_tree)) {
                                                if ($menu_type->id == $current_menu_type_tree) {
                                                    echo 'selected="selected"';
                                                }
                                            }
                                            ?>
                                                    data-ctype="">
                                                        <?php
                                                        echo $menu_type->category;
                                                        ?></option>
                                            <?php
                                        }
                                        ?>    

                                    </select>
                                    <span class="error">
                                        <?php echo form_error('menu_type'); ?>
                                    </span>
                                </div>

                                <div class="form-group" <?php // echo $this->common_model->admin_or_super_admin(); ?>>
                                    <label class="col-form-label">Parent<a style="color:#F00; font-size:12px;">*</a></label>
                                    <select class="custom-select parentid search_select" name="parentid" required style="cursor: pointer">
                                        <option selected value="0" data-url="">--parent--</option>

                                        <?php
                                        $i = 0;
                                        foreach ($categorylist as $sub) {
                                            ?>    
                                            <option data-url="<?php echo $this->menu_model->arr_reverse($sub['categoryslugtree']); ?>" value="<?php echo $sub['id']; ?>" <?php
                                            if (!empty($cat->parent_id)) {
                                                if ($sub['id'] == $cat->parent_id) {
                                                    echo 'selected="selected"';
                                                }
                                            }
                                            /**/
                                            if ($sub['id'] == $id) {
                                                echo "disabled";
                                            } /**/
                                            ?>
                                                    data-ctype="">
                                                        <?php
                                                        echo $sub['name'];
                                                        ?></option>
                                            <?php
                                        }
                                        ?>    

                                    </select>
                                    <span class="error">
                                        <?php echo form_error('parentid'); ?>
                                    </span>
                                </div>

                                <?php /**/ ?><div class="form-group">
                                    <label for="menuname">Name<a style="color:#F00; font-size:12px;">*</a></label>
                                    <input type="text" name="menuname" class="form-control slug_ref" id="menuname" placeholder="" value="<?php echo $cat->category; ?>" required />
                                    
                                    <span class="error">
                                        <?php echo form_error('menuname'); ?>
                                    </span>
                                </div><?php /**/ ?>

                                <div class="form-group" <?php // echo $this->common_model->admin_or_super_admin(); ?>>
                                    <label>Status</label>
                                
                                    <div class="custom-control custom-checkbox" <?php echo $this->common_model->admin_or_super_admin(); ?>>
                                        <input type="checkbox" name="home_menu_status" class="custom-control-input" id="home_menu_status" value="yes"
                                               <?php if (!empty($cat->home_menu_status)) {
                                                    if ($cat->home_menu_status == 'yes') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                        <label class="custom-control-label" for="home_menu_status"  style="cursor: pointer">Home Menu</label>
                                    </div>
                                    
                                <!--<div class="form-group"></div>-->

                                    <div class="custom-control custom-checkbox" <?php // echo $this->common_model->admin_or_super_admin(); ?>>
                                        <input type="checkbox" name="sub_menu_status" class="custom-control-input" id="sub_menu_status" value="yes"
                                                    <?php if (!empty($cat->sub_menu_status)) {
                                                         if ($cat->sub_menu_status == 'yes') {
                                                                 echo 'checked';
                                                             }
                                                    } ?>>
                                        <label class="custom-control-label" for="sub_menu_status"  style="cursor: pointer">Has Sub Menu</label>
                                    </div>
                                
                                </div>
                                
                                <?php
                                    $custom_link_array = json_decode($cat->custom_link, TRUE);
                                    $link_type = $custom_link_array['link_type'];
                                    $link_text = $custom_link_array['link_text'];
                                    $target_type = $custom_link_array['target_type'];
                                    $type3 = $custom_link_array['type3'];
                                ?>

                                <div class="form-group">
                                    <label for="customlink">Custom Link</label><br/>
                                    
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="internal" id="customlink1" name="customlink" class="custom-control-input gl_customlink_type"

                                            <?php
                                            if (isset($custom_link_array['link_type'])){
                                                  if($custom_link_array['link_type'] == 'internal'){
                                                      echo ' checked';
                                                  }
                                            }else {
                                                echo ' checked';
                                            }
                                            ?> />
                                        <label class="custom-control-label" for="customlink1" style="cursor: pointer">Internal</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="external" id="customlink2" name="customlink" class="custom-control-input gl_customlink_type"

                                               <?php
                                               if (isset($custom_link_array['link_type'])) {
                                                   if ($custom_link_array['link_type'] == 'external'){
                                                       echo 'checked';
                                                   }    
                                               }
                                               ?> />
                                        <label class="custom-control-label" for="customlink2" style="cursor: pointer">External</label>
                                    </div>

                                    <div class="form-group"></div>
                                    <?php $target_array = array('_self' => 'current tab', '_blank' => 'new tab'); ?>


                                    <div class="form-group slug_area" <?php
                                        /**/ if (isset($custom_link_array['type2'])){
                                                if($custom_link_array['type2'] == 'slug') {
                                                    echo "style='display:block;'";
                                                } else {
                                                    echo "style='display:none;'";
                                                }
                                             }
                                                /**/
                                        ?>>
                                        <p id="" class="form-text text-muted">
                                            <span style="font-size:13px;" class=""><?php echo base_url(); ?></span>
                                        </p>

                                        <input type="text" name="slug" value="<?php
                                                       /**/ if (isset($custom_link_array['type3']) &&
                                                                    $custom_link_array['type2'] == 'slug') {
                                                                echo $custom_link_array['type3'];
                                                            }/**/
                                                        ?>" class="form-control slug" id="slug" placeholder="" />

                                    </div>

                                    <div class="form-group url_area" <?php
                               /**/ if (isset($custom_link_array['link_type']) &&
                                        $custom_link_array['link_type'] == 'external') {
                                            echo "style='display:block;'";
                                        } else {/**/
                                            echo "style='display:none;'";
                                        }
                                        ?>>

                                        <input type="url" name="url" value="<?php
                                                     /**/   if (isset($custom_link_array['type3']) &&
                                                               $custom_link_array['type2'] == 'link') {
                                                                echo $custom_link_array['type3'];
                                                            }/**/
                                                            ?>" class="form-control url_text" id="url" placeholder="" />

                                    </div>

                                    <div class="form-group">
                                        <select class="custom-select" name="target_type" style="cursor: pointer">
                                            <option value="_self">--target type--</option>
                                            <?php
                                            if ($target_array != NULL) {
                                                foreach ($target_array as $target_key => $targettype) {
                                                    ?>

                                                    <option value="<?php echo $target_key; ?>"
                                                            <?php /**/ if ($target_type == $target_key) {
                                                                echo "selected";
                                                            } /**/ ?>><?php echo $targettype; ?></option>

                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <input type="hidden" name="linktxt" value="">
                                    <input type="hidden" name="fixed_link_status" value="no">
                                
                                </div>

                                <div class="form-group" <?php echo $this->common_model->admin_or_super_admin(); ?>>
                                    <label for="icon_class">Icon Class</label> 
                                    <input type="text" name="icon_class" class="form-control" id="icon_class" placeholder="" value="<?php
                                                        echo $cat->iconClass;
                                                        ?>" /> 
                                </div>

                                <div class="form-group" <?php echo $this->common_model->admin_or_super_admin(); ?>>
                                    <label for="attribute">Attribute</label> 
                                    <input type="text" name="attribute" class="form-control" id="attribute" placeholder="" value="<?php
                                                        echo $cat->attribute;
                                                        ?>" /> 
                                </div>

                                <?php /**/ ?><div class="form-group">
                                    <label for="order_number">Order</label>
                                    <input type="number" name="order_number" class="form-control" id="order_number" placeholder="" value="<?php
                                        if (isset($cat->order_no)) {
                                            echo $cat->order_no;
                                        } else {

                                            echo '0';
                                        }
                                        ?>" required />
                                    <span class="error"><?php echo form_error('order_number'); ?></span>
                                </div><?php /**/ ?>

                                <div class="form-group">
                                    <label for="active_status">Active Status</label><br/>                               

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="a" id="active_status1" name="active_status" class="custom-control-input"

                                               <?php
                                               if ($cat->active_status == 'a') {
                                                        echo 'checked';
                                                    }
                                               ?> />
                                        <label class="custom-control-label" for="active_status1" style="cursor: pointer">Active</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="d" id="active_status2" name="active_status" class="custom-control-input"

                                               <?php
                                               if ($cat->active_status == 'd') {
                                                        echo 'checked';
                                                    }
                                               ?> />
                                        <label class="custom-control-label" for="active_status2" style="cursor: pointer">Deactive</label>
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
    $("body").on("change", ".gl_customlink_type", function () {
        var cust_val = $(this).val();
        if (cust_val == 'internal') {
            $(".slug_area").show();
            $(".url_area").hide();
        } else {
            $(".slug_area").hide();
            $(".url_area").show();
        }
    });
</script>