<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	require_once(APPPATH."libraries/razorpay/Razorpay.php");
	use Razorpay\Api\Api;
	use Razorpay\Api\Errors\SignatureVerificationError;

class Paymentoption extends CI_Controller {

    var $data = array();
    var $beadData1 = array();
    var $valc = 0;
    var $ar = array();
    var $currency; //Create a variable for the entire controller

    public function __construct() {

        parent::__construct();

        //$this->load->helper('translate');
        $this->load->helper('cookie');
        //$this->load->helper('urlhelper');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('encryption');
        // $this->load->library('ion_auth');
        // $this->load->library('xmlparser');
        $this->load->library('cart');
        $this->load->model('common_model');
        $this->load->model('index_model');
        $this->load->model('cart_model');
        $this->load->model('paymentoption_model');
        $this->load->model('uploadlibrary_model');

        //session_start();

    //    error_reporting(0);
//        date_default_timezone_set('Asia/Calcutta');

        $this->form_validation->set_error_delimiters('', '');
    }
    
    public function do_payment($ec_orders_id, $payment_method_id) {

        $data['web_title'] = $this->common_model->option->project_name;

        $payment_method_row = $this->common_model->GetByRow('ec_payment_method', $payment_method_id, 'id');
        $ec_orders_row = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');

        $payment_status_id = $ec_orders_row->payment_status;
        if ($payment_status_id < 2) {

            $this->common_model->UpdateOrderStatus('2', $ec_orders_id);
        }

        if ($payment_method_row->payment_type == "GiftCard") {
            redirect('payment-response/' . $ec_orders_id);
        } else if ($payment_method_row->payment_type == "cod" || $payment_method_row->payment_type == "cardod") {
            redirect('payment-response/' . $ec_orders_id);
        }  else {
			
            //redirect('secure-payment/' . $ec_orders_id . '/' . $payment_method_id);

//encode numbers			
$logged_userid = $this->common_model->logged_user_data->id;
			
$ec_orders_id_encrypt =  $this->common_model->encode_id($ec_orders_id,$logged_userid);
$payment_method_id_encrypt =  $this->common_model->encode_id($payment_method_id,$logged_userid);

redirect('secure-payment/' . $ec_orders_id_encrypt . '/' . $payment_method_id_encrypt);
//encode numbers			
			
			
        }
    }

    function secure_payment($ec_orders_id, $payment_method_id) {
		
//error_reporting(-1);
//encode numbers
$logged_userid = $this->common_model->logged_user_data->id;
			
$ec_orders_id =  $this->common_model->decode_id($ec_orders_id,$logged_userid);
$payment_method_id =  $this->common_model->decode_id($payment_method_id,$logged_userid);

//encode numbers	
		

        $data['payment_method_array'] = $payment_method_array = $this->common_model->GetPaymentMethodFormArray($ec_orders_id, $payment_method_id);

        $data['payment_method_row'] = $payment_method_row = $this->common_model->GetByRow('ec_payment_method', $payment_method_id, 'id');
		
		
		
        //$data['ec_orders_row'] = $ec_orders_row = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');
		
		$this->db->where('id',$ec_orders_id);
		$this->db->where('user_id',$logged_userid);
		$data['ec_orders_row'] = $ec_orders_row = $this->db->get('ec_orders')->row();
		
		if(!$data['ec_orders_row'])
		{
			redirect('');
		}
		
		if($ec_orders_row)
		{
			if($ec_orders_row->payment_status != "2")
			{ 
			redirect('');
			}
		}



        $paymentparams = array();
        foreach ($payment_method_array['attributes'] as $payment_method_attributes_row) {
            $paymentparams = $this->common_model->array_push_assoc($paymentparams, $payment_method_attributes_row['key'], $payment_method_attributes_row['value']);
        }


//dump($paymentparams);
        $data['payment_parameter_values'] = $payment_parameter_values = array_values($paymentparams);
//dump($payment_parameter_values[1]);



$tabledata1 = array(
'payment_method_array' => json_encode($payment_method_array),
);

$this->db->where('id', $ec_orders_id);

$this->db->update('ec_orders', $tabledata1);



        if ($payment_method_row->redirect_page == 'internal') {

			//{oldoption}
           // $data['options'] = $this->common_model->get_options();
            //$data['option'] = $data['options'][0];
			//{oldoption}
			
			$data['option'] = $this->common_model->get_options();
			
//            $data['option_header'] = $this->index_model->option_header();
//            $data['option_footer'] = $this->index_model->option_footer();
            $page_type = 'payment';
            $data['page_details'] = $this->common_model->GetByFixedPageType('cms_pages', $page_type, 'fixed_type');
            $data['page_id'] = $data['page_details']->id;
            $this->common_model->CheckPageSecure($data['page_id']);

            /*             * **************Payment Gateway Data**************** */



            /*    $paymentparams = array(
              'tid' => $transactionIDval,
              'merchant_id' => $Merchant_Id,
              'order_id' => $Order_Id,
              'amount' => $Amount,
              'currency' => $currency,
              'redirect_url' => $Redirect_Url,
              'cancel_url' => $Redirect_Url,
              'language' => $language,
              'billing_name' => $ship_name,
              'billing_address' => $ship_address,
              'billing_city' => $ship_city,
              'billing_state' => $ship_state,
              'billing_zip' => $ship_zipcode,
              'billing_country' => $ship_country,
              'billing_tel' => $ship_phone,
              'billing_email' => $ship_email,
              'delivery_name' => $ship_name,
              'delivery_address' => $ship_address,
              'delivery_city' => $ship_city,
              'delivery_state' => $ship_state,
              'delivery_zip' => $ship_zipcode,
              'delivery_country' => $ship_country,
              'delivery_tel' => $ship_phone,
              'merchant_param1' => '',
              'merchant_param2' => '',
              'merchant_param3' => '',
              'merchant_param4' => '',
              'merchant_param5' => '',
              'promo_code' => '',
              'customer_identifier' => '',
              'integration_type' => 'iframe_normal',
              ); */






            if ($payment_method_row->payment_type == 'Ccavanue') {
                $merchant_data = '';



                foreach ($paymentparams as $key => $value) {

                    $merchant_data .= $key . '=' . $value . '&';
                }



                $encrypted_data = $this->common_model->encrypt($merchant_data, $payment_parameter_values[1]);

// Method for encrypting the data.



                $production_url = 'https://' . $payment_method_array['payment_url'] . '/transaction/transaction.do?command=initiateTransaction&encRequest=' . $encrypted_data . '&access_code=' . $payment_parameter_values[2];
            } else {

                $production_url = $payment_method_array['payment_url'];
            }



            $data['paymentparams'] = $paymentparams;


            $data['action'] = $production_url;



            /*             * **************Payment Gateway Data**************** */









            $this->template->load('master', 'index/featured_view', $data);
        } else if ($payment_method_row->redirect_page == 'external') {

			
			if ($payment_method_row->payment_type == 'Ccavanue3') {
				
                $merchant_data = '';



                foreach ($paymentparams as $key => $value) {

                    $merchant_data .= $key . '=' . $value . '&';
                }



                $encrypted_data = $this->common_model->encrypt($merchant_data, $payment_parameter_values[1]);

// Method for encrypting the data.

$data['encRequest'] = $encrypted_data;


$production_url = $payment_method_array['payment_url'];
            $data['paymentparams'] = $paymentparams;
            $data['action'] = $production_url;
            $this->load->view('payment/paymentform', $data);
               
            }
			else if ($payment_method_row->payment_type == 'worldpay') {
				redirect('paymentoption/worldpay/'.$ec_orders_id);
			}
			else if ($payment_method_row->payment_type == 'NGenius')
			{
			//
			
$apikey = $paymentparams['apikey'];
$outlet = $paymentparams['outlet'];  


$ngenius_parameters = array();

$amount_function_array = array();
$merchantAttributes_function_array = array();
$billingAddress_function_array = array();
$shippingAddress_function_array = array();

foreach($paymentparams as $ngenius_param_key=>$ngenius_param_value)
{

if($ngenius_param_key != 'apikey' && $ngenius_param_key != 'outlet')
{
//	
$ngenius_param_value_dot_split = explode('.',$ngenius_param_key);


if(count($ngenius_param_value_dot_split) > 1)
{

$ngenius_param_split_key = $ngenius_param_value_dot_split[1];	
	

if($ngenius_param_value_dot_split[0] == 'amount')
{
$amount_function_array[$ngenius_param_split_key] = $ngenius_param_value;	

}
else
if($ngenius_param_value_dot_split[0] == 'merchantAttributes')
{
$merchantAttributes_function_array[$ngenius_param_split_key] = $ngenius_param_value;		
}
else
if($ngenius_param_value_dot_split[0] == 'billingAddress')
{
$billingAddress_function_array[$ngenius_param_split_key] = $ngenius_param_value;		
}
else
if($ngenius_param_value_dot_split[0] == 'shippingAddress')
{
$shippingAddress_function_array[$ngenius_param_split_key] = $ngenius_param_value;		
}
	
	
}
else
{
$ngenius_parameters[$ngenius_param_key]	 = $ngenius_param_value;
}


	
//	
}
	
	
}


$ngenius_parameters['amount'] = $amount_function_array;
$ngenius_parameters['merchantAttributes'] = $merchantAttributes_function_array;
$ngenius_parameters['billingAddress'] = $billingAddress_function_array;
$ngenius_parameters['shippingAddress'] = $shippingAddress_function_array;

//place order

$apikey = $apikey;     // enter your API key here
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://api-gateway.sandbox.ngenius-payments.com/identity/auth/access-token"); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "accept: application/vnd.ni-identity.v1+json",
    "authorization: Basic ".$apikey,
    "content-type: application/vnd.ni-identity.v1+json",
	)
  ); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS,  ""); 
$output = json_decode(curl_exec($ch)); 
$access_token = $output->access_token;


//

$outlet = $outlet;
$token = $access_token;

//
$payment_parameter_json = json_encode($ngenius_parameters);
$ch = curl_init(); 
 
curl_setopt($ch, CURLOPT_URL, "https://api-gateway.sandbox.ngenius-payments.com/transactions/outlets/".$outlet."/orders"); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer ".$token, 
    "Content-Type: application/vnd.ni-payment.v2+json", 
    "Accept: application/vnd.ni-payment.v2+json")); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $payment_parameter_json); 
 
