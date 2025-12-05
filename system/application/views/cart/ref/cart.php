
<section id="hey-day-section">
    <div class="wrapper-full bg-hd ">
        <div class="container">
            <div class="row">
                <?php
                $gl_cart_session = $this->session->userdata('gl_cart');
                $ci_cart_items = $this->cart->contents();
                if ($ci_cart_items != NULL):
                    ?>
                    <div class="col-md-8">
                        <div class="wrapper-full cart-wrpr-hd margin-top-bottom-30">
                            <div class="row">

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="cart-hd">
                                        <h3 class="cart-head-hd padding-bottom-20 padding-top-10 f-family-montserat-size-12">My Cart (<span class="gl_cart_count"><?php echo $this->index_model->totalcartcount(); ?></span>)</h3>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <?php
                                    /* For Selecting all values of ec_categorytypes to an array to search in the loop according to the id */
                                    $item_product_type_list = $this->db->select('id, name')->get('ec_categorytypes')->result_array();
                                    ?>
                                    <?php
                                    if ($ci_cart_items != NULL) {
//                                        dump($ci_cart_items);

                                        foreach ($ci_cart_items as $item) {
                                            $data['item'] = $item;

                                            $pro_id = $item['pid'];

                                            if ($item['ptype'] == '3') {


                                                $data['product_details'] = $this->index_model->GetByRow('ec_products', $item['pid'], 'id');
                                                $data['prod_img'] = json_decode($data['product_details']->prod_file, TRUE);



                                                /* To find the name according to id from `ec_categorytypes` result array
                                                 * which was previously assigned to variable $item_product_type_list.  */

                                                $key = array_search($item['ptype'], array_column($item_product_type_list, 'id'));
                                                $item_product_type_name = $item_product_type_list[$key]['name'];

                                                if ($data['product_details']->qty > 0) {

                                                    $data['cart_item_row'] = $this->index_model->cart_color_price_common($item['ec_cart_item_id']);
                                                    $data['price_split'] = json_decode($data['cart_item_row']->gl_hd_total_price_slab, TRUE);
                                                    ?>



                                                    <?php
                                                    if ($data['cart_item_row']->gl_personalised == 'yes') {

                                                        $this->load->view('index/mycart_personalized', $data);
                                                    } else {

                                                        $this->load->view('index/mycart_themewise', $data);
                                                    }
                                                    ?>                              

                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>


                                    <div class="wrapper-full bottom-abs-hd">
                                        <div class="cart-button-fullwrapper wrapper-full f-family-montserat-size-12">
                                            <a href="<?php echo base_url(); ?>" class="cart-summery-btn cart-btn-clr-hd btn btn-primary f-family-montserat-size-12 pull-left"> Continue Shopping </a>
                                            <a href="<?php echo base_url() . 'checkout'; ?>" class="cart-summery-btn cart-btn-clr-hd2 btn btn-primary f-family-montserat-size-12 pull-right"> Place Order </a>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">

                        <div class="wrapper-full">


                            <div class="cart-right-fulwrpr"> 
                                <div class="wrapper-full cart-wrpr-hd margin-top-30 ">

                                    <ul>

                                        <li class="cart-hd padding-bottom-30 f-family-montserat-size-12 cart-right-section">Price Details</li>
                                        <li class="padding-bottom-30 f-family-montserat-size-12 cart-right-section">Price (<span class="gl_cart_count"><?php echo $this->index_model->totalcartcount(); ?></span> item)
                                            <span class="float-right"><i class="fa fa-inr" aria-hidden="true"></i> <span class="gl_cart_total_only_product_price"></span>/-</span>
                                        </li>
                                        <li class="padding-bottom-30 f-family-montserat-size-12 cart-right-section gl_delivery_cart_container">Delivery Charges
                                            <span class="float-right"><i class="fa fa-inr" aria-hidden="true"></i> <span class="gl_delivery_cart_price"></span>/-</span>
                                        </li><?php ?>
                                        <li class="padding-bottom-30 f-family-montserat-size-12 cart-right-section cart-border-dot font-weight-bold">Grand Total
                                            <span class="float-right font-weight-bold"><i class="fa fa-inr" aria-hidden="true"></i> <span class="gl_total_cart_price"></span>/-</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class=" f-family-montserat-size-12 cart-right-btn margin-bottom-30">

                                <a href="<?php echo base_url() . 'checkout'; ?>" class="cart-right-btn cart-summery-btn cart-btn-clr-hd2 btn btn-primary btn_submit_step_3">Place Order</a>
                            </div>

                            </form>

                        </div>
                    </div>
<?php else:
    ?>
                    <div class="col-md-12">
                        <div class="wrapper-full cart-wrpr-hd margin-top-bottom-30">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="cart-hd">
                                        <h3 class="cart-head-hd padding-bottom-20 padding-top-10 f-family-montserat-size-12">My Cart</h3>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="cart-bln-hd">
                                        <div class=" wrapper-full padding-bottom-20 border-bottom-gray margin-bottom-10 text-align-center">


                                            <img src="<?php echo base_url() . 'static/frontend/'; ?>images/no_items_image.jpg">

                                        </div> <!--section--> 




                                        <!--main-->


                                    </div>




                                    <div class="wrapper-full bottom-abs-hd">
                                        <div class="cart-button-fullwrapper f-family-montserat-size-12 mycart-btn-no-item">
                                            <a href="<?php echo base_url(); ?>" class="cart-summery-btn cart-btn-clr-hd btn btn-primary f-family-montserat-size-12"> Continue Shopping </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

<?php endif;
?>
            </div>

            </section>
            
            <footer>
                <div class="wrapper-full footer-menu-bg-hd">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            