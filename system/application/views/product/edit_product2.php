
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

                <?php
                $per_page = '';
                if (isset($_GET['per_page'])) {
                    $per_page = '&per_page=' . $_GET['per_page'];
                }
                ?>

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

                            <h4 class="header-title">Edit Service</h4>

                            <a href="<?php echo base_url() . 'ecproductadmin/edit_product?id=' . $product->id . $per_page; ?>"><button type="button" class="btn btn-flat btn-outline-success mb-3">STEP 1</button></a>
                            <a href="javascript:void(0);"><button style="background-color:#28a745;color: #fff;" type="button" class="btn btn-flat btn-outline-success mb-3">STEP 2</button></a>
                            <a href="<?php echo base_url() . 'ecproductadmin/editProducts3?id=' . $product->id . $per_page; ?>"><button type="button" class="btn btn-flat btn-outline-success mb-3">STEP 3</button></a>

                            <div style="height: 30px;"></div>
                            <form  action="<?php echo base_url() . 'ecproductadmin/editProducts2?id=' . $product->id . $per_page; ?>" method="post"  autocomplete="off" >

                                <div class="form-group" style="display:none;">
                                    <label for="product_code">Item Code</label>
                                    <input type="text" name="product_code" class="form-control" id="product_code" placeholder="" value="GLWT-<?php echo $product->id; ?>" readonly />

                                </div>

                                <div class="form-group" style="display:none;">
                                    <label>Home Featured Status</label>

                                    <div class="custom-control custom-checkbox" <?php // echo $this->common_model->admin_or_super_admin(); ?>>
                                        <input type="checkbox" name="featured_status" class="custom-control-input" id="featured_status" value="yes"
                                        <?php
                                           if ($product->featured_products == 'yes'){
                                              echo 'checked';
                                           }
                                        ?> >
                                        <label class="custom-control-label" for="featured_status"  style="cursor: pointer">Yes</label>
                                    </div>

                                </div>

                                <div class="form-group" style="display:none;">
                                    <label>Post Type</label><br/>                                  

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="image" id="post_type1" name="post_type" class="custom-control-input gl_post_type"

                                            <?php
                                            
                                            if ($product->post_type == 'image'){
                                                    echo 'checked';
                                            }                                             
                                            ?> />
                                        <label class="custom-control-label" for="post_type1" style="cursor: pointer;">Image</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" value="video" id="post_type2" name="post_type" class="custom-control-input gl_post_type"

                                            <?php
                                                                                       
                                            if ($product->post_type == 'video') {
                                                echo 'checked';
                                            } 
                                            
                                            ?> />

                                        <label class="custom-control-label" for="post_type2" style="cursor: pointer;">Video</label>
                                    </div>

                                </div>

                                <div class="form-group gl_post_type_div" style="display:none;" <?php // if ($product->post_type == 'image'){ echo 'style="display:none;"'; } ?>>
                                    <label for="fourth_title">Video Link</label>
                                                                        
                                    <input type="url" name="fourth_title" class="form-control" id="fourth_title" value="<?php echo $product->fourth_title; ?>" />

                                </div>
                                
                                <div class="form-group" style="display:none;">
                                    <label for="original_price">Original Price</label>
                                    <input type="text" name="original_price" class="form-control" id="original_price" placeholder="" value="<?php echo $product->original_price; ?>" />

                                </div>
                                
                                <div class="form-group" style="display:none;">
                                    <label for="selling_price">Selling Price</label>
                                    <input type="text" name="selling_price" class="form-control" id="selling_price" placeholder="" value="<?php echo $product->selling_price; ?>" />

                                </div>                                
                                <?php 
                                $title_header = json_decode($product->product_title_json, TRUE);
                                $second_header = json_decode($product->second_title_json, TRUE);
                                $third_header = json_decode($product->third_title_json, TRUE);
                                $fourth_header = json_decode($product->fourth_title_json, TRUE);  
                                
                                ?>
                                 <?php   ?>
                                <div class="form-group">
                                    <label for="title">First Title</label>
                                    
                                        <input type="text" name="title" class="form-control" id="title" value="<?php echo $product->product_title; ?>" />                                                                           

                                </div>

                                <div class="form-group">
                                    <label for="second_title">Second Title</label>                                      

                                    <input type="text" name="second_title" class="form-control" id="second_title" value="<?php echo $product->second_title; ?>" />
                                    
                                </div>

                                <div class="form-group">

                                    <label for="third_title">Third Title</label>                                  

                                        <input type="text" name="third_title" class="form-control" id="third_title" value="<?php echo $product->third_title; ?>" />
                                  
                                </div>                               
                               
                                <div class="form-group" style="display:none;">
                                    <label>Quote Title</label>

                                    <?php /* ?><input type="text" name="quote_title" class="form-control" id="quote_title" placeholder="" value="<?php echo $product->quote_title; ?>" /><?php /**/ ?>

                                    <?php
                                     $quote_title_array = json_decode($product->quote_title_json,TRUE);
                                     $quote_tag = "";
                                     $quote_title = "";

                                     if(!empty($quote_title_array)){
                                        $quote_tag = $quote_title_array['tag'];
                                        $quote_title = $quote_title_array['text'];
                                     }

                                     $tags_array = array("h2" => "H2" , "h3" => "H3" , "h4" => "H4" , "h5" => "H5" , "h6" => "H6");
                                    ?>

                                    <div class="input-group mb-3">
                                        <select class="custom-select gl_select_style" name="quote_tag" style="cursor: pointer;height:45px;">&nbsp;&nbsp;


                                                <!-- <option value="">--select tag--</option>      -->
                                                
                                                
                                                <?php
                                                foreach($tags_array as $tags_key => $tags_val){                                                    
                                                ?>
                                                <option value="<?php echo $tags_key; ?>" <?php if($tags_key == $quote_tag){ echo "selected"; } ?>><?php echo $tags_val; ?></option>
                                                <?php
                                                }
                                                ?>                                                
                                        </select>                                        
                                        <input type="text" class="form-control"  name="quote_title" style="width:60%;" placeholder="Quote..." value="<?php echo $quote_title; ?>">   
                                    </div>         

                                </div>

                                <div class="form-group" style="display:none;">
                                    <label for="fourth_title">Quote Description</label>
                                    <textarea  name="quote_description" class="form-control" id="quote_description" placeholder=""><?php echo $product->quote_description; ?></textarea>

                                </div>                                                         
                                <div class="form-group" style="display:none;">
                                    <label for="wedding_date">Wedding Date</label>
                                    <input type="date" name="wedding_date" class="form-control" id="wedding_date" placeholder="" value="<?php echo date('Y-m-d', strtotime($product->wedding_date));?>" />

                                </div>                           
                                                                                                 
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                  
                                    <div class="input-group mb-3">

                                        <textarea rows="4" name="short_description" id="editor1" class="form-control" placeholder="" aria-label=""><?php echo $product->prod_short_description; ?></textarea>
                                    </div>

                                </div> 

                                <div class="form-group">
                                    <label for="brief_description">Brief Description</label>
                            

                                    <div class="input-group mb-3">

                                        <textarea rows="5" name="brief_description" id="editor" class="form-control" placeholder="" aria-label=""><?php echo $product->prod_brief_description; ?></textarea>
                                    </div>

                                </div>
                                <div class="form-group" style="display:none;">
                                    <label for="customlink">Custom Link</label>
                                 
                                
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
                                    <label class="custom-control-label" for="customlink1" style="cursor: pointer;">Internal</label>
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
                                    <label class="custom-control-label" for="customlink2" style="cursor: pointer;">External</label>
                                </div>
                                
                                <div class="form-group"></div>
                                <?php $target_array = array('_self' => 'current tab', '_blank' => 'new tab'); ?>
                                
                                <div class="form-group slug_area" <?php
                                    /**/ if (isset($custom_link_array['type2'])){
                                            if($custom_link_array['type2'] == 'slug') {
//                                                echo "style='display:block;'";
                                            } else {
//                                                echo "style='display:none;'";
                                            }
                                         }
                                            /**/
                                         ?> style="display: none;">
                                    <p id="" class="form-text text-muted">
                                        <span style="font-size:13px;" class=""><?php echo base_url(); ?></span>
                                    </p>

                                    <input type="text" name="custom_slug" value="<?php
                                                   /**/ if (isset($custom_link_array['type3']) &&
                                                                $custom_link_array['type2'] == 'slug') {
                                                            echo $custom_link_array['type3'];
                                                        }/**/
                                                    ?>" class="form-control slug" id="custom_slug" placeholder="" />

                                </div>
                                
                                <div class="form-group url_area" <?php
                           /**/ if (isset($custom_link_array['link_type']) &&
                                    $custom_link_array['link_type'] == 'external') {
//                                        echo "style='display:block;'";
                                    } else {/**/
//                                        echo "style='display:none;'";
                                    }
                                    ?> style="display: none;">

                                    <input type="url" name="url" value="<?php
                                                 /**/   if (isset($custom_link_array['type3']) &&
                                                           $custom_link_array['type2'] == 'link') {
                                                            echo $custom_link_array['type3'];
                                                        }/**/
                                                        ?>" class="form-control url_text" id="url" placeholder="" />

                                </div>
                                
                                <div class="form-group">
                                    <select class="custom-select" name="target_type" style="cursor: pointer;">
                                        <option value="_self">--view type--</option>
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
                            </div>

                                <div class="form-group" style="display:none;">
                                    <label for="icon_class">Icon Class</label>
                                    <input type="text" name="icon_class" class="form-control" id="icon_class" value="<?php echo $product->iconClass; ?>" />
                                </div> 

                                <div id="dynamic_field" style="display:none;">
                                <?php 
                                $i=0; 
                                $extra_link_array = json_decode($product->extra_seo_links, TRUE);
                                if ($extra_link_array == NULL) { $i++; ?>  
                                
                                       
                                            <div class="form-group">
                                            <label>SEO Details <?php // echo $i ?></label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="seotitle[]" style="width:40%;" placeholder="SEO Title-<?php echo $i; ?>">&nbsp;&nbsp;
                                                <input type="url" class="form-control"  name="seolink[]" style="width:40%;" placeholder="SEO Link-<?php echo $i; ?>">
                                            </div>
                                            </div>                                                                                                                           
                                    
                                            <?php
                                        }
                                    
                                         else { ?>                                    
                                         <?php   
                                          foreach ($extra_link_array as $media_key => $media_val) { 
                                            $i++; 
                                            ?> 
                                           
                                           <div id="row<?php echo $i ?>">
                                                <div class="form-group">
                                                <?php if($i == 1){ ?><label>SEO Details </label><?php } ?>
                                                        <div class="input-group mb-2">
                                                            <input type="text" value="<?php echo $media_key ?>" style="width:40%;" class="form-control" placeholder="SEO Title-<?php echo $i; ?>" name="seotitle[]" >&nbsp;&nbsp;
                                                            <input type="url" value="<?php echo $media_val ?>" style="width:40%;" class="form-control" placeholder="SEO Link-<?php echo $i; ?>"  name="seolink[]" >
                                                        </div>

                                                        <?php if($i > 1){ ?>
                                                      <a href="javascript:void(0)" name="remove" id="<?php echo $i ?>" style="color:red;font-size:13px;" class="btn_remove pull-right mb-3">Remove</a>
                                                    <?php } ?>

                                                </div>                                                                                                                                              

                                            </div>
                                            
                                                                                 
                                          <?php 
                                          }
                                        } 
                                        ?>
                                    

                                    <input type="hidden" class="form-control" id="linkcount" name="linkcount" value="<?php echo $i ?>" >     
                                    
                                </div>

                                <div class="form-group mb-3" style="display:none;">        
                                    <!-- <div class="col-sm-offset-2 col-sm-10"> -->
                                        <a href="javascript:void(0)" name="add" id="add" class="" style="font-size:13px;">Add More</a>
                                    <!-- </div> -->
                                </div>                               

                                <input type="hidden" name="final_images">

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
        //var i=1;  
       var i= $("#linkcount").val();
      
        $('#add').click(function(){  
           i++;             
           $('#dynamic_field').append('<div id="row'+i+'"><div class="form-group"><div class="input-group mb-2"><input type="text" class="form-control"  name="seotitle[]" placeholder="SEO Title-'+i+'" style="width:40%;">&nbsp;&nbsp;<input type="url" class="form-control" name="seolink[]" placeholder="SEO Link-'+i+'" style="width:40%;"></div><a href="javascript:void(0)" name="remove" id="'+i+'" class="btn_remove pull-right mb-3" style="color:red;font-size:13px;">Remove</a></div></div>');
         });
         $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id"); 
           var res = confirm('Do you want to remove this?');
           if(res==true){
           $('#row'+button_id+'').remove();  
           $('#'+button_id+'').remove();  
           }
      }); 
    });

</script>

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

<script type="text/javascript">
$("body").on("change" , ".gl_post_type" , function(){
  var cur_type = $(this).val();

  /* if(cur_type == "video"){
     $(".gl_post_type_div").show();
  }else{
     $(".gl_post_type_div").hide();
  } /**/

});
</script>