$output = json_decode(curl_exec($ch)); 
$order_reference = $output->reference; 
$order_paypage_url = $output->_links->payment->href; 

curl_close ($ch);

$payment_extra_data = array();
if(!empty($ec_orders_row->payment_extra_data))
{
$payment_extra_data = json_decode($ec_orders_row->payment_extra_data,TRUE);	
}

$payment_extra_data['placeorder'] = array(
'data' =>json_encode($output),
'datetime' => date('Y-m-d H:i:s'),
);



$tabledata = array(
'payment_extra_data' => json_encode($payment_extra_data),
'order_reference' => $order_reference,
);

$this->db->where('id', $ec_orders_id);

$this->db->update('ec_orders', $tabledata);


redirect($order_paypage_url);
 


//place order				
				
			//			
			}
			else if ($payment_method_row->payment_type == 'Razorpay')
			{
				
			//redirect('razorpay/'.$ec_orders_id);	
			
$ec_orders_row = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');
//dump($ec_orders_row);

        $billing_address = json_decode($ec_orders_row->billing_address, TRUE);
        $shipping_address = json_decode($ec_orders_row->shipping_address, TRUE);

			//
			
$keyId  = $paymentparams['key'];
$keySecret  = $paymentparams['keysecret'];
$displayCurrency  = $paymentparams['currency'];
$payment_capture  = $paymentparams['payment_capture'];

$api = new Api($keyId, $keySecret);


//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => $ec_orders_id,
    'amount'          => $ec_orders_row->amount * 100, // 2000 rupees in paise
    'currency'        => $displayCurrency,
    'payment_capture' => $payment_capture // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrder_array = (array) $razorpayOrder;
$razorpayOrder_array = current($razorpayOrder);

//

$tabledata = array(
'payment_order_create' => json_encode($razorpayOrder_array),
'order_reference' => $razorpayOrder['id'],
);

$this->db->where('id', $ec_orders_id);
$this->db->update('ec_orders', $tabledata);


//

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $paymentparams['name'],
    "description"       => $paymentparams['description'],
    "image"             => base_url().$paymentparams['image'],
    "prefill"           => [
    "name"              => $billing_address['frm_first_name'].' '.$billing_address['frm_last_name'],
    "email"             => $billing_address['frm_email'],
    "contact"           => $billing_address['frm_phoneno'],
    ],
    "notes"             => [
    "address"           => $billing_address['frm_address'],
    "merchant_order_id" => $ec_orders_id,
    ],
    "theme"             => [
    "color"             => $paymentparams['color']
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
$data['json'] = $json;
$data['razorpay_myorderid'] = $ec_orders_id;


$this->load->view('payment/razorpayform', $data);
			
			
			//
				
			}
			else if ($payment_method_row->payment_type == 'CBKPG-KNET' || $payment_method_row->payment_type == 'CBKPG-TPay')
			{
//error_reporting(-1);
//access token


		$ClientId = $paymentparams['ClientId'];
		$ClientSecret = $paymentparams['ClientSecret'];
		$ENCRP_KEY = $paymentparams['ENCRP_KEY'];
		$URL = $payment_method_array['payment_url'];
	 
		$postfield = array("ClientId" => $ClientId,
				"ClientSecret" => $ClientSecret,
				"ENCRP_KEY" => $ENCRP_KEY);
        
        $curl = curl_init();

		 curl_setopt_array($curl, array(
					CURLOPT_URL =>  $URL ."/ePay/api/cbk/online/pg/merchant/Authenticate",
					CURLOPT_ENCODING => "",
					CURLOPT_FOLLOWLOCATION => 1,
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_SSL_VERIFYHOST=>0,
					CURLOPT_SSL_VERIFYPEER=>0,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2TLS,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_RETURNTRANSFER => 1,
					CURLOPT_FRESH_CONNECT => true,
					CURLOPT_POSTFIELDS => json_encode($postfield),
					CURLOPT_HTTPHEADER => array(
						'Authorization: Basic ' . base64_encode($ClientId. ":" . $ClientSecret),
						"Content-Type: application/json",
						"cache-control: no-cache"
					),
				));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
  

    
        
        $authenticateData = json_decode($response);
           
		$payment_accessToken = '';    
        if ($authenticateData->Status == "1") {
		//save access token till expiry
            $payment_accessToken  = $authenticateData->AccessToken;
        } 


//access token	


//payment

//
$udf1 = '';
$udf2 = '';
$udf3 = '';
$udf4 = '';
$udf5 = '';
$tij_MerchPayType = $paymentparams['tij_MerchPayType'];
$tij_MerchantPaymentLang = $paymentparams['tij_MerchantPaymentLang'];
$tij_MerchReturnUrl = $paymentparams['tij_MerchReturnUrl'];
$tij_MerchantPaymentTrack = $paymentparams['tij_MerchantPaymentTrack'];
$tij_MerchantPaymentRef = $paymentparams['tij_MerchantPaymentRef'];
$tij_MerchantPaymentAmount = $paymentparams['tij_MerchantPaymentAmount'];
$tij_MerchantPaymentCurrency = $paymentparams['tij_MerchantPaymentCurrency'];


//		
		
	 
        //get access token 
        if ($payment_accessToken) {
            //generate pg page 
            $formData = array(
                'tij_MerchantEncryptCode' => $ENCRP_KEY,
                'tij_MerchAuthKeyApi' => $payment_accessToken,
                'tij_MerchantPaymentLang' => $tij_MerchantPaymentLang,
                'tij_MerchantPaymentAmount' => $tij_MerchantPaymentAmount,
                'tij_MerchantPaymentTrack' => $tij_MerchantPaymentTrack,
                'tij_MerchantPaymentRef' => $tij_MerchantPaymentRef,
                'tij_MerchantUdf1' => $udf1,
                'tij_MerchantUdf2' => $udf2,
				'tij_MerchantUdf3' => $udf3,
				'tij_MerchantUdf4' => $udf4,
				'tij_MerchantUdf5' => $udf5,
                'tij_MerchPayType' => $tij_MerchPayType,
				'tij_MerchantPaymentCurrency' => $tij_MerchantPaymentCurrency,
				'tij_MerchReturnUrl' => $tij_MerchReturnUrl


            );
			
			
//

$payment_extra_data = array();
if(!empty($ec_orders_row->payment_extra_data))
{
$payment_extra_data = json_decode($ec_orders_row->payment_extra_data,TRUE);	
}

$payment_extra_data['placeorder'] = array(
'data' =>json_encode($formData),
'datetime' => date('Y-m-d H:i:s'),
);



$tabledata2 = array(
'payment_extra_data' => json_encode($payment_extra_data),
'order_reference' => $tij_MerchantPaymentTrack,
);

$this->db->where('id', $ec_orders_id);

$this->db->update('ec_orders', $tabledata2);


//
			
			
            $url = $URL."/ePay/pg/epay?_v=" . $payment_accessToken;
            $form = "<form id='pgForm' method='post' action='$url' enctype='application/x-www-form-urlencoded'>";
            foreach ($formData as $k => $v) {
                $form .= "<input type='hidden' name='$k' value='$v'>";
            }
            $form .= "</form><div style='position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%;text-align:center'>Redirecting to PG ... <br> <b> DO NOT REFRESH</b></div><script type='text/javascript'>
    document.getElementById('pgForm').submit();
</script>";
	

            echo  $form;
			
        } else {
           
        }
    



//payment
				
				
				
			}
			

            /*$production_url = $payment_method_array['payment_url'];
            $data['paymentparams'] = $paymentparams;
            $data['action'] = $production_url;
            $this->load->view('paymentform', $data);*/
			
        } else {
            
        }


        //dump($payment_method_array);
        //die();
    }

