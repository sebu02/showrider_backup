<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">

            <h3>Manage Common Settings</h3>                    

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span12" >

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Common Settings</span>
                        </h4>

                    </div>
                    <div class="content">
                        <form class="form-horizontal " action="<?php echo base_url() . 'optionadmin/user_option_updation'?>" method="post" enctype="multipart/form-data" >
                            
<input type="hidden" name="user_option_updation"  value="1">               
                                

<div class="form-row row-fluid"> 
 
 										<div class="title">
                                            <h4> 
                                                <span>Delivery Charge By Cart Total</span>
                                            </h4>
                                        </div>
                 
                                
    <div class="form-row row-fluid">
        <div class="span12">
            <div class="row-fluid">
                <label class="form-label span4" for="normal">Delivery Charge Minimum Cart Amount</label>
<input class="span8 gl_number_digits_only delivery_charge_minimum_cart_amount" id="delivery_charge_minimum_cart_amount" type="text" name="delivery_charge_minimum_cart_amount" value="<?php echo $option_row->delivery_charge_minimum_cart_amount; ?>" <?php
        if (!empty($option_row->delivery_charge_by_cart_total_status)) {
            if ($option_row->delivery_charge_by_cart_total_status == 'yes') {
                echo 'required';
            }
        } 
        ?> />
            </div>
        </div>
    </div>                                                          
</div> 

<div class="form-row row-fluid">
        <div class="span12">
            <div class="row-fluid">
                <label class="form-label span4" for="normal">Delivery Charge Amount</label>
<input class="span8 gl_number_digits_only delivery_charge_amount_by_cart_total" id="delivery_charge_amount_by_cart_total" type="text" name="delivery_charge_amount_by_cart_total" value="<?php echo $option_row->delivery_charge_amount_by_cart_total; ?>" <?php
        if (!empty($option_row->delivery_charge_by_cart_total_status)) {
            if ($option_row->delivery_charge_by_cart_total_status == 'yes') {
                echo 'required';
            }
        } 
        ?> />
            </div>
        </div>
    </div>                          

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">

                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-info">Submit</button>

                            </div>


                        </form>

                    </div>

                </div><!-- End .box -->

            </div><!-- End .span6 --><!-- End .span6 --><!-- End .span6 -->


        </div><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid -->





    </div><!-- End contentwrapper -->
</div>

<?php
if ($this->session->flashdata('message')) {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            //Regular success

            $.pnotify({
                type: 'success',
                title: '<?php echo $this->session->flashdata('message'); ?>',
                text: '',
                icon: 'picon icon16 iconic-icon-check-alt white',
                opacity: 0.95,
                history: false,
                sticker: false
            });

        });
    </script>
    <?php
}
?> 
