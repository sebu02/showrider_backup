<style type="text/css">
    @font-face
    {
        font-family:barcode;
        src: url('<?php echo base_url() . 'static/adminpanel/'; ?>B39MHR.TTF') format('truetype'),
            url('<?php echo base_url() . 'static/adminpanel/'; ?>B39MHR.TTF') format('truetype'); /* IE9+ */

    }
    .table th, .table td {
        line-height:60px;
        padding:0px;
    }
</style>
<style>

    body{
        margin:0px;
        padding:0px;
    }

    .clear{
        clear:both;
    }

    h1,h2,h3 {
        margin:0px;
        padding:0px;
    }

    .wrapper_deliver{
        width:100%;
        height:auto;
    }

    .main_deliver{
        width:1000px;
        height:auto;
        margin:auto;
        border:3px solid #000;
        margin-top:10px;
        position:relative;
    }

    .main_deliver2{
        width:1000px;
        height:auto;
        margin:auto;
    }

    .main_deliver3{
        width:957px;
        height:auto;
        margin-top:10px;
        border:3px solid #000;
        text-align:center;
        padding:20px;
    }

    .main_deliver_box_wrapper{
        min-width:1000px;
        width:auto;
        height:auto;
        border-bottom:solid 1px #333333;
    }

    .main_deliver_box_wrapper2{
        min-width:1000px;
        width:auto;
        height:auto;
        margin-top:40px;
        font-family:Arial, Helvetica, sans-serif;
        font-size:12px;
        color:#000;
    }

    .main_deliver_box_wrapper2 h1{
        font-family:Arial, Helvetica, sans-serif;
        font-size:14px;
        color:#000;
    }

    .main_deliver_box1{
       
        width:auto;
        height:auto;
        padding-left:10px;
        float:left;
        font-family:Arial, Helvetica, sans-serif;
        font-size:12px;
        color:#000;

    }

    .main_deliver_box1 img{
        width:auto;
        height:auto;
    }

    .main_deliver_box1 h1{
        font-family:Arial, Helvetica, sans-serif;
        font-size:16px;
        color:#000;
        text-transform:uppercase;
        text-decoration:underline;
    }

    .main_deliver_box2{
        min-width:333px;
        width:auto;
        height:auto;
        float:left;
        font-family:Arial, Helvetica, sans-serif;
        font-size:12px;
        color:#000;
        border-right: solid 1px #000000;
    }

    .main_deliver_box2 h1{
        font-family:Arial, Helvetica, sans-serif;
        font-size:14px;
        color:#000;
        text-transform:uppercase;
    }

    .main_deliver_box3{
        min-width:324px;
        width:auto;
        height:auto;
        min-height:170px;
        padding-left:10px;
        float:left;
        border-left: solid 1px #000000;
    }

    .main_deliver_box4{
        min-width:324px;
        width:auto;
        height:auto;
        min-height:170px;
        padding-left:10px;
        float:left;
        font-family:Arial, Helvetica, sans-serif;
        font-size:12px;
        color:#000;

    }

    .main_deliver_box3 h1{
        font-family:Arial, Helvetica, sans-serif;
        font-size:14px;
        color:#000;
        text-transform:uppercase;
		line-height:32px;
    }

</style>
<?php
$this->db->where('ec_orders_id', $pid);
if ($cid > 0) {
    $this->db->where('id', $cid);
}
$purchase_header_array = $this->db->get('ec_order_list')->result();


$purchase_details = $this->common_model->GetByRow_notrash('ec_orders', $pid, 'id');


//{oldoption}
//$data['options'] = $this->common_model->get_options();
//$data['option'] = $data['options'][0];
//{oldoption}

$data['option'] = $this->common_model->get_options();


//$order_id = $data['option']->org_order_string . $purchase_details->order_id;
//sbn orderid
$order_id = $this->common_model->format_order_number($purchase_details->order_id,$purchase_details->id);
//sbn orderid