//ccavenue



    function payment_response($ec_orders_id, $paystatus = '') {
		
//encode numbers
$logged_userid = $this->common_model->logged_user_data->id;
			
$ec_orders_id =  $this->common_model->decode_id($ec_orders_id,$logged_userid);

//encode numbers	

        //

        $ec_orders_row = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');
        $payment_method_row = $this->common_model->GetByRow('ec_payment_method', $ec_orders_row->payment_method, 'id');
        $payment_form_data = json_decode($payment_method_row->payment_formdata, TRUE);

        if ($ec_orders_row->order_id > 0) {

            redirect('');
        } else {

            if ($payment_method_row->payment_type == 'Ccavanue' || $payment_method_row->payment_type == 'Ccavanue3') {

                error_reporting(0);



                $workingKey = $payment_form_data[1]["p_value"];  //Working Key should be provided here.

                $encResponse = $_POST["encResp"];   //This is the response sent by the CCAvenue Server

                $rcvdString = $this->common_model->decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.

                $order_status = "";

                $decryptValues = explode('&', $rcvdString);

                $dataSize = sizeof($decryptValues);



                $paymentresponsedata = json_encode($decryptValues);





                for ($i = 0; $i < $dataSize; $i++) {

                    $information = explode('=', $decryptValues[$i]);

                    if ($i == 3)
                        $order_status = $information[1];
                }



                if ($order_status === "Success") {

                    //echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";

                    $paymentresponsestatus = 'success';
                    $paymentstatus = '3';
                } else if ($order_status === "Aborted") {

                    //echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";

                    $paymentresponsestatus = 'aborted';
                    $paymentstatus = '5';
                } else if ($order_status === "Failure") {

                    //echo "<br>Thank you for shopping with us.However,the transaction has been declined.";



                    $paymentresponsestatus = 'declined';
                    $paymentstatus = '6';
                } else {

                    //echo "<br>Security Error. Illegal access detected";

                    $paymentresponsestatus = 'error';
                    $paymentstatus = '4';
                }
            } else if ($payment_method_row->payment_type == 'PayU') {


                $decryptValues = $_POST;
                $paymentresponsedata = json_encode($decryptValues);


                if ($paystatus == 'success') {
                    $paymentresponsestatus = 'success';
                    $paymentstatus = '3';
                } else {
                    $paymentresponsestatus = 'error';
                    $paymentstatus = '4';
                }
            } else if ($payment_method_row->payment_type == 'NGenius') {
				
			//
			
$payment_formdata=json_decode($payment_method_row->payment_formdata,TRUE);	
		
//get api
$api_key = array_search('apikey', array_filter(array_combine(array_keys($payment_formdata),array_column($payment_formdata, 'p_key'))));	

if ($api_key !== FALSE) {
$api_row = $payment_formdata[$api_key];	
$payment_api = $api_row['p_value'];
}
//get api


//get outlet
$outlet_key = array_search('outlet', array_filter(array_combine(array_keys($payment_formdata),array_column($payment_formdata, 'p_key'))));	

if ($outlet_key !== FALSE) {
$outlet_row = $payment_formdata[$outlet_key];	
$payment_outlet = $outlet_row['p_value'];
}
//get outlet


//response check


$apikey = $payment_api;     // enter your API key here
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://api-gateway.sandbox.ngenius-payments.com/identity/auth/access-token"); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "accept: application/vnd.ni-identity.v1+json",
    "authorization: Basic ".$apikey,
    "content-type: application/vnd.ni-identity.v1+json",
	)
  ); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS,  "{\"realmName\":\"ni\"}"); 
