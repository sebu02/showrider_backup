<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    var $data = array();
    var $beadData1 = array();
    var $valc = 0;
    var $ar = array();
    var $currency; //Create a variable for the entire controller

    public function __construct() {

        parent::__construct();

        //$this->load->helper('translate');
        $this->load->helper('cookie');
        // $this->load->helper('urlhelper');
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
        $this->load->model('uploadlibrary_model');

        //session_start();
        // error_reporting(0);
  
        $this->form_validation->set_error_delimiters('', '');

    }

    /*
     * Function: check cart and insert to cart
    */

    public function addcart_detail() {

        $pid = $this->input->post('pid');

        $pro_qtys = $this->input->post('qty');

        $wizard_type = $this->input->post('wizard_type');

        if ($this->ion_auth->logged_in()) {

            $logged_user_data = $this->ion_auth->user()->row();	

            $username = $logged_user_data->username;

        } else {

            $username = session_id();

        }

        /* Product Details added to Cart */

        $product_detail = $this->common_model->GetByRow('ec_products', $pid, 'id');

        $product_images = $product_detail->prod_file;

        $pro_img = json_decode($product_images, true);

        $cart_qty = $pro_qtys;

        $data = array(

            'id' => $product_detail->id,

            'qty' => $pro_qtys,

            'price' => $product_detail->selling_price,

            'name' => '1',

            'pname' => $product_detail->prod_name,

            'pid' => $product_detail->id,

            'parent_sub_id' => $product_detail->parent_sub_id,

            'parent_main_id' => $product_detail->parent_main_id,

            'image' => $pro_img['image'],

            'ptype' => $product_detail->product_categorytype_id,

//            'wizard_option_id' => $product_detail->wizard_option_id,

        );

        $gl_cart_session = array();

        $product_id_list_session = array();

        if ($this->session->userdata('gl_cart') != FALSE) {

            $gl_cart_session = $this->session->userdata('gl_cart');

            //To add  product_id 'gl_cart_wizard_1'session  to  session

            if ($wizard_type == 'gl_cart_wizard_1') {

                $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'wizard_1_product_id', $pid);

            }

            if (isset($gl_cart_session['product_id_list'])) {

                $product_id_list_session = $gl_cart_session['product_id_list'];

                if (in_array($pid, $product_id_list_session)) {

                    //For updating the cart

                    $this->cart->insert($data);

                    echo '1';

                } else {

                    // To insert product into  existing 'product_id_list' array in the cart   

                    $this->add_product_id_list_to_session($product_id_list_session, $pid, $gl_cart_session);

                    $this->cart->insert($data);

                    echo '0';

                }

            } else {

                // To insert product into  fresh 'product_id_list' array in the cart    

                $this->add_product_id_list_to_session($product_id_list_session, $pid, $gl_cart_session);

                $this->cart->insert($data);

                echo '0';

            }

        } else {

            if ($wizard_type == 'gl_cart_wizard_1') {

                $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'wizard_1_product_id', $pid);

            }

            // To insert product into fresh 'product_id_list' array in the cart       

            $this->add_product_id_list_to_session($product_id_list_session, $pid, $gl_cart_session);

            $this->cart->insert($data);

            echo '0';

        }

    }

    public function add_product_id_list_to_session($product_id_list_session, $pid, $gl_cart_session) {

        //To push the 'product_id_list' to gl_cart

        //and set the session 'gl_cart'

        array_push($product_id_list_session, $pid);

        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'product_id_list', $product_id_list_session);

        $this->session->set_userdata('gl_cart', $gl_cart_session);

    }

    /*

     * EOF check cart and insert to cart

     */

    function totalcartcount() {

        echo $this->cart->total_items();

    }

    function total_cart_price() {

        echo $this->cart->total();

    }

    function get_product($pid) {

        $product_detail = $this->common_model->GetByRow('ec_products', $pid, 'id');

        echo json_encode($product_detail);

    }

    public function mycart() {

        $data['options'] = $this->common_model->get_options();

        $data['cart_items'] = $this->cart->total_items();

        $data['ci_cart_items'] = $this->cart->contents();

        $page_type = 'mycart';

        $this->common_model->update_cart_settings();

        $this->common_model->ShowPageByType($page_type, $data);

//        $data['options'] = $this->index_model->get_options();

//        $data['option'] = $data['options'][0];

//        $data['option_header'] = $this->index_model->option_header();

//        $data['option_footer'] = $this->index_model->option_footer();

//        $data['page_details'] = $this->index_model->GetByFixedPageType('cms_pages', 'mycart', 'fixed_type');

//        $data['page_id'] = $data['page_details']->id;

//        $data['cart_items'] = $this->cart->total_items();

//        $data['ci_cart_items'] = $this->cart->contents();

//        $this->template->load('master', 'index/featured_view', $data);

    }

    public function update_cart() {

        $row_id = $this->input->post('rowid');

        $qty = intval($this->input->post('qty'));

        $ci_cart_items = $this->cart->contents();

        $selected_product_id = $this->input->post('selected_product_id');

        if ($selected_product_id != FALSE) {

//     updating cart products For wizard1

            foreach ($ci_cart_items as $item) {

                if ($item['id'] == $selected_product_id) {

                    $row_id = $item['rowid'];

                    $prod_id = $selected_product_id;

                }

            }

        } else {

            if ($row_id != "0") {

                $prod_id = 0;

                foreach ($ci_cart_items as $item) {

                    if ($item['rowid'] == $row_id) {

                        $prod_id = $item['id'];

                    }

                }

            }

        }

        $data = array(

            'rowid' => $row_id,

            'qty' => $qty

        );

        $this->cart->update($data);

        if ($qty == '0') {

            if ($this->session->userdata('gl_cart') != FALSE) {

                $gl_cart_session = array();

                $product_id_list_session = array();

                $gl_cart_session = $this->session->userdata('gl_cart');

                $product_id_list_session = $gl_cart_session['product_id_list'];

                $item_session_key = array_search($prod_id, $product_id_list_session);

                unset($product_id_list_session[$item_session_key]);

                $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'product_id_list', $product_id_list_session);

                if ($selected_product_id != FALSE) {

                    //unsetting  'wizard_1_product_id' session For wizard1

                    unset($gl_cart_session['wizard_1_product_id']);

                }

                if (isset($gl_cart_session['wizard_1_product_id'])) {

                    if ($gl_cart_session['wizard_1_product_id'] == $prod_id) {

                        //unsetting  'wizard_1_product_id' session For wizard1

                        unset($gl_cart_session['wizard_1_product_id']);

                    }

                }

                $this->session->set_userdata('gl_cart', $gl_cart_session);

            }

            echo '-1';

        } else {

            echo '1';

        }

    }

    public function get_available_qty() {

        $pid = $this->input->post('pid');

        $current_qty = $this->input->post('current_gl_input_qty_val');

        $incre_decre_type = $this->input->post('gl_incre_decre_type');

        $avail_qty = $this->common_model->GetByRow('ec_products', $pid, 'id');

        switch ($incre_decre_type) {

            case 'gl_plus':

                if ($avail_qty->qty != 0) {

                    if ($current_qty >= $avail_qty->qty) {

                        echo "NO";

                    } else {

                        echo "YES";

                    }

                } else {

                    echo "OUT";

                }

                break;

            case 'gl_minus':

                if ($avail_qty->qty == 0) {

                    echo "NO";

                }

        }

    }

}

