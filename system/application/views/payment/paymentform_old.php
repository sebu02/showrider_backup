<html>

    <head>

        <title>Secure Payment | <?php echo $payment_method_row->payment_type; ?> |<?php echo $_SERVER['HTTP_HOST']; ?></title>

    </head>

    <body onLoad="document.forms['paymentForm'].submit();" >
    <center><h2>Please wait, your order is being processed and you will be redirected to the <?php echo $payment_method_row->payment_type; ?> Payment Gateway.</h2></center>
    <?php
    // dump($paymentparams);
    //dump($payment_method_row);
//    error_reporting(-1);
    ?>

    <?php
    if ($payment_method_row->payment_type == "PayU") {

// Merchant key here as provided by Payu
//$MERCHANT_KEY = "C0Dr8m"; //demo
        $MERCHANT_KEY = $payment_parameter_values[1]; //live
// Merchant Salt as provided by Payu
//$SALT = "3sf0jURk"; //demo
        $SALT = $payment_parameter_values[2]; //live
// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://test.payu.in/_payment";
        $PAYU_BASE_URL = $action;
//dump($action);
        $action_url = '';

        $posted = array();
        if (!empty($_POST)) {
            //print_r($_POST);
            foreach ($_POST as $key => $value) {

                $posted[$key] = htmlentities($value, ENT_QUOTES);
            }
        }
        /* foreach ($posted as $key => $value) {
          echo "posted[".$key."]=".$value."<br>";
          } */
//echo $posted;
        $formError = 0;

        if (empty($posted['txnid'])) {
            // Generate random transaction id
            $txnid = $paymentparams['txnid'];
        } else {
            $txnid = $posted['txnid'];
        }
        $paymentparams['txnid'] = $txnid;

        $hash = '';
// Hash Sequence
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        if (empty($posted['hash']) && sizeof($posted) > 0) {
            if (
                    empty($posted['key']) || empty($posted['txnid']) || empty($posted['amount']) || empty($posted['firstname']) || empty($posted['email']) || empty($posted['phone']) || empty($posted['productinfo']) || empty($posted['surl']) || empty($posted['furl'])
            ) {
                $formError = 1;
            } else {
                $hashVarsSeq = explode('|', $hashSequence);
                $hash_string = '';
                foreach ($hashVarsSeq as $hash_var) {
                    $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                    $hash_string .= '|';
                }
                $hash_string .= $SALT;
                $hash = strtolower(hash('sha512', $hash_string));
                $action_url = $PAYU_BASE_URL . '/_payment';
            }
        } elseif (!empty($posted['hash'])) {
            $hash = $posted['hash'];
            $action_url = $PAYU_BASE_URL . '/_payment';
        }

		
        }
	else
	{
	 $action_url = $action;	
	}
	 ?>





    <form action="<?php echo $action_url; ?>" method="post" name="paymentForm">


<?php

if ($payment_method_row->payment_type == "Ccavanue3") {
?>
<input type="hidden" name="encRequest" value="<?php echo $encRequest; ?>" />
<input type="hidden" name="access_code" value="<?php echo $paymentparams['access_code']; ?>" />
<?php
	
}
else
{

 foreach ($paymentparams as $key => $value) { ?>
            <input type="hidden" name="<?php echo $key ?>" value="<?php echo $value; ?>" />
<?php 

}

}

if ($payment_method_row->payment_type == "PayU") {
    ?>

            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>  
<?php } ?>    



        <center><br><br>If you are not automatically redirected to <?php echo $payment_method_row->payment_type; ?> within 5 seconds...<br><br>
            <input value="Click Here" type="submit"></center>
    </form>

</body>

</html>