$output = json_decode(curl_exec($ch)); 
$access_token = $output->access_token;


//

$outlet = $payment_outlet;
$token = $access_token;
$order_reference = $ec_orders_row->order_reference;
 

$ch = curl_init(); 
 
curl_setopt($ch, CURLOPT_URL, "https://api-gateway.sandbox.ngenius-payments.com/transactions/outlets/".$outlet."/orders/".$order_reference); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer ".$token, 
    //"Content-Type: application/vnd.ni-payment.v2+json", 
    //"Accept: application/vnd.ni-payment.v2+json"
	
	)); 
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
//curl_setopt($ch, CURLOPT_POST, 1); 
//curl_setopt($ch, CURLOPT_POSTFIELDS, ''); 


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
$output = json_decode(curl_exec($ch)); 

$order_state = $output->_embedded->payment[0]->state;

curl_close ($ch);


//response check

$payment_extra_data = array();
if(!empty($ec_orders_row->payment_extra_data))
{
$payment_extra_data = json_decode($ec_orders_row->payment_extra_data,TRUE);	
}

$payment_extra_data['orderstatus'] = array(
'data' =>json_encode($output),
'datetime' => date('Y-m-d H:i:s'),
);



$tabledata = array(
'payment_extra_data' => json_encode($payment_extra_data),
'payment_status_state' => $order_state,
);

$this->db->where('id', $ec_orders_id);

$this->db->update('ec_orders', $tabledata);


