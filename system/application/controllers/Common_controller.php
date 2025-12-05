<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_controller extends CI_Controller {

    var $data = '';
    var $beadData1 = array();
    var $valc = 0;
    var $ar = array();
    var $currency; //Create a variable for the entire controller

    public function __construct() {
        parent::__construct();

       // $this->load->helper('translate');
        $this->load->helper('cookie');
        //$this->load->helper('urlhelper');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('encryption'); 
        $this->load->library('ion_auth');
        $this->load->library('cart');
        $this->load->model('index_model');
        $this->load->model('cart_model');
        $this->load->model('common_model');
        $this->load->model('uploadlibrary_model');

        // session_start();
        error_reporting(0);
						
		$this->option = $this->common_model->option;		
        date_default_timezone_set('Asia/Calcutta');
        $this->form_validation->set_error_delimiters('', '');       
    }

    function index(){
    }

    function totalcartcount() {
        echo $this->cart->total_items();
    }

    function get_product($pid) {
        $product_detail = $this->index_model->GetByRow('ec_products', $pid, 'id');
        echo json_encode($product_detail);
    }

    function emptycompare() {
        $this->index_model->empty_compare();
    }

    function total_cart_price() {

        $total_cart_price = $this->common_model->total_cart_price();
        echo number_format($total_cart_price, 2, '.', ',');
    }
    function total_cart_currency_convertion_price() {

        $total_cart_price = $this->common_model->total_cart_price();
                
        $gl_cart_session = $this->session->userdata('gl_cart');
        $currency_key = '';
        $gift_card_present = FALSE;
        if (!empty($gl_cart_session["currency"])) {
            $currency_key = $gl_cart_session["currency"];
        }
        
        $currency_detail = $this->common_model->get_currency_by_key($currency_key);
        $value = '1';$value = $currency_detail['value'];
        $total_cart_price = $total_cart_price / $value;
        
        $total_cart_price = number_format($total_cart_price, 2, '.', ',');
        $total_currency_cart_price_array = array('key'=>$currency_key, 'price'=>$total_cart_price); 
        $total_currency_cart_price = json_encode($total_currency_cart_price_array);
        
        echo $total_currency_cart_price;
    }

    function gl_remove_coupon() {

        $status = $this->common_model->gl_remove_coupon();
        echo $status;
    }

    function gl_delivery_cart_price() {
        $gl_delivery_charge = '0.00';
        echo $gl_delivery_charge;
    }

    function gl_cart_total_only_product_price() {

        $gl_cart_total_only_product_price = $this->common_model->gl_cart_total_only_product_price();
        echo number_format($gl_cart_total_only_product_price, 2, '.', ',');
    }

    function gl_cart_coupon_amount() {

        $gl_cart_coupon_amount = $this->common_model->gl_cart_coupon_amount();
        echo $gl_cart_coupon_amount;
    }

    function check_set_coupon_applied() {

        $gl_cart_session = $this->session->userdata('gl_cart');
        $coupon_status = FALSE;
        $gift_card_present = FALSE;
        if (isset($gl_cart_session["product_id_list"])) {
            $product_id_list = $gl_cart_session["product_id_list"];
            foreach ($product_id_list as $product_id) {
                $conditional_array = array(
                    'qty >' => '0',
                );
                $ec_products = $this->common_model->GetByRowOrFalse('ec_products', $product_id, 'id', $conditional_array);
                if ($ec_products != FALSE) {
                    if ($ec_products->product_categorytype_id == '24') {
                        $gift_card_present = TRUE;
                    }
                }
                if ($gift_card_present == TRUE) {
                    break;
                }
            }
        }
        if (isset($gl_cart_session['coupon_applied'])) {
            if ($gl_cart_session['coupon_applied'] == 'yes' && $gift_card_present == FALSE) {
                $coupon_detail = $this->common_model->GetByRowOrFalse('ec_coupon', $gl_cart_session['coupon_code'], 'coupon_code');
                if ($coupon_detail != FALSE) {
                    if ($coupon_detail->coupon_balance > 0) {
                        
                $total_cart_amount = $this->common_model->gl_cart_total_only_product_price();
                $balance_amount = $total_cart_amount - floatval($coupon_detail->coupon_balance);

                if ($balance_amount < 0) {

                    $coupon_remaining_balance = floatval(-1) * floatval($balance_amount);
                    $applied_amount = floatval($coupon_detail->coupon_balance) - floatval($coupon_remaining_balance);

                }else{
                    $coupon_remaining_balance = 0;
                    $applied_amount = floatval($coupon_detail->coupon_balance);
                } 
                        
                        $coupon_array = array(
                            'id' => $coupon_detail->id,
                            'coupon_code' => strtoupper($coupon_detail->coupon_code),
                            'coupon_amount' => number_format(($coupon_detail->coupon_amount), 2, '.', ','),
                            'coupon_balance' => number_format(($coupon_detail->coupon_balance), 2, '.', ','),
                             'coupon_applied_amount' => number_format(($applied_amount), 2, '.', ','),
                    'coupon_remaining_balance' => number_format(($coupon_remaining_balance), 2, '.', ','),
                    'removed_status' => '',
                            'status' => 'valid',
                        );
                        $gl_cart_session = $this->session->userdata('gl_cart');
                        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_applied', 'yes');
                        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_code', strtoupper($coupon_detail->coupon_code));
                        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_amount', number_format(($coupon_detail->coupon_amount), 2, '.', ','));
                        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_balance', number_format(($coupon_detail->coupon_balance), 2, '.', ','));
                        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_applied_amount', number_format(($applied_amount), 2, '.', ','));
                        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_remaining_balance', number_format(($coupon_remaining_balance), 2, '.', ','));
                        $this->session->set_userdata('gl_cart', $gl_cart_session);
                        $coupon_status = TRUE;
                        echo json_encode($coupon_array);
                    }
                }
            }
        }

        if ($coupon_status == FALSE) {
            $coupon_array = array(
                'status' => 'invalid',
                'removed_status' => '',
                'message' => '',
            );
            $gl_cart_session = $this->session->userdata('gl_cart');
            $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_applied', 'no');
            $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_code', '');
            $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_amount', '');
            $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_balance', '');
            $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_applied_amount', '');
            $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_remaining_balance', '');
            $this->session->set_userdata('gl_cart', $gl_cart_session);
            echo json_encode($coupon_array);
        }
    }

    function countwishlist() {
        echo $this->index_model->refresh_countlistByType('wishlist');
    }

    function countcompare() {
        echo $this->index_model->refresh_countlistByType('compare');
    }   
    
  function common_ec_actions(){ 
      $this->common_model->common_ec_action();  
    }    
	
}
