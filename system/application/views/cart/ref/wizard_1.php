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
                    <li><a href="<?php echo base_url() . 'mycart'; ?>">Shopping Cart</a></li>
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
                                <li class="<?php if ($wizard_list_r['wizard_id'] == $this->uri->segment(2)) echo ' active '; ?>"><a  href="<?php echo base_url() . 'wizard/' . $wizard_list_r['wizard_id']; ?>"><?php echo $wizard_list_r['wizard_label']; ?></a></li>
                                <?php
                            }
                        }
                    }else {
                        $wizard_in_use_next_id = 0;
                    }
                    ?>
                </ul>
                <div>
                    <?php
                    $urisegment2 = $this->uri->segment(2);
                    $wizard_current_key = array_search($urisegment2, array_column($wizard_list, 'wizard_id'));
                    $wizard_current = $wizard_list[$wizard_current_key];

                    $wizard_product_list = $this->cart_model->get_wizard_products($wizard_current['wizard_id']);




                    $gl_cart_session = $this->session->userdata('gl_cart');

//                    dump($gl_cart_session);
//                    dump($this->session->userdata('cart_contents'));
                    ?>

                    <div id="" class=""  style="display: block;" >
                        <div class="wrapper-full margin-bottom-25">
                            <h5>PLEASE SELECT A <?php echo $wizard_current['wizard_label']; ?> OPTION FROM THE FOLLOWING:</h5>
                            <div class="wrapper-full margin-bottom-15 ">
                                <div class="table fa-table-theme1">
                                    <?php
                                    foreach ($wizard_product_list as $wizard_product_key => $wizard_product_row) {
                                        ?>

                                        <div class="row1 wizard_option_item gl_addto"  

                                             data-addtype="gl_cart_wizard_1" 
                                             data_wizard_id="<?php echo $wizard_current['wizard_id']; ?>"  
                                             data-flash_type="" 
                                             data-pid="<?php echo $wizard_product_row->id; ?>"  
                                             data_selected_pid="<?php
                                             if (isset($gl_cart_session['wizard_1_product_id']) == TRUE && $gl_cart_session['wizard_1_product_id'] != '') {
                                                 echo $gl_cart_session['wizard_1_product_id'];
                                             } else {
                                                 echo '0';
                                             }
                                             ?>"                                           

                                             <?php
                                             if (isset($gl_cart_session['wizard_1_product_id']) == TRUE && $gl_cart_session['wizard_1_product_id'] != '') {
                                                 if ($gl_cart_session['wizard_1_product_id'] == $wizard_product_row->id) {
                                                     ?>
                                                     style="background-color:#F3F3F3;"
                                                     <?php
                                                 }
                                             }
                                             ?> data-samt="<?php echo $wizard_product_row->prod_price; ?>" >
                                            <div class="column1 fa-border-bottom-right" data-label="">
                                                <input  type="radio" name="service" class="services_div" value="<?php echo $wizard_product_row->id; ?>" 
                                                <?php
                                                if (isset($gl_cart_session['wizard_1_product_id']) == TRUE && $gl_cart_session['wizard_1_product_id'] != '') {
                                                    if ($gl_cart_session['wizard_1_product_id'] == $wizard_product_row->id) {

                                                        echo 'checked="checked"';
                                                    }
                                                }
                                                ?>  />
                                            </div>
                                            <div class="column1 fa-border-bottom-right" data-label="">
                                                <?php echo $wizard_product_row->prod_name; ?>
                                            </div>
                                            <div class="column1 fa-border-bottom-right fa-text-color1" data-label=""> £ <span  class="plan_price"><?php echo number_format($wizard_product_row->prod_price, 3, '.', ','); ?></span> p/m (incl. VAT)</div>
                                        </div>
                                    <?php } ?>
                                    <div class="row1 wizard_option_item gl_addto"  
                                         data-addtype="gl_cart_wizard_1" 
                                         data_wizard_id="<?php echo $wizard_current['wizard_id']; ?>"  
                                         data-flash_type="" 
                                         data-pid="0"  
                                         data_selected_pid="<?php
                                         if (isset($gl_cart_session['wizard_1_product_id']) == TRUE && $gl_cart_session['wizard_1_product_id'] != '') {
                                             echo $gl_cart_session['wizard_1_product_id'];
                                         } else {
                                             echo '0';
                                         }
                                         ?>"
                                         <?php
                                         if (isset($gl_cart_session['wizard_1_product_id']) == TRUE && $gl_cart_session['wizard_1_product_id'] != '') {
                                             
                                         } else {
                                             ?>
                                             style="background-color:#F3F3F3;"
                                             <?php
                                         }
                                         ?>  data-samt="0">
                                        <div class="column1 fa-border-bottom-right" data-label="">
                                            <input  type="radio" name="service" class="services_div"  value="0" <?php
                                            if (isset($gl_cart_session['wizard_1_product_id']) == TRUE && $gl_cart_session['wizard_1_product_id'] != '') {
                                                
                                            } else {
                                                echo 'checked="checked"';
                                            }
                                            ?>/>
                                        </div>
                                        <div class="column1 fa-border-bottom-right" data-label="">
                                            No thanks
                                        </div>
                                        <div class="column1 fa-border-bottom-right fa-text-color1" data-label=""><span class="plan_price"></span></div>
                                    </div>

                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <!--row-->
                        </div>
                    
                        <div class="fa-btm-wrap">
                            <a href="javascript:void(0);" class="btn btn-flat  btn-lg btn-default pull-right button-type-3 sw-btn-next fa-tot-amt bg-color-none  padding-top-bottom-15 no-padding no-border">PRODUCT TOTAL : £ <span 
                                    class="gl_cart_total_only_product_price">0.00<span>/-</a>
                        </div>

                        <div class="fa-btm-wrap">
                            <a href="javascript:void(0);" class="btn btn-flat  btn-lg btn-default pull-right button-type-3 sw-btn-next fa-tot-amt bg-color-none padding-top-bottom-15 no-padding no-border">SERVICE TOTAL : £ <span 
                                    class="gl_total_service_amt"><?php
                                if (isset($gl_cart_session['wizard_1_product_id']) == TRUE && intval($gl_cart_session['wizard_1_product_id']) > 0) {
                                    $this->db->where('id', $gl_cart_session['wizard_1_product_id']);
                                    $prodct = $this->db->get('ec_products')->row();
                                    echo number_format($prodct->prod_price, 2, '.', ',');
                                } else {
                                    echo '0.00';
                                }
                                ?></span>/-</a>
                        </div> 


<?php
$urisegment2 = $this->uri->segment(2);
if (count($wizard_in_use_array) > 0 && end($wizard_in_use_array) == $urisegment2) {
    $wizard_in_use_next_id = 0;
} else if (end($wizard_in_use_array) > $urisegment2) {

    $wizard_in_use_next_id_key = array_search($urisegment2, $wizard_in_use_array) + 1;

    $wizard_in_use_next_id = $wizard_in_use_array[$wizard_in_use_next_id_key];
}
?> 

                        <div class="fa-btm-wrap"> 

                            <a href="<?php echo base_url() . 'wizard/' . $wizard_in_use_next_id; ?>" class="btn btn-flat fa-form-next-btn btn-lg btn-default pull-right button-type-3">Proceed to Next</a>
                            <a href="javascript:void(0);" class="btn btn-flat fa-form-next-btn btn-lg btn-default pull-right button-type-3  fa-tot-amt bg-color-none">
                                SUB TOTAL : £ <span class="gl_total_cart_price"><?php echo number_format($this->cart->total(), 2, '.', ','); ?></span>/-</a>
                        </div>
                    </div>
<?php ?>



                </div>
            </div>
        </div>
    </div>
</div>
<!--row-->