if ($order_state == 'CAPTURED' || $order_state == 'AUTHORISED' || $order_state == 'PARTIALLY_CAPTURED') {
$paymentresponsestatus = 'success';
$paymentstatus = '3';
} else {
$paymentresponsestatus = 'error';
$paymentstatus = '4';
}
		

				
			//	
			}
			else if ($payment_method_row->payment_type == 'Razorpay') {
				
			 if($ec_orders_row->payment_status == '3')
			 {
					$paymentresponsestatus = 'success';
                    $paymentstatus = '3'; 
			 }
			 else
			 {
					$paymentresponsestatus = 'error';
                    $paymentstatus = '4'; 
			 }
			 
			 $paymentresponsedata = $ec_orders_row->payment_response;
			
				
			}
			else if ($payment_method_row->payment_type == 'CBKPG-KNET' || $payment_method_row->payment_type == 'CBKPG-TPay') {
				

$response_encrp = $_REQUEST['encrp'];
$paymentresponsedata = array();
				
				
				$payment_formdata=json_decode($payment_method_row->payment_formdata,TRUE);
				
//get ClientId
$api_key = array_search('ClientId', array_filter(array_combine(array_keys($payment_formdata),array_column($payment_formdata, 'p_key'))));	

if ($api_key !== FALSE) {
$api_row = $payment_formdata[$api_key];	
$ClientId = $api_row['p_value'];
}
//get ClientId

//get ClientId
$api_key = array_search('ClientSecret', array_filter(array_combine(array_keys($payment_formdata),array_column($payment_formdata, 'p_key'))));	

if ($api_key !== FALSE) {
$api_row = $payment_formdata[$api_key];	
$ClientSecret = $api_row['p_value'];
}
//get ClientId

//get ENCRP_KEY
$api_key = array_search('ENCRP_KEY', array_filter(array_combine(array_keys($payment_formdata),array_column($payment_formdata, 'p_key'))));	

if ($api_key !== FALSE) {
$api_row = $payment_formdata[$api_key];	
$ENCRP_KEY = $api_row['p_value'];
}
//get ClientId


$payment_url_data_array = json_decode($payment_method_row->payment_url_data,TRUE);		

$URL = $payment_url_data_array['payment_url'];


//access token

	 
		$postfield = array("ClientId" => $ClientId,
				"ClientSecret" => $ClientSecret,
				"ENCRP_KEY" => $ENCRP_KEY);
        
        $curl = curl_init();

		 curl_setopt_array($curl, array(
					CURLOPT_URL =>  $URL ."/ePay/api/cbk/online/pg/merchant/Authenticate",
					CURLOPT_ENCODING => "",
					CURLOPT_FOLLOWLOCATION => 1,
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_SSL_VERIFYHOST=>0,
					CURLOPT_SSL_VERIFYPEER=>0,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2TLS,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_RETURNTRANSFER => 1,
					CURLOPT_FRESH_CONNECT => true,
					CURLOPT_POSTFIELDS => json_encode($postfield),
					CURLOPT_HTTPHEADER => array(
						'Authorization: Basic ' . base64_encode($ClientId. ":" . $ClientSecret),
						"Content-Type: application/json",
						"cache-control: no-cache"
					),
				));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
  

    
        
        $authenticateData = json_decode($response);
           
		$payment_accessToken = '';    
        if ($authenticateData->Status == "1") {
		//save access token till expiry
            $payment_accessToken  = $authenticateData->AccessToken;
        } 


//access token	
				
	


        //returns the unencrypted data
        //get access token 
        if ($payment_accessToken) {
            $url = $URL."/ePay/api/cbk/online/pg/GetTransactions/" . $response_encrp . "/" . $payment_accessToken;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_ENCODING => "",
                CURLOPT_FOLLOWLOCATION => 1,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ' .base64_encode($ClientId. ":" . $ClientSecret),
                    "Content-Type: application/json",
                    "cache-control: no-cache"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

                
            $paymentDetails = json_decode($response);
			
			
$payment_extra_data = array();
if(!empty($ec_orders_row->payment_extra_data))
{
$payment_extra_data = json_decode($ec_orders_row->payment_extra_data,TRUE);	
}

$payment_extra_data['orderstatus'] = array(
'data' => $response,
'datetime' => date('Y-m-d H:i:s'),
);



$tabledata = array(
'payment_extra_data' => json_encode($payment_extra_data),
'payment_status_state' => $paymentDetails->Status,
);

$this->db->where('id', $ec_orders_id);

$this->db->update('ec_orders', $tabledata);


				$paymentresponsedata = json_decode($response,TRUE);
				$paymentresponsedata['encrp'] = $response_encrp;
				$paymentresponsedata = json_encode($paymentresponsedata);
			
			
			if($paymentDetails->Status != "0" or $paymentDetails->Status != "-1")
			{

				
				
				if($paymentDetails->Status == '1')
				 {
						$paymentresponsestatus = 'success';
						$paymentstatus = '3'; 
				 }
				 else
				 {
						$paymentresponsestatus = 'error';
						$paymentstatus = '4'; 
				 }
			 
			 
				
			}
            else 
			{
					$paymentresponsestatus = 'error';
                    $paymentstatus = '4'; 	
			}

       
        } else {
           
        }
    		
		
				
			}
			else if ($payment_method_row->payment_type == 'GiftCard') {

				$paymentresponsestatus = 'success';
                $paymentstatus = '3';
            }
			else if ($payment_method_row->payment_type == 'cod' || $payment_method_row->payment_type == 'cardod') {
				
				$paymentresponsestatus = 'success';
                $paymentstatus = '3';
            }





            $sms = 'no';
            $mail = 'no';

            if ($paymentstatus == '3') {
                $sms = 'yes';
                $mail = 'yes';
            }

            
            $order_status_parameter_array = array(
                'sms' => $sms,
                'mail' => $mail,
            );

            $this->common_model->UpdateOrderStatus($paymentstatus, $ec_orders_id, $order_status_parameter_array);
            
            
            if ($paymentstatus == '3') {

                $this->common_model->update_newpurchase_order_id($ec_orders_id);
                $this->common_model->UpdatePurchasedProductQuantity($ec_orders_id);

                /* If Coupon is applied and to redeem the coupon with status */
                if ($ec_orders_row->coupon_applied == 'yes') {
                 
                    $couponstatus = $this->common_model->UpdateOrderAndCouponPaymentDetails($ec_orders_id);
                }


                $sms = 'yes';
                $mail = 'yes';
                $this->common_model->SendOrderMail($paymentstatus, $ec_orders_id);
                // $this->common_model->SendOrderSms($paymentstatus, $ec_orders_row);
                //triggermail
                //trigger sms
            }



            $tabledata = array(
                'payment_response' => $paymentresponsedata,
            );

            $this->db->where('id', $ec_orders_id);

            $this->db->update('ec_orders', $tabledata);


            $myorders = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');
//
            if ($myorders->payment_status == 3 ||
                    $myorders->payment_status == 7) {

                $this->session->set_flashdata('sms', "OK");
            }
           // redirect('order-result/' . $ec_orders_id);
		   
		   
//encode numbers			
$logged_userid = $this->common_model->logged_user_data->id;
			
$ec_orders_id_encrypt =  $this->common_model->encode_id($ec_orders_id,$logged_userid);

//encode numbers		   
		   
//	
   
//$result_page = $this->common_model->GetByRow('cms_pages', 'paymentresult' , 'fixed_type');
$this->common_model->RemoveCustomerproductbox_by_type('cart');
$this->cart->destroy();					
		
if ($myorders->payment_status == 3 ||
$myorders->payment_status == 7) {

$result_page = $this->common_model->GetByRow('cms_pages', 'paymentsuccess' , 'fixed_type');	

}
else
{
$result_page = $this->common_model->GetByRow('cms_pages', 'paymentfailed' , 'fixed_type');		
}


$page_key = $result_page->option_url_key;
	
$page_link_data=$this->common_model->getCommonContentHrefLink($page_key);

$base_url = $this->common_model->getPageSecuredata('common','return');

redirect($page_link_data['url'].'?order='.$ec_orders_id_encrypt);