//
$proceed_with_orderid = 'no';
if($purchase_details->order_split_status == 'yes' && $purchase_details->order_split_type == 'child')
{

$master_order_details = $this->common_model->GetByRow('ec_orders', $purchase_details->split_order_master_id , 'id');	

//if ($master_order_details->order_id == 0) {
//$order_id = $data['option']->tmp_order_string . $master_order_details->id;
//} else {
//$order_id = $data['option']->org_order_string . $master_order_details->order_id.'-'.$purchase_details->order_id_split_reference;
//$proceed_with_orderid = 'yes';
//}

//sbn orderid
$order_id = $this->common_model->format_order_number($master_order_details->order_id,$master_order_details->id);
//sbn orderid

if ($master_order_details->order_id == 0) {

} else {
$order_id = $order_id.'-'.$purchase_details->order_id_split_reference;
$proceed_with_orderid = 'yes';
}

}
else
{


//if ($purchase_details->order_id == 0) {
//$order_id = $data['option']->tmp_order_string . $purchase_details->id;
//} else {
//$order_id = $data['option']->org_order_string . $purchase_details->order_id;
//$proceed_with_orderid = 'yes';
//}

//sbn orderid
$order_id = $this->common_model->format_order_number($purchase_details->order_id,$purchase_details->id);
//sbn orderid

if ($purchase_details->order_id == 0) {
	
} else {

$proceed_with_orderid = 'yes';
}

}
                    
//


$shipping_address = json_decode($purchase_details->shipping_address, TRUE);

$ship_name = $shipping_address['frm_first_name'] . ' ' . $shipping_address['frm_last_name'];
$ship_address = $shipping_address['frm_locality'] . ', ' . $shipping_address['frm_address'];
$ship_city = $shipping_address['frm_city'];

$ship_zip = $shipping_address['frm_pincode'];
$ship_email = $shipping_address['frm_email'];
$ship_phone = $shipping_address['frm_phoneno'];

$string = $ship_address;
$pos = 35;
$begin_address = substr($string, 0, $pos + 1);
$end_address = substr($string, $pos + 1);
?>
<div class="wrapper_deliver">
    <div class="main_deliver">
        <div class="main_deliver_box_wrapper">
            <div class="main_deliver_box1"><img src="<?php echo base_url() . 'static/gl_build/common/images/logo2.png'; ?>"><br /><br /><strong style="text-transform:uppercase; font-size:16px">COMPANY NAME</strong></div><!--main_deliver_box1-->
<div class="main_deliver_box2" style="font-size:15px; padding-top:5px; margin-left:6%;">
<p style="font-size:14px;font-weight: 600;color: #000;text-align:left; margin: 0 ">Sold By :<br>
<span style="font-size: 14px;font-weight: 400;"><strong>COMPANY NAME</strong><br>

