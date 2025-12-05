<?php
//{oldoption}
//$data['options'] = $this->common_model->get_options();
//$data['option'] = $data['options'][0];
//{oldoption}

$data['option'] = $this->common_model->option;


$banner = json_decode($data['option']->logo);

$myorders = $this->common_model->GetByRow('ec_orders', $razorpay_myorderid, 'id');

$payment_method = $this->common_model->GetByRow('ec_payment_method', $myorders->payment_method, 'id');
$orderdate = $myorders->purchase_date;              // returns Saturday, January 30 10 02:06:34
$orderdate_timestamp = strtotime($orderdate);
$new_orderpurchase_date = $new_orderdate = date('l, F d Y H:i:s', $orderdate_timestamp);


$current_timeline = $this->common_model->GetByRow('ec_cart_order_status', $myorders->payment_status, 'id');
$timeline_list = $this->common_model->list_timeline_status_array($current_timeline, $myorders);
$current_key = array_search($myorders->payment_status, array_column($timeline_list, 'id'));
$new_statusdate = date('l, F d Y H:i:s', strtotime($timeline_list[$current_key]['product_order_status_datetime']));

$order_status_text = strtolower($ec_cart_order_status->status_title);



switch ($myorders->payment_status) {
    case '3':
    case '7':
    case '11':
        $order_status = 'success';
        break;
    case '12':
        $order_status = 'orderdispatched';
        break;
    case '13':
        $order_status = 'orderdelivered';
        break;
    case '4':
    case '8':
    case '5':
    case '9':
    case '6':
    case '10':

        $order_status = 'fail';

        break;
    default:
        $order_status = 'fail';
        break;
}


//if ($myorders->order_id == 0) {
//    $ordrid = $data['option']->tmp_order_string . $myorders->id;
//} else {
//    $ordrid = $data['option']->org_order_string . $myorders->order_id;
//}

//sbn orderid
$ordrid = $this->common_model->format_order_number($myorders->order_id,$myorders->id);
//sbn orderid

$billing_address_string = $this->common_model->GetSpecifiedAddressInSpecifiedFormat($myorders->billing_address);
$shipping_address_string = $this->common_model->GetSpecifiedAddressInSpecifiedFormat($myorders->shipping_address);
?>