//




            //
        }
    }

    function ccavenue($ec_orders_id) {
        //
//start
//billing_address
//shipping_address

        $this->db->where('id', $ec_orders_id);

        $order_details = $this->db->get('ec_orders')->row();

//        $user_details = $this->ion_auth->user()->row();	

        $shipping_address = $order_details->shipping_address;

        $shipping_address = json_decode($shipping_address);

//print_r($shipping_address);

        /* print_r($user_details);

          echo '<br>';

          echo '<br>';

          echo '<br>';

          print_r($shipping_address); */

        $ship_email = $shipping_address->frm_email;

        $ship_first_name = $shipping_address->frm_first_name;

        $ship_last_name = $shipping_address->frm_last_name;

        $ship_name = $ship_first_name;

        if ($ship_last_name != '') {

            $ship_name = $ship_name . ' ' . $ship_last_name;
        }

        $ship_phone = $shipping_address->frm_phoneno;

        $ship_zipcode = $shipping_address->frm_pincode;

        $ship_locality = $shipping_address->frm_locality;

        $ship_address = $shipping_address->frm_address;

        //$ship_city = $shipping_address->frm_city;

        //$ship_state = $shipping_address->frm_state;
		

//city
$ship_city=$shipping_address->frm_city;
		
/* $ship_city = trim($ship_city);	
if (is_numeric($ship_city)) {
$city_id = $ship_city;
$city_row = $this->common_model->GetByRow('cms_locations', $city_id, 'id');
$ship_city = $city_row->location;
}/**/
//city


//state
$ship_state=$shipping_address->frm_state;
		
/* $ship_state = trim($ship_state);
if(is_numeric($ship_state)){
$state_id=$ship_state;
$state_row = $this->common_model->GetByRow('cms_locations', $state_id, 'id');
$ship_state=$state_row->location;
}/**/
//state		
		
        $ship_country = $shipping_address->frm_country;

        $ship_landmark = $shipping_address->frm_landmark;

        $ship_alt_phone = $shipping_address->frm_alt_phone;

        $ship_delivery_type = $shipping_address->frm_delivery_type;

        $Amount = round($order_details->amount);
        //$Amount = 1;

        $Order_Id = 'GLTTMPODR' . $ec_orders_id;
		
        $Redirect_Url = base_url() . 'paymentoption/ccavenuepaymentresponse/' . $ec_orders_id;

        $Merchant_Id = "1608906";

        $working_key = "90A5F876C3ACCB1033EE5A47B30094B0";

        $access_code = "AVWH56JK38AF72HWFA";

        $tid = hash('sha256', uniqid(mt_rand(), true) . "somesalt" . strtolower($Order_Id));

//        $currency = $this->common_model->current_currency();
        $currency = 'USD';

        $language = 'EN';

        $transactionIDval = rand(1, 10000);

        $tabledata = array(
            'tid' => $transactionIDval,
        );

        $this->db->where('id', $ec_orders_id);

        $this->db->update('ec_orders', $tabledata);

        $paymentparams = array(
            'tid' => $transactionIDval,
            'merchant_id' => $Merchant_Id,
            'order_id' => $Order_Id,
            'amount' => $Amount,
            'currency' => $currency,
            'redirect_url' => $Redirect_Url,
            'cancel_url' => $Redirect_Url,
            'language' => $language,
            'billing_name' => $ship_name,
            'billing_address' => $ship_address,
            'billing_city' => $ship_city,
            'billing_state' => $ship_state,
            'billing_zip' => $ship_zipcode,
            'billing_country' => $ship_country,
            'billing_tel' => $ship_phone,
            'billing_email' => $ship_email,
            'delivery_name' => $ship_name,
            'delivery_address' => $ship_address,
            'delivery_city' => $ship_city,
            'delivery_state' => $ship_state,
            'delivery_zip' => $ship_zipcode,
            'delivery_country' => $ship_country,
            'delivery_tel' => $ship_phone,
            'merchant_param1' => '',
            'merchant_param2' => '',
            'merchant_param3' => '',
            'merchant_param4' => '',
            'merchant_param5' => '',
            'promo_code' => '',
            'customer_identifier' => '',
            'integration_type' => 'iframe_normal',
        );

        $merchant_data = '';

        foreach ($paymentparams as $key => $value) {

            $merchant_data .= $key . '=' . $value . '&';
        }

        $encrypted_data = $this->common_model->encrypt($merchant_data, $working_key);

// Method for encrypting the data.

        $production_url = 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest=' . $encrypted_data . '&access_code=' . $access_code;
       
//        $production_url = 'https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest=' . $encrypted_data . '&access_code=' . $access_code;

        $data['paymentparams'] = $paymentparams;

        $data['type'] = 'CCAvenue';

        $data['tableid'] = $ec_orders_id;

        $data['action'] = $production_url;

        $this->load->view('payment/paymentform', $data);
    }	
	
function worldpay($ec_orders_id)
{
	
	//
	
	
$this->load->library('merchant');

$this->merchant->load('worldpay');


$settings = array(

    'installation_id' => '',

    'secret' => '',

    'payment_response_password' => '',

    'test_mode' => false);

	

$this->merchant->initialize($settings);


//error_reporting(-1);


//start
//billing_address
//shipping_address

$this->db->where('id',$ec_orders_id);
$order_details = $this->db->get('ec_orders')->row();

$user_details = $this->ion_auth->user()->row();	

$shipping_address = $order_details->shipping_address;
$shipping_address = json_decode($shipping_address);

//print_r($shipping_address);

/*print_r($user_details);
echo '<br>';
echo '<br>';
echo '<br>';
print_r($shipping_address);*/


$ship_email=$user_details->email;

$ship_phone=$shipping_address->frm_phoneno;

$ship_name=$shipping_address->frm_first_name;

$ship_country='UK';

//$ship_state=$shipping_address->frm_state;

//state
$ship_state=$shipping_address->frm_state;
		
$ship_state = trim($ship_state);
if(is_numeric($ship_state)){
$state_id=$ship_state;
$state_row = $this->common_model->GetByRow('cms_locations', $state_id, 'id');
$ship_state=$state_row->location;
}
//state

$ship_zipcode=$shipping_address->frm_pincode;

//$ship_city=$shipping_address->frm_city;

//city
$ship_city=$shipping_address->frm_city;
		
$ship_city = trim($ship_city);	
if (is_numeric($ship_city)) {
$city_id = $ship_city;
$city_row = $this->common_model->GetByRow('cms_locations', $city_id, 'id');
$ship_city = $city_row->location;
}
//city

$ship_address1=$shipping_address->frm_locality.', '.$shipping_address->frm_address;

$ship_address2=$shipping_address->frm_landmark;

$finalgrandtotal = $order_details->amount;


$params = array(



        'installation_id' => '',

		'order_id' => ''.$ec_orders_id,

		'pid' => $ec_orders_id,

		'ptype' => 'product',

		'description' => 'product',

		'amount' => $finalgrandtotal,

		'currency' => 'GBP',

		'test_mode' => '0',

		'return_url' => base_url().'paymentoption/paymentsreturn',

		'name' => $ship_name,

		'address1' => $ship_address1,

		'address2' => $ship_address2,

		'city' => $ship_city,

		'region' => $ship_state,

		'postcode' => $ship_zipcode,

		'country' => $ship_country,

		'phone' => $ship_phone,

		'email' => $ship_email

		

		);

//print_r($params);

$response = $this->merchant->purchase($params);

	
	
	
	
}



function paymentsreturn()