Address 1
<br>
Address 2<br>
PH: 0000000000
<br>COUNTRY CODE</span></p>

            </div><!--main_deliver_box2-->
            <div class="main_deliver_box3">
                <h1>ORDER NO : <?php
                    if ($proceed_with_orderid == 'yes') {
                        echo $order_id;
                    } else {
                        echo '-';
                    }
                    ?><br />
                    DATE : <?php
                    $orderdate = $purchase_details->purchase_date;              // returns Saturday, January 30 10 02:06:34
                    $orderdate_timestamp = strtotime($orderdate);
                    $new_orderdate = date('d-m-Y ', $orderdate_timestamp);
                    echo $new_orderdate;
                    ?><br />

                    <?php /*?>PAN NO : AAFCA0423M<br>
                        GST NO : 29AAFCA0423M1ZP
                        <?php */?>


                    <br /></h1></div><!--main_deliver_box3-->
            <div class="clear"></div><!--clear-->
        </div><!--main_deliver_box_wrapper-->

        <div class="main_deliver_box_wrapper2">
            <div class="main_deliver_box1" style="width:30%; font-size:15px;">
                <h1>DELIVER TO :</h1>
                <?php
                echo $shipping_address_string = $this->common_model->GetSpecifiedAddressInSpecifiedFormat($purchase_details->shipping_address);
                
                ?>

            </div><!--main_deliver_box1-->
            <div class="main_deliver_box2" style="width:46%;">
                <?php
                    if (!empty($purchase_details->waybill)) {
                        ?>
                    <span  style="font-family:barcode; font-size:38px;"><?php echo $purchase_details->waybill; ?></span><?php
                }
                ?> <span  style="font-family:barcode; font-size:38px; float:right"><?php
                if ($proceed_with_orderid == 'yes') {
                    echo $order_id;
                } else {
                    echo '-';
                }
                ?></span>
            </div><!--main_deliver_box2-->
            <div class="main_deliver_box4" style="float:right"><div class="main_deliver_box2" style="font-size:12px; padding-top:40px;float:right;">
                    <?php
                    if (!empty($purchase_details->waybill)) {
                        ?>
                        <b>AWB No : <?php echo $purchase_details->waybill; ?></b> <br />
                        <?php
                    }
                    ?>
                   
                    
                    <b>Order ID : <?php
                        if ($proceed_with_orderid == 'yes') {
                            echo $order_id;
                        } else {
                            echo '-';
                        }
                        ?></b> <br />
                        <b>Invoice No : <?php
                        if ($proceed_with_orderid == 'yes') {
                            echo $order_id;
                        } else {
                            echo '-';
                        }
                        ?></b> <br />
                    <b>Order Date : <?php
                        $orderdate = $purchase_details->purchase_date;              // returns Saturday, January 30 10 02:06:34
                        $orderdate_timestamp = strtotime($orderdate);
                        $new_orderdate = date('d-m-Y ', $orderdate_timestamp);
                        echo $new_orderdate;
                        ?></b> <br />
                    
                </div><!--main_deliver_box2--></div><!--main_deliver_box3-->



            <div class="clear"></div><!--clear-->

        </div><!--main_deliver_box_wrapper-->
        
        
<?php
$address_by_pincode = $this->common_model->get_address_by_pincode($ship_zip);
$address_by_pincode_first_array = $address_by_pincode['PostOffice'];
$delivery_state = $address_by_pincode_first_array[0]['State'];
?>

        <div class="main_deliver_box_wrapper2">
            <table width="98%" border="0" cellspacing="0" cellpadding="0" style="border: solid 1px #000;margin-bottom:10px;margin-left:10px;" >
                <tr>
                    <td width="50" style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;"><h1>Sr. No.</h1></td>
                    <td width="120" style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;"><h1>Item Code</h1></td>
                    <td width="200" style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;"><h1>Item Description</h1></td>
                    <td width="60" style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;"><h1>Qty</h1></td> 
                    <td  style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;"><h1>Value</h1></td>
