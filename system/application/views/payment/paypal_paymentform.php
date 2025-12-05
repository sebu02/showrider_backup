<title> Paypal Integration in PHP</title>

<div class="container">
	<div class="col-lg-12">
	<div class="row">
      
  <?php
  $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
  $paypal_email = 'vijeeshchris@gmail.com';
  ?>
            
            <form action="<?php echo $paypal_url; ?>" method="post">
            
                <input type="hidden" name="business" value="<?php echo $paypal_email; ?>">
                
                <input type="hidden" name="cmd" value="_xclick">
                
                <input type="hidden" name="item_name" value="<?php echo $ec_orders_list_row->product_name; ?>">
                
                <input type="hidden" name="item_number" value="<?php echo $ec_orders_list_row->product_id; ?>">
                
                <input type="hidden" name="amount" value="<?php echo round($ec_orders_row->amount);; ?>">
                
                <input type="hidden" name="currency_code" value="USD">
                
                <input type='hidden' name='cancel_return' value='<?php echo base_url() . 'paymentoption/paypal_cancel/' . $ec_orders_id; ?>'>
                
                <input type='hidden' name='return' value='<?php echo base_url() . 'paymentoption/paypal_success/' . $ec_orders_id; ?>'>
                
                <input type="image" name="submit" border="0"
			src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
                
                <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" > 
            
            </form>
            
            
            
            </div>		
	</div>	
		
</div>