{

//error_reporting(-1);	


$this->load->library('merchant');

$this->merchant->load('worldpay');


$settings = array(

    'installation_id' => '',

    'secret' => '',

    'payment_response_password' => '',

    'test_mode' => false);

	

$this->merchant->initialize($settings);	



//$response = $this->merchant->purchase_return();



//print_r($response);

	//echo $transaction_id = $this->input->post('transId');

		//	echo $amount = $this->input->post('authAmount');

		

$resut_data=$_POST;

//print_r($_POST);

$ptype=$_POST['MC_ptype'];

$ec_orders_id=$_POST['MC_pid'];

$all_return_values = json_encode($resut_data);

$paymentresponsedata = $all_return_values;

$ec_orders_row = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');


if ($ec_orders_row->order_id > 0) {

echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.base_url().'">';

} 
else 
{


	if ($resut_data['transStatus']=='Y')
	{	


//echo 'success';


$paymentresponsestatus = 'success';
$paymentstatus = '3';

		
//

//echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.base_url().'payment-response/'.$pid.'">';

//echo 'success';

//		
				
		
	}
	else
	{

//echo 'failed';
	
	
$paymentresponsestatus = 'declined';
$paymentstatus = '6';
	
		
//

//echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.base_url().'payment-response/'.$pid.'">';

//echo 'Failed';

//			
		
	}
	


//start



//need to remove

//$paymentresponsestatus = 'success';
//$paymentstatus = '3';

//need to remove



            $sms = 'no';
            $mail = 'no';

            if ($paymentstatus == '3') {
                $sms = 'yes';
                $mail = 'yes';
            }

            
            $order_status_parameter_array = array(
                'sms' => $sms,
                'mail' => $mail,
            );

            $this->common_model->UpdateOrderStatus($paymentstatus, $ec_orders_id, $order_status_parameter_array);
            
            
            if ($paymentstatus == '3') {

                $this->common_model->update_newpurchase_order_id($ec_orders_id);
                //$this->common_model->UpdatePurchasedProductQuantity($ec_orders_id);

                /* If Coupon is applied and to redeem the coupon with status */
                if ($ec_orders_row->coupon_applied == 'yes') {
                 
                    $couponstatus = $this->common_model->UpdateOrderAndCouponPaymentDetails($ec_orders_id);
                }


                $sms = 'yes';
                $mail = 'yes';
                $this->common_model->SendOrderMail($paymentstatus, $ec_orders_id);
                // $this->common_model->SendOrderSms($paymentstatus, $ec_orders_row);
                //triggermail
                //trigger sms
            }



            $tabledata = array(
                'payment_response' => $paymentresponsedata,
            );

            $this->db->where('id', $ec_orders_id);

            $this->db->update('ec_orders', $tabledata);


            $myorders = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');
//
            if ($myorders->payment_status == 3 ||
                    $myorders->payment_status == 7) {

                //$this->session->set_flashdata('sms', "OK");
            }
            //redirect('order-result/' . $ec_orders_id);

			echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL='.base_url().'order-result-page?order='.$ec_orders_id.'">';



            //




//	end
	
	
	
}

	

}	
	

function razorpay()
{
//

error_reporting(-1);

$keyId  = '';
$keySecret  = '';
$displayCurrency  = 'INR';

$api = new Api($keyId, $keySecret);


//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => 3456,
    'amount'          => 2000 * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "DJ Tiesto",
    "description"       => "Tron Legacy",
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill"           => [
    "name"              => "Daft Punk",
    "email"             => "customer@merchant.com",
    "contact"           => "9999999999",
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
$data['json'] = $json;


$this->load->view('payment/razorpayform', $data);


//
}


function razorpayverify()
{

$ec_orders_id = $_POST['razorpay_myorderid'];

$ec_orders_row = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');
$payment_method_row = $this->common_model->GetByRow('ec_payment_method', $ec_orders_row->payment_method, 'id');
		

$payment_formdata=json_decode($payment_method_row->payment_formdata,TRUE);
				
//get key
$api_key = array_search('key', array_filter(array_combine(array_keys($payment_formdata),array_column($payment_formdata, 'p_key'))));	

if ($api_key !== FALSE) {
$api_row = $payment_formdata[$api_key];	
$keyId = $api_row['p_value'];
}
//get key

//get keysecret
$api_key = array_search('keysecret', array_filter(array_combine(array_keys($payment_formdata),array_column($payment_formdata, 'p_key'))));	

if ($api_key !== FALSE) {
$api_row = $payment_formdata[$api_key];	
$keySecret = $api_row['p_value'];
}
//get keysecret

//get currency
$api_key = array_search('currency', array_filter(array_combine(array_keys($payment_formdata),array_column($payment_formdata, 'p_key'))));	

if ($api_key !== FALSE) {
$api_row = $payment_formdata[$api_key];	
$displayCurrency = $api_row['p_value'];
}
//get currency



	$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{

$ec_orders_id = $_POST['razorpay_myorderid'];	

$paymentresponsedata = $_POST;
$paymentresponsedata = json_encode($paymentresponsedata);

$paymentresponsestatus = 'success';
$paymentstatus = '3';

$tabledata = array(
'payment_response' => $paymentresponsedata,
'payment_status' => $paymentstatus,
);

$this->db->where('id', $ec_orders_id);

$this->db->update('ec_orders', $tabledata);


	
    //$html = "<p>Your payment was successful</p>
          //   <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
}
else
{
	
$ec_orders_id = $_POST['razorpay_myorderid'];	

$paymentresponsedata = $_POST;
$paymentresponsedata = json_encode($paymentresponsedata);

$paymentresponsestatus = 'error';
$paymentstatus = '4';

$tabledata = array(
'payment_response' => $paymentresponsedata,
'payment_status' => $paymentstatus,
);

$this->db->where('id', $ec_orders_id);

$this->db->update('ec_orders', $tabledata);
	
    //$html = "<p>Your payment failed</p>
             //<p>{$error}</p>";
			 
			 
}

redirect('payment-response/' . $ec_orders_id);
}
	
	

function razorpaycancel()
{
	
$ec_orders_id = $_GET['pid'];	
$ec_orders_row = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');

if($ec_orders_row->order_id == 0)
{
$this->common_model->RemoveCustomerproductbox_by_type('cart');
$this->cart->destroy();	

$paymentstatus = '4';

//
$tabledata = array(
'payment_status' => $paymentstatus,
);

$this->db->where('id', $ec_orders_id);
$this->db->update('ec_orders', $tabledata);	
//

	
$result_page = $this->common_model->GetByRow('cms_pages', 'paymentfailed' , 'fixed_type');		

$page_key = $result_page->option_url_key;
	
$page_link_data=$this->common_model->getCommonContentHrefLink($page_key);

$base_url = $this->common_model->getPageSecuredata('common','return');

redirect($page_link_data['url'].'?order='.$ec_orders_id);

}
else
{
redirect('');
}
	
}