<?php /*?>                    <td  style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">SGST</td>
                    <td  style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">CGST</td>
<?php
if($delivery_state != 'Gujarat')
{
?>                    
<td  style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">IGST</td>

<?php
}
?>
<?php
if($delivery_state == 'Kerala')
{
?> 
<td  style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">CESS</td>
<?php
}
?><?php */?>
                    
                    
                    <td width="130" style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;"><h1>Total Amount</h1></td>

                </tr>


                <?php
                foreach ($purchase_header_array as $purchase_header) {

                    $prod = $this->common_model->GetByRow_notrash('ec_products', $purchase_header->product_id, 'id');


                    $prod_name = $prod->prod_name;
                    $sku = strtoupper($prod->sku);
                    $price = number_format($purchase_header->product_price, 2, ".", ",");
					

//Tax Calculation
/*$SGST = 0;
$CGST = 0;
$IGST = 0;
$CESS = 0;
$product_price = $purchase_header->product_price;

if($delivery_state == 'Gujarat')
{

$gst                =   18;
$calculateTax       =   100+$gst;
$calculateAmount    =   $product_price*100;
$actualProductPrice        =   $calculateAmount/$calculateTax;
$actualProductPrice       =   round($actualProductPrice,2);

$tax_amount = ($actualProductPrice*18)/100;
$tax_amount = round($tax_amount,2);

$tax_amount_split = $tax_amount/2;

$tax_amount_split = round($tax_amount_split,2);

$SGST = $tax_amount_split;

$CGST = $product_price-($actualProductPrice+$tax_amount_split);


}
else
if($delivery_state == 'Kerala')
{

$gst                =   19;
$calculateTax       =   100+$gst;
$calculateAmount    =   $product_price*100;
$actualProductPrice        =   $calculateAmount/$calculateTax;
$actualProductPrice       =   round($actualProductPrice,2);

$tax_amount = ($actualProductPrice*18)/100;
$tax_amount = round($tax_amount,2);

$tax_amount_split = $tax_amount/2;
$tax_amount_split = round($tax_amount_split,2);

$flood_sess_amount = ($actualProductPrice*1)/100;
$flood_sess_amount = round($flood_sess_amount,2);

$SGST = 0;
$CGST = 0;
$IGST = $tax_amount;
$CESS = $flood_sess_amount;

}
else
{

$gst                =   18;
$calculateTax       =   100+$gst;
$calculateAmount    =   $product_price*100;
$actualProductPrice        =   $calculateAmount/$calculateTax;
$actualProductPrice       =   round($actualProductPrice,2);

$tax_amount = ($actualProductPrice*18)/100;
$tax_amount = round($tax_amount,2);

$SGST = 0;
$CGST = 0;
$IGST = $tax_amount;

}*/


//Tax Calculation
					
					
                    ?>

                    <tr>
                        <td height="19" style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">1</td>
                        <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000; font-size:15px;"><?php echo $sku; ?></td>
                        <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000; font-size:15px;"><?php echo ucfirst($prod_name); ?></td>
                        <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;"><?php echo $purchase_header->order_qty; ?></td>
                        <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">Rs. &nbsp;<?php echo number_format($actualProductPrice, 2, '.', ','); ?></td>
                        <?php /*?><td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">Rs. &nbsp;<?php echo number_format($SGST, 2, '.', ',') ; ?></td>
                        <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">Rs. &nbsp;<?php echo number_format($CGST, 2, '.', ',') ; ?></td>
<?php
if($delivery_state != 'Gujarat')
{
?>
<td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">Rs. &nbsp;<?php echo number_format($IGST, 2, '.', ',') ; ?></td>
<?php
}
?>
<?php
if($delivery_state == 'Kerala')
{
?>
<td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">Rs. &nbsp;<?php echo number_format($CESS, 2, '.', ',') ; ?></td>
<?php
}
?><?php */?>

                        <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;"><strong><?php $item_subtotal = $purchase_header->product_price * $purchase_header->order_qty; ?>Rs. &nbsp;<?php echo number_format($item_subtotal, 2, '.', ','); ?></strong></td>

                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td height="19" style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
<?php /*?>                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
<?php
if($delivery_state != 'Gujarat')
{
?>
<td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>

<?php
}
?>

<?php
if($delivery_state == 'Kerala')
{
?>
<td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
<?php
}
?><?php */?>


                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
                </tr>
                <tr>
                    <td height="19" style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
                    <?php /*?><td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>

<td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>


<?php
if($delivery_state != 'Gujarat')
{
?>
                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;"></td>
 <?php
}
?>
<?php
if($delivery_state == 'Kerala')
{
?> 
                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;">&nbsp;</td>
                    <?php
}
?><?php */?>
                    <td style="border-right: solid 1px #000000;text-align:center;border-bottom:solid 1px #000000;"><strong style="font-size:18px;">Rs. &nbsp;<?php
                            
                
                if ($cid > 0) {
          
                    echo  number_format($item_subtotal, 2, ".", ",");
                }else{
                    echo  number_format($purchase_details->amount, 2, ".", ",");
                }
                            ?></strong><br>(Inclusive of all taxes)</td>
                </tr>
            </table>
        </div><!--main_deliver_box_wrapper-->


    </div><!--main_deliver-->

    <div class="main_deliver2">
        <div class="main_deliver3">



            <p style="font-size:14px;font-weight: 600;color: #000;text-align:left; margin: 0 ">
													<span style="font-size: 14px;font-weight: 400;">COMPANY  Address </p>

        </div><!--main_deliver3-->
        <div class="clear"></div><!--clear-->
    </div><!--main_deliver2-->

    <div class="clear"></div><!--clear-->
</div>



<script type="text/javascript">
    $(document).ready(function () {

        window.print();

    });
</script>
