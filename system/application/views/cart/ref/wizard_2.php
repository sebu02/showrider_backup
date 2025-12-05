<!--banner section-->
<div class="wrapper-full margin-bottom-25 fa-banner-in1">
    <div class="fa-banner-in1-bg margin-bottom-15">
        <div class="container">
            <div class="row">
                <div class="col-md-12 no-padding res-padding-left-right">
                    <h2 class="fa-banner-in-head-h2 fontweight-bold color-white margin-bottom-0 margin-top-15">My cart  </h2>
                    <span class="fa-banner-in1-menu"> <a href="<?php echo base_url(); ?>" class="color-white">Home </a> &gt; My cart</span>
                </div>
            </div>
            <!--row-->
        </div>
        <!--container-->
    </div>
</div>
<!--end -->
<div class="container">
    <div class="row">
        <div class="wrapper-full margin-bottom-50 res-padding-left-right">
            <!-- Smart Wizard html -->
               <div id="smartwizard" class="sw-main sw-theme-">
                <ul class="fa-tab-link-list margin-bottom-25 nav nav-tabs step-anchor">
                    <li><a href="<?php echo base_url().'mycart';?>">Shopping Cart</a></li>
                     <?php
                    $wizard_in_use_array = explode('+', $option->wizard_id_in_use);
                    $wizard_in_use_array = array_filter($wizard_in_use_array, 'is_numeric');
                    if (count($wizard_in_use_array) > 0) {
                        
                        $wizard_in_use_array_sort = asort($wizard_in_use_array, TRUE);
                        $imp_wizard_in_use_array = implode("+", $wizard_in_use_array);
                        $wizard_in_use_array = explode('+', $imp_wizard_in_use_array);

                        $wizard_list = json_decode($option->wizard_options, TRUE);
                        $wizard_in_use_next_id = $wizard_in_use_array[0];

                        foreach ($wizard_list as $wizard_list_r_key => $wizard_list_r) {
                            if (in_array($wizard_list_r['wizard_id'], $wizard_in_use_array)) {
                                ?>
                                 <li class="<?php if($wizard_list_r['wizard_id']==$this->uri->segment(2))echo ' active '; ?>"><a  href="<?php echo base_url().'wizard/'.$wizard_list_r['wizard_id']; ?>"><?php echo $wizard_list_r['wizard_label']; ?></a></li>
                            <?php
                            }
                        }
                    }else{
                        $wizard_in_use_next_id = 0;
                    }
                    ?>
                </ul>
                <div>
                    <?php
                    $ci_cart_items = $this->cart->contents();
//                     print_r($ci_cart_items);
                    if ($ci_cart_items != NULL):

                        /* For Selecting all values of ec_categorytypes to an array to search in the loop according to the id */
                        $item_product_type_list = $this->db->select('id, name')->get('ec_categorytypes')->result_array();
                        ?>
                        <?php
                     
                        $urisegment2 =$this->uri->segment(2);
                        $wizard_current_key = array_search($urisegment2, array_column($wizard_list, 'wizard_id'));
                        $wizard_current = $wizard_list[$wizard_current_key];
                                ?>
                                <div id="" class=""  style="display: block;" >
                                    <div class="wrapper-full margin-bottom-25">
                                        <h5>PLEASE SELECT A <?php echo $wizard_current['wizard_label']; ?> OPTION FROM THE FOLLOWING:</h5>
                                     
                                        
                                        <!--row-->
                                    </div>
                                    
                                     <div class="fa-btm-wrap"> 
                                     <?php 
                                    $urisegment2 = $this->uri->segment(2);
                                    if(count($wizard_in_use_array) > 0 &&  end($wizard_in_use_array) == $urisegment2){
                                        
                                        $wizard_in_use_next_id=0;
                                        
                                    }else if(end($wizard_in_use_array) > $urisegment2){
                                        
                                        $wizard_in_use_next_id_key = array_search($urisegment2,$wizard_in_use_array)+1;
                                        $wizard_in_use_next_id = $wizard_in_use_array[$wizard_in_use_next_id_key];
                                  
                                    }
                                    ?>               
                                <a href="<?php echo base_url() . 'wizard/'.$wizard_in_use_next_id; ?>" class="btn btn-flat fa-form-next-btn btn-lg btn-default pull-right button-type-3">Proceed to Next</a>
                                <a href="javascript:void(0);" class="btn btn-flat fa-form-next-btn btn-lg btn-default pull-right button-type-3  fa-tot-amt bg-color-none">
                                    SUB TOTAL : £ <span class="gl_total_cart_price"><?php echo number_format($this->cart->total(), 2, '.', ','); ?></span>/-</a>
                            </div>
                                </div>
                            <?php 
                         ?>

                        <?php
                    else:
                        echo '<span class="ss_no_itmsdis_wrapper"><img src="' . base_url() . 'static/frontend/images/no_items_image.jpg"></span>';
                    endif;
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--row-->