function razorpayfailed()
{

$ec_orders_id = $_POST['razorpay_myorderid'];	
$ec_orders_row = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');

if($ec_orders_row->order_id == 0)
{
$this->common_model->RemoveCustomerproductbox_by_type('cart');
$this->cart->destroy();	

$paymentstatus = '4';
$payment_response = json_encode($_POST);

//
$tabledata = array(
'payment_status' => $paymentstatus,
'payment_response ' => $payment_response,
);

$this->db->where('id', $ec_orders_id);
$this->db->update('ec_orders', $tabledata);	
//

	
$result_page = $this->common_model->GetByRow('cms_pages', 'paymentfailed' , 'fixed_type');		

$page_key = $result_page->option_url_key;
	
$page_link_data=$this->common_model->getCommonContentHrefLink($page_key);

$base_url = $this->common_model->getPageSecuredata('common','return');

echo $base_url.$page_link_data['url'].'?order='.$ec_orders_id;

}
else
{
echo base_url();
}


		
}
	
function do_payment_new($ec_orders_id){
    $data['web_title'] = "GL Infotech";
    
//    redirect('paymentoption/ccavenue/' . $ec_orders_id);
    redirect('paymentoption/paypal/' . $ec_orders_id);
}
	
function ccavenuepaymentresponse($ec_orders_id){
    
//        error_reporting(0);

        $workingKey = '90A5F876C3ACCB1033EE5A47B30094B0';  //Working Key should be provided here.

        $encResponse = $_POST["encResp"];   //This is the response sent by the CCAvenue Server

        $rcvdString = $this->common_model->decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.

        $order_status = "";

        $decryptValues = explode('&', $rcvdString);

        $dataSize = sizeof($decryptValues);

        $paymentresponsedata = json_encode($decryptValues);

        for ($i = 0; $i < $dataSize; $i++) {

            $information = explode('=', $decryptValues[$i]);

            if ($i == 3)
                $order_status = $information[1];
        }

        if ($order_status === "Success") {

            //echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";

            $paymentresponsestatus = 'success';
        } else if ($order_status === "Aborted") {

            //echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";

            $paymentresponsestatus = 'aborted';
        } else if ($order_status === "Failure") {

            //echo "<br>Thank you for shopping with us.However,the transaction has been declined.";

            $paymentresponsestatus = 'declined';
        } else {

            //echo "<br>Security Error. Illegal access detected";

            $paymentresponsestatus = 'error';
        }
//

        $ec_orders_id = $ec_orders_id;

        $paymentstatus = '1';
		
		$new_order_id = 0;
		$new_invoice_id = 0;

        if ($paymentresponsestatus == 'success') {

            $paymentstatus = '2';	
			//
		
		$this->db->select_max('order_id');
        $max_order_id = $this->db->get('ec_orders')->row();
        $new_order_id = $max_order_id->order_id + 1;
		
		$this->db->select_max('invoice_id');
        $max_invoice_id = $this->db->get('ec_orders')->row();
        $new_invoice_id = $max_invoice_id->invoice_id + 1;				
			//
						
        } else

        if ($paymentresponsestatus == 'aborted') {

            $paymentstatus = '6';
        } else

        if ($paymentresponsestatus == 'declined') {

            $paymentstatus = '4';
        } else

        if ($paymentresponsestatus == 'error') {

            $paymentstatus = '5';
        }

        $tabledata = array(
            'payment_status' => $paymentstatus,
            'payment_response' => $paymentresponsedata,
			
			'order_id' => $new_order_id,
			'invoice_id' => $new_invoice_id,
        );

        $this->db->where('id', $ec_orders_id);

        $this->db->update('ec_orders', $tabledata);

        redirect('payment-response/' . $ec_orders_id);

}

function paypal($ec_orders_id){
    if($ec_orders_id != ""){
        $data['ec_orders_id'] = $ec_orders_id;
        $data['ec_orders_row'] = $ec_orders_row = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');
        $data['ec_orders_list_row'] = $ec_orders_list_row = $this->common_model->GetByRow('ec_order_list', $ec_orders_id, 'ec_orders_id');
        $data['product_row'] = $product_row = $this->common_model->GetByRow('ec_products', $ec_orders_list_row->product_id, 'id');

        $this->load->view('index/paypal_payform', $data);
    } else {
        redirect('');
    }    
}

function paypal_success($ec_orders_id){
        $paymentstatus = '2';
        
    /**/$item_number = $_GET['item_number']; 
        $txn_id = $_GET['tx'];
        $payment_gross = $_GET['amt'];
        $currency_code = $_GET['cc'];
        $payment_status = $_GET['st'];/**/
        
        $paymentId = $_GET['paymentId']; 
        $PayerID = $_GET['PayerID'];
        $token = $_GET['token'];
        $RESPMSG = $_GET['RESPMSG'];
        
       /* $item_number = $_POST['item_number']; 
        $txn_id = $_POST['txn_id'];
        $payment_gross = $_POST['mc_gross'];
        $currency_code = $_POST['mc_currency'];
        $payment_status = $_POST['payment_status'];/**/
        
        $payment_gateway_data = $paymentId.'**'.$PayerID.'**'.$token.'**'.$RESPMSG.'+++'.$item_number.'**'.$txn_id.'**'.$payment_gross.'**'.$currency_code.'**'.$payment_status;

        $this->db->select_max('order_id');
        $max_order_id = $this->db->get('ec_orders')->row();
        $new_order_id = $max_order_id->order_id + 1;

        $this->db->select_max('invoice_id');
        $max_invoice_id = $this->db->get('ec_orders')->row();
        $new_invoice_id = $max_invoice_id->invoice_id + 1;
        
        if(empty($PayerID)){
            $paymentstatus = "0";
            
            $tabledata = array(
                'payment_status' => $paymentstatus,
                'payment_gateway_data' => $payment_gateway_data
            );
        } else {
           $tabledata = array(
                'payment_status' => $paymentstatus,
                'payment_response' => $txn_id,
                'order_id' => $new_order_id,
                'invoice_id' => $new_invoice_id,
                'payment_gateway_data' => $payment_gateway_data
            ); 
        }      
             
        $this->db->where('id', $ec_orders_id);

        $this->db->update('ec_orders', $tabledata);

        redirect('payment-response/' . $ec_orders_id);
    }
    
    function paypal_cancel($ec_orders_id){
        $paymentstatus = '6';
                
        $paymentId = $_GET['paymentId']; 
        $PayerID = $_GET['PayerID'];
        $token = $_GET['token'];
        $RESPMSG = $_GET['RESPMSG'];
        
        $payment_gateway_data = $paymentId.'**'.$PayerID.'**'.$token.'**'.$RESPMSG;
        
        $tabledata = array(
            'payment_status' => $paymentstatus,
            'payment_gateway_data' => $payment_gateway_data
        );
        
        $this->db->where('id', $ec_orders_id);

        $this->db->update('ec_orders', $tabledata);

        redirect('payment-response/' . $ec_orders_id);
    }	

}