<?php if ($order_status != "success") { ?><!DOCTYPE html>
<html>
<head>
   <!-- NAME: HERO CARD -->
    <!--[if gte mso 15]>
    <xml>
      <o:OfficeDocumentSettings>
        <o:AllowPNG />
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
  <title>Litecart  mailer</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src='https://www.thelitecart.com/static/frontend/js/jquery-3.3.1.min.js'></script>
</head>
<body style="margin: 0;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:auto;background-color:#e2e2e2;align-items: center;">
 <tbody><tr>
 <td>
 
 

<table width="700" border="0" cellspacing="0" cellpadding="0" style="margin:auto;background-color:#fff" align="center">
 <tbody><tr >
 <td style="border-bottom:dotted #adadad 1.0pt;"><table width="700" height="60" border="0" cellspacing="0" cellpadding="0">
 <tbody><tr>
 <td width="35">&nbsp;</td>
 <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tbody>
       <tr>
         <td><img src="<?php echo base_url(); ?>static/gl_build/mailer/header-logo.png" class="CToWUd"></td>
         <td><img src="<?php echo base_url(); ?>static/gl_build/mailer/axis-logo.png" class="CToWUd"></td>
         <td>&nbsp;</td>
       </tr>
     </tbody>
 </table></td>
 </tr>
 </tbody></table></td>
 </tr>
 <tr>
 <td><table width="700" height="150" border="0" cellspacing="0" cellpadding="0">
 <tbody><tr>
 <td ><table width="700" border="0" cellspacing="0" cellpadding="0">
 <tbody><tr>

<td>

<a href="javascript:void(0);" style="margin: 0 auto;display: table;padding: 15px 25px;color: #fff;font-family:'Roboto',sans-serif;font-size:14px;text-decoration: none;background-color: #359bfd;border-radius: 5px; margin-bottom:10px;" id="rzp-button1">Pay Now</a>

<center><img src="<?php echo base_url(); ?>static/gl_build/mailer/razorpay-logo.png" class="CToWUd" style="margin: 0 auto;"></center>

<form name='razorpayform' action="<?php echo base_url().'razorpayverify' ?>" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
    <input type="hidden" name="razorpay_myorderid"  id="razorpay_signature" value="<?php echo $razorpay_myorderid ;?>"  >
</form>
<script>

window.onload = function(){
  document.getElementById('rzp-button1').click();
  

}

// Checkout details as a json
var options = <?php echo $json?>;

/**
 * The entire list of Checkout fields is available at
 * https://docs.razorpay.com/docs/checkout-form#checkout-fields
 */
options.handler = function (response){
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};

// Boolean whether to show image inside a white frame. (default: true)
options.theme.image_padding = false;

options.modal = {
    ondismiss: function() {
        console.log("This code runs when the popup is closed");
    },
    // Boolean indicating whether pressing escape key 
    // should close the checkout form. (default: true)
    escape: true,
    // Boolean indicating whether clicking translucent blank
    // space outside checkout form should close the form. (default: false)
    backdropclose: false
};

var rzp = new Razorpay(options);

rzp.on('payment.failed', function (response){
	//console.log(response.error);
        //alert(response.error.code);
        //alert(response.error.description);
        //alert(response.error.source);
        //alert(response.error.step);
        //alert(response.error.reason);
       // alert(response.error.metadata.order_id);
        //alert(response.error.metadata.payment_id);

//


var base_url = '<?php echo base_url() ; ?>';
    $.ajax({
        type: "POST",
        data: {response: response.error, razorpay_myorderid: "<?php echo $razorpay_myorderid ; ?>"},
        url: base_url + "failed-razorpay",
        cache: false,
        success: function (data) {
			
		window.location = data;
		
        }

    });

//		
		
		
		
});

document.getElementById('rzp-button1').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>

</td>
 </tr>
 

 </tbody></table></td>
 </tr>
 </tbody></table></td>
 </tr>



<?php if ($mail_user == 'admin') { ?>
<tr>
                  <td style="padding:0cm 0cm 0cm 0cm">
                  <table border="0" cellspacing="0" cellpadding="0" width="700" style="width:525.0pt"><tbody><tr style="height:7.5pt">
                    <td width="35" style="width:26.25pt;">
                    </td>
                 
                  </tr>
                 
                  <tr style="height:9.6pt"><td style="padding:0cm 0cm 0cm 0cm;height:9.6pt"></td>
                    <td colspan="2" style="padding:0cm 0cm 0cm 0cm;height:9.6pt">

                      <p class="MsoNormal" style="margin:10px 0px;"><span style="font-size:12px;font-family:Roboto;color:#707070;font-weight: 500;">You have received an order from <?php echo $customer_name; ?>. The order details are as follows:</span></p>
                    </td>
                    </tr>
                    </tbody></table></td></tr>
 <?php } else if ($mail_user == 'user') { ?>                   


  <tr>
                  <td style="padding:0cm 0cm 0cm 0cm">
                  <table border="0" cellspacing="0" cellpadding="0" width="700" style="width:525.0pt"><tbody><tr style="height:7.5pt">
                    <td width="35" style="width:26.25pt;">
                    </td>
                 
                  </tr>
                  <tr>
                    <td style="padding:0cm 0cm 0cm 0cm"></td>
                  <td colspan="2" style="">
                    <p class="MsoNormal" style="margin: 5px 0px">
                      <span style="font-size:12px;font-family:Roboto;color:#707070;margin: 0; font-weight: 500;">Dear <?php echo $customer_name; ?> , </span></p>
                    </td>
                  </tr>
                  <tr style="height:9.6pt"><td style="padding:0cm 0cm 0cm 0cm;height:9.6pt"></td>
                    <td colspan="2" style="padding:0cm 0cm 0cm 0cm;height:9.6pt">
                      <p class="MsoNormal" style="margin:10px 0px;"><span style="font-size:12px;font-family:Roboto;color:#707070;font-weight: 500;">Thank you for the purchase. Order summary and address details are shown below. Contact us for any related queries.</span></p>
                    </td>
                    </tr>
                    </tbody></table></td></tr>
<?php
}
?>                    
                    

 


   <tr>
 <td><table width="700" border="0" cellspacing="0" cellpadding="0" style="width: 100%;" >
 <tbody>



 <tr style="background-color:#359bfd;padding: 10px">

<td width="30">&nbsp;</td>
<td width="640">
  <table width="640"><tbody>
   <tr>
    <td width="640" style="background:#359bfd;">
          <p style="text-align:center;margin: 5px;"><strong><i><span style="font-size:12.0pt;font-family:Roboto;color:white">Your Order Reference : <?php echo $ordrid; ?></span></i></strong><i><span style="font-size:12.0pt;font-family:Roboto;color:white"><br></span></i><i><?php /*?><span style="font-size:8.5pt;font-family:Roboto;color:white">(Placed on <?php echo $new_statusdate; ?>)</span><?php */?></i></p>
          </td>

          </tr>
        </tbody>
      </table></td>
<td width="30">&nbsp;</td>
 </tr>
 
 </tbody></table></td>
 </tr>



  <tr>
<td style="padding:0cm 0cm 0cm 0cm">
          <table border="0" cellspacing="0" cellpadding="0" width="700" style="width:525.0pt"><tbody>
            <tr>
              <td>
                <p></p>

              </td>
            </tr>
            <tr>
              <td>
                <p></p>
                
              </td>
            </tr>
          </tbody></table>
         <table border="0" cellspacing="0" cellpadding="0" width="700" style="width:525.0pt"><tbody><tr><td width="350" valign="top" style="width:262.5pt;padding:0cm 0cm 0cm 0cm"><table border="0" cellspacing="0" cellpadding="0" width="350" style="width:262.5pt"><tbody><tr><td width="35" style="width:26.25pt;padding:0cm 0cm 0cm 0cm"></td>
              <td style="padding:0cm 0cm 0cm 0cm"><span style="font-size:12.0pt;font-family:Roboto;color:#2b2b2b">Billing Address</span></td></tr><tr></tr><tr><td style="padding:0cm 0cm 0cm 0cm"></td><td style="padding:0cm 0cm 0cm 0cm"><span style="font-size:9.0pt;font-family:Roboto;color:#2b2b2b"><?php echo $billing_address_string; ?></span></td></tr><tr><td style="padding:0cm 0cm 0cm 0cm"></td><td style="padding:0cm 0cm 0cm 0cm"></td></tr><tr><td style="padding:0cm 0cm 0cm 0cm"></td><td style="padding:0cm 0cm 0cm 0cm"><p class="MsoNormal" style="margin: 35px 0px 5px;"><span style="font-size:12.0pt;font-family:Roboto;color:#61B1FF;">Payment Method</span></p></td></tr><tr>

                <td style="padding:0cm 0cm 0cm 0cm"></td><td style="padding:0cm 0cm 0cm 0cm"><p class="MsoNormal" style="margin: 5px 0px 25px;"><span style="font-size:9.0pt;font-family:Roboto;color:#61B1FF;"><?php echo $payment_method->payment_type; ?></span></p></td></tr></tbody></table></td>
              <td width="350" valign="top" style="width:262.5pt;padding:0cm 0cm 0cm 0cm"><table border="0" cellspacing="0" cellpadding="0" width="350" style="width:262.5pt"><tbody><tr><td width="35" style="width:26.25pt;padding:0cm 0cm 0cm 0cm"></td>
              <td style="padding:0cm 0cm 0cm 0cm"><span style="font-size:12.0pt;font-family:Roboto;color:#2b2b2b">  
Shipping Address</span></td></tr><tr></tr><tr><td style="padding:0cm 0cm 0cm 0cm"></td><td style="padding:0cm 0cm 0cm 0cm"><span style="font-size:9.0pt;font-family:Roboto;color:#2b2b2b"><?php echo $shipping_address_string; ?></span></td></tr><tr><td style="padding:0cm 0cm 0cm 0cm; height:30px;"></td><td style="padding:0cm 0cm 0cm 0cm"></td></tr><tr><td style="padding:0cm 0cm 0cm 0cm"></td><td style="padding:0cm 0cm 0cm 0cm"><a href="<?php echo base_url().'cancel-razorpay?pid='.$razorpay_myorderid ; ?>" style="display: table;padding: 10px 15px;color: #fff;font-family:'Roboto',sans-serif;font-size:14px;text-decoration: none;background-color: #F99A47;border-radius: 5px; margin-bottom:10px;" >Cancel Payment</a></td></tr></tbody></table></td></tr></tbody></table></td>
 </tr>


<?php
$my_order_products = $this->common_model->my_order_list($myorders->id);
$total_order_items = count($my_order_products);
foreach ($my_order_products as $key1 =>
$product_item) {
$product_details = $this->common_model->GetByRow('ec_products', $product_item->product_id, 'id');

$total_productwithqty_price = $this->common_model->fetch_num_format($product_item->product_price * $product_item->order_qty);

//                                                            $total_order_items += $product_item->order_qty;

$total_price =$total_productwithqty_price;

$images = json_decode($product_details->prod_file);

$image_link = '';
if ($images->image) {
$image_link = base_url() . "media_library/medium_" . $images->image;
}
?>
 <tr>
<td style="padding:0cm 0cm 0cm 0cm;background:#e5f3ff30;">
       
            <table border="0" cellspacing="0" cellpadding="0" width="700" style="width:525.0pt;margin: 20px 0px 0px;"><tbody><tr>

              <td width="280" style="width: 230.5pt;padding:0cm 0cm 0cm 0cm;margin-top: 20px;">
                <table border="0" cellspacing="0" cellpadding="0" width="250">
                  <tbody>
                  <tr>
                    <td width="35" style="width:26.25pt;padding:0cm 0cm 0cm 0cm"></td>
              <td style="padding:0cm 0cm 0cm 0cm">
                
                              
                              
<?php
if ($image_link) {
?>
<img border="0" width="215" height="260" src ="<?php echo $image_link; ?>" style = "margin-top: 20px;margin-bottom: 20px;">
<?php
}
?>                
                         
              </td>
            </tr>
        
</tbody>
</table>
</td>


              <td width="400">
               
<p class="MsoNormal">
                              <span style="font-size:12.0pt;font-family:Roboto;color:#2b2b2b;font-weight: 600;">
<?php
$product_title = $product_details->product_title;
$product_title = json_decode($product_title, TRUE);
$product_title = $product_title[0]['right_val'];
echo $product_title;

//echo $product_details->prod_name; 
?>
                              </span>
                            </p>
<p class="MsoNormal" style="padding: 0px 30px 0px 0px;text-align: justify;"><span style="font-size:12px;font-family:Roboto;color:#727272">
Product Code:
<?php echo $product_details->prod_code ?></span></p>

<?php /*?><p class="MsoNormal" style="padding: 0px 30px 0px 0px;text-align: justify;"><span style="font-size:12px;font-family:Roboto;color:#727272">
SKU:
000144782</span></p><?php */?>

<table border="0" cellspacing="0" cellpadding="0" width="370"><tbody><tr><td width="220" style="width:165.0pt;padding:0cm 0cm 0cm 0cm"><p class="MsoNormal"><strong><span style="font-size:18.0pt;font-family:Roboto;color:#a4cd39"><?php echo $this->common_model->current_currency(); ?> <?php echo $total_productwithqty_price; ?></span></strong><b><span style="font-size:18.0pt;font-family:Roboto;color:#a4cd39"> </span></b></p></td><td width="235" style="width:156.25pt;padding:0cm 0cm 0cm 0cm"><div align="right">

  <table border="0" cellspacing="0" cellpadding="0" width="180" style="width:100.0pt"><tbody><tr><td width="105" style="width:78.75pt;padding:0cm 0cm 0cm 0cm">

  <table border="0" cellspacing="0" cellpadding="0" width="105" style="width:78.75pt;"><tbody><tr><td width="70" style="width:52.5pt;padding:0cm 0cm 0cm 0cm"></td><td width="35" style="width:26.25pt;padding:0cm 0cm 0cm 0cm"><p class="MsoNormal"><span style="font-size:12px;font-family:Roboto;color:#636363">QTY</span></p></td></tr></tbody></table></td><td width="75" style="width:56.25pt;padding:0cm 0cm 0cm 0cm">
  <table border="1" cellspacing="0" cellpadding="0" width="75" height="50" style="width:56.25pt;border:1px solid #ababab;">
    <tbody><tr style="height:11.4pt"><td style="border:none;padding:0cm 0cm 0cm 0cm;height:11.4pt">
  <p class="MsoNormal" align="center" style="text-align:center"><span style="font-size:12.0pt;font-family:Roboto;color:#949494"><?php echo $product_item->order_qty; ?></span></p></td>
</tr>
</tbody>
</table></td></tr></tbody></table></div></td></tr></tbody></table>
               </td></tr></tbody></table></td>
 </tr>

<?php
}
?>





 





<tr><td style="padding:0cm 0cm 0cm 0cm"><table border="0" cellspacing="0" cellpadding="0" width="700" style="width:525.0pt; margin: 10px 0px;"><tbody><tr style="height:7.5pt"><td style="border:none;border-bottom:dotted #adadad 1.0pt;padding:0cm 0cm 0cm 0cm;height:7.5pt"><div align="center"><table border="0" cellspacing="0" cellpadding="0" width="640" height="50px" style="width:480.0pt"><tbody><tr><td style="padding:0cm 0cm 0cm 0cm"></td></tr><tr><td style="padding:0cm 0cm 0cm 0cm"><table border="0" cellspacing="0" cellpadding="0" width="640" style="width:480.0pt"><tbody><tr><td width="320" style="width:240.0pt;padding:0cm 0cm 0cm 0cm"><p class="MsoNormal"><span style="font-size:12px;font-family:Roboto;color:#2b2b2b">No of Items</span></p></td><td width="320" style="width:240.0pt;padding:0cm 0cm 0cm 0cm"><p class="MsoNormal" align="right" style="text-align:right"><span style="font-size:12px;font-family:Roboto;color:#2b2b2b">1 Item</span></p></td></tr></tbody></table></td></tr><tr><td style="padding:0cm 0cm 0cm 0cm"></td></tr></tbody></table></div></td></tr><tr><td style="padding:0cm 0cm 0cm 0cm"></td></tr><tr><td style="padding:0cm 0cm 0cm 0cm"><div align="center">
    <table border="0" cellspacing="0" cellpadding="0" width="640" height="50px"  style="width:480.0pt"><tbody><tr><td width="320" style="width:240.0pt;padding:0cm 0cm 0cm 0cm"><p class="MsoNormal"><b><span style="font-size:12.0pt;font-family:Roboto;color:#a4cd39">Grand Total</span></b></p></td><td width="320" style="width:240.0pt;padding:0cm 0cm 0cm 0cm"><p class="MsoNormal" align="right" style="text-align:right"><b><span style="font-size:12.0pt;font-family:Roboto;color:#a4cd39"><?php echo $this->common_model->current_currency(); ?> <?php echo $this->common_model->fetch_num_format($myorders->amount); ?></span></b></p></td></tr></tbody></table></div></td></tr><tr><td style="padding:0cm 0cm 0cm 0cm"></td></tr></tbody></table></td></tr>



 
</tbody></table>

 
 
 
 </td>
 </tr>
</tbody></table></body>

</html>
<?php } ?>