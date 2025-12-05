
<link href="<?php echo base_url() . 'static/frontend/'; ?>css/full-file.css" rel="stylesheet">

<style>

/*    .mypro_rightwrap {
        width: 100%;
        float: left;
    }
    
    
 .my_adrsedit_wrap .new_address_formouter .inputbox {
    height: 50px;
    width: 100%;
    float: left;
    border: solid 1px #ddd;
    outline: 0;
    font-family: Montserrat,sans-serif;
    font-weight: 400;
    padding: 0 20px;
    font-size: 12px;
}*/

 .head1 {
    color: #1e1e1e;
    font-family: Montserrat,sans-serif;
    font-size: 16px;
    margin-top: 0;
    margin-bottom: 15px;
    font-weight: 700;
    display: table;
    float: left;
}

</style>

<?php
        $data['user_details'] = $this->user_model->GetByRow('users', $userid, 'id');
        $data['meta_details'] = $this->user_model->GetByRow('users', $userid, 'user_id');
        
        $data['titles'] = $this->user_model->personal_titles();
        $data['country_list'] = $this->user_model->country_list();

        $existing_address = $this->user_model->get_user_address($userid);
        $data['existing_address'] = $existing_address; 
		
		//{oldoption}
       // $data['options'] = $this->user_model->get_options();
       // $data['option'] = $data['options'][0];
	   //{oldoption}
	   
	     $data['option'] = $this->common_model->get_options();
        
        
//        dump($existing_address);

?>



<div id="content" class="clearfix input_animation_wrap">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Edit Address</h3>  
            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>
        </div><!-- End .heading-->

<!--frontend view--> 



 <!--<div class="fullwrap whitebox">-->
        <div class="myacct_contentwrapper">
           <div class="row">
<!--        <div class="col-md-12 col-sm-12 col-xs-12">
            <h2 class="head1">Manage Addresses</h2>
        </div>-->

<input type="hidden" id="gl_uri" name="gl_uri" value="<?php echo $this->uri->segment(2); ?>">
 <input type="hidden" class="gl_userid" name="gl_userid" value="<?php echo $userid; ?>">

        <div class="col-md-12 m-b25 col-sm-12 col-xs-12">
            <a href="javascript:void(0)" class="addnewaddrs_btn fullwrap inputbox "><i class="fa fa-plus plusico"></i>Add new address</a>
      <?php  if ($existing_address == FALSE) { ?> 
           <div class="my_adrsedit_wrap">
            <div class="new_address_formouter" style="display:block;">
                            <?php $this->load->view('index/address/form_delivery_address',$data); ?>
                        </div>
              </div>
           
      <?php } else { ?>
            <div class="my_adrsedit_wrap">
             <div class="new_address_formouter gl_address_form_container">
                                <?php $this->load->view('index/address/form_delivery_address',$data); ?>
                            </div>
                </div>
              <?php }  ?>
        </div>
        <div class="address_lst">
        <?php
                        if ($existing_address != NULL) {
                            $this->load->view('index/address/my_account_list_address',$data);
                        }
                        ?>
            </div>
    </div>
</div>
        
        
       <!--frontend view--> 
        
    <!--</div>-->


    </div><!-- End contentwrapper -->
</div>
<div class="flash_message"></div>

<!--<script src="<?php echo base_url() . 'static/'; ?>gl_build/jquery_validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url() . 'static/frontend/'; ?>js/gl_ecommerce.js"></script>
<script src="<?php echo base_url() . 'static/'; ?>gl_build/cart/shopping_cart.js"></script>
<script src="<?php echo base_url() . 'static/'; ?>gl_build/cart/checkout.js"></script>-->
